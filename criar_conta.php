<?php 
$pagina_titulo = "Criar Conta";
include 'includes/header.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Criar Conta</h1>
        <p>Crie seu usuário</p>
    </div>
</section>

<section class="cadastro-form">
    <div class="container">
        <div class="form-container">
            <h2>Dados do Usuário</h2>
            <form action="processa_usuario.php" method="POST">
                
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="text" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="senha_hash">Senha *</label>
                    <input type="password" id="senha_hash" name="senha_hash" required>
                </div>
                
                <div class="form-group">
                    <label for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <button type="submit" class="submit-btn">Criar Usuário</button>
                <a href="servicos.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>