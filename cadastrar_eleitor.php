<?php 
$pagina_titulo = "Cadastrar Eleitor";
include 'includes/header.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Cadastrar Eleitor</h1>
        <p>Preencha os dados do novo eleitor</p>
    </div>
</section>

<section class="cadastro-form">
    <div class="container">
        <div class="form-container">
            <h2>Dados do Eleitor</h2>
            <form action="processa_eleitor.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="idade">Idade *</label>
                    <input type="number" id="idade" name="idade" min="16" required>
                </div>
                
                <div class="form-group">
                    <label for="titulo">Título de Eleitor *</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                
                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Cadastrar Eleitor</button>
                <a href="services.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>