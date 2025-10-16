 /**
 * ==========================================================================
 * @file        funciones.js
 * @author      José Daniel Real García
 * @date        15/10/2025
 * @version     1.0
 * @brief       Manejo de menú desplegable, carrusel de planetas y panel de detalle
 * @detail      Este script incluye:
 *                - Menú lateral tipo hamburger
 *                - Ocultamiento de cajas de información
 *                - Datos de planetas y creación dinámica de elementos DOM
 *                - Carrusel de planetas con scroll automático y manual
 *                - Panel de detalle de planetas con scroll bloqueado
 *                - Cierre de panel con click en botón o tecla Escape
 * ==========================================================================
 */

/* ==========================================================================
   @section: Menú lateral
   @detail  Control de apertura y cierre del menú tipo "hamburger"
   ========================================================================== */
const hamburger = document.getElementById('hamburger');
const sideMenu = document.getElementById('sideMenu');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  sideMenu.classList.toggle('open');
});

function closeInfo() {
  document.getElementById('infoBox').style.display = 'none';
}

/* ==========================================================================
   @section: Datos de planetas
   @detail  Array de objetos con información completa de cada planeta,
            incluyendo título, texto descriptivo y ruta de imagen.
   ========================================================================== */
const items = [
  // Ejemplo: Sol
  {id:'sol', title:'Sol', brief:'Estrella central — ver más...', text:`El Sol es la estrella central...`, img:'img/sol.png'},
  {id:'mercurio', title:'Mercurio', brief:'Más cercano al Sol — ver más...', text:`Mercurio es el planeta más cercano...`, img:'img/mercurio.png'},
  {id:'venus', title:'Venus', brief:'Hermano de la Tierra — ver más...', text:`Venus es el segundo planeta...`, img:'img/venus.png'},
  {id:'tierra', title:'Tierra', brief:'Nuestro hogar — ver más...', text:`La Tierra es el tercer planeta...`, img:'img/tierra.png'},
  {id:'marte', title:'Marte', brief:'El planeta rojo — ver más...', text:`Marte es el cuarto planeta...`, img:'img/marte.png'},
  {id:'jupiter', title:'Júpiter', brief:'Gigante gaseoso — ver más...', text:`Júpiter es el quinto planeta...`, img:'img/jupiter.png'},
  {id:'saturno', title:'Saturno', brief:'Sus anillos icónicos — ver más...', text:`Saturno es el sexto planeta...`, img:'img/saturno.png'},
  {id:'urano', title:'Urano', brief:'Gigante helado — ver más...', text:`Urano es el séptimo planeta...`, img:'img/urano.png'},
  {id:'neptuno', title:'Neptuno', brief:'Vientos extremos — ver más...', text:`Neptuno es el octavo planeta...`, img:'img/neptuno.png'},
  {id:'pluton', title:'Pluton', brief:'El planeta enano más grande — ver más...', text:`Plutón es un planeta enano...`, img:'img/pluton.png'},
];

/* ==========================================================================
   @section: Referencias DOM
   @detail  Referencias a elementos del DOM necesarios para carrusel
            y panel de detalle
   ========================================================================== */
const listEl = document.getElementById('list');
const carouselViewport = document.getElementById('carousel');
const detailEl = document.getElementById('detail');
const detailImg = document.getElementById('detail-img');
const detailTitle = document.getElementById('detail-title');
const detailText = document.getElementById('detail-text');
const closeBtn = document.getElementById('close');

/* ==========================================================================
   @section: Variables de estado
   @detail  Variables para control del scroll automático y offset del carrusel
   ========================================================================== */
let autoScroll = true;
let offset = 0;
const scrollSpeed = 0.45; 
let rafId = null;

/* ==========================================================================
   @section: Funciones para creación de elementos
   ========================================================================== */
/**
 * @function createPlanetBox
 * @param {Object} it - Objeto planeta
 * @returns {HTMLElement} Box del planeta con miniatura y título
 */
function createPlanetBox(it){
  const box = document.createElement('div');
  box.className = 'planet-box';

  const thumb = document.createElement('div');
  thumb.className = 'thumb';

  if(it.img){
    const img = document.createElement('img');
    img.src = it.img;
    img.alt = it.title;
    thumb.appendChild(img);
  } else {
    thumb.textContent = it.title[0];
  }

  const info = document.createElement('div');
  info.className = 'info';
  info.innerHTML = `
    <div class="title">${it.title}</div>
    <div class="brief">${it.brief}</div>
  `;

  box.appendChild(thumb);
  box.appendChild(info);

  box.addEventListener('click', () => showDetail(it));

  return box;
}

/**
 * @function renderList
 * @param {HTMLElement} container - Elemento contenedor
 * @param {Array} data - Array de planetas
 */
function renderList(container, data){
  data.forEach(it => container.appendChild(createPlanetBox(it)));
}

/* ==========================================================================
   @section: Renderización del carrusel
   ========================================================================== */
function renderLoopList(){
  listEl.innerHTML = '';
  renderList(listEl, items);
  renderList(listEl, items);
  offset = 0;
  listEl.style.transform = `translateY(0px)`;
  carouselViewport.style.overflowY = 'hidden';
  autoScroll = true;
  enableWheelToManual();
}

function renderOriginalList(){
  listEl.innerHTML = '';
  renderList(listEl, items);
  listEl.style.transform = 'none';
  carouselViewport.style.overflowY = 'auto';
  autoScroll = false;
}

/**
 * @function animateLoop
 * @detail  Animación de scroll automático en loop del carrusel
 */
function animateLoop(){
  if (autoScroll){
    const half = listEl.scrollHeight / 2 || 0;
    offset += scrollSpeed;
    if (half && offset >= half){
      offset = 0;
    }
    listEl.style.transform = `translateY(-${Math.round(offset)}px)`;
  }
  rafId = requestAnimationFrame(animateLoop);
}

/* ==========================================================================
   @section: Panel de detalle
   ========================================================================== */
function showDetail(item){
  detailTitle.textContent = item.title;
  detailText.textContent = item.text;

  detailImg.innerHTML = "";
  if(item.img){
    const img = document.createElement('img');
    img.src = item.img;
    img.alt = item.title;
    detailImg.appendChild(img);
  } else {
    detailImg.textContent = item.title[0];
  }

  detailEl.scrollTop = 0;
  detailEl.classList.add('show');

  document.body.style.overflow = 'hidden';
  carouselViewport.style.overflowY = 'hidden';
}

function closeDetail(){
  detailEl.classList.remove('show');
  document.body.style.overflow = '';
  carouselViewport.style.overflowY = autoScroll ? 'hidden' : 'auto';
}

closeBtn.addEventListener('click', closeDetail);
document.addEventListener('keydown', (e)=>{ if (e.key === 'Escape') closeDetail(); });

/* ==========================================================================
   @section: Scroll manual
   ========================================================================== */
function onWheelToManual(){
  if (!autoScroll) return;
  listEl.style.transform = `translateY(0px)`;
  renderOriginalList();
}

function enableWheelToManual(){
  carouselViewport.addEventListener('wheel', onWheelToManual, { passive: true, once: true });
}

/* ==========================================================================
   @section: Click fuera del carrusel para volver al loop
   ========================================================================== */
document.addEventListener('click', (e) => {
  if (!carouselViewport.contains(e.target) && !detailEl.contains(e.target) && !autoScroll) {
    renderLoopList();
  }
});

/* ==========================================================================
   @section: Inicialización
   ========================================================================== */
renderLoopList();
animateLoop();
