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
    <title>Análise de Notebooks - DESKGAME</title>
    <link rel="stylesheet" href="computadores.css">
</head>
<body>
    <div class="main-wrapper">
        
        <header class="gamer-header">
            <h1 class="logo-txt">🖥️ DESKGAME</h1>
            
            <nav class="gamer-nav">
                <a href="index.php" class="nav-link active">Início</a>
                <a href="computadores.php" class="nav-link">Computadores</a>
                <a href="notebooks.php" class="nav-link">Notebooks</a>
            </nav>

            <div class="header-right">
                <div class="user-info">
                    <span>Catálogo de Fotos</span>
                </div>
                <a href="cadastro.php" class="btn-logout">Sair</a>
            </div>
        </header>
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
                        <div class="componente-topo"><span class="nome-peca">⚡ i5-13420H (Mobile)</span><span class="badge-nivel nivel-intermediario">Intermediário</span></div>
                        <p class="explicao-peca">A linha 'H' indica alto desempenho para notebooks. Perfeito para jogos e programas pesados, mas consome mais bateria.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 RTX 4050 Laptop</span><span class="badge-nivel nivel-intermediario">Geração Atual</span></div>
                        <p class="explicao-peca">Versão portátil da RTX. Roda lançamentos atuais no médio/alto com o auxílio do DLSS 3 Frame Generation.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">📺 Tela 144Hz IPS</span><span class="badge-nivel nivel-topo">Fluidez Alta</span></div>
                        <p class="explicao-peca">Painel IPS com cores vivas e taxa de atualização ideal para eliminar rastros em jogos de tiro rápidos.</p>
                    </div>
                </div>
            </section>

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=400&q=80" alt="Notebook Stealth">
                </div>

                <div class="info-tecnica-mini">
                    <span class="tag-uso" style="background-color: #2b1a4a; color: #cda9ff; border-color: #463077;">💼 ULTRABOOK PREMIUM</span>
                    <h2>Notebook Stealth Book Ultra</h2>
                    <div class="preco-mini" style="color: #cda9ff;">R$ 7.200,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ Intel Core Ultra 7</span><span class="badge-nivel nivel-topo">Topo de Linha</span></div>
                        <p class="explicao-peca">Nova arquitetura com foco em Inteligência Artificial local e altíssima eficiência energética (bateria dura até 12h).</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🎮 Intel Arc Graphics</span><span class="badge-nivel nivel-intermediario">Vídeo Integrado</span></div>
                        <p class="explicao-peca">Muito superior às placas integradas antigas. Aguenta edições de vídeo leves e jogos casuais perfeitamente.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🪶 Chassi em Alumínio</span><span class="badge-nivel nivel-topo">Ultra Leve</span></div>
                        <p class="explicao-peca">Pesa apenas 1.2kg e tem espessura de 14mm. Feito sob medida para transporte diário em mochilas.</p>
                    </div>
                </div>
            </section>

            <section class="card-analise">
                <div class="visual-pc-mini">
                    <img src="data:image/jpeg;base64,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" alt="Notebook Eco">
                </div>

                <div class="info-tecnica-mini">
                    <span class="tag-uso" style="background-color: #222; color: #b0b5c0; border-color: #3a3f47;">📖 ESTUDOS & DIA A DIA</span>
                    <h2>Notebook Eco Slate 15</h2>
                    <div class="preco-mini" style="color: #ffffff;">R$ 2.699,00</div>

                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">⚡ Ryzen 5 5500U</span><span class="badge-nivel nivel-entrada">Excelente Custo</span></div>
                        <p class="explicao-peca">A linha 'U' foca no baixo consumo de energia. É um processador frio que faz o notebook trabalhar em silêncio.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">🧠 8GB RAM (Expansível)</span><span class="badge-nivel nivel-entrada">Básico Justo</span></div>
                        <p class="explicao-peca">Suficiente para abrir PDFs, Word, assistir aulas e navegar na internet com fluidez.</p>
                    </div>
                    <div class="componente-linha">
                        <div class="componente-topo"><span class="nome-peca">💾 SSD 256GB NVMe</span><span class="badge-nivel nivel-entrada">Padrão</span></div>
                        <p class="explicao-peca">Garante velocidade ao ligar e abrir programas, mas possui espaço limitado para guardar arquivos muito pesados.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>

</body>
</html>