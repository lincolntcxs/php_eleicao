<?php
include 'includes/config.php';

echo "<h1>Teste de Conexão com Banco</h1>";

$conn = conectarBanco();
if ($conn) {
    echo "✅ Conexão com banco OK!<br>";
    
    // Ver tabelas
    $stmt = $conn->query("SHOW TABLES");
    $tabelas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Tabelas no banco:</h3>";
    foreach($tabelas as $tabela) {
        echo "- $tabela<br>";
    }
    
    // Ver estrutura da tabela candidatos
    if (in_array('eleitor', $tabelas)) {
        echo "<h3>Estrutura da tabela eleitor:</h3>";
        $stmt = $conn->query("DESCRIBE eleitor");
        $campos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($campos as $campo) {
            echo "Campo: {$campo['Field']} - Tipo: {$campo['Type']}<br>";
        }
    } else {
        echo "❌ Tabela 'eleitor' não existe!";
    }
    
} else {
    echo "❌ Erro na conexão com banco!";
}
?>