<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise Técnica - PC Gamer Ares Core - DESKGAME</title>
    <link rel="stylesheet" href="computadores.css">
    </head>
<body>

    <div class="main-wrapper">
        <header class="gamer-header">
            <h1 class="logo-txt">🖥️DESKGAME</h1>
            <nav class="gamer-nav">
                <a href="index.php" class="nav-link">INÍCIO</a>
                <a href="computadores.php" class="nav-link active">Computadores</a>
                <a href="notebooks.php" class="nav-link">NOTEBOOK</a>
            </nav>
            <div class="header-right">
                <div class="user-info">
                    <span>Catálogo de Fotos</span>
                </div>
            </div>
            <div class="header-right">
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                    <div class="user-info">
                        <span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']); ?></span>
                    </div>
                    
                <?php else: ?>
                    <a href="login.php" class="btn-logout">Sair</a>
                <?php endif; ?>
            </div>
        </header>

       <main class="gamer-main" style="margin-bottom: 40px; padding: 0;">
            <h1 class="titulo-secao">Análise de setups</h1>
            <p class="subtitulo-secao">Entenda o nível real e o objetivo de cada máquina do laboratório</p>
        </main>

        <div class="analise-grid-horizontal">

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="https://cdn.dooca.store/1841/products/cubo-grande-preto-completo-2_620x620+fill_ffffff.jpg?v=1751486233" alt="PC Ares">
                </div>

                <div class="info-tecnica-mini">
                    <span class="tag-uso">🔥 COMPETITIVOS</span>
                    <h2>PC Gamer Ares Core</h2>
                    <div class="preco-mini">R$ 4.599,90</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ i5 13400F</span><span class="badge-nivel nivel-intermediario">Intermediário</span></div>
                        <p class="explicao-peca">Excelente estabilidade de frames, evitando aquelas travadas chatas na gameplay.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 RTX 3060 12GB</span><span class="badge-nivel nivel-intermediario">Intermediário</span></div>
                        <p class="explicao-peca">Muita memória de vídeo para carregar mapas gigantes sem perder rendimento.</p>
                    </div>
                </div>
            </section>

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="https://down-br.img.susercontent.com/file/br-11134207-81z1k-mhlyp577kgld3f@resize_w450_nl.webp" alt="PC Chronos">
                </div>

                <div class="info-tecnica-mini">
                    <span class="tag-uso" style="background-color: #2b1a4a; color: #cda9ff; border-color: #463077;">🚀 DESEMPENHO EXTREMO</span>
                    <h2>PC Titan Chronos X</h2>
                    <div class="preco-mini" style="color: #cda9ff;">R$ 8.999,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ Ryzen 7 7800X3D</span><span class="badge-nivel nivel-topo">Topo de Linha</span></div>
                        <p class="explicao-peca">O melhor processador do mundo para jogos hoje devido à tecnologia cache 3D.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 RTX 4070 Super</span><span class="badge-nivel nivel-topo">Premium</span></div>
                        <p class="explicao-peca">Suporta DLSS 3.0 com geração de quadros por IA, duplicando o desempenho nativo.</p>
                    </div>
                </div>
            </section>

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="data:image/jpeg;base64,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" alt="PC Spark">
                </div>

                <div class="info-tecnica-mini">
                    <span class="tag-uso" style="background-color: #222; color: #b0b5c0; border-color: #3a3f47;">💼 CUSTO-BENEFÍCIO</span>
                    <h2>PC Home Spark Slim</h2>
                    <div class="preco-mini" style="color: #ffffff;">R$ 2.199,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ Ryzen 5 5600G</span><span class="badge-nivel nivel-entrada">Entrada</span></div>
                        <p class="explicao-peca">Gráficos integrados Vega 7. Dispensa placa de vídeo para tarefas cotidianas e jogos leves.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🧠 16GB RAM DDR4</span><span class="badge-nivel nivel-entrada">Padrão</span></div>
                        <p class="explicao-peca">Garante que o computador abra dezenas de abas no navegador sem engasgar.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>

</body>
</html>