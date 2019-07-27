<?php
$apiKey = "j7k63hxbg9fcekguh6pf73jt";
$Secret = "W3MXcU22k7";
$signature = hash("sha256", $apiKey.$Secret.time());
$endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/hotels";
try
{	
	$request = [
		"stay" => [
			"checkIn" => "2019-09-10",
			"checkOut"=> "2019-09-13"
		],
		"occupancies" =>[			
			["rooms"=>1,
			"adults"=>2,
			"children"=>0]
		],
		"hotels" =>[
			"hotel" =>[13301]
		]
	];
	$datos =  json_encode($request);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_URL => $endpoint,
		CURLOPT_POSTFIELDS => $datos,
		CURLOPT_HTTPHEADER => ['Accept:application/json','Content-Type:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']
	));
	$resp = curl_exec($curl);
	if (!curl_errno($curl)) {
		switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
			$respuesta = json_decode($resp, true);
			$hoteles = $respuesta["hotels"];
			print("<pre>".print_r($hoteles,true)."</pre>");
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
?>