<?php require dirname(__DIR__) . '/src/pages/index.php'; ?>

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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php foreach ($flashes as $type => $message): ?>
                <div class="alert alert-<?= esc($type) ?>"><?= esc($message) ?></div>
            <?php endforeach; ?>

            <div class="card shadow-sm border-success border-2">
                <div class="card-body p-5">
                    <span class="badge text-bg-success mb-3">Информационная система</span>
                    <h1 class="h2 mb-3">Ремонт компьютеров на дому</h1>
                    <p class="text-secondary mb-4">Зарегистрируйтесь в системе, создайте заявку и отслеживайте её статус в личном кабинете.</p>

                    <?php if (isAuth()): ?>
                        <a class="btn btn-success" href="<?= isAdmin() ? 'admin.php' : 'cabinet.php' ?>">Открыть систему</a>
                    <?php else: ?>
                        <a class="btn btn-success" href="register.php">Регистрация</a>
                        <a class="btn btn-outline-success" href="login.php">Вход</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
