<<<<<<< HEAD
<?php
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
=======
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
>>>>>>> d3aa700ace326d1ebc90e6d5aab1d0ed19c968eb
}