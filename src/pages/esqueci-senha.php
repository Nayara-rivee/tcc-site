
<?php
// esqueci-senha.php
require '../database/config.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar se email existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "E-mail não cadastrado!";
        exit;
    }

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
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aurorait12345@gmail.com'; // seu e-mail real
        $mail->Password = 'xzwv vigj wxrt eero'; // senha de app
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Apenas para XAMPP teste local, ignore se for produção
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
        echo "E-mail de redefinição enviado! Verifique sua caixa de entrada ou spam.";
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: " . $mail->ErrorInfo;
    }
}
?>

<h2>Esqueci minha senha</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Seu e-mail" required>
    <button type="submit">Enviar link de redefinição</button>
</form>