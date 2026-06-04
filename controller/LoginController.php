<?php
require_once __DIR__ . "/../config/conexao.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt->bindParam(':email', $email);
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);
        $stmt->bindParam(':senha', $senhaSegura);
        $stmt->execute();
        echo "Usuário criado com sucesso!";
    } catch (PDOException $e) { 
        echo "Erro no banco de dados: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erro geral: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
