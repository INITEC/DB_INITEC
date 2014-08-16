<?php 
$sql="select * from deudas order by id_deuda desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Nombre de la Deuda
				</td>
				<td align="center" valign="top" width="150" >
				Fecha creada
				</td>
				<td align="center" valign="top" width="150" >
				Fecha limite
				</td>
				<td align="center" valign="top" width="150" >
				Cantidad
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["nombre_deuda"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_creada"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_final"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["cantidad"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_deuda"]; ?>','ver_mas_<?php echo $reg["id_deuda"]; ?>','observador_deudas_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_deuda"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_deuda"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_deudas_editar.php" method="post" name="form_<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="id_deuda" value="<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_deuda"]; ?>" >
				</div>	
				</td>
			</tr>
		
<?php 
}
?>
		</table>