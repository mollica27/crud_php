<?php
require_once '../models/user_model.php';


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'], $data['name'], $data['email'], $data['password'])) {
    die("Erro: Os campos 'id', 'name', 'email' e 'password' são obrigatórios.");
}


if (updateUser($data['id'], $data['name'], $data['email'], $data['password'])) {
    echo json_encode(["message" => "Usuário atualizado com sucesso!"]);
} else {
    echo json_encode(["error" => "Erro ao atualizar o usuário."]);
}
?>
