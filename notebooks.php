
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
    <title>Notebooks - DESKGAME</title>
    <link rel="stylesheet" href="computadores.css">
</head>
<body>

    <div class="main-wrapper">
        
        <?php include 'includes/header.php'; ?>

        <main class="gamer-main" style="margin-bottom: 40px; padding: 0;">
            <h1 class="titulo-secao">Análise de Notebooks</h1>
            <p class="subtitulo-secao">Portabilidade sem abrir mão do desempenho. Conheça o nível do hardware móvel.</p>
        </main>

        <div class="analise-grid-horizontal">

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=400&q=80" alt="Notebook Apex">
                </div>
                <div class="info-tecnica-mini">
                    <span class="tag-uso">🚀 GAMER PORTÁTIL</span>
                    <h2>Notebook Apex Nitro v15</h2>
                    <div class="preco-mini">R$ 5.899,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ i5-13420H</span><span class="badge-nivel nivel-intermediario">Intermediário</span></div>
                        <p class="explicao-peca">Linha 'H' de alto desempenho. Perfeito para jogos, mas consome mais bateria.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 RTX 4050 Laptop</span><span class="badge-nivel nivel-intermediario">Geração Atual</span></div>
                        <p class="explicao-peca">Roda lançamentos atuais no médio/alto com o auxílio do DLSS 3.</p>
                    </div>
                </div>
            </section>

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=400&q=80" alt="Notebook Stealth">
                </div>
                <div class="info-tecnica-mini">
                    <span class="tag-uso" style="background-color: #2b1a4a; color: #cda9ff; border-color: #463077;">💼 ULTRABOOK PREMIUM</span>
                    <h2>Notebook Stealth Book</h2>
                    <div class="preco-mini" style="color: #cda9ff;">R$ 7.200,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ Core Ultra 7</span><span class="badge-nivel nivel-topo">Topo de Linha</span></div>
                        <p class="explicao-peca">Foco em Inteligência Artificial e altíssima eficiência de bateria (até 12h).</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 Intel Arc Graphics</span><span class="badge-nivel nivel-intermediario">Integrada</span></div>
                        <p class="explicao-peca">Aguenta edições de vídeo leves e jogos casuais perfeitamente.</p>
                    </div>
                </div>
            </section>

        </div>

        <?php include 'includes/footer.php'; ?>

    </div>

</body>
</html>
