<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';


try {
        $mail = new PHPMailer(true);
        
        $nom = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $message = $_POST['message'] ?? null;
        
        if (in_array(null, [$nom, $email, $message])) {
                header('Location: index.html?status=error');
                exit(0);
        }

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maboadaniel.55@gmail.com';
        $mail->Password = 'yuzvakpzmejmlpsa';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('maboadaniel.55@gmail.com', 'Equipe Mister Clean');
        $mail->addAddress($email, $nom);

        $mail->isHTML(true);
        $mail->Subject = 'Nouveau contact';
        $mail->Body = <<< MESSAGE
                Je m'appel $nom,<br/>
                $message
        MESSAGE;

        $mail->send();
        header('Location: index.html?status=success');
} catch (Exception $e) {
        header('Location: index.html?status=error');
}
exit(0);
