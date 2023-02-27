<?php
//pagina para cierre de sesion del usuario y salir del sistema
session_start();
session_destroy(); //cerrar la session

header("Location: index.php"); //enviar al login despues de cerrar sesion
?>