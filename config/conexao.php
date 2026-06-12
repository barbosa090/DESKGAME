<?php
// se precisar no host aponta exatamente para o nome do serviço do banco de dados que está no seu docker-compose.yml
// e coloco "db"no $host
$host    = 'localhost';
$db      = 'deskgame';
$usuario = 'root';
$senha   = 'root';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usuario, $senha);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erro ao conectar: " . $e->getMessage());
}

?>
