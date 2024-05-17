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

$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Elenco Utenti</h1>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
    <a href="create.php" class="btn btn-primary mb-3">Crea Nuovo Utente</a>

    <?php if (count($users) > 0): ?>
    <div class="list-group mt-4">
        <?php foreach ($users as $user): ?>
        <div class="list-group-item">
            ID: <?php echo $user['id']; ?><br>
            Nome: <?php echo $user['nome']; ?><br>
            Cognome: <?php echo $user['cognome']; ?><br>
            Email: <?php echo $user['email']; ?><br>
            <a href="update.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Modifica</a>
            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Elimina</a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="alert alert-warning mt-4" role="alert">
        Nessun utente presente nel database.
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
