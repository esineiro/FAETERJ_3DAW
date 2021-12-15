<?php

$id = $_GET["id"];
$marca = $_GET["marca"];
$modelo = $_GET["modelo"];
$qtdAssentos = $_GET["qtdAssentos"];
$temBanheiro = $_GET["temBanheiro"];
$temArCondicionado = $_GET["temArCondicionado"];
$chassis = $_GET["chassis"];
$placa = $_GET["placa"];

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodeDados = "faeterj3dawnoite";
$conn = new mysqli($servidor, $usuario, $senha, $bancodeDados);
if ($conn->connect_error) {
    die("Conexao com o banco de dados falhou!!!");
}

$sql = "insert into `onibus`(`id`, `marca`, `modelo`, `qtdAssentos`, `temBanheiro`, `temArCondicionado`, `chassis`, `placa`) VALUES ('$id',$marca','$modelo','$qtdAssentos','$temBanheiro','$temArCondicionado','$chassis','$placa');";
$result = $conn->query($sql);
//   if ($conn->query($sql) === TRUE) {
$sucesso = true;

$sql = "select * from `onibus` where id=$id";
$result = $conn->query($sql);

$jOnibus = json_encode($result);
echo $jOnibus;
?>