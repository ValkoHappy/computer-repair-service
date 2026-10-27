<?php
require_once dirname(__DIR__) . '/functions.php';
requireGuest();

$pageTitle = 'Регистрация';
$pageDescription = 'Страница регистрации пользователя.';
$errors = [];

if (isPost()) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name === '' || mb_strlen($name) < 3) {
        $errors[] = 'Введите имя не короче 3 символов.';
    }

    if (!preg_match('/^\+?[0-9\-\(\)\s]{10,20}$/', $phone)) {
        $errors[] = 'Введите корректный номер телефона.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email.';
    }

    if (mb_strlen($password) < 6) {
        $errors[] = 'Пароль должен содержать как минимум 6 символов.';
    }

    $checkUser = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $checkUser->execute([$email]);

    if ($checkUser->fetch()) {
        $errors[] = 'Пользователь с таким email уже существует.';
    }

    if (!$errors) {
        $roleId = roleIdByCode('user');
        $statement = $pdo->prepare('INSERT INTO users (role_id, name, phone, email, password) VALUES (?, ?, ?, ?, ?)');
        $statement->execute([$roleId, $name, $phone, $email, password_hash($password, PASSWORD_DEFAULT)]);

        setFlash('success', 'Регистрация прошла успешно. Теперь войдите в систему.');
        redirect('login.php');
    }
}
