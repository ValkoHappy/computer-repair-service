<?php require dirname(__DIR__) . '/src/pages/register.php'; ?>

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
                    <h1 class="h3 mb-3">Регистрация</h1>
                    <p class="text-secondary">Заполните все поля формы.</p>

                    <?php if ($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div><?= esc($error) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" novalidate><?= Security::field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="name">Имя</label>
                            <input class="form-control" type="text" id="name" name="name" value="<?= old('name') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Номер телефона</label>
                            <input class="form-control" type="tel" id="phone" name="phone" value="<?= old('phone') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Пароль</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <button class="btn btn-success" type="submit">Зарегистрироваться</button>
                    </form>

                    <p class="text-secondary mt-4 mb-0">Уже есть аккаунт? <a class="text-success text-decoration-none fw-semibold" href="login.php">Войти</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
