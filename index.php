<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';
?>


<div class="home">
	<div class="box">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="book black">
							<h1>BOOK A HOTEL</h1>
							<div class="h10"></div>
							<input type="text" name="destino" placeholder="Destination" id="destino" />
							<input type="hidden" id="valor" name="valor">
							<div class="row">
								<div class="col-sm-6"><input type="text" id="from" name="from" placeholder="Check-in"></div>
								<div class="col-sm-6"><input type="text" id="to" name="to" placeholder="Check-out"></div>
								<div class="col-sm-4">
									<label>Rooms</label>
									<div class="select"><select><option>0</option></select></div>
								</div>
								<div class="col-sm-4">
									<label>Adults</label>
									<div class="select"><select><option>0</option></select></div>
								</div>
								<div class="col-sm-4">
									<label>Children</label>
									<div class="select"><select><option>0</option></select></div>
								</div>
							</div>
							<a href="javascript:;" class="btn-gral blue">SEARCH HOTELS</a>
						</div>
					</div>
					<div class="col-sm-5">
						<h2>VIAJA POR TODO EL MUNDO</h2>
						<div class="h20"></div>
						<h3>Comprometidos en ofrecerle servicios de viaje de la más alta calidad.</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="pleca-gris">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 tcenter">
				<h2>NOSOTROS</h2>
				<div class="h30"></div>
				<p class="mb0">Somos una Empresa 100% mexicana, dedicada a crear momentos inolvidables en destinos inolvidables</p>
			</div>
		</div>
	</div>
</div>

<div class="h70"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1 tcenter">
			<h2>DESTINOS DESTACADOS</h2>
			<div class="h30"></div>
			<p>¡Explora el mundo con intensidad! Te ofrecemos una amplia variedad de tours por múltiples destinos exóticos o ya conocidos, como los que presentamos a continuación.</p>
			<div class="h30"></div>

			<nav class="filtros">
				<a href="<?php echo base_url; ?>pais/CA">CANADÁ</a>
				<a href="<?php echo base_url; ?>pais/CU">CUBA</a>
				<a href="<?php echo base_url; ?>pais/US">ESTADOS UNIDOS</a>
				<a href="<?php echo base_url; ?>pais/MX">MÉXICO</a>
			</nav>
		</div>
		<div class="h20"></div>

		<?php
		$apiKey = "j7k63hxbg9fcekguh6pf73jt";
		$Secret = "W3MXcU22k7";
		$signature = hash("sha256", $apiKey.$Secret.time());
		$minimo = rand(1,3390);
		$maximo =  intval($minimo + 3);
		$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&countryCode=MX&language=CAS&from=$minimo&to=$maximo";

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $endpoint,
			CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
		));
		$resp = curl_exec($curl);
		$respuesta = json_decode($resp, true);
		// print("<pre>".print_r($respuesta,true)."</pre>");
		$hoteles = $respuesta["hotels"];
		foreach ($hoteles as $key => $hotel) {
			?>

			<div class="col-sm-3">
				<div class="destino">
					<img src="" alt="">
					<div class="imagen" style="background-image: url('http://photos.hotelbeds.com/giata/<?php echo $hotel["images"][0]["path"] ?>');"></div>
					<div class="descripcion">
						<div class="stars">
							<?php 
							$estrellas = convierte_estrellas($hotel["s2c"]);
							echo $estrellas;
							?>
						</div>

						<div class="h15"></div>

						<h4><?php echo $hotel["name"]["content"]; ?></h4>
						<div class="h10"></div>
						<p><?php echo custom_echo($hotel["description"]["content"]); ?></p>
					</div>
					<a href="<?php echo base_url; ?>hoteles/<?php echo $hotel["code"]; ?>" class="btn-gral blue">SEE MORE</a>
				</div>
			</div>
			<?php
		}
		?>
		<div class="h30"></div>

		<div class="col-sm-12 tcenter">
			<a href="javascript:;" class="a-blue">All trips <i class="fas fa-chevron-right"></i></a>
		</div>
	</div>
</div>


<div class="h40"></div>

<div class="pleca-gris">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 tcenter">
				<h2>BABILON TRAVEL EXPERIENCES</h2>
			</div>

			<div class="h40"></div>

			<div class="experiences">
				<div class="tcenter">
					<div class="imagen">
						<img src="img/logo_negro.png" class="img-responsive" alt="Experiences" />
					</div>
					<div class="h30"></div>
					<p>Me gustó, muy buen servicio, excelentes precios, y el trato maravilloso. 100% recomendable.</p>
					<div class="h10"></div>

					<div class="destacado"><strong>-Fernando Espadas.</strong></div>
				</div>

				<div class="tcenter">
					<div class="imagen">
						<img src="img/logo_negro.png" class="img-responsive" alt="Experiences" />
					</div>
					<div class="h30"></div>
					<p>Excelente servicio y trato de calidad, ofrecen excelentes propuestas de paquetes y garantías en la compra</p>
					<div class="h10"></div>

					<div class="destacado"><strong>-Aarón Caceres.</strong></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="h70"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 tcenter">
			<h2>BLOG</h2>
		</div>

		<div class="h30"></div>
		<?php 
		$noticias =  $database->select("noticias","*", ["status_not" => 0]);
		foreach ($noticias as $noticias => $not) {
			?>

			<div class="col-sm-12">
				<div class="pleca-blog">
					<div class="row">
						<div class="col-sm-3">
							<div class="imagen" style="background-image: url('img/noticias/<?php echo $not["portada_not"]; ?>');"></div>
						</div>

						<div class="col-sm-9">
							<div class="contenido">
								<h3><?php echo $not["titulo_not"]; ?></h3>
								<div class="h20"></div>
								<p><?php echo $not["intro_not"]; ?></p>
								<a href="<?php echo base_url; ?>noticias/<?php echo $not["url_not"]; ?>" class="fright a-blue">READ MORE <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>

		<div class="h10"></div>

		<div class="col-sm-12 tcenter">
			<a href="<?php echo base_url; ?>noticias/" class="a-blue">ALL ARTICLES <i class="fas fa-chevron-right"></i></a>
		</div>
	</div>
</div>


<div class="h40"></div>
<!-- CONTENIDO -->

<?php require_once 'includes/_footer.php'; ?>
<script>
	$('.experiences').slick();
</script>
</body>
</html>
