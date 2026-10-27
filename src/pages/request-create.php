<?php
require_once dirname(__DIR__) . '/functions.php';
requireAuth();

if (isAdmin()) {
    redirect('admin.php');
}

$pageTitle = 'Новая заявка';
$pageDescription = 'Создание новой заявки на ремонт компьютера.';
$errors = [];
$user = currentUser();

if (isPost()) {
    $fullName = trim($_POST['full_name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $visitDate = trim($_POST['visit_date'] ?? '');

    if ($fullName === '' || mb_strlen($fullName) < 10) {
        $errors[] = 'Введите ФИО полностью.';
    }

    if ($address === '' || mb_strlen($address) < 10) {
        $errors[] = 'Введите адрес полностью.';
    }

    if ($description === '' || mb_strlen($description) < 20) {
        $errors[] = 'Введите подробное описание проблемы.';
    }

    $date = DateTime::createFromFormat('Y-m-d', $visitDate);
    if (!$date || $date->format('Y-m-d') !== $visitDate) {
        $errors[] = 'Введите корректную дату визита.';
    }

    if (!$errors) {
        $statusId = statusIdByCode('new');
        $statement = $pdo->prepare(
            'INSERT INTO requests (user_id, status_id, full_name, address, description, visit_date)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $statement->execute([$user['id'], $statusId, $fullName, $address, $description, $visitDate]);

        setFlash('success', 'Заявка успешно отправлена.');
        redirect('cabinet.php');
    }
}
