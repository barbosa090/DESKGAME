<?php
// Carrega variáveis do arquivo .env
$env_file = __DIR__ . '/../.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

$host    = $_ENV['DB_HOST'] ?? 'db';
$db      = $_ENV['DB_NAME'] ?? 'deskgame';
$usuario = $_ENV['DB_USER'] ?? 'root';
$senha   = $_ENV['DB_PASSWORD'] ?? 'root';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usuario, $senha);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erro ao conectar: " . $e->getMessage());
}

?>
