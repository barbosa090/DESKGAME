<?php

<?php
$servename = "servename";
$username="username";
$password= "password";
$dbase="mydb";

try {
$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "a conexão foi um sucesso.";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

try {
    $sql = "CREATE DATABASE mydb";
    $con->exec($sql);
    echo "database criada com sucesso";
} catch(PDOException $e) {
    echo "erro na criação " . $sql . $e->getMessage();
}



?>
