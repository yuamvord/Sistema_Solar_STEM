<!--!
  @file resetpass.php
  @brief Página para restablecer mi contraseña.
  @details 
  Este archivo/formulario ayuda y da asistencia al usuario para restablecer su contraseña.
  @author
  Dream Team Systems
  @date
  Octubre 2025
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTS | Restablecer Contraseña</title>
    <link rel="stylesheet" href="resetpass.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
    <!-- =======================================================
         FORMULARIO DE OLVIDÉ MI CONTRASEÑA
         ======================================================= -->
    <div class="container-form forgot-form">
        <form action="forgot_password_process.php" method="POST" class="forgot-password">
            <h2>Recuperar Contraseña</h2>

            <!-- Mensajes dinámicos -->
            <?php if (isset($_GET['error'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <p style="color:green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>

            <!-- Redes sociales (opcional para contacto) -->
            <div class="social-networks">
                <a href="https://github.com/yuamvord/Sistema_Solar_STEM"><ion-icon name="logo-github"></ion-icon></a>
                <a href="https://www.instagram.com/dreamteamsystems"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="http://www.linkedin.com/in/dts-dream-team-systems-041b9b364"><ion-icon name="logo-linkedin"></ion-icon></a>
            </div>

            <span>Ingrese su correo electrónico para restablecer la contraseña</span>

            <!-- Input de correo -->
            <div class="container-input">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" placeholder="Correo electrónico" name="email" required>
            </div>

            <!-- Botones -->
            <div class="button-group">
                <button type="submit" class="button" id="btn-forgot">ENVIAR ENLACE</button>
            </div>

            <!-- Enlace de regreso -->
            <a href="Login.php" class="back-login">Regresar al inicio de sesión</a>
        </form>
    </div>
</div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>