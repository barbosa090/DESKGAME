<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade Gaming - Catálogo</title>
    <link rel="stylesheet" href="index.css">
   <style>
    .gamer-nav {
            display: flex;
            gap: 20px;
        }
        .nav-link {
            color: #c5c6c7;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #66fcf1; 
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        
        <header class="gamer-header">
            <h1 class="logo-txt">🖥️ DESKGAME</h1>
            
            <nav class="gamer-nav">
                <a href="#" class="nav-link active">Início</a>
                <a href="#" class="nav-link">Computadores</a>
                <a href="#" class="nav-link">Notebooks</a>
            </nav>

            <div class="header-right">
                <div class="user-info">
                    <span>Catálogo de Fotos</span>
                </div>
                <a href="logout.php" class="btn-logout">Sair</a>
            </div>
        </header>

        <h2 style="border-bottom: 1px solid #1f2833; padding-bottom: 10px; margin-bottom: 20px; color: #fff;">
            Nossas Máquinas
        </h2>

        <div class="products-grid">
            
            <div class="pc-card">
                <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=400&q=80" alt="PC Gamer Ryzen Ultimate">
                <h3>PC Gamer Ryzen Ultimate</h3>
                <div class="pc-specs">
                    🔹 <strong>CPU:</strong> AMD Ryzen 7 5700X<br>
                    🔹 <strong>GPU:</strong> RTX 4060 Ti<br>
                    🔹 <strong>RAM:</strong> 16GB DDR4
                </div>
                <div class="pc-price">R$ 5.499,00</div>
            </div>

            <div class="pc-card">
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?auto=format&fit=crop&w=400&q=80" alt="PC Gamer Intel Core Force">
                <h3>PC Gamer Intel Core Force</h3>
                <div class="pc-specs">
                    🔹 <strong>CPU:</strong> Intel Core i5-13400F<br>
                    🔹 <strong>GPU:</strong> RTX 3060<br>
                    🔹 <strong>RAM:</strong> 16GB DDR4
                </div>
                <div class="pc-price">R$ 4.299,00</div>
            </div>

            <div class="pc-card">
                <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=400&q=80" alt="PC Gamer Streamer Elite">
                <h3>PC Gamer Streamer Elite</h3>
                <div class="pc-specs">
                    🔹 <strong>CPU:</strong> Intel Core i7-14700K<br>
                    🔹 <strong>GPU:</strong> RTX 4070 Super<br>
                    🔹 <strong>RAM:</strong> 32GB DDR5
                </div>
                <div class="pc-price">R$ 8.999,00</div>
            </div>

        </div>

    </div>

</body>
</html>
