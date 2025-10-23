<!--!
  @file index.php
  @brief Página principal del sitio Sistema Solar Interactivo.
  @details 
  Este archivo contiene el encabezado, menú de navegación y secciones
  de contenido principales del sitio web educativo sobre el Sistema Solar.
  @author
  Dream Team Systems
  @date
  Octubre 2025
--->
<?php
session_start();
require_once "frontendbackend/conexion.php";


if (!isset($_SESSION['Username'])) {
    header("Location: frontendbackend/Login.php?error=Debes iniciar sesión primero");
    exit();
}



if (!isset($_SESSION['id'])) {
    header("Location: Login.php");
    exit();
}

// Verificar si el usuario está bloqueado
$id = $_SESSION['id'];
$sql = "SELECT Aprobado FROM users WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($aprobado);
$stmt->fetch();
$stmt->close();

// Si fue bloqueado → cerrar sesión y redirigir
if ((int)$aprobado === 0) {
    session_unset();
    session_destroy();
    header("Location: Login.php?error=Tu cuenta ha sido bloqueada por un administrador");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTS | Sistema Solar</title>
    <link rel="stylesheet" href="frontendbackend/estilo-index.css">
    <link rel="stylesheet" href="frontendbackend/normalize.css">
    <link rel="icon" href="frontendbackend/img/DreamTeam.ico" type="image/x-icon">
</head>
<body>
  <header>
    <div class="contenedor menu-nav">
      <div class="logo">
        <img src="frontendbackend/img/DreamTeam.png" alt="logo">
        <a href="index.php">Dream Team Systems</a>
      </div>

      <nav class="navegacion">
        <ul>
          <li><a href="frontendbackend/Interfaz.php">Interfaz | Sistema Solar</a></li>
          <li><a href="frontendbackend/somos.php">¿Quiénes somos?</a></li>
          <li><a href="frontendbackend/cerrarsesion.php">Cerrar Sesión</a></li>
        </ul>
      </nav>
    </div>

    <section class="contenedor-header">
      <div class="contenido-header">
        <h1>Sistema Solar Interactivo</h1>
        <p>
          Fuente de información interactivo para el aprendizaje orientado en el sistema solar, información detallada de cada planeta e información relacionada con el espacio. Nuestro proyecto tiene el objetivo de aprender y desarrollar nuevas habilidades y conocimientos de forma autodidacta.
        </p>
        <ul class="botones-header">
          <li><a href="frontendbackend/panelc.php">Panel de Control</a></li>
          <li><a href="index.php">Página de Inicio</a></li>
        </ul>
      </div>
    </section>
  </header>

  <!--! CONTENIDO PRINCIPAL -->
  <main>
    <section class="seccion-principal">
      <h2>Conoce el Sistema Solar</h2>
      <p class="parrafo-titulo">
        Explora información detallada sobre el Sistema Solar: su formación, estructura, planetas, asteroides, cometas y fenómenos celestes fascinantes.
      </p>

      <div class="info-general">
        <h3>¿Qué es el Sistema Solar?</h3>
        <p>El Sistema Solar está compuesto por el Sol y todos los cuerpos celestes que orbitan a su alrededor, incluyendo ocho planetas, planetas enanos, lunas, asteroides y cometas.</p>
        <p>Se formó hace aproximadamente 4.600 millones de años a partir del colapso de una nube de gas y polvo en la Vía Láctea, dando origen al Sol y a los planetas.</p>
        <p>Su estructura se divide en: el Sol como estrella central, los planetas interiores rocosos, los planetas exteriores gaseosos y los cinturones de objetos menores.</p>
        <div class="imagen-placeholder">
          <img src="frontendbackend/img/sistema_solar.jpg" alt="Imagen del Sistema Solar">
        </div>
      </div>

      <div class="planetas">
        <h3>Los Planetas</h3>
        <p>Hay ocho planetas principales: Mercurio, Venus, Tierra, Marte, Júpiter, Saturno, Urano y Neptuno. Los planetas interiores son rocosos y los exteriores son gigantes gaseosos o de hielo.</p>
        <div class="imagen-placeholder">
          <img src="frontendbackend/img/planetas.png" alt="Imagen de los planetas">
        </div>
        <p>Cada planeta tiene características únicas: <strong>Mercurio</strong> es el más cercano al Sol, <strong>Tierra</strong> tiene vida y agua líquida, <strong>Júpiter</strong> es el más grande y <strong>Neptuno</strong> es un gigante helado con fuertes vientos.</p>
      </div>

      <div class="otros-objetos">
        <h3>Otros Objetos Celestes</h3>
        <p>Además de los planetas y lunas, existen asteroides en el cinturón principal, cometas con órbitas elípticas, y cuerpos en el cinturón de Kuiper y la nube de Oort.</p>
        <p>Estos objetos son restos de la formación del Sistema Solar y nos ayudan a entender su evolución y composición química.</p>
        <div class="imagen-placeholder">
          <img src="frontendbackend/img/cuerpos_celestes.jpg" alt="Asteroides y cometas">
        </div>
      </div>

      <div class="datos-curiosos">
        <h3>Datos Curiosos</h3>
        <ul>
          <li>El Sol representa el 99,86% de la masa del Sistema Solar.</li>
          <li>El planeta más rápido es Mercurio, con una órbita de 88 días.</li>
          <li>Saturno tiene los anillos más espectaculares, formados por hielo y roca.</li>
          <li>Júpiter tiene más de 80 lunas confirmadas.</li>
          <li>El Sistema Solar viaja a unos 828.000 km/h alrededor del centro de la galaxia.</li>
        </ul>
      </div>

      <div class="contenedor-btn">
        <a href="frontendbackend/Interfaz.php" class="btn-ver-todos">Explorar más sobre el Sistema Solar</a>
      </div>
    </section>
  </main>

  <!--! FOOTER -->
  <footer>
    <div class="contenedor-footer">
      <div class="footer-logo">
        <img src="frontendbackend/img/DreamTeam.png" alt="Logo Dream Team">
      </div>
      <div class="fuentes-footer">
        <h3>Recursos</h3>
        <ul>
          <li><a href="Documents/Documentación - Sistema Solar" download="Documentación - Sistema Solar">Documentación</a></li>
          <li><a href="#">Informe</a></li>
          <li><a href="#">Manual de Usuario</a></li>
        </ul>
      </div>
      <div class="paginas-footer">
        <h3>Páginas</h3>
        <ul>
          <li><a href="frontendbackend/interfaz.php">Interfaz | Sistema Solar</a></li>
          <li><a href="frontendbackend/panelc.php">Panel de Control</a></li>
          <li><a href="frontendbackend/somos.php">¿Quiénes Somos?</a></li>
        </ul>
      </div>
      <div class="explorar-footer">
        <h3>Redes Sociales</h3>
        <ul>
          <li><a href="https://github.com/yuamvord/Sistema_Solar_STEM">GitHub</a></li>
          <li><a href="https://www.instagram.com/dreamteamsystems">Instagram</a></li>
          <li><a href="http://www.linkedin.com/in/dts-dream-team-systems-041b9b364">LinkedIn</a></li>
        </ul>
      </div>
      <div class="proyectos-footer">
        <h3>Proyectos</h3>
        <ul>
          <li><a href="index.php">Sistema Solar</a></li>
        </ul>
      </div>
    </div>
    <div class="contenedor-footer-2">
      <div class="footer-final">
        <p>&copy; 2025 - Dream Team Systems | Desarrollado por José Real y Yuam Vides</p>
      </div>
    </div>
  </footer>

</body>



    <script src="frontendbackend/verificar_sesion.js"></script>

  </body>
</html>

