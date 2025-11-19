<?php 
$pagina_titulo = "Cadastrar Candidato";
include 'includes/header.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Cadastrar Candidato</h1>
        <p>Registre um novo candidato no sistema</p>
    </div>
</section>

<section class="cadastro-form">
    <div class="container">
        <div class="form-container">
            <h2>Dados do Candidato</h2>
            <form action="processa_candidato.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="idade">Idade *</label>
                    <input type="number" id="idade" name="idade" min="18" required>
                </div>
                
                <div class="form-group">
                    <label for="partido">Partido *</label>
                    <input type="text" id="partido" name="partido" required>
                </div>
                
                <div class="form-group">
                    <label for="numero">Número para Votação *</label>
                    <input type="text" id="numero" name="numero" required>
                </div>
                
                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Cadastrar Candidato</button>
                <a href="servicos.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>