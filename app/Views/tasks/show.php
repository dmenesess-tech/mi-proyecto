<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="task">Task</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="task">Task</h1>
            <p><strong data-i18n="id">ID</strong>: <?= esc($tarea['id']) ?></p>
            <p><strong data-i18n="description">Description</strong></p>
            <p><?= nl2br(esc($tarea['description'])) ?></p>
            <p><strong data-i18n="created_at">Created at</strong>: <?= esc($tarea['created_at'] ?? '') ?></p>
            <p><strong data-i18n="updated_at">Updated at</strong>: <?= esc($tarea['updated_at'] ?? '') ?></p>

            <div class="panel-actions">
                <a class="panel-button" href="<?= site_url('tasks/' . $tarea['id'] . '/edit') ?>" data-i18n="edit">Edit</a>
                <form action="<?= site_url('tasks/' . $tarea['id'] . '/delete') ?>" method="post"
                      data-confirm="confirm_delete_task">
                    <?= csrf_field() ?>
                    <button class="panel-button danger-button" type="submit" data-i18n="delete">Delete</button>
                </form>
                <a class="panel-button secondary-button" href="<?= site_url('tasks') ?>" data-i18n="back">Back</a>
            </div>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>