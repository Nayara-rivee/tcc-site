<?php
require_once '../database/auth.php';
require_once '../database/config.php';

if (!estaLogado()) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];

// --- Consultas SQL (Inalteradas, pois já estavam corretas) ---

$stmtMeusServicos = $pdo->prepare('SELECT s.*, ts.nome_tipo, ts.valor FROM servico s JOIN tipos_servico ts ON s.tipo_servico_id = ts.id WHERE s.usuario_id = :usuario_id');
$stmtMeusServicos->execute([
    ':usuario_id' => $usuario_id
]);

$stmtTotalServicos = $pdo->prepare('SELECT COUNT(*) FROM servico WHERE usuario_id = :usuario_id ');
$stmtTotalServicos->execute([
    ':usuario_id' => $usuario_id
]);

$stmtTotalServicosEmAndamento = $pdo->prepare('SELECT COUNT(*) FROM servico WHERE status = :status AND usuario_id = :usuario_id');
$stmtTotalServicosEmAndamento->execute([
    ':status' => 'Em Andamento',
    ':usuario_id' => $usuario_id
]);

$stmtTotalServicosConcluidos = $pdo->prepare('SELECT COUNT(*) FROM servico WHERE status = :status AND usuario_id = :usuario_id');
$stmtTotalServicosConcluidos->execute([
    ':status' => 'Concluido',
    ':usuario_id' => $usuario_id
]);

$stmtTotalGastoEmServicos = $pdo->prepare('SELECT SUM(ts.valor) AS total_gasto FROM servico s JOIN tipos_servico ts ON s.tipo_servico_id = ts.id WHERE s.usuario_id = :usuario_id');
$stmtTotalGastoEmServicos->execute([
    ':usuario_id' => $usuario_id
]);

$stmtComentarios = $pdo->prepare('SELECT c.*, u.nome AS nome_autor FROM comentarios c JOIN servico s ON c.servico_id = s.id JOIN usuarios u ON c.usuario_id = u.id WHERE s.usuario_id = :usuario_id ORDER BY c.data_criacao DESC');
$stmtComentarios->execute([
    ':usuario_id' => $usuario_id
]);

$stmtAtividadesRecentesTituloDosComentarios = $pdo->prepare('SELECT c.titulo_comentario, data_criacao FROM comentarios c JOIN servico s ON c.servico_id = s.id WHERE s.usuario_id = :usuario_id AND c.data_criacao >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY c.data_criacao DESC LIMIT 10');
$stmtAtividadesRecentesTituloDosComentarios->execute([
    ':usuario_id' => $usuario_id
]);

// Consulta do caminho da foto
$stmtCaminhoFoto = $pdo->prepare('SELECT caminho_foto FROM usuarios WHERE id = :usuario_id');
$stmtCaminhoFoto->execute([
    ':usuario_id' => $usuario_id
]);

$meusServicos = $stmtMeusServicos->fetchAll(PDO::FETCH_ASSOC);
$totalServicos = $stmtTotalServicos->fetchColumn();
$TotalServicosEmAndamento = $stmtTotalServicosEmAndamento->fetchColumn();
$TotalServicosConcluidos = $stmtTotalServicosConcluidos->fetchColumn();
$TotalGasto = $stmtTotalGastoEmServicos->fetchColumn();
$comentariosDoServico = $stmtComentarios->fetchAll(PDO::FETCH_ASSOC);
$titulosRecentes = $stmtAtividadesRecentesTituloDosComentarios->fetchAll(PDO::FETCH_ASSOC);
$caminhoFoto = $stmtCaminhoFoto->fetchColumn();

// --- NOVO: Tratamento de Status de Upload ---
$upload_mensagem = '';
$upload_class = '';
if (isset($_GET['upload_status']) && isset($_GET['upload_msg'])) {
    $upload_mensagem = htmlspecialchars($_GET['upload_msg']);
    $upload_class = ($_GET['upload_status'] == 'sucesso') ? 'upload-success' : 'upload-error';
}
// --- FIM NOVO ---

$TotalGastoFormatado = number_format($TotalGasto ?? 0, 2 , ',', '.');
$dataCriacao = new DateTime($_SESSION['usuario']['data_criacao']);
$meses = array(
    'January' => 'janeiro',
    'February' => 'fevereiro',
    'March' => 'março',
    'April' => 'abril',
    'May' => 'maio',
    'June' => 'junho',
    'July' => 'julho',
    'August' => 'agosto',
    'September' => 'setembro',
    'October' => 'outubro',
    'November' => 'novembro',
    'December' => 'dezembro'
);

