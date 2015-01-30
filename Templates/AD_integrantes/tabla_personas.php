<?php 
if($acceso == 1) {

    if( !empty($_POST)){
    $tabla_personas = new personas();
    $cond_int = new cond_int();
        
?>
    <script>
        function cambiar_estado_persona (id_div, id_form){
            $.ajax({
                type: "POST",
                url: "AD_integrantes_aux.php",
                data: $(id_form).serialize(),
                success: function(data){
                    $(id_div).html(data);
                }
            });
            setTimeout(function(){cuadro_personas ();},3000);
            return false;
        }
    </script>
    
	<table align="center">
		<tr id="tabla1_encabezado">
			<td>
				No
			</td>
			<td>
				Apellido y Nombre
			</td>
			<td>
				Estado
			</td>
		</tr>
	<?php 
		$tabla_personas->ver_personas();
		$cont_personas = 1;
		while($rel_personas = $tabla_personas->retornar_SELECT()) {
	?>	
		<tr>
			<td colspan="5">
				<div id="div_resul<?php echo $rel_personas['id_persona'];?>">
				</div>
			</td>
		</tr>
		<?php 
			if($cond_int->ver_cond_persona($rel_personas['id_persona']) != 1) {
                $class = "item3";
            }else {
                $class = "item4";
            }
        ?>
		<tr class="<?php echo $class; ?>">
			<td>
				<?php echo $cont_personas;?>
			</td>
			<td class="mayuscula" >
				<?php echo $integrante->ver_nombre_completo($rel_personas["id_persona"]);?>
			</td>
			<td>
			<form  id="estado_<?php echo $rel_personas['id_persona'];?>" method="POST" >
				<input type="hidden" name="id_persona_env" value="<?php echo $rel_personas['id_persona'];?>" >
                <input type="text" name="id_tipo_cond_env" value="<?php echo $cond_int->ver_cond_persona($rel_personas['id_persona']); ?>" >
				<input type="button" id="cambiar-estado-persona" 
				onclick="cambiar_estado_persona('#div_resul<?php echo $rel_personas['id_persona'];?>','#estado_<?php echo $rel_personas['id_persona'];?>');" value="Enviar" title="Enviar condicion" >
				<input type="hidden" name="boton-cambiar-estado-persona" value="boton">
			</form>
			</td>

		</tr>	
	<?php 
		$cont_personas++;}
	?>
	</table>
<?php 
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>