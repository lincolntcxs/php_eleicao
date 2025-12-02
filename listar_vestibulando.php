<?php
$pagina_titulo = "Vestibulandos Cadastrados";
include 'includes/config.php';
include 'includes/header.php';

$conn = conectarBanco();
$alunos = [];

if ($conn){
    try{
        $stmt = $conn->query("SELECT * FROM vestibulando");
        $vestibulandos = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }   catch(PDOException $e){
        $erro = "Erro ao buscar vestibulando: " . $e->getMessage(); 
    }
}
?>

<section class="page-header">
    <div class="container">
        <h1>Vestibulandos Cadastrados</h1>
        <p>Lista de todas inscrições realizadas</p>
    </div>
</section>

<section class="lista-vestibulandos">
    <div class="container">
        <?php if(isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if (empty($vestibulandos)): ?>
            <div class="vazio">
                <p>Nenhuma inscrição realizada ainda</p>
            </div>
        <?php else: ?>
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>RG</th>
                            <th>Telefone</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Endereço</th>
                            <th>Curso</th>
                            <th>Turno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($vestibulandos as $vestibulando): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vestibulando['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['data_nascimento']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['rg']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['telefone']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['estado']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['cidade']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['endereco']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['curso']); ?></td>
                            <td><?php echo htmlspecialchars($vestibulando['turno']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="total">
                <p><strong>Total de inscrições:</strong> <?php echo count($vestibulandos); ?></p>
            </div>
        <?php endif; ?>

        <div class="acoes">
                <a href="servicos.php" class="btn secondary"> Voltar aos serviços</a>
        </div>
    </div>
</section>


<?php include 'includes/footer.php'; ?>