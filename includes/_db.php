<?php
//EDit
use Medoo\Medoo;
if ($_SERVER['HTTP_HOST'] == "localhost") {
 $database = new Medoo([
   'database_type' => 'mysql',
   'database_name' => 'babilonc_reservas',
   'server' => 'babilon.com.mx',
   'username' => 'babilonc_reservas',
   'password' => 'Reservas.2019!',
   'charset' => 'utf8'
]);
} else {
   $database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'babilonc_reservas',
    'server' => 'localhost',
    'username' => 'babilonc_reservas',
    'password' => 'Reservas.2019!',
    'charset' => 'utf8'
 ]);
}