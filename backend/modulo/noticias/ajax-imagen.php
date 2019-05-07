<?php
include "../../includes/_funciones.php";
if (isset($_FILES["portada"])) {
    $file             = $_FILES["portada"];
    $nombreTemp       = $file["name"];
    $arrfile          = explode(".", $nombreTemp);
    $vext             = $arrfile[1];
    $nombre           = time() . "." . $vext;
    $tipo             = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size             = $file["size"];
    $dimensiones      = getimagesize($ruta_provisional);
    $width            = $dimensiones[0];
    $height           = $dimensiones[1];
    $carpeta          = "../../../img/noticias/";

    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
        echo "Error, el archivo no es una imagen";
    } else if ($size > 1024 * 1024) {
        echo "Error, el tamaño máximo permitido es un 1MB";
    } else {
        $src = $carpeta . $nombre;
        move_uploaded_file($ruta_provisional, $src);
        echo "<img src='$src' class='foto-portada' rel='$nombre'>";
        //Thumb
        create_square_image("../../../img/noticias/" . $nombre, "../../../img/noticias/thumb/" . $nombre, 380);
    }
}
