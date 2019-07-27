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
						<?php 
						$black = "black";
						require_once 'includes/_book_box.php'; ?>
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
		$hoteles = $database->rand("hb_hotels", ["images","categoryCode", "name", "description","code"],["LIMIT" => 4]);
		foreach ($hoteles as $key => $hotel) {
			$imagenes = $hotel["images"];
			$photos =  json_decode($imagenes);
			?>

			<div class="col-sm-3">
				<div class="destino">
					<img src="" alt="">
					<div class="imagen" style="background-image: url('http://photos.hotelbeds.com/giata/<?php echo $photos[0]->path ?>');"></div>
					<div class="descripcion">
						<div class="stars">
							<?php 
							$estrellas = convierte_estrellas($hotel["categoryCode"]);
							echo $estrellas["texto"];
							?>
						</div>

						<div class="h15"></div>

						<h4><?php echo $hotel["name"]; ?></h4>
						<div class="h10"></div>
						<p><?php echo custom_echo($hotel["description"]); ?></p>
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
								<a href="<?php echo base_url; ?>blog/<?php echo $not["url_not"]; ?>" class="fright a-blue">READ MORE <i class="fas fa-chevron-right"></i></a>
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
			<a href="<?php echo base_url; ?>blog/" class="a-blue">ALL ARTICLES <i class="fas fa-chevron-right"></i></a>
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
