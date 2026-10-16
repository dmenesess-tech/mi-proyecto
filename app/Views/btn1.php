<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <link rel="stylesheet" href="/css/StyleS.css">
    <title>Document</title>
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

    <nav class="auth-links">
      <a class="btn2" href="/btn2" data-i18n="log_in">Log in</a>
    </nav>
  </header>

    <h1 data-i18n="sign_up" class="central-title">Sign Up</h1>

    <main class="main-page">
        <section class="singup-card">
            <h1 for="nombre" data-i18n="create_account">Create an account</h1>

            <form action="/signup" method="post">
                <label for="nombre" data-i18n="name">Name</label>
                <input
                type="text"
                id="nombre"
                name="nombre"
                required
                >

                <label for="email" data-i18n="email">Email</label>
                <input
                type="email"
                id="email"
                name="email"
                required
                >

                <label for="password" data-i18n="password">Password</label>
                <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                required
                >
                <small data-i18n="password_description">It must be at least 8 characters long.</small>

                <button type="submit" data-i18n="create_account">Create Account</button>
            </form>


        </section>
    </main>

    <script src="/js/btn1.js"></script>
    
</body>
</html>