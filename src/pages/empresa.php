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



    <!-- membros Section -->
    <section id="membros" class="membros section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Empresa</span>
            <h2>Nossa equipe</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="featured-membro row align-items-center g-4" data-aos="fade-up" data-aos-delay="150">
                <div class="col-lg-5">
                    <figure class="membro-photo m-0">
                        <img src="../img/equipe/grupo/grupo.jpeg" alt="Executive membro portrait" class="img-fluid">
                    </figure>
                </div>

                <div class="col-lg-7">
                    <div class="membro-content">
                        <h3 class="name">Aurora Ability</h3>
                        <p class="role mb-3">Quem somos?</p>
                        <p class="bio mb-4">Somos uma equipe dedicada, unindo criatividade e conhecimento técnico para desenvolver projetos que fazem a diferença. Acreditamos no poder da tecnologia como ferramenta de transformação, e trabalhamos juntos para entregar resultados que superam expectativas</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 team-grid mt-2">

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/alana.jpeg" alt="Sous membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Allana</h4>
                            <p class="role mb-2">Analista de software</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/aline.jpeg" alt="Pastry membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Aline Hosen</h4>
                            <p class="role mb-2">Gestão de social mídia</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/izabela.jpeg" alt="Grill membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Iza Tinico</h4>
                            <p class="role mb-2">Design</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/maria-eduarda.jpeg" alt="Grill membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Maria Eduarda Simões</h4>
                            <p class="role mb-2">Documentadora</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/nayara.jpeg" alt="Grill membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Nayara</h4>
                            <p class="role mb-2">Programadora</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/nickolas.jpeg" alt="Grill membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Nickolas</h4>
                            <p class="role mb-2">Programador</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->

                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <article class="membro-card h-100">
                        <div class="image-wrapper">
                            <img src="../img/equipe/bruno.jpeg" alt="Grill membro portrait" class="img-fluid" loading="lazy">
                            <ul class="social list-unstyled m-0">
                                <li><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="content p-3">
                            <h4 class="name mb-1">Bruno Rufino</h4>
                            <p class="role mb-2">Design</p>
                        </div>
                    </article>
                </div><!-- End membro Card -->



            </div>

        </div>

    </section><!-- /membros Section -->

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>