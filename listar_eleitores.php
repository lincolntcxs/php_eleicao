<?php
$pagina_titulo = "Eleitores Cadastrados";
include 'includes/config.php';
include 'includes/header.php';

$conn = conectarBanco();
$eleitores = [];

if ($conn){
    try{
        $stmt = $conn->query("SELECT * FROM eleitor");
        $eleitores = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }   catch(PDOException $e){
        $erro = "Erro ao buscar eleitores: " . $e->getMessage(); 
    }
}
?>

<section class="lista_eleitores">
    <div class="container">
        <h1>Eleitores Cadastrados</h1>
        <p>Lista de todos eleitores no sistema<p>
    </div>
</section>

<section class="lista-eleitores">
    <div class="container">
        <?php if(isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if (empty($eleitores)): ?>
            <div class="vazio">
                <p>Nenhum eleitor cadastrado ainda</p>
                <a href="cadastrar_eleitor.php" class="btn"> Cadastrar primeiro eleitor</a>
            </div>
        <?php else: ?>
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>idade</th>
                            <th>sexo</th>
                            <th>titulo</th>
                            <th>votou</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($eleitores as $eleitor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($eleitor['nome']); ?></td>
                            <td><?php echo $eleitor['idade']; ?> anos </td>
                            <td><?php echo htmlspecialchars($eleitor['sexo']); ?></td>
                            <td><?php echo htmlspecialchars($eleitor['titulo']); ?></td>
                            <td><?php echo $eleitor['votou'] ? '✅ Sim' : '❌ Não'; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="total">
                <p><strong>Total de eleitores:</strong> <?php echo count($eleitores); ?></p>
            </div>
        <?php endif; ?>

        <div class="acoes">
                <a href="cadastrar_eleitor.php" class="btn"> Cadastrar novo eleitor </a>
                <a href="servicos.php" class="btn secondary"> Voltar aos serviços</a>
        </div>
    </div>
</section>


<?php include 'includes/footer.php'; ?>