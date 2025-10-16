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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 
        @section head_config Configuración del documento HTML
        Define el conjunto de caracteres, el viewport para diseño responsivo,
        el título de la página y los enlaces a las hojas de estilo y al ícono del sitio.
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="normalize.css"> <!-- Normaliza estilos por defecto del navegador -->
    <link rel="stylesheet" href="estilo_login.css"> <!-- Estilos personalizados para el login -->
    <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon"> <!-- Ícono del sitio -->
</head>

<body>

    <div class="container">
        <!-- 
            @section login_form Formulario de inicio de sesión
            Permite a los usuarios iniciar sesión con su correo electrónico y contraseña.
            Envía los datos mediante POST al archivo login_process.php.
        -->
        <div class="container-form">
            <form action="login_process.php" method="POST" class="sign-in">
                <h2>Iniciar Sesión</h2>

                <!-- Mensajes dinámicos de error o éxito en el inicio de sesión -->
                <?php if (isset($_GET['error'])): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <p style="color:green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
                <?php endif; ?>

                <!-- 
                    @subsection social_links Enlaces a redes sociales
                    Incluye enlaces a GitHub, Instagram y LinkedIn.
                -->
                <div class="social-networks">
                    <a href="https://github.com/yuamvord/Sistema_Solar_STEM.git"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://www.instagram.com/umgportalesgt"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/jos%C3%A9-daniel-real-garc%C3%ADa-532a06276?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BAEQSTXexRIqMYmm0HDAi8w%3D%3D"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>

                <span>Utilice su correo electrónico y contraseña</span>

                <!-- Campo de correo electrónico -->
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" id="identifier" name="identifier" required>
                </div>

                <!-- Campo de contraseña -->
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" id="password" name="password" required>
                </div>

                <!-- Enlace de recuperación de contraseña -->
                <a href="#">¿Olvidaste tu contraseña?</a>

                <!-- Botón para enviar el formulario de inicio de sesión -->
                <div class="button-group">
                    <button type="submit" class="button" id="btn-login-signin">INICIAR SESION</button>
                </div>
            </form>
        </div>

        <!-- 
            @section register_form Formulario de registro
            Permite crear una nueva cuenta de usuario.
            Envía los datos mediante POST al archivo register_process.php.
        -->
        <div class="container-form">
            <form action="register_process.php" method="POST" class="sign-up">
                <h2>Registrarse</h2>

                <!-- Enlaces a redes sociales -->
                <div class="social-networks">
                    <a href="https://github.com/yuamvord/Sistema_Solar_STEM.git"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://www.instagram.com/umgportalesgt"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/jos%C3%A9-daniel-real-garc%C3%ADa-532a06276?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BAEQSTXexRIqMYmm0HDAi8w%3D%3D"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>

                <span>Use su correo electrónico para registrarse</span>

                <!-- Campos del formulario de registro -->
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Nombre Completo" id="nombre" name="Nombre_Completo" required>
                </div>

                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Usuario" id="username" name="Username" required>
                </div>

                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" required id="email" name="Email">
                </div>

                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" id="password" name="Password" required minlength="8">
                </div>

                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Confirmar Contraseña" id="password2" name="Password2" required minlength="8">
                </div>

                <!-- Botón para enviar el formulario de registro -->
                <div class="button-group">
                    <button type="submit" class="button" id="btn-login-signup">REGISTRARME</button>
                </div>
            </form>
        </div>

        <!-- 
            @section welcome_panel Panel de bienvenida
            Permite alternar entre los formularios de inicio de sesión y registro.
        -->
        <div class="container-welcome">

            <!-- Panel de bienvenida para nuevos usuarios -->
            <div class="welcome-sign-up welcome">
                <h3>¡Bienvenido!</h3>
                <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>

            <!-- Panel de bienvenida para usuarios existentes -->
            <div class="welcome-sign-in welcome">
                <h3>¡Hola!</h3>
                <p>Regístrese con sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-in">Iniciar Sesión</button>
            </div>

        </div>

    </div>

    <!-- 
        @section scripts Inclusión de scripts
        Incluye los scripts necesarios para la funcionalidad del formulario y los iconos.
    -->
    <script src="script_login.js"></script> <!-- Script principal que maneja el comportamiento dinámico -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
