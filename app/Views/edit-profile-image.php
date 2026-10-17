<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="change_profile_image">Edit profile image</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="change_profile_image">Edit profile image</h1>

            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('profile/image') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <label for="foto" data-i18n="choose_image">Choose image</label>
                <input id="foto" name="foto" type="file" accept="image/png,image/jpeg,image/webp" required>
                <p data-i18n="image_limit">PNG, JPG, or WEBP. Maximum size: 2 MB.</p>

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