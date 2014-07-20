<?php 

function encabezado ($trabajo_actual,$id_integrante,$trabajo ) {
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
echo $id_integrante;
$sql="select * from integrantes where id_integrante='".$id_integrante."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
echo $usuario["integrante"];
?>

	<b>hola1</b>

<?php
echo $trabajo_actual;
?>
	<b>hola2</b>
<?php 	} 	?>

<html>
<head>
<title>..::HOME::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">


		
<?php	
				
		echo "hola";
encabezado('usuario','1','usuario');		
		echo "hola";
		
		
?>

</body>
</html>

