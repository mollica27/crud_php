<?php
require_once '../models/user_model.php';


if (!isset($_GET['id'])) {
    die("Erro: O parâmetro 'id' é obrigatório.");
}

$id = intval($_GET['id']);


if (deleteUser($id)) {
    echo json_encode(["message" => "Usuário deletado com sucesso!"]);
} else {
    echo json_encode(["error" => "Erro ao deletar o usuário."]);
}
?>
