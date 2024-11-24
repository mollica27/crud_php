<?php
require_once '../models/user_model.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name'], $data['email'], $data['password'])) {
    die("Erro: Os campos 'name', 'email' e 'password' são obrigatórios.");
}


if (createUser($data['name'], $data['email'], $data['password'])) {
    echo json_encode(["message" => "Usuário criado com sucesso!"]);
} else {
    echo json_encode(["error" => "Erro ao criar o usuário."]);
}
?>
