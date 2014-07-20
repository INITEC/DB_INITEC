<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD DEUDAS"){
	$sql="insert into deudas values (
	null, '".$_POST["nombre_deuda"]."', '".$_POST["fecha_creada"]."', 
	'".$_POST["fecha_final"]."', '".$_POST["cantidad"]."' , '".$_SESSION["temporada"]."', '".$_POST["cobrador"]."')";
	if($res=mysql_query($sql,$conexion)){
		$deu="select id_deuda from deudas order by id_deuda desc limit 1";
		$res_deu=mysql_query($deu,$conexion);
		$reg_deu=mysql_fetch_array($res_deu);
		
		$rell="select * from integrantes where estado='activo'" ;
		$res_rell=mysql_query($rell,$conexion);
		while($reg_rell=mysql_fetch_array($res_rell)){
			$ing="insert into pagos values (
					null, '".$reg_rell["id_integrante"]."' , '0' , '1' , '".$reg_deu["id_deuda"]."') ";
			$res_ing=mysql_query($ing,$conexion);
		}
		?>
		<html>
		<body>
		<form action="AD_deudas.php" method="post" name="form" >
		<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"];?>" >
		</form>
		</body>
		</html>
		<?php 
	
	echo "<script type='text/javascript' language='javascript' >
	document.form.submit();
	</script>";
	}
	else {
		echo "<script type=''>
			alert('La deuda no pudo ser creada, vuelva a intentarlo');
			history.back();
	</script>";}


} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

