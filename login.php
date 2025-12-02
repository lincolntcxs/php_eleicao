<?php
session_start();
include 'includes/config.php';
include 'includes/header.php';

if(isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<section class="login-form">
    <div class="container">
        <h2>Login do Sistema</h2>
        <div class="logo-login">
            <img src="imagens/image-Photoroom.png" alt="logo UFSS">
        </div>
        <?php if(isset($_GET['erro'])): ?>
            <div class="alert error">
                <?php 
                switch($_GET['erro']) {
                    case 'credenciais': echo 'Email ou senha incorretos'; break;
                    case 'vazio': echo 'Preencha todos os campos'; break;
                    default: echo 'Erro ao fazer login';
                }
                ?>
            </div>
        <?php endif; ?>
        
        <form action="processa_login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <button type="submit" class="btn primary">Entrar</button>
            <a href="index.php" class="btn secondary">Voltar</a>
            <a href="criar_conta.php" class="btn secondary">Criar Conta</a>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>