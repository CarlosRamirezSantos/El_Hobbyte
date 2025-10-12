<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';


function enviarCorreoRecuperacion($destinatario, $contrasena) {
    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';        
        $mail->SMTPAuth   = true;
        $mail->Username   = 'carlosramidaw2@gmail.com';   
        $mail->Password   = 'olaz wlln bhti jsqx';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
       

        
        
        $mail->CharSet = 'UTF-8';

       
        $mail->setFrom('carlosramidaw2@gmail.com', 'El Hobbyte - Recuperación Contraseña');
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'El Hobbyte: Recuperación de contraseña';
        $mail->Body    = "
        <h2>¡Saludos!</h2>
        <p>Se ha generado una nueva contraseña para tu acceso en <strong>El Hobbyte</strong>.</p>
        <p><strong>Contraseña asignada:</strong> <code>$contrasena</code></p>
        <hr>
        <small>Este correo se envía automáticamente y no requiere respuesta.</small>";
        $mail->send();
        return true;

   } catch (Exception $e) {
        echo "Error al enviar correo: {$mail->ErrorInfo}";
        return false;
    }
}