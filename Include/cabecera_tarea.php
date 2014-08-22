<?php 
header('Content-Type: text/html; charset=UTF-8');
?>
<link href="../Estilos/cabecera_tarea.css" type="text/css" rel="stylesheet" >
<div id="cabecera_tarea">
	<img src="../Imagenes/initec_presentacion.jpg" height="100%" align="left">
	<img src="<?php echo $integrante->foto_int();?>" height="70px" align="right">
	<a href="salir.php"><img src="../Imagenes/salir.png"  title="Salir" height="70px" align="right"></a>
</div>