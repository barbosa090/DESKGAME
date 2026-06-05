<?php
<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . "/../controller/LoginController.php";

session_start();


if (isset($_SESSION['usuarios'])) {
    header("Location: login.php");
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
    <link rel="icon" href="favicon.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Upgrade Gaming</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-container">
        <h2 style="color: #706d6d;">Upgrade Gaming</h2>

        <?php if (!empty($mensagemErro)): ?>
            <div class="erro-alerta">
                <?= htmlspecialchars($mensagemErro); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="email">E-mail</label>
            <p><input type="email" name="email" id="email" placeholder="Digite seu e-mail" required></p>
            
            <label for="senha">Senha</label>
            <p><input type="password" name="senha" id="senha" placeholder="Digite sua senha" required></p>
            
            <input type="submit" value="Entrar">
        </form>
    </div>

</body>
</html>
