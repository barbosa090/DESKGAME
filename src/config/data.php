<?php


$servername = "localhost"; // Corrigido o nome da variável e o valor comum
$username = "username";
$password = "password";

try {
    // Conecta apenas ao servidor MySQL, sem especificar banco de dados ainda
    $con = new PDO("mysql:host=$servername", $username, $password,);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "A conexão ao servidor foi um sucesso.<br>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Para a execução se a conexão falhar
}

try {
    $sql = "CREATE DATABASE mydb";
    $con->exec($sql);
    echo "Database criada com sucesso!<br>";
} catch(PDOException $e) {
    // Removida a variável $sql do echo para evitar erros de escopo
    echo "Erro na criação do banco de dados: " . $e->getMessage();


    }


?>
