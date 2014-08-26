<?php 
session_start();
	unset($_SESSION["id_integrante"]);
	unset($_SESSION["id_temporada"]);
session_destroy();
	header("Location: index.php");
?>