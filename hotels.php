<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';
?>

<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="book">
				<h1>BOOK A HOTEL</h1>
				<div class="h10"></div>
				<input type="text" name="destino" placeholder="Destination" />
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
			<div class="h30"></div>
			<form id="filters">
				<input type="text" name="hotel" placeholder="Search by hotel name" />
				<div class="h20"></div>
				<p><strong>FILTERS HOTEL BY</strong></p>
				<p class="destacado2">PRICE PER NIGHT</p>
				<div id="slider-range"></div>
				<div class="h10"></div>
				<input type="text" id="minimo" value="Min. $0" class="rangos" readonly> 
				<input type="text" id="maximo" value="Max. $0" class="rangos" readonly> 
				<input type="hidden" name="rango" id="rango" />

				<div class="h30"></div>

				<input id="chk1" type="checkbox" name="plus" /> <label for="chk1"><span></span><i class="fas fa-mug-hot"></i> Free Breackfast</label>
				<div class="h5"></div>
				<input id="chk2" type="checkbox" name="plus" /> <label for="chk2"><span></span><i class="fas fa-swimming-pool"></i> Pool</label>
				<div class="h5"></div>
				<input id="chk3" type="checkbox" name="plus" /> <label for="chk3"><span></span><i class="fas fa-wifi"></i> Free Wifi</label>
				<div class="h5"></div>
				<input id="chk4" type="checkbox" name="plus" /> <label for="chk4"><span></span><i class="fas fa-car"></i> Free Parking</label>
				<div class="h5"></div>
				<input id="chk5" type="checkbox" name="plus" /> <label for="chk5"><span></span><i class="fas fa-paw"></i> Pet friendly</label>

				<div class="h30"></div>

				<p class="destacado2">CLASS</p>

				<input id="chk6" type="radio" name="class" checked /> <label for="chk6"><span></span><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /></label>
				<div class="h5"></div>
				<input id="chk7" type="radio" name="class" /> <label for="chk7"><span></span><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /></label>
				<div class="h5"></div>
				<input id="chk8" type="radio" name="class" /> <label for="chk8"><span></span><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /></label>

				<div class="h30"></div>

				<div class="select"><select><option>Guest rating</option></select></div>
				<div class="select"><select><option>Property type</option></select></div>

				<div class="h30"></div>

				<p class="destacado2">NEIGHBORHOOD</p>
				<input id="chk9" type="radio" name="plus" /> <label for="chk9"><span></span> Vancouver (and vicinity)</label>
				<div class="h5"></div>
				<input id="chk10" type="radio" name="plus" /> <label for="chk10"><span></span> Vancouver</label>
				<div class="h5"></div>
				<input id="chk11" type="radio" name="plus" /> <label for="chk11"><span></span> Downtown Vancouver</label>
				<div class="h5"></div>
				<input id="chk12" type="radio" name="plus" /> <label for="chk12"><span></span> Richmond</label>
				<div class="h5"></div>
				<input id="chk13" type="radio" name="plus" /> <label for="chk13"><span></span> Surrey</label>
				
			</form>
		</div>

		<div class="col-sm-8">
			<h2>FEATURED HOTELS</h2>
			<div class="h10"></div>
			<p>Explore the world with Intense! We offer you a vast variety of tours of all types.</p>
			<div class="h10"></div>
			<nav class="filtros">
				<a href="javascript:;">ALL</a>
				<a href="javascript:;">FRANCE</a>
				<a href="javascript:;">NEPAL</a>
				<a href="javascript:;">THAILAND</a>
				<a href="javascript:;">MEXICO</a>
			</nav>
			<div class="h10"></div>
			<?php $cont = 1; for ($i=1; $i < 14; $i++) { if($cont > 6){ $cont = 1;}?>
				<div class="hotel">
					<div class="imagen" style="background-image: url('img/t<?=$cont;?>.png');"></div>
					<div class="contenido">
						<div class="bx1">
							<div class="stars"><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /><img src="img/star.png" alt="Star" /> <strong>4.0/ 5 Excellent</strong></div>
							<h5>Camino Real Aeropuerto Cancún</h5>
						</div>
						<div class="bx2">
							<p class="price">$106</p>
							<p>Nightly Price</p>
						</div>

						<div class="h10"></div>
						<p class="location">Cancún</p>
						<p class="type"><span class="icon"></span> All inclusive</p>
						<div class="tright">
							<a href="javascript:;" class="a-blue">SHOW HOTEL <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>
				</div>

			<?php $cont++;} ?>
		</div>
	</div>
</div>

<div class="h40"></div>
<!-- CONTENIDO -->

<?php require_once 'includes/_footer.php'; ?>

<script type="text/javascript">
	
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
