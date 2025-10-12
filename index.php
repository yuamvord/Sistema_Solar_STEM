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
if (!isset($_SESSION['Username'])) {
    header("Location: frontendbackend/Login.php?error=Debes iniciar sesión primero");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Solar</title>
    <link rel="stylesheet" href="frontendbackend/estilo-index.css">
    <link rel="stylesheet" href="frontendbackend/normalize.css">
</head>
  <body>
    <header>
      <!--! @section header Encabezado del sitio web-->
      <div class="contenedor menu-nav">
        <div class="logo">
          <img 
            src="frontendbackend/img/logo-galaxia.png" 
            alt="logo-sistema-solar"
          />
        <a href="/">Sistema Solar</a>
        </div>
        <!--! @subsection menu Menú de navegación del sitio web --->
        <nav class="navegacion">
          <ul>
            <li><a href="frontendbackend/Interfaz.php">Interfaz | Sistema Solar</a></li>
            <li><a href="frontendbackend/somos.php">¿Quiénes somos?</a></li>
            <li><a href="frontendbackend/Login.php">Iniciar Sesión</a></li>
          </ul>
        </nav>
      </div>
      <!--! @subsection banner Banner e información inicial de la págin web -->
      <section class="contenedor-header">
        <div class="contenido-header">
          <h1>Sistema Solar Interactivo</h1>
          <p>
            Fuente de información interactivo para el aprendizaje orientado en el sistema solar, información detallada de cada planeta e información relacionada con el espacio. Nuestro proyecto tiene el objetivo de aprender y desarrollar nuevas habilidades y conocimientos de forma autodidacta.
          </p>
          <ul class="botones-header">
            <li><a href="#">Página de Inicio</a></li>
            <li><a href="#">¿Quiénes somos?</a></li>
          </ul>
        </div>
        <div>
          <img 
              src="frontendbackend/img/banner sistema solar.png" 
              alt="banner-header">
        </div>
      </section>
    </header>
  <!--! @section main Contenido principal de la página web --->
    <main>
      <!--! @subsection contenido Articulo y contenido de la página web acerca del sistema solar --->
      <div class="seccion-principal">
          <h2>Hola Mundo</h2>
          <p class="parrafo-titulo">Holaaaa holaaaaa</p>
          <section class="contenedor-articulos">
              <div class="articulo">
                <span class="etiqueta">Sistema Solar</span>
                <h2><a href="#">El Sol es la estrella más grande de nuestra Galaxia</a></h2>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro nemo, excepturi tempora vel praesentium laborum vero quidem, alias iste doloremque tempore, aperiam magnam atque amet asperiores veniam ullam sequi perspiciatis.
                </p>
                <div class="mas-información">
                  <a href="#">Leer más</a>
                  <span class="span-lectura">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore maxime id, in porro fuga eligendi doloribus perspiciatis minima quos nihil odio voluptates voluptatibus cupiditate laborum repellat consectetur expedita quaerat nobis.</span>
                </div>
              </div>
              <div class="articulo">
                <span class="etiqueta">Sistema Solar</span>
                <h2><a href="#">El Sol es la estrella más grande de nuestra Galaxia</a></h2>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro nemo, excepturi tempora vel praesentium laborum vero quidem, alias iste doloremque tempore, aperiam magnam atque amet asperiores veniam ullam sequi perspiciatis.
                </p>
                <div class="mas-informacion">
                  <a href="#">Leer más</a>
                  <span class="span-lectura">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore maxime id, in porro fuga eligendi doloribus perspiciatis minima quos nihil odio voluptates voluptatibus cupiditate laborum repellat consectetur expedita quaerat nobis.</span>
                </div>
              </div>
              <div class="articulo">
                <span class="etiqueta">Sistema Solar</span>
                <h2><a href="#">El Sol es la estrella más grande de nuestra Galaxia</a></h2>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro nemo, excepturi tempora vel praesentium laborum vero quidem, alias iste doloremque tempore, aperiam magnam atque amet asperiores veniam ullam sequi perspiciatis.
                </p>
                <div class="mas-información">
                  <a href="#">Leer más</a>
                  <span class="span-lectura">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore maxime id, in porro fuga eligendi doloribus perspiciatis minima quos nihil odio voluptates voluptatibus cupiditate laborum repellat consectetur expedita quaerat nobis.</span>
                </div>
              </div>
              <div class="articulo">
                <span class="etiqueta">Sistema Solar</span>
                <h2><a href="#">El Sol es la estrella más grande de nuestra Galaxia</a></h2>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro nemo, excepturi tempora vel praesentium laborum vero quidem, alias iste doloremque tempore, aperiam magnam atque amet asperiores veniam ullam sequi perspiciatis.
                </p>
                <div class="mas-información">
                  <a href="#">Leer más</a>
                  <span class="span-lectura">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore maxime id, in porro fuga eligendi doloribus perspiciatis minima quos nihil odio voluptates voluptatibus cupiditate laborum repellat consectetur expedita quaerat nobis.</span>
                </div>
              </div>
               <div class="contenedor-btn">
                  <a href="#" class="btn-ver-todos">Ver Todos</a>
               </div>
          </section>
      </div>
    </main>

    <!--! @section footer Pie de página con enlaces a redes sociales y otros accesos al sitio --->
    <footer>
      <!--! @subsection enlaces Submenus con enlaces a diferentes fuentes de la página --->
        <div class="contenedor-footer">
          <!--! @article recursos Enlaces a los recursos como documentación, accesos y repositorios --->
            <div class="fuentes-footer">
                <h3>Recursos</h3>    
                <ul>
                  <li><a href="#">Mapa del sitio</a></li>
                  <li><a href="#">Mapa del sitio</a></li>
                  <li><a href="#">Mapa del sitio</a></li>
                  <li><a href="#">Mapa del sitio</a></li>
                </ul>
            </div>
            <!--! @article páginas Enlaces a diferentes accesos dentro de la página --->

            <div class="paginas-footer">
                <h3>Páginas</h3>
                <ul>
                  <li><a href="#">¿Quines Somos?</a></li>
                  <li><a href="#">Contactenos</a></li>
                </ul>
            </div>
            <!--! @article explorar Enlaces redes sociales y recursos informativos de la empresa --->

            <div class="explorar-footer">
                <h3>Explorar</h3>
                <ul>
                  <li><a href="#">¿Quines Somos?</a></li>
                  <li><a href="#">Contactenos</a></li>
                </ul>
            </div>
            <!--! @article proyectos Enlaces a proyectos realizados por la empresa --->
            <div class="proyectos-footer">
                <h3>Proyectos</h3>
                <ul>
                  <li><a href="#">¿Quines Somos?</a></li>
                  <li><a href="#">Contactenos</a></li>
                </ul>
            </div>
        </div>
        <div class="contenedor-footer-2">
            <div class="footer-final">
              <p>&copy; 2025 - Sistema Solar | Desarrollado por José Real</p>
            </div>
        </div>
    </footer>

  </body>
</html>

