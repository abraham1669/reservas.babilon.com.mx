<?php
ob_start();
session_start();
error_reporting(0);
// Nombre del Sitio
$site_name = 'Babilon Travel';

// Obtiene la url actual del sitio
$url_actual = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// VARIABLE BASE_URL para la ruta absoluta del sitio y los datos de conexion locales y remotos
if ($_SERVER['HTTP_HOST'] == "localhost") {
    define("base_url", "http://" . $_SERVER['HTTP_HOST'] . "/reservas.babilon.com.mx/backend/");
    $bd_host    = "babilon.com.mx";
    $bd_usuario = "babilonc_reservas";
    $bd_pwd     = "Reservas.2019!";
    $bd_nombre  = "babilonc_reservas";
} else {
    define("base_url", "http://" . $_SERVER['HTTP_HOST'] . "/backend/");
    $bd_host    = "localhost";
    $bd_usuario = "babilonc_reservas";
    $bd_pwd     = "Reservas.2019!";
    $bd_nombre  = "babilonc_reservas";
}

// CONEXION A LA BASE DE DATOS
function conectar($bd_host, $bd_usuario, $bd_pwd, $bd_nombre)
{
    $link = mysql_connect($bd_host, $bd_usuario, $bd_pwd);
    if ($link) {
        if (!mysql_select_db($bd_nombre, $link)) {
            echo "No se pudo establecer la conexion a la Base de Datos, revise los datos de conexión.";
        }
    } else {
        echo "No se pudo completar la conexion al servidor, revise los datos de conexión.";
    }
    return $link;
}

$link = conectar($bd_host, $bd_usuario, $bd_pwd, $bd_nombre);

// MANTENIMIENTO 1 NORMAL 0
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$man = "0";
if ($url !== base_url && $man === "1") {
    header("location: " . base_url . "logout.php");
}

// ARRAY de las Secciones Administrables por cada usuario
$sec = explode("-", $_SESSION['secciones']);

// FUNCIONES DE LOGIN - CONTRASEÑAS - CONTACTO
if ($_POST) {
    switch ($_POST['accion']) {
        case 'contacto':contacto();
        break;

        case 'login':login();
        break;

        case 'forgot':forgot();
        break;

        case 'recovery':recovery();
        break;
    }
}

// Mostrar errores php en consola
function ap($baz)
{
    error_log(print_r($baz, true));
}

