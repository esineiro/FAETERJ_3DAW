<?php
require "ConfigBanco.php";
$sql = "SELECT * FROM Usuario;";
$sql = $pdo->query($sql);

 if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $usuario) {
        echo "<tr>";
        echo "<td>".$usuario["nome"]."</td>";
        echo "<td>".$usuario["matricula"]."</td>";
        echo "<td>".$usuario["funcao"]."</td>";
        echo "<td>
                <a href='AlterarUsuario.php?matricula=".$usuario['matricula']."'><button>Alterar</button></a>
                <a href='ExcluirUsuario.php?matricula=".$usuario['matricula']."'><button>Excluir</button></a>
              </td>
            </tr>
            ";
    }
 } else {
     echo "Nenhum usuário cadastrado.";
 }
?>