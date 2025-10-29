<?php
require_once '../database/auth.php';
require_once '../database/config.php';

if (!estaLogado()) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$nivel = $_SESSION['usuario']['nivel'];

if ($nivel == 1) {
    $stmtUsuarios = $pdo->prepare('SELECT id, nome, email, numero, nivel, rg, cpf, genero, data_criacao FROM usuarios ORDER BY nome ASC');
    $stmtUsuarios->execute();
    $usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);


    // Consulta para pegar a quantidade total de usuários
    $stmtTotalUsuarios = $pdo->prepare('SELECT COUNT(*) FROM usuarios');
    $stmtTotalUsuarios->execute();
    $totalUsuarios = $stmtTotalUsuarios->fetchColumn();

    // Consulta para pegar a quantidade total de serviços concluídos
    $stmtServicosConcluidos = $pdo->prepare('SELECT COUNT(*) FROM servico WHERE status = "Concluído"');
    $stmtServicosConcluidos->execute();
    $totalServicosConcluidos = $stmtServicosConcluidos->fetchColumn();

    // Consulta para pegar a quantidade total de serviços em andamento
    $stmtServicosPendentes = $pdo->prepare('SELECT COUNT(*) FROM servico WHERE status = "Em Andamento"');
    $stmtServicosPendentes->execute();
    $totalServicosPendentes = $stmtServicosPendentes->fetchColumn();

    // Consulta para pegar o valor total dos serviços concluídos
    $stmtDinheiroConcluidos = $pdo->prepare('SELECT SUM(ts.valor) AS total_dinheiro FROM servico s JOIN tipos_servico ts ON s.tipo_servico_id = ts.id WHERE s.status = "Concluído"');
    $stmtDinheiroConcluidos->execute();
    $totalDinheiroConcluidos = $stmtDinheiroConcluidos->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon/favicon.png" type="image/x-icon">

    <!-- BOXICON  -->
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <!--Bootstrap-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/css-globais/navbar.css">

    <link rel="stylesheet" href="../css/css-pages/perfil.css">
    <link rel="stylesheet" href="../css/css-pages/configuracaoPerfil.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- BOXICON  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <title>Aurorability | Perfil</title>
</head>


