<?php
session_start();
// Proteger página - só acessa se estiver logado
if(!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$pagina_titulo = "Dashboard";
include 'includes/header.php';
?>

<section class="dashboard">
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
        <p>Email: <?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>
        
        <div class="dashboard-menu">
            <a href="listar_vestibulando.php" class="btn">Ver Inscrições</a>
            <a href="logout.php" class="btn secondary">Sair</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>