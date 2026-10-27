<?php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require dirname(__DIR__) . '/src/Database.php';
$email = getenv('ADMIN_EMAIL') ?: '';
$password = getenv('ADMIN_PASSWORD') ?: '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 12 || strlen($password) > 72) {
    fwrite(STDERR, "Задайте ADMIN_EMAIL и ADMIN_PASSWORD длиной от 12 до 72 символов.\n");
    exit(1);
}
$db = Database::connect();
$hash = password_hash($password, PASSWORD_DEFAULT);
$role = $db->query("SELECT id FROM roles WHERE code = 'admin'")->fetchColumn();
$statement = $db->prepare('INSERT INTO users (role_id, name, email, password, phone) VALUES (?, ?, ?, ?, ?)');
$statement->execute([$role, 'Администратор', $email, $hash, '+70000000000']);
echo "Администратор создан.\n";
