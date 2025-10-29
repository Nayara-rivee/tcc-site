<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');

$dotenv->load();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'];
        $mail->Password   = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];

        // Remetente
        $mail->setFrom($_ENV['SMTP_USER'], 'Formulário Fale Conosco');

        // Destinatário (você mesmo)
        $mail->addAddress($_ENV['SMTP_USER']);

        // Campos do formulário (validação básica)
        $nome = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $mensagem = $_POST['message'] ?? '';

        if (empty($nome) || empty($email) || empty($mensagem)) {
            throw new Exception('Por favor, preencha todos os campos.');
        }

        // Reply-To
        $mail->addReplyTo($email, $nome);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem de contato';
        $mail->Body    = "
            <h3>Nova mensagem recebida:</h3>
            <p><strong>Nome:</strong> {$nome}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Mensagem:</strong><br>{$mensagem}</p>
        ";

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ],
        ];

        $mail->send();
        echo '<div class="alert alert-success text-center mt-4">Mensagem enviada com sucesso!</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger text-center mt-4">Erro ao enviar: ' . $mail->ErrorInfo . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/css-pages/contato.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
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
        <img src="../img/logo/whatsapp.png" alt="WhatsApp" class="img-fluid rounded-circle shadow whatsapp-hover"
            style="width: clamp(60px, 10vw, 70px); height: auto;">
    </a>

    <a href="../../index.php" class="icon btn btn-link text-white mb-3 d-inline-flex align-items-center gap-1 text-decoration-none">
        <i class='bx bx-arrow-back'></i>
    </a>

    <div class="background-blob"></div>
    <div id="content-wrapper" class="main-content-wrapper">
        <div class="container mt-5" style="max-width:600px;">
            <h1 class="text-center custom-heading">Entre em Contato</h1>
            <form class="mt-4" action="faleconosco.php" method="post">
                <div class="form-group mt-4">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
                <div class="form-group mt-4">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                </div>
                <div class="form-group mt-4">
                    <label for="message">Assunto</label>
                    <textarea class="form-control" name="message" id="" rows="5" required></textarea>
                </div>
                <input type="submit" class="mt-4 btn btn-primary btn-block custom-btn" value="Enviar Mensagem">
            </form>
        </div>
    </div>

    <!-- JSs -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="../js/acessibilidade.js"></script>
</body>

</html>