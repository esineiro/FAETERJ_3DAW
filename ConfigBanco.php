<?php
$dbl = "mysql:dbname=3daw;host=127.0.0.1";
$dbuser = "root";
$dbpass = "";

try {
    $pdo = new PDO($dbl, $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Falha na conexão<br>".$e->getMessage();
}
?>