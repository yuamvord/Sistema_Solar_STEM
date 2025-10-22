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
  {id:'sol', title:'Sol', brief:'Estrella central — ver más...', 
    text:`El Sol es la estrella central del Sistema Solar y el cuerpo celeste más masivo que conocemos, con un diámetro aproximado de 1.392.700 kilómetros. 
    Compuesto en un 74% por hidrógeno y en un 24% por helio, junto a trazas de elementos como oxígeno, carbono, neón y hierro, su energía se produce mediante 
    reacciones de fusión nuclear en su núcleo. En estas reacciones, el hidrógeno se transforma en helio liberando enormes cantidades de energía en forma de luz y 
    calor, que irradian hacia todo el Sistema Solar. La temperatura superficial del Sol es de aproximadamente 5.500 °C, mientras que en su núcleo puede alcanzar 
    hasta 15 millones de grados Celsius. La luz solar tarda unos 8 minutos y 20 segundos en llegar a la Tierra, recorriendo los 149,6 millones de kilómetros que 
    nos separan de él. Su gravedad es tan intensa que mantiene a todos los planetas y cuerpos menores en órbita, incluyendo asteroides y cometas. Sin el Sol, no 
    existiría la vida tal como la conocemos, ya que proporciona la energía necesaria para la fotosíntesis y regula los climas y ciclos estacionales de la Tierra. 
    La actividad solar se manifiesta en fenómenos como las manchas solares, las fulguraciones y las eyecciones de masa coronal, que pueden afectar las comunicaciones 
    y redes eléctricas de nuestro planeta. Su composición y comportamiento han sido estudiados durante siglos, primero a simple vista, luego mediante telescopios, 
    y finalmente con sondas y satélites especializados. Históricamente, el Sol ha sido venerado por distintas culturas como símbolo de vida, energía y poder, y su 
    estudio ha permitido entender la física de las estrellas y la evolución del universo. Aunque es solo una estrella promedio en la Vía Láctea, su influencia es 
    fundamental para el desarrollo de planetas habitables y para la formación de sistemas planetarios similares. La rotación del Sol no es uniforme: su ecuador 
    gira más rápido que los polos, lo que genera corrientes de plasma y campos magnéticos complejos. El ciclo solar dura aproximadamente 11 años, alternando entre 
    periodos de mayor y menor actividad, afectando el clima espacial. Su luz y calor permiten mantener temperaturas en la Tierra que oscilan entre niveles que permiten 
    la vida, y su radiación impulsa fenómenos meteorológicos, corrientes oceánicas y el ciclo del agua. A medida que envejece, el Sol se irá expandiendo lentamente, 
    convirtiéndose en una gigante roja dentro de aproximadamente 5.000 millones de años, etapa que transformará completamente el Sistema Solar. Las investigaciones 
    actuales buscan entender no solo la física solar, sino también cómo sus cambios pueden afectar la tecnología y la vida en la Tierra. Su importancia es incalculable, 
    ya que sin esta estrella no existirían los planetas habitables ni la energía que mantiene la vida.`, 
img:'img/sol.png'},

  {id:'mercurio', title:'Mercurio', brief:'Más cercano al Sol — ver más...', 
    text:`Mercurio es el planeta más cercano al Sol y el más pequeño del Sistema Solar, con un diámetro de aproximadamente 4.880 kilómetros. Su proximidad al Sol lo 
    hace extremadamente caliente durante el día, alcanzando temperaturas de hasta 427 °C, y muy frío por la noche, descendiendo hasta -173 °C debido a su casi inexistente 
    atmósfera que no retiene el calor. Su superficie está cubierta de cráteres, similares a los de la Luna, y extensas llanuras rocosas. Mercurio carece de satélites 
    naturales y su gravedad es apenas el 38% de la terrestre. Un día en Mercurio dura 58,6 días terrestres, mientras que un año equivale a solo 88 días terrestres, 
    lo que significa que el tiempo entre amaneceres es muy largo en comparación con la duración de su órbita. Su rotación y traslación generan un fenómeno llamado resonancia 
    3:2, donde gira tres veces sobre su eje por cada dos vueltas alrededor del Sol. Mercurio posee un núcleo metálico grande en proporción a su tamaño, lo que sugiere un 
    campo magnético débil pero significativo. Su superficie muestra evidencia de actividad geológica antigua y fracturas llamadas “lobate scarps” producidas por la contracción 
    de su corteza a medida que se enfriaba. La sonda MESSENGER de la NASA ha permitido mapear su composición, revelando altas concentraciones de elementos como azufre y 
    potasio. Mercurio es un planeta rocoso con poca atmósfera, formada principalmente por oxígeno, sodio, hidrógeno, helio y potasio, extremadamente tenue y variable según 
    la exposición solar. Su cercanía al Sol lo hace difícil de observar desde la Tierra, siendo visible solo cerca del horizonte durante el amanecer o el atardecer. 
    Históricamente, Mercurio ha sido asociado con el dios romano del comercio y la velocidad, debido a su rápida órbita alrededor del Sol. La exploración de Mercurio 
    permite entender la formación temprana de los planetas rocosos y la evolución del Sistema Solar interior. A pesar de su pequeño tamaño, su núcleo metálico indica 
    procesos de diferenciación compleja. Los científicos también estudian la posibilidad de hielo en los cráteres de sus polos, donde la luz solar nunca llega. Mercurio 
    carece de volcanes activos actualmente, pero evidencia de antiguas erupciones muestra que tuvo actividad geológica significativa. La radiación solar extrema y las 
    temperaturas cambiantes hacen de Mercurio un mundo inhóspito, pero crucial para comprender cómo los planetas cercanos a una estrella pueden evolucionar.`, 
  img:'img/mercurio.png'},

  {id:'venus', title:'Venus', brief:'Hermano de la Tierra — ver más...', 
    text:`Venus es el segundo planeta desde el Sol y es muy similar en tamaño y masa a la Tierra, lo que le ha valido el sobrenombre de “hermano de la Tierra”. 
    Su diámetro es de 12.104 kilómetros y posee una atmósfera extremadamente densa compuesta principalmente de dióxido de carbono, con nubes de ácido sulfúrico que 
    cubren todo el planeta. Esta atmósfera provoca un efecto invernadero extremo, haciendo que su temperatura superficial alcance unos constantes 462 °C, suficiente 
    para fundir plomo. La rotación de Venus es retrógrada y muy lenta, de modo que un día completo dura 243 días terrestres, más largo que su año, que es de 225 días 
    terrestres. Venus carece de satélites naturales y su superficie es inaccesible por la presión atmosférica, que es unas 92 veces mayor que la terrestre. Su topografía 
    muestra vastas llanuras volcánicas, montañas, cráteres de impacto y numerosos volcanes, algunos de los cuales podrían ser activos hoy. Los vientos en la atmósfera 
    superior superan los 360 km/h, moviendo rápidamente las nubes alrededor del planeta. Venus refleja mucha luz solar, por lo que es uno de los objetos más brillantes 
    del cielo nocturno, visible desde la Tierra a simple vista. Las misiones espaciales, como Magellan, han permitido mapear su superficie mediante radar, revelando 
    detalles de su geología y composición. Históricamente, Venus ha sido asociado con la diosa del amor y la belleza, y ha fascinado a la humanidad desde tiempos antiguos 
    por su brillo y cercanía. Su estudio es crucial para entender los efectos del cambio climático extremo y la dinámica atmosférica. La atmósfera genera fenómenos 
    eléctricos como relámpagos, y el metano y azufre presentes ofrecen pistas sobre procesos químicos complejos. Venus también presenta evidencias de tectónica de placas 
    incipiente y resurfacamiento volcánico, indicando que su interior está geológicamente activo. Comparar Venus con la Tierra permite estudiar cómo planetas similares 
    pueden evolucionar de manera drásticamente diferente debido a la composición atmosférica y la proximidad a su estrella. Además, Venus ha sido objetivo de investigaciones 
    para la búsqueda de vida microbiana en las capas altas de su atmósfera, donde las condiciones podrían ser menos hostiles.`, 
  img:'img/venus.png'},

  {id:'tierra', title:'Tierra', brief:'Nuestro hogar — ver más...', 
    text:`La Tierra es el tercer planeta desde el Sol y el único conocido que alberga vida. Su diámetro es de 12.742 kilómetros y está cubierta en aproximadamente 
    un 71% por agua, principalmente océanos, que regulan la temperatura global y permiten la existencia de ecosistemas diversos. Su atmósfera está compuesta principalmente 
    por nitrógeno (78%) y oxígeno (21%), con trazas de otros gases como argón, dióxido de carbono y vapor de agua. La interacción entre océanos, atmósfera y superficie 
    terrestre genera fenómenos como vientos, lluvias, huracanes y cambios estacionales. La Tierra rota sobre su eje cada 24 horas, lo que da lugar al ciclo día-noche, y 
    completa su órbita alrededor del Sol en 365,25 días. Su campo magnético, generado por el movimiento del núcleo de hierro líquido, protege al planeta de la radiación 
    solar y cósmica. La geología terrestre es dinámica: posee placas tectónicas que se mueven lentamente, provocando terremotos, volcanes y la formación de montañas. 
    La diversidad biológica de la Tierra es impresionante, con millones de especies de plantas, animales y microorganismos adaptados a distintos hábitats. La Luna, 
    su satélite natural, regula las mareas y estabiliza la inclinación del eje terrestre, contribuyendo a la estabilidad climática. La vida en la Tierra ha evolucionado 
    durante más de 3.500 millones de años, desde organismos unicelulares hasta seres humanos capaces de modificar el planeta. La energía solar es fundamental para mantener 
    los ecosistemas, impulsando la fotosíntesis y regulando el ciclo del agua. Los polos están cubiertos de hielo, que actúa como regulador térmico y refleja parte de la 
    radiación solar. La Tierra posee grandes desiertos, bosques, selvas, montañas y llanuras, cada uno con ecosistemas únicos. La interacción humana con el planeta ha 
    transformado su superficie, provocando urbanización, contaminación y cambios climáticos. La historia geológica de la Tierra incluye glaciaciones, formación de 
    continentes y extinciones masivas que han moldeado la vida actual. Los océanos contienen corrientes marinas que distribuyen el calor y regulan el clima global. 
    Los ríos y lagos son fuentes de agua dulce esenciales para la vida. La atmósfera protege de meteoritos pequeños que se desintegran antes de impactar. La Tierra 
    sigue evolucionando geológicamente y climáticamente, y los estudios científicos buscan entender su futuro y preservar sus recursos. Su posición en la zona habitable 
    del Sol la hace ideal para sostener vida compleja. La diversidad cultural humana ha sido posible gracias a la riqueza natural del planeta. Las energías renovables y 
    los esfuerzos de conservación son clave para mantener su equilibrio ecológico. La observación espacial de la Tierra permite monitorear el clima, los desastres naturales 
    y el impacto humano. La Tierra es un laboratorio vivo para entender procesos planetarios y la evolución de la vida en el universo.`, 
    img:'img/tierra.png'},

  {id:'marte', title:'Marte', brief:'El planeta rojo — ver más...', 
    text:`Marte es el cuarto planeta desde el Sol, conocido como el “Planeta Rojo” por el color rojizo de su superficie debido al óxido de hierro. Tiene un diámetro 
    de 6.779 kilómetros y su atmósfera es muy delgada, compuesta principalmente de dióxido de carbono, con pequeñas cantidades de nitrógeno y argón. La temperatura 
    varía entre -125 °C durante la noche y 20 °C durante el día en zonas ecuatoriales. Marte tiene un día similar al terrestre, de 24,6 horas, y un año de 687 días 
    terrestres. Posee dos lunas pequeñas, Fobos y Deimos, que se cree que son asteroides capturados por su gravedad. Su superficie está marcada por enormes volcanes, 
    siendo Olympus Mons el más grande del Sistema Solar con 22 km de altura. Los valles y cañones, como Valles Marineris, muestran que Marte tuvo actividad geológica e 
    incluso agua líquida en el pasado. Los polos están cubiertos de capas de hielo de agua y dióxido de carbono, que se expanden y retraen según las estaciones. Las 
    misiones de exploración, como los rovers Curiosity y Perseverance, han detectado compuestos orgánicos y minerales que indican la posible existencia de vida microbiana 
    en el pasado. Marte ha sido objeto de estudios sobre terraformación y colonización humana futura. Su gravedad es aproximadamente un tercio de la terrestre, lo que 
    afectaría la fisiología humana. La atmósfera fina y la ausencia de un campo magnético protector exponen la superficie a radiación solar intensa. Los desiertos 
    marcianos, dunas de arena y rocas erosionadas por el viento son testigos de procesos climáticos actuales. Los científicos buscan entender el ciclo del agua marciano 
    y la presencia de agua subterránea. Las tormentas de polvo pueden cubrir grandes regiones durante semanas, afectando la visibilidad y la temperatura. Marte posee 
    evidencia de antiguos ríos secos, deltas y minerales hidratados que sugieren un pasado húmedo. El estudio de su geología ayuda a comprender la evolución de los 
    planetas rocosos. La exploración de Marte también permite probar tecnologías para misiones espaciales prolongadas. El interés cultural por Marte ha inspirado 
    innumerables historias y proyectos de ciencia ficción. Comprender Marte es clave para entender cómo un planeta similar a la Tierra puede volverse inhóspito. 
    Sus estaciones, aunque más largas, tienen efectos visibles en los casquetes polares y en la atmósfera. Las investigaciones continúan sobre su magnetismo residual 
    y la historia de su núcleo. Marte sigue siendo un objetivo prioritario para futuras misiones tripuladas.`, 
  img:'img/marte.png'},

  {id:'jupiter', title:'Júpiter', brief:'Gigante gaseoso — ver más...', 
    text:`Júpiter es el quinto planeta desde el Sol y el más grande del Sistema Solar, con un diámetro de 139.820 kilómetros. Es un gigante gaseoso compuesto 
    principalmente de hidrógeno y helio, con trazas de metano, amoníaco, vapor de agua y otros compuestos. Su atmósfera está organizada en bandas de nubes con fuertes 
    vientos que superan los 600 km/h. La Gran Mancha Roja es una tormenta gigante, más grande que la Tierra, que ha estado activa durante siglos. Júpiter rota muy 
    rápidamente, completando un giro sobre su eje en solo 9,9 horas, lo que provoca un achatamiento visible en sus polos. Posee un sistema de anillos tenues y al menos 
    95 lunas confirmadas, siendo Ganímedes la mayor, más grande que Mercurio. Europa, otra de sus lunas, posee un océano subterráneo bajo su superficie helada, 
    considerado un candidato para la búsqueda de vida extraterrestre. La gravedad de Júpiter influye en la trayectoria de asteroides y cometas, protegiendo indirectamente 
    a la Tierra de impactos mayores. Sus auroras polares son más intensas que las terrestres y se generan por la interacción del viento solar con su fuerte campo magnético. 
    El planeta genera una radiación intensa que requiere protección para cualquier nave espacial cercana. Los vientos, tormentas y cinturones de nubes de Júpiter son 
    estudiados para comprender la dinámica atmosférica de los gigantes gaseosos. Su formación y composición ofrecen pistas sobre el origen del Sistema Solar y los planetas 
    exteriores. La exploración mediante sondas, como Juno, ha permitido estudiar su campo gravitatorio y magnético con gran precisión. La composición interna incluye 
    un posible núcleo rocoso rodeado de hidrógeno metálico líquido, generando un potente campo magnético. La observación de Júpiter desde la Tierra es fácil por su brillo 
    y tamaño aparente. Históricamente, Júpiter ha sido asociado con el dios romano del trueno y el cielo, reflejando su importancia cultural y astronómica. Su estudio 
    contribuye al entendimiento de otros sistemas planetarios y la formación de gigantes gaseosos. La interacción gravitatoria con sus lunas genera actividad volcánica 
    en Io y fracturas en Europa. Júpiter continúa siendo un laboratorio natural para estudiar fenómenos atmosféricos extremos y la evolución de planetas masivos.`, 
  img:'img/jupiter.png'},

  {id:'saturno', title:'Saturno', brief:'Sus anillos icónicos — ver más...', 
    text:`Saturno es el sexto planeta desde el Sol y el segundo más grande del Sistema Solar, con un diámetro de 116.460 kilómetros. Es un gigante gaseoso compuesto 
    principalmente de hidrógeno y helio, con trazas de metano, amoníaco y vapor de agua. Su característica más famosa es su espectacular sistema de anillos, formados 
    por partículas de hielo y roca de distintos tamaños, que orbitan el planeta creando un efecto visual impresionante. Saturno rota rápidamente sobre su eje, 
    completando un giro en aproximadamente 10,7 horas, lo que provoca un notable achatamiento en sus polos. La atmósfera de Saturno presenta bandas de nubes y tormentas 
    gigantescas, algunas visibles desde telescopios en la Tierra. Posee al menos 83 lunas confirmadas, siendo Titán la más grande, con una atmósfera densa compuesta 
    principalmente de nitrógeno y metano, y lagos de hidrocarburos en su superficie. Otras lunas, como Encelado, muestran actividad geológica y géiseres de agua, lo que 
    despierta interés sobre posibles entornos habitables. La gravedad de Saturno, aunque menos intensa que la de Júpiter, sigue siendo enorme y afecta la órbita de sus lunas 
    y los anillos. La exploración mediante sondas, como Cassini, ha permitido estudiar la composición química de los anillos, la atmósfera y las lunas con gran detalle. 
    Saturno emite más energía de la que recibe del Sol debido a la contracción de su núcleo, un fenómeno conocido como “calor de Kelvin-Helmholtz”. Las corrientes y vientos 
    en su atmósfera alcanzan velocidades de hasta 1.800 km/h. Los anillos de Saturno son dinámicos y muestran divisiones y estructuras complejas causadas por la interacción 
    gravitacional con sus lunas. Históricamente, Saturno ha sido asociado con el dios romano de la agricultura y el tiempo, reflejando su importancia en la mitología y 
    la cultura. Su estudio ayuda a comprender la formación de gigantes gaseosos y los sistemas de anillos en otros sistemas estelares. A pesar de su apariencia tranquila 
    desde la distancia, Saturno es un mundo activo con fenómenos atmosféricos extremos. La densidad de Saturno es tan baja que flotaría si existiera un océano suficientemente 
    grande. Su observación y estudio han sido clave para entender la física de los planetas masivos y los procesos de formación del Sistema Solar. Saturno sigue siendo un 
    laboratorio natural para estudiar la dinámica de anillos, lunas y atmósferas de gigantes gaseosos.`, 
  img:'img/saturno.png'},

  {id:'urano', title:'Urano', brief:'Gigante helado — ver más...', 
    text:`Urano es el séptimo planeta desde el Sol y un gigante helado, con un diámetro de 50.724 kilómetros. Su composición es principalmente de hidrógeno, helio y metano, 
    con un núcleo de roca y agua helada, lo que lo clasifica como un “gigante helado”. La característica más notable de Urano es su inclinación extrema de aproximadamente 98°, 
    haciendo que prácticamente “ruede” sobre su órbita, provocando estaciones extremas de 21 años cada una. La atmósfera de Urano tiene un color azul verdoso debido a la 
    absorción de luz roja por el metano. La temperatura promedio es de aproximadamente -224 °C, lo que lo convierte en uno de los planetas más fríos del Sistema Solar. Urano 
    posee 27 lunas conocidas y un sistema de anillos delgados y oscuros, descubiertos mediante observaciones astronómicas y misiones espaciales. Sus lunas presentan 
    características geológicas variadas, incluyendo cráteres, valles y montañas de hielo. La rotación de Urano dura 17,2 horas, y su año dura 84 años terrestres. Las 
    observaciones sugieren que el interior de Urano contiene un océano de agua, amoníaco y metano en estado líquido, rodeando un núcleo rocoso. La atmósfera superior 
    muestra vientos moderados y nubes de hielo, aunque menos visibles que en Júpiter o Saturno. Su inclinación extrema provoca fenómenos únicos de luz solar en los polos, 
    con periodos de oscuridad total o luz continua durante décadas. Históricamente, Urano fue el primer planeta descubierto mediante un telescopio en 1781 por William Herschel. 
    La exploración espacial de Urano ha sido limitada, principalmente gracias a la sonda Voyager 2, que pasó cerca en 1986, revelando detalles de su atmósfera y lunas. 
    Urano sigue siendo un objetivo de estudio para comprender la formación de gigantes helados y la dinámica atmosférica en condiciones extremas. La observación de su magnetismo 
    sugiere un campo magnético complejo, inclinado y desplazado respecto al centro del planeta. Su color y composición son claves para entender cómo los planetas con 
    metano atmosférico y baja temperatura se comportan. La investigación de Urano ayuda a comparar sistemas planetarios similares en otros sistemas estelares. A pesar de 
    su distancia, Urano se mantiene como un objeto brillante visible con telescopios desde la Tierra. Su estudio sigue proporcionando información valiosa sobre la diversidad 
    y evolución de los planetas exteriores.`, 
  img:'img/urano.png'},

  {id:'neptuno', title:'Neptuno', brief:'Vientos extremos — ver más...', 
    text:`Neptuno es el octavo planeta desde el Sol y otro gigante helado, ligeramente más pequeño que Urano, con un diámetro de 49.244 kilómetros. Compuesto principalmente 
    de hidrógeno, helio y metano, Neptuno muestra un intenso color azul debido a la absorción de luz roja por el metano en su atmósfera. Su temperatura promedio es de 
    aproximadamente -218 °C, y presenta los vientos más rápidos del Sistema Solar, que superan los 2.000 km/h. Neptuno rota sobre su eje en 16,1 horas y tarda 164,8 años 
    terrestres en completar una órbita alrededor del Sol. Posee 14 lunas conocidas, siendo Tritón la más grande, la cual presenta actividad geológica y géiseres de nitrógeno 
    que indican un interior aún activo. La gravedad de Neptuno influye en los objetos del cinturón de Kuiper y otros cuerpos menores del Sistema Solar exterior. Sus tormentas 
    y bandas de nubes son visibles mediante telescopios y muestran patrones atmosféricos complejos. La sonda Voyager 2 proporcionó la mayoría de la información directa sobre 
    Neptuno, incluyendo detalles de su magnetismo, atmósfera y lunas. La atmósfera superior contiene nubes de metano helado, y se observan estructuras como la Gran Mancha 
    Oscura, una tormenta comparable a la Gran Mancha Roja de Júpiter. Neptuno ha sido objeto de estudio para comprender la dinámica de los gigantes helados, su formación y 
    evolución. Tritón, con su órbita retrógrada, podría ser un objeto capturado del cinturón de Kuiper, lo que ofrece pistas sobre la historia de Neptuno. La observación y 
    modelado de su clima permiten entender procesos de viento extremo y transporte de calor en planetas fríos. La inclinación axial de Neptuno genera estaciones menos 
    extremas que Urano pero con variaciones significativas en los polos. Los estudios actuales buscan detectar cambios atmosféricos, tormentas y posibles variaciones en el 
    color y composición de las nubes. Neptuno sigue siendo clave para comprender la formación y evolución de los planetas gigantes del Sistema Solar exterior. Su exploración 
    futura podría revelar más sobre la actividad geológica de Tritón y los fenómenos atmosféricos del planeta.`, 
  img:'img/neptuno.png'},

  {id:'pluton', title:'Pluton', brief:'El planeta enano más grande — ver más...', 
    text:`Plutón es un planeta enano situado en el cinturón de Kuiper, con un diámetro de 2.377 kilómetros. Su superficie está compuesta de hielo de metano, nitrógeno 
    y monóxido de carbono, y presenta regiones montañosas, llanuras y cráteres. Plutón tiene cinco lunas conocidas, siendo Caronte la más grande, y juntos forman un sistema 
    binario, ya que orbitan un centro de masa común fuera de Plutón. Su órbita es muy elíptica y a veces se acerca más al Sol que Neptuno. La temperatura promedio en su 
    superficie es de aproximadamente -229 °C, lo que lo convierte en un mundo extremadamente frío. Plutón tarda 248 años terrestres en completar una órbita alrededor del Sol, 
    y su rotación dura 6,4 días terrestres. Las observaciones del telescopio y la sonda New Horizons revelaron detalles de su geología y composición, incluyendo regiones 
    jóvenes sin cráteres que indican actividad geológica reciente. Los glaciares de nitrógeno se desplazan lentamente sobre su superficie, y existen montañas de hielo de agua 
    que alcanzan varios kilómetros de altura. La delgada atmósfera de Plutón se forma cuando el hielo se sublima con la cercanía al Sol y se condensa nuevamente cuando se aleja, 
    creando un ciclo atmosférico estacional. Su superficie muestra un color rojizo característico debido a la radiación solar que transforma el metano en compuestos orgánicos 
    complejos llamados tholins. Plutón fue considerado el noveno planeta hasta 2006, cuando la Unión Astronómica Internacional lo reclasificó como planeta enano, aunque sigue 
    siendo de gran interés científico. Su estudio permite entender la formación de cuerpos transneptunianos y la historia del Sistema Solar exterior. La interacción con 
    Caronte genera mareas y efectos gravitacionales únicos, que afectan la rotación y estabilidad del sistema. Los datos obtenidos han revelado patrones climáticos, 
    variaciones de hielo y posibles capas subterráneas de agua. Plutón sigue siendo un laboratorio natural para estudiar mundos helados pequeños, su evolución geológica y 
    la dinámica atmosférica en condiciones extremas. Su exploración ha ampliado enormemente el conocimiento de los planetas enanos y los cuerpos del cinturón de Kuiper.`, 
  img:'img/pluton.png'},
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
