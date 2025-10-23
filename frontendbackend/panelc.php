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
    <script type="module">
    // Importa los módulos de Firebase (versión moderna)
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
    import { getDatabase, ref, set } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-database.js";

    // ⚙️ Configura tu Firebase aquí (reemplaza con tus datos reales)
    const firebaseConfig = {
  		apiKey: "AIzaSyBSi-HBeCQ-0G90M1Xv--LKK8ipCgRwTiU",
  		authDomain: "dreamteamsolarstem.firebaseapp.com",
  		databaseURL: "https://dreamteamsolarstem-default-rtdb.firebaseio.com",
  		projectId: "dreamteamsolarstem",
  		storageBucket: "dreamteamsolarstem.firebasestorage.app",
  		messagingSenderId: "1015544824617",
  		appId: "1:1015544824617:web:8b753ed0a6f242fa462d38",
  		measurementId: "G-7CVNPCP096"
	};

    // Inicializa Firebase
    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

    // 📤 Funciones para enviar comandos
    function sendCommand(type, value) {
      set(ref(db, 'control/' + type), value)
        .then(() => console.log(`✅ ${type} => ${value}`))
        .catch((e) => console.error('❌ Error:', e));
    }

    // Botones
    window.ledOn = () => sendCommand('led', 'on');
    window.ledOff = () => sendCommand('led', 'off');
    window.ledMode0 = () => sendCommand("mode", "0");
    window.ledMode1 = () => sendCommand("mode", "1");
    window.ledMode2 = () => sendCommand("mode", "2");
    window.motorRight = () => sendCommand('motor', 'right');
    window.motorLeft = () => sendCommand('motor', 'left');
    window.motorOff = () => sendCommand('motor', 'off');
    window.motorOn = () => sendCommand('motor', "on");
  </script>

</head>
<body>

<div class="container">
    <!--! =======================================================
         BOTÓN DE REGRESO
         ======================================================= -->
    <div class="back-button-container">
        <button class="button back-btn" onclick="history.back()">← Regresar</button>
    </div>

    <!--! =======================================================
         PANEL DE CONTROL ARDUINO
         ======================================================= -->
    <div class="container-panel">
        <h2 class="panel-title">Panel de Control</h2>

        <!--! =======================================================
             SECCIÓN DE LUCES LED
             ======================================================= -->
        <div class="section leds-section">
            <h3 class="section-title">Control de Luces LED</h3>
            <div class="button-group">
                <button class="button" id="led1" onclick="ledOn()">Encender LED</button>
                <button class="button" id="led2" onclick="ledOff()">Apagar LED</button>
                <button class="button" id="led3" onclick="ledMode0()">Rojo</button>
                <button class="button" id="led4" onclick="ledMode1()">Verde</button>
                <button class="button" id="led5" onclick="ledMode2()">Arcoiris</button>
            </div>
        </div>
 
        <!--! =======================================================
             SECCIÓN DE MOTOR
             ======================================================= -->
        <div class="section motor-section">
            <h3 class="section-title">Control del Motor</h3>
            <div class="button-group">
                <button class="button" id="motor-start" onclick="motorOn()">Iniciar</button>
                <button class="button" id="motor-stop" onclick="motorOff()">Detener</button>
                <button class="button" id="motor-clockwise" onclick="motorRight()">Girar Derecha</button>
                <button class="button" id="motor-counterclockwise" onclick="motorLeft()">Girar Izquierda</button>
            </div>
        </div>
    </div>

    <!--! =======================================================
         FOOTER
         ======================================================= -->
    <footer class="footer">
        <p>&copy; 2025 - Dream Team Systems | Desarrollado por José Real y Yuam Vides</p>
    </footer>
</div>

</body>
</html>