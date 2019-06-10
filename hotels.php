<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
require_once 'includes/_menu.php';
require_once 'includes/_paginador.php';
$numero_items_mostar = 20;
$pages = new Paginator($numero_items_mostar, 'p');
$booking = "";
if($_POST){
	if(isset($_POST["accion"])){
		switch ($_POST["accion"]) {
			case 'filtrar_categorias':
			$count = $database->count("hb_hotels",["s2c" => $_POST["class"]]);
			$hoteles = $database->select("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["s2c" => $_POST["class"],"LIMIT" => [$pages->get_start(), $numero_items_mostar]]);
			break;
			case 'filtrar_plan':
			$count = $database->count("hb_hotels",["boardCodes[~]" => $_POST["plus"]]);
			$hoteles = $database->select("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["boardCodes[~]" => $_POST["plus"],"LIMIT" => [$pages->get_start(), $numero_items_mostar]]);
			break;
			case 'filtrar_pais':
			$count = $database->count("hb_hotels",["countryCode" => $_POST["country"]]);
			$hoteles = $database->select("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["hb_hotels.countryCode" => $_POST["country"],"LIMIT" => [$pages->get_start(), $numero_items_mostar]]);
			break;
		}
	}else{	
		$destino =  $_POST["destino"];
		$valor =  $_POST["valor"];
		$from =  $_POST["from"];
		$to =  $_POST["to"];
		$rooms =  $_POST["rooms"];
		$adults =  $_POST["adults"];
		$children =  $_POST["children"];
		$booking = '{ "destino" : "'.$destino.'", "valor" : "'.$valor.'", "from" : "'.$from.'", "to" : "'.$to.'", "rooms" : "'.$rooms.'", "adults" : "'.$adults.'", "children" : "'.$children.'"}';
		$hoteles = $database->select("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["destinationCode" => $valor,"LIMIT" => [$pages->get_start(), $numero_items_mostar]]);
		$count = $database->count("hb_hotels",["destinationCode" => $valor]);
	}
}else{
	$count = $database->count("hb_hotels");
	$hoteles = $database->select("hb_hotels", ["[>]hb_destinations" => ["destinationCode" => "cod_destination"]],["images","s2c", "name", "description","code","name_destination","city","boardCodes"],["LIMIT" => [$pages->get_start(), $numero_items_mostar]]);
}
$pages->set_total($count);
$pages->set_withLinkInCurrentLi(true);
$pages->set_paginatorStartChar("< Anterior");
$pages->set_paginatorEndChar("Siguiente >");
?>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<?php require_once 'includes/_book_box.php'; ?>
			<div class="h30"></div>
			<?php require_once 'includes/_book_filtros.php'; ?>
		</div>

		<div class="col-sm-8">
			<h2 id="principal" data-booking='<?php echo $booking; ?>'>FEATURED HOTELS</h2>
			<div class="h10"></div>
			<p>Explore the world with Intense! We offer you a vast variety of tours of all types.</p>
			<div class="h10"></div>
			<?php
			if($count == 0){
				?>
				<div class="alert alert-danger" role="alert">
					No se encontraron registros
				</div>
				<?php
			}else{
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

	<?php 
}
}
?>
<div class="h10"></div>
<?= $pages->page_links() ?>
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
	$(document).ready(function(){
		if($("#frm-category").data("categoria") != ""){
			let categoria = $("#frm-category").data("categoria");
			$("#frm-category").find(".category_filter").map(function(){
				let input_cat = $(this).val();
				if(input_cat == categoria){
					$(this).prop("checked", true);
				}
			});
		}
		if($("#frm-plan").data("plan") != ""){
			let plan = $("#frm-plan").data("plan");
			$("#frm-plan").find(".plan_filter").map(function(){
				let input_plan = $(this).val();
				if(input_plan == plan){
					$(this).prop("checked", true);
				}
			});
		}
		if($("#frm-country").data("pais") != ""){
			let pais = $("#frm-country").data("pais");
			$("#country_filter").val(pais);
		}
		let booking = $("#principal").data("booking");
		if(booking != ""){
			$("#destino").val(booking.destino);
			$("#valor").val(booking.valor);
			$("#from").val(booking.from);
			$("#to").val(booking.to);
			$("#rooms").val(booking.rooms);
			$("#adults").val(booking.adults);
			$("#children").val(booking.children);
		}
		$("#frm-category").find(".category_filter").change(function(){
			$("#frm-category").submit();
		});
		$("#country_filter").change(function(){
			$("#frm-country").submit();
		});
		$("#frm-plan").find(".plan_filter").click(function(){
			$("#frm-plan").submit();
		});
	});
</script>
</body>
</html>
