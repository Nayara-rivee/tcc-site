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
    $stmtUsuarios = $pdo->query('SELECT id, nome, email, nivel, data_criacao FROM usuarios ORDER BY nome ASC');
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


<body>

    <!-- libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <!-- end libras -->

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

    <!-- ======== header start ======== -->
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg" style="background-color: transparent;">
                            <a class="navbar-brand" href="index.html">
                                <img src="../img/logo/logo.png" alt="Logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll active" href="../../index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="../../index.php">Serviços</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="page-scroll" href="../../index.php">Redes</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="../pages/faleconosco.php">Fale conosco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/empresa.php">Sobre</a>
                                    </li>


                                    <?php if (estaLogado()): ?>
                                        <!-- Mostra a imagem do usuário logado -->
                                        <div class="d-flex align-items-center flex-column gap-2"
                                            style="position: relative; bottom: 15px; left: 20px;">
                                            <?php
                                            $fotoPerfil = !empty($_SESSION['usuario']['foto'])
                                                ? '../uploads/' . $_SESSION['usuario']['foto']
                                                : '../img/usuarioGenerico.jpg';
                                            ?>
                                            <a href="../pages/perfil.php" class="perfil">
                                                <img src="<?= $fotoPerfil ?>"
                                                    class="border" alt="Usuário"
                                                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                            </a>
                                            <span class="fw-bold" style="color: white;">
                                                <?= ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?>
                                            </span>

                                        </div>
                                    <?php else: ?>

                                        <li class="nav-item-login">
                                            <a href="../pages/login.php">Login</a>
                                        </li>
                                    <?php endif ?>

                                </ul>
                            </div>
                            <!-- navbar collapse -->
                        </nav>
                        <!-- navbar -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->
    <!---->
    <section class="container mb-4" style="margin-top: 15%;">
        <div class="d-flex rounded">
            <!-- Sidebar -->
            <aside class="nav-menu text-white p-3 vh-100 d-flex flex-column rounded-start" style="width: 240px;">
                <div class="d-flex align-items-center mb-4">
                    <img src="../img/favicon/favicon.png" alt="Logo Aurora" width="30" class="me-2">
                    <span class="fw-bold fs-5">Aurora</span>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link text-white active bg-opacity-25 bg-white rounded mb-2" href="../../index.php">🏠 Inicial</a>
                    <a class="nav-link text-white bg-danger bg-opacity-25  rounded mb-2"
                        href="../database/logout.php">📤 Sair</a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-grow-1 bg-white p-4 rounded-end">
                <div class="mb-4">
                    <h2>Foto de Perfil</h2>
                    <form action="../database/uploadFoto.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="foto" accept="image/*" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-primary">Enviar Foto</button>
                    </form>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fs-3 fw-semibold">Usuarios</h1>
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search the users">
                        <button class="btn">Procurar</button>
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
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
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
                                            <?php
                                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                            date_default_timezone_set('America/Sao_Paulo');
                                            $data = new DateTime($usuario['data_criacao']);
                                            echo strftime('%d de %B de %Y', $data->getTimestamp());
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
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script>
        document.querySelectorAll('.btn-usuario').forEach(btn => {
            btn.addEventListener('click', function() {
                const btnAgendarServico = document.getElementById('btnAgendarServico');
                btnAgendarServico.classList.remove('d-none')
                const usuarios = document.querySelector('.usuarios');
                usuarios.classList.add('d-none');
                const userId = this.getAttribute('data-id');
                document.getElementById('usuarioSelecionadoId').value = userId;
                fetch(`../database/getServicos.php?id=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('servicosUsuario');
                        let html = '';

                        if (data.length > 0) {

                            html +=
                                `<div class="alert alert-info">Veja as Consultas a seguir!<i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i></div>`;
                            html += `<ul class="list-group">`;
                            data.forEach(servico => {
                                html += `<li class="list-group-item">
                            <strong>Tipo Serviço:</strong> ${servico.tipo_servico}<br>
                            <strong>Data de Início:</strong> ${servico.data_inicio}<br>
                            <strong>Data de Término:</strong> ${servico.data_termino}<br>
                            
                            <div class="mt-2">
                               
                                    <button class="btn btn-sm btn-outline-secondary"  onclick="remarcarConsulta(${servico.userId})">
                                        <i class="fas fa-edit me-1"></i> Remarcar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="cancelarConsulta(${servico.userId})">
                                        <i class="fas fa-times me-1e"></i> Cancelar
                                    </button>
                                </div>
                            </li>   
                        `;
                            });
                            html += `</ul>`;
                        } else {
                            html =
                                '<div class="alert alert-warning" id="avisoConsulta">Nenhuma Servico Agendado Encontrado!<i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i></div>';

                        }

                        container.innerHTML = html;
                        container.classList.remove('d-none');

                        setTimeout(() => {
                            const voltar = document.querySelector("#voltar");
                            const btnAgendarServico = document.getElementById(
                                'btnAgendarServico');
                            if (voltar) {
                                voltar.addEventListener('click', () => {
                                    container.classList.add('d-none');
                                    usuarios.classList.remove('d-none')
                                    container.innerHTML = ''
                                    btnAgendarServico.classList.add('d-none')
                                })
                            }
                        }, 0);
                    });
            });
        });

        function agendarServico() {
            const modal = new bootstrap.Modal(document.getElementById('modalAgendarServico'));
            modal.show();
        }
    </script>

    <!-- scripts libras-->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <!-- end scripts -->
</body>

</html>