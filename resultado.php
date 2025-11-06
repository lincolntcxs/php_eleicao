<?php
$pagina_titulo = "Resultados da Eleição";
include 'includes/config.php';
include 'includes/header.php';

$conn = conectarBanco();
$resultados_reitor = [];
$resultados_vice = [];

if ($conn) {
    try {
        // Contagem de votos para REITOR
        $sql_reitor = "SELECT reitor, COUNT(*) as total_votos 
                      FROM voto 
                      GROUP BY reitor 
                      ORDER BY total_votos DESC";
        $stmt_reitor = $conn->query($sql_reitor);
        $resultados_reitor = $stmt_reitor->fetchAll(PDO::FETCH_ASSOC);

        // Contagem de votos para VICE
        $sql_vice = "SELECT vice, COUNT(*) as total_votos 
                    FROM voto 
                    GROUP BY vice 
                    ORDER BY total_votos DESC";
        $stmt_vice = $conn->query($sql_vice);
        $resultados_vice = $stmt_vice->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        $erro = "Erro ao buscar resultados: " . $e->getMessage();
    }
}

// Preparar dados para os gráficos
function prepararDadosGrafico($resultados) {
    if (empty($resultados)) {
        return [
            'nomes' => ['Nenhum voto registrado'],
            'votos' => [1],
            'cores' => ['#cccccc']
        ];
    }

    $nomes = [];
    $votos = [];
    
    // Cores pré-definidas para o gráfico
    $cores = ['#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#84cc16', '#f97316'];
    
    // Se tiver mais de 4 candidatos, agrupa os menos votados como "Outros"
    if (count($resultados) > 4) {
        $principais = array_slice($resultados, 0, 3);
        $outros = array_slice($resultados, 3);
        
        $total_outros = 0;
        foreach ($outros as $candidato) {
            $total_outros += $candidato['total_votos'];
        }
        
        foreach ($principais as $candidato) {
            $nomes[] = $candidato['reitor'] ?? $candidato['vice'];
            $votos[] = $candidato['total_votos'];
        }
        
        if ($total_outros > 0) {
            $nomes[] = 'Outros';
            $votos[] = $total_outros;
        }
    } else {
        foreach ($resultados as $candidato) {
            $nomes[] = $candidato['reitor'] ?? $candidato['vice'];
            $votos[] = $candidato['total_votos'];
        }
    }
    
    return [
        'nomes' => $nomes,
        'votos' => $votos,
        'cores' => array_slice($cores, 0, count($nomes))
    ];
}

$dados_reitor = prepararDadosGrafico($resultados_reitor);
$dados_vice = prepararDadosGrafico($resultados_vice);

// Estatísticas gerais
$total_votos = 0;
foreach ($resultados_reitor as $voto) {
    $total_votos += $voto['total_votos'];
}
?>

<section class="page-header">
    <div class="container">
        <h1>Resultados da Eleição</h1>
        <p>Apuração em tempo real dos votos</p>
    </div>
</section>

<section class="resultados-eleicao">
    <div class="container">
        <?php if (isset($erro)): ?>
            <div class="alert error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <!-- Estatísticas Gerais -->
        <div class="estatisticas-gerais">
            <div class="estatistica-card">
                <div class="estatistica-numero"><?php echo $total_votos; ?></div>
                <div class="estatistica-label">Total de Votos</div>
            </div>
            <div class="estatistica-card">
                <div class="estatistica-numero"><?php echo count($resultados_reitor); ?></div>
                <div class="estatistica-label">Candidatos a Reitor</div>
            </div>
            <div class="estatistica-card">
                <div class="estatistica-numero"><?php echo count($resultados_vice); ?></div>
                <div class="estatistica-label">Candidatos a Vice</div>
            </div>
        </div>

        <!-- Gráfico Reitor -->
        <div class="grafico-section">
            <div class="grafico-card">
                <h2>🏛️ Votos para Reitor</h2>
                <div class="grafico-content">
                    <div class="grafico-wrapper">
                        <canvas id="graficoReitor" width="400" height="400"></canvas>
                    </div>
                    <div class="tabela-resultados">
                        <h3>Ranking Detalhado - Reitor</h3>
                        <table class="tabela">
                            <thead>
                                <tr>
                                    <th>Posição</th>
                                    <th>Candidato</th>
                                    <th>Votos</th>
                                    <th>Percentual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($resultados_reitor)): ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: #6b7280;">
                                            Nenhum voto registrado para reitor
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($resultados_reitor as $index => $candidato): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?>º</td>
                                        <td><?php echo htmlspecialchars($candidato['reitor']); ?></td>
                                        <td><?php echo $candidato['total_votos']; ?></td>
                                        <td>
                                            <?php 
                                            $percentual = $total_votos > 0 ? round(($candidato['total_votos'] / $total_votos) * 100, 1) : 0;
                                            echo $percentual . '%';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico Vice -->
        <div class="grafico-section">
            <div class="grafico-card">
                <h2>🎓 Votos para Vice-Reitor</h2>
                <div class="grafico-content">
                    <div class="grafico-wrapper">
                        <canvas id="graficoVice" width="400" height="400"></canvas>
                    </div>
                    <div class="tabela-resultados">
                        <h3>Ranking Detalhado - Vice-Reitor</h3>
                        <table class="tabela">
                            <thead>
                                <tr>
                                    <th>Posição</th>
                                    <th>Candidato</th>
                                    <th>Votos</th>
                                    <th>Percentual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($resultados_vice)): ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: #6b7280;">
                                            Nenhum voto registrado para vice-reitor
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($resultados_vice as $index => $candidato): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?>º</td>
                                        <td><?php echo htmlspecialchars($candidato['vice']); ?></td>
                                        <td><?php echo $candidato['total_votos']; ?></td>
                                        <td>
                                            <?php 
                                            $percentual = $total_votos > 0 ? round(($candidato['total_votos'] / $total_votos) * 100, 1) : 0;
                                            echo $percentual . '%';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="acoes">
            <a href="services.php" class="btn secondary">Voltar aos Serviços</a>
            <button onclick="window.print()" class="btn">Imprimir Resultados</button>
            <a href="votar.php" class="btn">Registrar Novo Voto</a>
        </div>
    </div>
</section>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Dados para os gráficos
const dadosReitor = {
    labels: <?php echo json_encode($dados_reitor['nomes']); ?>,
    datasets: [{
        data: <?php echo json_encode($dados_reitor['votos']); ?>,
        backgroundColor: <?php echo json_encode($dados_reitor['cores']); ?>,
        borderWidth: 2,
        borderColor: '#fff'
    }]
};

const dadosVice = {
    labels: <?php echo json_encode($dados_vice['nomes']); ?>,
    datasets: [{
        data: <?php echo json_encode($dados_vice['votos']); ?>,
        backgroundColor: <?php echo json_encode($dados_vice['cores']); ?>,
        borderWidth: 2,
        borderColor: '#fff'
    }]
};

// Configuração dos gráficos
const config = {
    type: 'pie',
    data: {},
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} votos (${percentage}%)`;
                    }
                }
            }
        }
    }
};

// Criar gráficos quando a página carregar
window.addEventListener('load', function() {
    // Gráfico Reitor
    const ctxReitor = document.getElementById('graficoReitor').getContext('2d');
    const graficoReitor = new Chart(ctxReitor, {
        ...config,
        data: dadosReitor
    });

    // Gráfico Vice
    const ctxVice = document.getElementById('graficoVice').getContext('2d');
    const graficoVice = new Chart(ctxVice, {
        ...config,
        data: dadosVice
    });
});
</script>

<?php include 'includes/footer.php'; ?>