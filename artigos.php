<?php
// artigo.php (Raiz)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/conexao.php';

$id_artigo = isset($_GET['id']) ? intval($_GET['id']) : null;
$artigo_completo = null;

// Se clicou, busca o artigo específico
if ($id_artigo) {
    $stmt = $pdo->prepare("SELECT * FROM artigos WHERE id = :id");
    $stmt->execute(['id' => $id_artigo]);
    $artigo_completo = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Busca a lista de todas as postagens para o menu lateral/superior
$sql_lista = "SELECT id, titulo, subtitulo, data_criacao FROM artigos ORDER BY id DESC";
$lista_artigos = $pdo->query($sql_lista)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Notícias - DESKGAME</title>
    <link rel="stylesheet" href="artigos.css">
</head>
<body>


    <div class="main-container">
        <?php include 'includes/header.php'; ?>


        <h1 class="portal-title">Portal de Conteúdo DESKGAME</h1>

        <h2 class="section-title">Manchetes Recentes</h2>
        <div class="articles-grid">
            <?php if(empty($lista_artigos)): ?>
                <p class="empty-message">Nenhum artigo publicado no momento.</p>
            <?php else: ?>
                <?php foreach($lista_artigos as $art): ?>
                    <div class="article-card">
                        <div>
                            <span class="card-date">📅 <?= date('d/m/Y', strtotime($art['data_criacao'])); ?></span>
                            <h3 class="card-title"><?= htmlspecialchars($art['titulo']); ?></h3>
                            <p class="card-subtitle"><?= htmlspecialchars($art['subtitulo']); ?></p>
                        </div>
                        <a href="artigos.php?id=<?= $art['id']; ?>" class="card-button">Ler Artigo Completo 📖</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($artigo_completo): ?>
                <article class="full-article">
                    <h2 class="article-main-title"><?= htmlspecialchars($artigo_completo['titulo']); ?></h2>
                    <p class="article-main-subtitle"><?= htmlspecialchars($artigo_completo['subtitulo']); ?></p>
                    <small class="article-meta">Por: <strong><?= htmlspecialchars($artigo_completo['autor']); ?></strong> | Postado em: <?= date('d/m/Y H:i', strtotime($artigo_completo['data_criacao'])); ?></small>
                    
                    <hr class="article-divider">
                    
                    <div class="article-content">
                        <?= htmlspecialchars($artigo_completo['conteudo']); ?>
                    </div>
                </article>
            <?php else: ?>
                <div class="placeholder-box">
                    <p class="placeholder-text">💡 Escolha um dos artigos na lista acima para abrir o leitor de notícias.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>