<?php 
if($acceso == 1) {
	$id_persona_env = $_POST["id_persona"];
	$id_trabajo_env = $_POST["id_trabajo"];
	
	if($integrante->cambiar_trabajo($id_persona_env,$id_trabajo_env) ) {
		echo "<script type='text/javascript' language='javascript' >
				alert ('Se cambio el trabajo correctamente');
				history.back();
				</script>";
	}
	else {
		echo "<script type='text/javascript' language='javascript' >
				alert ('No se pudo cambiar el trabajo');
				history.back();
				</script>";
	}
}
?>