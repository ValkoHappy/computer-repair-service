<?php
require_once dirname(__DIR__) . '/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
$_SESSION = [];
session_destroy();
redirect('index.php');
