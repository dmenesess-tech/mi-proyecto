<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="verify_password">Verify password</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="verify_password">Please enter your password to continue</h1>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <p class="form-errors"><?= esc(session()->getFlashdata('mensaje')) ?></p>
            <?php endif; ?>

            <form action="<?= site_url('verify-password') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="accion" value="<?= esc($accion) ?>">

                <label for="password" data-i18n="password">Password</label>
                <input id="password" name="password" type="password" required>

                <div class="panel-actions">
                    <button class="panel-button" type="submit" data-i18n="send">Send</button>
                    <a class="panel-button secondary-button" href="<?= site_url('profile') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>