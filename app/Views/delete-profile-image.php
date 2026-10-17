<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="delete_profile_image">Delete profile image</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="delete_profile_image">Delete profile image</h1>
            <p data-i18n="confirm_delete_image">Are you sure you want to delete your profile image?</p>

            <form action="<?= site_url('profile/image/delete') ?>" method="post">
                <?= csrf_field() ?>
                <div class="panel-actions">
                    <button class="panel-button danger-button" type="submit" data-i18n="confirm">Delete</button>
                    <a class="panel-button secondary-button" href="<?= site_url('profile') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>