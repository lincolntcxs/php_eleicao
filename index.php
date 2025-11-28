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
        <!-- Notícias em Destaque -->
        <div class="noticias-section">
            <h2>📢 Notícias e Eventos</h2>
            <div class="noticias-grid">
                <div class="noticia-card">
                    <span class="noticia-data">22 JAN 2026</span>
                    <h3>Inscrições Abertas para o Vestibular 2026</h3>
                    <p>Processo seletivo com 500 vagas disponíveis</p>
                    <a href="inscricao.php">Increver-se</a>
                </div>
                <div class="noticia-card">
                    <span class="noticia-data">20 MAR 2026</span>
                    <h3>Semana de Tecnologia e Inovação</h3>
                    <p>Evento com palestras e workshops gratuitos</p>
                    <a href="eventos.php">Ver programação →</a>
                </div>
            </div>
        </div>
        <!-- Próximos Eventos -->
        <div class="calendario-section">
            <h2>📅 Calendário Acadêmico</h2>
            <div class="eventos-lista">
                <div class="evento">
                    <span class="evento-data">01/04 - 15/04</span>
                    <span class="evento-titulo">Período de Matrícula</span>
                </div>
                <div class="evento">
                    <span class="evento-data">20/04</span>
                    <span class="evento-titulo">Início do Semestre 2024.1</span>
                </div>
                <div class="evento">
                    <span class="evento-data">25/04</span>
                    <span class="evento-titulo">Semana de Recepção aos Calouros</span>
                </div>
            </div>
        </div>
        <!-- Estatísticas Institucionais -->
        <div class="estatisticas-ufss">
            <h2> Números da UFSS</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">2.000+</div>
                    <div class="stat-label">Estudantes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">9</div>
                    <div class="stat-label">Cursos de Graduação</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Professores</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Aprovação no ENADE</div>
                </div>
            </div>
        </div>
        <!-- Cursos Populares -->
        <div class="cursos-destaque">
            <h2>🎓 Cursos em Destaque</h2>
            <div class="cursos-grid">
                <div class="curso-destaque">
                    <i class="fas fa-laptop-code"></i>
                    <h3>Ciência da Computação</h3>
                    <p>Nota 5 no MEC - 8 semestres</p>
                    <a href="curso_computacao.php">Conhecer →</a>
                </div>
                <div class="curso-destaque">
                    <i class="fas fa-stethoscope"></i>
                    <h3>Medicina</h3>
                    <p>Nota 5 no MEC - 12 semestres</p>
                    <a href="curso_medicina.php">Conhecer →</a>
                </div>
                <div class="curso-destaque">
                    <i class="fas fa-hard-hat"></i>
                    <h3>Engenharia Civil</h3>
                    <p>Nota 4 no MEC - 10 semestres</p>
                    <a href="curso_eng_civil.php">Conhecer →</a>
                </div>
            </div>
        </div>
    </div>
    <section class="votacao-section">
    <div class="votacao-container">
        <h2>🗳️ Vote Agora!</h2>
        <p>Escaneie o QR Code para acessar a votação diretamente pelo celular</p>
        
        <div class="qr-code-container">
            <img src="imagens/qr-code.png" alt="QR Code para votação" class="qr-code">
        </div>
        
        <div class="votacao-links">
            <a href="votar.php" class="btn-votar">📱 Votar Agora</a>
            <p class="ou">ou</p>
            <p class="instrucao">Aponte a câmera do celular para o QR Code</p>
        </div>
    </div>
</section>
</section>

<?php include 'includes/footer.php'; ?>