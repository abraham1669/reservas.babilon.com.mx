<?php
$apiKey = "j7k63hxbg9fcekguh6pf73jt";
$Secret = "W3MXcU22k7";
$signature = hash("sha256", $apiKey.$Secret.time());
$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&countryCode=MX&language=CAS&from=1&to=25";

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $endpoint,
	CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
));
$resp = curl_exec($curl);
$respuesta = json_decode($resp, true);
$hoteles = $respuesta["hotels"];
foreach ($hoteles as $hotel => $h) {
	echo $h["name"]["content"];
	echo $h["code"];
	$imagenes =  $h["images"];
	for ($i=0; $i < 2; $i++) { 
		?>
		<img src="http://photos.hotelbeds.com/giata/<?php echo $imagenes[$i]["path"] ?>" alt="">
		<?php
	}
	// print("<pre>".print_r($h,true)."</pre>");
}
?>