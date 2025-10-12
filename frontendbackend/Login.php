<?php
session_start();
if (isset($_SESSION['Username'])) {
    header("Location: ../index.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="estilo_login.css">
</head>

<body>

    <div class="container">
    <!--- Formulario de inicio de sesion --->
        <div class="container-form">
            <form action="login_process.php" method="POST" class="sign-in">
                <h2>Iniciar Sesión</h2>
                <?php if (isset($_GET['error'])): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <p style="color:green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
                <?php endif; ?>
                <div class="social-networks">
                    <a href="https://github.com/yuamvord/Sistema_Solar_STEM.git"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://www.instagram.com/umgportalesgt"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/jos%C3%A9-daniel-real-garc%C3%ADa-532a06276?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BAEQSTXexRIqMYmm0HDAi8w%3D%3D"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
                <span>Utilice su correo electrónico y contraseña</span>
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" id="identifier" name="identifier" required>
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" id="password" name="password" required>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <div class="button-group">
                    <button type="submit" class="button" id="btn-login-signin">INICIAR SESION</button>
                    <button class="button2" id="btn-home-signin">PAGINA INICIAL</button>
                </div>
            </form>
        </div>
        <!--- Formulario de registro --->            
        <div class="container-form">
            <form action="register_process.php" method="POST" class="sign-up">
                <h2>Registrarse</h2>
                <div class="social-networks">
                    <a href="https://github.com/yuamvord/Sistema_Solar_STEM.git"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://www.instagram.com/umgportalesgt"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/jos%C3%A9-daniel-real-garc%C3%ADa-532a06276?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BAEQSTXexRIqMYmm0HDAi8w%3D%3D"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
                <span>Use su correo electrónico para registrarse</span>
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
                <div class="button-group">
                    <button type="submit" class="button" id="btn-login-signup">REGISTRARME</button>
                    <button class="button2" id="btn-home-signup">PAGINA INICIAL</button>
                </div>
            </form>
        </div>

        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <h3>¡Bienvenido!</h3>
                <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <h3>¡Hola!</h3>
                <p>Registrese con sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>

    </div>


    <script src="script_login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>