<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/cuadro_inasistencias.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/asistencias_class.php");
        require_once ("../require/reuniones_class.php");
        require_once ("../require/temporadas_class.php");
        require_once ("../require/fecha_text_func.php");
        
        $id_asistencia = $_GET["id_asistencia"];
        $id_temporada = $_SESSION["id_temporada"];
        $temporadas = new temporadas();
        $asistencias = new asistencias();
        $reuniones = new reuniones();
        $asistencia = $asistencias->ver_asistencia($id_asistencia);
        $reunion = $reuniones->ver_reunion($asistencia["id_reunion"]);
        $integrante_amo = new integrantes();
        $max_faltas = $temporadas->ver_max_faltas($id_temporada);
        
        ?>
        <div class="carta_inasistencia" >
            <div class="carta_inasistencia_interior" >
            <br>
			Reunion del d&iacutea <?php echo fecha_text($reuniones->ver_fecha_reunion($asistencia["id_reunion"])); ?>
			<br>
			Lugar: <b><?php echo $reunion["lugar"];?></b>
			<br>
			Condicion de la inasistencia: <b><?php echo $asistencias->ver_nom_condicion($asistencia["id_cond_asist"]);?></b>
			<br>
			<br>
			En el caso de acumular <?php echo $max_faltas; ?> inasistencias entre justificadas e injustificadas, se proceder&aacute a separarlo de la organizaci&oacuten conforme lo estipula el Estatuto.
			<br>
            <br>
			Directorio de Talento Humano
			<br>
            <br>
			</div>
        </div>
<?php
	}
}
?>