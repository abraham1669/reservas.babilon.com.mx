
<input type="text" name="hotel" placeholder="Search by hotel name" />
<div class="h20"></div>
<p><strong>FILTERS HOTEL BY</strong></p>
<p class="destacado2">Categoría</p>
<?php 
$categorias =  "";
$paises =  "";
if($_POST["accion"] && $_POST["accion"] == "filtrar_categorias"){
	$categorias =  $_POST["class"];
} 
if($_POST["accion"] && $_POST["accion"] == "filtrar_pais"){
	$paises =  $_POST["country"];
} 
if($_POST["accion"] && $_POST["accion"] == "filtrar_plan"){
	$plan =  $_POST["plus"];
} 
?>
<form action="<?php echo base_url; ?>hotels" method="POST" id="frm-category" data-categoria = "<?php echo $categorias; ?>">
	<input id="chk6" type="radio" class="category_filter" name="class" value="5*" /> <label for="chk6"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk7" type="radio" class="category_filter" name="class" value="4*" /> <label for="chk7"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" class="category_filter" name="class" value="3*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" class="category_filter" name="class" value="2*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<div class="h5"></div>
	<input id="chk8" type="radio" class="category_filter" name="class" value="1*" /> <label for="chk8"><span></span><img src="<?=base_url;?>img/star.png" alt="Star" /></label>
	<input type="hidden" name="accion" value="filtrar_categorias">
</form>

<div class="h30"></div>
<form action="<?php echo base_url; ?>hotels" id="frm-country" method="POST" data-pais = "<?php echo $paises; ?>">
	<div class="select">
		<select id="country_filter" name="country">
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
	<input type="hidden" name="accion" value="filtrar_pais">
</form>
<div class="h30"></div>

<p class="destacado2">Plan</p>
<form action="<?php echo base_url; ?>hotels" method="POST" id="frm-plan" data-plan = "<?php echo $plan; ?>">
	<input id="chk9" type="radio" class="plan_filter" value="AI" name="plus" /> <label for="chk9"><span></span> Todo Incluído</label>
	<div class="h5"></div>
	<input id="chk10" type="radio" class="plan_filter" value="AB" name="plus" /> <label for="chk10"><span></span> Desayuno Americano</label>
	<div class="h5"></div>
	<input id="chk11" type="radio" class="plan_filter" value="CB" name="plus" /> <label for="chk11"><span></span> Desayuno Continental</label>
	<div class="h5"></div>
	<input id="chk12" type="radio" class="plan_filter" value="BB" name="plus" /> <label for="chk12"><span></span> Alojamiento y Desayuno</label>
	<div class="h5"></div>
	<input id="chk13" type="radio" class="plan_filter" value="RO" name="plus" /> <label for="chk13"><span></span> Solo Habitación</label>
	<input type="hidden" name="accion" value="filtrar_plan">
</form>