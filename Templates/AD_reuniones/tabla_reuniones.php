<script type='text/javascript' languaje='javascript'>
	function cargar_cuadro_integrantes (){
        $parametros = {'amonestaciones_int' : true };
        $.ajax({
            url: 'amonestaciones_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    }
    window.onload = function(){
	   cargar_cuadro_integrantes();
    }
</script>




<?php 
$sql="select * from reuniones order by id_fecha desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Dia
				</td>
				<td align="center" valign="top" width="150" >
				Fecha
				</td>
				<td align="center" valign="top" width="150" >
				Hora inicio
				</td>
				<td align="center" valign="top" width="150" >
				Hora final
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["dia_semana"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_inicio"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_final"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_fecha"]; ?>','ver_mas_<?php echo $reg["id_fecha"]; ?>','observador_asistencias_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_fecha"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_fecha"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_reuniones_editar.php" method="post" name="form_<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_fecha"]; ?>" >
				</div>	
				</td>
			</tr>
		
<?php 
}
?>
		</table>