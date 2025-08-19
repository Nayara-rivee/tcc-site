<?php
require_once '../database/config.php';
require_once '../database/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Planos - Aurora Ability IT</title>


    <!-- LINKS BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>


    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="../css/css-globais/navbar.css" />
    <link rel="stylesheet" href="../css-globais/footer.css" />

    <!-- CSS DA PÁGINA -->
    <link rel="stylesheet" href="../css/css-pages/planos-templates.css">

    <!-- CSS RESPONSIVO -->
    <link rel="stylesheet" href="../css/responsivo.css" />

    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
    <!-- ======== header start ======== -->
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
                                    <a href="faleconosco.php">Fale conosco</a>
                                </li>
                                <li class="nav-item">
                                    <a href="empresa.php">Sobre</a>
                                </li>

                                <li class="nav-item-login">
                                    <a href="login.php">Login</a>
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
    <!-- ======== header end ======== -->
    <div class="planos">
        <div class="nossos-planos">
            <h1> Planos e Produtos</h1>
            <p>Templates e preços</p>
        </div>
        <section class="container py-5">
            <div id="carouselPlanos" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <div class="carousel-wrapper">
                    <div class="carousel-inner">
                        <!-- Slide 1 - Plano Básico -->
                        <div class="carousel-item active">
                            <div class="row align-items-center plano">
                                <div class="col-md-6">
                                    <h2 class="fw-bold">Plano Básico</h2>
                                    <p>Ideal para quem está começando</p>
                                    <ul>
                                        <li>Site simples de 1 página</li>
                                        <li>Responsivo</li>
                                        <li>Suporte por e-mail</li>
                                        <li>R$ 399,00</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <img src="../img/card1.jpg" class="d-block w-100 rounded shadow"
                                        alt="Plano Básico" />
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 - Plano Intermediário -->
                        <div class="carousel-item">
                            <div class="row align-items-center plano">
                                <div class="col-md-6">
                                    <h2 class="fw-bold">Plano Intermediário</h2>
                                    <p>Para pequenas empresas</p>
                                    <ul>
                                        <li>Site com até 5 páginas</li>
                                        <li>Design personalizado</li>
                                        <li>Suporte por WhatsApp</li>
                                        <li>R$ 799,00</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <img src="../img/card2.jpeg" class="d-block w-100 rounded shadow"
                                        alt="Plano Intermediário" />
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 - Plano Profissional -->
                        <div class="carousel-item">
                            <div class="row align-items-center plano">
                                <div class="col-md-6">
                                    <h2 class="fw-bold">Plano Profissional</h2>
                                    <p>
                                        Para empresas que precisam de mais recursos
                                    </p>
                                    <ul>
                                        <li>Site completo com blog</li>
                                        <li>SEO e Analytics</li>
                                        <li>Hospedagem e domínio</li>
                                        <li>R$ 1.299,00</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <img src="../img/card2.webp" class="d-block w-100 rounded shadow"
                                        alt="Plano Profissional" />
                                </div>
                            </div>
                        </div>
                        <!-- Slide 4 - Plano Personalizado -->
                        <div class="carousel-item">
                            <div class="row align-items-center plano">
                                <div class="col-md-6">
                                    <h2 class="fw-bold">Plano Personalizado</h2>
                                    <p>
                                        Crie seu site com a sua própria perspectiva e personalidade
                                    </p>
                                    <ul>
                                        <li>Faça seu site personalizado do jeitinho <br>
                                        que você sempre sonhou, com tudo que você deseja</li>
                                        <li><a href="#planopersonalizado" class="text-light ">Faça seu orçamento conosco</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <img src="../img/planos/site_personalizado.avif" class="d-block w-60 rounded shadow"
                                        alt="Plano Profissional" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de navegação -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlanos"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselPlanos"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <div class="vendas">
        <div class="text-center mb-5">
            <small class="text-uppercase text-secondary fw-bold">EXTRA</small>
            <h2 class="fw-bold mt-2">Nossos Serviços <span class="text-primary">Extras</span></h2>
        </div>
    </div>
    <div class="extras-section container mt-5">
        <h2 class="extras-title">Itens adicionais que podem ser combinados com qualquer plano:</h2>
        <section id="servicos" class="py-5">
            <div class="container">
                <div class="row text-center justify-content-center">

                    <!-- Card 1 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="single-feature">
                            <div class="icon-circle">
                                <i class="bi bi-badge-cc"></i>
                            </div>
                            <p>Versão em inglês/espanhol (tradução + layout) — <strong>+ R$ 398</strong></p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="single-feature">
                            <div class="icon-circle">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <p>Design de ícones e logotipo simples — <strong>R$ 150 - R$ 299</strong></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="header_hero_shape d-none d-lg-block"></div>
    </div>
    <br><br><br><br><br>


    <!--tipo dos sites -->

    <section class="py-5 text-center">
        <h6 class="text-muted">NOSSOS</h6>
        <h2 class="fw-bold">Modelos de <span class="text-primary">Site</span></h2>
    </section>

    <div class="container pb-5">
        <div class="row g-4">

            <!-- Plano Básico -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="../img/planos/site_basico.webp" class="card-img-top" alt="Plano Básico">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plano Básico</h5>
                        <a href="sitebasico.php" class="btn btn-saiba-mais mt-2">Saiba mais</a>
                    </div>
                </div>
            </div>

            <!-- Plano Intermediário -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="../img/planos/site_intermediario.webp" class="card-img-top" alt="Plano Intermediário">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plano Intermediário</h5>
                        <a href="siteintermedio.php" class="btn btn-saiba-mais mt-2">Saiba mais</a>
                    </div>
                </div>
            </div>

            <!-- Plano Pro -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="../img/planos/site_pro.jpg" class="card-img-top" alt="Plano Pro">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plano Pro</h5>
                        <a href="sitepro.php" class="btn btn-saiba-mais mt-2">Saiba mais</a>
                    </div>
                </div>
            </div>

            <!-- Plano Personalizado -->
            <div id="planopersonalizado" class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="../img/planos/site_personalizado.avif" class="card-img-top" alt="Plano Personalizado">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plano Personalizado</h5>
                        <a href="sitepersonalizado.php" class="btn btn-saiba-mais mt-2">Saiba mais</a>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="../js/mod.js"></script>
    <script src="../js/planoseprodutos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap + Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setupForm(idForm, idMsg, plano) {
            const form = document.getElementById(idForm);
            const msg = document.getElementById(idMsg);

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const nome = form.querySelector("input[type='text']").value;
                const email = form.querySelector("input[type='email']").value;
                const mensagem = form.querySelector("textarea").value;

                fetch("src/pages/enviar-email.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams({
                            nome,
                            email,
                            mensagem: `Plano: ${plano}\n${mensagem}`
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            msg.textContent = "Pedido enviado com sucesso!";
                            msg.classList.remove("text-danger");
                            msg.classList.add("text-success");
                            msg.style.display = "block";
                            form.reset();
                        } else {
                            msg.textContent = data.message || "Erro ao enviar.";
                            msg.classList.remove("text-success");
                            msg.classList.add("text-danger");
                            msg.style.display = "block";
                        }
                        setTimeout(() => msg.style.display = "none", 5000);
                    })
                    .catch(err => {
                        msg.textContent = "Erro na conexão.";
                        msg.classList.remove("text-success");
                        msg.classList.add("text-danger");
                        msg.style.display = "block";
                        setTimeout(() => msg.style.display = "none", 5000);
                    });
            });
        }

        setupForm("formBasico", "msgBasico", "Básico");
        setupForm("formIntermediario", "msgIntermediario", "Intermediário");
        setupForm("formPro", "msgPro", "Pro");
    </script>

    <script>
        const gradients = [
            "linear-gradient(45deg, #ff6b6b, #ff4757)",
            "linear-gradient(45deg, #6c5ce7, #341f97)",
            "linear-gradient(45deg, #00b894, #00cec9)",
            "linear-gradient(45deg, #f1c40f, #f39c12)",
            "linear-gradient(45deg, #e84393, #d63031)",
            "linear-gradient(45deg, #0984e3, #00cec9)"
        ];

        let currentPicker;

        function createGradientPicker(target) {
            if (currentPicker) currentPicker.remove();

            const picker = document.createElement("div");
            picker.className = "gradient-picker";

            gradients.forEach(gradient => {
                const btn = document.createElement("div");
                btn.className = "gradient-option";
                btn.style.background = gradient;
                btn.onclick = () => {
                    target.style.background = gradient;
                    picker.remove();
                };
                picker.appendChild(btn);
            });

            target.parentElement.appendChild(picker);
            currentPicker = picker;
        }

        // Ativar clique nos elementos
        document.querySelectorAll(".header, .footer, .sidebar, .content, .box").forEach(el => {
            el.addEventListener("click", (e) => {
                e.stopPropagation(); // Impede múltiplas ativações
                createGradientPicker(e.target);
            });
        });

        // Clicar fora para fechar picker
        document.addEventListener("click", () => {
            if (currentPicker) {
                currentPicker.remove();
                currentPicker = null;
            }
        });
    </script>
</body>

</html>

</html>