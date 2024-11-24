<?php
require_once '../config/database.php';


function createUser($name, $email, $password) {
    $conn = connect();
    $hashed_password = sha1($password);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}


function getUserById($id) {
    $conn = connect();

    $stmt = $conn->prepare("SELECT id, name, email, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


function updateUser($id, $name, $email, $password) {
    $conn = connect();
    $hashed_password = sha1($password);

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $hashed_password, $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}


function deleteUser($id) {
    $conn = connect();

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}


function validateToken($token) {
    $conn = connect();

    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


function generateToken($email) {
    return sha1($email . time() . rand());
}


function authenticateUser($email, $password) {
    $conn = connect();
    $hashed_password = sha1($password);

    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        
        $token = generateToken($email);
        $update_stmt = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
        $update_stmt->bind_param("si", $token, $user['id']);
        $update_stmt->execute();

        $user['token'] = $token; // Adiciona o token ao array do usuário
        return $user;
    }

    return false;
}
?>
