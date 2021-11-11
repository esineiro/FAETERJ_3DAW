<?php
require "ConfigBanco.php";
$sql = "SELECT * FROM Usuario;";
$sql = $pdo->query($sql);

 if ($sql->rowCount() > 0) {
     echo "<br>
     <table>
          <a href='CriarUsuario.php'><button>Criar</button></a>
          <a href='ListarUsuario.php'><button>Listar um usuário</button></a>
            <tr>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Funcao</th>
                <th>Ação</th>
            </tr>
     ";
    foreach ($sql->fetchAll() as $usuario) {
        echo "<tr>";
        echo "<td>".$usuario['nome']."</td>";
        echo "<td>".$usuario['matricula']."</td>";
        echo "<td>".$usuario['funcao']."</td>";
        echo "<td>
                <a href='AlterarUsuario.php?matricula=".$usuario['matricula']."'><button>Alterar</button></a>
                <a href='ExcluirUsuario.php?matricula=".$usuario['matricula']."'><button>Excluir</button></a>
              </td>
            </tr>";

    }
    echo "</table>
";
 } else echo "<br><a href='CriarUsuario.php'><button>Criar</button></a>
              <br><br>Nenhum usuário cadastrado.";
