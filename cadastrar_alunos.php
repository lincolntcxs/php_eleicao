<?php 
$pagina_titulo = "Cadastrar Alunos";
include 'includes/header.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Cadastrar Aluno</h1>
        <p>Registre um novo aluno no sistema</p>
    </div>
</section>

<section class="cadastro-form">
    <div class="container">
        <div class="form-container">
            <h2>Dados do Aluno</h2>
            <form action="processa_aluno.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="curso">Curso *</label>
                    <input type="text" id="curso" name="curso" required>
                </div>

                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento *</label>
                    <input type="text" id="dataa" name="dataa" required>
                </div>
                
                <div class="form-group">
                    <label for="turma">Turma *</label>
                    <input type="text" id="turma" name="turma" required>
                </div>
                
                <button type="submit" class="submit-btn">Cadastrar Aluno</button>
                <a href="servicos.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>