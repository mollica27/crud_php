<?php

include('../config/database.php');


$conn = connect();


echo json_encode(["message" => "Banco de dados e tabela verificados/criados com sucesso."]);
?>
