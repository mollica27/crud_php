<?php

define('DB_HOST', 'localhost'); // Host do banco
define('DB_USER', 'root');      // Nome do usuário do banco (apenas "root")
define('DB_PASSWORD', '');      // Senha (vazia por padrão no XAMPP)
define('DB_NAME', 'crud_app');  // Nome do banco de dados

function connect() {
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

    
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if ($conn->query($sql) === TRUE) {
        echo "Banco de dados `" . DB_NAME . "` verificado/criado com sucesso.<br>";
    } else {
        die("Erro ao criar o banco de dados: " . $conn->error);
    }

    
    $conn->select_db(DB_NAME);

    
    createTables($conn);

    return $conn;
}

function createTables($conn) {
    
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password CHAR(40) NOT NULL,
        token VARCHAR(64) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    
    if ($conn->query($sql) === TRUE) {
        echo "Tabela `users` verificada/criada com sucesso.<br>";
    } else {
        echo "Erro ao criar/verificar a tabela: " . $conn->error . "<br>";
    }
}
?>
