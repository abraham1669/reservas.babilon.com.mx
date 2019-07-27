
<?php
use Medoo\Medoo;
if ($_SERVER['HTTP_HOST'] == "localhost") {
 $database = new Medoo([
   'database_type' => 'mysql',
   'database_name' => 'babilont_reservas',
   'server' => 'babilon-travel.com',
   'username' => 'babilont_reserva',
   'password' => 'Reservas.2019!',
   'charset' => 'utf8'
 ]);
} else {
 $database = new medoo([
  'database_type' => 'mysql',
  'database_name' => 'babilont_reservas',
  'server' => 'localhost',
  'username' => 'babilont_reserva',
  'password' => 'Reservas.2019!',
  'charset' => 'utf8'
]);
}