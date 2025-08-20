<?php
require_once 'src/database/config.php';
require_once 'src/database/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="src/img/favicon/favicon.png" />
    <title>Aurora Ability IT - Tecnologia com Acessibilidade</title>

    <!-- LINKS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- BOXICON  -->
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS GLOBAL -->
    <!-- <link rel="stylesheet" href="src/css-globais/navbar.css"> -->
    <link rel="stylesheet" href="src/css/css-globais/Footer.css">

    <!-- CSS DA PÁGINA -->
    <link rel="stylesheet" href="src/css/css-pages/index.css">
    <link rel="stylesheet" href="src/css/css-pages/bootstrap.min.css" />

    <!-- CSS RESPONSIVO -->
    <link rel="stylesheet" href="src/css/css-pages/responsivo.css">

    <!-- JS DE ACESSIBILIDADE -->
    <script src="src/js/acessibilidade.js" defer></script>


</head>

<body>

    <!-- ======== header start ======== -->
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="src/img/logo/logo.png" alt="Logo" />
                            </a>
                            <button
                                class="navbar-toggler"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div
                                class="collapse navbar-collapse sub-menu-bar"
                                id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll active" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#servicos">Serviços</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="src/pages/planos.php">Planos</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="page-scroll" href="#redes">Redes</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="src/pages/faleconosco.php">Fale conosco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#empresa">Sobre</a>
                                    </li>

                                    <li class="nav-item-login">
                                        <a href="src/pages/login.php">Login</a>
                                    </li>
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

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">
                            Bem-vindo à Aurora Ability IT
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Somos apaixonados por transformar ideias em experiências digitais acessíveis, funcionais e inovadoras.
                            Na Aurora Ability, tecnologia e inclusão caminham lado a lado para criar soluções únicas, feitas sob medida para cada pessoa.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Comece agora sua jornada digital com propósito.
                        </p>
                        <a
                            href="src/pages/planos.php"
                            class="main-btn border-btn btn-hover wow fadeInUp"
                            data-wow-delay=".6s">Começar agora</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="src/img/hero-img.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="servicos" class="py-5">
        <div class="container">
            <div class="row text-center justify-content-center">

                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="single-feature">
                        <div class="icon-circle">
                            <i class='bx bx-code'></i>
                        </div>
                        <h5>Sites Responsivos</h5>
                        <p>Sites que se adaptam a qualquer dispositivo, proporcionando a melhor experiência ao usuário.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="single-feature">
                        <div class="icon-circle">
                            <i class='bx bx-store-alt-2'></i>
                        </div>
                        <h5>Lojas Virtuais</h5>
                        <p>Comércio eletrônico moderno com design atrativo e ferramentas para aumentar suas vendas.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="single-feature">
                        <div class="icon-circle">
                            <i class='bx bx-pencil'></i>
                        </div>
                        <h5>Otimização SEO</h5>
                        <p>Melhoramos o posicionamento do seu site no Google e atraímos mais visitantes qualificados.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="single-feature">
                        <div class="icon-circle">
                            <i class="fas fa-universal-access"></i>
                        </div>
                        <h5>Acessibilidade</h5>
                        <p>Aferecemos acessibilidade para todos os tipos de públicos</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <div class="container py-5">
        <div class="text-center mb-5">
            <small class="text-uppercase text-secondary fw-bold">Planos</small>
            <h2 class="fw-bold mt-2">Nossos <span>Planos</span></h2>
        </div>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="tour-card position-relative">
                    <div class="position-relative">
                        <img src="src/img/card1.jpg" alt="Beach" class="tour-image">
                    </div>
                    <div class="p-3">
                        <h5 class="fw-bold">Plano Básico</h5>
                        <p class="small text-muted">Ideal para quem está começando sua vida no mercado</p>
                        <div class="mb-2">
                            <span class="location-badge">Site simples de 1 página</span>
                            <span class="location-badge">Responsivo</span>
                            <span class="location-badge">Suporte por e-mail</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="./src/pages/planos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="tour-card position-relative">
                    <div class="position-relative">
                        <img src="src/img/card2.jpeg" alt="Arctic" class="tour-image">
                    </div>
                    <div class="p-3">
                        <h5 class="fw-bold">Plano Intermediário</h5>
                        <p class="small text-muted">Para pequenas empresas que desejam ter uma integridade e mantimento no mercado</p>
                        <div class="mb-2">
                            <span class="location-badge">Site com até 5 páginas</span>
                            <span class="location-badge">Design personalizado</span>
                            <span class="location-badge">Suporte por WhatsApp</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="./src/pages/planos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="tour-card position-relative">
                    <div class="position-relative">
                        <img src="src/img/card2.webp" alt="Sahara" class="tour-image">
                    </div>
                    <div class="p-3">
                        <h5 class="fw-bold">Plano Pro</h5>
                        <p class="small text-muted">Para empresas que precisam de mais recursos e querem ainda mais informatização no seu negócio</p>
                        <div class="mb-2">
                            <span class="location-badge">Site completo com blog</span>
                            <span class="location-badge">SEO e Analytics</span>
                            <span class="location-badge">Hospedagem e domínio</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="./src/pages/planos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="tour-card position-relative">
                    <div class="position-relative">
                        <img src="src/img/card2.webp" alt="Sahara" class="tour-image">
                    </div>
                    <div class="p-3">
                        <h5 class="fw-bold">Plano Personalizado</h5>
                        <p class="small text-muted">Crie seu site com a sua própria perspectiva e personalidade</p>
                        <div class="mb-2">
                            <span class="location-badge">Versão em inglês/espanhol (tradução + layout)</span>
                            <span class="location-badge">Design de ícones e logotipo simples </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="./src/pages/planos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Call To Action Section -->
    <!-- <section class="section-cta cta">
        <div class="section-cta-text">
            <h2>Instale SiteHelper para ficar por dentro de seu projeto</h2>
            <p>Para maior segurança e acompanhamento no seu projeto, baixe nosso aplicativo para não perder nenhuma novidade nele</p>
            <button>Baixe Agora</button>
        </div>
    </section> -->

    <div id="empresa" class="header_hero">
        <ul id="redes" class="header_social d-none d-lg-block">
            <li><a href="#"><i class="bi bi-whatsapp"></i></a></li>
            <li><a href="https://www.instagram.com/aurorability.it?igsh=NTc4MTIwNjQ2YQ=="><i class="bi bi-instagram"></i></a></li>
        </ul>
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="header_hero_content mt-45">
                        <div class="hero-texts">
                            <h5 class="header_sub_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">Espera</h5>
                            <h2 class="header_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">Você sabe quem é a Aurora Ability?</h2>
                            <span class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">A Aurora Ability nasceu de um grupo de jovens estudantes, cada um com sua perspectiva única e experiências diversas.</span>
                            <p class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">
                                Unidos por um propósito comum, eles decidiram transformar o mundo digital em um espaço mais acessível e acolhedor para todos. As ideias inovadoras de cada um, combinadas com a paixão por criar um ambiente digital inclusivo, deram origem à Aurorability, uma empresa que busca fazer a diferença na vida de todos os usuários.
                            </p>
                            <div class="buttons">
                                <a href="src/pages/empresa.php" rel="nofollow" class="main-btn-one wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.4s">Saiba Mais</a>
                                <a href="#servicos" rel="nofollow" class="main-btn-two wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.4s">Nossos Serviços</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COLUNA DO VÍDEO -->
                <div class="col-lg-6 col-md-6 col-sm-7">
                    <div class="header_hero_video mt-50 wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="1.8s">
                        <video autoplay muted loop playsinline class="video-fluid">
                            <source src="src/video/hero.mp4" type="video/mp4">
                            Seu navegador não suporta vídeo em HTML5.
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_hero_shape d-none d-lg-block"></div>
    </div>


    <!-- Header -->
    <div class="header-projetos">
        <h1>Nossos Projetos</h1>
        <p class="lead text-secondary">Conheça outros projetos nossos</p>
    </div>

    <!-- Projects Section -->
    <div class="container pb-5">
        <div class="row g-4">

            <!-- Project 1 -->
            <div class="col-md-6">
                <div class="project-card p-4 h-100">
                    <h5 class="fw-bold">Quântun</h5>
                    <p class="text-muted">Site de  computação quantica</p>
                    <p class="small">
                        Site desenvolvido para mostrar sobre o estudo e a história da computação quantica 
                    </p>
                    <small>Quântun<br>14/06/2023 - 10/11/2023</small>
                </div>
            </div>

            <!-- Project 1 Image + Modal Trigger -->
            <div class="col-md-6">
                <div class="image-container" data-bs-toggle="modal" data-bs-target="#videoModal1">
                    <img src="src/img/projetos/projeto1.jpeg" class="project-img" alt="Project 1">
                    <div class="play-button">
                        <i class='bxr  bxs-play' style='color:#ffffff'></i>
                    </div>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="col-md-6 order-md-2">
                <div class="project-card p-4 h-100">
                    <h5 class="fw-bold">Play On</h5>
                    <p class="text-muted">Site de jogos</p>
                    <p class="small">
                       Site voltado para venda de jogos incriveis para sua diversão
                    </p>
                    <small>Play on<br>27/02/2024 - 25/10/2024</small>
                </div>
            </div>

            <!-- Project 2 Image + Modal Trigger -->
            <div class="col-md-6 order-md-1">
                <div class="image-container" data-bs-toggle="modal" data-bs-target="#videoModal2">
                    <img src="src/img/projetos/projeto2.jpeg" class="project-img" alt="Project 2">
                    <div class="play-button">
                        <i class='bxr  bxs-play' style='color:#ffffff'></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal 1 -->
    <div class="modal fade" id="videoModal1" tabindex="-1" aria-labelledby="videoModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <iframe class="modal-video" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video 1"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="videoModal2" tabindex="-1" aria-labelledby="videoModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <iframe class="modal-video" src="https://www.youtube.com/embed/tgbNymZ7vqY" title="Video 2"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Projeto 1 -->
    <div class="modal fade" id="modalProjeto1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Website Computação Quântica</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-0">
                    <video id="videoProjeto1" controls autoplay muted loop style="width: 100%; border-radius: 0 0 8px 8px;">
                        <source src="src/video/quantica.mp4" type="video/mp4">
                        Seu navegador não suporta vídeo em HTML5.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Projeto 2 -->
    <div class="modal fade" id="modalProjeto2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Website de Jogos</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-0">
                    <video id="videoProjeto2" controls autoplay muted loop style="width: 100%; border-radius: 0 0 8px 8px;">
                        <source src="src/video/jogos.mp4" type="video/mp4">
                        Seu navegador não suporta vídeo em HTML5.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Aurora Ability IT. Todos os direitos reservados.</p>
        <p>Desenvolvido com foco em acessibilidade digital.</p>
    </footer>

    <!-- JSs -->
    <!-- Bootstrap JS (opcional, mas deixado caso queira usar dropdowns, etc) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/index.js"></script>
    <script src="src/js/mod.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!-- JSs -->
<!-- Bootstrap JS (opcional, mas deixado caso queira usar dropdowns, etc) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="src/js/index.js"></script>
<script src="src/js/mod.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>