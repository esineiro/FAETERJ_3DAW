<?php
require "ConfigBanco.php";

echo "
<form action='' method='post'>
    <table>
        <tr>
            <td style='width: 150px;'>Nome: </td>
            <td><input type='text' name='nome' required></td>
        </tr>    
        <tr>
            <td style='width: 150px;'>Matrícula: </td>
            <td><input type='text' name='matricula' required></td>
        </tr>
        
        <tr>
            <td style='width: 150px;'>Função: </td>
            <td><input type='text' name='funcao' required></td>
        </tr>
    </table>
    <input type='submit' value='Criar'>
    
</form>
<a href='Usuarios.php'><button>Voltar</button></a>
";
$valido = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nome"]) && !empty($_POST["nome"]) &&
        isset($_POST["matricula"]) && !empty($_POST["maticula"]) &&
        isset($_POST["funcao"]) && !empty($_POST["funcao"])
    ) {
        $nome = addslashes(converteMaiusculo($_POST["nome"]));
        $matricula = addslashes(trataString($_POST["matricula"]));
        $funcao = addslashes(converteMaiusculo($_POST["funcao"]));
    }

    if ($valido) {
        $sqlCommand = "SELECT * FROM Usuario WHERE matricula = '$matricula';";
        $sqlCommand = $pdo->query($sqlCommand);
        $continua = false;
        if ($sqlCommand->rowCount() >= 1) {
            echo "Matrícula já cadastrada.";
        } else {
            $continua = true;
        }
        if ($continua) {
            $sqlCommand = "INSERT INTO usuario set nome = '$nome', 
                matricula = '$matricula',
                funcao = '$funcao';";
            try {
                $sql = "START TRANSACTION;";
                $sql = $pdo->query($sql);
                $sqlCommand = $pdo->query($sqlCommand);
                $sql = "COMMIT;";
                $sql = $pdo->query($sql);
                echo "Usuário cadastrado com sucesso.";
            } catch (Exception $e) {
                $sql = "ROLLBACK;";
                $sql = $pdo->query($sql);
                echo "Erro no cadastro<br>";
                $e->getMessage();
            }
        }
    }
}

function trataString($valor)
{
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

function converteMaiusculo($palavra)
{
    return strtr(strtoupper($palavra), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
}
?>