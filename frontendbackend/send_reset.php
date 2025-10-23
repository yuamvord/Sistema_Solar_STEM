<?php
include 'conexion.php';

// Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/phpmailer/src/Exception.php";
require __DIR__ . "/phpmailer/src/PHPMailer.php";
require __DIR__ . "/phpmailer/src/SMTP.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $query = $conexion->prepare("SELECT id FROM users WHERE Email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        
        // Generar token y guardar en BD
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $update = $conexion->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE Email=?");
        $update->bind_param("sss", $token, $expiry, $email);
        $update->execute();

        $resetLink = "http://localhost/SistemaSolarSTEM/frontendbackend/reset_password.php?token=" . $token;

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'avideso@miumg.edu.gt'; // tu correo gmail
            $mail->Password   = 'ivpphdvpgcvcafdc';     // tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Información del remitente
            $mail->setFrom('avideso@miumg.edu.gt', 'Recuperación de contraseña - Dream Team Systems');
            $mail->addAddress($email);

            // Contenido del mensaje
            $mail->isHTML(true);
            $mail->Subject = "Restablecer tu contraseña";
            $mail->Body    = "
                <h3>Solicitud de restablecimiento de contraseña</h3>
                <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                <a href='$resetLink'>Restablecer contraseña</a>
                <br><br>
                <p>Este enlace expirará en 1 hora.</p>
            ";

            $mail->send();
            echo "✅ Se ha enviado un enlace a tu correo.";
            header('Location: Login.php?reset=success');
            exit();
        } catch (Exception $e) {
            echo "❌ Error al enviar correo: {$mail->ErrorInfo}";
            header('Location: Login.php?reset=success');
            exit();
        }

    } else {
        echo "❌ No existe una cuenta con ese correo.";
    }
}
?>
