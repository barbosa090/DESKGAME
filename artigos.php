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
    $sql = "SELECT * FROM artigos WHERE id = :id";
    $stmt = $conexaoPDO->prepare($sql);
    $stmt->execute(['id' => $id_artigo]);
    $artigo_completo = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Busca a lista de todas as postagens para o menu lateral/superior
$sql_lista = "SELECT id, titulo, subtitulo, data_criacao FROM artigos ORDER BY id DESC";
$lista_artigos = $conexaoPDO->query($sql_lista)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Notícias - DESKGAME</title>
    <link rel="stylesheet" href="login.css">
</head>
<body style="background: #0b0c10; font-family: sans-serif; color: #c5c6c7; margin:0; padding:0;">

    <div style="max-width: 1000px; margin: 40px auto; padding: 20px;">
        <h1 style="color: #66fcf1; text-align: center; margin-bottom: 40px;">Portal de Conteúdo DESKGAME</h1>

        <h2 style="color: #fff; border-bottom: 1px solid #2f3b4c; padding-bottom: 10px;">Manchetes Recentes</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <?php if(empty($lista_artigos)): ?>
                <p style="color: #ff3333;">Nenhum artigo publicado no momento.</p>
            <?php else: ?>
                <?php foreach($lista_artigos as $art): ?>
                    <div style="background: #1f2833; padding: 20px; border-radius: 8px; border: 1px solid #2f3b4c; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <span style="color: #66fcf1; font-size: 11px;">📅 <?= date('d/m/Y', strtotime($art['data_criacao'])); ?></span>
                            <h3 style="color: #fff; margin: 10px 0 5px 0;"><?= htmlspecialchars($art['titulo']); ?></h3>
                            <p style="font-size: 13px; color: #c5c6c7; margin-bottom: 15px;"><?= htmlspecialchars($art['subtitulo']); ?></p>
                        </div>
                        <a href="artigo.php?id=<?= $art['id']; ?>" style="display: block; text-align:center; background:#463077; color:#fff; text-decoration:none; padding:10px; border-radius:5px; font-weight:bold; font-size:13px;">Ler Artigo Completo 📖</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($artigo_completo): ?>
                <article style="background: #1f2833; border: 1px solid #66fcf1; padding: 40px; border-radius: 8px; box-shadow: 0 0 20px rgba(102, 252, 241, 0.1);">
                    <h2 style="color: #fff; font-size: 2.2rem; margin: 0 0 10px 0;"><?= htmlspecialchars($artigo_completo['titulo']); ?></h2>
                    <p style="color: #66fcf1; font-size: 1.2rem; margin: 0 0 5px 0; font-style: italic;"><?= htmlspecialchars($artigo_completo['subtitulo']); ?></p>
                    <small style="color: #555;">Por: <strong><?= htmlspecialchars($artigo_completo['autor']); ?></strong> | Postado em: <?= date('d/m/Y H:i', strtotime($artigo_completo['data_criacao'])); ?></small>
                    
                    <hr style="border: 0; border-top: 1px solid #2f3b4c; margin: 25px 0;">
                    
                    <div style="color: #fff; font-size: 1.1rem; line-height: 1.8; white-space: pre-line;">
                        <?= htmlspecialchars($artigo_completo['conteudo']); ?>
                    </div>
                </article>
            <?php else: ?>
                <div style="background: #1f2833; padding: 25px; border-radius: 8px; text-align: center; border: 1px dashed #2f3b4c;">
                    <p style="color: #c5c6c7; margin: 0;">💡 Escolha um dos artigos na lista acima para abrir o leitor de notícias.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>