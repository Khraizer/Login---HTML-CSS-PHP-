<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Configuración del servidor SMTP de Gmail
define('SMTP_SERVER', 'smtp.gmail.com');
define('SMTP_PORT', 587); // Utiliza el puerto 587 para TLS
define('SMTP_USERNAME', 'tucorreo@gmail.com'); // Tu dirección de correo electrónico de Gmail
define('SMTP_PASSWORD', 'tupassword'); // La contraseña de tu cuenta de Gmail

// Recuperar el correo electrónico del formulario
$correo = $_POST['correo'];

// Validar el correo electrónico (aquí deberías realizar una validación más robusta)
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "Por favor, ingresa una dirección de correo electrónico válida.";
    exit;
}

// Generar un token seguro para el restablecimiento de contraseña (aquí se omite la generación real)
$token = "TOKEN_DE_PRUEBA";

// URL para restablecer la contraseña (aquí deberías usar la URL de tu aplicación)
$url_reset = "https://tuapp.com/reset_password.php?token=$token";

// Crear el contenido del correo electrónico
$subject = "Recuperación de Contraseña";
$message = "Hola,\n\n";
$message .= "Has solicitado restablecer tu contraseña. Por favor, sigue este enlace para crear una nueva contraseña:\n";
$message .= "$url_reset\n\n";
$message .= "Si no has solicitado restablecer tu contraseña, puedes ignorar este mensaje.\n\n";
$message .= "Gracias,\nTu aplicación";

try {
    // Crear una instancia de PHPMailer
    $mail = new PHPMailer();

    // Configurar el servidor SMTP
    $mail->isSMTP();
    $mail->Host = SMTP_SERVER;
    $mail->Port = SMTP_PORT;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = 'tls';

    // Configurar el remitente y el destinatario
    $mail->setFrom(SMTP_USERNAME, 'Tu Nombre');
    $mail->addAddress($correo);

    // Configurar el asunto y el cuerpo del mensaje
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Enviar el correo electrónico
    $mail->send();
    echo "Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.";
} catch (Exception $e) {
    echo "Error al enviar el correo electrónico. Por favor, intenta de nuevo más tarde. Detalles del error: {$mail->ErrorInfo}";
}
?>

