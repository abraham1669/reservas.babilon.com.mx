<?php
include("../../includes/_funciones.php");

if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar_usuario':guardar_usuario();
            break;
        
        case 'listar_usuarios':listar_usuarios();
            break;
        
        case 'eliminar_usuario':eliminar_usuario();
            break;
        
        case 'consultar_usuario':consultar_usuario();
            break;
        
        case 'editar_usuario':editar_usuario();
            break;
    }
}

function guardar_usuario() {
    mysql_query("SET NAMES 'utf8'");
    global $link;
    $usuario = trim($_POST['usuario']);
    $password = md5(str_replace(' ', '', $_POST['password']));
    
    $login = time();
    $sql = "INSERT INTO usuarios values('', '" . $_POST['nombre'] . "', '" . $_POST['correo'] . "', '" . $usuario . "', '$password', '" . $_POST['nivel'] . "', '" . $_POST['secciones'] . "', '$login', '', '')";
    mysql_query($sql, $link);
}


function listar_usuarios() {
    global $link;
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "SELECT * FROM usuarios WHERE id_usr != '1'";
    $query = mysql_query($sql, $link);
    $datos = array();
    
    while ($rows = mysql_fetch_array($query)) {
        if($rows['nivel_usr'] == "1"){
            $nivel = "Admnistrador";
        }else{
            $nivel = "Editor";
        }
        
        $datos[] = array(
            'nombre' => $rows['nombre_usr'],
            'nivel' => $nivel,
            'email' => $rows['correo_usr'],
            'id' => $rows['id_usr']
        );
    }

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function eliminar_usuario(){
    global $link;
    $sql = "
	DELETE FROM usuarios where id_usr = '" . $_POST['id'] . "'";
    mysql_query($sql, $link);
}

function consultar_usuario() {
    mysql_query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM usuarios WHERE id_usr = '" . $_POST['id'] . "'";

    $query = mysql_query($sql);
    $datos = array();
    $rows = mysql_fetch_array($query);
    
    $datos[] = array(
        'nombre' => $rows['nombre_usr'],
        'email' => $rows['correo_usr'],
        'usuario' => $rows['usuario_usr'],
        'password' => $rows['clave_usr'],
        'nivel' => $rows['nivel_usr'],
        'secciones' => $rows['secciones_usr'],
        'id' => $rows['id_usr']
    );

    $_SESSION["usuario_editado"] = $rows['id_usr'];
    $_SESSION["usuario_clave"] = $rows['clave_usr'];

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function editar_usuario() {
    global $link;
    mysql_query("SET NAMES 'utf8'");
    $correo = trim($_POST['correo']);

    if ($_POST['password'] === $_SESSION['usuario_clave']) {
        $password = trim($_SESSION['usuario_clave']);
    } else {
        $password = md5(trim($_POST['password']));
    }

    $sql = "
	UPDATE usuarios
	SET 
        nombre_usr = '" . $_POST['nombre'] . "', 
        correo_usr = '$correo', 
        usuario_usr = '" . $_POST['usuario'] . "', 
        clave_usr = '$password',
        nivel_usr = '" . $_POST['nivel'] . "',
        secciones_usr = '" . $_POST['secciones'] . "'
	WHERE 
	id_usr='" . $_SESSION['usuario_editado'] . "'";

    mysql_query($sql, $link);
}


