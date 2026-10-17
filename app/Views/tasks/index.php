<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="tasks">Tasks</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card wide-card">
            <h1 data-i18n="tasks">Tasks</h1>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <p class="success-message"><?= esc(session()->getFlashdata('mensaje')) ?></p>
            <?php endif; ?>

            <a class="panel-button" href="<?= site_url('tasks/new') ?>" data-i18n="new_task">New task</a>

            <form class="search-row" action="<?= site_url('tasks') ?>" method="get">
                <label for="q" data-i18n="search">Search</label>
                <input id="q" name="q" value="<?= esc($busqueda) ?>">
                <button class="panel-button" type="submit" data-i18n="search">Search</button>
            </form>

            <div class="sort-row">
                <a href="<?= site_url('tasks?orden=newest&q=' . urlencode($busqueda)) ?>" data-i18n="newest">Newest</a>
                <a href="<?= site_url('tasks?orden=oldest&q=' . urlencode($busqueda)) ?>" data-i18n="oldest">Oldest</a>
            </div>

            <ul class="record-list">
                <?php foreach ($tareas as $tarea): ?>
                    <li>
                        <a href="<?= site_url('tasks/' . $tarea['id']) ?>">
                            <?= esc($tarea['description']) ?>
                        </a>
                        <small><?= esc($tarea['created_at'] ?? '') ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?= $pager->links('tareas') ?>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>