<?php
require_once '../models/user_model.php';


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email'], $data['password'])) {
    http_response_code(400);
    die(json_encode(["error" => "'email' e 'password' são obrigatórios."]));
}


$user = authenticateUser($data['email'], $data['password']);

if ($user) {
    echo json_encode([
        "message" => "Login realizado com sucesso.",
        "token" => $user['token']
    ]);
} else {
    http_response_code(401);
    echo json_encode(["error" => "Credenciais inválidas."]);
}
?>
