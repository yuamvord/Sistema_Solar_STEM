// Bloques de información de cada planeta
document.addEventListener('DOMContentLoaded', () => {
  const infoBox = document.getElementById('infoBox');
  const planetName = document.getElementById('planetName');
  const planetInfo = document.getElementById('planetInfo');

  const planets = document.querySelectorAll('.planet');

  planets.forEach(planet => {
    planet.addEventListener('click', () => {
      const name = planet.getAttribute('data-name');
      const info = planet.getAttribute('data-info');

      planetName.textContent = name;
      planetInfo.textContent = info;
      infoBox.style.display = 'block';
    });
  });

  // Menú desplegable
  const hamburger = document.getElementById('hamburger');
  const sideMenu = document.getElementById('sideMenu');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    sideMenu.classList.toggle('open');
  });
});

function closeInfo() {
  document.getElementById('infoBox').style.display = 'none';
}