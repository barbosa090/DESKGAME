<?php
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . "/controller/LoginController.php";

session_start();

// Proteção contra loop: se já logou, vai para a index
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    $loginController = new LoginController($pdo);
    $resultado = $loginController->autenticar($email, $senha);
    
    if ($resultado === true) {
        header("Location: index.php");
        exit;
    } else {
        $mensagemErro = $resultado;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Upgrade Gaming</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="body-login"> <div class="login-container">
        <h2>Upgrade Gaming</h2>

        <?php if (!empty($mensagemErro)): ?>
            <div class="erro-alerta">
                <?= htmlspecialchars($mensagemErro); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required autocomplete="email">
            
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            
            <input type="submit" value="Entrar">
        </form>
    </div>

</body>
</html>