<?php
session_start();
require_once "conexion.php";

// Si no hay sesión activa → login
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
<!--
/**
 * @file index.html
 * @brief Página principal del Sistema Solar Interactivo.
 * @details Esta página muestra un modelo visual del sistema solar
 * con planetas orbitando y un panel lateral de información interactivo.
 * @author 
 *   - José Daniel Real García
 * @date 2025-10-15
 */
-->

<html lang="es">
<head>
  <!--
  /**
   * @section Cabecera
   * @brief Define la configuración inicial del documento.
   * Incluye el título, metadatos y enlaces a hojas de estilo.
   */
  -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Interfaz | Sistema Solar</title>

  <!--
  @note Se cargan las hojas de estilo principales para el diseño visual.
  -->
  <link rel="stylesheet" href="estilo.css" />
  <link rel="stylesheet" href="normalize.css">
  <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon">
</head>

<body>
  <!--
  /**
   * @section Título principal
   * @brief Muestra el encabezado principal de la página.
   */
  -->
  <h1>Sistema Solar Interactivo</h1>

  <!--
  /**
   * @section Menú desplegable
   * @brief Contiene el ícono tipo "hamburguesa" para mostrar/ocultar el menú lateral.
   * @details El menú lateral permite navegar hacia la página principal y la sección "¿Quiénes somos?".
   */
  -->
  <div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <nav class="side-menu" id="sideMenu">
    <ul>
      <li><a href="../index.php">Página de Inicio</a></li>
      <li><a href="somos.php">¿Quiénes somos?</a></li> 
    </ul>
  </nav>

  <!--
  /**
   * @section Sistema Solar
   * @brief Representa los planetas y sus órbitas.
   * @details Cada planeta tiene su órbita y un div asociado con su clase específica.
   */
  -->
  <div class="solarsystem">
    <div class="sun"></div>

    <div class="orbit orbit-mercury"><div class="planet mercury"></div></div>
    <div class="orbit orbit-venus"><div class="planet venus"></div></div>
    <div class="orbit orbit-earth"><div class="planet earth"></div></div>
    <div class="orbit orbit-mars"><div class="planet mars"></div></div>
    <div class="orbit orbit-jupiter"><div class="planet jupiter"></div></div>
    <div class="orbit orbit-saturn"><div class="planet saturn"></div></div>
    <div class="orbit orbit-uranus"><div class="planet uranus"></div></div>
    <div class="orbit orbit-neptune"><div class="planet neptune"></div></div>
    <div class="orbit orbit-pluton"><div class="planet pluton"></div></div>
  </div>

  <!--
  /**
   * @section Panel de detalles
   * @brief Contiene el carrusel y la descripción detallada de cada planeta.
   * @details Al seleccionar un planeta, se muestra información adicional
   * e imagen asociada en el panel derecho.
   */
  -->
  <div class="left-half">
    <div class="carousel-viewport" id="carousel">
      <div class="carousel-list" id="list"></div>
    </div>

    <div class="detail-panel" id="detail">
      <button class="close-btn" id="close">Cerrar ✕</button>
      <div class="detail-left">
        <div class="big-img" id="detail-img">☀</div>
        <div class="detail-title" id="detail-title">Título</div>
      </div>
      <div class="detail-right">
        <div class="detail-text" id="detail-text">Contenido extenso...</div>
      </div>
    </div>
  </div>

  <!--
  /**
   * @section Scripts
   * @brief Carga el archivo JavaScript principal con las funciones interactivas.
   */
  -->
  <script src="funciones.js"></script>
  <script src="verificar_sesion.js"></script>
</body>
</html>
