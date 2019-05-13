<form id="filters">
	<input type="text" name="hotel" placeholder="Search by hotel name" />
	<div class="h20"></div>
	<p><strong>FILTERS HOTEL BY</strong></p>
	<!-- <p class="destacado2">PRICE PER NIGHT</p>
	<div id="slider-range"></div>
	<div class="h10"></div>
	<input type="text" id="minimo" value="Min. $0" class="rangos" readonly> 
	<input type="text" id="maximo" value="Max. $0" class="rangos" readonly> 
	<input type="hidden" name="rango" id="rango" /> -->

	<!-- <div class="h30"></div> -->

	<!-- <input id="chk1" type="checkbox" name="plus" /> <label for="chk1"><span></span><i class="fas fa-mug-hot"></i> Free Breackfast</label>
	<div class="h5"></div>
	<input id="chk2" type="checkbox" name="plus" /> <label for="chk2"><span></span><i class="fas fa-swimming-pool"></i> Pool</label>
	<div class="h5"></div>
	<input id="chk3" type="checkbox" name="plus" /> <label for="chk3"><span></span><i class="fas fa-wifi"></i> Free Wifi</label>
	<div class="h5"></div>
	<input id="chk4" type="checkbox" name="plus" /> <label for="chk4"><span></span><i class="fas fa-car"></i> Free Parking</label>
	<div class="h5"></div>
	<input id="chk5" type="checkbox" name="plus" /> <label for="chk5"><span></span><i class="fas fa-paw"></i> Pet friendly</label>

	<div class="h30"></div> -->

	<p class="destacado2">Categoría</p>

	<input id="chk6" type="radio" name="class" value="5*" checked /> <label for="chk6"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk7" type="radio" name="class" value="4*" /> <label for="chk7"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" name="class" value="3*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" name="class" value="2*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" name="class" value="1*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /></label>

	<div class="h30"></div>

	<div class="select">
		<select>
			<option>Selecciona un país...</option>
			<?php 
			$countries = $database->select("hb_countries", "*");
			foreach ($countries as $coun => $c) {
				?>
				<option value="<?php echo $c["cod_country"]; ?>"><?php echo $c["name_country"]; ?></option>
				<?php
			}
			?>
		</select>
	</div>
	<!-- <div class="select"><select><option>Property type</option></select></div> -->

	<div class="h30"></div>

	<p class="destacado2">Plan</p>
	<input id="chk9" type="radio" name="plus" /> <label for="chk9"><span></span> Todo Incluído</label>
	<div class="h5"></div>
	<input id="chk10" type="radio" name="plus" /> <label for="chk10"><span></span> Desayuno Americano</label>
	<div class="h5"></div>
	<input id="chk11" type="radio" name="plus" /> <label for="chk11"><span></span> Desayuno Continental</label>
	<div class="h5"></div>
	<input id="chk12" type="radio" name="plus" /> <label for="chk12"><span></span> Alojamiento y Desayuno</label>
	<div class="h5"></div>
	<input id="chk13" type="radio" name="plus" /> <label for="chk13"><span></span> Solo Habitación</label>

</form>