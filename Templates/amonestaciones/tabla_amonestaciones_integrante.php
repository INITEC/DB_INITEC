<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >
			
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/asistencias_class.php");
        require_once ("../require/temporadas_class.php");
        
        if(isset($_POST['id_persona'])){
			$id_persona_env = $_POST["id_persona"];
		} else {
			$id_persona_env = $id_persona;
        }
        
        $tabla_integrante = new integrantes();
        $amonestaciones = new amonestaciones();
        $temporadas = new temporadas();
        
        $tabla_integrante->establecer_integrante($id_persona_env);
        ?>
     
<?php
	}
}
?>