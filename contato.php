<?php 
$pagina_titulo = "Contato";
include 'includes/header.php'; 

// Processamento do formulário
$mensagem_enviada = false;
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    
    if ($nome && $email && $mensagem) {
        // Simular envio de email (substitua por email real)
        $to = SITE_EMAIL;
        $subject = "Contato do Site - " . SITE_NOME;
        $message = "Nome: $nome\nEmail: $email\nTelefone: $telefone\n\nMensagem:\n$mensagem";
        $headers = "From: $email";
        
        // Em produção, use: mail($to, $subject, $message, $headers);
        $mensagem_enviada = true;
    } else {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<section class="page-header">
    <div class="container">
        <h1>Contato</h1>
        <p>Entre em contato conosco</p>
    </div>
</section>

<section class="contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Informações de Contato</h2>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Endereço</h3>
                        <p>Rua Exemplo, 123 - São Paulo, SP</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Telefone</h3>
                        <p>(11) 9999-9999</p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p><?php echo "contato@ufss.edu.br"; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2>Envie uma Mensagem</h2>
                
                <?php if ($mensagem_enviada): ?>
                    <div class="alert success">
                        <p>✅ Mensagem enviada com sucesso! Entraremos em contato em breve.</p>
                    </div>
                <?php elseif ($erro): ?>
                    <div class="alert error">
                        <p>❌ <?php echo $erro; ?></p>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone">
                    </div>
                    
                    <div class="form-group">
                        <label for="mensagem">Mensagem *</label>
                        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>