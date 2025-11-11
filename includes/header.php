<?php include 'includes/config.php'; ?>
<link rel="stylesheet" href="/home/lincoln/Documentos/codigos_vs/projeto_php/css">
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo UFSS; ?> - <?php echo $pagina_titulo ?? 'Página Inicial'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="/imagens/logo_ufss.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <a href="index.php"><?php echo UFSS; ?></a>
                </div>
                <ul class="nav-menu">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="sobre.php" class="nav-link">Sobre</a></li>
                    <li><a href="servicos.php" class="nav-link">Serviços</a></li>
                    <li><a href="contato.php" class="nav-link">Contato</a></li>
                    <li><a href="graduacao.php" class="nav-link">Graduação</a></li>
                </ul>
                <div class="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>
    <main>