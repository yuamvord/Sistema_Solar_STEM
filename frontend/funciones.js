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