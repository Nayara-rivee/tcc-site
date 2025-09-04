<?php
require __DIR__ . '../../database/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Apenas executa a lógica de envio se o método for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitiza e valida os dados do formulário
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));


    // Verifica se os campos obrigatórios estão preenchidos
    if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
    } else {

        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor 
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // Destinatários e Remetente
            $mail->setFrom($email, $fullname); 
            $mail->addAddress($_ENV['SMTP_USERNAME'], 'AuroraIT'); 
            $mail->addReplyTo($email, $fullname); 

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                <h3>Nova Mensagem de Contato</h3>
                <p><strong>Nome:</strong> {$fullname}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Telefone:</strong> {$phone}</p>
                <p><strong>Assunto:</strong> {$subject}</p>
                <p><strong>Mensagem:</strong><br>{$message}</p>
            ";
            $mail->AltBody = "Nova Mensagem de Contato\nNome: {$fullname}\nEmail: {$email}\nTelefone: {$phone}\nAssunto: {$subject}\nMensagem: {$message}";

            $mail->send();
           
            $_SESSION['form_message'] = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
            header('Location: ../pages/faleconosco.php');
            exit;
            
        } catch (Exception $e) {
            $_SESSION['form_message'] = "A mensagem não pôde ser enviada. Erro: {$mail->ErrorInfo}";
            header('Location: ../pages/faleconosco.php');
            exit;
        }
    }
}
?>