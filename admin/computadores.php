<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. SEGURANÇA: Centraliza a proteção usando o seu arquivo oficial
require_once '../includes/auth.php'; // Trava de segurança contra invasores
require_once '../config/conexao.php'; // Conexão segura com o banco

$mensagem = ""; // Para exibir alertas de sucesso ou erro na tela

// -------------------------------------------------------------------------
// 1. AÇÃO DE SALVAR OU ATUALIZAR (Seguro contra SQL Injection)
// -------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']);
    $preco    = trim($_POST['preco']);
    $tag_uso  = trim($_POST['tag_uso']);
    $cpu_nome = trim($_POST['cpu_nome']);
    $gpu_nome = trim($_POST['gpu_nome']);
    $id       = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id === 0) {
        // [C]REATE - INSERIR NOVO
        $sql = "INSERT INTO produtos (nome, preco, tag_uso, cpu_nome, gpu_nome, tipo) 
                VALUES (:nome, :preco, :tag_uso, :cpu_nome, :gpu_nome, 'computador')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome'     => $nome,
            'preco'    => $preco,
            'tag_uso'  => $tag_uso,
            'cpu_nome' => $cpu_nome,
            'gpu_nome' => $gpu_nome
        ]);
        $mensagem = "✅ Computador cadastrado com sucesso!";
    } else {
        // [U]PDATE - ATUALIZAR EXISTENTE
        $sql = "UPDATE produtos SET 
                    nome = :nome, preco = :preco, tag_uso = :tag_uso, 
                    cpu_nome = :cpu_nome, gpu_nome = :gpu_nome 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome'     => $nome,
            'preco'    => $preco,
            'tag_uso'  => $tag_uso,
            'cpu_nome' => $cpu_nome,
            'gpu_nome' => $gpu_nome,
            'id'       => $id
        ]);
        $mensagem = "🔄 Ficha técnica atualizada com sucesso!";
    }
}

// -------------------------------------------------------------------------
// 2. AÇÃO DE DELETAR (Seguro usando prepare e intval)
// -------------------------------------------------------------------------
if (isset($_GET['deletar_id'])) {
    // Força o ID a ser estritamente um número inteiro, bloqueando trapaças na URL
    $id_para_deletar = intval($_GET['deletar_id']);
    
    $sql_delete = "DELETE FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute(['id' => $id_para_deletar]);
    
    header("Location: computadores.php?sucesso=deletado");
    exit();
}

// 3. CORREÇÃO DE SEGURANÇA (XSS): Evita injeção de códigos pela URL
if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'deletado') {
    $mensagem = "❌ Computador removido do catálogo.";
}

// -------------------------------------------------------------------------
// 3. READ - LISTAR TODOS (Seguro, pois não depende de dados digitados pelo usuário)
// -------------------------------------------------------------------------
$sql_todos = "SELECT * FROM produtos WHERE tipo = 'computador' ORDER BY id DESC";
$stmt_todos = $pdo->query($sql_todos);
$computadores = $stmt_todos->fetchAll(PDO::FETCH_ASSOC);

// -------------------------------------------------------------------------
// 4. CAPTURAR O PC ESCOLHIDO (Seguro usando prepare)
// -------------------------------------------------------------------------
$id_escolhido = isset($_GET['id']) ? intval($_GET['id']) : null;
$id_editar    = isset($_GET['editar']) ? intval($_GET['editar']) : null;
$pc_detalhe   = null;
$modo_edicao  = false;

