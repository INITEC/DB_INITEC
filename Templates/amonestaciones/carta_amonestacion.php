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
        require_once ("../require/temporadas_class.php");
        
        $id_amonestacion = $_GET["dato"];
        $amonestaciones = new amonestaciones();
        ?>
        <div width="600px" style="background-color:#FF0000">
			&nbsp;Instituto de Innovaci&oacuten Tecnol&oacutegica<br>
			&nbsp;Direci&oacuten de Talento Humano
			
			&nbsp;<p align="left" ><b>Carta de Amonestaci&oacuten <?php echo $id_amonestacion; ?></b></p>
			<p align="right" >UNI - <?php echo fecha_text($reg["fecha_emision"]); ?></p>
			&nbsp; <b><?php echo $reg["integrante"];?></b> integrante del INITEC<br>
			El Directorio de Talento Humano, en ejercicio de sus facultades de direcci&oacuten, a decidido amonestarle por escrito en virtud de los siguientes hechos:<br>
			<b><?php echo chao_tilde($reg["motivo"]);?></b><br>
			Estos hechos constituyen para el INITEC una falta <?php echo $reg["tipo"];?> de conformidad con lo dispuesto en el articulo "<?php echo $reg["articulo"];?>" del cap&iacutetulo <?php echo $reg["capitulo"];?> del vigente estatuto y en su virtud de Director decide:<br>
			Amonestarle por este comportamiento, y en el caso de acumular seis amonestaciones leves o dos graves, se proceder&aacute a separarlo de la organizaci&oacuten conforme lo estipula el Estatuto.<br>
			Sin otro particular que manifestarle, se despide atentamente.<br><br>
			Directorio de Talento Humano
			
        </div>
<?php
	}
}
?>