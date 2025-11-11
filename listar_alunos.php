<?php
$pagina_titulo = "Alunos Matriculados";
include 'includes/config.php';
include 'includes/header.php';

$conn = conectarBanco();
$alunos = [];

if ($conn){
    try{
        $stmt = $conn->query("SELECT * FROM Alunos");
        $alunos = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }   catch(PDOException $e){
        $erro = "Erro ao buscar alunos: " . $e->getMessage(); 
    }
}
?>

<section class="page-header">
    <div class="container">
        <h1>Alunos Matriculados</h1>
        <p>Lista de todos alunos no sistema</p>
    </div>
</section>

<section class="lista-eleitores">
    <div class="container">
        <?php if(isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if (empty($alunos)): ?>
            <div class="vazio">
                <p>Nenhum aluno cadastrado ainda</p>
            </div>
        <?php else: ?>
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>id</th>
                            <th>Data de Nascimento</th>
                            <th>Turma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($alunos as $aluno): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($aluno['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($aluno['Curso']); ?></td>
                            <td><?php echo $aluno['id']; ?>  </td>
                            <td><?php echo htmlspecialchars($aluno['data_nascimento']); ?></td>
                            <td><?php echo $aluno['turma']; ?>  </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="total">
                <p><strong>Total de alunos:</strong> <?php echo count($alunos); ?></p>
            </div>
        <?php endif; ?>

        <div class="acoes">
                <a href="servicos.php" class="btn secondary"> Voltar aos serviços</a>
        </div>
    </div>
</section>


<?php include 'includes/footer.php'; ?>