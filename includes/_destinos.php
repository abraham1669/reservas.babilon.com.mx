<?php
require_once '_functions.php';
if(isset($_POST['search'])){
	$destino = $_POST['search'];
	$consulta = $database->select("hb_destinations","*",["AND"=>["name_destination[~]" => $destino, "language_id"=> 1]]);
	// $consulta2 = $database->select("hb_hotels","*",["name[~]" => $destino]);
	// $consulta3 = $database->select("hb_states","*",["name_state[~]" => $destino]);
	// $consulta4 = $database->select("hb_countries","*",["name_contry[~]" => $destino]);
	foreach ($consulta as $key => $value) {
		$response[] = array("value"=>$value['cod_destination'],"label"=>$value['name_destination']);

	}
	// foreach ($consulta2 as $k => $v) {
	// 	$response[] = array("value"=>$v['code'],"label"=>$v['name']);

	// }
	// foreach ($consulta3 as $ke => $va) {
	// 	$response[] = array("value"=>$va['cod_state'],"label"=>$va['name_state']);

	// }
	// foreach ($consulta4 as $ke => $va) {
	// 	$response[] = array("value"=>$va['cod_country'],"label"=>$va['name_country']);

	// }
	echo json_encode($response);
}
exit;
?>