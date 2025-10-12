document.addEventListener("DOMContentLoaded", function() {
  const container = document.querySelector(".container");
  const btnSignIn = document.getElementById("btn-sign-in");
  const btnSignUp = document.getElementById("btn-sign-up");

  // Botones de formularios de iniciar sesión
  const btnLoginSignIn = document.getElementById("btn-login-signin");
  const btnHomeSignIn = document.getElementById("btn-home-signin");

  // Botones de formularios de registro
  const btnLoginSignUp = document.getElementById("btn-login-signup");
  const btnHomeSignUp = document.getElementById("btn-home-signup");

  // Cambios de panel (animaciones)
  if (btnSignIn) btnSignIn.addEventListener("click", () => {
    container.classList.remove("toggle");
  });
  if (btnSignUp) btnSignUp.addEventListener("click", () => {
    container.classList.add("toggle");
  });

  // Redirecciones 
 /*if (btnLoginSignIn)
    btnLoginSignIn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });
*/
  if (btnHomeSignIn)
    btnHomeSignIn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });

 /* if (btnLoginSignUp)
    btnLoginSignUp.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });
*/
  if (btnHomeSignUp)
    btnHomeSignUp.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "index.php";
    });
});







