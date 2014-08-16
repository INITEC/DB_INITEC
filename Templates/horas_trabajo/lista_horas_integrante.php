<?php 
if($acceso == 1) {
    $horas_trabajo = new horas_trabajo();
    $horas_trabajo_aux = new horas_trabajo();
    
    $cond_hora = new cond_hora();
    
    if(isset($_POST['id_persona_env'])){
        $id_persona_env = $_POST["id_persona_env"];
    } else {
        $id_persona_env = $id_persona;
    }
    
?>
	<table align="center" >
	    <tr class="tabla1_encabezado" >
	        <td>
	           CONDICION 
	        </td>
	        <td>
	            TOTAL
	        </td>
	        <td>
	            HORAS TOTAL
	        </td>
	    </tr>
	    <?php 
        $cond_hora->ver_cond_horas();
        while($dato_cond = $cond_hora->retornar_SELECT() ) {
        ?>
        <tr bgcolor="<?php echo $horas_trabajo->ver_color_cond($dato_cond["id_cond_hora"]); ?>" class="item5"  >
            <td>
                <?php echo $horas_trabajo->ver_nom_cond($dato_cond["id_cond_hora"]); ?>
            </td>
            <td>
                <?php echo $horas_trabajo->num_total_cond($dato_cond["id_cond_hora"],$id_persona_env, $id_temporada); ?>
            </td>
            <td>
                <?php echo $horas_trabajo->horas_total_cond($dato_cond["id_cond_hora"],$id_persona_env, $id_temporada); ?>
            </td>
        </tr>
	    <?php 
        }
        ?>
	</table>
	<hr>
	
	<h2 class="tabla1_encabezado" >DETALLES</h2>
	
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
			<td>
			    COND. HORA
			</td>
		</tr>
	<?php 
		$horas_trabajo->ver_horas_trabajo_all_int($id_persona_env,$id_temporada);
		$cont_horas = 1;
		while($dt_trabajo = $horas_trabajo->retornar_SELECT() ) {
	?>	
		<tr bgcolor="<?php echo $horas_trabajo_aux->ver_color_cond($dt_trabajo["id_cond_hora"]); ?>" class="item5" >
			<td>
				<?php echo $grupo->ver_grupo($dt_trabajo["id_grupo"]); ?>
			</td>
			<td>
				<?php echo $dt_trabajo["comentario"];?>
			</td>
			<td>
				<?php echo $horas_trabajo_aux->ver_fecha($dt_trabajo["id_dia_trabajo"]);?>
			</td>
			<td>
				<?php echo $dt_trabajo["n_horas"];?>
			</td>
			<td>
			    <?php echo $horas_trabajo_aux->ver_nom_cond($dt_trabajo["id_cond_hora"]);?>
			</td>
		</tr>
	<?php 
		$cont_horas++; }
	?>
	</table>
<?php 
}
?>