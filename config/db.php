<?php
include '../config/db.php';

function registerUser($username, $email, $password) {
    global $pdo;
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashed_password]);
}
?>
