<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';
?>

<!-- HTML SLIDER PRINCIPAL - CSS EN EL MAIN.LESS -->
<div class="slider-principal">
    <ul class="bxslider">
        <li class="slider slider-1"></li>
        <li class="slider slider-1"></li>
        <li class="slider slider-1"></li>
    </ul>
</div>

<!-- GENERA ALTURAS O ESPACIOS ENTRE DIVS - USAR VALORES CERRADOS COMO h10, h20 , h30 , h35 etc hasta h200 -->
<div class="h50"></div>
<!--
========================================================================================================================
========================================================================================================================
=========================================== FUNCIONES PARA FECHA Y HORA
                                IMPRIME FECHA EN FORMATO DÍA DE LA SEMANA, DÍA MES Y AÑO
1. Incluir _functions.php
2. Enviar fecha en formato yyyy-mm-dd
3. Asignar función a variable
4. imprimir la función
========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6 tcenter">
            <p>
                <?php
                $texto = fechaAString('2018-11-09');
                echo $texto;
                ?>
            </p>
        </div>
    </div>
</div>
<!--
========================================================================================================================
========================================================================================================================
=========================================== ARRAY DE ESTADOS EN UN SELECT
1. Incluir _functions.php
2. setear en una variable el array
3. hacer un for
========================================================================================================================
========================================================================================================================
-->
<div class="select">
<select name="estado" id="estado">
    <option value="">¿En qué Estado se encuentra tu negocio?</option>
    <?php
    $estados = estados();
    print_r($estados);
    for ($i=1; $i < count($estados) ; $i++) {
        ?>
        <option value="<?php echo $estados[$i]; ?>"><?php echo $estados[$i]; ?></option>
        <?php
    }

    ?>
</select>
</div>

<!--
========================================================================================================================
========================================================================================================================
=========================================== FUNCIONES PARA FECHA Y HORA
                                IMPRIME FECHA EN FORMATO DÍA y MES
1. Incluir _functions.php
2. Enviar fecha en formato yyyy-mm-dd
3. Asignar función a variable
4. imprimir la función
========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6 tcenter">
            <p>
                <?php
                $texto = fechaCastellano('2018-11-09');
                echo $texto;
                ?>
            </p>
        </div>
    </div>
</div>
<!--
========================================================================================================================
========================================================================================================================
=========================================== IMPRIME BREADCRUMBS EN LA PANTALLA

1. Incluir _functions.php
2. imprimir la función BREADCRUMBS
========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php echo breadcrumbs(); ?>
        </div>
    </div>
</div>
<!--
========================================================================================================================
========================================================================================================================
=========================================== IMPRIMIR SELECT DE PAÍSES
1. Incluir _functions.php
2. Asignar a variable la funcion arrayPaises
3. Recorrer la variable

