<?php
$host    = 'localhost';
$db      = 'deskgame';
$usuario = 'root';
$senha   = '';

try {
  $conexaoPDO = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usuario, $senha);
  $conexaoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexaoPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erro ao conectar: " . $e->getMessage());
}

?>
