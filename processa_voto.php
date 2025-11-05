<?php
include 'includes/config.php';

//VERIFICA SE O FOMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //RECEBE E VALIDA OS DADOS
    $reitor = trim($_POST['reitor']);
    $vice = trim($_POST['vice']);

    //VALIDACOES BASICAS
    $erros = [];
    if(empty($reitor)){
        $erros[] = "Reitor é obrigatório";
    }

    if(empty($vice)){
        $erros[] = "Vice é obrigatório";
    }

    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                $sql = "INSERT INTO voto (reitor, vice) VALUES (:reitor, :vice)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':reitor', $reitor);
                $stmt->bindParam(':vice', $vice);

                if($stmt->execute()){
                    $sucesso = "Voto registrado com sucesso!";
                    $id_voto = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao registar voto";
                }
            } catch(PDOException $e){
                $erros[] = "Erro no banco de dados: " . $e->getMessage();
            }
        }else{
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