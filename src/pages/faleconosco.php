<?php
require_once '../database/config.php';
require_once '../database/auth.php';

if(!estaLogado()) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fale conosco</title>
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon/favicon.png" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/contacts/contact-5/assets/css/contact-5.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css-pages/contato.css">


</head>

<body>


    <section class="py-4 py-md-5 py-xl-9">
        <div class="container">
            <div class="row gy-4 gy-md-5 gy-lg-0 align-items-md-center">
                <!-- FORMULÁRIO -->
                <div class="col-12 col-lg-6">
                    <a href="../../index.php"
                        class="icon btn btn-link text-white mb-3 d-inline-flex align-items-center gap-1 text-decoration-none">
                        <i class='bx bx-arrow-back'></i>
                    </a>

                    <div class="border overflow-hidden">
                        <form action="../database/contatoEmail.php" method="POST">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="fullname" class="form-label">Nome Completo <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Telefone Para Contato</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-phone'></i></span>
                                        <input type="tel" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Assunto <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Mensagem <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" type="submit">Enviar
                                            Mensagem</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- TÍTULO + CONTATOS -->
                <div class="col-12 col-lg-6">
                    <!-- TÍTULO -->
                    <div class="mb-4">
                        <h3 class="fs-5 text-uppercase">Entre em contato</h3>
                        <h2 class="display-6 fw-semibold">Para retirar todas as suas dúvidas sobre nossos serviços,
                            entre em contato conosco</h2>
                    </div>

                    <!-- CONTATOS -->
                    <div class="row justify-content-xl-start">
                        <div class="col-12 col-xl-11">
                            <div class="row contato">
                                <!-- TELEFONE -->
                                <div class="col-12 col-sm-6 mb-4">
                                    <div class="mb-3  icon">
                                        <i class='bx bx-phone-outgoing'></i>
                                    </div>
                                    <h4 class="mb-2">Telefone</h4>
                                    <p class="mb-2">Fale conosco diretamente</p>
                                    <hr class="w-75 mb-3 border-dark-subtle">
                                    <p class="mb-0">
                                        <a class="text-decoration-none" href="tel:+5511974557734">(11)
                                            97455-7734</a>
                                    </p>
                                </div>
                                <!-- EMAIL -->
                                <div class="col-12 col-sm-6 mb-4">
                                    <div class="mb-3 icon">
                                        <i class='bx bx-envelope'></i>
                                    </div>
                                    <h4 class="mb-2">Email</h4>
                                    <p class="mb-2">Fale conosco diretamente</p>
                                    <hr class="w-75 mb-3 border-dark-subtle">
                                    <p class="mb-0">
                                        <a class="text-decoration-none"
                                            href="mailto:nck.tec.suporte@gmail.com">nck.tec.suporte@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- fim da coluna da direita -->
            </div>
        </div>
    </section>
</body>

</html>