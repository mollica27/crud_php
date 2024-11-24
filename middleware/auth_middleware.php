<?php
require_once '../models/user_model.php';

function authenticate() {
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        die(json_encode(["error" => "Token não fornecido."]));
    }

    $token = $headers['Authorization'];
    $user = validateToken($token);

    if (!$user) {
        http_response_code(401);
        die(json_encode(["error" => "Token inválido ou expirado."]));
    }

    return $user; 
    
}
?>
