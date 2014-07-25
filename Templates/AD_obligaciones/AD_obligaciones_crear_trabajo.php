<?php 
if($acceso == 1) {
	$trabajo = new trabajos_int();
	$nom_trabajo_env = $_POST["nom_trabajo"];
	if($trabajo->crear_trabajo($nom_trabajo_env)) {
		echo "<script type='text/javascript' language='javascript' >
				alert ('El trabajo fue creado con exito');
				history.back();
				</script>";
	}
	else {
		echo "<script type='text/javascript' language='javascript' >
				alert ('No se pudo crear el trabajo, vuelva a intentarlo');
				history.back();
				</script>";
	}
}
?>