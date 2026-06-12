<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// SEGURANÇA: Trava de segurança e Conexão com o banco
require_once '../includes/auth.php'; 
require_once '../config/conexao.php'; 

$mensagem = ""; // Para exibir alertas na tela

// -------------------------------------------------------------------------
// 1. AÇÃO DE SALVAR OU ATUALIZAR (Disparada pelo formulário POST)
// -------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']);
    $preco    = trim($_POST['preco']);
    $tag_uso  = trim($_POST['tag_uso']);
    $cpu_nome = trim($_POST['cpu_nome']);
    $gpu_nome = trim($_POST['gpu_nome']);
    
    // Descobre se é um Notebook novo (0) ou uma Edição (> 0)
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id === 0) {
        // [C]REATE - INSERIR NOVO NOTEBOOK (Repare o 'notebook' no final)
        $sql = "INSERT INTO produtos (nome, preco, tag_uso, cpu_nome, gpu_nome, tipo) 
                VALUES (:nome, :preco, :tag_uso, :cpu_nome, :gpu_nome, 'notebook')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome'     => $nome,
            'preco'    => $preco,
            'tag_uso'  => $tag_uso,
            'cpu_nome' => $cpu_nome,
            'gpu_nome' => $gpu_nome
        ]);
        $mensagem = "✅ Notebook cadastrado com sucesso!";
    } else {
        // [U]PDATE - ATUALIZAR EXISTENTE
        $sql = "UPDATE produtos SET 
                    nome = :nome, preco = :preco, tag_uso = :tag_uso, 
                    cpu_nome = :cpu_nome, gpu_nome = :gpu_nome 
                WHERE id = :id AND tipo = 'notebooks'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome'     => $nome,
            'preco'    => $preco,
            'tag_uso'  => $tag_uso,
            'cpu_nome' => $cpu_nome,
            'gpu_nome' => $gpu_nome,
            'id'       => $id
        ]);
        $mensagem = "🔄 Ficha técnica do notebook atualizada!";
    }
}

// -------------------------------------------------------------------------
// 2. AÇÃO DE DELETAR (Disparada pelo link ?deletar_id=X)
// -------------------------------------------------------------------------
if (isset($_GET['deletar_id'])) {
    $id_para_deletar = intval($_GET['deletar_id']);
    
    // Deleta apenas se for do tipo notebook por segurança
    $sql_delete = "DELETE FROM produtos WHERE id = :id AND tipo = 'notebooks'";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute(['id' => $id_para_deletar]);
    
    header("Location: notebook.php?sucesso=deletado");
    exit();
}

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'deletado') {
    $mensagem = "❌ Notebook removido do catálogo.";
}

// -------------------------------------------------------------------------
// 3. READ - BUSCAR APENAS NOTEBOOKS PARA A LISTA DA ESQUERDA
// -------------------------------------------------------------------------
$sql_todos = "SELECT * FROM produtos WHERE tipo = 'notebooks' ORDER BY id DESC";
$stmt_todos = $pdo->query($sql_todos);
$notebooks = $stmt_todos->fetchAll(PDO::FETCH_ASSOC);

// -------------------------------------------------------------------------
// 4. CAPTURAR O NOTEBOOK ESCOLHIDO PARA EDIÇÃO/INSPEÇÃO
// -------------------------------------------------------------------------
$id_escolhido = isset($_GET['id']) ? intval($_GET['id']) : null;
$id_editar    = isset($_GET['editar']) ? intval($_GET['editar']) : null;
$note_detalhe = null;
$modo_edicao  = false;

