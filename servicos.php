<?php 
$pagina_titulo = "Nossos Serviços";
include 'includes/header.php'; 

// Array de serviços com links específicos
$servicos = [
    [
        'icone' => 'fa fa-user-circle',
        'titulo' => 'Cadastrar Eleitor',
        'descricao' => 'Cadastra um novo eleitor',
        'link' => 'cadastrar_eleitor.php', // NOVO LINK
        'texto_botao' => 'Cadastrar Agora' // TEXTO DIFERENTE
    ],
    [
        'icone' => 'fa fa-university',
        'titulo' => 'Cadastrar Candidato',
        'descricao' => 'Cadastra um novo candidato', 
        'link' => 'cadastrar_candidato.php', // NOVO LINK
        'texto_botao' => 'Cadastrar Agora' // TEXTO DIFERENTE
    ],
    [
        'icone' => 'fa fa-users',
        'titulo' => 'Eleitores',
        'descricao' => 'Exibe lista de eleitores', 
        'link' => 'listar_eleitores.php', // NOVO LINK
        'texto_botao' => 'Ver Agora' // TEXTO DIFERENTE
    ],
    [
        'icone' => 'fa fa-users',
        'titulo' => 'Candidatos',
        'descricao' => 'Exibe lista de candidatos', 
        'link' => 'listar_candidatos.php', // NOVO LINK
        'texto_botao' => 'Ver Agora' // TEXTO DIFERENTE
    ],
    [
        'icone' => 'fa fa-graduation-cap',
        'titulo' => 'Votar',
        'descricao' => 'Vote em um reitor e vice',
        'link' => 'votar.php',
        'texto_botao' => 'Votar agora'
    ]
];
?>

<section class="page-header">
    <div class="container">
        <h1>Nossos Serviços</h1>
        <p>Soluções completas para seu negócio</p>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="services-grid">
            <?php foreach($servicos as $servico): ?>
            <div class="service-card">
                <i class="<?php echo $servico['icone']; ?>"></i>
                <h3><?php echo $servico['titulo']; ?></h3>
                <p><?php echo $servico['descricao']; ?></p>
                <a href="<?php echo $servico['link']; ?>" class="service-btn">
                    <?php echo $servico['texto_botao']; ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>