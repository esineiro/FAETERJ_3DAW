<?php
require "ConfigBanco.php";
$valido = false;
$matricula = addslashes($_GET['matricula']);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $valido = true;
}

if ($valido) {
    $sql = "SELECT * FROM usuario WHERE matricula = '$matricula';";
    $sql = $pdo->query($sql);
    if ($sql->rowCount() == 1) {
        $usuario = $sql->fetch();
        echo "
        <form action='' method='post'>
            <table>
                <tr>
                    <td style='width: 150px;'>Nome: </td>
                    <td><input type='text' value='".$usuario['nome']."'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Matricula: </td>
                    <td><input type='text' value='".$usuario['matricula']."'></'td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Função: </td>
                    <td><input type='text' value='".$usuario['funcao']."'></td>
                </tr>
            </table>
            <input type='submit' value='Apagar'>
        
        </form>";
    } else {
        echo "Usuário não encontrado.";
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sqlCommand = "DELETE FROM Usuario WHERE matricula = '$matricula';";
    try {
        $sql = "START TRANSACTION;";
        $sql = $pdo->query($sql);
        $sqlCommand = $pdo->query($sqlCommand);
        $sql = "COMMIT;";
        $sql = $pdo->query($sql);
        echo "Usuário excluído com sucesso!";
    } catch (\Exception $e) {
        $sql = "ROLLBACK;";
        $sql = $pdo->query($sql);
        echo "Erro ao apagar o usuário!<br>";

        $e->getMessage();
    }
}
echo "<br><a href='Usuarios.php'><button>Voltar</button></a>";
?>