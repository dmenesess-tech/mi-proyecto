<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/css/welcome-s.css">
    <link rel="stylesheet" href="/css/edit-profile.css">
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
            <span data-i18n="hello">Hello</span>,
            <?= esc(session()->get('usuario_nombre') ?? 'User') ?>
        </span>

        <a href="<?= site_url('profile') ?>" data-i18n="profile" class="Profile">Profile</a>
        <a href="#" data-i18n="users" class="Users">Users</a>
        <a href="#" data-i18n="tasks" class="Tasks">Tasks</a>
        <a href="<?= site_url('logout') ?>" data-i18n="log_out" class="LogOut">Log out</a>
    </nav>
</header>

<main class="edit-main">
    <section class="edit-card">
        <h1 data-i18n="edit_profile">Edit profile</h1>

        <?php if (!empty($errors)): ?>
            <div class="form-errors">
                <?php foreach ($errors as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('profile/update') ?>" method="post">
            <?= csrf_field() ?>

            <label for="nombre" data-i18n="name">Name</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                value="<?= esc(old('nombre', $usuario['nombre'] ?? '')) ?>"
                required
            >

            <label for="email" data-i18n="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= esc(old('email', $usuario['email'] ?? '')) ?>"
                required
            >

            <div class="edit-actions">
                <button type="submit" data-i18n="save">Save</button>
                <a href="<?= site_url('profile') ?>" data-i18n="cancel">Cancel</a>
            </div>
        </form>
    </section>
</main>

<script src="/js/edit-profile.js"></script>
</body>
</html>