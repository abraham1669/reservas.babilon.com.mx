<?php
require_once '_functions.php';
if(isset($_POST['search'])){
	$destino = $_POST['search'];
	$consulta = $database->select("hb_destinations","*",["name_destination[~]" => $destino]);
	foreach ($consulta as $key => $value) {
		$response[] = array("value"=>$value['cod_destination'],"label"=>$value['name_destination']);

	}
	echo json_encode($response);
}
exit;
?>