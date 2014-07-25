<?php 
if($acceso == 1 ) {
?>
	<table align="center" >
		<tr id="tabla1_encabezado">
			<td>
				No
			</td>
			<td>
				Nombre del Grupo
			</td>
			<td>
				Cantidad
			</td>
			<td>
				Fecha Creada
			</td>
			<td>
				Cambiar Estado
			</td>
		</tr>
		<?php 
			$grupo->ver_grupos_todos();
			$cont_grupo = 1; 
			while($op_grupo = $grupo->retornar_SELECT()) {
		?>
		<tr>
			<td colspan="5">
				<div id="div_resul<?php echo $op_grupo['id_grupo']; ?>">
		
				</div>
			</td>
		</tr>
		<tr id="tabla1_informacion">
			<td>
				<?php echo $cont_grupo;?>
			</td>
			<td>
				<?php echo $op_grupo["nom_grupo"]; ?>
			</td>
			<td>
				<?php echo $op_grupo["cantidad"]?>
			</td>
			<td>
				<?php echo $op_grupo["fecha_creada"];?>
			</td>
			<form action="javascript:void(0);" method="POST" id="form<?php echo $op_grupo['id_grupo'];?>">
			<td>
				<?php 
					if($op_grupo["estado_grupo"] == 1) {
				?>
				<input type="button" name="Desactivar" value="Desactivar" 
				onclick="cambiar_estado('<?php echo $op_grupo['id_grupo'];?>','0','div_resul<?php echo $op_grupo['id_grupo'];?>','AD_grupos_aux.php',1);">
				<?php }else{?>
				<input type="button" name="Activar" value="Activar" 
				onclick="cambiar_estado('<?php echo $op_grupo['id_grupo'];?>','1','div_resul<?php echo $op_grupo['id_grupo'];?>','AD_grupos_aux.php',1);">
				<?php }?>
			</td>
			</form>
		</tr>
		<?php $cont_grupo++; } ?>
	</table>
<?php 
}
?>