<?php
require_once __DIR__ . '/../config/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Gamer</title>
</head>
<body>
<main>
    <h1>Bem-vindo ao Dashboard Gamer!</h1>
</main>
    
<strong><?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? ''); ?></strong>
 <a href="logout.php" style="color: #030303; margin-left: 0px; text-decoration: none; font-weight: bold;"> Sair da Conta ]</a>
    

 
</body>
</html>