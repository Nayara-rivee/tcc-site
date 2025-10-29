<?php
session_start();

require '../database/config.php'; // conexão com banco


// Variáveis para mensagens de status e classe CSS
$mensagem_status = '';
$mensagem_class = '';

if (!isset($_GET['token'])) {
    die("Token inválido ou não fornecido! Por favor, use o link completo do e-mail.");
}

$token = $_GET['token'];

// Verificar se token existe e ainda está válido
$stmt = $pdo->prepare("SELECT id, token_expira FROM usuarios WHERE token = :token");
$stmt->execute(['token' => $token]);
$user = $stmt->fetch();

if (!$user) {
    die("Token inválido! O link de redefinição não é mais válido.");
}

// Verificar se expirou
if (strtotime($user['token_expira']) < time()) {
    die("Token expirado! Solicite uma nova recuperação.");
}

// TODO O PROCESSAMENTO DEVE FICAR AQUI DENTRO!
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // AGORA SIM, é seguro acessar $_POST["senha"] e $_POST["confirmar"]
    // A LINHA 32 DO ERRO ANTERIOR ESTAVA AQUI, FORA DO BLOCO POST
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar"];

    if (empty($senha) || empty($confirmar)) {
        $mensagem_status = "Preencha todos os campos.";
        $mensagem_class = 'alert-danger';
    } elseif ($senha !== $confirmar) {
        $mensagem_status = "As senhas não coincidem!";
        $mensagem_class = 'alert-danger';
    } else {
        // Hash seguro da senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        // Atualizar senha e remover token
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha, token = NULL, token_expira = NULL WHERE id = :id");
        $stmt->execute([
            'senha' => $hash,
            'id' => $user['id']
        ]);

        // Mensagem de sucesso na sessão para o login.php
        $_SESSION['status_login'] = "Senha redefinida com sucesso! Faça login.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../css/css-pages/login.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <style>
        .vh-100 {
            height: 100vh;
        }
    </style>
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
    
    <div id="content-wrapper" class="main-content-wrapper">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="row w-100 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card py-3 px-2">
                        <p class="text-center mb-3 mt-2">Redefinir Senha</p>

                        <?php if (!empty($mensagem_status)): ?>
                            <div class="alert <?= $mensagem_class; ?>" role="alert">
                                <?= htmlspecialchars($mensagem_status); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" class="myform">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Nova senha" name="senha" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirmar senha" name="confirmar" required>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg">
                                    <small><i class="far fa-user pr-2"></i>Redefinir Senha</small>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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