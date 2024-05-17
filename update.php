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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];

    $user->updateUser($id, $nome, $cognome, $email);
    header("Location: index.php");
    exit();
} else {
    $id = $_GET['id'];
    $currentUser = $user->getUserById($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Modifica Utente</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Torna Indietro</a>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $currentUser['id']; ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $currentUser['nome']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo $currentUser['cognome']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $currentUser['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

