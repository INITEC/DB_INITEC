<?php 
if($acceso = 1) {
	$id_grupo = $_POST["id_grupo"];
    $horas_trabajo = new horas_trabajo();
    $horas_trabajo_aux = new horas_trabajo();
?>
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
			<td>
			</td>
		</tr>
	<?php 
		$horas_trabajo->ver_horas_en_espera($id_grupo);
		$cont_horas = 1;
		while($rel_horas = $horas_trabajo->retornar_SELECT()) {
	?>	
		<tr>
			<td colspan="7">
				<div id="div_resul<?php echo $rel_horas['persona'].'_'.$id_grupo;?>">
				</div>
			</td>
		</tr>
		<tr id="tabla2_informacion">
			<td>
				<?php echo $cont_horas;?>
			</td>
			<td>
				<img src="<?php echo $integrante->ver_foto($rel_horas["id_persona"]);?>" width="60" height="48" border="0" >
			</td>
			<td>
				<?php echo $integrante->ver_nombre_completo($rel_horas["id_persona"]);?>
			</td>
			<td>
				<?php echo $rel_horas["comentario"];?>
			</td>
			<td>
				<?php echo $horas_trabajo_aux->ver_fecha($rel_horas["id_dia_trabajo"]);?>
			</td>
			<td>
				<?php echo $rel_horas["n_horas"];?>
			</td>
			<td>
				<input type="button" id="validar_horas_trabajo" value="Validar" 
				onclick="validar_horas_trabajo('div_resul<?php echo $rel_horas['id_persona'].'_'.$id_grupo;?>','<?php echo $rel_horas['id_horas_trab'];?>' ">
			</td>
			<td>
				<input type="button" id="rechazar_horas_trabajo" value="Rechazar" 
				onclick="rechazar_horas_trabajo('div_resul<?php echo $rel_horas['id_persona'].'_'.$id_grupo;?>','<?php echo $rel_horas['id_horas_trab'];?>' ">
			</td>
		</tr>	
	<?php 
		$cont_integrante++;}
	?>
	</table>
<?php 
}
?>