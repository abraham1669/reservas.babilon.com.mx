<?php
session_start();
session_destroy();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    header("Location: index.php");	
}else{
    header("Location: /");	
}
?>