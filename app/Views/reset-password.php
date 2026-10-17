<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet" href="/css/reset.css">
    <title>Rest Password</title>
</head>
<body>

<header class="home">


    <label for="idioma" data-i18n="select_language">
      Select Language
    </label>

    <select class="idioma" id="idioma">
      <option value="en" data-i18n="english">English</option>
      <option value="es" data-i18n="spanish">Spanish</option>
    </select>

  </header>

    <main class="main-page">
        <h1 data-i18n="title">Create New Password</h1>

        <?php if (isset($validation)): ?>
            <?= $validation->listErrors() ?>
        <?php endif; ?>

        <form action="<?= site_url('reset-password/' . $token) ?> "method="post" class="reset-card"> 
            <?= csrf_field() ?>

            <label for="password" data-i18n="new_password">New password</label>
            <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                required
            >

            <label for="password_confirm" data-i18n="confirm_password">Confirm password</label>
            <input
                type="password"
                id="password_confirm"
                name="password_confirm"
                minlength="8"
                required
            >

            <button type="submit" data-i18n="change">Change password</button>
        </form>
    </main>

    <script src="/js/reset.js"></script>
</body>
</html> 