<?php
include 'includes/config.php';

//VERIFICA SE O FOMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //RECEBE E VALIDA OS DADOS
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $data_nascimento = trim($_POST['data_nascimento']);
    $rg = trim($_POST['rg']);
    $telefone = trim($_POST['telefone']);
    $estado = trim($_POST['estado']);
    $cidade = trim($_POST['cidade']);
    $endereco = trim($_POST['endereco']);
    $curso = trim($_POST['curso']);
    $turno = trim($_POST['turno']);
 
    //VALIDACOES BASICAS
    $erros = [];
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if(empty($cpf)){
        $erros[] = "CPF é obrigatório";
    }

    if(empty($data_nascimento)){
        $erros[] = "Data de nascimento é obrigatório";
    }

    // CONVERTE A DATA PARA O FORMATO DO BANCO (YYYY-MM-DD)
    if(!empty($data_nascimento)){
        $data_formatada = date('Y-m-d', strtotime($data));
        if($data_formatada == '1970-01-01'){ // Se strtotime falhar
            $erros[] = "Formato de data inválido. Use AAAA/MM/DD";
        }
    }

    if(empty($estado)){
        $erros[] = "Estado é obrigatório";
    }

    if(empty($cidade)){
        $erros[] = "Cidade é obrigatório";
    }

    if(empty($endereco)){
        $erros[] = "Endereço é obrigatório";
    }

    if(empty($curso)){
        $erros[] = "Por favor selecione seu curso";
    }

    if(empty($turno)){
        $erros[] = "Por favor selecione o turno do seu curso";
    }


    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                $sql = "INSERT INTO vestibulando (Nome, cpf, data_nascimento, rg, telefone, estado, cidade, endereco, curso, turno) VALUES (:nome, :cpf, :data_nascimento, :rg, :telefone, :estado, :cidade, :endereco, :curso, :turno)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':data_nascimento', $data_nascimento);
                $stmt->bindParam(':rg', $rg);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':estado', $estado);
                $stmt->bindParam(':cidade', $cidade);
                $stmt->bindParam(':endereco', $endereco);
                $stmt->bindParam(':curso', $curso);
                $stmt->bindParam(':turno', $turno);

                if($stmt->execute()){
                    $sucesso = "Vestibulando cadastrado com sucesso!";
                    $id_vestibulando = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao cadastrar vestibulando";
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
                            <li><strong>CPF:</strong> <?php echo $curso; ?></li>
                            <li><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data_nascimento); ?></li>
                            <li><strong>RG:</strong> <?php echo htmlspecialchars($rg); ?></li>
                            <li><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></li>
                            <li><strong>Estado:</strong> <?php echo htmlspecialchars($estado); ?></li>
                            <li><strong>Cidade:</strong> <?php echo htmlspecialchars($cidade); ?></li>
                            <li><strong>Endereço:</strong> <?php echo htmlspecialchars($endereco); ?></li>
                            <li><strong>Curso:</strong> <?php echo htmlspecialchars($curso); ?></li>
                            <li><strong>Turno:</strong> <?php echo htmlspecialchars($turno); ?></li>
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
                    <a href ="inscricao.php" class= "btn">Fazer outra inscrição </a>
                    <a href ="servicos.php" class="btn secondary">Voltar aos serviços</a>
                    <a href ="listar_vestibulando.php" class = "btn secondary">Ver todos os vestibulandos</a>
                </div>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>
</html>