if ($id_escolhido) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id AND tipo = 'computador'");
    $stmt->execute(['id' => $id_escolhido]);
    $pc_detalhe = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($id_editar) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id AND tipo = 'computador'");
    $stmt->execute(['id' => $id_editar]);
    $pc_detalhe = $stmt->fetch(PDO::FETCH_ASSOC);
    $modo_edicao = true; 
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Computadores</title>
    <link rel="stylesheet" href="../computadores.css">
    <style>
        .grid-admin { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px; }
        .lista-painel { list-style: none; padding: 0; }
        .lista-painel li { background: #1f2833; padding: 12px; margin-bottom: 10px; border-radius: 4px; display: flex; justify-content: space-between; border: 1px solid #2d3745; }
        .form-adm { background: #1f2833; padding: 25px; border-radius: 8px; border: 1px solid #2d3745; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; color: #66fcf1; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; background: #0b0c10; border: 1px solid #2d3745; color: #fff; border-radius: 4px; }
        .btn-salvar { background: #66fcf1; color: #0b0c10; border: none; padding: 12px; font-weight: bold; width: 100%; border-radius: 4px; cursor: pointer; text-transform: uppercase; }
        .alert-msg { background: #463077; color: #66fcf1; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <header class="gamer-header">
            <h1 class="logo-txt">🖥️ DESKGAME ADMIN</h1>
            <nav class="gamer-nav">
                <a href="index.php" class="nav-link">Dashboard</a>
                <a href="computadores.php" class="nav-link active">Gerenciar PCs</a>
                <a href="notebooks.php" class="nav-link">Gerenciar Notes</a>
            </nav>
        </header>

        <main style="text-align: left; margin-top: 40px; padding: 0 20px;">
            
            <?php if (!empty($mensagem)): ?>
                <div class="alert-msg"><?= $mensagem; ?></div>
            <?php endif; ?>

            <div class="grid-admin">
                
                <div>
                    <h2 style="color: #fff; margin-bottom: 15px;">Banco de Computadores</h2>
                    <a href="computadores.php" style="color: #66fcf1; text-decoration: none; font-weight: bold; display: block; margin-bottom: 15px;">[+] Resetar para Cadastrar Novo PC</a>
                    
                    <ul class="lista-painel">
                        <?php foreach($computadores as $pc): ?>
                            <li>
                                <span style="color: #fff; font-weight: bold;"><?= htmlspecialchars($pc['nome']); ?></span>
                                <div>
                                    <a href="computadores.php?id=<?= $pc['id']; ?>" style="color: #66fcf1; text-decoration: none; margin-right: 10px;">🔎 Ver</a>
                                    <a href="computadores.php?editar=<?= $pc['id']; ?>" style="color: #ffca28; text-decoration: none; margin-right: 10px;">⚙️ Editar</a>
                                    <a href="computadores.php?deletar_id=<?= $pc['id']; ?>" style="color: #ff3333; text-decoration: none;" onclick="return confirm('Deletar agora?')">❌ Apagar</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <?php if ($modo_edicao && $pc_detalhe): ?>
                        <h2 style="color: #ffca28; margin-bottom: 15px;">Editar: <?= htmlspecialchars($pc_detalhe['nome']); ?></h2>
                        <form method="POST" class="form-adm">
                            <input type="hidden" name="id" value="<?= $pc_detalhe['id']; ?>">
                            
                            <div class="form-group">
                                <label>Nome do Computador</label>
                                <input type="text" name="nome" value="<?= htmlspecialchars($pc_detalhe['nome']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Preço (R$)</label>
                                <input type="number" step="0.01" name="preco" value="<?= $pc_detalhe['preco']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Tag de Uso</label>
                                <input type="text" name="tag_uso" value="<?= htmlspecialchars($pc_detalhe['tag_uso']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Modelo CPU</label>
                                <input type="text" name="cpu_nome" value="<?= htmlspecialchars($pc_detalhe['cpu_nome']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Modelo GPU</label>
                                <input type="text" name="gpu_nome" value="<?= htmlspecialchars($pc_detalhe['gpu_nome']); ?>">
                            </div>
                            <button type="submit" class="btn-salvar" style="background: #ffca28;">Atualizar Dados</button>
                        </form>

                    <?php elseif (!$modo_edicao && $pc_detalhe): ?>
                        <h2 style="color: #66fcf1; margin-bottom: 15px;">Inspeção do Registro</h2>
                        <div style="background: #1f2833; padding: 20px; border-radius: 8px; border: 1px solid #66fcf1;">
                            <h3 style="color:#fff;"><?= htmlspecialchars($pc_detalhe['nome']); ?></h3>
                            <p style="color:#66fcf1; font-weight:bold; margin-top:5px;">R$ <?= number_format($pc_detalhe['preco'], 2, ',', '.'); ?></p>
                            <hr style="border-color:#2d3745; margin: 15px 0;">
                            <p style="color:#c5c6c7;"><strong>Tag:</strong> <?= htmlspecialchars($pc_detalhe['tag_uso']); ?></p>
                            <p style="color:#c5c6c7; margin-top:5px;"><strong>Processador:</strong> <?= htmlspecialchars($pc_detalhe['cpu_nome']); ?></p>
                            <p style="color:#c5c6c7; margin-top:5px;"><strong>Placa de Vídeo:</strong> <?= htmlspecialchars($pc_detalhe['gpu_nome']); ?></p>
                            
                            <div style="margin-top: 20px;">
                                <a href="computadores.php?editar=<?= $pc_detalhe['id']; ?>" style="background:#ffca28; color:#0b0c10; padding:8px 15px; text-decoration:none; font-weight:bold; border-radius:4px;">Ir para Edição</a>
                            </div>
                        </div>

                    <?php else: ?>
                        <h2 style="color: #66fcf1; margin-bottom: 15px;">Cadastrar Novo Computador</h2>
                        <form method="POST" class="form-adm">
                            <input type="hidden" name="id" value="0">
                            
                            <div class="form-group">
                                <label>Nome do Computador</label>
                                <input type="text" name="nome" placeholder="Ex: PC Gamer Ares" required>
                            </div>
                            <div class="form-group">
                                <label>Preço (R$)</label>
                                <input type="number" step="0.01" name="preco" placeholder="Ex: 4500.00" required>
                            </div>
                            <div class="form-group">
                                <label>Tag de Uso</label>
                                <input type="text" name="tag_uso" placeholder="Ex: JOGOS COMPETITIVOS">
                            </div>
                            <div class="form-group">
                                <label>Modelo CPU</label>
                                <input type="text" name="cpu_nome" placeholder="Ex: Intel i5 13400F">
                            </div>
                            <div class="form-group">
                                <label>Modelo GPU</label>
                                <input type="text" name="gpu_nome" placeholder="Ex: RTX 3060">
                            </div>
                            <button type="submit" class="btn-salvar">Salvar no Banco</button>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </main>

        <?php include '../includes/footer.php'; ?>
    </div>

</body>