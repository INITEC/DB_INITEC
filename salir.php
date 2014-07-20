<?php 
session_start();
	unset($_SESSION["id_integrante"]);
	unset($_SESSION["trabajo"]);
	unset($_SESSION["temporada"]);
	session_destroy();
	header("Location: index.php");
?>