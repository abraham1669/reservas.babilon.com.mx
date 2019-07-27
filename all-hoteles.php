<?php
$apiKey = "j7k63hxbg9fcekguh6pf73jt";
$Secret = "W3MXcU22k7";
$signature = hash("sha256", $apiKey.$Secret.time());
$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&from=1&to=2";
try
{	
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $endpoint,
		CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
	));
	$resp = curl_exec($curl);
	if (!curl_errno($curl)) {
		switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
			echo "Server JSON Response:" . $resp;
			break;
			default:
			echo 'Unexpected HTTP code: ', $http_code, "\n";
			echo $resp;
		}
	}
	curl_close($curl);
} catch (Exception $ex) {
	printf("Error while sending request, reason: %s\n",$ex->getMessage());
}
// $respuesta = json_decode($resp, true);
// $hoteles = $respuesta["hotels"];
// $hotel = [];
// foreach ($hoteles as $key => $value) {
// 	$hotel[$key]["code"] = $value["code"];
// 	$hotel[$key]["name"] = $value["name"]["content"];
// 	$hotel[$key]["description"] = $value["description"]["content"];
// 	$hotel[$key]["countryCode"] = $value["countryCode"];
// 	$hotel[$key]["stateCode"] = $value["stateCode"];
// 	$hotel[$key]["destinationCode"] = $value["destinationCode"];
// 	$hotel[$key]["zoneCode"] = $value["zoneCode"];
// 	$hotel[$key]["coordinates"] = implode(",",$value["coordinates"]);
// 	$hotel[$key]["categoryCode"] = $value["categoryCode"];
// 	$hotel[$key]["categoryGroupCode"] = $value["categoryGroupCode"];
// 	$hotel[$key]["chainCode"] = $value["chainCode"];
// 	$hotel[$key]["accommodationTypeCode"] = $value["accommodationTypeCode"];
// 	$hotel[$key]["boardCodes"] = implode("**",$value["boardCodes"]);
// 	$hotel[$key]["segmentCodes"] = implode("**",$value["segmentCodes"]);
// 	$hotel[$key]["address"] = $value["address"]["content"];
// 	$hotel[$key]["postalCode"] = $value["postalCode"];
// 	$hotel[$key]["city"] = $value["city"]["content"];
// 	$hotel[$key]["email"] = $value["email"];
// 	$hotel[$key]["license"] = $value["license"];
// 	$telefonos = '';
// 	foreach ($value["phones"] as $k => $v) {
// 		$telefonos .= json_encode($v);
// 	}
// 	$hotel[$key]["phones"] = $telefonos;
// 	$rooms = '';
// 	foreach ($value["rooms"] as $c => $d) {
// 		$rooms .= json_encode($d);
// 	}
// 	$hotel[$key]["rooms"] = $rooms;
// 	$facilities = '';
// 	foreach ($value["facilities"] as $a => $b) {
// 		$facilities .= json_encode($b);
// 	}
// 	$hotel[$key]["facilities"] = $facilities;
// 	$hotel[$key]["web"] = $value["web"];
// 	$hotel[$key]["lastUpdate"] = $value["lastUpdate"];
// 	$hotel[$key]["S2C"] = $value["S2C"];
// 	$hotel[$key]["ranking"] = $value["ranking"];
// }
// print("<pre>".print_r($hotel,true)."</pre>");
?>