<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function registroForm()
    {
        return view('btn1');
    }

    public function loginForm()
    {
        return view('btn2');
    }

    public function registrar()
    {
        $reglas = [
            'nombre'   => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|max_length[150]|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        }

        $modelo = new UsuarioModel();
        $modelo->insert([
            'nombre'   => trim($this->request->getPost('nombre')),
            'email'    => strtolower(trim($this->request->getPost('email'))),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        return redirect()->to('/btn2');
    }

    public function login()
    {
        $email = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $modelo = new UsuarioModel();
        $usuario = $modelo->where('email', $email)->first();

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            return redirect()->back()->withInput();
        }

        session()->set([
            'usuario_id'     => $usuario['id'],
            'usuario_nombre' => $usuario['nombre'],
            'esta_logueado'  => true,
        ]);

        return redirect()->to('welcome-sesion');
    }

    public function profile()
    {
        if (!session()->get('esta_logueado')) {
            return redirect()->to(site_url('login'));
        }

        $modelo = new UsuarioModel();
        $usuario = $modelo->find((int) session()->get('usuario_id'));

        if (!$usuario) {
            return redirect()->to(site_url('login'));
        }

        return view('profile', ['usuario' => $usuario]);
    }

    public function editProfile()
    {
        if (!session()->get('esta_logueado')) {
            return redirect()->to(site_url('login'));
        }

        $modelo = new UsuarioModel();
        $usuario = $modelo->find((int) session()->get('usuario_id'));

        if (!$usuario) {
            return redirect()->to(site_url('login'));
        }

        return view('edit-profile', [
            'usuario' => $usuario,
            'errors'  => [],
        ]);
    }

    public function updateProfile()
    {
        if (!session()->get('esta_logueado')) {
            return redirect()->to(site_url('login'));
        }

        $id = (int) session()->get('usuario_id');

        $reglas = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'email'  => 'required|valid_email|max_length[150]|is_unique[usuarios.email,id,' . $id . ']',
        ];

        $modelo = new UsuarioModel();
        $usuario = $modelo->find($id);

        if (!$usuario) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->validate($reglas)) {
            return view('edit-profile', [
                'usuario' => $usuario,
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $nombre = trim($this->request->getPost('nombre'));
        $email = strtolower(trim($this->request->getPost('email')));

        $modelo->update($id, [
            'nombre' => $nombre,
            'email'  => $email,
        ]);

        session()->set('usuario_nombre', $nombre);

        return redirect()->to(site_url('profile'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }

    public function forgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function sendResetLink()
    {
        $correo = strtolower(trim($this->request->getPost('email')));

        $modelo = new UsuarioModel();
        $usuario = $modelo->where('email', $correo)->first();

        if (!$usuario) {
            return redirect()->back()->with(
                'mensaje',
                'Si el correo está registrado, recibirás un enlace.'
            );
        }

        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = date('Y-m-d H:i:s', time() + 3600);

        $db = \Config\Database::connect();

        $db->table('password_resets')
            ->where('user_id', $usuario['id'])
            ->delete();

        $db->table('password_resets')->insert([
            'user_id'    => $usuario['id'],
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt,
        ]);

        $resetLink = site_url('reset-password/' . $token);

        $email = service('email');
        $email->setTo($usuario['email']);
        $email->setSubject('Restablecer contraseña');
        $email->setMessage(
            'Para cambiar tu contraseña, abre este enlace: ' . $resetLink
        );

        if (!$email->send(false)) {
            $detalle = $email->printDebugger(['headers']);
            log_message('error', 'Error SMTP al restablecer contraseña: ' . $detalle);

            $db->table('password_resets')
                ->where('token_hash', $tokenHash)
                ->delete();

            return redirect()->back()->with(
                'mensaje',
                'Error SMTP: ' . $detalle
            );
        }

        return redirect()->back()->with(
            'mensaje',
            'Si el correo está registrado, recibirás un enlace.'
        );
    }

    public function resetPasswordForm($token)
    {
        $tokenHash = hash('sha256', $token);
        $db = \Config\Database::connect();

        $reset = $db->table('password_resets')
            ->where('token_hash', $tokenHash)
            ->get()
            ->getRowArray();

        if (!$reset || strtotime($reset['expires_at']) <= time()) {
            return redirect()->to('/forgot-password')->with(
                'mensaje',
                'El enlace venció o no es válido. Solicita uno nuevo.'
            );
        }

        return view('reset-password', ['token' => $token]);
    }

    public function updatePassword($token)
    {
        $reglas = [
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($reglas)) {
            return view('reset-password', [
                'token'      => $token,
                'validation' => $this->validator,
            ]);
        }

        $tokenHash = hash('sha256', $token);
        $db = \Config\Database::connect();

        $reset = $db->table('password_resets')
            ->where('token_hash', $tokenHash)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->get()
            ->getRowArray();

        if (!$reset) {
            return redirect()->to('/forgot-password')->with(
                'mensaje',
                'El enlace venció o no es válido. Solicita uno nuevo.'
            );
        }

        $modelo = new UsuarioModel();
        $modelo->update((int) $reset['user_id'], [
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        $db->table('password_resets')
            ->where('id', $reset['id'])
            ->delete();

        return redirect()->to('/login')->with(
            'mensaje',
            'Tu contraseña fue cambiada. Ya puedes iniciar sesión.'
        );
    }
}