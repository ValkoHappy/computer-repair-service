<?php require dirname(__DIR__) . '/src/pages/cabinet.php'; ?>

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
            <h1 class="h3 mb-1">Личный кабинет</h1>
            <p class="text-secondary mb-0">Пользователь: <?= esc($user['name']) ?></p>
        </div>
        <div>
            <a class="btn btn-success" href="request-create.php">Новая заявка</a>
            <form action="logout.php" method="post" style="display:inline"><?= Security::field() ?><button type="submit" class="btn btn-outline-secondary" >Выйти</button></form>
        </div>
    </div>

    <?php foreach ($flashes as $type => $message): ?>
        <div class="alert alert-<?= esc($type) ?>"><?= esc($message) ?></div>
    <?php endforeach; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (!$requests): ?>
                <p class="mb-0">Заявок пока нет. Нажмите <a class="text-success text-decoration-none" href="request-create.php">создать заявку</a>.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ФИО клиента</th>
                                <th>Адрес</th>
                                <th>Описание</th>
                                <th>Дата визита</th>
                                <th>Статус</th>
                                <th>Создана</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?= esc($request['id']) ?></td>
                                    <td><?= esc($request['full_name']) ?></td>
                                    <td><?= esc($request['address']) ?></td>
                                    <td><?= esc($request['description']) ?></td>
                                    <td><?= esc($request['visit_date']) ?></td>
                                    <td><span class="badge text-bg-<?= esc(statusBadge($request['status_code'])) ?>"><?= esc($request['status_name']) ?></span></td>
                                    <td><?= esc($request['created_at']) ?></td>
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
