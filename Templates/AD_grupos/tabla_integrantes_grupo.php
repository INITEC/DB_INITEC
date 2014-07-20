<?php 
if($acceso = 1) {
	$id_grupo = $_GET["id_grupo"];
?>
	<br>
	<table align="center" >
		<tr id="tabla1_encabezado">
			<td>
				Nombre del Grupo
			</td>
			<td>
				Cantidad
			</td>
			<td>
				Fecha Creada
			</td>
		</tr>
		<?php 
			$op_grupo = $grupo->datos_grupo($id_grupo); 
		?>
		<tr id="tabla1_informacion">
			<td>
				<?php echo $op_grupo["nom_grupo"]; ?>
			</td>
			<td>
				<?php echo $op_grupo["cantidad"]?>
			</td>
			<td>
				<?php echo $op_grupo["fecha_creada"];?>
			</td>
		</tr>
	</table>
	<hr>
	<table align="center">
		<tr id="tabla1_encabezado">
			<td>
				No
			</td>
			<td>
				Foto
			</td>
			<td>
				Integrante
			</td>
			<td>
				Estado
			</td>
		</tr>
	<?php 
		$integrante->ver_integrantes();
		$cont_integrante = 1;
		while($rel_integrante = $integrante->retornar_SELECT()) {
	?>	
		<tr>
			<td colspan="5">
				<div id="div_resul<?php echo $rel_integrante['id_integrante'];?>">
				</div>
			</td>
		</tr>
		<tr id="tabla1_informacion">
			<td>
				<?php echo $cont_integrante;?>
			</td>
			<td>
				<img src="../foto_integrantes/<?php echo $rel_integrante['foto'];?>" width="60" height="48" border="0" >
			</td>
			<td>
				<?php echo $rel_integrante["integrante"];?>
			</td>
			
			<td>
			<form action="javascript:void(0);" id="form_<?php echo $rel_integrante['id_integrante'];?>" >
				<input type="hidden" name="id_integrante_env" value="<?php echo $rel_integrante['id_integrante'];?>" >
				<input type="hidden" name="id_grupo_env" value="<?php echo $id_grupo; ?>">
			
				<?php 
					if($grupo->verificar_integrante($rel_integrante['id_integrante'], $id_grupo) != 0 ) {
				?>
				<input type="button" name="Quitar_integrante" value="Quitar" 
				onclick="enviar_int('div_resul<?php echo $rel_integrante['id_integrante'];?>','form_<?php echo $rel_integrante['id_integrante'];?>', 1);">
				<?php }else{?>
				<input type="button" name="Agregar_integrante" value="Agregar" 
				onclick="enviar_int('div_resul<?php echo $rel_integrante['id_integrante'];?>','form_<?php echo $rel_integrante['id_integrante'];?>', 1);">
				<?php }?>
			</form>
			</td>

		</tr>	
	<?php 
		$cont_integrante++;}
	?>
	</table>
<?php 
}
?>