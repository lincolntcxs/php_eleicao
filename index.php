<?php 
$pagina_titulo = "Página Inicial";
include 'includes/header.php'; 
?>

<section class="hero">
    <div class="hero-content">
        <h1>Bem-vindo ao <?php echo UFSS; ?></h1>
        <p><?php echo SITE_DESCRICAO; ?></p>
        <a href="servicos.php" class="cta-button">Conheça Nossos Serviços</a>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class = "imagem-flex">
            <img src="/imagens/universidade.jpg" alt="gerencia">
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