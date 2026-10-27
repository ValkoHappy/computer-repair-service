<?php require dirname(__DIR__) . '/src/pages/admin.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($pageDescription) ?>">
    <title><?= esc($pageTitle) ?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Панель администратора</h1>
            <p class="text-secondary mb-0">Просмотр и обработка всех заявок.</p>
        </div>
        <form action="logout.php" method="post" style="display:inline"><?= Security::field() ?><button type="submit" class="btn btn-outline-secondary" >Выйти</button></form>
    </div>

    <?php foreach ($flashes as $type => $message): ?>
        <div class="alert alert-<?= esc($type) ?>"><?= esc($message) ?></div>
    <?php endforeach; ?>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?= esc($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (!$requests): ?>
                <p class="mb-0">Заявок пока нет.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Клиент</th>
                                <th>Контакты</th>
                                <th>Адрес</th>
                                <th>Описание</th>
                                <th>Дата визита</th>
                                <th>Статус</th>
                                <th>Изменить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?= esc($request['id']) ?></td>
                                    <td>
                                        <div><?= esc($request['full_name']) ?></div>
                                        <div class="text-secondary small"><?= esc($request['user_name']) ?></div>
                                    </td>
                                    <td>
                                        <div><?= esc($request['phone']) ?></div>
                                        <div><?= esc($request['email']) ?></div>
                                    </td>
                                    <td><?= esc($request['address']) ?></td>
                                    <td><?= esc($request['description']) ?></td>
                                    <td><?= esc($request['visit_date']) ?></td>
                                    <td><span class="badge text-bg-<?= esc(statusBadge($request['status_code'])) ?>"><?= esc($request['status_name']) ?></span></td>
                                    <td>
                                        <form class="d-flex gap-2" method="post"><?= Security::field() ?>
                                            <input type="hidden" name="request_id" value="<?= esc($request['id']) ?>">
                                            <select class="form-select" name="status">
                                                <?php foreach ($statusLabels as $value => $label): ?>
                                                    <option value="<?= esc($value) ?>" <?= $request['status_code'] === $value ? 'selected' : '' ?>>
                                                        <?= esc($label) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button class="btn btn-success" type="submit">Сохранить</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
