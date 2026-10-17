<?php $mensaje = session()->getFlashdata('mensaje'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="users">Users</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card wide-card">
            <h1 data-i18n="users">Users</h1>

            <?php if ($mensaje): ?>
                <p class="success-message"><?= esc($mensaje) ?></p>
            <?php endif; ?>

            <a class="panel-button"
               href="<?= site_url('users/new') ?>"
               data-i18n="new_user">New user</a>

            <form class="search-row" action="<?= site_url('users') ?>" method="get">
                <label for="q" data-i18n="search">Search</label>
                <input id="q" name="q" value="<?= esc($busqueda) ?>">
                <button class="panel-button" type="submit" data-i18n="search">Search</button>
            </form>

            <div class="sort-row">
                <a href="<?= site_url('users?orden=newest&q=' . urlencode($busqueda)) ?>"
                   data-i18n="newest">Newest</a>

                <a href="<?= site_url('users?orden=oldest&q=' . urlencode($busqueda)) ?>"
                   data-i18n="oldest">Oldest</a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th data-i18n="name">Name</th>
                            <th data-i18n="email">Email</th>
                            <th data-i18n="active">Active</th>
                            <th data-i18n="administrator">Administrator</th>
                            <th data-i18n="created_at">Created at</th>
                            <th data-i18n="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= esc($usuario['nombre']) ?></td>
                                <td><?= esc($usuario['email']) ?></td>

                                <td data-i18n="<?= $usuario['active'] ? 'yes' : 'no' ?>">
                                    <?= $usuario['active'] ? 'Yes' : 'No' ?>
                                </td>

                                <td data-i18n="<?= $usuario['administrator'] ? 'yes' : 'no' ?>">
                                    <?= $usuario['administrator'] ? 'Yes' : 'No' ?>
                                </td>

                                <td><?= esc($usuario['created_at'] ?? '') ?></td>

                                <td>
                                    <a href="<?= site_url('users/' . $usuario['id']) ?>"
                                       data-i18n="view">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?= $pager->links('usuarios') ?>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>