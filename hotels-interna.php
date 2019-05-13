<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';
$codigo = $_GET["secc"];
$hotel =  $database->get("hb_hotels","*",["code" => $codigo]);
?>
<div class="box-gris-interna">
	<div class="container">
		<div class="row">
			<div class="col-sm-12"><a href="<?=base_url;?>hotels" class="a-blue"><i class="fas fa-chevron-left"></i> ALL HOTELS</a></div>
			<div class="h20"></div>
			<div class="col-sm-8">
				<h2><?php echo $hotel["name"]; ?></h2>
				<div class="h10"></div>
				<p class="address"> <i class="fas fa-map-marker-alt"></i> <?php echo $hotel["address"]; ?></p>
			</div>
			<div class="col-sm-4"><a href="javascript:;" class="btn-gral blue fright">RESERVE</a></div>
			<div class="h30"></div>

			<div class="col-sm-8">
				<div class="slider-for slider-interna">
					<?php 
					$imagenes = explode("**", $hotel["images"]);
					$total_imagenes = count($imagenes); 
					for ($i=0; $i < $total_imagenes; $i++) {  
						if($imagenes[$i] !=""){
							?>
							<div><img src="http://photos.hotelbeds.com/giata/bigger/<?=$imagenes[$i];?>" alt="Propiedad" /></div>
							<?php 
						}
					} 
					?>
				</div>
				
				<div class="h10"></div>
				<div class="slider-nav">
					<?php 
					for ($i=0; $i < $total_imagenes; $i++) {  
						if($imagenes[$i] !=""){
							?>
							<div><img src="http://photos.hotelbeds.com/giata/<?=$imagenes[$i];?>" alt="Propiedad" / width="250"></div>
							<?php 
						}
					} ?>
				</div>
			</div>

			<div class="col-sm-4">
				<?php $estrellas = convierte_estrellas($hotel["s2c"]); ?>
				<strong><?php echo intval($estrellas["valor"])." / 5 ". $estrellas["recomendacion"]; ?></strong>
				<div class="stars">
					<?php  echo $estrellas["texto"]; ?>
				</div>

				<div class="h30"></div>

				<div id="Gmap"></div>

				<div class="h40"></div>

				<a href="#amenities" class="a-blue open-popup-link"><i class="fas fa-award"></i> ALL AMENITIES</a>
				<div class="h10"></div>
				<a href="#description" class="a-blue open-popup-link"><i class="far fa-building"></i> MORE ABOUT THIS HOTEL</a>
				<div class="h10"></div>
				<a href="<?php  echo $hotel["web"]; ?>" target="_BLANK" class="a-blue" target="_blank"><i class="fas fa-globe"></i> WEB SITE</a>
			</div>

			<div class="h40"></div>

			<div class="col-sm-12">
				<div class="buscador-lineal">
					<h3><strong class="tprimario">MODIFY MY SEARCH</strong></h3>
					<div class="h10"></div>
					<div class="row">
						<div class="col-sm-3"><input type="text" name="destino" placeholder="Destination" /></div>
						<div class="col-sm-2"><input type="text" id="from" name="from" placeholder="Check-in"></div>
						<div class="col-sm-2"><input type="text" id="to" name="to" placeholder="Check-out"></div>
						<div class="col-sm-1">
							<label>Rooms</label>
							<div class="select"><select><option>0</option></select></div>
						</div>
						<div class="col-sm-1">
							<label>Adults</label>
							<div class="select"><select><option>0</option></select></div>
						</div>
						<div class="col-sm-1">
							<label>Children</label>
							<div class="select"><select><option>0</option></select></div>
						</div>
						<div class="col-sm-2">
							<a href="javascript:;" class="btn-gral blue">SEARCH HOTELS</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="h40"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 tcenter">
			<h2>Choose your Room</h2>
		</div>

		<div class="h30"></div>

		<div class="col-sm-10 col-sm-offset-1">
			<?php  
			$rooms = explode("**", $hotel["rooms"]); 
			$cod_rooms = [];
			foreach ($rooms as $key => $value) {
				$room = json_decode($value);
				array_push($cod_rooms, $room->roomCode);
			}
			$r = $database->select("hb_rooms","*",["cod_rooms" => $cod_rooms]);
			?>
			<?php foreach ($r as $k => $v) { ?>
				<div class="rooms">
					<div class="row">
						<div class="col-sm-4">
							<div class="imagen" style="background-image: url('img/room.png');"></div>
						</div>

						<div class="col-sm-8">
							<div class="contenido">
								<div class="bx1">
									<h5><?php echo $v["description"] ?></h5>
									<!-- <p class="breve">Before Wed. May 15</p> -->
									<p class="icons"><span><i class="fas fa-bed"></i></span>Tipo: <?php echo $v["type"] ?></p>
									<p class="icons"><span><i class="fas fa-users"></i></span> <?php echo $v["minAdult"]; ?> Adulto(s) </p>
								</div>
								<div class="bx2">
									<p class="price">$106</p>
									<p>Nightly Price</p>
									<div class="h30"></div>
									<a href="javascript:;" class="btn-gral blue">RESERVE</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="h30"></div>

			<div class="tcenter">
				<a href="<?=base_url;?>hotels" class="a-blue"><i class="fas fa-chevron-left"></i> ALL HOTELS</a>
			</div>
		</div>
	</div>
</div>

<div class="h50"></div>


<div id="description" class="white-popup mfp-hide">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="tcenter">
					<i class="far fa-building icono-descripcion"></i>
					<div class="h20"></div>
					<h2 class="tprimario"><strong><?php  echo $hotel["name"]; ?></strong></h2>
					<div class="h15"></div>
					<h3>More about this hotel</h3>
				</div>
				<div class="h30"></div>
				<p><?php echo $hotel["description"]; ?></p>
			</div>
		</div>
	</div>
</div>
<div id="amenities" class="white-popup mfp-hide">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="tcenter">
					<i class="fas fa-award icono-descripcion"></i> 
					<div class="h20"></div>
					<h2 class="tprimario"><strong><?php  echo $hotel["name"]; ?></strong></h2>
					<div class="h15"></div>
					<h3>All Amenities</h3>
				</div>
				<div class="h30"></div>
				<?php  
				$facilities = explode("**", $hotel["facilities"]); 
				$cod_amenities = [];
				foreach ($facilities as $key => $value) {
					$amenitie = json_decode($value);
					array_push($cod_amenities, $amenitie->facilityCode);
				}
				$amen = $database->select("hb_facilities","name_facility",["AND" => ["cod_facilities" => $cod_amenities, "language_id" => 1]]);
				?>
				<ul class="amenities">
					<?php 
					for ($i=0; $i < count($amen); $i++) { 
						if($amen[$i] != "1" && $amen[$i] != "2"  && $amen[$i] != "3" && $amen[$i] != "4" && $amen[$i] != "5"){
							?>
							<li><?php echo ucfirst($amen[$i]); ?></li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- CONTENIDO -->

<?php require_once 'includes/_footer.php'; ?>
<script type="text/javascript">
	$("#header-main").addClass("Clor");

	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav',
		centerPadding: true
	});

	$('.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '.slider-for',
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: true
	});
	$('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true 
	});

</script>
<!-- GOOGLE MAPS JS -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDqOGOmxz5rKMwsUVUISapQOrChjEGfxQg"></script>
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
</body>
</html>
