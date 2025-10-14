<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Interfaz | Sistema Solar</title>
  <link rel="stylesheet" href="estilo.css" />
  <link rel="stylesheet" href="normalize.css">
  <link rel="icon" href="img/DreamTeam.ico" type="image/x-icon">
</head>
<body>
<h1>Sistema Solar Interactivo</h1>

<!-- Botón desplegable -->
<div class="hamburger" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</div>

<!-- Menú lateral -->
<nav class="side-menu" id="sideMenu">
  <ul>
    <li><a href="../index.php">Página de Inicio</a></li>
    <li><a href="somos.php">¿Quiénes somos?</a></li> 
  </ul>
</nav>

<!-- Información de cada planeta -->
<div class="solarsystem">
  <div class="sun"></div>

  <div class="orbit orbit-mercury">
    <div class="planet mercury"></div>
  </div>

  <div class="orbit orbit-venus">
    <div class="planet venus"></div>
  </div>

  <div class="orbit orbit-earth">
    <div class="planet earth"></div>
  </div>

  <div class="orbit orbit-mars">
    <div class="planet mars"></div>
  </div>

  <div class="orbit orbit-jupiter">
    <div class="planet jupiter"></div>
  </div>

  <div class="orbit orbit-saturn">
    <div class="planet saturn"></div>
  </div>

  <div class="orbit orbit-uranus">
    <div class="planet uranus"></div>
  </div>

  <div class="orbit orbit-neptune">
    <div class="planet neptune"></div>
  </div>

  <div class="orbit orbit-pluton">
    <div class="planet pluton"></div>
  </div>
</div>

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
  
  <script src="funciones.js"></script>
</body>
</html>