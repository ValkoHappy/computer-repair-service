<?php require dirname(__DIR__) . '/src/pages/request-create.php'; ?>

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
        <div class="col-lg-6">
            <div class="card shadow-sm border-success border-2">
                <div class="card-body p-4">
                    <h1 class="h3 mb-3">Новая заявка</h1>
                    <p class="text-secondary">Укажите данные для вызова мастера.</p>

                    <?php if ($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div><?= esc($error) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" novalidate><?= Security::field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="full_name">ФИО клиента</label>
                            <input class="form-control" type="text" id="full_name" name="full_name" value="<?= old('full_name', $user['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Адрес</label>
                            <input class="form-control" type="text" id="address" name="address" value="<?= old('address') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Описание проблемы</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required><?= old('description') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="visit_date">Дата визита</label>
                            <input class="form-control" type="date" id="visit_date" name="visit_date" value="<?= old('visit_date') ?>" required>
                        </div>
                        <button class="btn btn-success" type="submit">Отправить</button>
                        <a class="btn btn-outline-secondary" href="cabinet.php">Назад</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
