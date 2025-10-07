  // Menú desplegable
const hamburger = document.getElementById('hamburger');
const sideMenu = document.getElementById('sideMenu');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  sideMenu.classList.toggle('open');
});

function closeInfo() {
  document.getElementById('infoBox').style.display = 'none';
}

// Datos de ejemplo
const items = [
  {id:'sol', title:'Sol', brief:'Estrella central — ver más...', text:`El Sol es la estrella más cercana al planeta Tierra, ubicada a 149,6 millones de kilómetros de distancia. Se trata del centro del sistema solar: todos los planetas que lo integran, así como los cometas y asteroides conocidos, orbitan a su alrededor, atraídos por su gigantesca gravedad. Científicamente, el Sol se clasifica como una estrella enana amarilla, del tipo G2V. Es un tipo de estrella bastante común en la Vía Láctea. Está ubicado en una región exterior de la galaxia, en uno de sus brazos espirales (el “brazo de Orión”), a 26.000 años luz del centro galáctico. Actualmente, el Sol se halla en su secuencia principal de vida. El tamaño del Sol es tan grande que concentra el 99,86 % de toda la masa del sistema solar. Su masa es unas 743 veces mayor que la de todos los planetas juntos y alrededor de 330.000 veces la de la Tierra. Con un diámetro de 1,39 millones de kilómetros, es el objeto más grande y brillante que se ve desde nuestro planeta. El Sol es una enorme bola de plasma, casi perfectamente redonda. Está compuesto mayormente por hidrógeno (74,9 %) y helio (23,8 %), así como por una pequeña porción de elementos más pesados, como oxígeno, carbono, neón y hierro (2 %).
`, img:'img/sol.png'},
  {id:'mercurio', title:'Mercurio', brief:'Más cercano al Sol — ver más...', text:`Mercurio es la estrella más cercana...`, img:'img/mercurio.png'},
  {id:'venus', title:'Venus', brief:'Hermano de la Tierra — ver más...', text:`Venus es similar en tamaño a la Tierra...`, img:'img/venus.png'},
  {id:'tierra', title:'Tierra', brief:'Nuestro hogar — ver más...', text:`La Tierra es el único planeta conocido que alberga vida...`, img:'img/tierra.png'},
  {id:'marte', title:'Marte', brief:'El planeta rojo — ver más...', text:`Marte es conocido por su color rojizo...`, img:'img/marte.png'},
  {id:'jupiter', title:'Júpiter', brief:'Gigante gaseoso — ver más...', text:`Júpiter es el mayor planeta del sistema solar...`, img:'img/jupiter.png'},
  {id:'saturno', title:'Saturno', brief:'Sus anillos icónicos — ver más...', text:`Saturno es conocido por sus espectaculares anillos...`, img:'img/saturno.png'},
  {id:'urano', title:'Urano', brief:'Gigante helado — ver más...', text:`Urano tiene una inclinación axial extrema...`, img:'img/urano.png'},
  {id:'neptuno', title:'Neptuno', brief:'Vientos extremos — ver más...', text:`Neptuno es el planeta más lejano...`, img:'img/neptuno.png'},
];

// DOM refs
const listEl = document.getElementById('list');
const carouselViewport = document.getElementById('carousel');
const detailEl = document.getElementById('detail');
const detailImg = document.getElementById('detail-img');
const detailTitle = document.getElementById('detail-title');
const detailText = document.getElementById('detail-text');
const closeBtn = document.getElementById('close');

// Estado
let autoScroll = true;
let offset = 0;
const scrollSpeed = 0.45; 
let rafId = null;

// Crear planetas
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

// Render lista
function renderList(container, data){
  data.forEach(it => container.appendChild(createPlanetBox(it)));
}

// Loop de carrusel
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

// Animación auto
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

// Mostrar detalle
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

  detailEl.classList.add('show');
  // Bloquear scroll global y del carrusel
  document.body.style.overflow = 'hidden';
  carouselViewport.style.overflow = 'hidden';
}

// Cerrar detalle
function closeDetail(){
  detailEl.classList.remove('show');
  document.body.style.overflow = '';
  carouselViewport.style.overflowY = autoScroll ? 'hidden' : 'auto';
}
closeBtn.addEventListener('click', closeDetail);
document.addEventListener('keydown', (e)=>{ if (e.key === 'Escape') closeDetail(); });

// Scroll manual
function onWheelToManual(){
  if (!autoScroll) return;
  listEl.style.transform = `translateY(0px)`;
  renderOriginalList();
}
function enableWheelToManual(){
  carouselViewport.addEventListener('wheel', onWheelToManual, { passive: true, once: true });
}

// Click fuera para volver loop
document.addEventListener('click', (e) => {
  if (!carouselViewport.contains(e.target) && !detailEl.contains(e.target) && !autoScroll) {
    renderLoopList();
  }
});

// Init
renderLoopList();
animateLoop();
