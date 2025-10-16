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
<!--!
/**
 * @file quienes-somos.html
 * @brief Página informativa "¿Quiénes Somos?" del Proyecto Sistema Solar.
 * @details 
 * Esta página describe al equipo de desarrollo del proyecto educativo interactivo sobre el sistema solar,
 * destacando los roles, funciones y especializaciones de cada integrante.  
 * 
 * Forma parte del Proyecto Final del curso de **Algoritmos** en la **Universidad Mariano Gálvez**.
 * @author 
 *   - José Daniel Real García  
 * @date 2025-10-15
 */
-->

<!DOCTYPE html>
<html lang="es">
<head>
  <!--!
  /**
   * @section metadata Metadatos del documento
   * @brief Contiene información de configuración, título y vínculos externos.
   * @details 
   * Se define la codificación, adaptabilidad del viewport, título de la pestaña del navegador,
   * y se enlazan los recursos de ícono y hoja de estilos principal.
   */
  -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>¿Quiénes Somos? | Proyecto Sistema Solar</title>
  <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon">
  <link rel="stylesheet" href="estilo-somos.css">
</head>

<body>
  <!--!
  /**
   * @section header Encabezado principal
   * @brief Presenta el título y una descripción general del propósito del equipo.
   * @details 
   * Describe el objetivo del proyecto, el contexto académico y el enfoque educativo del mismo.
   */
  -->
  <header class="header">
    <h1>¿Quiénes somos?</h1>
    <p>
      Somos un equipo de cinco estudiantes de la <strong>Universidad Mariano Gálvez</strong>, 
      comprometidos con la innovación y la aplicación de la tecnología para el aprendizaje. 
      Este proyecto fue desarrollado como parte del <strong>Proyecto Final del curso de Algoritmos</strong>, 
      con el objetivo de combinar programación, diseño y creatividad para ofrecer una experiencia educativa interactiva sobre el sistema solar.
    </p>
  </header>

  <!--!
  /**
   * @section main Contenido principal
   * @brief Contiene la presentación del equipo y sus respectivos roles.
   * @details 
   * Cada miembro se representa mediante una tarjeta con imagen, nombre, rol y descripción de funciones.
   */
  -->
  <main class="team-section">
    <div class="team-grid">
      <!--!
      /**
       * @subsection miembro1 Ariel Yuam Vides Ordoñez
       * @brief Chief Information Security Officer (CISO)
       * @details Supervisa la seguridad y estrategia tecnológica del proyecto.
       */
      -->
      <div class="team-member">
        <img src="img/yuamFoto.jpg" alt="Ariel Yuam Vides Ordoñez">
        <h3>Ariel Yuam Vides Ordoñez</h3>
        <span class="role">Chief Information Security Officer (CISO)</span>
        <p>
          Supervisa la estrategia tecnológica y la seguridad del proyecto. Garantiza la protección 
          de la infraestructura digital, la integridad de los datos y el cumplimiento de políticas 
          de seguridad, además de coordinar la gestión técnica general del equipo.
        </p>
      </div>

      <!--!
      /**
       * @subsection miembro2 José Daniel Real García
       * @brief Frontend Lead Developer
       * @details Lidera el desarrollo de interfaces web y garantiza la experiencia de usuario.
       */
      -->
      <div class="team-member">
        <img src="img/foto José Real.jpeg" alt="José Daniel Real García">
        <h3>José Daniel Real García</h3>
        <span class="role">Frontend Lead Developer</span>
        <p>
          Lidera el desarrollo de interfaces web, garantizando la implementación de experiencias 
          de usuario eficientes, responsivas y optimizadas. Supervisa el uso de buenas prácticas 
          en frameworks frontend y coordina la integración con el backend.
        </p>
      </div>

      <!--!
      /**
       * @subsection miembro3 José Miguel Argueta Ortíz
       * @brief Business Analyst
       * @details Responsable de la documentación técnica, análisis funcional y requerimientos.
       */
      -->
      <div class="team-member">
        <img src="img/foto José A.png" alt="José Miguel Argueta Ortíz">
        <h3>José Miguel Argueta Ortíz</h3>
        <span class="role">Business Analyst</span>
        <p>
          Responsable del levantamiento de requerimientos, análisis funcional y 
          documentación técnica del proyecto. Asegura la trazabilidad de los procesos 
          y la correcta comunicación entre las áreas técnicas y de negocio.
        </p>
      </div>

      <!--!
      /**
       * @subsection miembro4 Rodrigo Adrian Barrios Monterroso
       * @brief UX/UI Design Manager
       * @details Encargado del diseño visual, usabilidad y experiencia interactiva del usuario.
       */
      -->
      <div class="team-member">
        <img src="img/foto Adrian.png" alt="Rodrigo Adrian Barrios Monterroso">
        <h3>Rodrigo Adrian Barrios Monterroso</h3>
        <span class="role">UX/UI Design Manager</span>
        <p>
          Encargado del diseño visual y la experiencia interactiva del usuario. Define 
          la identidad gráfica, la usabilidad y la coherencia estética de los productos 
          digitales, alineándolos con los objetivos del proyecto.
        </p>
      </div>

      <!--!
      /**
       * @subsection miembro5 Moisés Abinadí Farfan González
       * @brief Hardware Engineering Manager
       * @details Supervisa la integración hardware-software y la validación de sistemas electrónicos.
       */
      -->
      <div class="team-member">
        <img src="img/foto Farfan.png" alt="Moisés Abinadí Farfan González">
        <h3>Moisés Abinadí Farfan González</h3>
        <span class="role">Hardware Engineering Manager</span>
        <p>
          Dirige el diseño, prototipado y validación de sistemas electrónicos e IoT. Supervisa
          la integración de hardware con software y asegura la funcionalidad y confiabilidad de 
          los dispositivos.
        </p>
      </div>
    </div>

    <!--!
    /**
     * @subsection back-link Enlace de retorno
     * @brief Enlace que redirige al usuario a la página de inicio.
     */
    -->
    <div class="back-link">
      <a href="../Index.php">← Página de Inicio</a>
    </div>
  </main>

  <!--!
  /**
   * @section footer Pie de página
   * @brief Contiene información de derechos de autor y créditos de desarrollo.
   */
  -->
  <footer class="footer">
    <p>&copy; 2025 - Dream Team Systems | Desarrollado por José Real y Yuam Vides</p>
  </footer>


  <script src="verificar_sesion.js"></script>

</body>
</html>

