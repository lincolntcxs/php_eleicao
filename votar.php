<?php 
$pagina_titulo = "Votação eletrônica";
include 'includes/header.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Votação eletrônica</h1>
        <p>Preencha os dados dos candidatos</p>
    </div>
</section>

<section class="cadastro-form">
    <div class="container">
        <div class="form-container">
            <h2>Reitor</h2>
            <form action="processa_voto.php" method="POST">
                <div class="form-group">
                    <label for="reitor">Nome Reitor *</label>
                    <input type="text" id="reitor" name="reitor" required>
                </div>
                
                <div class="form-group">
                    <label for="vice">Vice reitor *</label>
                    <input type="text" id="vice" name="vice" required>
                </div>
                
                <button type="submit" class="submit-btn">Registar Voto</button>
                <a href="services.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>