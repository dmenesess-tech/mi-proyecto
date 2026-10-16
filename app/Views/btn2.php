<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <link rel="stylesheet" href="/css/StyleL.css">
    <title>Sing in</title>
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
     <a class="btn1" href="/btn1" data-i18n="sign_up">Sign up</a>
    </nav>
  </header>

    <main class="main-page">
        <section class="login-card">

            <h1 for="nombre" data-i18n="log_in">Log In</h1>

            <form action="/login" method="post">
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
                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" data-i18n="remember_me">Remember me</label>
                </div>

                <button type="submit" data-i18n="log_in">Log In</button>
                <a href="/forgot-password" data-i18n="forgot">Forgot Password?</a>
            </form>


        </section>
    </main>

    <script src="/js/btn2.js"></script>
    
</body>
</html>