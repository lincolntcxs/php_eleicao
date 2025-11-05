<?php
include 'includes/config.php';

//VERIFICA SE O FOMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //RECEBE E VALIDA OS DADOS
    $nome = trim($_POST['nome']);
    $idade = intval($_POST['idade']);
    $sexo = trim($_POST['sexo']);
    $titulo = trim($_POST['titulo']);

    //VALIDACOES BASICAS
    $erros = [];
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if($idade < 18){
        $erros[] = "Candidato deve ter pelo menos 18 anos";
    }

    if(empty($titulo)){
        $erros[] = "Titulo é obrigatório";
    }

    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                $sql = "INSERT INTO eleitor (nome, idade, sexo, titulo)";
                $values = "VALUES (:nome, :idade, :sexo, :titulo)";

                $sql .= ") " . $values . ")";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':sexo', $sexo);
                $stmt->bindParam(':titulo', $titulo);

                if($stmt->execute()){
                    $sucesso = "Eleitor cadastrado com sucesso!";
                    $id_candidato = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao cadastrar eleitor";
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
    <meta name="viewport" content="width=devic-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="page-header">
        <div class="contanier">
            <h1>Resultado do Cadastro</h1>
        </div>
    </section>

    <section class="resultado-cadastro">
        <div class="container">
            <div class="mensagem-container">
                <?php if(!empty($sucesso)): ?>
                    <div class="alert success">
                        <h3>✅ <?php echo $sucesso; ?></h3>
                        <p><strong>Dados do eleitor:</strong></p>
                        <ul>
                            <li><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></li>
                            <li><strong>idade:</strong> <?php echo $idade; ?> anos</li>
                            <li><strong>Sexo:</strong> <?php echo htmlspecialchars($sexo); ?></li>
                            <li><strong>Título:</strong> <?php echo htmlspecialchars($titulo); ?></li>
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
                    <a href="cadastrar_eleitor.php" class= "btn">Cadastrar outro eleitor</a>
                    <a href ="servicos.php" class="btn secondary">Voltar aos serviços</a>
                    <a href ="listar_eleitores.php">Ver todos os eleitores</a>
                </div>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>
</html>