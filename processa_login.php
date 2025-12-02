<?php
session_start();
include 'includes/config.php';

// 1. Validar entrada
if(empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: login.php?erro=vazio');
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// 2. Buscar usuário no banco
try {
    $conn = conectarBanco();
    $stmt = $conn->prepare("SELECT id, nome, email, senha_hash, nivel_acesso FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 3. Verificar se usuário existe E se senha está correta
    if($usuario && password_verify($senha, $usuario['senha_hash'])) {
        // 4. Criar sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_nivel'] = $usuario['nivel_acesso'];
        
        // 5. Redirecionar para área restrita
        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: login.php?erro=credenciais');
        exit;
    }
    
} catch(PDOException $e) {
    error_log("Erro de login: " . $e->getMessage());
    header('Location: login.php?erro=sistema');
    exit;
}
?>