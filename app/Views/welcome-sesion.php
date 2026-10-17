<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <link rel="stylesheet" href="/css/welcome-s.css">
    <title>page</title>
</head>
<body>

<header class="home">
    <a href="#"><h2 data-i18n="home">Home</h2></a>

    <label for="idioma" data-i18n="select_language">
      Select Language
    </label>

    <select class="idioma" id="idioma">
      <option value="en" data-i18n="english">English</option>
      <option value="es" data-i18n="spanish">Spanish</option>
    </select>

    <nav class="list-links">
        <span class="name">Hello, <?= esc(session()->get('usuario_nombre') ?? 'User')?></span>
        <a class="Profile" href="/profile" data-i18n="profile">Profile</a>
        <a class="Users" href="" data-i18n="user">Users</a>
        <a class="Tasks" href="" data-i18n="task">Tasks</a>
        <a class="LogOut" href="/" data-i18n="log_out">Log out</a>
    </nav>
  </header>

    <main class="main-page">
        <section class="body">

            <h1 for="nombre" data-i18n="welcome">Welcome</h1>

            <div class="main-text" data-i18n="main_text">
                <p data-i18n="text">Login succesful! Welcome to your home page. Here you can view and manage your tasks, profile, user account, and other features.</p>
            </div>


        </section>
    </main>

    <script src="/js/welcome-s.js"></script>
    
</body>
</html>