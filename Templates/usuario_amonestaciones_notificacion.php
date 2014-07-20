<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
$id_amonestacion=$_GET["id"];
$sql="select * from amonestaciones,integrantes where amonestaciones.id_amonestacion='".$id_amonestacion."' AND
		integrantes.id_integrante=amonestaciones.receptor";
$res=mysql_query($sql,$conexion);

if($reg=mysql_fetch_array($res)){

?>
	<html>
		<head>
		<link href="css/estilos.css" type="text/css" rel="stylesheet" >
		</head>
		<body>
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
		</body>
	</html>
<?php 
} else {
	echo "Lamentablemente no se pudo acceder a los datos";
}}
?>