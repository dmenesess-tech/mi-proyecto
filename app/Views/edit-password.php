<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="change_password">Change password</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="change_password">Edit password</h1>

            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('edit-password') ?>" method="post">
                <?= csrf_field() ?>

                <label for="password" data-i18n="new_password">New password</label>
                <input id="password" name="password" type="password" minlength="8" required>

                <label for="password_confirm" data-i18n="repeat_password">Repeat new password</label>
                <input id="password_confirm" name="password_confirm" type="password" minlength="8" required>

                <div class="panel-actions">
                    <button class="panel-button" type="submit" data-i18n="save">Save</button>
                    <a class="panel-button secondary-button" href="<?= site_url('profile') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>