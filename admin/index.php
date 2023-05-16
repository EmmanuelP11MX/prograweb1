<?php 
    require_once(__DIR__."/controllers/departamento.php");
    include_once(__DIR__."/controllers/sistema.php");
    include_once(__DIR__."/controllers/proyecto.php");
    include_once("views/header.php");
    include_once("views/menu.php");
    $sistema -> validateRol('Usuario');
    $reporte=$proyecto->chartProyecto();
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = google.visualization.arrayToDataTable([
            ['Element', 'Density', { role: 'style' }],
            <?php foreach($reporte as $key => $value): ?>
            ['<?php echo $value['mes']; ?>', <?php echo $value['cantidad'] ?>, '#b87333'],
            <?php endforeach; ?>
        ]);

        // Set chart options
        var options = {'title':'Proyectos mensuales', 'width':400, 'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
}
</script>
<body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
    <section>
        <div id="carouselExampleCaptions" class="carousel slide" >
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" id="slidertxt">
                <div class="carousel-item active">
                    <img src="images/construc01.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>OHLA implementa en España Coordinal y VerSat, dos soluciones digitales para una mejor gestión del clima urbano</h1>
                        <p>OHLA, a través de Ingesan, filial de cabecera de su línea de actividad de Servicios, ha implementado en España Coordinal y VerSat, dos soluciones digitales de diseño e propio. En concreto, la compañía ya emplea ambas herramientas en contratos vinculados a su línea de actividad de servicios urbanos aplicados a la gestión de zonas verdes y analiza extenderla a otros proyectos.  </p>
                    </div>
                    </div>
                <div class="carousel-item">
                <img src="images/terremoto.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>“Nuestros empleados en el país se han volcado con las personas afectadas por esta tragedia”</h1>
                    <p>Cihan Akkuş, director de Salud y Seguridad, y Fatih Memiş, director adjunto del proyecto ferroviario Marmaray, en Turquía, nos cuentan cómo ha sido su implicación personal y la de todo el equipo de OHLA en el país para ayudar a los equipos de rescate tras el fuerte terremoto acaecido el pasado 6 de febrero. Entre otras acciones, la compañía ha donado grupos electrógenos, torres de luz y otras herramientas y se encarga de su puesta en marcha y mantenimiento.</p>
                </div>
                </div>
                <div class="carousel-item">
                    <img src="images/construc02.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>+110 años construyendo historia</h1>
                        <p>Entre la multitud de realizaciones llevadas a cabo por OHLA en sus más de cien años de historia, destacan algunas que pueden considerarse emblemáticas por su dimensión, complejidad, innovación técnica o alcance social. En esta sección se recoge un catálogo no exhaustivo de algunas de estas actuaciones. </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <section class="container__page">
            <h3 class="subtitle">ACTUALIDAD</h3>
            <p class="about__paragraph">Ultimas noticias de nuestra compañía:</p>
            <section >
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="images/notar1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6>17 de febrero de 2023</h6>
                                <h5 class="card-title">Sobre negocio y situación financiera. Finalización de la recompra de bonos</h5>
                                <p class="card-text">OBRASCÓN HUARTE LAÍN, S.A. (OHLA o la Sociedad), en cumplimiento de lo establecido en el artículo 227 de la Ley del Mercado de Valores, pone en conocimiento de la Comisión Nacional del Mercado de Valores (CNMV) la siguiente OTRA INFORMACIÓN RELEVANTE</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/notar2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6>15 de febrero de 2023</h6>
                                <h5 class="card-title">El equipo de OHLA en Turquía dona maquinaria y herramientas para ayudar en las tareas de rescate del terremoto</h5>
                                <p class="card-text">Tras el fuerte terremoto que sacudió el sur de Turquía el pasado 6 de febrero, el equipo de OHLA en el país se ha movilizado donando maquinaria y equipamientos para ayudar en las labores de rescate.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="images/notar3.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6>13 de febrero de 2023</h6>
                                <h5 class="card-title">Ingesan introduce robots de limpieza para su servicio en hospitales</h5>
                                <p class="card-text">Ingesan, filial de cabecera de la división de Servicios de OHLA, ha presentado las nuevas unidades de robots autónomos de limpieza que desempeñarán su función en el Parque Hospitalario Martí i Julià (Girona).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <div id="fondo">
            <section class="presentation container">
                <div class="about__texts">
                    <h3 class="subtitle">Nuestro compromiso</h3>
                    <p class="about__paragraph">Nuestro compromiso con la igualdad, la sostenibilidad y la adhesión a distintas iniciativas impulsadas por la ONU, en el marco de la agenda 2030, marcan nuestra actividad, traducida en los siguientes objetivos:</p>
                    <ul>
                        <li><p class="about__paragraph">Apoyo a la inserción laboral de colectivos desfavorecidos, a través de la realización de más de 600 contrataciones.</p></li>
                        <li><p class="about__paragraph">Apuesta por una sociedad libre de violencia de género mediante la adhesión a la Red de Empresas por una Sociedad Libre de Violencia de Género, impulsada por el Ministerio de Sanidad, Consumo y Bienestar Social.</p></li>
                        <li><p class="about__paragraph">Cumplimiento del Pacto Mundial de las Naciones Unidas en materia de Responsabilidad Social Corporativa: implantación de sus Diez Principios basados en los derechos humanos, laborales, medioambientales y de lucha contra la corrupción.</p></li>
                    </ul>
                    <p class="about__paragraph">OHLA Servicios ha obtenido la certificación de Empresa Familiarmente Responsable (EFR) en el primer semestre del año 2020, otorgado por la Fundación Másfamilia. Se trata del sello de calidad que reconoce a las empresas que incorporan un sistema de gestión que permite el equilibrio entre la vida laboral y personal, sistema basado en el respeto, compromiso y flexibilidad.</p>
                </div>
                <figure class="about__img">
                    <img src="images/img4.jpg" class="about__picture" alt="img1">
                </figure>
            </section>
        </div>
        <div class="container__page">
            <h1 class="title">Proyectos Recientes</h1>
            <div class="card-group">
                <div class="card">
                    <img src="images/card1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Estaciones de las calles 63 y 72. Línea de Metro de la Segunda Avenida</h5>
                        <p class="card-text">En diciembre de 2016, OHLA, a través de su filial Judlau Contracting Inc., completó con éxito los trabajos adjudicados por la Autoridad Metropolitana del Transporte (MTA, atendiendo a sus siglas en inglés) en las estaciones de las calles 63 y 72, integradas en la nueva Línea de Metro de la Segunda Avenida, la cual amplía los servicios de las líneas Q y F.</p>
                        <p class="card-text"><small class="text-muted">EEUU / NUEVA YORK</small></p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/card2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ampliación del Puerto de Gijón</h5>
                        <p class="card-text">A instancias de la Autoridad Portuaria de Gijón, se han llevado a cabo la ampliación del puerto de la ciudad. Destacan, entre otras actuaciones, la construcción de 3.797 m de dique de abrigo. También se han realizado 1.365 m de muelle, con cajones de hormigón armado (cimentado a la cota -23,00), 1.650 m de taludes interiores en el cierre de las explanadas, 140 ha de explanada y 145 ha de agua abrigada.</p>
                        <p class="card-text"><small class="text-muted">ESPAÑA / GIJÓN</small></p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/card3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Autovía del Cantábrico A-8. Tramo Lindín-Careira</h5>
                        <p class="card-text">Con 10,4 km de longitud, el tramo discurre por un terreno accidentado, que ha exigido construir cinco viaductos. En su trazado, la A-8 alcanza su punto más alto en Galicia, 698 m sobre el nivel del mar, en el alto de O Fiouco, donde ha sido necesario instalar un importante sistema de balizas para el guiado del tráfico en condiciones de baja visibilidad. Este tramo y el de Mondoñedo-Lindín, eran los dos últimos en fase de construcción de la Autovía del Cantábrico, en Galicia. </p>
                        <p class="card-text"><small class="text-muted">ESPAÑA / GALICIA</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
    include_once("views/footer.php");
?>