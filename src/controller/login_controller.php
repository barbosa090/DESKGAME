<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

}
    try{
        $stmt= $pdo->prepare("SELECT id, senha FROM usuarios WHERE email = :email");
        $stmt = bindParam(':email',$email);
        $stmt = bindParam(':senha',$senha);
        $stmt = execute(['emal'=> $email,'senha'=>$senha]);
        $usuario=$stmt->fetch();


    }
       ?>