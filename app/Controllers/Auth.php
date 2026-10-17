<?php

namespace App\Controllers;

use App\Models\TareaModel;
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
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        $modelo = new UsuarioModel();
        $modelo->insert([
            'nombre'        => trim($this->request->getPost('nombre')),
            'email'         => strtolower(trim($this->request->getPost('email'))),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active'        => 1,
            'administrator' => 0,
        ]);

        return redirect()->to(site_url('login'))->with('mensaje', 'Account created successfully.');
    }

    public function login()
    {
        $email = strtolower(trim($this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        $modelo = new UsuarioModel();
        $usuario = $modelo->where('email', $email)->first();

        if (
            !$usuario ||
            !(int) ($usuario['active'] ?? 1) ||
            !password_verify($password, $usuario['password'])
        ) {
            return redirect()->back()->withInput()->with('mensaje', 'Email or password is incorrect.');
        }

        session()->regenerate();

        session()->set([
            'usuario_id'      => (int) $usuario['id'],
            'usuario_nombre'  => $usuario['nombre'],
            'esta_logueado'   => true,
            'es_administrador'=> (bool) ($usuario['administrator'] ?? false),
        ]);

        return redirect()->to(site_url('welcome-sesion'));
    }

    public function welcomeSesion()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        return view('welcome-sesion');
    }

    public function profile()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $usuario = $this->currentUser();

        if (!$usuario) {
            return redirect()->to(site_url('logout'));
        }

        return view('profile', ['usuario' => $usuario]);
    }

    public function editProfile()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->authorized('edit_profile')) {
            return redirect()->to(site_url('verify-password?accion=edit_profile'));
        }

        return view('edit-profile', [
            'usuario' => $this->currentUser(),
            'errores' => [],
        ]);
    }

    public function updateProfile()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->authorized('edit_profile')) {
            return redirect()->to(site_url('verify-password?accion=edit_profile'));
        }

        $id = (int) session()->get('usuario_id');

        $reglas = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'email'  => 'required|valid_email|max_length[150]|is_unique[usuarios.email,id,' . $id . ']',
        ];

        if (!$this->validate($reglas)) {
            return view('edit-profile', [
                'usuario' => $this->currentUser(),
                'errores' => $this->validator->getErrors(),
            ]);
        }

        $nombre = trim($this->request->getPost('nombre'));
        $email = strtolower(trim($this->request->getPost('email')));

        (new UsuarioModel())->update($id, [
            'nombre' => $nombre,
            'email'  => $email,
        ]);

        session()->set('usuario_nombre', $nombre);
        session()->remove('accion_autorizada');

        return redirect()->to(site_url('profile'))->with('mensaje', 'Profile updated.');
    }

    public function verifyPasswordForm()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $accion = $this->request->getGet('accion') ?? 'change_password';

        if (!in_array($accion, ['edit_profile', 'change_password'], true)) {
            $accion = 'change_password';
        }

        return view('verify-password', ['accion' => $accion]);
    }

    public function verifyPassword()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $accion = $this->request->getPost('accion');

        if (!in_array($accion, ['edit_profile', 'change_password'], true)) {
            return redirect()->to(site_url('profile'));
        }

        $usuario = $this->currentUser();
        $password = (string) $this->request->getPost('password');

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            return redirect()->back()->with('mensaje', 'The password is incorrect.');
        }

        session()->set([
            'accion_autorizada' => $accion,
            'accion_hasta'      => time() + 300,
        ]);

        if ($accion === 'edit_profile') {
            return redirect()->to(site_url('profile/edit'));
        }

        return redirect()->to(site_url('edit-password'));
    }

    public function editPasswordForm()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->authorized('change_password')) {
            return redirect()->to(site_url('verify-password?accion=change_password'));
        }

        return view('edit-password', ['errores' => []]);
    }

    public function updateLoggedInPassword()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->authorized('change_password')) {
            return redirect()->to(site_url('verify-password?accion=change_password'));
        }

        $reglas = [
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($reglas)) {
            return view('edit-password', ['errores' => $this->validator->getErrors()]);
        }

        (new UsuarioModel())->update((int) session()->get('usuario_id'), [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        session()->remove(['accion_autorizada', 'accion_hasta']);

        return redirect()->to(site_url('profile'))->with('mensaje', 'Password changed successfully.');
    }

    public function editProfileImage()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        return view('edit-profile-image', ['errores' => []]);
    }

    public function updateProfileImage()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $reglas = [
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($reglas)) {
            return view('edit-profile-image', ['errores' => $this->validator->getErrors()]);
        }

        $foto = $this->request->getFile('foto');

        if (!$foto || !$foto->isValid()) {
            return redirect()->back()->with('mensaje', 'Choose a valid image.');
        }

        $carpeta = FCPATH . 'uploads/perfiles';

        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0775, true);
        }

        $nombreArchivo = $foto->getRandomName();

        if (!$foto->move($carpeta, $nombreArchivo)) {
            return redirect()->back()->with('mensaje', 'The image could not be saved.');
        }

        $usuario = $this->currentUser();
        $this->removeProfileImage($usuario['foto_perfil'] ?? null);

        (new UsuarioModel())->update((int) $usuario['id'], [
            'foto_perfil' => 'uploads/perfiles/' . $nombreArchivo,
        ]);

        return redirect()->to(site_url('profile'))->with('mensaje', 'Profile image updated.');
    }

    public function deleteProfileImageForm()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        return view('delete-profile-image');
    }

    public function deleteProfileImage()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $usuario = $this->currentUser();
        $this->removeProfileImage($usuario['foto_perfil'] ?? null);

        (new UsuarioModel())->update((int) $usuario['id'], ['foto_perfil' => null]);

        return redirect()->to(site_url('profile'))->with('mensaje', 'Profile image deleted.');
    }

    public function users()
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $modelo = new UsuarioModel();
        $busqueda = trim((string) $this->request->getGet('q'));
        $orden = $this->request->getGet('orden') === 'oldest' ? 'ASC' : 'DESC';

        if ($busqueda !== '') {
            $modelo->groupStart()
                ->like('nombre', $busqueda)
                ->orLike('email', $busqueda)
                ->groupEnd();
        }

        return view('users/index', [
            'usuarios' => $modelo->orderBy('created_at', $orden)->paginate(10, 'usuarios'),
            'pager'    => $modelo->pager,
            'busqueda' => $busqueda,
            'orden'    => $orden === 'ASC' ? 'oldest' : 'newest',
        ]);
    }

    public function newUserForm()
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        return view('users/form', ['usuario' => null, 'errores' => []]);
    }

    public function createUser()
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $reglas = [
            'nombre'   => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|max_length[150]|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($reglas)) {
            return view('users/form', [
                'usuario' => null,
                'errores' => $this->validator->getErrors(),
            ]);
        }

        (new UsuarioModel())->insert([
            'nombre'        => trim($this->request->getPost('nombre')),
            'email'         => strtolower(trim($this->request->getPost('email'))),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active'        => $this->request->getPost('active') ? 1 : 0,
            'administrator' => $this->request->getPost('administrator') ? 1 : 0,
        ]);

        return redirect()->to(site_url('users'))->with('mensaje', 'User created.');
    }

    public function showUser($id)
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $usuario = (new UsuarioModel())->find((int) $id);

        if (!$usuario) {
            return redirect()->to(site_url('users'));
        }

        return view('users/show', ['usuario' => $usuario]);
    }

    public function editUser($id)
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $usuario = (new UsuarioModel())->find((int) $id);

        if (!$usuario) {
            return redirect()->to(site_url('users'));
        }

        return view('users/form', ['usuario' => $usuario, 'errores' => []]);
    }

    public function updateUser($id)
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $id = (int) $id;
        $modelo = new UsuarioModel();
        $usuario = $modelo->find($id);

        if (!$usuario) {
            return redirect()->to(site_url('users'));
        }

        $reglas = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'email'  => 'required|valid_email|max_length[150]|is_unique[usuarios.email,id,' . $id . ']',
        ];

        $password = (string) $this->request->getPost('password');

        if ($password !== '') {
            $reglas['password'] = 'min_length[8]';
        }

        if (!$this->validate($reglas)) {
            return view('users/form', [
                'usuario' => $usuario,
                'errores' => $this->validator->getErrors(),
            ]);
        }

        $datos = [
            'nombre'        => trim($this->request->getPost('nombre')),
            'email'         => strtolower(trim($this->request->getPost('email'))),
            'active'        => $this->request->getPost('active') ? 1 : 0,
            'administrator' => $this->request->getPost('administrator') ? 1 : 0,
        ];

        if ($password !== '') {
            $datos['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $modelo->update($id, $datos);

        return redirect()->to(site_url('users/' . $id))->with('mensaje', 'User updated.');
    }

    public function deleteUser($id)
    {
        if (!$this->admin()) {
            return redirect()->to(site_url('welcome-sesion'));
        }

        $id = (int) $id;

        if ($id === (int) session()->get('usuario_id')) {
            return redirect()->to(site_url('users'))->with('mensaje', 'You cannot delete your own account.');
        }

        (new UsuarioModel())->delete($id);

        return redirect()->to(site_url('users'))->with('mensaje', 'User deleted.');
    }

    public function tasks()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        $modelo = new TareaModel();
        $busqueda = trim((string) $this->request->getGet('q'));
        $orden = $this->request->getGet('orden') === 'oldest' ? 'ASC' : 'DESC';

        $modelo->where('user_id', (int) session()->get('usuario_id'));

        if ($busqueda !== '') {
            $modelo->like('description', $busqueda);
        }

        return view('tasks/index', [
            'tareas'   => $modelo->orderBy('created_at', $orden)->paginate(10, 'tareas'),
            'pager'    => $modelo->pager,
            'busqueda' => $busqueda,
            'orden'    => $orden === 'ASC' ? 'oldest' : 'newest',
        ]);
    }

    public function newTaskForm()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        return view('tasks/form', ['tarea' => null, 'errores' => []]);
    }

    public function createTask()
    {
        if (!$this->loggedIn()) {
            return redirect()->to(site_url('login'));
        }

        if (!$this->validate(['description' => 'required|min_length[1]|max_length[2000]'])) {
            return view('tasks/form', ['tarea' => null, 'errores' => $this->validator->getErrors()]);
        }

        (new TareaModel())->insert([
            'user_id'     => (int) session()->get('usuario_id'),
            'description' => trim($this->request->getPost('description')),
        ]);

        return redirect()->to(site_url('tasks'))->with('mensaje', 'Task created.');
    }

    public function showTask($id)
    {
        $tarea = $this->findOwnTask($id);

        if (!$tarea) {
            return redirect()->to(site_url('tasks'));
        }

        return view('tasks/show', ['tarea' => $tarea]);
    }

    public function editTask($id)
    {
        $tarea = $this->findOwnTask($id);

        if (!$tarea) {
            return redirect()->to(site_url('tasks'));
        }

        return view('tasks/form', ['tarea' => $tarea, 'errores' => []]);
    }

    public function updateTask($id)
    {
        $tarea = $this->findOwnTask($id);

        if (!$tarea) {
            return redirect()->to(site_url('tasks'));
        }

        if (!$this->validate(['description' => 'required|min_length[1]|max_length[2000]'])) {
            return view('tasks/form', [
                'tarea'   => $tarea,
                'errores' => $this->validator->getErrors(),
            ]);
        }

        (new TareaModel())->update((int) $id, [
            'description' => trim($this->request->getPost('description')),
        ]);

        return redirect()->to(site_url('tasks/' . $id))->with('mensaje', 'Task updated.');
    }

    public function deleteTask($id)
    {
        $tarea = $this->findOwnTask($id);

        if (!$tarea) {
            return redirect()->to(site_url('tasks'));
        }

        (new TareaModel())->delete((int) $id);

        return redirect()->to(site_url('tasks'))->with('mensaje', 'Task deleted.');
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
        $usuario = (new UsuarioModel())->where('email', $correo)->first();

        if (!$usuario) {
            return redirect()->back()->with('mensaje', 'If the email is registered, a link will be sent.');
        }

        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = date('Y-m-d H:i:s', time() + 3600);
        $db = \Config\Database::connect();

        $db->table('password_resets')->where('user_id', $usuario['id'])->delete();
        $db->table('password_resets')->insert([
            'user_id'    => $usuario['id'],
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt,
        ]);

        $email = service('email');
        $email->setTo($usuario['email']);
        $email->setSubject('Restablecer contraseña');
        $email->setMessage('Para cambiar tu contraseña, abre este enlace: ' . site_url('reset-password/' . $token));

        if (!$email->send(false)) {
            log_message('error', 'Error SMTP al restablecer contraseña: ' . $email->printDebugger(['headers']));
            $db->table('password_resets')->where('token_hash', $tokenHash)->delete();

            return redirect()->back()->with('mensaje', 'No se pudo enviar el correo. Revisa la configuración SMTP.');
        }

        return redirect()->back()->with('mensaje', 'If the email is registered, a link will be sent.');
    }

    public function resetPasswordForm($token)
    {
        $reset = \Config\Database::connect()->table('password_resets')
            ->where('token_hash', hash('sha256', $token))
            ->get()->getRowArray();

        if (!$reset || strtotime($reset['expires_at']) <= time()) {
            return redirect()->to(site_url('forgot-password'))->with('mensaje', 'The link expired or is invalid.');
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
            return view('reset-password', ['token' => $token, 'validation' => $this->validator]);
        }

        $db = \Config\Database::connect();
        $reset = $db->table('password_resets')
            ->where('token_hash', hash('sha256', $token))
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->get()->getRowArray();

        if (!$reset) {
            return redirect()->to(site_url('forgot-password'))->with('mensaje', 'The link expired or is invalid.');
        }

        (new UsuarioModel())->update((int) $reset['user_id'], [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        $db->table('password_resets')->where('id', $reset['id'])->delete();

        return redirect()->to(site_url('login'))->with('mensaje', 'Your password was changed.');
    }

    private function loggedIn(): bool
    {
        return (bool) session()->get('esta_logueado');
    }

    private function admin(): bool
    {
        return $this->loggedIn() && (bool) session()->get('es_administrador');
    }

    private function currentUser(): ?array
    {
        return (new UsuarioModel())->find((int) session()->get('usuario_id'));
    }

    private function authorized(string $accion): bool
    {
        return session()->get('accion_autorizada') === $accion
            && (int) session()->get('accion_hasta') >= time();
    }

    private function findOwnTask($id): ?array
    {
        if (!$this->loggedIn()) {
            return null;
        }

        return (new TareaModel())
            ->where('id', (int) $id)
            ->where('user_id', (int) session()->get('usuario_id'))
            ->first();
    }

    private function removeProfileImage(?string $ruta): void
    {
        if (!$ruta || strpos($ruta, 'uploads/perfiles/') !== 0) {
            return;
        }

        $archivo = FCPATH . $ruta;

        if (is_file($archivo)) {
            unlink($archivo);
        }
    }
}