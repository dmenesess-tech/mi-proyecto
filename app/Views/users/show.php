<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="user">User</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="user">User</h1>
            <p><strong data-i18n="name">Name</strong><br><?= esc($usuario['nombre']) ?></p>
            <p><strong data-i18n="email">Email</strong><br><?= esc($usuario['email']) ?></p>
            <p><strong data-i18n="active">Active</strong><br><?= $usuario['active'] ? 'Yes' : 'No' ?></p>
            <p><strong data-i18n="administrator">Administrator</strong><br><?= $usuario['administrator'] ? 'Yes' : 'No' ?></p>
            <p><strong data-i18n="created_at">Created at</strong><br><?= esc($usuario['created_at'] ?? '') ?></p>
            <p><strong data-i18n="updated_at">Updated at</strong><br><?= esc($usuario['updated_at'] ?? '') ?></p>

            <div class="panel-actions">
                <a class="panel-button" href="<?= site_url('users/' . $usuario['id'] . '/edit') ?>" data-i18n="edit">Edit</a>
                <form action="<?= site_url('users/' . $usuario['id'] . '/delete') ?>" method="post"
                      data-confirm="confirm_delete_user">
                    <?= csrf_field() ?>
                    <button class="panel-button danger-button" type="submit" data-i18n="delete">Delete</button>
                </form>
                <a class="panel-button secondary-button" href="<?= site_url('users') ?>" data-i18n="back">Back</a>
            </div>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>