<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/welcome-s.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>

<header class="home">
    <a href="<?= site_url('welcome-sesion') ?>">
        <h2 data-i18n="home">Home</h2>
    </a>

    <label for="idioma" data-i18n="select_language">Select Language</label>
    <select class="idioma" id="idioma">
        <option value="en" data-i18n="english">English</option>
        <option value="es" data-i18n="spanish">Spanish</option>
    </select>

    <nav class="list-links">
        <span class="W">
            <span data-i18n="hello" >Hello</span>,
            <?= esc(session()->get('usuario_nombre') ?? 'User') ?>
        </span>

        <a href="<?= site_url('profile') ?>" data-i18n="profile" class="Profile">Profile</a>
        <a href="#" data-i18n="users" class="Users">Users</a>
        <a href="#" data-i18n="tasks" class="Tasks">Tasks</a>
        <a href="<?= site_url('logout') ?>" data-i18n="log_out" class="LogOut">Log out</a>
    </nav>
</header>

<main class="profile-main">
    <section class="profile-card">
        <h1 data-i18n="profile">Profile</h1>

        <div class="profile-avatar">
            <?= esc(strtoupper(substr($usuario['nombre'] ?? 'U', 0, 1))) ?>
        </div>

        <p>
            <strong data-i18n="name">Name</strong><br>
            <?= esc($usuario['nombre'] ?? '') ?>
        </p>

        <p>
            <strong data-i18n="email">Email</strong><br>
            <?= esc($usuario['email'] ?? '') ?>
        </p>

        <a
            class="profile-button"
            href="<?= site_url('profile/edit') ?>"
            data-i18n="edit"
        >Edit</a>
    </section>
</main>

<script src="/js/profile.js"></script>
</body>
</html>