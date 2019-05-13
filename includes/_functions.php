<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'medoo.php'; // Libreria para las consultas de la base de datos checar DOC https://medoo.in/doc
require_once '_db.php'; // Datos de acceso a la BD
require_once 'PHPMailer/PHPMailerAutoload.php'; // Libreria para el envio de emails.

// ***************************************************
// ********* CONFIGURACION GENERAL DEL SITIO *********
// ***************************************************
$local = "";
if ($_SERVER['HTTP_HOST'] == "localhost") {
    // $local = "babilon.com/";
    $local = "reservas.babilon.com.mx/";
} else {
    $local = "";
}

date_default_timezone_set('America/Mexico_City');
define('empresa', ''); // NOMBRE DE LA EMPRESA CONSTANTE PARA DERECHOS RESERVADOS, AUTHOR <REDES SOCIALES>, EMAIL TEMPLATE
define("telefono", "+52"); // TELEFONO PARA TEXT RICH, LINK DE URL TELEFONO.
define("base_url", "http://" . $_SERVER['HTTP_HOST'] . "/" . $local); // RUTA ABSOLUTA DEL SITIO
define("base_dir", realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
define("upload_dir", base_dir . 'cache' . DIRECTORY_SEPARATOR);

define('captcha_front', '6Ld7IqMUAAAAACp8atmfgWiANi8fObIc_q6XIiYv'); // KEY DEL CAPTCHA - CLAVE DEL SITIO
define('captcha_back', '6Ld7IqMUAAAAANo0PymHVJr1qtQoF7mkEtUiGqAV'); // KEY DEL CAPTCHA - CLAVE SECRETA

//Configuracion para poner los errores y warnings en los logs
ini_set("log_errors", "1");
ini_set("error_log", upload_dir . "errors.log");
ini_set("display_errors", "0");

// CONFIGURACIONES HEADER
// Obtener GEO TAGS - http://es.mygeoposition.com/
define("geo_tags", '
    <meta name="geo.placename" content="" />
    <meta name="geo.position" content="" />
    <meta name="geo.region" content="" />
    <meta name="ICBM" content="" />');

define("logo", "img/logotipo.png");

// CONFIGURACION REDES BORRAR LAS QUE NO SE OCUPEN
define("facebook", "http://www.facebook.com/");
define("twitter", "http://www.twitter.com/");
define("instagram", "http://www.instagram.com/");
define("pinterest", "http://www.pinterest.com/");
define("linkedin", "http://www.linkedin.com/");
define("youtube", "https://www.youtube.com/channel/");

//CONFIGURACION EMAIL TEMPLATE
$color = "#000"; // Colores representativos de la marca
$logo = base_url . "img/logo-mail.png"; // URL Logotipo para el email Tamaño Maximo 200px Ancho / 50px de alto

// ***************************************************
// **************** F U N C I O N E S ****************
// ***************************************************

// Variables del email template IGNORAR
$de = "";
$subjet = "";
$para = "";
$msg = "";

// DISTRIBUCION DE FUNCIONES
if ($_POST && isset($_POST['accion'])) {
    if (isAjax()) {
        if (isCaptchaValid()) {
            switch ($_POST['accion']) {
                case 'contacto':
                contacto();
                break;
            }
        } else {
            responderJson(array(
                'status' => 'bad',
                'code' => 'captcha',
                'mensaje' => 'Captcha no seleccionado'
            ));
        }
    }
}
function convierte_estrellas($s2c){
    $valor = 5;
    switch ($s2c) {
        case '1*':
        $valor = 1;
        $recomendacion = "Muy poco recomendable";
        break;
        case '2*':
        $valor = 2;
        $recomendacion = "Poco recomendable";
        break;
        case '3*':
        $valor = 3;
        $recomendacion = "Recomendable";
        break;
        case '4*':
        $valor = 4;
        $recomendacion = "Bastante recomendable";
        break;
        default:
        $valor =  5;
        $recomendacion = "Excelente";
        break;
    }
    for ($i=1; $i <= $valor; $i++) { 
        $texto .= "<img src='".base_url."img/star.png' alt='Star' />";
    }
    $arreglo["texto"] = $texto;
    $arreglo["valor"] = $valor;
    $arreglo["recomendacion"] = $recomendacion;
    return $arreglo;
}
function contacto(){
    #limpia los espacios en los valores los arreglos
    array_filter($_POST, 'trim_value');
    #saneo de datos
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $msg = '';
    // Agregar a qui todos los inputs extra no importa que los formularios sean diferentes
    // si detecta el post vacio no se imprime el campo en el template del email
    $datos = array(
        'Nombre' => $_POST['nombre'],
        'Email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'Telefono' => $_POST['telefono'],
        'Empresa' => $_POST['empresa'],
        'Interesado en' => $_POST['interes'],
        '¿Cómo supo de nosotros?' => $_POST['fuente'],
        'Mensaje' => $_POST['mensaje'],
    );
    $espacio = '<br>';
    foreach ($datos as $key => $value) {
        if (!empty($value)) {
            $msg .= "<strong>{$key}: </strong>{$value}{$espacio}";
        }
    }
    $de = $datos['Email'];
    $subjet = $_POST['area'];
    //Aqui van el email de los clientes
    $para = "pruebas@genotipo.com";
    envio_email($para, $de, $subjet, $tipo, $titulo, $msg);
    responderJson(array(
        'status' => 'ok',
        'code' => '202',
        'mensaje' => 'Correo enviado'
    ));
}

#Limpia los valores
function trim_value(&$value){
    $value = trim($value);
}

/**
 * @return bool
 *
 * Funcion para permitir solo llamadas ajax
 */
function isAjax(){
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * @return bool
 * Funcion para validar el captcha de google
 */
#Validar Captcha google
function isCaptchaValid(){
    $handler = curl_init();

    $elements = [
        "secret" => captcha_back,
        "response" => xss($_POST["g-recaptcha-response"]),
        "remoteip" => $_SERVER["REMOTE_ADDR"],
    ];

    $data = http_build_query($elements);
    curl_setopt($handler, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($handler, CURLOPT_POST,true);
    curl_setopt($handler, CURLOPT_POSTFIELDS, $elements);
    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($handler), true);
    curl_close($handler);
    return $response["success"];
}

#Resonde con un json y us status
function responderJson($arreglo, $http_code = 202){
    header('Content-Type: application/json');
    http_response_code($http_code);
    echo json_encode($arreglo);
}

// EMAIL TEMPLATE
function envio_email($para, $de, $subjet, $tipo, $titulo, $msg){
    global $logo;
    $mensaje = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title></title><!--[if mso]><style>*{font-family: sans-serif !important;}</style><![endif]--> <style>/* What it does: Remove spaces around the email design added by some email clients. */ /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */ html, body{margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important;}/* What it does: Stops email clients resizing small text. */ *{-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}/* What it does: Centers email on Android 4.4 */ div[style*="margin: 16px 0"]{margin:0 !important;}/* What it does: Stops Outlook from adding extra spacing to tables. */ table, td{mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;}/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */ table{border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;}table table table{table-layout: auto;}/* What it does: Uses a better rendering method when resizing images in IE. */ img{-ms-interpolation-mode:bicubic;}/* What it does: A work-around for iOS meddling in triggered links. */ *[x-apple-data-detectors]{color: inherit !important; text-decoration: none !important;}/* What it does: A work-around for Gmail meddling in triggered links. */ .x-gmail-data-detectors, .x-gmail-data-detectors *, .aBn{border-bottom: 0 !important; cursor: default !important;}/* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */ .a6S{display: none !important; opacity: 0.01 !important;}/* If the above doesnt work, add a .g-img class to any image in question. */ img.g-img + div{display:none !important;}/* What it does: Prevents underlining the button text in Windows 10 */ .button-link{text-decoration: none !important;}/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89 *//* Create one of these media queries for each additional viewport size youd like to fix *//* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */@media only screen and (min-device-width: 375px) and (max-device-width: 413px){/* iPhone 6 and 6+ */ .email-container{min-width: 375px !important;}}</style><style>/* What it does: Hover styles for buttons */ .button-td, .button-a{transition: all 100ms ease-in;}.button-td:hover, .button-a:hover{background: #555555 !important; border-color: #555555 !important;}/* Media Queries */ @media screen and (max-width: 600px){.email-container{width: 100% !important; margin: auto !important;}/* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */ .fluid{max-width: 100% !important; height: auto !important; margin-left: auto !important; margin-right: auto !important;}/* What it does: Forces table cells into full-width rows. */ .stack-column, .stack-column-center{display: block !important; width: 100% !important; max-width: 100% !important; direction: ltr !important;}/* And center justify these ones. */ .stack-column-center{text-align: center !important;}/* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */ .center-on-narrow{text-align: center !important; display: block !important; margin-left: auto !important; margin-right: auto !important; float: none !important;}table.center-on-narrow{display: inline-block !important;}/* What it does: Adjust typography on small screens to improve readability */ .email-container p{font-size: 17px !important; line-height: 22px !important;}}</style><!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--> </head><body width="100%" bgcolor="#f5f5f5" style="mso-line-height-rule: exactly;"> <center style="width: 100%; background: #f5f5f5; text-align: left; padding-top: 30px;"> <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> (Optional) This text will appear in the inbox preview, but not the email body. </div><table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" width="600" class="email-container"> <tr> <td style="padding: 20px 0; text-align: center"> <img src="'.$logo.'" aria-hidden="true" width="200" height="50" alt="alt_text" border="0" style="height: auto; background: #fff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #fff;"> </td></tr></table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto; border-radius: 10px;" class="email-container"> <tr> <td bgcolor="#ffffff" style="padding: 20px 40px 20px 40px; text-align: center;"> <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #656a72; font-weight: bold;">'.$subjet.'</h1> </td></tr><tr> <td bgcolor="#ffffff" style="padding: 0 70px 70px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #656a72; text-align: left;"><p style="margin: 0;">'.$msg.'</p></td></tr><tr> <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto"> <tr> <td style="border-radius: 3px; background: #333333; text-align: center;" class="button-td"><a href="mailto:'.$de.'" style="background: #333333; border: 15px solid #333333; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Responder Solicitud</span>&nbsp;&nbsp;&nbsp;&nbsp; </a> </td></tr></table> </td></tr></table> <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container"> <tr> <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">'.empresa.'<br>&copy; Todos los derechos reservados '.date("Y").'</td></tr></table> </center></body></html>';

    $email = new PHPMailer();
    $email->From = 'hola@genotipo.com';
    $email->FromName = empresa;
    $email->Subject = $subjet;
    $email->Body = $mensaje;
    $email->isHTML(true);
    $email->CharSet = 'UTF-8';

    $limpia_correos = str_replace(' ', '', $para);
    $correos = explode(",", $limpia_correos);

    foreach ($correos as $mail) {
        $email->addAddress($mail);
    }
    $email->addBCC("pruebas@genotipo.com");
    $email->send();
}

// ACORTADOR DE TEXTOS
function custom_echo($x, $length = 155){
    $y = html_entity_decode(strip_tags($x));
    return strlen($y) <= $length ? $y : substr($y, 0, $length) . '...';
}

// OBTENER PAGINA ACTUAL
function page(){
    $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
    return "http://" . $_SERVER['HTTP_HOST'] . $uri_parts[0];
}

function versionarArchivo($archivo){
    return base_url . $archivo . '?v=' . md5_file(base_dir . $archivo);
}

function css(){
    if($_SERVER['HTTP_HOST'] === "localhost"){
        return '<link rel="stylesheet" href="'.versionarArchivo('css/main.css').'" /> ';
    }else{
        $archivo = fopen(base_dir."css/main.css", "r") or die("No se pudo abrir");
        $lectura = fread($archivo,filesize(base_dir."css/main.css"));

        return "<style>" . str_replace("../img/", base_url."img/", $lectura) . "</style>";

        fclose($archivo);
    }
}

function xss($string){
   $string = str_replace("#", "&#35;", $string);
   // $string = htmlspecialchars($string, ENT_QUOTES);
   $string = str_replace("?", "&#63;", $string);
   $string = str_replace("--", "&#45;", $string);
   $string = str_replace("+", "&#43;", $string);
   $string = str_replace("*", "&#42;", $string);
   $string = str_replace("$", "&#36;", $string);
   return $string;
}
///======================================================================================================================================================
//=======================================================================================================================================================
//                                                          ACTUALIZACIÓN 26 DE OCTUBRE DE 2018
//=======================================================================================================================================================
//=======================================================================================================================================================

//===================================== CONVERTIR FECHA EN TEXTO - EJEMPLO (MARTES 3 DE NOVIEMBRE DE 2018)


function fechaAString($fecha)
{
    $dias  = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $fecha = new \DateTime($fecha);

    #return $fecha->format('l d \d\e F \d\e\l Y');
    return "{$dias[$fecha->format('w')]} {$fecha->format('d')} de {$meses[$fecha->format('n') - 1]} del {$fecha->format('Y')}";
}
//===================================== CONVERTIR FECHA EN TEXTO - EJEMPLO (3 DE NOVIEMBRE)
function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia." de ".$nombreMes;
    // return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
//===================================== AÑADIR BREADCRUMBS
function breadcrumbs($sep = '', $home = 'Home') {
    $bc     =   '<ul class="breadcrumb">';
    $site   =   'http://'.$_SERVER['HTTP_HOST'];
    $crumbs =   array_filter( explode("/",$_SERVER["REQUEST_URI"]) );
    $bc    .=   '<li><a href="'.$site.'">'.$home.'</a>'.$sep.'</li>';
    $nm     =   count($crumbs);
    $i      =   1;
    foreach($crumbs as $crumb){
        $last_piece = end($crumbs);
        $link    =  ucfirst( str_replace( array(".php","-","_"), array(""," "," ") ,$crumb) );
        $sep     =  $i==$nm?'':$sep;
        $site   .=  '/'.$crumb;
        if ($last_piece!==$crumb){
            $bc     .= '<li><a href="'.$site.'">'.$link.'</a>'.$sep.'</li>';
        } else {
            $bc     .= '<li class="active">'.ucfirst( str_replace( array(".php","-","_"), array(""," "," ") ,$last_piece)).'</li>';
        }
        $i++;
    }
    $bc .=  '</ul>';
    return $bc;
}

//===================================== REVISAR SI UN NÚMERO ES PAR PARA AÑADIR UNA CLASE

function isPar($numero, $cadena){
    $clase = ($numero%2 == 0) ? $cadena : '';
    echo $clase;
}

//===================================== ARREGLO DE PAÍSES
function arrayPaises(){
    $paises = array(
        array("nomenclatura" => "AF","pais" => "Afganistán"),
        array("nomenclatura" => "AL","pais" => "Albania"),
        array("nomenclatura" => "DE","pais" => "Alemania"),
        array("nomenclatura" => "AD","pais" => "Andorra"),
        array("nomenclatura" => "AO","pais" => "Angola"),
        array("nomenclatura" => "AI","pais" => "Anguilla"),
        array("nomenclatura" => "AQ","pais" => "Antártida"),
        array("nomenclatura" => "AG","pais" => "Antigua y Barbuda"),
        array("nomenclatura" => "AN","pais" => "Antillas Holandesas"),
        array("nomenclatura" => "SA","pais" => "Arabia Saudí"),
        array("nomenclatura" => "DZ","pais" => "Argelia"),
        array("nomenclatura" => "AR","pais" => "Argentina"),
        array("nomenclatura" => "AM","pais" => "Armenia"),
        array("nomenclatura" => "AW","pais" => "Aruba"),
        array("nomenclatura" => "AU","pais" => "Australia"),
        array("nomenclatura" => "AT","pais" => "Austria"),
        array("nomenclatura" => "AZ","pais" => "Azerbaiyán"),
        array("nomenclatura" => "BS","pais" => "Bahamas"),
        array("nomenclatura" => "BH","pais" => "Bahrein"),
        array("nomenclatura" => "BD","pais" => "Bangladesh"),
        array("nomenclatura" => "BB","pais" => "Barbados"),
        array("nomenclatura" => "BE","pais" => "Bélgica"),
        array("nomenclatura" => "BZ","pais" => "Belice"),
        array("nomenclatura" => "BJ","pais" => "Benin"),
        array("nomenclatura" => "BM","pais" => "Bermudas"),
        array("nomenclatura" => "BY","pais" => "Bielorrusia"),
        array("nomenclatura" => "MM","pais" => "Birmania"),
        array("nomenclatura" => "BO","pais" => "Bolivia"),
        array("nomenclatura" => "BA","pais" => "Bosnia y Herzegovina"),
        array("nomenclatura" => "BW","pais" => "Botswana"),
        array("nomenclatura" => "BR","pais" => "Brasil"),
        array("nomenclatura" => "BN","pais" => "Brunei"),
        array("nomenclatura" => "BG","pais" => "Bulgaria"),
        array("nomenclatura" => "BF","pais" => "Burkina Faso"),
        array("nomenclatura" => "BI","pais" => "Burundi"),
        array("nomenclatura" => "BT","pais" => "Bután"),
        array("nomenclatura" => "CV","pais" => "Cabo Verde"),
        array("nomenclatura" => "KH","pais" => "Camboya"),
        array("nomenclatura" => "CM","pais" => "Camerún"),
        array("nomenclatura" => "CA","pais" => "Canadá"),
        array("nomenclatura" => "TD","pais" => "Chad"),
        array("nomenclatura" => "CL","pais" => "Chile"),
        array("nomenclatura" => "CN","pais" => "China"),
        array("nomenclatura" => "CY","pais" => "Chipre"),
        array("nomenclatura" => "VA","pais" => "Ciudad del Vaticano (Santa Sede)"),
        array("nomenclatura" => "CO","pais" => "Colombia"),
        array("nomenclatura" => "KM","pais" => "Comores"),
        array("nomenclatura" => "CG","pais" => "Congo"),
        array("nomenclatura" => "CD","pais" => "Congo, República Democrática del"),
        array("nomenclatura" => "KR","pais" => "Corea"),
        array("nomenclatura" => "KP","pais" => "Corea del Norte"),
        array("nomenclatura" => "CI","pais" => "Costa de Marfíl"),
        array("nomenclatura" => "CR","pais" => "Costa Rica"),
        array("nomenclatura" => "HR","pais" => "Croacia (Hrvatska)"),
        array("nomenclatura" => "CU","pais" => "Cuba"),
        array("nomenclatura" => "DK","pais" => "Dinamarca"),
        array("nomenclatura" => "DJ","pais" => "Djibouti"),
        array("nomenclatura" => "DM","pais" => "Dominica"),
        array("nomenclatura" => "EC","pais" => "Ecuador"),
        array("nomenclatura" => "EG","pais" => "Egipto"),
        array("nomenclatura" => "SV","pais" => "El Salvador"),
        array("nomenclatura" => "AE","pais" => "Emiratos Árabes Unidos"),
        array("nomenclatura" => "ER","pais" => "Eritrea"),
        array("nomenclatura" => "SI","pais" => "Eslovenia"),
        array("nomenclatura" => "ES","pais" => "España"),
        array("nomenclatura" => "US","pais" => "Estados Unidos"),
        array("nomenclatura" => "EE","pais" => "Estonia"),
        array("nomenclatura" => "ET","pais" => "Etiopía"),
        array("nomenclatura" => "FJ","pais" => "Fiji"),
        array("nomenclatura" => "PH","pais" => "Filipinas"),
        array("nomenclatura" => "FI","pais" => "Finlandia"),
        array("nomenclatura" => "FR","pais" => "Francia"),
        array("nomenclatura" => "GA","pais" => "Gabón"),
        array("nomenclatura" => "GM","pais" => "Gambia"),
        array("nomenclatura" => "GE","pais" => "Georgia"),
        array("nomenclatura" => "GH","pais" => "Ghana"),
        array("nomenclatura" => "GI","pais" => "Gibraltar"),
        array("nomenclatura" => "GD","pais" => "Granada"),
        array("nomenclatura" => "GR","pais" => "Grecia"),
        array("nomenclatura" => "GL","pais" => "Groenlandia"),
        array("nomenclatura" => "GP","pais" => "Guadalupe"),
        array("nomenclatura" => "GU","pais" => "Guam"),
        array("nomenclatura" => "GT","pais" => "Guatemala"),
        array("nomenclatura" => "GY","pais" => "Guayana"),
        array("nomenclatura" => "GF","pais" => "Guayana Francesa"),
        array("nomenclatura" => "GN","pais" => "Guinea"),
        array("nomenclatura" => "GQ","pais" => "Guinea Ecuatorial"),
        array("nomenclatura" => "GW","pais" => "Guinea-Bissau"),
        array("nomenclatura" => "HT","pais" => "Haití"),
        array("nomenclatura" => "HN","pais" => "Honduras"),
        array("nomenclatura" => "HU","pais" => "Hungría"),
        array("nomenclatura" => "IN","pais" => "India"),
        array("nomenclatura" => "ID","pais" => "Indonesia"),
        array("nomenclatura" => "IQ","pais" => "Irak"),
        array("nomenclatura" => "IR","pais" => "Irán"),
        array("nomenclatura" => "IE","pais" => "Irlanda"),
        array("nomenclatura" => "BV","pais" => "Isla Bouvet"),
        array("nomenclatura" => "CX","pais" => "Isla de Christmas"),
        array("nomenclatura" => "IS","pais" => "Islandia"),
        array("nomenclatura" => "KY","pais" => "Islas Caimán"),
        array("nomenclatura" => "CK","pais" => "Islas Cook"),
        array("nomenclatura" => "CC","pais" => "Islas de Cocos o Keeling"),
        array("nomenclatura" => "FO","pais" => "Islas Faroe"),
        array("nomenclatura" => "HM","pais" => "Islas Heard y McDonald"),
        array("nomenclatura" => "FK","pais" => "Islas Malvinas"),
        array("nomenclatura" => "MP","pais" => "Islas Marianas del Norte"),
        array("nomenclatura" => "MH","pais" => "Islas Marshall"),
        array("nomenclatura" => "UM","pais" => "Islas menores de Estados Unidos"),
        array("nomenclatura" => "PW","pais" => "Islas Palau"),
        array("nomenclatura" => "SB","pais" => "Islas Salomón"),
        array("nomenclatura" => "SJ","pais" => "Islas Svalbard y Jan Mayen"),
        array("nomenclatura" => "TK","pais" => "Islas Tokelau"),
        array("nomenclatura" => "TC","pais" => "Islas Turks y Caicos"),
        array("nomenclatura" => "VI","pais" => "Islas Vírgenes (EEUU)"),
        array("nomenclatura" => "VG","pais" => "Islas Vírgenes (Reino Unido)"),
        array("nomenclatura" => "WF","pais" => "Islas Wallis y Futuna"),
        array("nomenclatura" => "IL","pais" => "Israel"),
        array("nomenclatura" => "IT","pais" => "Italia"),
        array("nomenclatura" => "JM","pais" => "Jamaica"),
        array("nomenclatura" => "JP","pais" => "Japón"),
        array("nomenclatura" => "JO","pais" => "Jordania"),
        array("nomenclatura" => "KZ","pais" => "Kazajistán"),
        array("nomenclatura" => "KE","pais" => "Kenia"),
        array("nomenclatura" => "KG","pais" => "Kirguizistán"),
        array("nomenclatura" => "KI","pais" => "Kiribati"),
        array("nomenclatura" => "KW","pais" => "Kuwait"),
        array("nomenclatura" => "LA","pais" => "Laos"),
        array("nomenclatura" => "LS","pais" => "Lesotho"),
        array("nomenclatura" => "LV","pais" => "Letonia"),
        array("nomenclatura" => "LB","pais" => "Líbano"),
        array("nomenclatura" => "LR","pais" => "Liberia"),
        array("nomenclatura" => "LY","pais" => "Libia"),
        array("nomenclatura" => "LI","pais" => "Liechtenstein"),
        array("nomenclatura" => "LT","pais" => "Lituania"),
        array("nomenclatura" => "LU","pais" => "Luxemburgo"),
        array("nomenclatura" => "MK","pais" => "Macedonia, Ex-República Yugoslava de"),
        array("nomenclatura" => "MG","pais" => "Madagascar"),
        array("nomenclatura" => "MY","pais" => "Malasia"),
        array("nomenclatura" => "MW","pais" => "Malawi"),
        array("nomenclatura" => "MV","pais" => "Maldivas"),
        array("nomenclatura" => "ML","pais" => "Malí"),
        array("nomenclatura" => "MT","pais" => "Malta"),
        array("nomenclatura" => "MA","pais" => "Marruecos"),
        array("nomenclatura" => "MQ","pais" => "Martinica"),
        array("nomenclatura" => "MU","pais" => "Mauricio"),
        array("nomenclatura" => "MR","pais" => "Mauritania"),
        array("nomenclatura" => "YT","pais" => "Mayotte"),
        array("nomenclatura" => "MX","pais" => "selected>México"),
        array("nomenclatura" => "FM","pais" => "Micronesia"),
        array("nomenclatura" => "MD","pais" => "Moldavia"),
        array("nomenclatura" => "MC","pais" => "Mónaco"),
        array("nomenclatura" => "MN","pais" => "Mongolia"),
        array("nomenclatura" => "MS","pais" => "Montserrat"),
        array("nomenclatura" => "MZ","pais" => "Mozambique"),
        array("nomenclatura" => "NA","pais" => "Namibia"),
        array("nomenclatura" => "NR","pais" => "Nauru"),
        array("nomenclatura" => "NP","pais" => "Nepal"),
        array("nomenclatura" => "NI","pais" => "Nicaragua"),
        array("nomenclatura" => "NE","pais" => "Níger"),
        array("nomenclatura" => "NG","pais" => "Nigeria"),
        array("nomenclatura" => "NU","pais" => "Niue"),
        array("nomenclatura" => "NF","pais" => "Norfolk"),
        array("nomenclatura" => "NO","pais" => "Noruega"),
        array("nomenclatura" => "NC","pais" => "Nueva Caledonia"),
        array("nomenclatura" => "NZ","pais" => "Nueva Zelanda"),
        array("nomenclatura" => "OM","pais" => "Omán"),
        array("nomenclatura" => "NL","pais" => "Países Bajos"),
        array("nomenclatura" => "PA","pais" => "Panamá"),
        array("nomenclatura" => "PG","pais" => "Papúa Nueva Guinea"),
        array("nomenclatura" => "PK","pais" => "Paquistán"),
        array("nomenclatura" => "PY","pais" => "Paraguay"),
        array("nomenclatura" => "PE","pais" => "Perú"),
        array("nomenclatura" => "PN","pais" => "Pitcairn"),
        array("nomenclatura" => "PF","pais" => "Polinesia Francesa"),
        array("nomenclatura" => "PL","pais" => "Polonia"),
        array("nomenclatura" => "PT","pais" => "Portugal"),
        array("nomenclatura" => "PR","pais" => "Puerto Rico"),
        array("nomenclatura" => "QA","pais" => "Qatar"),
        array("nomenclatura" => "UK","pais" => "Reino Unido"),
        array("nomenclatura" => "CF","pais" => "República Centroafricana"),
        array("nomenclatura" => "CZ","pais" => "República Checa"),
        array("nomenclatura" => "ZA","pais" => "República de Sudáfrica"),
        array("nomenclatura" => "DO","pais" => "República Dominicana"),
        array("nomenclatura" => "SK","pais" => "República Eslovaca"),
        array("nomenclatura" => "RE","pais" => "Reunión"),
        array("nomenclatura" => "RW","pais" => "Ruanda"),
        array("nomenclatura" => "RO","pais" => "Rumania"),
        array("nomenclatura" => "RU","pais" => "Rusia"),
        array("nomenclatura" => "EH","pais" => "Sahara Occidental"),
        array("nomenclatura" => "KN","pais" => "Saint Kitts y Nevis"),
        array("nomenclatura" => "WS","pais" => "Samoa"),
        array("nomenclatura" => "AS","pais" => "Samoa Americana"),
        array("nomenclatura" => "SM","pais" => "San Marino"),
        array("nomenclatura" => "VC","pais" => "San Vicente y Granadinas"),
        array("nomenclatura" => "SH","pais" => "Santa Helena"),
        array("nomenclatura" => "LC","pais" => "Santa Lucía"),
        array("nomenclatura" => "ST","pais" => "Santo Tomé y Príncipe"),
        array("nomenclatura" => "SN","pais" => "Senegal"),
        array("nomenclatura" => "SC","pais" => "Seychelles"),
        array("nomenclatura" => "SL","pais" => "Sierra Leona"),
        array("nomenclatura" => "SG","pais" => "Singapur"),
        array("nomenclatura" => "SY","pais" => "Siria"),
        array("nomenclatura" => "SO","pais" => "Somalia"),
        array("nomenclatura" => "LK","pais" => "Sri Lanka"),
        array("nomenclatura" => "PM","pais" => "St Pierre y Miquelon"),
        array("nomenclatura" => "SZ","pais" => "Suazilandia"),
        array("nomenclatura" => "SD","pais" => "Sudán"),
        array("nomenclatura" => "SE","pais" => "Suecia"),
        array("nomenclatura" => "CH","pais" => "Suiza"),
        array("nomenclatura" => "SR","pais" => "Surinam"),
        array("nomenclatura" => "TH","pais" => "Tailandia"),
        array("nomenclatura" => "TW","pais" => "Taiwán"),
        array("nomenclatura" => "TZ","pais" => "Tanzania"),
        array("nomenclatura" => "TJ","pais" => "Tayikistán"),
        array("nomenclatura" => "TF","pais" => "Territorios franceses del Sur"),
        array("nomenclatura" => "TP","pais" => "Timor Oriental"),
        array("nomenclatura" => "TG","pais" => "Togo"),
        array("nomenclatura" => "TO","pais" => "Tonga"),
        array("nomenclatura" => "TT","pais" => "Trinidad y Tobago"),
        array("nomenclatura" => "TN","pais" => "Túnez"),
        array("nomenclatura" => "TM","pais" => "Turkmenistán"),
        array("nomenclatura" => "TR","pais" => "Turquía"),
        array("nomenclatura" => "TV","pais" => "Tuvalu"),
        array("nomenclatura" => "UA","pais" => "Ucrania"),
        array("nomenclatura" => "UG","pais" => "Uganda"),
        array("nomenclatura" => "UY","pais" => "Uruguay"),
        array("nomenclatura" => "UZ","pais" => "Uzbekistán"),
        array("nomenclatura" => "VU","pais" => "Vanuatu"),
        array("nomenclatura" => "VE","pais" => "Venezuela"),
        array("nomenclatura" => "VN","pais" => "Vietnam"),
        array("nomenclatura" => "YE","pais" => "Yemen"),
        array("nomenclatura" => "YU","pais" => "Yugoslavia"),
        array("nomenclatura" => "ZM","pais" => "Zambia"),
        array("nomenclatura" => "ZW","pais" => "Zimbabue")
    );
return $paises;
}

function estados(){
    return [
        '1' => 'Aguascalientes',
        '2' => 'Baja California',
        '3' => 'Baja California Sur',
        '4' => 'Campeche',
        '5' => 'Chiapas',
        '6' => 'Chihuahua',
        '7' => 'Coahuila de Zaragoza',
        '8' => 'Colima',
        '9' => 'Ciudad de México',
        '10' => 'Durango',
        '11' => 'Guanajuato',
        '12' => 'Guerrero',
        '13' => 'Hidalgo',
        '14' => 'Jalisco',
        '15' => 'Mexico',
        '16' => 'Michoacan de Ocampo',
        '17' => 'Morelos',
        '18' => 'Nayarit',
        '19' => 'Nuevo Leon',
        '20' => 'Oaxaca',
        '21' => 'Puebla',
        '22' => 'Queretaro de Arteaga',
        '23' => 'Quintana Roo',
        '24' => 'San Luis Potosi',
        '25' => 'Sinaloa',
        '26' => 'Sonora',
        '27' => 'Tabasco',
        '28' => 'Tamaulipas',
        '29' => 'Tlaxcala',
        '30' => 'Veracruz-Llave',
        '31' => 'Yucatan',
        '32' => 'Zacatecas',

    ];
}
function formatear_numero($numero, $simbolo = "$", $separador = " ", $decimales = 2){
    $money = number_format($numero, $decimales, ".", ",");
    $cadena =  $simbolo.$separador.$money;
    if($simbolo == "%"){
        $cadena =  $money.$separador.$simbolo;
    }
    return $cadena;
}
require_once '_seo.php';