$mes = $dataCriacao->format('F');
$mes_pt = $meses[$mes];

function formatarTempoPassado($data_criacao) {
    $agora = new DateTime();
    $data_atividade = new DateTime($data_criacao);
    $intervalo = $agora->diff($data_atividade);

    if ($intervalo->y > 0) {
        return 'Há ' . $intervalo->y . ' ano(s)';
    } elseif ($intervalo->m > 0) {
        return 'Há ' . $intervalo->m . ' mês(es)';
    } elseif ($intervalo->d > 0) {
        return 'Há ' . $intervalo->d . ' dia(s)';
    } elseif ($intervalo->h > 0) {
        return 'Há ' . $intervalo->h . ' hora(s)';
    } elseif ($intervalo->i > 0) {
        return 'Há ' . $intervalo->i . ' minuto(s)';
    } else {
        return 'Agora mesmo';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário - Aurora IT</title>
    <link rel="stylesheet" href="../css/css-pages/perfilUsuario.css">
    <link rel="shortcut icon" href="../img/favicon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="floating-elements">
        <div class="floating-element" style="left: 10%; width: 60px; height: 60px; animation-delay: -2s;"></div>
        <div class="floating-element" style="left: 70%; width: 80px; height: 80px; animation-delay: -8s;"></div>
        <div class="floating-element" style="left: 40%; width: 40px; height: 40px; animation-delay: -15s;"></div>
    </div>

    <div class="container">
        <div class="header">
            <a href="../../index.php" class="btn-voltar">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>

            <?php if (!empty($upload_mensagem)): ?>
                <div class="upload-alert <?= $upload_class; ?>">
                    <?= $upload_mensagem; ?>
                </div>
            <?php endif; ?>
            <div class="profile-section">

                <form id="form-upload-foto" action="../database/upload_foto_perfil.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="foto_perfil" id="foto-perfil-input" accept="image/png, image/jpeg, image/webp" style="display: none;">
                    
                    <label for="foto-perfil-input" class="profile-avatar profile-clickable" title="Clique para trocar a foto de perfil">
                        <?php if($caminhoFoto):?>
                            <img src="../../<?= htmlspecialchars($caminhoFoto);?>" alt="Foto de Perfil">
                        <?php else:?>
                            <?= htmlspecialchars(strtoupper(substr($_SESSION['usuario']['nome'] ?? '' , 0, 2)));?>
                        <?php endif;?>
                    </label>
                </form>
                <div class="profile-info">
                    <h1><?= htmlspecialchars($_SESSION['usuario']['nome'])?></h1>
                    <p><?= htmlspecialchars($_SESSION['usuario']['email'])?></p>
                    <p><?= htmlspecialchars($_SESSION['usuario']['numero'])?></p>
                    <p> Membro desde:
                        <?= 
                            $dataCriacao->format('d \d\e ') . $mes_pt . $dataCriacao->format(' \d\e Y')
                        ?>
                    </p>
                    <a class="btn-sair" href="../database/logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i> Sair da Conta
                    </a>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-card">
                    <span class="stat-number"><?= $totalServicos ?></span>
                    <span class="stat-label">Projetos Totais</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">
                        <?=$TotalServicosEmAndamento?>
                    </span>
                    <span class="stat-label">Em Andamento</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number"><?= $TotalServicosConcluidos?></span>
                    <span class="stat-label">Concluídos</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">R$
                        <?=$TotalGastoFormatado?>
                    </span>
                    <span class="stat-label">Investimento Total</span>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="services-section">
                <h2 class="section-title">Meus Serviços</h2>

                <div class="services-grid">
                    <?php foreach ($meusServicos as $servico):?>
                    <div class="service-card">
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon">🚀</div>
                                <span><?= $servico['nome_tipo']?></span>
                            </div>

                            <?php if($servico['status'] === 'Em Andamento'):?>
                            <span class="status-badge status-in-progress">
                                <?= $servico['status']?>
                            </span>
                            <?php elseif($servico['status'] ==='Concluido'):?>
                            <span class="status-badge status-completed">
                                <?= $servico['status']?>
                            </span>
                            <?php endif?>


                        </div>
                        <div class="service-details">
                            <?php
                                $comentariosDoServicoEncontrados = false;
                                $comentariosParaEsteServico = array_filter($comentariosDoServico, function($c) use ($servico) {
                                    return $c['servico_id'] === $servico['id'];
                                });

                                if (!empty($comentariosParaEsteServico)):
                                    $comentariosDoServicoEncontrados = true;
                                        
                                    $primeiroComentario = array_shift($comentariosParaEsteServico);
                                ?>
                            <div class="comentario">
                                <strong>Comentário feito por:
                                    <?= htmlspecialchars($primeiroComentario['nome_autor']) ?></strong>
                                <p><?= nl2br(htmlspecialchars($primeiroComentario['titulo_comentario'])) ?></p>
                                <p><?= nl2br(htmlspecialchars($primeiroComentario['comentario'])) ?></p>
                                <small>Criado em:
                                    <?= formatarTempoPassado($primeiroComentario['data_criacao']) ?></small>
                            </div>
                            <hr>

                            <?php if (!empty($comentariosParaEsteServico)): ?>
                            <div id="comentarios-adicionais-<?= $servico['id'] ?>" class="comentarios-adicionais">
                                <?php foreach ($comentariosParaEsteServico as $comentario): ?>
                                <div class="comentario comentario-oculto">
                                    <strong>Comentário feito por:
                                        <?= htmlspecialchars($comentario['nome_autor']) ?></strong>
                                    <p><?= nl2br(htmlspecialchars($comentario['titulo_comentario'])) ?></p>
                                    <p><?= nl2br(htmlspecialchars($comentario['comentario'])) ?></p>
                                    <small>Criado em:
                                        <?= formatarTempoPassado($comentario['data_criacao']) ?></small>
                                </div>
                                <hr>
                                <?php endforeach; ?>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary btn-ver-mais"
                                data-servico-id="<?= $servico['id'] ?>">Ver todos os comentários</button>
                            <?php endif; ?>
                            <?php else: ?>
                            <p>Nenhum comentário para este serviço.</p>
                            <?php endif; ?>
                        </div>
                        <div class="service-progress">
                            <div class="progress-label">
                                <span>Progresso: 75%</span>
                                <span>Entrega: <?= $servico['data_termino']?></span>

                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="service-actions">
                            <button class="btn btn-primary">📋 Ver Detalhes</button>

                        </div>
                    </div>
                    <?php endforeach?>

                </div>
            </div>

            <div class="sidebar">
                <div class="sidebar-card">
                    <h3 class="section-title">Ações Rápidas</h3>
                    <div class="quick-actions">
                        <a href="../../src/pages/faleconosco.php" class="action-btn">
                            <span>➕</span> Novo Projeto
                        </a>

                        <a href="../database/exportar_servicos.php" class="action-btn"
                            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <span>📊</span> Exportar CSV
                        </a>
                    </div>
                </div>

                <div class="sidebar-card">
                    <h3 class="section-title">Atividades Recentes</h3>
                    <div class="recent-activity">
                        <?php foreach($titulosRecentes as $titulo):?>
                        <div class="activity-item">
                            <div class="activity-icon">✅</div>
                            <div class="activity-content">
                                <div class="activity-title"><?= htmlspecialchars($titulo['titulo_comentario']) ?>
                                </div>
                                <div class="activity-time"><?= formatarTempoPassado($titulo['data_criacao']) ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('foto-perfil-input');
            const form = document.getElementById('form-upload-foto');

            // Ao selecionar um arquivo, o formulário é enviado automaticamente
            if (fileInput && form) {
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        form.submit();
                    }
                });
            }

            // Script original para comentários (se houver)
            // Lógica para 'Ver todos os comentários' (se estiver no seu perfilUsuarios.js)
            document.querySelectorAll('.btn-ver-mais').forEach(button => {
                button.addEventListener('click', function() {
                    const servicoId = this.dataset.servicoId;
                    const comentariosAdicionais = document.getElementById(`comentarios-adicionais-${servicoId}`);
                    
                    if (comentariosAdicionais) {
                        const comentariosOcultos = comentariosAdicionais.querySelectorAll('.comentario-oculto');
                        comentariosOcultos.forEach(comentario => {
                            comentario.classList.remove('comentario-oculto');
                        });
                        this.style.display = 'none'; // Esconde o botão após expandir
                    }
                });
            });

        });
    </script>
    <script src="../js/perfilUsuarios.js"></script>
</body>

</html>