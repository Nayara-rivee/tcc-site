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
    $stmtUsuarios = $pdo->prepare('SELECT id, nome, email, nivel, rg, cpf, genero, data_criacao FROM usuarios ORDER BY nome ASC');
    $stmtUsuarios->execute();
    $usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
} 
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon/favicon.png" type="image/x-icon">

    <!--Bootstrap-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/css-globais/navbar.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/css-pages/perfil.css">

    <title>Aurorability | Perfil</title>


</head>

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
                        <label for="tipoServico" class="form-label">Tipo de Servico</label>
                        <select class="form-select" name="tipoServico" id="tipoServico" required>
                            <option value="">Selecione uma opção</option>
                            <option value="Plano Básico">Plano Básico</option>
                            <option value="Plano Intermediário">Plano Intermediário</option>
                            <option value="PlanoAvancado">Plano Avançado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dataTermino" class="form-label">Data Término</label>
                        <input type="datetime-local" class="form-control" name="dataTermino" id="dataTermino" required>
                    </div>

                    <input type="hidden" name="usuario_id" id="usuarioSelecionadoId">
                    <button type="submit" class="btn btn-vinho w-100">
                        <i class="fas fa-check me-1"></i> Confirmar Agendamento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<body>

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
                        <i class="fas fa-home me-2"></i> Inicial
                    </a>
                    <a class="nav-link text-white rounded mb-2" href="#">
                        <i class="fas fa-users me-2"></i> Usuários
                    </a>
                    <a class="nav-link text-white rounded mb-2" href="#">
                        <i class="fas fa-calendar-alt me-2"></i> Serviços
                    </a>
                    <a class="nav-link text-white rounded mb-2" href="#">
                        <i class="fas fa-cog me-2"></i> Configurações
                    </a>
                    <a class="nav-link text-white bg-danger bg-opacity-25 rounded mt-auto"
                        href="../database/logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i> Sair da Conta
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-grow-1 bg-white p-4 rounded-end col-12 col-md-9 col-lg-10">
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

                <?php if($nivel == 1):?>
                <div>
                    <div>
                        <!--Quantidade de Usuarios-->
                    </div>
                    <div>
                        <!--Quantidade de Admins-->
                    </div>
                    <div>
                        <!--Serviços Pendente-->
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>RG</th>
                                <th>Gênero</th>
                                <th>Membro desde</th>
                                <th>Nível</th>
                            </tr>
                        </thead>
                        <tbody class="usuarios">
                            <?php foreach ($usuarios as $usuario):?>
                            <tr class="btn-usuario" data-id="<?= $usuario['id']?>" style="cursor: pointer;">
                                <td>
                                    <?= htmlspecialchars($usuario['nome'])?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($usuario['email'])?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($usuario['cpf'])?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($usuario['rg'])?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($usuario['genero'])?>
                                </td>
                                <td>
                                    <?php  
                                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                    date_default_timezone_set('America/Sao_Paulo');
                                    $data = new DateTime($usuario['data_criacao']);
                                    echo strftime('%d de %B de %Y', $data->getTimestamp());
                                    ?>
                                </td>
                                <td><span class="badge bg-success"> <?= htmlspecialchars($usuario['nivel'])?></span>
                                </td>

                            </tr>


                            <?php endforeach?>

                        </tbody>

                    </table>
                    <div id="servicosUsuario" class="d-none"></div>
                </div>
                <?php endif;?>
            </main>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script>
    const searchInput = document.getElementById('searchUsuario');
    const tabelaUsuarios = document.querySelector('.usuarios');
    const tabelaUsuariosContainer = document.querySelector('.table-responsive');
    const btnAgendarServico = document.getElementById('btnAgendarServico');
    const servicosUsuarioContainer = document.getElementById('servicosUsuario');

    // Variável para armazenar todos os usuários inicialmente carregados
    let todosUsuarios = [];

    // Carrega todos os usuários quando a página é carregada
    document.addEventListener('DOMContentLoaded', function() {
        // Se já temos usuários no PHP, convertemos para o formato que o JS espera
        <?php if($nivel == 1 && isset($usuarios)): ?>
        todosUsuarios = <?= json_encode($usuarios) ?>;
        renderUsuarios(todosUsuarios);
        <?php endif; ?>

        adicionarListenersBotoesUsuario();
    });

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
                <td colspan="7" class="text-center">Nenhum usuário encontrado.</td>
            </tr>
            `;
        }
        tabelaUsuarios.innerHTML = html;
        adicionarListenersBotoesUsuario();
    }

    // Função para filtrar usuários localmente (sem requisição ao servidor)
    function filtrarUsuarios(termo) {
        termo = termo.toLowerCase().trim();

        if (termo === '') {
            // Se o campo de pesquisa estiver vazio, mostra todos os usuários
            renderUsuarios(todosUsuarios);
            return;
        }

        const usuariosFiltrados = todosUsuarios.filter(usuario => {
            return (
                usuario.nome.toLowerCase().includes(termo) ||
                usuario.email.toLowerCase().includes(termo) ||
                usuario.nivel.toString().includes(termo) ||
                usuario.genero.toLowerCase().includes(termo) ||
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

        const userId = this.getAttribute('data-id');
        document.getElementById('usuarioSelecionadoId').value = userId;

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
                        Veja os Serviços pendentes a seguir!
                        <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                    </div>
                    <ul class="list-group">
                    `;
                    data.forEach(servico => {
                        html += `
                        <li class="list-group-item">
                            <strong>Tipo Serviço:</strong> ${servico.tipo_servico}<br>
                            <strong>Data de Início:</strong> ${servico.data_inicio}<br>
                            <strong>Data de Término:</strong> ${servico.data_termino}<br>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="remarcarConsulta(${servico.userId})">
                                    <i class="fas fa-edit me-1"></i> Remarcar
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="cancelarConsulta(${servico.userId})">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </button>
                            </div>
                        </li>
                        `;
                    });
                    html += `</ul>`;
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
    </script>
</body>

</html>