<body>
    <!-- libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <!-- end libras -->
    <button id="accessibility-toggle-btn" class="floating-btn" aria-expanded="false" aria-controls="accessibility-panel" aria-label="Abrir Menu de Acessibilidade">
        <i class="bi bi-universal-access-circle"></i> Acessibilidade
    </button>

    <div id="accessibility-panel" class="panel hidden" role="dialog" aria-modal="false" aria-labelledby="panel-title">
        <h3 id="panel-title" class="panel-title">Menu de Acessibilidade</h3>
        <button id="close-panel-btn" class="close-panel-btn" aria-label="Fechar Painel">
            <i class="bi bi-x-lg"></i>
        </button>

        <h4 class="control-section-title">Controle de Fonte</h4>
        <div class="control-group">
            <button class="control-btn" data-action="increase-font" aria-label="Aumentar Tamanho da Fonte">
                <i class="bi bi-fonts"></i><span>Tamanho de fonte (A+)</span>
            </button>
            <button class="control-btn" data-action="decrease-font" aria-label="Diminuir Tamanho da Fonte">
                <i class="bi bi-fonts"></i><span>Tamanho de fonte (A-)</span>
            </button>
            <button class="control-btn" data-action="increase-line-height" aria-label="Aumentar Espaço entre Linhas">
                <i class="bi bi-text-height"></i><span>Espaço entre linhas (+)</span>
            </button>
            <button class="control-btn" data-action="decrease-line-height" aria-label="Diminuir Espaço entre Linhas">
                <i class="bi bi-text-height"></i><span>Espaço entre linhas (-)</span>
            </button>
            <button class="control-btn" data-action="increase-letter-spacing" aria-label="Aumentar Espaço entre Letras">
                <i class="bi bi-text-spacing"></i><span>Espaço entre letras (+)</span>
            </button>
            <button class="control-btn" data-action="decrease-letter-spacing" aria-label="Diminuir Espaço entre Letras">
                <i class="bi bi-text-spacing"></i><span>Espaço entre letras (-)</span>
            </button>
        </div>

        <h4 class="control-section-title">Controle de cor</h4>
        <div class="control-group">
            <button class="control-btn" data-action="toggle-contrast" aria-label="Contraste de cores (Alto Contraste)">
                <i class="bi bi-circle-half"></i><span>Contraste de cores</span>
            </button>
            <button class="control-btn" data-action="colorblind-protanopia" aria-label="Simulação de Protanopia">
                <i class="bi bi-palette"></i><span>Protanopia (Vermelho)</span>
            </button>
            <button class="control-btn" data-action="colorblind-deuteranopia" aria-label="Simulação de Deuteranopia">
                <i class="bi bi-palette"></i><span>Deuteranopia (Verde)</span>
            </button>
            <button class="control-btn" data-action="colorblind-tritanopia" aria-label="Simulação de Tritanopia">
                <i class="bi bi-palette"></i><span>Tritanopia (Azul)</span>
            </button>
        </div>

        <button id="restore-btn" class="restore-btn" aria-label="Restaurar todas as configurações de acessibilidade">
            <i class="bi bi-arrow-clockwise me-1"></i>Restaurar recursos
        </button>
    </div>

    <a href="https://wa.me/5511974557734" target="_blank" class="position-fixed bottom-0 end-0 m-3 whatsapp"
        style="z-index: 22222;">
        <img src="../img/logo/whatsapp.png" alt="WhatsApp" class="img-fluid rounded-circle shadow whatsapp-hover"
            style="width: clamp(60px, 10vw, 70px); height: auto;">
    </a>


    <div id="content-wrapper" class="main-content-wrapper">


        <!-- Modal para Agendar Consulta -->
        <div class="modal fade" id="modalAgendarServico" tabindex="-1" aria-labelledby="modalAgendarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgendarLabel"><i class="fas fa-plus me-2"></i>Agendar Servico</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgendamento" method="post" action="../database/criarServico.php">
                            <div class="mb-3">
                                <label for="tipoServico-agendar" class="form-label">Tipo de Servico</label>
                                <select class="form-select" name="tipoServicoId" id="tipoServico-agendar" required>
                                    <option value="">Selecione uma opção</option>
                                    <option value="1">Plano Básico</option>
                                    <option value="2">Plano Intermediário</option>
                                    <option value="3">Plano Avançado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dataTermino-agendar" class="form-label">Data Término</label>
                                <input type="datetime-local" class="form-control" name="dataTermino" id="dataTermino-agendar"
                                    required>
                            </div>

                            <input type="hidden" name="usuario_id" id="usuarioSelecionadoId-agendar">
                            <button type="submit" class="btn btn-vinho w-100">
                                <i class="fas fa-check me-1"></i> Confirmar Agendamento
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Agendar Consulta -->
        <div class="modal fade" id="modalEditarServico" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel"><i class="fas fa-plus me-2"></i>Agendar Servico</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarAgendamento" method="post" action="../database/editarServico.php">
                            <div class="mb-3">
                                <label for="tipoServico-editar" class="form-label">Edite este Servico:</label>
                                <select class="form-select" name="tipoServicoId" id="tipoServico-editar" required>
                                    <option value="">Selecione uma opção</option>
                                    <option value="1">Plano Básico</option>
                                    <option value="2">Plano Intermediário</option>
                                    <option value="3">Plano Avançado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dataTermino-editar" class="form-label">Data Término</label>
                                <input type="datetime-local" class="form-control" name="dataTermino" id="dataTermino-editar"
                                    required>
                            </div>

                            <input type="hidden" name="usuario_id" id="usuarioSelecionadoId-editar">
                            <button type="submit" class="btn btn-vinho w-100">
                                <i class="fas fa-check me-1"></i> Confirmar Edição
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Adicionar Comentários -->
        <div class="modal fade" id="modalAdicionarComentario" tabindex="-1" aria-labelledby="modalAdicionarComentarioLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAdicionarComentarioLabel"><i class="fas fa-plus me-2"></i>Adicionar
                            Comentários Do Projeto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAdicionarComentario" method="post">
                            <div class="mb-3">
                                <label for="Comentario" class="form-label">Adicione o Título do Projeto:</label>
                                <input type="text" class="form-control" name="tituloComentario" id="tituloComentario" rows="4"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="Comentario" class="form-label">Adicione um Comentário ao Projeto:</label>
                                <textarea class="form-control" name="comentario" id="comentario" rows="4" required></textarea>
                            </div>

                            <input type="hidden" name="servico_id" id="servicoIdComentario">
                            <input type="hidden" name="usuario_id" id="usuarioIdComentario">

                            <button type="submit" class="btn btn-vinho w-100">
                                <i class="fas fa-check me-1"></i> Confirmar Comentário
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!---->
        <section class="container-fluid mt-4">
            <div class="d-flex rounded">
                <!-- Sidebar -->
                <aside class="bg-primary text-white p-3 d-flex flex-column rounded-start col-5 col-md-3 col-lg-2">
                    <div class="d-flex align-items-center mb-4">
                        <img src="../img/favicon/favicon.png" alt="Logo Aurora" width="30" class="me-2">
                        <span class="fw-bold fs-5">Aurora</span>
                    </div>
                    <!-- Navegação -->
                    <nav class="nav flex-column">
                        <a class="nav-link text-white active bg-white bg-opacity-25 rounded mb-2" href="../../index.php">
                            <i class="bxr bx-home me-2"></i> Voltar
                        </a>
                        <a class="nav-link text-white rounded mb-2" id="linkConfiguracao" href="#">
                            <i class="bxr bx-cog me-2"></i> Configurações
                        </a>

                        <a class="nav-link text-white rounded mb-2 d-none" id="linkDashboard" href="#">
                            <i class="bxr  bx-dashboard-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link text-white bg-danger bg-opacity-25 rounded mt-auto"
                            href="../database/logout.php">
                            <i class="bxr bx-arrow-out-up-square-half me-2"></i> Sair da Conta
                        </a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <main class="flex-grow-1 bg-white p-4 rounded-end col-12 col-md-9 col-lg-10" id="dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="fs-3 fw-semibold">Dashboard</h1>
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Procurar Usuário"
                                aria-label="Search" id="searchUsuario">
                            <div class=" text-center ">
                                <button class="btn btn-vinho ms-1 btn-secondary d-none" id="btnAgendarServico"
                                    style="width: 150px;" onclick="agendarServico();">
                                    <i class="fas fa-calendar-plus me-2"></i>Agendar
                                    Serviço
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php if ($nivel == 1): ?>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <span class="stat-number"><?= $totalUsuarios ?? 0 ?></span>
                                <span class="stat-label">Usuários Totais</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number"><?= $totalServicosConcluidos ?? 0 ?></span>
                                <span class="stat-label">Concluídos</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number"><?= $totalServicosPendentes ?? 0 ?></span>
                                <span class="stat-label">Em Andamento</span>
                            </div>

                            <div class="stat-card">
                                <span class="stat-number">
                                    R$ <?= number_format($totalDinheiroConcluidos ?? 0, 2, ',', '.') ?>
                                </span>
                                <span class="stat-label">Total Recebido</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Numero</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Gênero</th>
                                        <th>Membro desde</th>
                                        <th>Nível</th>
                                    </tr>
                                </thead>
                                <tbody class="usuarios">
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <tr class="btn-usuario" data-id="<?= $usuario['id'] ?>" style="cursor: pointer;">
                                            <td>
                                                <?= htmlspecialchars($usuario['nome']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($usuario['email']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($usuario['numero'] ?? 'Não informado') ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($usuario['cpf']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($usuario['rg']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($usuario['genero']) ?>
                                            </td>
                                            <td>
                                                <?php
                                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                                date_default_timezone_set('America/Sao_Paulo');
                                                $data = new DateTime($usuario['data_criacao']);
                                                $formatter = new IntlDateFormatter(
                                                    'pt_BR',
                                                    IntlDateFormatter::LONG,
                                                    IntlDateFormatter::NONE
                                                );
                                                echo $formatter->format($data);
                                                ?>
                                            </td>
                                            <td><span class="badge bg-success"> <?= htmlspecialchars($usuario['nivel']) ?></span>
                                            </td>

                                        </tr>


                                    <?php endforeach ?>

                                </tbody>

                            </table>
                            <div id="servicosUsuario" class="d-none"></div>
                        </div>
                    <?php endif; ?>
                </main>

                <div class="flex-grow-1 bg-light p-4 rounded-end col-12 col-md-9 col-lg-10 d-none" id="configuracoes">
                    <h1 class="fs-3 fw-semibold mb-4">Configurações da Conta</h1>

                    <div class="config-card">
                        <h2 class="config-card-title">
                            <i class="fas fa-user-edit"></i>
                            Dados Pessoais
                        </h2>
                        <form method="post" action="../database/alterarDadosPessoais.php" id="formDadosPessoais">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="configNome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="configNome" name="nome">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="configEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="configEmail">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="configNumero" class="form-label">Número</label>
                                    <input type="tel" class="form-control" name="numero" id="configNumero">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-salvar mt-2">
                                <i class="fas fa-save"></i>
                                Salvar Alterações
                            </button>
                        </form>
                    </div>

                    <div class="config-card">
                        <h2 class="config-card-title">
                            <i class="fas fa-shield-alt"></i>
                            Alterar Senha
                        </h2>
                        <form method="post" id="formAlterarSenha" action="../database/alterarSenha.php">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="configSenhaAtual" class="form-label">Senha Atual</label>
                                    <input type="password" class="form-control" name="senha_atual" id="configSenhaAtual"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="configNovaSenha" class="form-label">Nova Senha</label>
                                    <input type="password" class="form-control" name="nova_senha" id="configNovaSenha"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="configConfirmarSenha" class="form-label">Confirmar Nova Senha</label>
                                    <input type="password" class="form-control" name="confirmar_senha"
                                        id="configConfirmarSenha" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-salvar mt-2">
                                <i class="fas fa-key"></i>
                                Alterar Senha
                            </button>
                        </form>
                    </div>
                </div>

        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script>
        const searchInput = document.getElementById('searchUsuario');
        const tabelaUsuarios = document.querySelector('.usuarios');
        const tabelaUsuariosContainer = document.querySelector('.table-responsive');
        const btnAgendarServico = document.getElementById('btnAgendarServico');
        const servicosUsuarioContainer = document.getElementById('servicosUsuario');
        const cabecalhoTabelaUsuarios = document.querySelector('.table-light')
        const linkConfiguracao = document.querySelector('#linkConfiguracao');
        const configuracao = document.querySelector('#configuracoes');
        const linkDashboard = document.querySelector('#linkDashboard');
        const Dashboard = document.querySelector('#dashboard');


        // Variável para armazenar todos os usuários inicialmente carregados
        let todosUsuarios = [];
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($nivel == 1 && isset($usuarios)): ?>
                todosUsuarios = <?= json_encode($usuarios) ?>;
                renderUsuarios(todosUsuarios);
            <?php endif; ?>

            adicionarListenersBotoesUsuario();

            linkConfiguracao.addEventListener('click', mostrarConfiguracao);
            linkDashboard.addEventListener('click', mostrarDashboard);
        });

        function mostrarConfiguracao() {
            dashboard.style.display = 'none';
            linkConfiguracao.style.display = 'none';

            linkDashboard.classList.remove('d-none');
            configuracao.classList.remove('d-none')
        }

        function mostrarDashboard() {
            dashboard.style.display = 'block';
            linkConfiguracao.style.display = 'block';
            linkDashboard.classList.add('d-none');
        }

        function adicionarListenersBotoesUsuario() {
            document.querySelectorAll('.btn-usuario').forEach(btn => {
                btn.addEventListener('click', selecionarUsuario);
            });
        }


        function renderUsuarios(usuarios) {
            let html = '';
            if (usuarios.length > 0) {
                usuarios.forEach(usuario => {
                    // Formata a data corretamente
                    const data = new Date(usuario.data_criacao);
                    const dataFormatada = data.toLocaleDateString('pt-BR', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });

                    const cpfDisplay = usuario.cpf ? usuario.cpf : 'N/A';
                    const rgDisplay = usuario.rg ? usuario.rg : 'N/A';
                    const generoDisplay = usuario.genero ? usuario.genero : 'N/A';

                    html += `
                <tr class="btn-usuario" data-id="${usuario.id}" style="cursor: pointer;">
                <td>${usuario.nome}</td>
                <td>${usuario.email}</td>
                <td>${usuario.numero}</td>
                <td>${cpfDisplay}</td>
                <td>${rgDisplay}</td>
                <td>${generoDisplay}</td>
                <td>${dataFormatada}</td>
                <td><span class="badge bg-success">${usuario.nivel}</span></td>
            </tr>
                `;
                });
            } else {
                html = `
            <tr>
                <td colspan="8" class="text-center">Nenhum usuário encontrado.</td>
            </tr>
            `;
            }
            tabelaUsuarios.innerHTML = html;
            adicionarListenersBotoesUsuario();
        }

        function filtrarUsuarios(termo) {
            termo = termo.toLowerCase().trim();

            if (termo === '') {
                renderUsuarios(todosUsuarios);
                return;
            }

            const usuariosFiltrados = todosUsuarios.filter(usuario => {
                return (
                    usuario.nome.toLowerCase().includes(termo) ||
                    usuario.email.toLowerCase().includes(termo) ||
                    usuario.nivel.toString().includes(termo) ||
                    usuario.genero.toLowerCase().includes(termo) ||
                    usuario.numero.toString().includes(termo) ||
                    usuario.rg.toString().includes(termo) ||
                    usuario.cpf.toString().includes(termo)
                );
            });

            renderUsuarios(usuariosFiltrados);
        }

        // Debounce para melhorar performance
        let debounceTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimeout);
            const termo = this.value;
            debounceTimeout = setTimeout(() => {
                filtrarUsuarios(termo);
            }, 300);
        });

        function selecionarUsuario() {

            btnAgendarServico.classList.remove('d-none');
            tabelaUsuarios.classList.add('d-none');
            cabecalhoTabelaUsuarios.classList.add('d-none')

            const userId = this.getAttribute('data-id');
            document.getElementById('usuarioSelecionadoId-agendar').value = userId;

            fetch(`../database/getServicos.php?id=${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na resposta da rede: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    let html = '';
                    if (data.length > 0) {
                        html += `
                    <div class="alert alert-info">
                        <span class="fw-bold">Serviços Pendentes:</span> Veja os serviços em andamento para este usuário!
                        <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar"> Voltar</i>
                    </div>
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tipo de Serviço</th>
                                <th>Data de Início</th>
                                <th>Data de Término</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>  
                            </tr>
                        </thead>
                    <tbody>
                    `;
                        data.forEach(servico => {
                            html += `
                        <tr>
                            <td>${servico.nome_tipo}</td>
                            <td>${servico.data_inicio}</td>
                            <td>${servico.data_termino}</td>
                            <td>R$ ${parseFloat(servico.valor).toFixed(2).replace('.', ',')}</td>
                            <td style="display:flex; gap:10px;">
                            <select class="form-select">
                                <option value="Em Andamento" ${servico.status === 'Em Andamento' ? 'selected' : ''}>Em Andamento</option>
                                <option value="Concluído" ${servico.status === 'Concluído' ? 'selected' : ''}>Concluído</option>
                                <option value="Cancelado" ${servico.status === 'Cancelado' ? 'selected' : ''}>Cancelado</option>
                            </select>
                             <button class="btn btn-sm btn-outline-primary" onclick="salvarStatus(this)" data-servico-id="${servico.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy me-1" viewBox="0 0 16 16">
                                    <path d="M11 2H9v3h2z"/>
                                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                                </svg>
                            </button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" onclick="remarcarServico(${servico.id})">
                                    <i class="fas fa-edit me-1"></i> Remarcar
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="cancelarServico(${servico.id})">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </button>
                                <button class="btn btn-sm btn-outline-primary" onclick="prepararModalComentario(${servico.id})">
                                    <i class="fas fa-times me-1"></i> Adicionar Comentário
                                </button>
                            </td>
                        </tr>
                        `;
                        });
                        html += ` 
                        </tbody>
                    </table>
                    `;
                    } else {
                        html = `
                    <div class="alert alert-warning" id="avisoConsulta">
                        Nenhum Serviço Agendado Encontrado!
                    </div>
                    <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                    `;
                    }

                    servicosUsuarioContainer.innerHTML = html;
                    servicosUsuarioContainer.classList.remove('d-none');

                    document.getElementById('voltar').addEventListener('click', () => {
                        servicosUsuarioContainer.classList.add('d-none');
                        tabelaUsuarios.classList.remove('d-none');
                        btnAgendarServico.classList.add('d-none');
                        cabecalhoTabelaUsuarios.classList.remove('d-none')
                        searchInput.value = ''; // Limpa a pesquisa ao voltar
                        filtrarUsuarios(''); // Mostra todos os usuários novamente
                    });
                })
                .catch(error => {
                    console.error('Erro ao buscar serviços:', error);
                    servicosUsuarioContainer.innerHTML = `
                <div class="alert alert-danger">
                    Ocorreu um erro ao carregar os serviços.
                    <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                </div>
                `;
                    servicosUsuarioContainer.classList.remove('d-none');

                    document.getElementById('voltar').addEventListener('click', () => {
                        servicosUsuarioContainer.classList.add('d-none');
                        tabelaUsuarios.classList.remove('d-none');
                        btnAgendarServico.classList.add('d-none');
                    });
                });
        }

        function agendarServico() {
            const modal = new bootstrap.Modal(document.getElementById('modalAgendarServico'));
            modal.show();
        }

        function cancelarServico(id) {
            if (!confirm('Tem certeza que deseja cancelar este serviço?')) return;

            fetch('../database/cancelarServico.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Servico Cancelado com Sucesso.')
                        location.reload();
                    } else {
                        alert('Erro:' + (data.erro || 'Desconhecido'));
                    }
                })
                .catch(err => alert('Erro na requisição: ' + err));
        }

        function remarcarServico(servico) {
            const form = document.getElementById('formEditarAgendamento');
            let servicoIdInput = document.getElementById('id_servico_editar');
            if (!servicoIdInput) {
                servicoIdInput = document.createElement('input');
                servicoIdInput.type = 'hidden';
                servicoIdInput.name = 'id_servico';
                servicoIdInput.id = 'id_servico_editar';
                form.appendChild(servicoIdInput);
            }
            servicoIdInput.value = servico.id;
            document.getElementById('tipoServico-editar').value = servico.tipo_servico_id;
            const dataTermino = new Date(servico.data_termino);
            const dataFormatada = dataTermino.getFullYear() + '-' +
                ('0' + (dataTermino.getMonth() + 1)).slice(-2) + '-' +
                ('0' + dataTermino.getDate()).slice(-2) + 'T' +
                ('0' + dataTermino.getHours()).slice(-2) + ':' +
                ('0' + dataTermino.getMinutes()).slice(-2);
            document.getElementById('dataTermino-editar').value = dataFormatada;
            const modal = new bootstrap.Modal(document.getElementById('modalEditarServico'));
            modal.show();
        }

        function salvarStatus(buttonElement) {

            const servicoId = buttonElement.getAttribute('data-servico-id');
            const selectStatus = buttonElement.closest('td').querySelector('select');

            if (!selectStatus) {
                console.error('Erro: Elemento <select> não encontrado na mesma célula do botão.');
                alert('Erro interno: Não foi possível encontrar o seletor de status. Tente recarregar a página.');
                return;
            }
            const novoStatus = selectStatus.value;
            if (!confirm(`Deseja realmente atualizar o status do serviço ${servicoId} para "${novoStatus}"?`)) {
                return;
            }

            fetch('../database/salvarStatus.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${servicoId}&status=${novoStatus}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Status atualizado com sucesso.');
                        location.reload();
                    } else {
                        alert('Erro: ' + (data.erro || 'Desconhecido'));
                    }
                })
                .catch(err => {
                    console.error('Erro na requisição:', err);
                    alert('Erro na requisição: ' + err);
                });
        }

        function prepararModalComentario(servicoId) {
            const usuarioId = document.getElementById('usuarioSelecionadoId-agendar').value;

            document.getElementById('servicoIdComentario').value = servicoId;
            document.getElementById('usuarioIdComentario').value = usuarioId;

            const modal = new bootstrap.Modal(document.getElementById('modalAdicionarComentario'));
            modal.show();
        }

        document.getElementById('formAdicionarComentario').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const data = new URLSearchParams(formData).toString();

            fetch('../database/adicionarComentario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: data,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na resposta da rede: ' + response.statusText);
                    }
                    return response.json()
                })
                .then(result => {
                    if (result.sucesso) {
                        alert('Comentário adicionado com sucesso!');
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalAdicionarComentario'));
                        if (modal) {
                            modal.hide();
                        }
                    } else {
                        alert('Erro ao adicionar comentário.' + result.erro);
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                    alert('Ocorreu um erro. Tente novamente.')
                });
        });
    </script>
    <!-- JSs -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="../js/acessibilidade.js"></script>
</body>

</html>