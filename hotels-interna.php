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
			data-scroll-offset="0" data-room="">RESERVE</a></div>
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

				<iframe src='https://maps.google.com/maps?hl=es&q=<?php echo $hotel["coordinates"]; ?>&ie=UTF8&t=&z=8&iwloc=B&output=embed' frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="Gmap" class="bg-gris"></iframe>

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
				<form action="<?php echo base_url; ?>contacto" id="frm-booking-lineal" method="POST">
					<div class="buscador-lineal">
						<h3><strong class="tprimario">MODIFY MY SEARCH</strong></h3>
						<div class="h10"></div>
						<div class="row">
							<div class="col-sm-3"><input type="text" name="destino" placeholder="Destination" value="<?php echo $hotel["name_destination"] ?>"  autocomplete="off" /></div>
							<div class="col-sm-2"><input type="text" id="from" name="from" placeholder="Check-in" autocomplete="off"></div>
							<div class="col-sm-2"><input type="text" id="to" name="to" placeholder="Check-out"  autocomplete="off"></div>
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
							<input type="hidden" name="room" id="room">
							<input type="hidden" name="hotel" value="<?php echo $hotel["name"] ?>">
							<input type="hidden" name="country" value="<?php echo $hotel["name_country"] ?>">
							<input type="hidden" name="state" value="<?php echo $hotel["name_state"] ?>">
							<div class="col-sm-2">
								<button class="btn-gral blue">BOOK NOW!</button>
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
			$count_rooms = $database->count("hb_rooms","*",["cod_rooms" => $cod_rooms]);
			// print_r($total_imagenes." - ".$count_rooms);
			$r = $database->select("hb_rooms","*",["cod_rooms" => $cod_rooms]);
			$contar = 0;
			?>
			<?php foreach ($r as $k => $v) { 
				if($contar >= $total_imagenes){
					$contar = 0;
				}
				?>
				<div class="rooms">
					<div class="row">
						<div class="col-sm-4">
							<div class="imagen">
								<img src="http://photos.hotelbeds.com/giata/<?=$imagenes[$contar];?>" class="img-responsive" alt="Propiedad" />
							</div>
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
									<!-- <p class="price">$106</p>
										<p>Nightly Price</p> -->
										<div class="h30"></div>
										<a href="javascript:;" class="btn-gral blue" data-scroll-to=".buscador-lineal"
										data-scroll-focus="#from"
										data-scroll-speed="700"
										data-scroll-offset="0" data-room="<?php echo $v["description"] ?>">RESERVE</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $contar++; } ?>

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
