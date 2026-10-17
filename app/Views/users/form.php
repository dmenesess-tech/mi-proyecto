<?php $editar = !empty($usuario); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="<?= $editar ? 'edit_user' : 'new_user' ?>"><?= $editar ? 'Edit user' : 'New user' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="<?= $editar ? 'edit_user' : 'new_user' ?>"><?= $editar ? 'Edit user' : 'New user' ?></h1>

            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= $editar ? site_url('users/' . $usuario['id'] . '/edit') : site_url('users/new') ?>" method="post">
                <?= csrf_field() ?>

                <label for="nombre" data-i18n="name">Name</label>
                <input id="nombre" name="nombre" value="<?= esc(old('nombre', $usuario['nombre'] ?? '')) ?>" required>

                <label for="email" data-i18n="email">Email</label>
                <input id="email" name="email" type="email" value="<?= esc(old('email', $usuario['email'] ?? '')) ?>" required>

                <label for="password" data-i18n="<?= $editar ? 'new_password_optional' : 'password' ?>">
                    <?= $editar ? 'New password (optional)' : 'Password' ?>
                </label>
                <input id="password" name="password" type="password" <?= $editar ? '' : 'required' ?>>

                <label class="check-row">
                    <input type="checkbox" name="active" value="1" <?= old('active', $usuario['active'] ?? 1) ? 'checked' : '' ?>>
                    <span data-i18n="active">Active</span>
                </label>

                <label class="check-row">
                    <input type="checkbox" name="administrator" value="1" <?= old('administrator', $usuario['administrator'] ?? 0) ? 'checked' : '' ?>>
                    <span data-i18n="administrator">Administrator</span>
                </label>

                <div class="panel-actions">
                    <button class="panel-button" type="submit" data-i18n="save">Save</button>
                    <a class="panel-button secondary-button" href="<?= site_url('users') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>