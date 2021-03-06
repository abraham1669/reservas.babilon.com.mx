<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
require_once 'includes/_menu.php';
$codigo = $_GET["secc"];
$hotel =  $database->get("hb_hotels",["[>]hb_countries" => ["countryCode" => "cod_country"],"[>]hb_states" => ["stateCode" => "cod_state"],"[>]hb_destinations" => ["destinationCode" => "cod_destination"]],"*",["code" => $codigo]);
?>
<div class="box-gris-interna">
	<div class="container">
		<div class="row">
			<div class="col-sm-12"><a href="<?=base_url;?>hotels" class="a-blue"><i class="fas fa-chevron-left"></i> ALL HOTELS</a></div>
			<div class="h20"></div>
			<div class="col-sm-8">
				<h2 id="hotel_name" data-options='{
				"nombre" : "<?php echo $hotel["nombre"]; ?>",
				"direccion" : "<?php echo $hotel["address"]; ?>",
				"ciudad" : "<?php echo $hotel["city"]; ?>",
				"cp" : "<?php echo $hotel["postalCode"]; ?>",
				"estado" : "<?php echo $hotel["name_state"]; ?>",
				"correo" : "<?php echo $hotel["email"]; ?>",
				"coordenadas" : "<?php echo $hotel["coordinates"]; ?>"
			}'><?php echo $hotel["name"]; ?></h2>
			<div class="h10"></div>
			<p class="address"> <i class="fas fa-map-marker-alt"></i> <?php echo $hotel["address"]; ?></p>
		</div>
		<div class="col-sm-4"><a href="javascript:;" class="btn-gral blue fright" data-scroll-to=".buscador-lineal"
			data-scroll-focus="#from"
			data-scroll-speed="700"
			data-scroll-offset="0" data-room="">AVAILABILITY</a></div>
			<div class="h30"></div>

			<div class="col-sm-8">
				<div class="slider-for slider-interna">
					<?php 
					$imagenes = json_decode($hotel["images"]);
					foreach ($imagenes as $key => $value) {
						if($value->path != ""){
							?>
							<div><img src="http://photos.hotelbeds.com/giata/bigger/<?=$value->path;?>" alt="Propiedad" /></div>
							<?php
						}
					}
					?>
				</div>

				<div class="h10"></div>
				<div class="slider-nav">
					<?php 
					foreach ($imagenes as $key => $value) {
						if($value->path != ""){
							?>
							<div><img src="http://photos.hotelbeds.com/giata/<?=$value->path;?>" alt="Propiedad" width="250" /></div>
							<?php
						}
					}
					?>
				</div>
			</div>

			<div class="col-sm-4">
				<?php $estrellas = convierte_estrellas($hotel["categoryCode"]); ?>
				<strong><?php echo intval($estrellas["valor"])." / 5 ". $estrellas["recomendacion"]; ?></strong>
				<div class="stars">
					<?php  echo $estrellas["texto"]; ?>
				</div>

				<div class="h30"></div>
				<?php
				$coordenadas = json_decode($hotel["coordinates"]);
				?>
				<iframe src='https://maps.google.com/maps?hl=es&q=<?php echo $coordenadas->longitude.",".$coordenadas->latitude; ?>&ie=UTF8&t=&z=8&iwloc=B&output=embed' frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="Gmap" class="bg-gris"></iframe>

				<div class="h40"></div>

				<a href="#amenities" class="a-blue open-popup-link"><i class="fas fa-award"></i> ALL AMENITIES</a>
				<div class="h10"></div>
				<a href="#description" class="a-blue open-popup-link"><i class="far fa-building"></i> MORE ABOUT THIS HOTEL</a>
				<div class="h10"></div>
				<?php 
				if (strpos($hotel["web"], 'http://') == false && strpos($hotel["web"], 'https://') == false) {
					$web = "http://".$hotel["web"];
				}else{
					$web = $hotel["web"];
				}
				?>
				<a href="<?php  echo $web; ?>" target="_BLANK" class="a-blue" target="_blank"><i class="fas fa-globe"></i> WEB SITE</a>
			</div>

			<div class="h40"></div>

			<div class="col-sm-12">
				<form action="<?php echo base_url; ?>hoteles/<?php echo $codigo; ?>" id="frm-booking-lineal" method="POST">
					<div class="buscador-lineal">
						<h3><strong class="tprimario">MODIFY MY SEARCH</strong></h3>
						<div class="h10"></div>
						<div class="row">
							<div class="col-sm-3"><input type="text" name="destino" placeholder="Hotel" value="<?php echo $hotel["name"] ?>"  autocomplete="off" /></div>
							<div class="col-sm-2"><input type="text" id="checkin" name="checkin" placeholder="Check-in" autocomplete="off"></div>
							<div class="col-sm-2"><input type="text" id="checkout" name="checkout" placeholder="Check-out"  autocomplete="off"></div>
							<div class="col-sm-1">
								<label>Rooms</label>
								<div class="select">
									<select id="rooms" name="rooms">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
							<div class="col-sm-1">
								<label>Adults</label>
								<div class="select">
									<select id="adults" name="adults">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</div>
							</div>
							<div class="col-sm-1">
								<label>Children</label>
								<div class="select">
									<select id="children" name="children">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
							<input type="hidden" name="hotel" value="<?php echo $hotel["codigo"] ?>">
							<div class="col-sm-2">
								<button class="btn-gral blue">RESERVE!</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="h40"></div>
