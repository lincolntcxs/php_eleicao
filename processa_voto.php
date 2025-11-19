<?php
include 'includes/config.php';

// VERIFICA SE O FORMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // RECEBE E VALIDA OS DADOS
    $reitor = trim($_POST['reitor']);
    $vice = trim($_POST['vice']);
    $eleitor = trim($_POST['eleitor']);

    // VALIDAÇÕES BÁSICAS
    $erros = [];
    if(empty($reitor)){
        $erros[] = "Reitor é obrigatório";
    }

    if(empty($vice)){
        $erros[] = "Vice é obrigatório";
    }

    if(empty($eleitor)){
        $erros[] = "É preciso escolher um eleitor";
    }

    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                // INICIAR TRANSAÇÃO
                $conn->beginTransaction();
                
                // 1. PRIMEIRO: INSERIR O VOTO
                $sql_voto = "INSERT INTO voto (reitor, vice) VALUES (:reitor, :vice)";
                $stmt_voto = $conn->prepare($sql_voto);
                $stmt_voto->bindParam(':reitor', $reitor);
                $stmt_voto->bindParam(':vice', $vice);
                
                if($stmt_voto->execute()){
                    // 2. SEGUNDO: ATUALIZAR O ELEITOR
                    $sql_eleitor = "UPDATE eleitor SET votou = 1 WHERE nome = :eleitor";
                    $stmt_eleitor = $conn->prepare($sql_eleitor);
                    $stmt_eleitor->bindParam(':eleitor', $eleitor);
                    
                    if($stmt_eleitor->execute()){
                        // Verificar se algum registro foi atualizado
                        if($stmt_eleitor->rowCount() > 0){
                            $conn->commit();
                            $sucesso = "Voto registrado com sucesso! Eleitor atualizado.";
                        } else {
                            $conn->rollBack();
                            $erros[] = "Eleitor não encontrado ou já votou. Nenhum voto foi registrado.";
                        }
                    } else {
                        $conn->rollBack();
                        $erros[] = "Erro ao atualizar status do eleitor";
                    }
                } else {
                    $conn->rollBack();
                    $erros[] = "Erro ao registrar voto";
                }
                
            } catch(PDOException $e){
                // Garantir rollback em caso de erro
                if($conn->inTransaction()) {
                    $conn->rollBack();
                }
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
    <title>Resultado do Voto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Resultado do voto</h1>
        </div>
    </section>

    <section class="resultado-cadastro">
        <div class="container">
            <div class="mensagem-container">
                <?php if(!empty($sucesso)): ?>
                    <div class="alert success">
                        <h3>✅ <?php echo $sucesso; ?></h3>
                        <p><strong>Dados do voto:</strong></p>
                        <ul>
                            <li><strong>Reitor:</strong> <?php echo htmlspecialchars($reitor); ?></li>
                            <li><strong>Vice:</strong> <?php echo htmlspecialchars($vice); ?></li>
                            <li><strong>Eleitor:</strong> <?php echo htmlspecialchars($eleitor); ?></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($erros)): ?>
                    <div class="alert error">
                        <h3>❌ Erros na votação:</h3>
                        <ul>
                            <?php foreach($erros as $erro): ?>
                                <li><?php echo $erro; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="acoes">
                    <a href="votar.php" class= "btn">Novo voto</a>
                    <a href ="servicos.php" class="btn secondary">Voltar aos serviços</a>
                </div>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>