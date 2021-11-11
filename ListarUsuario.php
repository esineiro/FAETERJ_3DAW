<?php
require "ConfigBanco.php";
$valido = false;
$nome = "";
$matricula = "";
$funcao = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['matricula']) && !empty($_GET['matricula'])) {
        $matricula = addslashes($_GET['matricula']);
        $valido = true;
    }
}
if ($valido) {
    $sql = "SELECT * FROM Usuario WHERE matricula = '$matricula';";
    try {
        $sql = $pdo->query($sql);
        $usuario = $sql->fetch();
        $nome = $usuario['nome'];
        $matricula = $usuario['matricula'];
        $funcao = $usuario['funcao'];

    } catch (\Exception $e) {
        echo "Erro na exibição do usuário!<br>";
        $e->getMessage();
    }

}
echo "
<h1>Usuários</h1>
        <form action='' method=''>
        <h2>Lista Usuário</h2>
        <h3>(informe somente a matrícula)</h3>
            <table>
                <tr>
                    <td style='width: 150px;'>Nome: </td>
                    <td><input type='text' value='$nome'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Matrícula: </td>
                    <td><input type='text' value='$matricula'></'td>
                </tr>
                <tr>
                    <td style='width: 150px;'>Função: </td>
                    <td><input type='text' value='$funcao'></td>
                </tr>
            </table>
            <input type='submit' value='Buscar'>         
        </form>
        <a href='Usuarios.php'><button>Voltar</button></a>";

