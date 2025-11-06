<?php 
$pagina_titulo = "Página Inicial";
include 'includes/header.php'; 

// Array de imagens para o carrossel
$imagens_carrossel = [
    [
        'src' => '/imagens/universidade.jpg',
        'alt' => 'Campus Universitário',
        'link' => 'sobre.php',
        'titulo' => 'Conheça Nossa Universidade'
    ],
    [
        'src' => '/imagens/gerencia.jpeg', 
        'alt' => 'Professores',
        'link' => 'servicos.php',
        'titulo' => 'Nossos Serviços'
    ],
    [
        'src' => '/imagens/eleicao.jpeg',
        'alt' => 'Eleição para reitor 2025',
        'link' => 'servicos.php',
        'titulo' => 'Eleição'
    ],
    [
        'src' => '/imagens/graduacao.jpg',
        'alt' => 'graduacao',
        'link' => 'graduacao.php',
        'titulo' => 'Cursos de graduação'
    ]
];
?>

<section class="hero">
    <div class="hero-content">
        <div class="hero-logo">
            <img src="/imagens/image-Photoroom.png" alt="logo <?php echo UFSS; ?>">
        </div>
        
        <div class="hero-text">
            <h1>Bem-vindo à <?php echo UFSS; ?></h1>
            <p><?php echo SITE_DESCRICAO; ?></p>
            <a href="servicos.php" class="cta-button">Conheça Nossos Serviços</a>
        </div>
        
        <!-- CAIXINHA DE PESQUISA SIMPLES -->
        <div class="hero-search-simple">
            <form action="pesquisa.php" method="GET" class="simple-search-form">
                <input type="text" name="q" placeholder="Buscar portal UFSS..." class="simple-search-input">
                <button type="submit" class="simple-search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <!-- CARROSSEL DE IMAGENS -->
        <div class="carrossel-container">
            <div class="carrossel">
                <?php foreach($imagens_carrossel as $index => $imagem): ?>
                <div class="carrossel-item <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <a href="<?php echo $imagem['link']; ?>" class="carrossel-link">
                        <img src="<?php echo $imagem['src']; ?>" alt="<?php echo $imagem['alt']; ?>">
                        <div class="carrossel-overlay">
                            <h3><?php echo $imagem['titulo']; ?></h3>
                            <span class="carrossel-btn">Saiba mais →</span>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Controles do carrossel -->
            <button class="carrossel-prev">‹</button>
            <button class="carrossel-next">›</button>
            
            <!-- Indicadores -->
            <div class="carrossel-indicators">
                <?php foreach($imagens_carrossel as $index => $imagem): ?>
                <button class="carrossel-indicator <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>

        <h2>Nossos Diferenciais</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-rocket"></i>
                <h3>Inovação</h3>
                <p>Soluções modernas e eficientes para seu negócio.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Equipe Qualificada</h3>
                <p>Profissionais experientes e dedicados.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-medal"></i>
                <h3>Qualidade</h3>
                <p>Compromisso com a excelência em todos os projetos.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>