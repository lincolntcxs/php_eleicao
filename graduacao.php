<?php 
$pagina_titulo = "Cursos de Graduação";
include 'includes/header.php'; 

// Array de cursos
$cursos = [
    [
        'imagem' => 'imagens/adm_porto.jpg',
        'titulo' => 'Administração Portuária',
        'descricao' => 'Bacharelado em Administração com ênfase em gestão portuária',
        'link' => 'curso_administracao.php',
        'duracao' => '8 semestres',
        'turno' => 'Matutino/Noturno'
    ],
    [
        'imagem' => 'imagens/agro.jpg',
        'titulo' => 'Agronomia',
        'descricao' => 'Formação em ciências agrárias e desenvolvimento rural sustentável',
        'link' => 'curso_agronomia.php',
        'duracao' => '10 semestres', 
        'turno' => 'Integral'
    ],
    [
        'imagem' => 'imagens/biologia.jpg',
        'titulo' => 'Ciências Biológicas',
        'descricao' => 'Licenciatura e Bacharelado em Ciências Biológicas',
        'link' => 'curso_biologia.php',
        'duracao' => '8 semestres',
        'turno' => 'Matutino/Noturno'
    ],
    [
        'imagem' => 'imagens/computacao.jpeg',
        'titulo' => 'Ciência da Computação',
        'descricao' => 'Bacharelado em Ciência da Computação e Tecnologia da Informação',
        'link' => 'curso_computacao.php',
        'duracao' => '8 semestres',
        'turno' => 'Noturno'
    ],
    [
        'imagem' => 'imagens/eng_alimen.jpg',
        'titulo' => 'Engenharia de Alimentos',
        'descricao' => 'Engenharia com foco em processamento e tecnologia de alimentos',
        'link' => 'curso_eng_alimentos.php',
        'duracao' => '10 semestres',
        'turno' => 'Integral'
    ],
    [
        'imagem' => 'imagens/eng_civ.jpg',
        'titulo' => 'Engenharia Civil',
        'descricao' => 'Bacharelado em Engenharia Civil e Construção Civil',
        'link' => 'curso_eng_civil.php',
        'duracao' => '10 semestres',
        'turno' => 'Integral'
    ],
    [
        'imagem' => 'imagens/eng_mec.png',
        'titulo' => 'Engenharia Mecânica',
        'descricao' => 'Engenharia Mecânica com ênfase em projetos e manufatura',
        'link' => 'curso_eng_mecanica.php',
        'duracao' => '10 semestres',
        'turno' => 'Integral'
    ],
    [
        'imagem' => 'imagens/eng_produ.jpg',
        'titulo' => 'Engenharia de Produção',
        'descricao' => 'Engenharia de Produção e Gestão Industrial',
        'link' => 'curso_eng_producao.php',
        'duracao' => '10 semestres',
        'turno' => 'Noturno'
    ],
    [
        'imagem' => 'imagens/medicina.jpg',
        'titulo' => 'Medicina',
        'descricao' => 'Curso de Medicina com formação generalista e humanista',
        'link' => 'curso_medicina.php',
        'duracao' => '12 semestres',
        'turno' => 'Integral'
    ]
];
?>

<section class="page-header">
    <div class="container">
        <h1>Cursos de Graduação</h1>
        <p>Conheça nossa oferta de cursos de graduação e encontre sua vocação</p>
    </div>
</section>

<section class="cursos-graduacao">
    <div class="container">
        <!-- Grid de Cursos -->
        <div class="cursos-grid">
            <?php foreach($cursos as $curso): ?>
            <div class="curso-card">
                <a href="<?php echo $curso['link']; ?>" class="curso-link">
                    <div class="curso-imagem">
                        <img src="<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['titulo']; ?>">
                        <div class="curso-overlay">
                            <span class="saiba-mais">Ver detalhes →</span>
                        </div>
                    </div>
                    <div class="curso-info">
                        <h3><?php echo $curso['titulo']; ?></h3>
                        <p class="curso-descricao"><?php echo $curso['descricao']; ?></p>
                        <div class="curso-detalhes">
                            <span class="curso-duracao">⏱️ <?php echo $curso['duracao']; ?></span>
                            <span class="curso-turno">🕒 <?php echo $curso['turno']; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Informações Adicionais -->
        <div class="info-cursos">
            <div class="info-card">
                <h3>🎓 Processo Seletivo</h3>
                <p>Ingresso através do Vestibular UFSS e SISU. Inscrições abertas semestralmente.</p>
                <a href="vestibular.php" class="btn">Saiba Mais</a>
            </div>
            <div class="info-card">
                <h3>💼 Estágios e Empregabilidade</h3>
                <p>Parcerias com empresas locais e nacionais para estágios e colocação profissional.</p>
                <a href="estagios.php" class="btn">Ver Oportunidades</a>
            </div>
            <div class="info-card">
                <h3>🏫 Infraestrutura</h3>
                <p>Laboratórios modernos, biblioteca atualizada e espaços de convivência.</p>
                <a href="campus.php" class="btn">Conhecer Campus</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>