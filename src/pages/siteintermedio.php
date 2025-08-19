<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Grand Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css-pages/sites/siteintermediario.css">
    <link rel="stylesheet" href="../css/css-globais/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

    <div class="container section-feature">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="../img/hero-img.png" alt="Room" class="img-thumbnail mt-3">
            </div>
            <div class="col-lg-6">
                <h6 class="text-uppercase text-light">Site Intermediário</h6>
                <h1 class="fw-bold text-light">Transforme Sua Empresa com um Site Sob Medida</h1>
                <p class="text-light">O Plano Intermediário é voltado para pequenas empresas que desejam se destacar com um site moderno e funcional. Com até 5 páginas, design personalizado e suporte direto via WhatsApp, sua marca ganha mais força e credibilidade no ambiente digital.</p>
                <p class="text-light">Perfeito para negócios que estão em crescimento e precisam de uma estrutura mais robusta, este plano garante uma presença digital adaptada à sua identidade visual e às necessidades do seu público.</p>


                <div class="row g-4">
                    <div class="col-6">
                        <div><strong class="text-light">Plano Intermediário</strong><br><small class="text-light">Para pequenas empresas</small></div>
                    </div>
                    <div class="col-6">
                        <div><strong class="text-light">Como é</strong><br><small class="text-light">Site com até 5 páginas</small></div>
                    </div>
                    <div class="col-6">
                        <div><strong class="text-light">É responsivo?</strong><br><small class="text-light">É Responsivo</small></div>
                    </div>
                    <div class="col-6">
                        <div><strong class="text-light">Suporte</strong><br><small class="text-light">Suporte por WhatsApp</small></div>
                    </div>
                    <div class="col-6">
                        <div><strong class="text-light">Diferencial</strong><br><small class="text-light">Design personalizado</small></div>
                    </div>
                    <div class="col-6">
                        <div><strong class="text-light">Custo</strong><br><small class="text-light">R$ 799,00</small>
                        </div>
                    </div>
                </div>
                <a href="#orcamento" class="btn btn-gold mt-4">Faça seu orçamento →</a>
            </div>
        </div>
    </div>

    <div id="orcamento" class="container section">
        <div class="highlight-box mx-auto" style="max-width: 700px;">
            <h2 class="fw-bold text-center">Venha fazer seu orçamento</h2>
            <p class="text-center">Preencha os campos de acordo com as informações</p>
            <form class="row g-3">
                <div class="col-md-6">
                    <label>Nome completo</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Check-Out Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Páginas</label>
                    <select class="form-select">
                        <option>1 página</option>
                        <option>2 páginas</option>
                        <option>3 páginas</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Quantas línguas</label>
                    <select class="form-select">
                        <option>Português</option>
                        <option>Inglês</option>
                    </select>
                </div>
                <div class="col-12">
                    <label>Mensagem</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="col-12 text-center mt-3">
                    <button class="btn btn-gold px-5">Fechar orçamento</button>
                </div>
            </form>
        </div>
        <div id="redes" class=" cards row mt-5 g-4">
            <div class="col-sm-12 col-md-4">
                <div class="info-card">
                    <div class="feature-icon"><i class="bi bi-telephone"></i></div>
                    <h6 class="fw-bold">Telefone Para Contato</h6>
                    <p>Entre em contato com nossa equipe<br><strong>+1 (555) 123-4567</strong></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="info-card">
                    <div class="feature-icon"><i class="bi bi-clock"></i></div>
                    <h6 class="fw-bold">Que horas estamos em espediente?</h6>
                    <p>Entre em contato conosco acesse esses horários: <br><strong> 12:00 PM - 18:00 PM</strong></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>