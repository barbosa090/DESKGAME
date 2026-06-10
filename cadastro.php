<?php
require_once __DIR__ . '/config/conexao.php';
$msg = "";
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $nome = trim($_POST['nome']);
 $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
 $senha = $_POST['senha'];
 if(!empty($nome) && !empty($email) && !empty($senha)) {
    $msg = "Por favor, preencha todos os campos!";
    $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

    try{
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha_segura]);
       $msg = "faça login para acessar sua conta!";
       $sucesso = true;
    } catch (PDOException $e) {
        $msg = "esse e-mail já está cadastrado!";

    }
 } else {
        $msg = "Por favor, preencha todos os campos!";
    }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - DESKGAME</title>
    <link rel="stylesheet" href="cadastro.css">
  
</head>
<body>
    <div class="login-container">
        <h2 style="color: #17c5e4;">Criar Conta</h2>

        <?php if (!empty($msg)): ?>
            <div class="erro-alerta">
                <?= htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="nome">Nome</label>
            <p><input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required></p>

            <label for="email">E-mail</label>
            <p><input type="email" name="email" id="email" placeholder="Digite seu e-mail" required></p>
            
            <label for="senha">Senha</label>
            <p><input type="password" name="senha" id="senha" placeholder="Crie uma senha forte" required></p>
            
            <input type="submit" value="Cadastrar e Entrar">
        </form>

        <a href="login.php" class="login-link">Já tenho uma conta. Fazer Login</a>
    </div>

</body>
</html>