<?php
require_once __DIR__ . '/bootstrap.php';
$pdo = Database::connect();

function esc($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path)
{
    header("Location: {$path}");
    exit;
}

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function currentUser()
{
    return $_SESSION['user'] ?? null;
}

function isAuth()
{
    return currentUser() !== null;
}

function isAdmin()
{
    return isAuth() && currentUser()['role_code'] === 'admin';
}

function requireGuest()
{
    if (isAuth()) {
        redirect(isAdmin() ? 'admin.php' : 'cabinet.php');
    }
}

function requireAuth()
{
    if (!isAuth()) {
        setFlash('danger', 'Сначала войдите в систему.');
        redirect('login.php');
    }
}

function requireAdmin()
{
    if (!isAdmin()) {
        setFlash('danger', 'Доступ только для администратора.');
        redirect('index.php');
    }
}

function setFlash($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

function getFlashMessages()
{
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);

    return $messages;
}

function old($key, $default = '')
{
    return esc($_POST[$key] ?? $default);
}

function roleIdByCode($code)
{
    global $pdo;

    $statement = $pdo->prepare('SELECT id FROM roles WHERE code = ? LIMIT 1');
    $statement->execute([$code]);

    return (int) ($statement->fetchColumn() ?: 0);
}

function statusOptions()
{
    global $pdo;
    $rows = $pdo->query('SELECT code, name FROM statuses ORDER BY id')->fetchAll();
    $options = [];
    foreach ($rows as $row) {
        $options[$row['code']] = $row['name'];
    }
    return $options;
}

function statusIdByCode($code)
{
    global $pdo;

    $statement = $pdo->prepare('SELECT id FROM statuses WHERE code = ? LIMIT 1');
    $statement->execute([$code]);

    return (int) ($statement->fetchColumn() ?: 0);
}

function statusBadge($status)
{
    $map = [
        'new' => 'warning',
        'confirmed' => 'success',
        'rejected' => 'danger',
    ];

    return $map[$status] ?? 'secondary';
}
