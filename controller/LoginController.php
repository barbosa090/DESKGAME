<?php
require_once __DIR__ . "/../config/conexao.php";
function autenticarUsuario($pdo, $email, $senha) {
    if (empty($email) || empty($senha)) {
        return "Por favor, preencha todos os campos.";
    }
    try {
     $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
     $stmt->bindParam(':email', $email); 
    $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bindParam(':senha', $senhaSegura);
        $stmt->execute();
    return true;
    } catch (PDOException $e) {
        return "Erro no banco de dados: " . $e->getMessage();
    } catch (Exception $e) {
        return "Erro geral: " . $e->getMessage();
    }
}
?>
