<?php
require_once __DIR__ . '/config/conexao.php';


// Garante que a variável da mensagem comece vazia
$mensagemErro = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    $emailAdminOficial = "admin@deskgame.com.br";
    $senhaAdminOficial = "SenhaSecreta123"; 

    if ($email === $emailAdminOficial && $senha === $senhaAdminOficial) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['logado'] = true;
        $_SESSION['nome']   = "Administrador Geral";
        $_SESSION['tipo']   = "admin";

        header("Location: admin/index.php");
        exit();
    } else {
        // Se não for o admin, procura o cliente no banco
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['logado'] = true;
            $_SESSION['id']     = $usuario['id'];
            $_SESSION['nome']   = $usuario['nome'];
            $_SESSION['tipo']   = "cliente";

            header("Location: index.php");
            exit();
        } else {
            $mensagemErro = "⚠️ E-mail ou senha inválidos!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DESKGAME</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="body-login"> 
    
    <div class="login-container">
        <h2 style="color: cyan;">DESKGAME</h2>

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