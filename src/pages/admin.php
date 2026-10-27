<?php
require_once dirname(__DIR__) . '/functions.php';
requireAdmin();

$pageTitle = 'Панель администратора';
$pageDescription = 'Управление заявками пользователей.';
$errors = [];
$flashes = getFlashMessages();
$statusLabels = statusOptions();

if (isPost()) {
    $requestId = (int) ($_POST['request_id'] ?? 0);
    $statusCode = trim($_POST['status'] ?? '');

    if ($requestId <= 0) {
        $errors[] = 'Не выбрана заявка.';
    }

    if (!isset($statusLabels[$statusCode])) {
        $errors[] = 'Выбран неверный статус.';
    }

    if (!$errors) {
        $statusId = statusIdByCode($statusCode);
        $statement = $pdo->prepare('UPDATE requests SET status_id = ? WHERE id = ?');
        $statement->execute([$statusId, $requestId]);

        setFlash('success', 'Статус заявки изменён.');
        redirect('admin.php');
    }
}

$requests = $pdo->query(
    'SELECT requests.id, requests.full_name, requests.address, requests.description, requests.visit_date, requests.created_at,
            users.name AS user_name, users.phone, users.email,
            statuses.code AS status_code, statuses.name AS status_name
     FROM requests
     INNER JOIN users ON users.id = requests.user_id
     INNER JOIN statuses ON statuses.id = requests.status_id
     ORDER BY requests.id DESC'
)->fetchAll();
