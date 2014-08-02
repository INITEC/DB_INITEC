<?php
session_start();
require_once ("usuarios_class.php");
require_once ("temporadas_class.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$usuarios = new usuarios ();
$temporadas = new temporadas ();

if ($usuarios->verificar_usuario ($usuario,$clave) == 1  ){
    $id_persona = $usuarios->obtener_id_persona ($usuario, $clave);
    $id_temporada = $temporadas->ver_ultima_id_temporada ();
    $_SESSION["id_persona"]=$id_persona;
	$_SESSION["id_temporada"]=$id_temporada;
    header("Location: home.php");
}

?>