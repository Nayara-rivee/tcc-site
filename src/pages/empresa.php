<?php
require_once '../database/config.php'; 
require_once '../database/auth.php';

if (estaLogado()) {
    $usuario_id = $_SESSION['usuario']['id'];

    $stmtCaminhoFoto = $pdo->prepare('SELECT caminho_foto FROM usuarios WHERE id = :usuario_id');
    $stmtCaminhoFoto->execute([
        ':usuario_id' => $usuario_id
    ]);

    $caminhoFoto = $stmtCaminhoFoto->fetchColumn();
    $fotoPerfil = !empty($caminhoFoto) ? $caminhoFoto : '../img/usuarioGenerico.jpg';

    // Se o nível for 0 (cliente), link para perfilUsuario.php
    if ($_SESSION['usuario']['nivel'] == 0) {
        $link_perfil = '../pages/perfilUsuario.php';
    }
    // Se o nível for 1 (admin), link para perfil.php
    else if ($_SESSION['usuario']['nivel'] == 1) {
        $link_perfil = '../pages/perfil.php';
    }
    // Se for outro nível ou indefinido, usa um link padrão seguro.
    else {
        $link_perfil = '../pages/perfil.php';
    }

    $primeiro_nome = ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]);
}

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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
                                        <a class="page-scroll" href="empresa.php">Redes</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="page-scroll" href="faleconosco.php">Fale conosco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="empresa.php">Sobre</a>
                                    </li>

                                    <?php if (estaLogado()) : ?>
                                        <li class="nav-item d-lg-none">
                                            <a class="nav-link" href="../pages/perfil.php">Meu Perfil</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item d-lg-none">
                                            <a class="nav-link" href="../pages/login.php">Login</a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                                <?php if (estaLogado()) : ?>
                                    <!-- Mostra a imagem do usuário logado (apenas em desktop) -->
                                    <?php if ($_SESSION['usuario']['nivel'] == 0): ?>
                                        <div class="d-none d-lg-flex align-items-center ms-4">
                                            <a href="../pages/perfilUsuario.php"
                                                class="perfil d-flex align-items-center text-decoration-none">
                                                <img src="<?php echo $fotoPerfil; ?>" class="border rounded-circle me-2"
                                                    alt="Usuário" style="width: 40px; height: 40px;">
                                                <span
                                                    class="fw-bold text-white"><?php echo ucfirst(explode(' ', $_SESSION['usuario']['nome'])[0]) ?></span>
                                            </a>
                                        </div>

                                    <?php elseif ($_SESSION['usuario']['nivel'] == 1): ?>
                                        <div class="d-none d-lg-flex align-items-center ms-4">
                                            <a href="../pages/perfil.php"
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
                                            <a href="../pages/login.php">Login</a>
                                        </li>
                                    </ul>
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
                                <p class="description">Somos apaixonados por criar experiências digitais únicas que unem design criativo com desenvolvimento funcional. Nosso objetivo é transformar ideias em soluções digitais que inspiram, conectam e geram resultados.</p>

                                <div class="social-links">
                                    <a href="https://www.instagram.com/aurorability.it?igsh=NTc4MTIwNjQ2YQ=="><i class="bi bi-instagram"></i></a>
                                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-visual">
                                <div class="profile-container">
                                    <div class="profile-background"></div>
                                    <img src="../img/logo/segunda-opcao-logo.png" alt="Alexander Chen"
                                        class="profile-image">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- ======== feature-section start ======== -->
        <section id="servicos" class="feature-section py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="fw-bold">Nossos <span class="text-muted">Serviços</span></h2>
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
                                        aurorait12345@gmail.com
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
                                <p>Trabalhamos para desenvolver soluções inovadoras que combinam tecnologia, estética e usabilidade. Cada projeto é pensado para atender às necessidades do cliente, entregando qualidade, funcionalidade e impacto.</p>
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
                                        <span class="detail-label">Linguagens</span>
                                        <span class="detail-value">Inglês e Espanhol</span>
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





    <div class="swiper">
        <h2>Nossa Equipe</h2>

        <div class="swiper-wrapper">

            <!-- Integrante 1 -->
            <div class="swiper-slide">
                <img src="../img/equipe/alana.jpeg" alt="Integrante 1">
                <div class="overlay">
                    <h3>Integrante 1</h3>
                    <div class="skill"><span>HTML</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>CSS</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>JavaScript</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 2 -->
            <div class="swiper-slide">
                <img src="src/img/equipe/aline.jpeg" alt="Integrante 2">
                <div class="overlay">
                    <h3>Integrante 2</h3>
                    <div class="skill"><span>React</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Node.js</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>SQL</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 3 -->
            <div class="swiper-slide">
                <img src="src/img/equipe/bruno.jpeg" alt="Integrante 3">
                <div class="overlay">
                    <h3>Integrante 3</h3>
                    <div class="skill"><span>UI/UX</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Figma</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Design</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 4 -->
            <div class="swiper-slide">
                <img src="src/img/equipe/nayara.jpeg" alt="Integrante 4">
                <div class="overlay">
                    <h3>Integrante 4</h3>
                    <div class="skill"><span>PHP</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Laravel</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>MySQL</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 5 -->
            <div class="swiper-slide">
                <img src="src/img/equipe/izabela.jpeg" alt="Integrante 5">
                <div class="overlay">
                    <h3>Integrante 5</h3>
                    <div class="skill"><span>Marketing</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>SEO</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Social Media</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 6 -->
            <div class="swiper-slide">
                <img src="src/img/equipe/nickolas.jpeg" alt="Integrante 6">
                <div class="overlay">
                    <h3>Integrante 6</h3>
                    <div class="skill"><span>DevOps</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>AWS</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Docker</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- Integrante 7 -->
            <div class="swiper-slide">
                <img src="../img/equipe/maria-eduarda.jpeg" alt="Integrante 7">
                <div class="overlay">
                    <h3>Integrante 7</h3>
                    <div class="skill"><span>Python</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>Data Science</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="skill"><span>IA</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Botões de navegação -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Bolinhas -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper", {
            loop: true,
            centeredSlides: true,
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>


    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>