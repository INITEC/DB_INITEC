<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/temporadas_class.php");
        require_once ("../require/fecha_text_func.php");

        $id_temporada = $_SESSION["id_temporada"];
        $temporadas = new temporadas();
        $amonestaciones = new amonestaciones();
        $max_amonestaciones = $temporadas->ver_max_amonestaciones($id_temporada);
        ?>
        <div class="carta_amonestacion" >
            <div class="carta_amonestacion_interior" >
            <br>
			&nbsp;Instituto de Innovaci&oacuten Tecnol&oacutegica<br>
			&nbsp;Direci&oacuten de Talento Humano
			
			&nbsp;<p align="left" ><b>Carta de Amonestaci&oacuten <?php echo $id_amonestacion; ?></b></p>
			<p align="right" >UNI - <?php echo fecha_text($amonestacion["fecha_emision"]);?></p>
			&nbsp; <b><?php  echo $integrante_amo->ver_nombre_completo($amonestacion["id_receptor"]); ?></b> integrante del INITEC<br>

			<p align="justify" >El Directorio de Talento Humano, en ejercicio de sus facultades de direcci&oacuten, a decidido amonestarle por escrito en virtud de los siguientes hechos sucedidos el <?php echo fecha_text($amonestacion["fecha_falta"]);?>:</p>

			<p align="justify" ><b><?php echo $amonestacion["motivo"];?></b><br></p>
			
			<p align="justify" >Estos hechos constituyen para el INITEC una falta <?php echo $amonestaciones->ver_nom_tipo_amonestacion($amonestacion["id_tipo_amonestacion"]); ?> de conformidad con lo dispuesto en el articulo "<?php echo $amonestacion["articulo"];?>" del cap&iacutetulo <?php echo $amonestacion["capitulo"]; ?> del vigente <?php echo $amonestaciones->ver_nom_reglamento($amonestacion["id_reglamento"]);  ?>, por tanto, se decide:
			<br>
			Amonestarle por este comportamiento, y en el caso de acumular un equivalente a <?php echo $max_amonestaciones; ?> amonestaciones, se proceder&aacute a separarlo de la organizaci&oacuten conforme lo estipula el Estatuto.<br></p>
			
			Sin otro particular que manifestarle, se despide atentamente.<br><br>
			<?php  echo $integrante_amo->ver_nombre_completo($amonestacion["id_remitente"]); ?>
			<!-- <br>
			Directorio de Talento Humano
			<br>
            <br> -->
			</div>
        </div>
<?php
	}
}
?>