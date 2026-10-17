<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="edit_profile">Edit profile</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/edit-profile.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="edit_profile">Edit profile</h1>

            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('profile/update') ?>" method="post">
                <?= csrf_field() ?>

                <label for="nombre" data-i18n="name">Name</label>
                <input id="nombre" name="nombre" type="text"
                       value="<?= esc(old('nombre', $usuario['nombre'] ?? '')) ?>" required>

                <label for="email" data-i18n="email">Email</label>
                <input id="email" name="email" type="email"
                       value="<?= esc(old('email', $usuario['email'] ?? '')) ?>" required>

                <div class="panel-actions">
                    <button type="submit" class="panel-button" data-i18n="save">Save</button>
                    <a class="panel-button secondary-button" href="<?= site_url('profile') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>