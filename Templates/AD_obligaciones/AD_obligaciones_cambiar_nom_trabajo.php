<?php 
if($acceso == 1) {
	$trabajo = new trabajos_int();
	$id_trabajo_env = $_POST["id_trabajo"];
	$nom_trabajo_env = $_POST["nom_trabajo"];
	if($trabajo->cambiar_nom_trabajo($id_trabajo_env, $nom_trabajo_env)) {
		echo "<script type='text/javascript' language='javascript' >
				alert ('El trabajo fue modificado con exito');
				history.back();
				</script>";
	}
	else {
		echo "<script type='text/javascript' language='javascript' >
				alert ('No se pudo modificar el trabajo, vuelva a intentarlo');
				history.back();
				</script>";
	}
}
?>