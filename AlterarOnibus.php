<?php

$alterar = $_GET["alterar"];
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
} else {
    if ($alterar!=1) {
        $sql = "SELECT * FROM `onibus` WHERE placa='$placa'";
        $result = $conn->query($sql);
        $arrOnibus[] = array();
        $i = 0;
        while ($linha = $result->fetch_assoc()) {
            $arrOnibus[$i] = $linha;
            $i++;
        }
        if ($i == 0) {
            echo "Ônibus não localizado na base.";
        } else {
            echo json_encode($arrOnibus, JSON_UNESCAPED_UNICODE);
        }
    } else {

        $sql = "update `onibus` set marca='$marca', modelo='$modelo', qtdAssentos=$qtdAssentos, temBanheiro=$temBanheiro, temArCondicionado=$temArCondicionado, chassis='$chassis', placa='$placa' where id = $id;";
        if ($conn->query($sql)) {
            $sucesso = true;
            echo "Registro alterado com sucesso!  ";
            header("Location: ListarOnibus.html");
            die();
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
            echo "Registro não alterado. Tente novamente.";
        }
    }
}
