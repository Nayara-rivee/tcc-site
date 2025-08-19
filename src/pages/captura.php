<?php
// Carregar autoload do Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php'; // ajuste o caminho se precisar

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome     = htmlspecialchars(trim($_POST['fullname']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $telefone = htmlspecialchars(trim($_POST['phone']));
    $assunto  = htmlspecialchars(trim($_POST['subject']));
    $mensagem = htmlspecialchars(trim($_POST['message']));

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aurorait12345@gmail.com';       // seu Gmail
        $mail->Password   = 'vhyy bhmo arbw qdxa';           // senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // TLS (porta 587)
        $mail->Port       = 587;

        // 🔹 Se estiver em localhost, ignora SSL (para evitar erro do OpenSSL)
        if (in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'])) {
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                ]
            ];
        }

        // Remetente e destinatário
        $mail->setFrom('aurorait12345@gmail.com', 'Formulário do Site');
        $mail->addAddress('aurorait12345@gmail.com', 'Equipe da Empresa');
        $mail->addReplyTo($email, $nome);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = "📩 Novo contato via site - $assunto";
        $mail->Body    = "
            <h2>Nova mensagem recebida pelo formulário do site</h2>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telefone:</strong> $telefone</p>
            <p><strong>Assunto:</strong> $assunto</p>
            <p><strong>Mensagem:</strong><br>" . nl2br($mensagem) . "</p>
            <hr>
            <p>Enviado em: " . date("d/m/Y H:i") . "</p>
        ";

        $mail->send();

        // Redireciona com sucesso
        header("Location: faleconosco.php?status=sucesso");
        exit;
    } catch (Exception $e) {
        // Redireciona com erro e mensagem
        header("Location: faleconosco.php?status=erro&msg=" . urlencode($mail->ErrorInfo));
        exit;
    }
} else {
    header("Location: faleconosco.php");
    exit;
}
