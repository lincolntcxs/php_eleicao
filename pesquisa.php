<?php 
$pagina_titulo = "Resultados da Pesquisa";
include 'includes/header.php'; 

// Recebe o termo de pesquisa
$termo = isset($_GET['q']) ? trim($_GET['q']) : '';
$resultados = [];

// Simulação de busca (substitua por busca real no banco)
$conteudo_pesquisavel = [
    'servicos' => [
        'titulo' => 'Nossos Serviços',
        'descricao' => 'Conheça todos os serviços disponíveis no sistema eleitoral',
        'link' => 'servicos.php',
        'categoria' => 'Serviços'
    ],
    'eleitores' => [
        'titulo' => 'Lista de Eleitores', 
        'descricao' => 'Visualize todos os eleitores cadastrados no sistema',
        'link' => 'listar_eleitores.php',
        'categoria' => 'Cadastros'
    ],
    'candidatos' => [
        'titulo' => 'Lista de Candidatos',
        'descricao' => 'Confira os candidatos participantes da eleição',
        'link' => 'listar_candidatos.php', 
        'categoria' => 'Cadastros'
    ],
    'alunos' => [
        'titulo' => 'Lista de Alunos', 
        'descricao' => 'Visualize todos os alunos cadastrados no sistema',
        'link' => 'listar_alunos.php',
        'categoria' => 'Alunos'
    ],

    'votar' => [
        'titulo' => 'Registrar Voto',
        'descricao' => 'Exercite seu direito ao voto na eleição atual',
        'link' => 'votar.php',
        'categoria' => 'Votação'
    ],
    'resultados' => [
        'titulo' => 'Resultados da Eleição',
        'descricao' => 'Acompanhe os resultados em tempo real',
        'link' => 'resultados.php',
        'categoria' => 'Resultados'
    ],
    'graduacao' => [
        'titulo' => 'Cursos de Graduação',
        'descricao' => 'Conheça nossa oferta de cursos de graduação',
        'link' => 'graduacao.php',
        'categoria' => 'Cursos'
    ],
    'sobre' => [
        'titulo' => 'Sobre a UFSS',
        'descricao' => 'Conheça a história e missão da Universidade',
        'link' => 'sobre.php',
        'categoria' => 'Universidade'
    ]
];

// Busca nos dados
if (!empty($termo)) {
    $termo_lower = strtolower($termo);
    foreach ($conteudo_pesquisavel as $palavra_chave => $conteudo) {
        if (strpos($palavra_chave, $termo_lower) !== false || 
            stripos($conteudo['titulo'], $termo) !== false ||
            stripos($conteudo['descricao'], $termo) !== false) {
            $resultados[] = $conteudo;
        }
    }
}

// Se não encontrou nada, sugere termos
$sugestoes = [];
if (empty($resultados) && !empty($termo)) {
    $sugestoes = ['servicos', 'eleitores', 'candidatos', 'votar', 'resultados', 'graduacao'];
}
?>

<section class="page-header">
    <div class="container">
        <h1>Resultados da Pesquisa</h1>
        <p>
            <?php if (!empty($termo)): ?>
                Você pesquisou por: "<strong><?php echo htmlspecialchars($termo); ?></strong>"
            <?php else: ?>
                Digite um termo para pesquisar
            <?php endif; ?>
        </p>
        
        <!-- Barra de pesquisa na página de resultados -->
        <div class="pesquisa-container">
            <form action="pesquisa.php" method="GET" class="search-page-form">
                <input type="text" name="q" value="<?php echo htmlspecialchars($termo); ?>" 
                       placeholder="Buscar no portal UFSS..." class="search-page-input" autofocus>
                <button type="submit" class="search-page-btn">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </form>
        </div>
    </div>
</section>

<section class="resultados-pesquisa">
    <div class="container">
        <?php if (empty($termo)): ?>
            <div class="vazio">
                <i class="fas fa-search fa-3x"></i>
                <h3>Digite algo para pesquisar</h3>
                <p>Encontre serviços, candidatos, eleitores e muito mais</p>
            </div>
            
        <?php elseif (!empty($resultados)): ?>
            <div class="resultados-info">
                <p>Encontramos <strong><?php echo count($resultados); ?></strong> resultado(s) para sua pesquisa</p>
            </div>
            
            <div class="resultados-lista">
                <?php foreach($resultados as $resultado): ?>
                <div class="resultado-item">
                    <div class="resultado-categoria"><?php echo $resultado['categoria']; ?></div>
                    <h3><a href="<?php echo $resultado['link']; ?>"><?php echo $resultado['titulo']; ?></a></h3>
                    <p><?php echo $resultado['descricao']; ?></p>
                    <a href="<?php echo $resultado['link']; ?>" class="resultado-link">Acessar →</a>
                </div>
                <?php endforeach; ?>
            </div>
            
        <?php else: ?>
            <div class="vazio">
                <i class="fas fa-search-minus fa-3x"></i>
                <h3>Nenhum resultado encontrado</h3>
                <p>Não encontramos resultados para "<strong><?php echo htmlspecialchars($termo); ?></strong>"</p>
                
                <?php if (!empty($sugestoes)): ?>
                <div class="sugestoes">
                    <h4>Tente pesquisar por:</h4>
                    <div class="sugestoes-lista">
                        <?php foreach($sugestoes as $sugestao): ?>
                        <a href="pesquisa.php?q=<?php echo urlencode($sugestao); ?>" class="sugestao"><?php echo $sugestao; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="acoes-pesquisa">
            <a href="servicos.php" class="btn">Ver Todos os Serviços</a>
            <a href="index.php" class="btn secondary">Voltar ao Início</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>