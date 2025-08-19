<?php
require_once '../database/config.php';
require_once '../database/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membros da Empresa - Aurora IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/css-pages/empresa.css">
    <link rel="stylesheet" href="../css/css-globais/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="../img/logo/logo.png" alt="Logo" />
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
                                        <a class="page-scroll active" href="../../index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="empresa.php">Serviços</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="planos.php">Planos</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="page-scroll" href="empresa.php">Redes</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="page-scroll" href="faleconosco.php">Fale conosco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="empresa.php">Sobre</a>
                                    </li>

                                    <li class="nav-item-login">
                                        <a class="page-scroll" href="login.php">Login</a>
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
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="background-elements">
                <div class="bg-circle circle-1"></div>
                <div class="bg-circle circle-2"></div>
            </div>

            <div class="hero-content">

                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                            <div class="hero-text">
                                <h1>Porti<span class="accent-text">folio</span></h1>
                                <h2>Aurora Ability IT</h2>
                                <p class="description">Passionate about creating exceptional digital experiences that
                                    blend innovative design with functional development. Let's bring your vision to
                                    life.</p>

                                <div class="social-links">
                                    <a href="#"><i class="bi bi-instagram"></i></a>
                                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                                    <a href="#"><i class="bi bi-github"></i></a>
                                    <a href="#"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-visual">
                                <div class="profile-container">
                                    <div class="profile-background"></div>
                                    <img src="../img/equipe/grupo/grupo.jpeg" alt="Alexander Chen"
                                        class="profile-image">
                                    <div class="floating-elements">
                                        <div class="floating-icon icon-1"><i class="bi bi-palette"></i></div>
                                        <div class="floating-icon icon-2"><i class="bi bi-code-slash"></i></div>
                                        <div class="floating-icon icon-3"><i class="bi bi-lightbulb"></i></div>
                                        <div class="floating-icon icon-4"><i class="bi bi-graph-up"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

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
                            <div class="content">
                                <h5>Sites Responsivos</h5>
                                <p>Sites que se adaptam a qualquer dispositivo, proporcionando a melhor experiência ao usuário.</p>
                            </div>
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

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                        <div class="profile-card">
                            <div class="profile-header">
                                <div class="profile-image">
                                    <img src="../img/logo/segunda-opcao-logo.png" alt="Profile Image" class="img-fluid">
                                </div>
                            </div>

                            <div class="profile-content">
                                <h3>Aurora Ability</h3>

                                <div class="contact-links">
                                    <a href="mailto:marcus@example.com" class="contact-item">
                                        <i class="bi bi-envelope"></i>
                                        marcus@example.com
                                    </a>
                                    <a href="tel:+15551234567" class="contact-item">
                                        <i class="bi bi-telephone"></i>
                                        +1 (555) 123-4567
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-content">
                            <div class="section-header">
                                <h2>Passionate About Creating Digital Experiences</h2>
                            </div>

                            <div class="description">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                    architecto beatae vitae dicta sunt explicabo.</p>

                                <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                    laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
                            </div>

                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number">3+</div>
                                    <div class="stat-label">Projetos completos</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">3+</div>
                                    <div class="stat-label">Anos de experiência</div>
                                </div>
                            </div>

                            <div class="details-grid">
                                <div class="detail-row">
                                    <div class="detail-item">
                                        <span class="detail-label">Languages</span>
                                        <span class="detail-value">English, Spanish, French</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Experience Level</span>
                                        <span class="detail-value">Senior Professional</span>
                                    </div>
                                </div>
                            </div>

                            <div class="cta-section">
                                <a href="#" class="btn btn-primary">
                                    Conheça nosso instagram
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

    </main>



    <!-- Gestão de Redes Sociais -->
    <section class="area-section area-social">
        <div class="container">
            <h2 class="section-title">Gestão de Redes Sociais</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="../img/equipe/aline.jpeg" class="profile-img mb-3" alt="">
                    <h4>Aline Hosen</h4>
                    <p>Especialista em campanhas no Instagram e TikTok.</p>
                    <div class="mb-2">
                        <strong>Marketing Criativo</strong>
                        <div class="progress">
                            <div class="progress-bar bg-dark" style="width: 90%">90%</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <strong>Planejamento Estratégico</strong>
                        <div class="progress">
                            <div class="progress-bar bg-secondary" style="width: 75%">75%</div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-github"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-linkedin"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-project">
                        <h5>Campanha Primavera 2024</h5>
                        <p>Engajamento cresceu 120% em 3 semanas com reels e posts diários.</p>
                    </div>
                    <div class="card-project">
                        <h5>Promoção Natal 2023</h5>
                        <p>Criação de conteúdos animados e sorteios ao vivo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Design Gráfico -->
    <section class="area-section area-design">
        <div class="container">
            <h2 class="section-title">Design Gráfico</h2>
            <div class="row">
                <div class="cards-designs col-md-4">
                    <div class="designers">
                        <div class="text-center">
                            <img src="../img/equipe/bruno.jpeg" class="profile-img" alt="">
                            <h4>Bruno Rufino</h4>
                            <p>Designer</p>
                            <div class="social-icons">
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"> <i class="bi bi-github"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-linkedin"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-instagram"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="../img/equipe/izabela.jpeg" class="profile-img" alt="">
                            <h4>Izabela Tinoco</h4>
                            <p>Designer</p>
                            <div class="social-icons">
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"> <i class="bi bi-github"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-linkedin"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-instagram"></i></a>
                                <a href="https://linkedin.com/in/anacode" target="_blank"
                                    class="btn btn-sm btn-outline-dark"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="">
                            <p class="text-center">Logo para Aurora Café</p>
                        </div>
                        <div class="col-md-6">
                            <img src="https://via.placeholder.com/300x200" class="img-fluid rounded shadow" alt="">
                            <p class="text-center">Cartaz de evento musical</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Documentadora -->
    <section class="area-section area-documentadora">
        <div class="container container-documentadora">
            <h2 class="section-title">Documentadora</h2>
            <div class="d-flex align-items-center">
                <img src="../img/equipe/maria-eduarda.jpeg" class="profile-img me-4" alt="">
                <div>
                    <h4>Maria Eduarda Simões</h4>
                    <p>Responsável por toda documentação técnica e tutoriais internos.</p>
                    <ul>
                        <li>Manual de sistemas da empresa</li>
                        <li>Documentação da API Aurora</li>
                    </ul>
                    <div class="social-icons">
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-github"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-linkedin"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programadores -->
    <section class="container-programador my-5" id="programadores">
        <h2 class="mb-4 text-center fw-bold" style="color: #fff;">Equipe de Programadores</h2>

        <div class="row session-programdador  gy-4">
            <!-- Programador 1 -->
            <div class="card col-md-6">
                <div class="card-programador">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <img src="../img/equipe/nayara.jpeg" class="img-fluid rounded-circle" alt="Programador 1">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nayara Silva</h5>
                                <p class="card-text">Back-end especialista em PHP e Desenvolvimento Mobile com React
                                    Native</p>
                                <p class="mb-1">PHP</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-info"
                                        style="width: 90%; background-color: #287697 !important;">90%</div>
                                </div>
                                <p class="mb-1">Laravel</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-info"
                                        style="width: 80%; background-color: #287697 !important;">80%</div>
                                </div>
                                <p class="mb-1">Projetos:</p>
                                <ul class="list-unstyled">
                                    <li>🔹 Sistema de login seguro para e-commerce</li>
                                    <li>🔹 API RESTful para mobile</li>
                                </ul>
                                <div class="social-icons">
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"> <i class="bi bi-github"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-linkedin"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-instagram"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Programador 2 -->
            <div class="card col-md-6">
                <div class="card-programador">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <img src="../img/equipe/nickolas.jpeg" class="img-fluid rounded-circle" alt="Programador 2">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nickolas Cremasco</h5>
                                <p class="card-text">Front-end com experiência em React e UI/UX.</p>
                                <p class="mb-1">React</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-info"
                                        style="width: 85%; background-color: #287697 !important;">85%</div>
                                </div>
                                <p class="mb-1">HTML/CSS</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-info"
                                        style="width: 95%; background-color: #287697 !important;">95%</div>
                                </div>
                                <p class="mb-1">Projetos:</p>
                                <ul class="list-unstyled">
                                    <li>🔹 Landing page para startup de educação</li>
                                    <li>🔹 Dashboard interativo com React</li>
                                </ul>
                                <div class="social-icons">
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"> <i class="bi bi-github"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-linkedin"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-instagram"></i></a>
                                    <a href="https://linkedin.com/in/anacode" target="_blank"
                                        class="btn btn-sm btn-outline-dark"><i class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Analista de Software -->
    <section class="area-section area-analista">
        <div class="container">
            <h2 class="section-title">Analista de Software</h2>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="../img/equipe/alana.jpeg" class="profile-img" alt="">
                    <h4>Alana</h4>
                    <p>Analisa requisitos, desenha sistemas e integra equipes.</p>
                    <div class="social-icons">
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-github"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-linkedin"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com/in/anacode" target="_blank" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-project">
                        <h5>Sistema de Gestão de Contratos</h5>
                        <p>Desenvolvido com foco em performance e escalabilidade.</p>
                    </div>
                    <div class="card-project">
                        <h5>Dashboard de KPIs</h5>
                        <p>Monitoração de dados em tempo real usando Node.js e Chart.js.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>