if ($id_escolhido) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id AND tipo = 'notebooks'");
    $stmt->execute(['id' => $id_escolhido]);
    $note_detalhe = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($id_editar) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id AND tipo = 'notebooks'");
    $stmt->execute(['id' => $id_editar]);
    $note_detalhe = $stmt->fetch(PDO::FETCH_ASSOC);
    $modo_edicao = true; 
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Notebooks</title>
    <link rel="stylesheet" href="notebooks.css">
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
                <a href="computadores.php" class="nav-link">Gerenciar PCs</a>
                <a href="notebook.php" class="nav-link active">Gerenciar Notes</a>
            </nav>
        </header>

        <main style="text-align: left; margin-top: 40px; padding: 0 20px;">
            
            <?php if (!empty($mensagem)): ?>
                <div class="alert-msg"><?= $mensagem; ?></div>
            <?php endif; ?>

            <div class="grid-admin">
                
                <div>
                    <h2 style="color: #fff; margin-bottom: 15px;">Banco de Notebooks</h2>
                    <a href="notebook.php" style="color: #66fcf1; text-decoration: none; font-weight: bold; display: block; margin-bottom: 15px;">[+] Resetar para Cadastrar Novo Notebook</a>
                    
                    <ul class="lista-painel">
                        <?php foreach($notebooks as $note): ?>
                            <li>
                                <span style="color: #fff; font-weight: bold;"><?= htmlspecialchars($note['nome']); ?></span>
                                <div>
                                    <a href="notebook.php?id=<?= $note['id']; ?>" style="color: #66fcf1; text-decoration: none; margin-right: 10px;">🔎 Ver</a>
                                    <a href="notebook.php?editar=<?= $note['id']; ?>" style="color: #ffca28; text-decoration: none; margin-right: 10px;">⚙️ Editar</a>
                                    <a href="notebook.php?deletar_id=<?= $note['id']; ?>" style="color: #ff3333; text-decoration: none;" onclick="return confirm('Deletar esse notebook?')">❌ Apagar</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <?php if ($modo_edicao && $note_detalhe): ?>
                        <h2 style="color: #ffca28; margin-bottom: 15px;">Editar: <?= htmlspecialchars($note_detalhe['nome']); ?></h2>
                        <form method="POST" class="form-adm">
                            <input type="hidden" name="id" value="<?= $note_detalhe['id']; ?>">
                            
                            <div class="form-group">
                                <label>Nome do Notebook</label>
                                <input type="text" name="nome" value="<?= htmlspecialchars($note_detalhe['nome']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Preço (R$)</label>
                                <input type="number" step="0.01" name="preco" value="<?= $note_detalhe['preco']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Tag (Ex: GAMER PORTÁTIL)</label>
                                <input type="text" name="tag_uso" value="<?= htmlspecialchars($note_detalhe['tag_uso']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Modelo Processador</label>
                                <input type="text" name="cpu_nome" value="<?= htmlspecialchars($note_detalhe['cpu_nome']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Modelo Placa de Vídeo</label>
                                <input type="text" name="gpu_nome" value="<?= htmlspecialchars($note_detalhe['gpu_nome']); ?>">
                            </div>
                            <button type="submit" class="btn-salvar" style="background: #ffca28;">Atualizar Notebook</button>
                        </form>

                    <?php elseif (!$modo_edicao && $note_detalhe): ?>
                        <h2 style="color: #66fcf1; margin-bottom: 15px;">Inspeção do Notebook</h2>
                        <div style="background: #1f2833; padding: 20px; border-radius: 8px; border: 1px solid #66fcf1;">
                            <h3 style="color:#fff;"><?= htmlspecialchars($note_detalhe['nome']); ?></h3>
                            <p style="color:#66fcf1; font-weight:bold; margin-top:5px;">R$ <?= number_format($note_detalhe['preco'], 2, ',', '.'); ?></p>
                            <hr style="border-color:#2d3745; margin: 15px 0;">
                            <p style="color:#c5c6c7;"><strong>Tag:</strong> <?= htmlspecialchars($note_detalhe['tag_uso']); ?></p>
                            <p style="color:#c5c6c7; margin-top:5px;"><strong>Processador:</strong> <?= htmlspecialchars($note_detalhe['cpu_nome']); ?></p>
                            <p style="color:#c5c6c7; margin-top:5px;"><strong>Placa de Vídeo:</strong> <?= htmlspecialchars($note_detalhe['gpu_nome']); ?></p>
                            
                            <div style="margin-top: 20px;">
                                <a href="notebook.php?editar=<?= $note_detalhe['id']; ?>" style="background:#ffca28; color:#0b0c10; padding:8px 15px; text-decoration:none; font-weight:bold; border-radius:4px;">Ir para Edição</a>
                            </div>
                        </div>

                    <?php else: ?>
                        <h2 style="color: #66fcf1; margin-bottom: 15px;">Cadastrar Novo Notebook</h2>
                        <form method="POST" class="form-adm">
                            <input type="hidden" name="id" value="0">
                            
                            <div class="form-group">
                                <label>Nome do Notebook</label>
                                <input type="text" name="nome" placeholder="Ex: Notebook Apex Nitro v15" required>
                            </div>
                            <div class="form-group">
                                <label>Preço (R$)</label>
                                <input type="number" step="0.01" name="preco" placeholder="Ex: 5899.00" required>
                            </div>
                            <div class="form-group">
                                <label>Tag de Uso</label>
                                <input type="text" name="tag_uso" placeholder="Ex: ULTRABOOK PREMIUM">
                            </div>
                            <div class="form-group">
                                <label>Modelo CPU</label>
                                <input type="text" name="cpu_nome" placeholder="Ex: Intel Core i5-13420H">
                            </div>
                            <div class="form-group">
                                <label>Modelo GPU</label>
                                <input type="text" name="gpu_nome" placeholder="Ex: RTX 4050 Laptop">
                            </div>
                            <button type="submit" class="btn-salvar">Salvar Notebook</button>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </main>

        <?php include '../includes/footer.php'; ?>
    </div>

</body>
</html>