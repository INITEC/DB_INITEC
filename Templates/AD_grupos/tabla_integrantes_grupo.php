<?php 
if($acceso == 1) {

    if( !empty($_POST)){
	$id_grupo = $_POST["id_grupo"];
    
    $tabla_integrantes = new integrantes();
        
?>
    <script>
        function cambiar_estado_integrante (id_div, id_form){
            $.ajax({
                type: "POST",
                url: "AD_grupos_aux.php",
                data: $(id_form).serialize(),
                success: function(data){
                    $(id_div).html(data);
                }
            });
            setTimeout(function(){cuadro_integrantes_grupo ();},3000);
            return false;
        }
    </script>
    
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
		$tabla_integrantes->ver_datos_integrantes();
		$cont_integrante = 1;
		while($rel_integrante = $tabla_integrantes->retornar_SELECT()) {
	?>	
		<tr>
			<td colspan="5">
				<div id="div_resul<?php echo $rel_integrante['id_persona'];?>">
				</div>
			</td>
		</tr>
		<?php 
			if($grupo->verificar_integrante($rel_integrante['id_persona'], $id_grupo) != 0 ) {
                $class = "item3";
            }else {
                $class = "item4";
            }
        ?>
		<tr class="<?php echo $class; ?>">
			<td>
				<?php echo $cont_integrante;?>
			</td>
			<td>
				<img src="<?php echo $integrante->ver_foto($rel_integrante["id_persona"]);?>" width="60" height="48" border="0" >
			</td>
			<td class="mayuscula" >
				<?php echo $integrante->ver_nombre_completo($rel_integrante["id_persona"]);?>
			</td>
			
			<td>
			<form  id="estado_<?php echo $rel_integrante['id_persona'];?>" method="POST" >
				<input type="hidden" name="id_persona_env" value="<?php echo $rel_integrante['id_persona'];?>" >
				<input type="hidden" name="id_grupo_env" value="<?php echo $id_grupo; ?>">
				<input type="hidden" name="boton-cambiar-estado-integrante" value="boton">
				
				<input type="button" id="cambiar-estado-integrante" 
				onclick="cambiar_estado_integrante('#div_resul<?php echo $rel_integrante['id_persona'];?>','#estado_<?php echo $rel_integrante['id_persona'];?>');"
				<?php 
				if($grupo->verificar_integrante($rel_integrante['id_persona'], $id_grupo) != 0 ) {
				?>
				    value="Quitar" title="Quitar Integrante"
				<?php
                } else {
                ?>
				    value="Agregar" title="Agregar Integrante"
				<?php
                }
                ?>
				>
				
			</form>
			</td>

		</tr>	
	<?php 
		$cont_integrante++;}
	?>
	</table>
<?php 
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>