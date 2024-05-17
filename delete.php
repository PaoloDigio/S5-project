<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

$database = new Database();
$pdo = $database->getConnection();
$user = new User($pdo);

$id = $_GET['id'];
$user->deleteUser($id);

header("Location: index.php");
exit();
?>

