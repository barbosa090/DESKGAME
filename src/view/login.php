<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

}
    try{
        $stmt = $pdo->prepare("SELECT id, senha FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="" action ="">
    <label for="email">email</label>
    <input type ="text" id="email" name="email"required>
    <label for="senha">senha</label>
    <input type="password" id="senha" name="senha" required>
    <button type="submit">enter </button>
    </form>
</body>
