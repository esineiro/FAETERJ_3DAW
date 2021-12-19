<?php

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

$sql = "insert into `onibus`(`marca`, `modelo`, `qtdAssentos`, `temBanheiro`, `temArCondicionado`, `chassis`, `placa`) VALUES ('$marca','$modelo',$qtdAssentos,$temBanheiro,$temArCondicionado,'$chassis','$placa');";

if ($conn->query($sql)) {
    $sucesso = true;
    echo "Registro incluído com sucesso!  ";
    $sql = "select * from `onibus` where placa='$placa'";
    $result = $conn->query($sql);

    $arrOnibus[] = array();
    $i = 0;
    while ($linha = $result->fetch_assoc()) {
        $arrOnibus[$i] = $linha;
        $i++;
    }

    $jOnibus = json_encode($arrOnibus);
    echo $jOnibus;
} else {
    echo "alert('Registro não incluído. Tente novamente.');";
}


?>