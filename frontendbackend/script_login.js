/**
 * ==========================================================================
 * @file        script_login.js
 * @author      José Daniel Real García
 * @date        15/10/2025
 * @version     1.0
 * @brief       Control de animaciones y redirecciones del formulario de 
 *              inicio de sesión (Sign In) y registro (Sign Up)
 * @detail      Este script maneja:
 *                - Animación de cambio de panel entre Sign In y Sign Up
 *                - Redirección de botones hacia la página "index.php"
 *                - Manejo de eventos DOMContentLoaded para asegurar 
 *                  que los elementos estén disponibles
 * ==========================================================================
 */

/** ==========================================================================
   @section: Esperar a que el DOM esté completamente cargado
   ========================================================================== */
document.addEventListener("DOMContentLoaded", function() {

  /** ==========================================================================
     @section: Selección de elementos principales
     @detail  Elementos del contenedor y botones que controlan la animación
     ========================================================================== */
  const container = document.querySelector(".container");  // Contenedor principal del formulario
  const btnSignIn = document.getElementById("btn-sign-in"); // Botón para cambiar a Sign In
  const btnSignUp = document.getElementById("btn-sign-up"); // Botón para cambiar a Sign Up

  /** ==========================================================================
     @section: Botones internos de Sign In
     @detail  Botones dentro del panel de Sign In
     ========================================================================== */
  const btnLoginSignIn = document.getElementById("btn-login-signin"); // Botón de login Sign In
  const btnHomeSignIn = document.getElementById("btn-home-signin");   // Botón de Home Sign In

  /** ==========================================================================
     @section: Botones internos de Sign Up
     @detail  Botones dentro del panel de Sign Up
     ========================================================================== */
  const btnLoginSignUp = document.getElementById("btn-login-signup"); // Botón de login Sign Up
  const btnHomeSignUp = document.getElementById("btn-home-signup");   // Botón de Home Sign Up

  /** ==========================================================================
     @section: Manejo de cambios de panel (Animaciones)
     @detail  Se agregan o remueven clases para activar animaciones de transición
     ========================================================================== */
  if (btnSignIn) 
    btnSignIn.addEventListener("click", () => {
      container.classList.remove("toggle"); // Muestra panel Sign In
    });

  if (btnSignUp) 
    btnSignUp.addEventListener("click", () => {
      container.classList.add("toggle");    // Muestra panel Sign Up
    });

  /** ==========================================================================
     @section: Redirecciones de botones
     @detail  Redirige a "index.php" según el botón presionado
     ========================================================================== */
  if (btnHomeSignIn)
    btnHomeSignIn.addEventListener("click", (e) => {
      e.preventDefault();                   // Previene acción por defecto
      window.location.href = "index.php";   // Redirige al home
    });

  if (btnHomeSignUp)
    btnHomeSignUp.addEventListener("click", (e) => {
      e.preventDefault();                   // Previene acción por defecto
      window.location.href = "index.php";   // Redirige al home
    });

  /** ==========================================================================
     @section: Redirecciones comentadas (Login buttons)
     @detail  Botones de login que actualmente están deshabilitados
     ========================================================================== */
  /**
  if (btnLoginSignIn)
    btnLoginSignIn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });
  
  if (btnLoginSignUp)
    btnLoginSignUp.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });
  */

});






