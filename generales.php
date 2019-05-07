<?php
$codigo = $_GET["secc"];
$apiKey = "j7k63hxbg9fcekguh6pf73jt";
$Secret = "W3MXcU22k7";
$signature = hash("sha256", $apiKey.$Secret.time());
$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/$codigo";

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $endpoint,
	CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
));
$resp = curl_exec($curl);
$respuesta = json_decode($resp, true);
$hotel = $respuesta["hotel"];
// print("<pre>".print_r($respuesta,true)."</pre>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Nombre: <?php echo $hotel["name"]["content"]; ?></h1>
	<p><strong>Descripción:</strong> <?php echo $hotel["description"]["content"]; ?></p>
	<p><strong>País:</strong> <?php echo $hotel["country"]["description"]["content"]; ?></p>
	<p><strong>Estado:</strong> <?php echo $hotel["state"]["name"] ?></p>
	<p><strong>Categoría:</strong> <?php echo $hotel["category"]["description"]["content"]; ?></p>
	<p><strong>Dirección:</strong> <?php echo $hotel["address"]["content"]; ?></p>
	<p><strong>Código Postal:</strong> <?php echo $hotel["postalCode"]; ?></p>
	<p><strong>Ciudad:</strong> <?php echo $hotel["city"]["content"]; ?></p>
	<p><strong>Web:</strong> <?php echo $hotel["web"]; ?></p>
	<p>Cuartos</p>
	<ul>
		<?php 
		$cuartos = $hotel["rooms"];
		foreach ($cuartos as $key => $cuarto) {
			?>
			<li><?php echo $cuarto["description"]; ?></li>
			<?php
		}
		?>
	</ul>
	<p>Facilities</p>
	<ul>
		<?php 
		$facilities = $hotel["facilities"];
		foreach ($facilities as $k => $fac) {
			?>
			<li><?php echo $fac["description"]["content"]; ?></li>
			<?php
		}
		?>
	</ul>
	<?php 
	$imagenes = $hotel["images"];
	foreach ($imagenes as $ke => $imagen) {
		?>
		<img src="http://photos.hotelbeds.com/giata/<?php echo $imagen["path"]; ?>"> <br>
		<?php
	}
	?>
</body>
</html>