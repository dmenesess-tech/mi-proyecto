<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="welcome">Welcome</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="main-page">
        <section class="body">
            <h1 data-i18n="welcome">Welcome</h1>
            <div class="main-text">
                <p data-i18n="welcome_text">
                    Login successful! Welcome to your home page. Here you can view and manage your tasks and profile.
                </p>
            </div>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>