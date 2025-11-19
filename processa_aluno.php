<?php
include 'includes/config.php';

//VERIFICA SE O FOMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //RECEBE E VALIDA OS DADOS
    $nome = trim($_POST['nome']);
    $curso = trim($_POST['curso']);
    $data = trim($_POST['dataa']);
    $turma = trim($_POST['turma']);

    //VALIDACOES BASICAS
    $erros = [];
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if(empty($curso)){
        $erros[] = "O aluno deve estar matriculado em algum curso";
    }

    if(empty($data)){
        $erros[] = "Data de nascimento é obrigatório";
    }

    // CONVERTE A DATA PARA O FORMATO DO BANCO (YYYY-MM-DD)
    if(!empty($data)){
        $data_formatada = date('Y-m-d', strtotime($data));
        if($data_formatada == '1970-01-01'){ // Se strtotime falhar
            $erros[] = "Formato de data inválido. Use AAAA/MM/DD";
        }
    }


    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                $sql = "INSERT INTO Alunos (Nome, Curso, data_nascimento, turma) VALUES (:nome, :curso, :dataa, :turma)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':curso', $curso);
                $stmt->bindParam(':dataa', $data);
                $stmt->bindParam(':turma', $turma);

                if($stmt->execute()){
                    $sucesso = "Aluno cadastrado com sucesso!";
                    $id_candidato = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao cadastrar aluno";
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
                            <li><strong>Curso:</strong> <?php echo $curso; ?></li>
                            <li><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data); ?></li>
                            <li><strong>Turma:</strong> <?php echo htmlspecialchars($turma); ?></li>
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
                    <a href ="cadastrar_alunos.php" class= "btn">Cadastrar outro aluno</a>
                    <a href ="servicos.php" class="btn secondary">Voltar aos serviços</a>
                    <a href ="listar_alunos.php" class = "btn secondary">Ver todos os alunos</a>
                </div>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>
</html>