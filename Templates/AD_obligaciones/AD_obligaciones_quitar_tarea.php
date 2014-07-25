<?php 
if($acceso == 1) {
	$id_trabajo_env = $_POST["id_trabajo"];
	$id_tarea_env = $_POST["id_tarea"];
	if($obligaciones->eliminar_obligacion($id_trabajo_env,$id_tarea_env ) ) {
		echo "<script type='text/javascript' language='javascript' >
				alert ('La tarea fue quitada con exito');
				history.back();
				</script>";
	}
	else {
		echo "<script type='text/javascript' language='javascript' >
				alert ('No se ha podido quitar la tarea, vuelva a intentarlo');
				history.back();
				</script>";
	}
}
?>