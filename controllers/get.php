<?php
require_once '../models/user_model.php';


if (!isset($_GET['id'])) {
    die("Erro: O parâmetro 'id' é obrigatório.");
}

$id = intval($_GET['id']);
$user = getUserById($id);

if ($user) {
    echo json_encode($user);
} else {
    echo json_encode(["error" => "Usuário não encontrado."]);
}
?>



