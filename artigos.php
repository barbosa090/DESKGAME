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

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Notícias - DESKGAME</title>
    <link rel="stylesheet" href="artigos.css"> 
    
    <style>
        /* Configurações globais e imagem de fundo */
        body {
            background-image: url('download.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        /* Container principal: centraliza tudo e define uma largura máxima simétrica */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Força um espaçamento entre o menu carregado pelo PHP e o título do portal */
        .header-wrapper {
            margin-bottom: 40px;
        }

        /* Alinhamento e estilo dos títulos centrais */
        .portal-title {
            text-align: center;
            color: #17c5e4;
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            text-align: center;
            font-size: 1.5rem;
            margin-top: 30px;
            margin-bottom: 25px;
            color: #ffffff;
        }

        /* Garante que a grid de artigos fique centralizada e bem distribuída */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Estilo para ajustar mensagens vazias ou caixas de aviso */
        .empty-message, .placeholder-box {
            text-align: center;
            padding: 20px;
            background-color: rgba(29, 36, 45, 0.7);
            border-radius: 8px;
            border: 1px dashed rgba(23, 197, 228, 0.3);
        }
    </style>
</head>
<body>

    <div class="main-container">
        
        <div class="header-wrapper">
            <?php include 'includes/header.php'; ?>
        </div>

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

        <div class="reader-section">
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