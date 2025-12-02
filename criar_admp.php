<?php
include 'includes/config.php';

$conn = conectarBanco();

// Senha: admin123 (você altera depois)
$senha_hash = password_hash('admin123', PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (email, senha_hash, nome, nivel_acesso) 
        VALUES ('admin@universidade.edu', ?, 'Administrador', 'admin')";

$stmt = $conn->prepare($sql);
if($stmt->execute([$senha_hash])) {
    echo "Usuário admin criado com sucesso!<br>";
    echo "Email: admin@universidade.edu<br>";
    echo "Senha: admin123<br>";
    echo "<strong>DELETE ESTE ARQUIVO APÓS USAR!</strong>";
} else {
    echo "Erro ao criar usuário.";
}
?>