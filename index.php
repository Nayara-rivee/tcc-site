<?php
require_once 'src/database/config.php';
require_once 'src/database/auth.php';

if (estaLogado()) {
    $usuario_id = $_SESSION['usuario']['id'];

    $stmtCaminhoFoto = $pdo->prepare('SELECT caminho_foto FROM usuarios WHERE id = :usuario_id');
    $stmtCaminhoFoto->execute([
        ':usuario_id' => $usuario_id
    ]);

    $caminhoFoto = $stmtCaminhoFoto->fetchColumn();
    $fotoPerfil = !empty($caminhoFoto) ? $caminhoFoto : 'src/img/usuarioGenerico.jpg';

    // Se o nível for 0 (cliente), link para perfilUsuario.php
    if ($_SESSION['usuario']['nivel'] == 0) {
        $link_perfil = 'src/pages/perfilUsuario.php';
    }
    // Se o nível for 1 (admin), link para perfil.php
    else if ($_SESSION['usuario']['nivel'] == 1) {
        $link_perfil = 'src/pages/perfil.php';
    }
    // Se for outro nível ou indefinido, usa um link padrão seguro.
    else {
        $link_perfil = 'src/pages/perfil.php';
    }

    $primeiro_nome = ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]);
}

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
    <!-- BOXICON  -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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
        <img src="src/img/logo/whatsapp.png" alt="WhatsApp" class="img-fluid rounded-circle shadow whatsapp-hover"
            style="width: clamp(60px, 10vw, 70px); height: auto;">
    </a>

    <div id="content-wrapper" class="main-content-wrapper">
        <!-- ======== header start ======== -->
        <header class="header">
            <div class="navbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="index.php">
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
                                            <a href="src/pages/faleconosco.php">Fale conosco</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#empresa">Sobre</a>
                                        </li>

                                        <?php if (estaLogado()) : ?>
                                            <li class="nav-item d-lg-none">
                                                <a class="nav-link" href="src/pages/perfil.php">Meu Perfil</a>
                                            </li>
                                        <?php else : ?>
                                            <li class="nav-item d-lg-none">
                                                <a class="nav-link" href="src/pages/login.php">Login</a>
                                            </li>
                                        <?php endif ?>
                                    </ul>
                                    <?php if (estaLogado()) : ?>
                                        <!-- Mostra a imagem do usuário logado (apenas em desktop) -->
                                        <?php if ($_SESSION['usuario']['nivel'] == 0): ?>
                                            <div class="d-none d-lg-flex align-items-center ms-4">
                                                <a href="src/pages/perfilUsuario.php"
                                                    class="perfil d-flex align-items-center text-decoration-none">
                                                    <img src="<?php echo $fotoPerfil; ?>" class="border rounded-circle me-2"
                                                        alt="Usuário" style="width: 40px; height: 40px;">
                                                    <span
                                                        class="fw-bold text-white"><?php echo ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?></span>
                                                </a>
                                            </div>

                                        <?php elseif ($_SESSION['usuario']['nivel'] == 1): ?>
                                            <div class="d-none d-lg-flex align-items-center ms-4">
                                                <a href="src/pages/perfil.php"
                                                    class="perfil d-flex align-items-center text-decoration-none">
                                                    <img src="<?php echo $fotoPerfil; ?>" class="border rounded-circle me-2"
                                                        alt="Usuário" style="width: 40px; height: 40px;">
                                                    <span
                                                        class="fw-bold text-white"><?php echo ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?></span>
                                                </a>
                                            </div>
                                        <?php endif ?>

                                    <?php else : ?>
                                        <ul class="navbar-nav">
                                            <li class="nav-item-login">
                                                <a href="src/pages/login.php">Login</a>
                                            </li>
                                        </ul>
                                    <?php endif ?>
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
                                href="#planos"
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
        <section id="servicos" class="feature-section py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="fw-bold">Nossos <span class="text-primary">Serviços</span></h2>
                        <p class="text-muted">Oferecemos soluções completas para sua presença digital</p>
                    </div>
                </div>
                <div class="row justify-content-center">

                    <!-- Card 1 -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card feature-card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon icon-circle mb-3 mx-auto">
                                        <i class='bx bx-code'></i>
                                    </div>
                                    <h5 class="card-title">Sites Responsivos</h5>
                                    <p class="card-text">
                                        Sites que se adaptam a qualquer dispositivo, proporcionando a melhor experiência ao
                                        usuário.
                                    </p>
                                </div>
                            </div>
                        </div>


                        <!-- Card 2 -->
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card feature-card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon icon-circle mb-3 mx-auto">
                                        <i class='bx bx-store-alt-2'></i>
                                    </div>
                                    <h5 class="card-title">Lojas Virtuais</h5>
                                    <p class="card-text">Comércio eletrônico moderno com design atrativo e ferramentas para
                                        aumentar suas vendas.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card feature-card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon icon-circle mb-3 mx-auto">
                                        <i class='bx bx-pencil'></i>
                                    </div>
                                    <h5 class="card-title">Otimização SEO</h5>
                                    <p class="card-text">Melhoramos o posicionamento do seu site no Google e atraímos mais
                                        visitantes qualificados.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card feature-card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon icon-circle mb-3 mx-auto">
                                        <i class='bx bx-mobile'></i>
                                    </div>
                                    <h5 class="card-title">Aplicativos Mobile</h5>
                                    <p class="card-text">Aplicativos com design moderno e foco em usabilidade, performance e
                                        integração com sistemas web.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>
        <!-- ======== feature-section end ======== -->

        <!-- Planos Section -->
        <section class="container-fluid py-5 bg-light" id="planos">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Nossos <span class="text-primary">Planos</span></h2>
                    <p class="text-muted">Escolha o plano ideal para o seu negócio</p>
                </div>

                <div class="row g-4 justify-content-center">
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden tour-card">
                            <div class="position-relative">
                                <img src="src/img/card1.jpg" class="card-img-top" alt="Plano Básico"
                                    style="height: 200px; object-fit: cover;">
                                <span
                                    class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">R$200,00</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Aurora Light</h5>
                                <p class="card-text text-muted small">Site com até 4 páginas, design acessível e compatível com leitores de tela</p>

                                <ul class="list-group list-group-flush mb-3 border-0">
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Design:</strong> Uso de
                                        template, adaptamos as cores e logo.
                                    </li>

                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Dev:</strong> Página
                                        única com HTML/CSS (landing page).
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Social Media:</strong>
                                        Criamos o perfil e postamos 1x por semana.
                                    </li>
                                </ul>

                                <div class="mt-auto">
                                    <div class="mb-3">
                                        <span
                                            class="badge bg-light text-dark border rounded-pill me-1 mb-1">Essencial</span>
                                        <span class="badge bg-light text-dark border rounded-pill me-1 mb-1">Pronto Pra
                                            Usar</span>
                                        <span class="badge bg-light text-dark border rounded-pill mb-1">Rápido</span>
                                    </div>
                                    <?php if (!estaLogado()): ?>
                                        <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden tour-card">
                            <div class="position-relative featured">

                                <img src="src/img/card2.jpeg" class="card-img-top" alt="Plano Intermediário"
                                    style="height: 200px; object-fit: cover;">
                                <span
                                    class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">R$450,00</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Aurora Pro</h5>
                                <p class="card-text text-muted small">Site com até 8 páginas, integração do Vlibras e tudo do light</p>

                                <ul class="list-group list-group-flush mb-3 border-0">
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Design:</strong> Visual
                                        próprio, responsivo, com identidade visual
                                        personalizada.
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Dev:</strong> Até
                                        páginas com formulário e responsividade (HTML, CSS, JS).
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Social Media:</strong>
                                        Estratégia semanal, com 3 posts por semana.
                                    </li>
                                </ul>

                                <div class="mt-auto">
                                    <div class="mb-3">
                                        <span
                                            class="badge bg-light text-dark border rounded-pill me-1 mb-1">Identidade</span>
                                        <span class="badge bg-light text-dark border rounded-pill me-1 mb-1">Presença
                                            Digital</span>
                                        <span class="badge bg-light text-dark border rounded-pill mb-1">Estratégico</span>
                                    </div>
                                    <?php if (!estaLogado()): ?>
                                        <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden tour-card">
                            <div class="position-relative">
                                <img src="src/img/card2.webp" class="card-img-top" alt="Plano Avançado"
                                    style="height: 200px; object-fit: cover;">
                                <span
                                    class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">R$600,00</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Aurora Total</h5>
                                <p class="card-text text-muted small">Tudo do Pro+ páginas ilimitadas acessibilidade nível AAA e painel administrativo avançado</p>

                                <ul class="list-group list-group-flush mb-3 border-0">
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Design:</strong> UX/UI
                                        pensadas do zero, com protótipos e testes de
                                        usabilidade.
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i><strong>Dev:</strong> Site
                                        completo com backend (login, banco, painel admin).
                                    </li>
                                    <li class="list-group-item border-0 ps-0 pb-2 small">
                                        <i class="bi bi-check-circle text-success me-2"></i> <strong>Social Media:</strong>
                                        Planejamento mensal, análises de resultado,
                                        calendário e execução.
                                    </li>
                                </ul>

                                <div class="mt-auto">
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark border rounded-pill me-1 mb-1">UX
                                            Premium</span>
                                        <span
                                            class="badge bg-light text-dark border rounded-pill me-1 mb-1">Automação</span>
                                        <span class="badge bg-light text-dark border rounded-pill mb-1">Alta
                                            Performance</span>
                                    </div>
                                    <?php if (!estaLogado()): ?>
                                        <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                            Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="empresa" class="header_hero">
            <ul id="redes" class="header_social d-none d-lg-block">
                <li><a href="https://wa.me/5511974557734"><i class="bi bi-whatsapp"></i></a></li>
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
                        <div class="header_hero_img mt-50 wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="1.8s">
                            <img src="src/img/pensativo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_hero_shape d-none d-lg-block"></div>
        </div>


        <section class="portfolio-section py-5">
            <div class="container portfolio-content">
                <!-- Header da seção -->
                <div class="section-header text-center fade-in-up">
                    <h6 class="section-subtitle">PORTFÓLIO</h6>
                    <h2 class="section-title">Nossos <span class="highlight">Projetos</span></h2>
                    <p class="lead text-muted">Conheça alguns dos nossos trabalhos mais recentes e descubra como
                        transformamos ideias em realidade digital.</p>
                </div>

                <!-- Grid de projetos -->
                <div class="row g-4 justify-content-center mb-5">
                    <!-- Projeto 1: Quantun -->
                    <div class="col-lg-4 col-md-6 fade-in-up delay-1">
                        <div class="project-card">
                            <div class="project-image-container">
                                <img src="src/img/projetos/projeto1.png" class="project-image"
                                    alt="Quantun - Computação Quântica">
                                <div class="project-overlay">
                                    <div class="overlay-content">
                                        <h5 class="mb-3">Ver Projeto</h5>
                                        <a href="https://nickolassantoscremasco.github.io/Quantun/" target="_blank"
                                            class="view-project-btn">
                                            <i class="bi bi-eye me-2"></i>Visualizar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="project-content">
                                <span class="project-category category-education">Educação</span>
                                <h5 class="project-title">Quantun</h5>
                                <p class="project-description">
                                    Plataforma educacional dedicada à evolução intelectual dos usuários, divulgando
                                    conhecimentos sobre computação quântica e comercializando soluções de automação.
                                </p>
                                <div class="tech-stack">
                                    <span class="tech-tag">React</span>
                                    <span class="tech-tag">Node.js</span>
                                    <span class="tech-tag">PostgreSQL</span>
                                    <span class="tech-tag">AWS</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projeto 2: PlayOn -->
                    <div class="col-lg-4 col-md-6 fade-in-up delay-2">
                        <div class="project-card">
                            <div class="project-image-container">
                                <img src="src/img/projetos/projeto2.jpeg" class="project-image"
                                    alt="PlayOn - Desenvolvimento de Jogos">
                                <div class="project-overlay">
                                    <div class="overlay-content">
                                        <h5 class="mb-3">Ver Projeto</h5>
                                        <a href="https://nickolassantoscremasco.github.io/PlayOn/" target="_blank"
                                            class="view-project-btn">
                                            <i class="bi bi-eye me-2"></i>Visualizar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="project-content">
                                <span class="project-category category-entertainment">Entretenimento</span>
                                <h5 class="project-title">PlayOn</h5>
                                <p class="project-description">
                                    Instituição voltada para o desenvolvimento de jogos indies, detentora de 3 jogos
                                    autorais. Projeto final apresentado com foco na experiência do usuário.
                                </p>
                                <div class="tech-stack">
                                    <span class="tech-tag">HTML</span>
                                    <span class="tech-tag">CSS</span>
                                    <span class="tech-tag">Javascript</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projeto 3: Site Institucional -->
                    <div class="col-lg-4 col-md-6 fade-in-up delay-3">
                        <div class="project-card">
                            <div class="project-image-container">
                                <img src="src/img/projetos/projeto3.png" class="project-image"
                                    alt="Site Institucional - Alexandra Sarandi">
                                <div class="project-overlay">
                                    <div class="overlay-content">
                                        <h5 class="mb-3">Ver Projeto</h5>
                                        <a href="https://aprenderinvestindo.com.br/index.php" class="view-project-btn">
                                            <i class="bi bi-eye me-2"></i>Visualizar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="project-content">
                                <span class="project-category category-health">Cuidado Pessoal</span>
                                <h5 class="project-title">Site Institucional</h5>
                                <p class="project-description">
                                    Site institucional desenvolvido para apresentar as terapias da cliente Alexandra
                                    Sarandi, com painel de controle, serviços e curadoria em redes sociais.
                                </p>
                                <div class="tech-stack">

                                    <span class="tech-tag">PHP</span>
                                    <span class="tech-tag">MySQL</span>
                                    <span class="tech-tag">SEO</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <footer class="bg-dark text-white pt-5 pb-3">
            <div class="container">
                <div class="row">
                    <!-- Coluna Sobre -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">
                            <img src="src/img/logo/logo.png" style="width: 50%;" alt="Logo Aurora Ability"
                                class="img-fluid">
                        </h5>
                        <p class="mb-3">Transformando o mundo digital em um espaço mais acessível e acolhedor para todos.
                        </p>
                        <div class="d-flex gap-3">

                            <a href="https://www.instagram.com/aurorability.it?igsh=NTc4MTIwNjQ2YQ==" class="text-white fs-5"><i class="bi bi-instagram"></i></a>

                        </div>
                    </div>

                    <!-- Coluna Links Rápidos -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">Links Rápidos</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Serviços</a></li>
                            <li class="mb-2"><a href="#planos" class="text-white text-decoration-none">Planos</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Sobre Nós</a></li>
                        </ul>
                    </div>

                    <!-- Coluna Serviços -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">Nossos Serviços</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Sites Responsivos</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Lojas Virtuais</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Otimização SEO</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Aplicativos Mobile</a></li>
                        </ul>
                    </div>

                    <!-- Coluna Contato -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">Contato</h5>
                        <ul class="list-unstyled">

                            <li class="mb-2 d-flex align-items-center">
                                <i class="bi bi-telephone-fill me-2"></i>
                                <span>(11) 97455-7734</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <span>aurorait12345@gmail.com</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="bi bi-clock-fill me-2"></i>
                                <span>Seg - Sex: 9h - 18h</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; 2025 Aurora Ability IT. Todos os direitos reservados.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Desenvolvido com <i class="bi bi-heart-fill text-danger"></i> e foco na
                            acessibilidade digital</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JSs -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <!-- Bootstrap JS (opcional, mas deixado caso queira usar dropdowns, etc) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="src/js/mod.js"></script>
    <script src="src/js/acessibilidade.js"></script>
</body>

</html>