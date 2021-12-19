<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodeDados = "faeterj3dawnoite";
$conn = new mysqli($servidor, $usuario, $senha, $bancodeDados);
if ($conn->connect_error) {
    die("Conexao com o banco de dados falhou!!!");
}

$sql = "SELECT * from onibus";
$result = $conn->query($sql);

$arrOnibus[] = array();
$i = 0;
While ($linha = $result->fetch_assoc()){
    $arrOnibus[$i] = $linha;
     $i++;
}
echo json_encode($arrOnibus, JSON_UNESCAPED_UNICODE);