function login()
{
    global $link;
    if ($_POST["usuario"] !== "" || $_POST["password"] !== "") {
        $usuario  = trim(strtolower($_POST["usuario"]));
        $password = md5($_POST["password"]);
        mysql_query("SET NAMES 'utf8'");
        $sql  = mysql_query("SELECT * FROM usuarios WHERE usuario_usr='$usuario' AND clave_usr='$password'", $link);
        $row  = mysql_fetch_array($sql);
        $cant = mysql_num_rows($sql);

        if ($row['status_usr'] === "1") {
            echo "suspended";
        } else if ($cant === 1) {
            session_start();
            $_SESSION['id']           = $row['id_usr'];
            $_SESSION['nombre']       = $row['nombre_usr'];
            $_SESSION['nivel']        = $row['nivel_usr'];
            $_SESSION['pic']          = "pic.jpg";
            $_SESSION['ultimoacceso'] = $row['login_usr'];
            $_SESSION['session']      = "admin";
            $_SESSION['secciones']    = $row['secciones_usr'];
            echo "escritorio";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
}

function forgot()
{
    global $link;
    $email = trim(strtolower($_POST['email']));
    mysql_query("SET NAMES 'utf8'");
    $sql = mysql_query("SELECT * FROM usuarios WHERE correo_usr='$email'", $link);

    while ($row = mysql_fetch_array($sql)) {
        $usuario = $row['nombre_usr'];
        $hash1   = md5($row['id_usr']);
        $hash2   = md5($row['correo_usr']);
    }

    $para   = $email;
    $de     = 'Genotipo <soporte@genotipo.com>';
    $subjet = 'Recuperacion de cuenta backend.';
    $tipo   = 'Recuperaci&oacute;n de cuenta';
    $titulo = 'Recuperaci&oacute;n de Contraseña';
    $msg    = '
    Estimado(a) <strong>' . $usuario . '</strong> se ha registrado una solicitud de cambio de contraseña en su cuenta.
    <br/><br/>
    Si usted no ha realizado esta solicitud, ignore este e-mail, en caso contrario para <strong>reiniciar</strong> su contraseña de <strong>click</strong> en el siguiente link:
    <br/><br/>
    <a href="' . base_url . '?recovery=' . $hash1 . $hash2 . '">Restablecer contraseña ahora.</a>
    <br/><br/>
    Que tenga buen d&iacute;a.';

    envio_email($para, $de, $subjet, $tipo, $titulo, $msg);
}

function recovery()
{
    global $link;
    $res1 = substr($_POST['hash'], 0, 32);
    $res2 = substr($_POST['hash'], 32, 64);

    mysql_query("SET NAMES 'utf8'");
    $sql      = mysql_query("SELECT * FROM usuarios WHERE md5(id_usr) = '$res1' AND md5(correo_usr) = '$res2'", $link);
    $password = md5($_POST['password']);
    $existe   = mysql_num_rows($sql);

    while ($row = mysql_fetch_array($sql)) {
        $sql2 = "
        UPDATE usuarios
        SET
        clave_usr = '$password'
        WHERE
        id_usr='" . $row['id_usr'] . "'";

        mysql_query($sql2, $link);

        $para   = $row['correo_usr'];
        $de     = 'Genotipo <soporte@genotipo.com>';
        $subjet = 'Cambio de contraseña Nanodepot CRM.';
        $tipo   = 'Cambio de contraseña';
        $titulo = 'Cambio de contraseña exitoso.';
        $msg    = '
        Estimado(a) <strong>' . $row['nombre_usr'] . '</strong> su cambio de contraseña se ha realizado con &eacute;xito.
        <br/><br/>
        Si usted no ha realizado este proceso favor de contactarse al corporativo para la verificaci&oacute;n de su cuenta.
        <br/><br/>
        Que tenga buen d&iacute;a.';

        envio_email($para, $de, $subjet, $tipo, $titulo, $msg);
    }

    echo $existe;
}

function envio_email($para, $de, $subjet, $tipo, $titulo, $msg)
{
    $logo  = base_url . "img/logo_header.png";
    $link  = base_url;
    $tlink = "backend.revistaequipar.com";

    $destinatario = $para;
    $asunto       = $subjet;
    $color        = "#303030";
    $mensaje      = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Documento sin título</title>
    </head>
    <body style="background-color: #ddd;">
    <table id="pageContainer" width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; background-repeat:repeat; ">
    <tbody>
    <tr>
    <td style="padding:30px 20px 40px 20px;">
    <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;">
    <tbody>
    <tr>
    <td bgcolor="' . $color . '" colspan="2" height="7" style="font-size:2px; line-height:0px;">
    <img alt="" height="7" src="http://www.genotipo.com/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;">
    </td>
    </tr>
    <tr>
    <td bgcolor="' . $color . '" width="255" valign="middle" style="padding:25px 28px 25px 28px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:' . $color . ';">
    <a href="http://www.genotipo.com/"><img alt="Logo" src="' . $logo . '" align="left" border="0" vspace="0" hspace="0" style="display:block;"> </a>
    </td>
    <td bgcolor="' . $color . '" width="255" valign="middle" style="padding:20px 20px 15px 0; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:100%; color:#777777; text-align:right;">
    <table width="254" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;">
    <tbody>
    <tr>
    <td width="66" valign="top" style="line-height:100%; color:#fff;">
    <img alt="●" src="http://www.genotipo.com/img/mail/calendarIcon.png" height="32" width="32" border="0" vspace="0" hspace="17" style="display:block;">
    ' . ucfirst(strftime("%b %d")) . '
    </td>
    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
    <img alt="" src="http://www.genotipo.com/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
    </td>
    <td width="64" valign="top" style="line-height:100%;">
    <a href="mailto:' . $de . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
    <img alt="●" src="http://www.genotipo.com/img/mail/forwardIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;">
    Responder
    </a>
    </td>
    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
    <img alt="" src="http://www.genotipo.com/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
    </td>
    <td width="54" valign="top" style="line-height:100%;">
    <a href="' . $link . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
    <img alt="●" src="http://www.genotipo.com/img/mail/websiteIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;">
    Backend
    </a>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td colspan="2" height="11" style="font-size:2px; line-height:0px;">
    <img alt="" src="http://www.genotipo.com/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
    </td>
    </tr>
    </tbody>
    </table>

    <table bgcolor="#ffffff" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;">
    <tbody>
    <tr>
    <td style="padding-top:20px; padding-right:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#aaaaaa;">
    <img alt="" src="http://www.genotipo.com/img/mail/dateIcon.png" height="14" width="12" border="0" vspace="0" hspace="0" style="vertical-align:-1px;" />&nbsp;&nbsp; ' . date("d.m.y") . ' &nbsp;&nbsp;
    <img alt="" src="http://www.genotipo.com/img/mail/categoryIcon.png" height="14" width="15" border="0" vspace="0" hspace="0" style="vertical-align:-2px;" />&nbsp;&nbsp; ' . $tipo . '
    </td>
    </tr>
    <tr>
    <td style="padding-top:20px; padding-right:40px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">
    <p style="font-family: Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif; font-size:30px; line-height:30pt; color:#3b5167; font-weight:300; margin-top:0; margin-bottom:20px !important; padding:0; text-indent:-3px;">' . $titulo . '</p>
    </td>
    </tr>
    <tr>
    <td style="padding-right:30px; padding-bottom:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">
    ' . $msg . '
    </td>
    </tr>
    <tr>
    <td height="11" style="font-size:2px; line-height:0px;">
    <img alt="" src="http://www.genotipo.com/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
    </td>
    </tr>
    </tbody>
    </table>
    <table bgcolor="#f4f4f4" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;">
    <tbody>
    <tr>
    <td>
    <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;">
    <tbody>
    <tr>
    <td width="30">
    <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
    </td>
    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">
    Copyright &COPY; ' . date("Y") . '<br/>
    <a style="text-decoration:underline; color:' . $color . ';" href="' . $link . '">' . $tlink . '</a>
    <br/>
    All rights reserved.
    </td>
    <td width="30">
    <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
    </td>
    <td width="160" valign="top" style="padding-top:34px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;">
    <tbody>
    <tr>
    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
    <img alt="●" src="http://www.genotipo.com/img/mail/homeIcon.png" width="13" height="12" border="0" align="left" style="display:block;">
    </td>
    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;">
    <a href="' . $link . '" style="text-decoration:underline; color:' . $color . '; line-height:9pt;"> ' . $tlink . '</a>
    </td>
    </tr>
    <tr>
    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
    <img alt="●" src="http://www.genotipo.com/img/mail/emailIcon.png" width="12" height="12" border="0" align="left" style="display:block;">
    </td>
    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;">
    <a href="mailto:' . $de . '" style="text-decoration:underline; color:' . $color . '; line-height:9pt;"> ' . $de . '</a>
    </td>
    </tr>
    <tr>
    <td class="socialIcons" colspan="2" style="padding-top:17px; padding-bottom:5px;">
    <a href="#"><img alt="Facebook" src="http://www.genotipo.com/img/mail/facebookIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp;
    <a href="#"><img alt="Twitter" src="http://www.genotipo.com/img/mail/twitterIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp;
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    <td width="30">
    <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
    </td>
    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">
    <strong>Email de Notificación</strong><br/> Estos emails unicamente son para referencias futuras.<br/><br/>
    </td>
    <td width="30">
    <img alt="·" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td bgcolor="' . $color . '" height="7" style="font-size:2px; line-height:0px;"><img alt="" height="7" src="http://www.genotipo.com/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;"></td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </body>
    </html>
    ';

    $headers = "From: Genotipo <soporte@genotipo.com> \r\n";
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    mail($destinatario, $asunto, $mensaje, $headers);
}

// REEMPLAZA CARACTERES PARA URL AMIGABLE
function replaceUrl($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}

// RESIZE DE LAS IMAGENES CON FORMATO TOTALMENTE CUADRADO
if (!function_exists("create_square_image")) {

    function create_square_image($original_file, $destination_file = null, $square_size = 100)
    {
        // get width and height of original image
        $imagedata       = getimagesize($original_file);
        $original_width  = $imagedata[0];
        $original_height = $imagedata[1];

        if ($original_width > $original_height) {
            $new_height = $square_size;
            $new_width  = $new_height * ($original_width / $original_height);
        }
        if ($original_height > $original_width) {
            $new_width  = $square_size;
            $new_height = $new_width * ($original_height / $original_width);
        }
        if ($original_height == $original_width) {
            $new_width  = $square_size;
            $new_height = $square_size;
        }

        $new_width  = round($new_width);
        $new_height = round($new_height);

        // load the image
        if (substr_count(strtolower($original_file), ".jpg") or substr_count(strtolower($original_file), ".jpeg") or substr_count(strtolower($original_file), ".JPG") or substr_count(strtolower($original_file), ".JPEG")) {
            $original_image = imagecreatefromjpeg($original_file);
        }
        if (substr_count(strtolower($original_file), ".gif")) {
            $original_image = imagecreatefromgif($original_file);
        }
        if (substr_count(strtolower($original_file), ".png")) {
            $original_image = imagecreatefrompng($original_file);
        }

        $smaller_image = imagecreatetruecolor($new_width, $new_height);
        $square_image  = imagecreatetruecolor($square_size, $square_size);

        imagecopyresampled($smaller_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

        if ($new_width > $new_height) {
            $difference      = $new_width - $new_height;
            $half_difference = round($difference / 2);
            imagecopyresampled($square_image, $smaller_image, 0 - $half_difference + 1, 0, 0, 0, $square_size + $difference, $square_size, $new_width, $new_height);
        }
        if ($new_height > $new_width) {
            $difference      = $new_height - $new_width;
            $half_difference = round($difference / 2);
            imagecopyresampled($square_image, $smaller_image, 0, 0 - $half_difference + 1, 0, 0, $square_size, $square_size + $difference, $new_width, $new_height);
        }
        if ($new_height == $new_width) {
            imagecopyresampled($square_image, $smaller_image, 0, 0, 0, 0, $square_size, $square_size, $new_width, $new_height);
        }

        // if no destination file was given then display a png
        if (!$destination_file) {
            imagepng($square_image, null, 9);
        }

        // save the smaller image FILE if destination file given
        if (substr_count(strtolower($destination_file), ".jpg") or substr_count(strtolower($destination_file), ".jpeg")) {
            imagejpeg($square_image, $destination_file, 100);
        }
        if (substr_count(strtolower($destination_file), ".gif")) {
            imagegif($square_image, $destination_file);
        }
        if (substr_count(strtolower($destination_file), ".png")) {
            imagepng($square_image, $destination_file, 9);
        }

        imagedestroy($original_image);
        imagedestroy($smaller_image);
        imagedestroy($square_image);
    }

}


/**
***
***
***
**
            Funciones Generales
***
***
**/
function colores()
{
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql   = "SELECT * FROM colores WHERE status_col = 0 ORDER BY id_col ASC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'imagen' => $rows['url_col'],
            'id'     => $rows['id_col']
        );
    }

    return($datos);
}
function categorias()
{
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql   = "SELECT * FROM categorias WHERE status_cat = 0 ORDER BY id_cat ASC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'nombre' => $rows['nombre_cat'],
            'id'     => $rows['id_cat']
        );
    }

    return($datos);
}

function sectores()
{
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql   = "SELECT * FROM sectores WHERE status_sec = 0 ORDER BY id_sec ASC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'nombre' => $rows['nombre_sec'],
            'id'     => $rows['id_sec']
        );
    }

    return($datos);
}
function lineas()
{
    global $link;
    mysql_query("SET NAMES 'utf8'");

    $sql   = "SELECT * FROM lineas WHERE status_lin = 0 ORDER BY id_lin ASC";
    $query = mysql_query($sql, $link);
    $datos = array();
    while ($rows = mysql_fetch_array($query)) {
        $datos[] = array(
            'nombre' => $rows['nombre_lin'],
            'id'     => $rows['id_lin']
        );
    }

    return($datos);
}