<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
</head>

<body id="usuario">
    <div id="content">
        <h1>Usuario</h1>
        <a href="CriarUsuario.php"><button class="button add">Criar</button></a>
        <a href="AlterarUsuario.php"><button class="button add">Alterar</button></a>
		<a href="ListarUsuario.php"><button class="button add">Listar</button></a>
		<a href="ExcluirUsuario.php"><button class="button add">Criar</button></a>
        <table>
            <tr>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Funcao</th>
                <th>Ação</th>
            </tr>
            <?php
            require "ListarTodosUsuarios.php"
            ?>
        </table>
    </div>
</body>
</html>