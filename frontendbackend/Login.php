<?php
/**
 * @file login.php
 * @brief Página principal para el inicio de sesión y registro de usuarios.
 * 
 * Este archivo contiene el formulario de inicio de sesión y registro,
 * maneja la sesión del usuario y redirige al index si ya se encuentra logueado.
 * 
 * @author 
 *   - José Daniel Real García 
 *   - Ariel Yuam Vides Ordoñez
 * @date 2025-10-15
 */ 

/**
 * @section session_start Manejo de sesión
 * Inicia la sesión y verifica si el usuario ya está autenticado.
 */
session_start();

/**
 * Verifica si la variable de sesión 'Username' está definida.
 * Si es así, redirige al archivo index.php ubicado en el nivel superior.
 */
if (isset($_SESSION['Username'])) {
    header("Location: ../index.php"); ///< Redirección a la página principal.
}
?>
<?php if (isset($_GET['reset']) && $_GET['reset'] == 'success'): ?>
<div id="alert" style="
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4caf50;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    z-index: 1000;
">
    Se ha enviado un enlace a tu correo.
</div>

<script>
    // Desaparece después de 4 segundos
    setTimeout(() => {
        const alertBox = document.getElementById('alert');
        if (alertBox) alertBox.style.display = 'none';
    }, 4000);
</script>
<?php endif; ?>

<?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
<div id="alert2" style="
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4caf50;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    z-index: 1000;
">
    Contraseña cambiada exitosamente
</div>

<script>
    // Desaparece después de 4 segundos
    setTimeout(() => {
        const alertBox2 = document.getElementById('alert2');
        if (alertBox2) alertBox2.style.display = 'none';
    }, 4000);
</script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--! 
        @section head_config Configuración del documento HTML
        Define el conjunto de caracteres, el viewport para diseño responsivo,
        el título de la página y los enlaces a las hojas de estilo y al ícono del sitio.
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="normalize.css"> <!--! Normaliza estilos por defecto del navegador -->
    <link rel="stylesheet" href="estilo_login.css"> <!--! Estilos personalizados para el login -->
    <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon"> <!--! Ícono del sitio -->
</head>

<div class="container">
    <!--! =======================================================
         FORMULARIO DE INICIO DE SESIÓN
         ======================================================= -->
    <div class="container-form">
        <form action="login_process.php" method="POST" class="sign-in">
            <h2>Iniciar Sesión</h2>

            <!--! Mensajes dinámicos -->
            <?php if (isset($_GET['error'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <p style="color:green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>

            <!--! Redes sociales -->
            <div class="social-networks">
                <a href="https://github.com/yuamvord/Sistema_Solar_STEM"><ion-icon name="logo-github"></ion-icon></a>
                <a href="https://www.instagram.com/dreamteamsystems"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="http://www.linkedin.com/in/dts-dream-team-systems-041b9b364"><ion-icon name="logo-linkedin"></ion-icon></a>
            </div>

            <span>Utilice su correo electrónico y contraseña</span>

            <!--! Inputs -->
            <div class="container-input">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" placeholder="Email" name="identifier" required>
            </div>

            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" placeholder="Contraseña" name="password" required>
            </div>

            <a href="resetpass.php">¿Olvidaste tu contraseña?</a>

            <div class="button-group">
                <button type="submit" class="button" id="btn-login-signin">INICIAR SESIÓN</button>
            </div>
        </form>
    </div>

    <!--! =======================================================
         FORMULARIO DE REGISTRO
         ======================================================= -->
    <div class="container-form">
        <form action="register_process.php" method="POST" class="sign-up">
            <h2>Registrarse</h2>

            <!--! Redes sociales -->
            <div class="social-networks">
                <a href="https://github.com/yuamvord/Sistema_Solar_STEM"><ion-icon name="logo-github"></ion-icon></a>
                <a href="https://www.instagram.com/dreamteamsystems"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="http://www.linkedin.com/in/dts-dream-team-systems-041b9b364"><ion-icon name="logo-linkedin"></ion-icon></a>
            </div>

            <span>Use su correo electrónico para registrarse</span>

            <!--! Inputs -->
            <div class="container-input">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" placeholder="Nombre Completo" name="Nombre_Completo" required>
            </div>

            <div class="container-input">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" placeholder="Usuario" name="Username" required>
            </div>

            <div class="container-input">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" placeholder="Email" name="Email" required>
            </div>

            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" placeholder="Contraseña" name="Password" required minlength="8">
            </div>

            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" placeholder="Confirmar Contraseña" name="Password2" required minlength="8">
            </div>

            <div class="button-group">
                <button type="submit" class="button" id="btn-login-signup">REGISTRARME</button>
            </div>
        </form>
    </div>

    <!--! =======================================================
         PANEL DE BIENVENIDA CON BOTONES
         ======================================================= -->
    <div class="container-welcome">
        <div class="welcome-sign-up welcome">
            <h3>¡Bienvenido!</h3>
            <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
            <button class="button" id="btn-sign-up">Registrarse</button>
        </div>
        <div class="welcome-sign-in welcome">
            <h3>¡Hola!</h3>
            <p>Regístrese con sus datos personales para usar todas las funciones del sitio</p>
            <button class="button" id="btn-sign-in">Iniciar Sesión</button>
        </div>
    </div>
</div>

    <!--! 
        @section scripts Inclusión de scripts
        Incluye los scripts necesarios para la funcionalidad del formulario y los iconos.
    -->
    <script src="script_login.js"></script> <!--! Script principal que maneja el comportamiento dinámico -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="login.js"></script>
</body>

</html>