<div class="container">
	<?php 
	if($_POST){
		$apiKey = "j7k63hxbg9fcekguh6pf73jt";
		$Secret = "W3MXcU22k7";
		$signature = hash("sha256", $apiKey.$Secret.time());
		$endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/hotels";
		try{	
			$request = [
				"stay" => [
					"checkIn" => $_POST["checkin"],
					"checkOut"=> $_POST["checkout"]
				],
				"occupancies" =>[			
					["rooms"=>$_POST["rooms"],
					"adults"=>$_POST["adults"],
					"children"=>$_POST["children"]]
				],
				"hotels" =>[
					"hotel" =>[$codigo]
				]
			];
			$datos =  json_encode($request);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_URL => $endpoint,
				CURLOPT_POSTFIELDS => $datos,
				CURLOPT_HTTPHEADER => ['Accept:application/json','Content-Type:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
			));
			$resp = curl_exec($curl);
			if (!curl_errno($curl)) {
				switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
			$respuesta = json_decode($resp, true);
			$hoteles = $respuesta["hotels"];
			print("<pre>".print_r($hoteles,true)."</pre>");
			break;
			default:
			echo 'Unexpected HTTP code: ', $http_code, "\n";
			echo $resp;
		}
	}
	curl_close($curl);
} catch (Exception $ex) {
	printf("Error while sending request, reason: %s\n",$ex->getMessage());
}
?>
<div class="row">
	<div class="col-sm-12 tcenter">
		<h2>Choose your Room</h2>
	</div>

	<div class="h30"></div>

	<div class="col-sm-10 col-sm-offset-1">
		<div class="rooms">
			<div class="row">
				<div class="col-sm-4">
					<div class="imagen">
						<!-- <img src="http://photos.hotelbeds.com/giata/<?#=$imagenes[$contar];?>" class="img-responsive" alt="Propiedad" /> -->
					</div>
				</div>

				<div class="col-sm-8">
					<div class="contenido">
						<div class="bx1">
							<h5><?php #echo $v["description"] ?></h5>
							<!-- <p class="breve">Before Wed. May 15</p> -->
							<p class="icons"><span><i class="fas fa-bed"></i></span>Tipo: <?php #echo $v["type"] ?></p>
							<p class="icons"><span><i class="fas fa-users"></i></span> <?php #echo $v["minAdult"]; ?> Adulto(s) </p>
						</div>
						<div class="bx2">
									<!-- <p class="price">$106</p>
										<p>Nightly Price</p> -->
										<div class="h30"></div>
										<a href="javascript:;" class="btn-gral blue" data-scroll-to=".buscador-lineal"
										data-scroll-focus="#from"
										data-scroll-speed="700"
										data-scroll-offset="0" data-room="<?php #echo $v["description"] ?>">RESERVE</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="h30"></div>

					<div class="tcenter">
						<a href="<?=base_url;?>hotels" class="a-blue"><i class="fas fa-chevron-left"></i> ALL HOTELS</a>
					</div>
				</div>
			</div>
			<?php
		}
		?>
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
		$(document).ready(function(){
			$("[data-scroll-to]").click(function() {
				let room = $(this).data("room");
				$("#room").val(room);
				var $this = $(this),
				$toElement      = $this.attr('data-scroll-to'),
				$focusElement   = $this.attr('data-scroll-focus'),
				$offset         = $this.attr('data-scroll-offset') * 1 || 0,
				$speed          = $this.attr('data-scroll-speed') * 1 || 500;

				$('html, body').animate({
					scrollTop: $($toElement).offset().top + $offset
				}, $speed);

				if ($focusElement) $($focusElement).focus();
			});
		});
	</script>
</body>
</html>
