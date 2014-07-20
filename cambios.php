<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
?>
<html>
<head>
<title>..::AD PAGOS::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
<div id="contenedor">
	<div id="cabecera_ob" >
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $usuario["foto"];?>" height="70px" align="right">
		<a href="salir.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	</div>
	<div id="cuerpo_tr" >
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo "editor"; ?></h1>
			</div>
			<div id="identidad" >
<!-- *************************************************************************************************** -->
<form action="inicio_editar_2.php" method="post" name="reun">
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Integrante a editar
				</td>
				<td valign="top" width="200" class="informacion_extra" >
						<select name="id">
					<?php 
					$inte="select id_integrante,integrante,estado from integrantes where estado='activo' order by integrante asc";
					$res_inte=mysql_query($inte,$conexion);
					while($reg_inte=mysql_fetch_array($res_inte)){
					?>					
						<option value="<?php echo $reg_inte["id_integrante"];?>"><?php echo $reg_inte["integrante"];?></option>
					<?php } ?>
						</select>
				</td>
			</tr>
			
			<input type="submit" name="enviar" value="enviar">
		</form>
		
<!-- *************************************************************************************************** -->			
			</div>
		</div>	
	</div>
</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>
</body>
</html>


