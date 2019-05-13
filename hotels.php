<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';
?>

<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<?php require_once 'includes/_book_box.php'; ?>
			<div class="h30"></div>
			<?php require_once 'includes/_book_filtros.php'; ?>
		</div>

		<div class="col-sm-8">
			<h2>FEATURED HOTELS</h2>
			<div class="h10"></div>
			<p>Explore the world with Intense! We offer you a vast variety of tours of all types.</p>
			<!-- <div class="h10"></div>
			<nav class="filtros">
				<a href="javascript:;">ALL</a>
				<a href="javascript:;">FRANCE</a>
				<a href="javascript:;">NEPAL</a>
				<a href="javascript:;">THAILAND</a>
				<a href="javascript:;">MEXICO</a>
			</nav> -->
			<div class="h10"></div>
			<?php
			$hoteles = $database->rand("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["LIMIT" => 15]);
			foreach ($hoteles as $key => $hotel) {
				$imagenes = $hotel["images"];
				$photos =  explode("**",$imagenes);
				?>
				<div class="hotel">
					<div class="imagen" style="background-image: url('http://photos.hotelbeds.com/giata/<?php echo $photos[0] ?>');"></div>
					<div class="contenido">
						<div class="bx1">
							<div class="stars">
								<?php 
								$estrellas = convierte_estrellas($hotel["s2c"]);
								echo $estrellas["texto"];
								?><strong><?php echo intval($estrellas["valor"])." / 5 ". $estrellas["recomendacion"]; ?></strong>
							</div>
							<h5><?php echo $hotel["name"]; ?></h5>
						</div>
						<!-- <div class="bx2">
							<p class="price">$106</p>
							<p>Nightly Price</p>
						</div> -->

						<div class="h10"></div>
						<p class="location"><?php echo $hotel["city"].", ".$hotel["name_destination"]; ?></p>
						<?php 
						$boards = explode("**", $hotel["boardCodes"]);
						$board =  $database->select("hb_boards","*",["AND"=>["code_board" => $boards,"language_id" => 1]]);
						?>
						<p class="type"><span class="icon"></span> <?php 
						if($board[0]["name_board"] != ""){
							$boa = $board[0]["name_board"];
						}else{
							$boa = $board[1]["name_board"];
						}
						echo $boa;
						?></p>
						<div class="tright">
							<a href="<?php echo base_url; ?>hoteles/<?php echo $hotel["code"]; ?>" class="a-blue">SHOW HOTEL <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>
				</div>

			<?php } ?>
		</div>
	</div>
</div>

<div class="h40"></div>
<!-- CONTENIDO -->

<?php require_once 'includes/_footer.php'; ?>

<script type="text/javascript">

	const formatter = new Intl.NumberFormat('en-US', {
		style: 'currency',
		currency: 'USD',
		minimumFractionDigits: 0
	})
	$("#header-main").addClass("Clor");
	// SELECCIONADOR RANGOS
	$( function() {
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 10000,
			values: [ 0, 10000 ],
			step: 50,
			slide: function( event, ui ) {
				$( "#minimo" ).val( "Min. " + formatter.format(ui.values[ 0 ]) );
				$( "#maximo" ).val( "Max " + formatter.format(ui.values[ 1 ]) );
				$( "#rango" ).val(  ui.values[ 0 ] + '-' + ui.values[ 1 ] );
			}
		});
		$( "#minimo" ).val( "Min. " + formatter.format($( "#slider-range" ).slider( "values", 0 )));
		$( "#maximo" ).val( "Max. " + formatter.format($( "#slider-range" ).slider( "values", 1 )));
		$( "#rango" ).val( $( "#slider-range" ).slider( "values", 0 ) + '-' + $( "#slider-range" ).slider( "values", 1 ) );
	} );
</script>
</body>
</html>
