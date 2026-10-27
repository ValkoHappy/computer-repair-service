<?php require dirname(__DIR__) . '/src/pages/login.php'; ?>

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
        <div class="col-lg-5">
            <div class="card shadow-sm border-success border-2">
                <div class="card-body p-5">
                    <h1 class="h3 mb-3">Вход в систему</h1>
                    <p class="text-secondary">Введите email и пароль.</p>

                    <?php foreach ($flashes as $type => $message): ?>
                        <div class="alert alert-<?= esc($type) ?>"><?= esc($message) ?></div>
                    <?php endforeach; ?>

                    <?php if ($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <?= esc($error) ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" novalidate><?= Security::field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Пароль</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>

                        <button class="btn btn-success" type="submit">Войти</button>
                    </form>

                    <p class="text-secondary mt-4 mb-0">Нет аккаунта? <a class="text-success text-decoration-none fw-semibold" href="register.php">Регистрация</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
