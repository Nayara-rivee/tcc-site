<?php
// esqueci-senha.php
require '../database/config.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 1. Variáveis para capturar o status e a classe CSS
$mensagem_status = '';
$mensagem_class = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar se email existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Mensagem de segurança: não informamos se o e-mail existe, apenas que o processo foi iniciado.
        $mensagem_status = "Se o e-mail estiver cadastrado, o link de redefinição foi enviado! Verifique sua caixa de entrada ou spam.";
        $mensagem_class = 'alert-info';
    } else {

        // Gerar token e expiração
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Salvar token no banco
        $stmt = $pdo->prepare("UPDATE usuarios SET token = :token, token_expira = :expira WHERE id = :id");
        $stmt->execute([
            'token' => $token,
            'expira' => $expira,
            'id' => $user['id']
        ]);

        // Enviar e-mail
        $mail = new PHPMailer(true);
        try {
            // CORREÇÃO: Garante que caracteres especiais (ç, ã) funcionem
            $mail->CharSet = 'UTF-8'; 
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aurorait12345@gmail.com'; 
            // A senha deve estar SEM espaços
            $mail->Password = 'xzwvvigjwxrteero'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Apenas para XAMPP teste local (Mantido, pois é necessário para TLS)
            if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ]
                ];
            }

            $mail->setFrom('aurorait12345@gmail.com', 'Seu Site');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Redefinição de senha';
            $mail->Body = "Clique no link para redefinir sua senha: 
                <a href='http://localhost/Tcc-site/src/pages/esqueci.php?token=$token'>Redefinir Senha</a>";

            $mail->send();
            
            // Sucesso
            $mensagem_status = "E-mail de redefinição enviado! Verifique sua caixa de entrada ou spam.";
            $mensagem_class = 'alert-success';
            
        } catch (Exception $e) {
            // Falha
            $mensagem_status = "Erro ao enviar e-mail. Tente novamente mais tarde.";
            $mensagem_class = 'alert-danger';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../css/css-pages/login.css">
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
                            <input type="email" class="form-control" name="email" placeholder="Seu e-mail" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">
                                <small>Enviar link de redefinição</small>
                            </button>
                        </div>
                    </form>
                    
                    <a href="login.php" class="d-block text-center mt-3">Voltar ao Login</a>
                </div>
           </div>
        </div>
    </div>
</body>

</html>