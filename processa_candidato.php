<?php
include 'includes/config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recebe e valida os dados
    $nome = trim($_POST['nome']);
    $idade = intval($_POST['idade']);
    $partido = trim($_POST['partido']);
    $numero = trim($_POST['numero']);
    $sexo = trim($_POST['sexo']);
    $cargo = isset($_POST['cargo']) ? trim($_POST['cargo']) : '';
    
    // Validações básicas
    $erros = [];
    
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }
    
    if ($idade < 18) {
        $erros[] = "Candidato deve ter pelo menos 18 anos";
    }
    
    if (empty($partido)) {
        $erros[] = "Partido é obrigatório";
    }
    
    if (empty($numero)) {
        $erros[] = "Número para votação é obrigatório";
    }
    
    // Se não há erros, salva no banco
    if (empty($erros)) {
        $conn = conectarBanco();
        
        if ($conn) {
            try {
                // SQL adaptável - funciona com ou sem campo cargo
                $sql = "INSERT INTO candidato (nome, idade, partido, numero_para_votar, sexo";
                $values = "VALUES (:nome, :idade, :partido, :numero, :sexo";
                
                if (!empty($cargo)) {
                    $sql .= ", cargo";
                    $values .= ", :cargo";
                }
                
                $sql .= ") " . $values . ")";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':partido', $partido);
                $stmt->bindParam(':numero', $numero);
                $stmt->bindParam(':sexo', $sexo);
                
                if (!empty($cargo)) {
                    $stmt->bindParam(':cargo', $cargo);
                }
                
                if ($stmt->execute()) {
                    $sucesso = "Candidato cadastrado com sucesso!";
                    $id_candidato = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao cadastrar candidato";
                }
                
            } catch(PDOException $e) {
                $erros[] = "Erro no banco de dados: " . $e->getMessage();
            }
        } else {
            $erros[] = "Erro ao conectar com o banco de dados";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <section class="page-header">
        <div class="container">
            <h1>Resultado do Cadastro</h1>
        </div>
    </section>

    <section class="resultado-cadastro">
        <div class="container">
            <div class="mensagem-container">
                <?php if (!empty($sucesso)): ?>
                    <div class="alert success">
                        <h3>✅ <?php echo $sucesso; ?></h3>
                        <p><strong>Dados do candidato:</strong></p>
                        <ul>
                            <li><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></li>
                            <li><strong>Idade:</strong> <?php echo $idade; ?> anos</li>
                            <li><strong>Partido:</strong> <?php echo htmlspecialchars($partido); ?></li>
                            <li><strong>Número:</strong> <?php echo htmlspecialchars($numero); ?></li>
                            <li><strong>Sexo:</strong> <?php echo $sexo == 'M' ? 'Masculino' : 'Feminino'; ?></li>
                            <?php if (!empty($cargo)): ?>
                                <li><strong>Cargo:</strong> <?php echo htmlspecialchars($cargo); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($erros)): ?>
                    <div class="alert error">
                        <h3>❌ Erros no cadastro:</h3>
                        <ul>
                            <?php foreach($erros as $erro): ?>
                                <li><?php echo $erro; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="acoes">
                    <a href="cadastrar_candidato.php" class="btn">Cadastrar outro candidato</a>
                    <a href="servicos.php" class="btn secondary">Voltar aos serviços</a>
                    <a href="listar_candidatos.php" class="btn">Ver todos os candidatos</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>