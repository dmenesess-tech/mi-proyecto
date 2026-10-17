<header class="home">
    <a class="home-link" href="<?= site_url('welcome-sesion') ?>">
        <h2 data-i18n="home">Home</h2>
    </a>

    <label for="idioma" data-i18n="select_language">Select Language</label>

    <select class="idioma" id="idioma">
        <option value="en" data-i18n="english">English</option>
        <option value="es" data-i18n="spanish">Spanish</option>
    </select>

    <nav class="list-links">
        <span class="name">
            <span data-i18n="hello">Hello</span>,
            <?= esc(session()->get('usuario_nombre') ?? 'User') ?>
        </span>

        <a class="Profile" href="<?= site_url('profile') ?>" data-i18n="profile">Profile</a>

        <?php if (session()->get('es_administrador')): ?>
            <a class="Users" href="<?= site_url('users') ?>" data-i18n="users">Users</a>
        <?php endif; ?>

        <a class="Tasks" href="<?= site_url('tasks') ?>" data-i18n="tasks">Tasks</a>
        <a class="LogOut" href="<?= site_url('logout') ?>" data-i18n="log_out">Log out</a>
    </nav>
</header>