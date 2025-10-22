<?php
session_start();
require __DIR__ . '/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fullname = htmlspecialchars(trim($_POST['fullname']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
    $_SESSION['form_message'] = "Por favor, preencha todos os campos obrigatórios.";
    header('Location: ../pages/faleconosco.php');
    exit;
}

$mail = new PHPMailer(true);

$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

try {
    // Configuração do servidor SMTP do Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aurorait12345@gmail.com'; // e-mail da empresa
    $mail->Password = 'rjwlkyjmzxvjuswx';       // coloque aqui a senha de app gerada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Codificação e formato
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    // Remetente (quem envia tecnicamente)
    $mail->setFrom('aurorait12345@gmail.com', 'Formulário Aurora IT');

    // Destinatário (quem vai receber — a empresa)
    $mail->addAddress('aurorait12345@gmail.com', 'Aurora IT');

    // “Responder para” — aqui entra o e-mail do cliente!
    $mail->addReplyTo($email, $fullname);

    // Assunto e corpo
    $mail->Subject = 'Nova mensagem de contato: ' . $subject;
    $mail->Body = "
        <strong>Nome:</strong> {$fullname}<br>
        <strong>Email:</strong> {$email}<br>
        <strong>Telefone:</strong> {$phone}<br><br>
        <strong>Mensagem:</strong><br>{$message}
    ";

    // Envia o e-mail
    $mail->send();

    $_SESSION['form_message'] = "Mensagem enviada com sucesso!";
    header('Location: ../pages/faleconosco.php');
    exit;
} catch (Exception $e) {
    $_SESSION['form_message'] = "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    header('Location: ../pages/faleconosco.php');
    exit;
} catch (Exception $e) {
    $_SESSION['form_message'] = "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
}

header('Location: ../pages/faleconosco.php');
exit;
