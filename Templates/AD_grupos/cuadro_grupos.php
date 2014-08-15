<?php 
if($acceso == 1 ) {
?>
	<script>
        function cambiar_estado_grupo (id_div, id_grupo){
            $parametros = {
                'boton-cambiar-estado-grupo' : true,
                'id_grupo_env' : id_grupo
            };
            $.ajax({
                type: "POST",
                url: "AD_grupos_aux.php",
                data: $parametros,
                success: function(data){
                    $(id_div).html(data);
                }
            });
            setTimeout(function(){ cuadro_grupos ();},3000);
            return false;
        }
        
        
        
    </script>
	
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
			<td>
				
			</td>
		</tr>
		<?php 
			$grupo->ver_grupos_todos();
			$cont_grupo = 1; 
			while($op_grupo = $grupo->retornar_SELECT()) {
		?>
		<tr>
			<td colspan="6">
				<div id="div_resul<?php echo $op_grupo['id_grupo']; ?>">
		
				</div>
			</td>
		</tr>
		<?php
        if($op_grupo["estado"] == 1) {
            $class = "item3";
        } else {
            $class = "item4";
        }
        ?>
		<tr class="<?php echo $class; ?>">
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
			<td>
				<input type="button" 
				onclick="cambiar_estado_grupo('#div_resul<?php echo $op_grupo['id_grupo'];?>','<?php echo $op_grupo['id_grupo'];?>');"
				<?php 
					if($op_grupo["estado"] == 1) {
				?>
				    value="Desactivar" title="Desactivar grupo"
				<?php }else{?>
				    value="Activar" title="Activar grupo"
				<?php }?>
				>
			</td>
			<td >
                <img title="Editar" src="../Imagenes/editar.png" width="20px"
                onClick="editar_grupo('#div_editar_grupo_<?php echo $datos_reunion["id_reunion"]; ?>','<?php echo $datos_reunion["id_reunion"]; ?>' )">
            </td>
		</tr>
        <tr>
			<td colspan="6">
				<div id="div_editar_grupo_<?php echo $datos_reunion["id_reunion"]; ?>">
		
				</div>
			</td>
		</tr>
		<?php $cont_grupo++; } ?>
	</table>
<?php 
}
?>