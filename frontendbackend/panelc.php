<!--!
  @file panelc.php
  @brief Panel de control con botones para dar instrucciones al arduino.
  @details 
  Este archivo nos brinda apoyo para manejar las funciones e instrucciones que 
  podemos darle a nuestro Arduino para manejar el motor y las luces LED.
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
    <title>DTS | Panel de Control</title>
    <link rel="stylesheet" href="panelc.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="icon" href="frontendbackend/img/DreamTeam.ico" type="image/x-icon">
</head>
<body>

<div class="container">
    <!-- =======================================================
         BOTÓN DE REGRESO
         ======================================================= -->
    <div class="back-button-container">
        <button class="button back-btn" onclick="history.back()">← Regresar</button>
    </div>

    <!-- =======================================================
         PANEL DE CONTROL ARDUINO
         ======================================================= -->
    <div class="container-panel">
        <h2 class="panel-title">Panel de Control</h2>

        <!-- =======================================================
             SECCIÓN DE LUCES LED
             ======================================================= -->
        <div class="section leds-section">
            <h3 class="section-title">Control de Luces LED</h3>
            <div class="button-group">
                <button class="button" id="led1">LED 1</button>
                <button class="button" id="led2">LED 2</button>
                <button class="button" id="led3">LED 3</button>
                <button class="button" id="led4">LED 4</button>
                <button class="button" id="led5">LED 5</button>
            </div>
        </div>

        <!-- =======================================================
             SECCIÓN DE MOTOR
             ======================================================= -->
        <div class="section motor-section">
            <h3 class="section-title">Control del Motor</h3>
            <div class="button-group">
                <button class="button" id="motor-start">Iniciar</button>
                <button class="button" id="motor-stop">Detener</button>
                <button class="button" id="motor-clockwise">Girar CW</button>
                <button class="button" id="motor-counterclockwise">Girar CCW</button>
            </div>
        </div>
    </div>

    <!-- =======================================================
         FOOTER
         ======================================================= -->
    <footer class="footer">
        <p>&copy; 2025 - Dream Team Systems | Desarrollado por José Real y Yuam Vides</p>
    </footer>
</div>

</body>
</html>