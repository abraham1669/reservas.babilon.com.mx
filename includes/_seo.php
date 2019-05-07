<?php 
$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
$page = $uri_parts[2];
if($page === ""){
	$title = "Home";
	$description = "";
	$keywords = "";
	$sec = "multinivel"; // Esta variable asigna en el menu el Hover si se encuenta activa o no.
}

if($page === "nosotros"){
	$title = "Nosotros";
	$description = "";
	$keywords = "";
	$sec = "nosotros";
}