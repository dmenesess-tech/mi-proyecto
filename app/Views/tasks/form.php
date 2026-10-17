<?php $editar = !empty($tarea); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="<?= $editar ? 'edit_task' : 'new_task' ?>"><?= $editar ? 'Edit task' : 'New task' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/welcome-s.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/panel.css') ?>">
</head>
<body>
    <?= $this->include('partials/session-header') ?>

    <main class="panel-main">
        <section class="panel-card">
            <h1 data-i18n="<?= $editar ? 'edit_task' : 'new_task' ?>"><?= $editar ? 'Edit task' : 'New task' ?></h1>

            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= $editar ? site_url('tasks/' . $tarea['id'] . '/edit') : site_url('tasks/new') ?>" method="post">
                <?= csrf_field() ?>
                <label for="description" data-i18n="description">Description</label>
                <textarea id="description" name="description" required><?= esc(old('description', $tarea['description'] ?? '')) ?></textarea>

                <div class="panel-actions">
                    <button class="panel-button" type="submit" data-i18n="save">Save</button>
                    <a class="panel-button secondary-button" href="<?= site_url('tasks') ?>" data-i18n="cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('js/panel.js') ?>"></script>
</body>
</html>