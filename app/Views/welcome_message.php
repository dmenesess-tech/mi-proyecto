<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome page</title>

  <link rel="stylesheet" href="/css/Style.css">
  <script src="/js/idioma.js" defer></script>
</head>
<body>
  <header class="home">
    <h2 data-i18n="home">Home</h2>

    <label for="idioma" data-i18n="select_language">
      Select Language
    </label>

    <select class="idioma" id="idioma">
      <option value="en" data-i18n="english">English</option>
      <option value="es" data-i18n="spanish">Spanish</option>
    </select>

    <nav class="auth-links">
      <a class="btn1" href="/btn1" data-i18n="sign_up">Sign up</a>
      <a class="btn2" href="/btn2" data-i18n="log_in">Log in</a>
    </nav>
  </header>

  <main class="main-content">
    <h1 data-i18n="main_title">Welcome to Our Page</h1>

    <p data-i18n="main_description">
      Here, the teacher and students can check assignments, activities, and
      important course dates. The goal is to keep everything organized and
      make communication easier.
    </p>

    <p data-i18n="main_message">
      If you already have an account, log in. If you don't, sign up.
      You can change the language using the selector if needed.
    </p>
  </main>
</body>
</html>