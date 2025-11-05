<?php
// Configurações do site
define('SITE_NOME', 'Meu Site Institucional');
define('SITE_DESCRICAO', 'Universidade Federal de São Sebastião');

// Configurações do banco de dados 
define('DB_HOST', 'localhost');
define('DB_NAME', 'eleicao');  
define('DB_USER', 'root');
define('DB_PASS', 'password');

// Função para conexão com o banco - COM VERIFICAÇÃO SE JÁ EXISTE
if (!function_exists('conectarBanco')) {
    function conectarBanco() {
        try {
            $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            return null;
        }
    }
}

// Inicia a sessão
session_start();
?>