<?php
$pagina_titulo = "Candidatos Cadastrados";
include 'includes/config.php';
include 'includes/header.php'; 

$conn = conectarBanco();
$candidatos = [];

if ($conn) {
    try {
        $stmt = $conn->query("SELECT * FROM candidato ");
        $candidatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $erro = "Erro ao buscar candidatos: " . $e->getMessage();
    }
}
?>

<section class="page-header">
    <div class="container">
        <h1>Candidatos Cadastrados</h1>
        <p>Lista de todos os candidatos no sistema</p>
    </div>
</section>

<section class="lista-candidatos">
    <div class="container">
        <?php if (isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if (empty($candidatos)): ?>
            <div class="vazio">
                <p>Nenhum candidato cadastrado ainda.</p>
                <a href="cadastrar_candidato.php" class="btn">Cadastrar primeiro candidato</a>
            </div>
        <?php else: ?>
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Partido</th>
                            <th>Número</th>
                          

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($candidatos as $candidato): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($candidato['nome']); ?></td>
                            <td><?php echo $candidato['idade']; ?> anos</td>
                            <td><?php echo htmlspecialchars($candidato['partido']); ?></td>
                            <td><?php echo htmlspecialchars($candidato['numero_para_votar']); ?></td>
                            
                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="total">
                <p><strong>Total de candidatos:</strong> <?php echo count($candidatos); ?></p>
            </div>
        <?php endif; ?>
        
        <div class="acoes">
            <a href="cadastrar_candidato.php" class="btn">Cadastrar novo candidato</a>
            <a href="servicos.php" class="btn secondary">Voltar aos serviços</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>