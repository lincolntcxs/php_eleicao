<?php
include 'includes/config.php';

//VERIFICA SE O FOMULÁRIO FOI ENVIADO
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //RECEBE E VALIDA OS DADOS
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha_hash']);
    $nome = trim($_POST['nome']);

    //CRIPTOGRAFA A SENHA
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    //VALIDACOES BASICAS
    $erros = [];
    if(empty($nome)){
        $erros[] = "Nome é obrigatório";
    }

    if(empty($senha)){
        $erros[] = "Senha é obrigatória";
    }

    if(empty($email)){
        $erros[] = "E-mail é obrigatório";
    }

    if(empty($erros)){
        $conn = conectarBanco();
        if($conn){
            try{
                $sql = "INSERT INTO usuarios (email, senha_hash, nome) VALUES (:email, :senha_hash, :nome)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha_hash', $senha);
                $stmt->bindParam(':nome', $nome);

                if($stmt->execute()){
                    $sucesso = "Usuário cadastrado com sucesso!";
                    $id_usuario = $conn->lastInsertId();
                } else {
                    $erros[] = "Erro ao cadastrar usuário";
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
                        <p><strong>Dados do Ssuário:</strong></p>
                        <ul>
                            <li><strong>E-Mail:</strong> <?php echo $email; ?></li>
                            <li><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></li>
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
                    <a href ="criar_conta.php" class= "btn secondary">Criar outra conta </a>
                    <a href ="index.php" class="btn secondary">Home</a>
                </div>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>
</html>