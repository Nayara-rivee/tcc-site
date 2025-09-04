<?php
require_once 'src/database/config.php';
require_once 'src/database/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="src/img/favicon/favicon.png" />
    <title>Aurora Ability IT - Tecnologia com Acessibilidade</title>

    <!-- LINKS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- BOXICON  -->
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="src/css/css-globais/Footer.css">

    <!-- CSS DA PÁGINA -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/bootstrap.min.css" />

    <!-- CSS RESPONSIVO -->
    <link rel="stylesheet" href="src/css/responsivo.css">

    <!-- JS DE ACESSIBILIDADE -->
    <script src="src/js/acessibilidade.js" defer></script>
    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --accent-color: #00d4ff;
        --text-dark: #2d3748;
        --text-muted: #718096;
        --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        --card-shadow-hover: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f8fafc;
    }

    /* Seção de portfólio com background dinâmico */
    .portfolio-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        position: relative;
        overflow: hidden;
    }

    .portfolio-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 140%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23e2e8f0" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
        z-index: 0;
    }

    .portfolio-content {
        position: relative;
        z-index: 1;
    }

    /* Título da seção */
    .section-header {
        margin-bottom: 4rem;
    }

    .section-subtitle {
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 2px;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .section-title .highlight {
        background: linear-gradient(45deg, var(--accent-color), #667eea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Cards de projeto modernos */
    .project-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        height: 100%;
        border: none;
    }

    .project-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: var(--card-shadow-hover);
    }

    .project-image-container {
        position: relative;
        height: 280px;
        overflow: hidden;
    }

    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .project-card:hover .project-image {
        transform: scale(1.1);
    }

    /* Overlay com informações */
    .project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .overlay-content {
        text-align: center;
        color: white;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .project-card:hover .overlay-content {
        transform: translateY(0);
    }

    .view-project-btn {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-project-btn:hover {
        background: white;
        color: var(--text-dark);
        transform: translateY(-2px);
    }

    /* Conteúdo do card */
    .project-content {
        padding: 2rem;
    }

    .project-category {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .category-education {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .category-entertainment {
        background: linear-gradient(135deg, #56ab2f, #a8e6cf);
        color: white;
    }

    .category-health {
        background: linear-gradient(135deg, #ff6b6b, #ffa500);
        color: white;
    }

    .project-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .project-description {
        color: var(--text-muted);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Tecnologias usadas */
    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .tech-tag {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Animações de entrada */
    .fade-in-up {
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.3s;
    }

    .delay-3 {
        animation-delay: 0.5s;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .project-content {
            padding: 1.5rem;
        }

        .project-image-container {
            height: 220px;
        }

        .section-header {
            margin-bottom: 2rem;
        }
    }
    </style>
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
                                <img src="src/img/logo/logo.png" alt="Logo" class="img-fluid" />
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
                                        <a class="nav-link" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#servicos">Serviços</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#planos">Planos</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="src/pages/faleconosco.php">Fale conosco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#empresa">Sobre a empresa</a>
                                    </li>

                                    <?php if(estaLogado()) : ?>
                                    <li class="nav-item d-lg-none">
                                        <a class="nav-link" href="src/pages/perfil.php">Meu Perfil</a>
                                    </li>
                                    <?php else : ?>
                                    <li class="nav-item d-lg-none">
                                        <a class="nav-link" href="src/pages/login.php">Login</a>
                                    </li>
                                    <?php endif ?>
                                </ul>

                                <?php if(estaLogado()) : ?>
                                <!-- Mostra a imagem do usuário logado (apenas em desktop) -->
                                <?php if($_SESSION['usuario']['nivel'] == 0):?>
                                <div class="d-none d-lg-flex align-items-center ms-4">
                                    <a href="src/pages/perfilUsuario.php"
                                        class="perfil d-flex align-items-center text-decoration-none">
                                        <img src="src/img/icono-usuario_126283-435.avif"
                                            class="border rounded-circle me-2" alt="Usuário"
                                            style="width: 40px; height: 40px;">
                                        <span
                                            class="fw-bold text-white"><?php echo ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?></span>
                                    </a>
                                </div>

                                <?php elseif($_SESSION['usuario']['nivel'] == 1):?>
                                <div class="d-none d-lg-flex align-items-center ms-4">
                                    <a href="src/pages/perfil.php"
                                        class="perfil d-flex align-items-center text-decoration-none">
                                        <img src="src/img/icono-usuario_126283-435.avif"
                                            class="border rounded-circle me-2" alt="Usuário"
                                            style="width: 40px; height: 40px;">
                                        <span
                                            class="fw-bold text-white"><?php echo ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?></span>
                                    </a>
                                </div>
                                <?php endif?>

                                <?php else : ?>
                                <div class="d-none d-lg-block ms-4">
                                    <a href="src/pages/login.php" class="btn btn-outline-light">Login</a>
                                </div>
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

    <a href="https://wa.me/5511974557734" target="_blank" class="position-fixed bottom-0 end-0 m-3 whatsapp"
        style="z-index: 22222;">
        <img src="src/img/logo/whatsapp.png" alt="WhatsApp" class="img-fluid rounded-circle shadow whatsapp-hover"
            style="width: clamp(60px, 10vw, 70px); height: auto;">
    </a>

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">
                            Bem-vindo à Aurora IT
                        </h1>
                        <p class="wow fadeInUp" style="text-align: justify;" data-wow-delay=".6s">
                            Somos apaixonados por transformar ideias em experiências digitais acessíveis, funcionais
                            e inovadoras. Na Aurora Ability, tecnologia e inclusão caminham lado a lado para criar
                            soluções
                            únicas, feitas sob medida para cada pessoa.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#servicos" class="main-btn border-btn btn-hover wow fadeInUp"
                                data-wow-delay=".7s">Venha nos Conhecer!</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="src/img/hero-img.png" alt="inicial" class="img-fluid" />
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
                                class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">$2,490</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Plano Básico</h5>
                            <p class="card-text text-muted small">Ideal para quem está começando. Entregamos o essencial
                                com velocidade e simplicidade.</p>

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
                                <?php if(!estaLogado()):?>
                                <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php else : ?>
                                <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php endif;?>
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
                                class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">$4,950</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Plano Intermediário</h5>
                            <p class="card-text text-muted small">Para empresas que querem uma presença sólida e
                                funcional.</p>

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
                                <?php if(!estaLogado()):?>
                                <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php else : ?>
                                <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php endif;?>
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
                                class="position-absolute top-0 end-0 m-2 badge bg-primary fs-6 px-3 py-2 rounded-pill shadow-sm">$6,420</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Plano Avançado</h5>
                            <p class="card-text text-muted small">Para empresas que querem se destacar e crescer no
                                digital.</p>

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
                                <?php if(!estaLogado()):?>
                                <a href="src/pages/login.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php else : ?>
                                <a href="src/pages/faleconosco.php" class="btn btn-primary w-100 fw-semibold">
                                    Adquira Já <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- Sobre a Empresa Section -->
    <section id="empresa" class="header_hero py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="header_hero_content">
                        <div class="hero-texts">
                            <h5 class="header_sub_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">
                                Espera</h5>
                            <h2 class="header_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">
                                Você sabe quem é a Aurora Ability?</h2>
                            <p class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">A Aurora Ability
                                nasceu de um grupo de jovens estudantes, cada um com sua perspectiva única e
                                experiências diversas.</p>
                            <p class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Unidos por um
                                propósito comum, eles decidiram transformar o mundo digital em um espaço mais
                                acessível e acolhedor para todos. As ideias inovadoras de cada um, combinadas com a
                                paixão por
                                criar um ambiente digital inclusivo, deram origem à Aurorability, uma empresa que
                                busca fazer a diferença na vida de todos os usuários.</p>
                            <div class="buttons mt-4">
                                <a href="https://rebrand.ly/freelancer-ud" rel="nofollow"
                                    class="main-btn-one wow fadeInUp me-2 mb-2" data-wow-duration="1.3s"
                                    data-wow-delay="1.4s">Saiba Mais</a>
                                <a href="#servicos" rel="nofollow" class="main-btn-two wow fadeInUp mb-2"
                                    data-wow-duration="1.3s" data-wow-delay="1.4s">Nossos Serviços</a>
                            </div>
                        </div>
                    </div> <!-- header hero content -->
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="header_hero_image mt-5 mt-lg-0 wow fadeInRightBig" data-wow-duration="1.3s"
                        data-wow-delay="1.8s">
                        <img src="src/img/image.png" alt="Aurora Ability" class="img-fluid rounded shadow">
                    </div> <!-- header hero image -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->

        <!-- Redes Sociais -->
        <div id="redes" class="d-flex justify-content-center mt-5">
            <ul class="header_social d-flex list-unstyled gap-3">
                <li><a href="#" class="text-decoration-none fs-4"><i class="bi bi-whatsapp"></i></a></li>
                <li><a href="#" class="text-decoration-none fs-4"><i class="bi bi-github"></i></a></li>
                <li><a href="#" class="text-decoration-none fs-4"><i class="bi bi-instagram"></i></a></li>
                <li><a href="#" class="text-decoration-none fs-4"><i class="bi bi-linkedin"></i></a></li>
            </ul>
        </div>
    </section>


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
                            <img src="src/img/projetos/Captura de tela 2025-08-19 203736.png" class="project-image"
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
                                    <a href="#" class="view-project-btn">
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

                        <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>

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
                            <span>contato@auroraability.com</span>
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

    <!-- JSs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    </script>
    <script src="src/js/mod.js"></script>

</body>

</html>