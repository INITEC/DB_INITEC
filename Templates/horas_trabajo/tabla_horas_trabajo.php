<?php 
if($acceso = 1) {
	$id_grupo = $_GET["id_grupo"];
?>
	<br>
	<table align="center">
		<tr id="tabla2_encabezado">
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
				Comentario
			</td>
			<td>
				Fecha
			</td>
			<td>
				Num Horas				
			</td>
			<td>
			</td>
		</tr>
	<?php 
		$horas_trabajo->ver_horas_no_validadas($id_grupo);
		$cont_horas = 1;
		while($rel_horas = $horas_trabajo->retornar_SELECT()) {
	?>	
		<tr>
			<td colspan="7">
				<div id="div_resul<?php echo $rel_horas['id_integrante'].'_'.$id_grupo;?>">
				</div>
			</td>
		</tr>
		<tr id="tabla2_informacion">
			<td>
				<?php echo $cont_horas;?>
			</td>
			<td>
				<img src="../foto_integrantes/<?php echo $rel_horas['foto'];?>" width="60" height="48" border="0" >
			</td>
			<td>
				<?php echo $rel_horas["integrante"];?>
			</td>
			<td>
				<?php echo $rel_horas["comentario"];?>
			</td>
			<td>
				<?php echo $horas_trabajo->ver_fecha($rel_horas["id_dia_trabajo"]);?>
			</td>
			<td>
				<?php echo $rel_horas["n_horas"];?>
			</td>
			<td>
			<form action="javascript:void(0);" id="form_<?php echo $rel_horas['id_integrante'].'_'.$id_grupo;?>" >
				<input type="hidden" name="id_integrante_env" value="<?php echo $rel_horas['id_integrante'];?>" >
				<input type="hidden" name="id_grupo_env" value="<?php echo $id_grupo; ?>">
				<input type="hidden" name="id_horas_trab" value="<?php echo $rel_horas['id_horas_trab'];?>">
				<input type="button" name="Validar_horas_trabajo" value="Validar" 
				onclick="enviar_int('div_resul<?php echo $rel_horas['id_integrante'].'_'.$id_grupo;?>','form_<?php echo $rel_horas['id_integrante'].'_'.$id_grupo;?>', 1);">				
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