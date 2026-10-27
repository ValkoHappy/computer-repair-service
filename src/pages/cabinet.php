<?php
require_once dirname(__DIR__) . '/functions.php';
requireAuth();

if (isAdmin()) {
    redirect('admin.php');
}

$user = currentUser();
$flashes = getFlashMessages();
$statement = $pdo->prepare(
    'SELECT requests.id, requests.full_name, requests.address, requests.description, requests.visit_date, requests.created_at,
            statuses.code AS status_code, statuses.name AS status_name
     FROM requests
     INNER JOIN statuses ON statuses.id = requests.status_id
     WHERE requests.user_id = ?
     ORDER BY requests.id DESC'
);
$statement->execute([$user['id']]);
$requests = $statement->fetchAll();

$pageTitle = 'Личный кабинет';
$pageDescription = 'Просмотр собственных заявок на ремонт компьютеров.';
