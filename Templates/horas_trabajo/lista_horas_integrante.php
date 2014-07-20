<?php 
if($acceso == 1) {
?>
	<table align="center">
		<tr id="tabla2_encabezado">
			<td>
				GRUPO
			</td>
			<td>
				COMENTARIO
			</td>
			<td>
				FECHA
			</td>
			<td>
				NUM. HORAS
			</td>
		</tr>
	<?php 
		$horas_trabajo->ver_horas_trabajo_int($id_integrante_env);
		$cont_horas = 1;
		while($dt_trabajo = $horas_trabajo->retornar_SELECT() ) {
	?>	
		<tr id="tabla2_informacion">
			<td>
				<?php echo $grupo->ver_grupo($dt_trabajo["id_grupo"]); ?>
			</td>
			<td>
				<?php echo $dt_trabajo["comentario"];?>
			</td>
			<td>
				<?php echo $horas_trabajo->ver_fecha($dt_trabajo["id_dia_trabajo"]);?>
			</td>
			<td>
				<?php echo $dt_trabajo["n_horas"];?>
			</td>
		</tr>
	<?php 
		$cont_horas++; }
	?>
	</table>
<?php 
}
?>