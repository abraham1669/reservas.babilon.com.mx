<?php

include "../../includes/_funciones.php";
$seccion_actual = "noticias";
if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar':guardar();
            break;

        case 'listar':listar();
            break;

        case 'eliminar':eliminar();
            break;

        case 'consultar':consultar();
            break;

        case 'editar':editar();
            break;

        case 'eliminar_imagen':eliminar_imagen();
            break;

        case 'ver':ver();
            break;

        case 'destacar':destacar();
            break;
    }
}

function guardar()
{
    $url = replaceUrl($_POST['titulo']);
    mysql_query("SET NAMES 'utf8'");
    global $link;
    extract($_POST);
    date_default_timezone_set('UTC-5');
    $fecha = date('Y-m-d');
    $autor = $_SESSION['nombre'];
    $sql   = "INSERT INTO noticias values('','$titulo','$intro','$fotoportada','$autor','$fecha','$descripcion','0','$url','0')";
    mysql_query($sql, $link);
}

function listar()
{
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql   = "SELECT * FROM noticias ORDER BY id_not ASC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'titulo' => $rows['titulo_not'],
            'status' => $rows['status_not'],
            'destacado' => $rows['destacado_not'],
            'id'     => $rows['id_not'],
        );
    }

    echo json_encode($datos);
}

function eliminar()
{
    global $link;
    $sqlx  = "SELECT portada_not FROM noticias WHERE id_not = '" . $_POST['id'] . "'";
    $query = mysql_query($sqlx);
    $rows  = mysql_fetch_array($query);

    $portada = $rows['portada_not'];
    unlink('../../../img/noticias/' . $portada);
    unlink('../../../img/noticias/thumb/' . $portada);

    $sql = "DELETE FROM noticias WHERE id_not = '" . $_POST['id'] . "'";
    mysql_query($sql, $link);
}

function consultar()
{
    mysql_query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM noticias WHERE id_not = '" . $_POST['id'] . "'";

    $query = mysql_query($sql);
    $datos = array();
    $rows  = mysql_fetch_array($query);

    $datos[] = array(
        'titulo'      => $rows['titulo_not'],
        'intro'       => $rows['intro_not'],
        'descripcion' => $rows['descripcion_not'],
        'portada'     => $rows['portada_not'],
        'id'          => $rows['id_not'],
    );

    $_SESSION["noticia_editada"] = $rows['id_not'];

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function editar()
{
    $url = replaceUrl($_POST['titulo']);
    global $link;
    mysql_query("SET NAMES 'utf8'");
    $descripcion = str_replace("'", "’", $_POST['descripcion']);

    $sql = "
    UPDATE noticias
    SET
        titulo_not = '" . $_POST['titulo'] . "',
        intro_not = '" . $_POST['intro'] . "',
        descripcion_not = '" . $descripcion . "',
        portada_not = '" . $_POST['fotoportada'] . "',
        url_not = '" . $url . "'
    WHERE
    id_not='" . $_SESSION['noticia_editada'] . "'";

    mysql_query($sql, $link);
}

function eliminar_imagen($img)
{
    global $link;

    $fotos = explode('**', $img);

    for ($i = 0; $i < count($fotos); $i++) {
        if ($fotos[$i] !== "") {
            unlink('../../../img/noticias/' . $fotos[$i]);
            unlink('../../../img/noticias/thumb/' . $fotos[$i]);
        }
    }
}

function ver()
{
    global $link;
    if ($_POST['activo'] === "0") {
        $activo = "1";
    } else {
        $activo = "0";
    }
    $sql = "
    UPDATE noticias
    SET
        status_not = '" . $activo . "'
    WHERE
    id_not='" . $_POST['id'] . "'";

    mysql_query($sql, $link);
}

function destacar()
{
    global $link;
    if ($_POST['activo'] === "0") {
        $activo = "1";
    } else {
        $activo = "0";
    }
    $sql = "
    UPDATE noticias
    SET
        destacado_not = '" . $activo . "'
    WHERE
    id_not='" . $_POST['id'] . "'";

    mysql_query($sql, $link);
}
