<?php
require "ConfigBanco.php";
$valido = false;
$altera = false;
$continua = false;
$matricula = addslashes($_GET['matricula']);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $valido = true;
}

if ($valido) {
    $sql = "SELECT * FROM Usuario WHERE matricula = '$matricula';";
    $sql = $pdo->query($sql);
    if ($sql->rowCount() == 1) {
        $usuario = $sql->fetch();
        echo "
       <h1>Usuários</h1>
        <h2>Altera Usuário</h2>
        <form action='' method='post'>
            <table>
                <tr>
                    <td style='width: 150px;'>Nome: </td>
                    <td><input type='text' name='nome' value='".$usuario['nome']."' required></td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Matrícula: </td>
                    <td><input type='text' name='matricula' value='".$usuario['matricula']."' required></'td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Função: </td>
                    <td><input type='text' name='funcao' value='".$usuario['funcao']."' required></td>
                </tr>
            </table>
            <input type='submit' value='Alterar'>
        
        </form>";
    } else {
        echo "Usuário não encontrado.";
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nome"]) && !empty($_POST["nome"]) &&
        isset($_POST["matricula"]) && !empty($_POST["matricula"]) &&
        isset($_POST["funcao"]) && !empty($_POST["funcao"])
    ) {
        $nome = addslashes(converteMaiusculo($_POST["nome"]));
        $matricula = addslashes(trataString($_POST["matricula"]));
        $funcao = addslashes(converteMaiusculo($_POST["funcao"]));
        $altera = true;
    }
    
}

if ($altera) {
    $sqlCommand = "SELECT * FROM Usuario WHERE matricula = '$matricula';";
    $sqlCommand = $pdo->query($sqlCommand);
    $continua = true;
    if ($sqlCommand->rowCount() >= 1) {
        foreach($sqlCommand->fetchAll() as $usuario){
            if ($usuario['matricula'] != $matricula){
                echo "Usuário não cadastrado no sistema!";
                $continua = false;
            }
        }
    } else {
        $continua = true;
    }
    if ($continua) {
        $sqlCommand = "UPDATE Usuario set nome = '$nome', 
            matricula = '$matricula',
            funcao = '$funcao'
        WHERE matricula = '$matricula';";
        try {
            $sql = "START TRANSACTION;";
            $sql = $pdo->query($sql);
            $sqlCommand = $pdo->query($sqlCommand);
            $sql = "COMMIT;";
            $sql = $pdo->query($sql);
            echo "Usuário alterado com sucesso!";
        } catch (Exception $e) {
            $sql = "ROLLBACK;";
            $sql = $pdo->query($sql);
            echo "Erro na alteração do usuário!<br>";
            $e->getMessage();
        }
    }
}

function trataString($valor) {
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("+", "", $valor);
    $valor = str_replace(" ", "", $valor);
    $valor = str_replace("_", "", $valor);
    return $valor;
}

function converteMaiusculo($palavra) {
    return strtr(strtoupper($palavra), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
}
echo "<br><a href='Usuarios.php'><button>Voltar</button></a>";
?>