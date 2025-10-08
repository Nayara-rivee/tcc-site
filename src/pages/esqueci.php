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
    <style>
        .vh-100 { height: 100vh; }
    </style>
</head>

<body>
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
</body>

</html>