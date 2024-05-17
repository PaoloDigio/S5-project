<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authenticate($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($nome, $cognome, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO users (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        return $stmt->execute();
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $nome, $cognome, $email) {
        $stmt = $this->pdo->prepare("UPDATE users SET nome = :nome, cognome = :cognome, email = :email WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
