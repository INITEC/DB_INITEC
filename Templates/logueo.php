<?php
session_start();
require_once ("../require/usuarios_class.php");
require_once ("../require/temporadas_class.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$usuarios = new usuarios ();
$temporadas = new temporadas ();

$id_persona = $usuarios->obtener_id_persona ($usuario, $clave);
    
if ($id_persona != 0  ){
    $id_temporada = $temporadas->ver_ultima_id_temporada ();
    $_SESSION["id_persona"]=$id_persona;
	$_SESSION["id_temporada"]=$id_temporada;
    header("Location: home.php");
} else {
    echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, o estan deshabilitados porfavor vuelva a intentarlo o consulte con el administrador');
			window.location.assign('index.php');
			</script>";
}

?>