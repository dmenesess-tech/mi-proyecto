<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="profile">Profile</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main profile-main">
        <section class="panel-card profile-card">
            <h1 data-i18n="profile">Profile</h1>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <p class="success-message"><?= esc(session()->getFlashdata('mensaje')) ?></p>
            <?php endif; ?>

            <?php if (!empty($usuario['foto_perfil'])): ?>
                <img class="profile-photo"
                     src="<?= base_url($usuario['foto_perfil']) ?>"
                     alt="Profile image">
            <?php else: ?>
                <div class="profile-avatar">
                    <?= esc(strtoupper(substr($usuario['nombre'] ?? 'U', 0, 1))) ?>
                </div>
            <?php endif; ?>

            <p><strong data-i18n="name">Name</strong><br><?= esc($usuario['nombre'] ?? '') ?></p>
            <p><strong data-i18n="email">Email</strong><br><?= esc($usuario['email'] ?? '') ?></p>

            <div class="panel-actions">
                <a class="panel-button" href="<?= site_url('profile/edit') ?>" data-i18n="edit">Edit</a>
                <a class="panel-button" href="<?= site_url('verify-password?accion=change_password') ?>" data-i18n="change_password">Change password</a>
                <a class="panel-button" href="<?= site_url('profile/image') ?>" data-i18n="change_profile_image">Change profile image</a>

                <?php if (!empty($usuario['foto_perfil'])): ?>
                    <a class="panel-button danger-button"
                       href="<?= site_url('profile/image/delete') ?>"
                       data-i18n="delete_profile_image">Delete profile image</a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>