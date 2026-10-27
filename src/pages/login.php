<?php
require_once dirname(__DIR__) . '/functions.php';
requireGuest();

$pageTitle = 'Вход';
$pageDescription = 'Страница входа в систему ремонта компьютеров.';
$flashes = getFlashMessages();
$errors = [];

if (isPost()) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email.';
    };

    if ($password === '') {
        $errors[] = 'Введите пароль.';
    };

    if (!$errors) {
        $statement = $pdo->prepare(
            'SELECT users.id, users.name, users.phone, users.email, users.password, roles.code AS role_code
             FROM users
             INNER JOIN roles ON roles.id = users.role_id
             WHERE users.email = ?
             LIMIT 1'
        );
        $statement->execute([$email]);
        $user = $statement->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = 'Неверный email или пароль.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'role_code' => $user['role_code'],
            ];

            redirect($user['role_code'] === 'admin' ? 'admin.php' : 'cabinet.php');
        }
    }
}
