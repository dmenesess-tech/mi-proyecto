<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <link rel="stylesheet" href="/css/forgot-pass.css">
    <title>Forgot Password</title>
</head>
<body>

<header class="home">
    <a href="/"><h2 data-i18n="home">Home</h2></a>

    <label for="idioma" data-i18n="select_language">
      Select Language
    </label>

    <select class="idioma" id="idioma">
      <option value="en" data-i18n="english">English</option>
      <option value="es" data-i18n="spanish">Spanish</option>
    </select>
  </header>

    <main class="main-page">
        <section class="forgot-password-card">

            <h1 for="nombre" data-i18n="forgot_password">Forgot Password?</h1>

            <?php if ($mensaje = session()->getFlashdata('mensaje')): ?>
                <p><?= esc($mensaje) ?></p>
            <?php endif; ?>
            
           <form action="/forgot-password" method="post">
    <label for="email" data-i18n="email">Email</label>
    <input type="email"id="email" name="email"required>

    <div class="fun-buttons">
        <button type="submit" data-i18n="send_reset_link">Send</button>

        <a href="/" class="cancel-button"data-i18n="cancel_password_reset">Cancel</a>
    </div>
</form>


        </section>
    </main>

    <script src="/js/Fpass.js"></script>
    
</body>
</html>