========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <select name="pais" id="pais" class="select">
                <?php
                $paises = arrayPaises();
                foreach ($paises as $pais => $p) {
                    ?>
                    <option value="<?php echo $p["nomenclatura"]; ?>"><?php echo $p["pais"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
</div>
<!--
========================================================================================================================
========================================================================================================================
=========================================== FORMATEAR NÚMEROS CON MILES Y DOS DECIMALES
1. Incluir _functions.php
2. Asignar el número
3. Ocupar la función number_format
    3.1 Mandar número
    3.2 Mandar cantidad de decimales
    3.3 Separador de Decimales
    3.4 Separador de Millares
4. Imprimir la variable concatenando el símbolo de $

========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p><?php echo formatear_numero(1231254.233, "$","");?></p>
            <p><?php echo formatear_numero(1231254.233, "$","**");?></p>
            <p><?php echo formatear_numero(1231254.233, "$","**",3);?></p>
            <p><?php echo formatear_numero(123, "%","",0);?></p>
            <p><?php echo formatear_numero(123, "%"," ",2);?></p>
        </div>
    </div>
</div>

<!--
========================================================================================================================
========================================================================================================================
=========================================== FORMULARIO MODAL

1. require incluir includes/_modal.php
2. Se agrega el botón con atributos data-toggle, data-target y href vacío
3. Los estilos están en Bootstrap.less

========================================================================================================================
========================================================================================================================
-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <a href="javascript:;" class="btn-gral me-interesa" data-interes="Hola">ME INTERESA</a>
        </div>
    </div>
</div>
<?php require_once 'includes/_modal.php'; ?>
<!-- FORMULARIO DE CONTACTO
En el Main.js se encuentra el codigo que recorre la validación del formulario,
lo que se va a validar debe ir dentro de la clase "formulario-informacion".

El envio se hace por $.POST y se valida en _functions.php si se agregan nuevos inputs hay que agregar los inputs en el arreglo dentro de la funcion de contacto().

-->
<div class="container">
    <div class="row formulario-informacion">
        <div class="col-sm-4">
            <label>Interesado en: *</label>
            <div class="select">
                <select name="interes">
                    <option value="Producto 1" selected>Producto 1</option>
                    <option value="Producto 2">Producto 2</option>
                    <option value="Producto 3">Producto 3</option>
                </select>
            </div>
            <label>Nombre: *</label>
            <input type="text" name="nombre" />
            <label>Empresa:</label>
            <input type="text" name="empresa" />
            <label>Estado:</label>
            <div class="select"><select name="estado"><option value="">Estado *</option> <option value="Aguascalientes">Aguascalientes</option> <option value="Baja California">Baja California</option> <option value="Baja California Sur">Baja California Sur</option> <option value="Campeche">Campeche</option> <option value="CDMX">CDMX</option> <option value="Coahuila">Coahuila</option> <option value="Colima">Colima</option> <option value="Chiapas">Chiapas</option> <option value="Chihuahua">Chihuahua</option> <option value="Durango">Durango</option> <option value="Estado de México">Edo México</option> <option value="Guanajuato">Guanajuato</option> <option value="Guerrero">Guerrero</option> <option value="Hidalgo">Hidalgo</option> <option value="Jalisco">Jalisco</option> <option value="Michoacán">Michoacán</option> <option value="Morelos">Morelos</option> <option value="Nayarit">Nayarit</option> <option value="Nuevo León">Nuevo León</option> <option value="Oaxaca">Oaxaca</option> <option value="Puebla">Puebla</option> <option value="Querétaro">Querétaro</option> <option value="Quintana Roo">Quintana Roo</option> <option value="San Luis Potosí">San Luis Potosí</option> <option value="Sinaloa">Sinaloa</option> <option value="Sonora">Sonora</option> <option value="Tabasco">Tabasco</option> <option value="Tamaulipas">Tamaulipas</option> <option value="Tlaxcala">Tlaxcala</option> <option value="Veracruz">Veracruz</option> <option value="Yucatán">Yucatán</option> <option value="Zacatecas">Zacatecas</option></select></div>
        </div>
        <div class="col-sm-4">
            <label>Teléfono:</label>
            <input type="tel" name="telefono" id="telefono"> <!-- REFERENCIA 1: FORMATO MASK (442) 000-0000 -->
            <label>Correo electrónico:</label>
            <input type="email" name="email" />
            <label>¿Cómo supo de nosotros? *</label>
            <div class="select">
                <select name="fuente">
                    <option value="A través de Google" selected>A través de Google</option>
                    <option value="Redes Sociales">Redes Sociales</option>
                    <option value="Publicidad Impresa">Publicidad Impresa</option>
                    <option value="Visita de un Ejecutivo">Visita de un Ejecutivo</option>
                    <option value="Recomendación / Referencia">Recomendación / Referencia</option>
                    <option value="Mailing">Mailing</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <label>Mensaje:</label>
            <textarea name="mensaje"></textarea>
            <input type="hidden" name="area" value="Contáctanos">
        </div>

        <div class="col-sm-12 tcenter">
            <!-- CODIGO DEL RECAPTCHA -->
            <div class="g-recaptcha dib" data-sitekey="<?=captcha_front;?>"></div>
            <div class="h20"></div>
            <input id="frm-gral" type="button" value="Enviar" />
        </div>

    </div>
</div>
<div class="h50"></div>

<!-- EJEMPLO DE CHECKBOX -->
<div class="container">
    <div class="row">
        <div class="col-sm-12 tcenter">
            <input id="chk1" type="checkbox" /> <label for="chk1"><span></span>Opcion 1.</label>
            <input id="chk2" type="checkbox" /> <label for="chk2"><span></span>Opcion 2.</label>
        </div>
    </div>
</div>

<!-- EJEMPLOS DE POPUP -->
<div class="h100 clearfix"></div>

<div class="col-sm-4 tcenter">
    <label>
        Botón para ver video:<br>
        <a href="javascript:;" class="play">
            <i class="fa fa-play" aria-hidden="true"></i>
        </a>
    </label> <!-- REFERENCIA 2: MAGNIFIC POPUP -->
</div>

<div class="col-sm-4">
    <label>Paises</label>
    <select name="paises" id="paises" style="width: 100%;">
        <option value="" selected>Seleccione</option>
        <option value="AF">Afganistán</option>
        <option value="AL">Albania</option>
        <option value="DE">Alemania</option>
        <option value="AD">Andorra</option>
        <option value="AO">Angola</option>
        <option value="AI">Anguilla</option>
        <option value="AQ">Antártida</option>
        <option value="AG">Antigua y Barbuda</option>
        <option value="AN">Antillas Holandesas</option>
        <option value="SA">Arabia Saudí</option>
        <option value="DZ">Argelia</option>
        <option value="AR">Argentina</option>
        <option value="AM">Armenia</option>
        <option value="AW">Aruba</option>
        <option value="AU">Australia</option>
        <option value="AT">Austria</option>
        <option value="AZ">Azerbaiyán</option>
        <option value="BS">Bahamas</option>
        <option value="BH">Bahrein</option>
        <option value="BD">Bangladesh</option>
        <option value="BB">Barbados</option>
        <option value="BE">Bélgica</option>
        <option value="BZ">Belice</option>
        <option value="BJ">Benin</option>
        <option value="BM">Bermudas</option>
        <option value="BY">Bielorrusia</option>
        <option value="MM">Birmania</option>
        <option value="BO">Bolivia</option>
        <option value="BA">Bosnia y Herzegovina</option>
        <option value="BW">Botswana</option>
        <option value="BR">Brasil</option>
        <option value="BN">Brunei</option>
        <option value="BG">Bulgaria</option>
        <option value="BF">Burkina Faso</option>
        <option value="BI">Burundi</option>
        <option value="BT">Bután</option>
        <option value="CV">Cabo Verde</option>
        <option value="KH">Camboya</option>
        <option value="CM">Camerún</option>
        <option value="CA">Canadá</option>
        <option value="TD">Chad</option>
        <option value="CL">Chile</option>
        <option value="CN">China</option>
        <option value="CY">Chipre</option>
        <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
        <option value="CO">Colombia</option>
        <option value="KM">Comores</option>
        <option value="CG">Congo</option>
        <option value="CD">Congo, República Democrática del</option>
        <option value="KR">Corea</option>
        <option value="KP">Corea del Norte</option>
        <option value="CI">Costa de Marfíl</option>
        <option value="CR">Costa Rica</option>
        <option value="HR">Croacia (Hrvatska)</option>
        <option value="CU">Cuba</option>
        <option value="DK">Dinamarca</option>
        <option value="DJ">Djibouti</option>
        <option value="DM">Dominica</option>
        <option value="EC">Ecuador</option>
        <option value="EG">Egipto</option>
        <option value="SV">El Salvador</option>
        <option value="AE">Emiratos Árabes Unidos</option>
        <option value="ER">Eritrea</option>
        <option value="SI">Eslovenia</option>
        <option value="ES">España</option>
        <option value="US">Estados Unidos</option>
        <option value="EE">Estonia</option>
        <option value="ET">Etiopía</option>
        <option value="FJ">Fiji</option>
        <option value="PH">Filipinas</option>
        <option value="FI">Finlandia</option>
        <option value="FR">Francia</option>
        <option value="GA">Gabón</option>
        <option value="GM">Gambia</option>
        <option value="GE">Georgia</option>
        <option value="GH">Ghana</option>
        <option value="GI">Gibraltar</option>
        <option value="GD">Granada</option>
        <option value="GR">Grecia</option>
        <option value="GL">Groenlandia</option>
        <option value="GP">Guadalupe</option>
        <option value="GU">Guam</option>
        <option value="GT">Guatemala</option>
        <option value="GY">Guayana</option>
        <option value="GF">Guayana Francesa</option>
        <option value="GN">Guinea</option>
        <option value="GQ">Guinea Ecuatorial</option>
        <option value="GW">Guinea-Bissau</option>
        <option value="HT">Haití</option>
        <option value="HN">Honduras</option>
        <option value="HU">Hungría</option>
        <option value="IN">India</option>
        <option value="ID">Indonesia</option>
        <option value="IQ">Irak</option>
        <option value="IR">Irán</option>
        <option value="IE">Irlanda</option>
        <option value="BV">Isla Bouvet</option>
        <option value="CX">Isla de Christmas</option>
        <option value="IS">Islandia</option>
        <option value="KY">Islas Caimán</option>
        <option value="CK">Islas Cook</option>
        <option value="CC">Islas de Cocos o Keeling</option>
        <option value="FO">Islas Faroe</option>
        <option value="HM">Islas Heard y McDonald</option>
        <option value="FK">Islas Malvinas</option>
        <option value="MP">Islas Marianas del Norte</option>
        <option value="MH">Islas Marshall</option>
        <option value="UM">Islas menores de Estados Unidos</option>
        <option value="PW">Islas Palau</option>
        <option value="SB">Islas Salomón</option>
        <option value="SJ">Islas Svalbard y Jan Mayen</option>
        <option value="TK">Islas Tokelau</option>
        <option value="TC">Islas Turks y Caicos</option>
        <option value="VI">Islas Vírgenes (EEUU)</option>
        <option value="VG">Islas Vírgenes (Reino Unido)</option>
        <option value="WF">Islas Wallis y Futuna</option>
        <option value="IL">Israel</option>
        <option value="IT">Italia</option>
        <option value="JM">Jamaica</option>
        <option value="JP">Japón</option>
        <option value="JO">Jordania</option>
        <option value="KZ">Kazajistán</option>
        <option value="KE">Kenia</option>
        <option value="KG">Kirguizistán</option>
        <option value="KI">Kiribati</option>
        <option value="KW">Kuwait</option>
        <option value="LA">Laos</option>
        <option value="LS">Lesotho</option>
        <option value="LV">Letonia</option>
        <option value="LB">Líbano</option>
        <option value="LR">Liberia</option>
        <option value="LY">Libia</option>
        <option value="LI">Liechtenstein</option>
        <option value="LT">Lituania</option>
        <option value="LU">Luxemburgo</option>
        <option value="MK">Macedonia, Ex-República Yugoslava de</option>
        <option value="MG">Madagascar</option>
        <option value="MY">Malasia</option>
        <option value="MW">Malawi</option>
        <option value="MV">Maldivas</option>
        <option value="ML">Malí</option>
        <option value="MT">Malta</option>
        <option value="MA">Marruecos</option>
        <option value="MQ">Martinica</option>
        <option value="MU">Mauricio</option>
        <option value="MR">Mauritania</option>
        <option value="YT">Mayotte</option>
        <option value="MX">México</option>
        <option value="FM">Micronesia</option>
        <option value="MD">Moldavia</option>
        <option value="MC">Mónaco</option>
        <option value="MN">Mongolia</option>
        <option value="MS">Montserrat</option>
        <option value="MZ">Mozambique</option>
        <option value="NA">Namibia</option>
        <option value="NR">Nauru</option>
        <option value="NP">Nepal</option>
        <option value="NI">Nicaragua</option>
        <option value="NE">Níger</option>
        <option value="NG">Nigeria</option>
        <option value="NU">Niue</option>
        <option value="NF">Norfolk</option>
        <option value="NO">Noruega</option>
        <option value="NC">Nueva Caledonia</option>
        <option value="NZ">Nueva Zelanda</option>
        <option value="OM">Omán</option>
        <option value="NL">Países Bajos</option>
        <option value="PA">Panamá</option>
        <option value="PG">Papúa Nueva Guinea</option>
        <option value="PK">Paquistán</option>
        <option value="PY">Paraguay</option>
        <option value="PE">Perú</option>
        <option value="PN">Pitcairn</option>
        <option value="PF">Polinesia Francesa</option>
        <option value="PL">Polonia</option>
        <option value="PT">Portugal</option>
        <option value="PR">Puerto Rico</option>
        <option value="QA">Qatar</option>
        <option value="UK">Reino Unido</option>
        <option value="CF">República Centroafricana</option>
        <option value="CZ">República Checa</option>
        <option value="ZA">República de Sudáfrica</option>
        <option value="DO">República Dominicana</option>
        <option value="SK">República Eslovaca</option>
        <option value="RE">Reunión</option>
        <option value="RW">Ruanda</option>
        <option value="RO">Rumania</option>
        <option value="RU">Rusia</option>
        <option value="EH">Sahara Occidental</option>
        <option value="KN">Saint Kitts y Nevis</option>
        <option value="WS">Samoa</option>
        <option value="AS">Samoa Americana</option>
        <option value="SM">San Marino</option>
        <option value="VC">San Vicente y Granadinas</option>
        <option value="SH">Santa Helena</option>
        <option value="LC">Santa Lucía</option>
        <option value="ST">Santo Tomé y Príncipe</option>
        <option value="SN">Senegal</option>
        <option value="SC">Seychelles</option>
        <option value="SL">Sierra Leona</option>
        <option value="SG">Singapur</option>
        <option value="SY">Siria</option>
        <option value="SO">Somalia</option>
        <option value="LK">Sri Lanka</option>
        <option value="PM">St Pierre y Miquelon</option>
        <option value="SZ">Suazilandia</option>
        <option value="SD">Sudán</option>
        <option value="SE">Suecia</option>
        <option value="CH">Suiza</option>
        <option value="SR">Surinam</option>
        <option value="TH">Tailandia</option>
        <option value="TW">Taiwán</option>
        <option value="TZ">Tanzania</option>
        <option value="TJ">Tayikistán</option>
        <option value="TF">Territorios franceses del Sur</option>
        <option value="TP">Timor Oriental</option>
        <option value="TG">Togo</option>
        <option value="TO">Tonga</option>
        <option value="TT">Trinidad y Tobago</option>
        <option value="TN">Túnez</option>
        <option value="TM">Turkmenistán</option>
        <option value="TR">Turquía</option>
        <option value="TV">Tuvalu</option>
        <option value="UA">Ucrania</option>
        <option value="UG">Uganda</option>
        <option value="UY">Uruguay</option>
        <option value="UZ">Uzbekistán</option>
        <option value="VU">Vanuatu</option>
        <option value="VE">Venezuela</option>
        <option value="VN">Vietnam</option>
        <option value="YE">Yemen</option>
        <option value="YU">Yugoslavia</option>
        <option value="ZM">Zambia</option>
        <option value="ZW">Zimbabue</option>
    </select>
</div>

<div class="col-sm-4">
    <div class="pleca-galeria">
        <h1>Popup Video</h1>
        <div class="h20"></div>
        <div class="col-sm-12 galerias tcenter">
            <a href="https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_20mb.mp4" class="play1">
                <div class="item " style="background: url(<?= base_url; ?>img/vdo1.jpg);">
                    <div class="cortina">
                        <span>
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="h50"></div>


<!-- PLUGGIN SHARE SOLO AGREGAR ESTA LINEA DONDE SE REQUIERA YA CONTIENE EL JS Y EL HTML -->
<?php require_once 'includes/_share.php'; ?>

<div class="h50"></div>

<!-- HTML DEL MAPA EL CSS ESTA EN EL MAIN.LESS   -->
<div id="Gmap"></div>

<div class="clearfix"></div>

<?php require_once 'includes/_footer.php'; ?>
<script>
    $(document).ready(function () {
        // JS DEL SLIDER PRINCIPAL EL MOTOR ESTA EN PLUGGINS
        $('.slider-principal .bxslider').bxSlider({
            mode: "fade",
            pager: true,
            controls: false,
            auto: true
        });
    });
</script>
<!-- JS DEL RECAPTCHA -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- GOOGLE MAPS JS -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyASYLu_ygR7nlyy5t6qJq4N-O-HjsG12tk"></script>
<script type="text/javascript">
    // PONER DATOS CORRECTOS, SI LA EMPRESA CUENTA CON 2 o Mas sucursales simplemente agregarlos en el Array de markers.
    var markers = [
    {"partner": false, "name": "Corporativo", "contact": null, "address": "Carretera Humilpan No. 1004-A Col. Vista Alegre c.p. 76090 ", "city": "Querétaro", "state": "Qro", "email": "ventas@neochem.com.mx", "lat": "20.561948", "lng": "-100.374725", "red": false}];

    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng("20.561948", "-100.374725"),
            zoom: 15,  // Zoom del 1 al 22 - 22 es la vista mas cercana.
            panControl: true,
            zoomControl: true,
            scaleControl: true,
            overviewMapControl: true,
            streetViewControl: true,
            scrollwheel: false,
            styles: [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "poi", "elementType": "labels.text", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#dbdbdb"}, {"visibility": "on"}]}],
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("Gmap"), mapOptions);

        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();

        // Icono del mapa
        var image = 'img/map.png';

        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.name,
                icon: image
            });

            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    var zip = "";
                    if (data.zip !== null) {
                        zip = ", " + data.zip;
                    }

                    infoWindow.setContent("<div class='oficinas'><strong class='nombre'>" + data.name + "</strong><br/><span class='direccion'>" + data.address + "</span><br/><span class='email glyphicon glyphicon-envelope'>" + data.email + "</span></div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>
<!--**********************************
    REFERENCIA 1
    FORMATO DE NUMERO DE TELEFONO CON MASK
    https://igorescobar.github.io/jQuery-Mask-Plugin/
    **********************************
-->
<script type="text/javascript" src="<?=base_url?>js/jquery.maskedinput.js"></script>
<script>
    $("input[type=tel]").mask("(999) 999-9999", {placeholder : "(   ) ___-____"});
</script>

<!--**********************************
    REFERENCIA 2
    POP UP VIDEO
    http://dimsemenov.com/plugins/magnific-popup/documentation.html#gallery
    **********************************
-->
<style type="text/css">
/*****
    YOUTUBE.COM
    ******/
    .play {
        background: #000;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        padding: 13px 0px;
        position: relative;
        display: inline-block;
        text-align: center;
    }
    .play i {
        font-size: 24px;
        color: #fff;
    }
    .play:hover {
        background: #7f7f7f;
    }
/*****
    ARCHIVO MP4
    ******/
    .pleca-galeria {
      position: relative;
      width: 100%;
      height: auto;
      max-height: 100%;
      overflow: hidden;
      text-align: center;
  }
  .pleca-galeria .item {
      position: relative;
      display: inline-block;
      width: 208px;
      height: 208px;
      margin-right: 15px;
      margin-bottom: 25px;
      background-position: center center !important;
      background-repeat: no-repeat !important;
      background-size: cover !important;
  }
  .pleca-galeria .item .cortina {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      max-height: 100%;
      opacity: 0;
      z-index: 0;
      background: #000;
  }
  .pleca-galeria .item .cortina span {
      margin-top: 85px;
      display: inline-block;
      font-size: 40px;
  }
  .pleca-galeria .item .cortina span i {
      color: #fff;
  }
  .pleca-galeria .item:hover .cortina {
      opacity: 0.6;
      background: #304299;
      -moz-transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -o-transition: all 0.5s;
      transition: all 0.5s;
  }
</style>
<script>
    /*
        DESDE YOUTUBE.COM
        */
        $(".play").magnificPopup({
            items: {
                src: "https://www.youtube.com/watch?v=-BI6m_hCUFE"
            },
            type: "iframe",
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                '</div>',
                patterns: {
                    youtube: {
                        index: "youtube.com/",
                        id: "v=",
                        src: "//www.youtube.com/embed/%id%?autoplay=1"
                    }
                },
                srcAction: "iframe_src",
            }
        });
    /*
        DESDE UN ARCHIVO MP4
        */
        $(".play1").magnificPopup({
            type: "iframe",
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                '<div class="mfp-title">Some caption</div>'+
                '</div>'
            },
            callbacks: {
                markupParse: function(template, values, item) {
                    values.title = item.el.attr("title");
                }
            }
        });
    </script>

<!--**********************************
    REFERENCIA 3
    SELECT BUSQUEDAS
    http://select2.github.io/select2/
    **********************************
-->
<link href="<?= base_url ?>css/select2/select2.css" rel="stylesheet"/>
<script src="<?= base_url ?>js/select2.js"></script>
<script>
    $("#paises").select2();
    $("#paises").select2("val", "MX"); // ASIGNAR VALORES
</script>

</body>
</html>
