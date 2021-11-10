<?php
require "ConfigBanco.php";
$valido = false;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["matricula"]) && !empty($_GET["matricula"])) {
        $matricula = addslashes($_GET["matricula"]);
        $valido = true;
    }
}

if ($valido) {
    $sql = "SELECT * FROM Usuario WHERE matricula = '$matricula';";
    try {
        $sql = $pdo->query($sql);
        $usuario = $sql->fetch();
        echo "
        <form action='' method=''>
            <table>
                <tr>
                    <td style='width: 150px;'>Nome: </td>
                    <td><input type='text' value='".$usuario['nome']."'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Matrícula: </td>
                    <td><input type='text' value='".$usuario['matricula']."'></'td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Função: </td>
                    <td><input type='text' value='".$usuario['funcao']."'></td>
                </tr>
            </table>
        </form>
        <a href='Usuario.php'><button>Voltar</button></a>";
    } catch (\Exception $e) {
        echo "Erro na exibição do usuário!<br>";
        $e->getMessage();
    }
}
?>