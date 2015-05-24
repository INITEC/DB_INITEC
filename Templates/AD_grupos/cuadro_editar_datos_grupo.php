<?php 
if($acceso == 1) {

    if( !empty($_POST)){

        $grupos = new grupos();
        $id_grupo_env = $_POST["id_grupo_env"];
        $datos_grupo = $grupos->datos_grupo($id_grupo_env);
        $integrantes_aux = new integrantes();
        
?>
        <script>
            $(function(){
                $("#boton-guardar-cambios-grupo").click(function(){
                    $url = "AD_grupos_aux.php";
                    $.ajax({
                        type: "POST",
                        url: $url,
                        data: $("#cambiar_grupo_<?php echo $id_grupo_env; ?>").serialize(),
                        success: function(data){
                            $("#resultado_cambiar_grupo_<?php echo $id_grupo_env; ?>").html(data);
                        }
                    });
                    setTimeout(function(){cuadro_grupos();},3000);
                    return false;
                });
            });
        </script>

<form method="post" id="cambiar_grupo_<?php echo $id_grupo_env; ?>" >
		<table align="center" width="400" >
			<tr>
				<td class="tabla2_encabezado" >
					Nombre grupo:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="nom_grupo" value="<?php echo $datos_grupo["nom_grupo"]; ?>" >
					<div id="div_nom_grupo" ></div>
				</td>
			</tr>
			<tr class="tabla2_encabezado" >
			    <td colspan="2" >
			        Encargado del grupo
			    </td>
            </tr>
            <tr class="tabla2_informacion" >
			    <td colspan="2" >
                    <select name="encargado" id="encargado" >
                       <option value="" >Nadie</option>
                        <?php			
                        $integrantes_aux->ver_datos_integrantes();
                        while($list_integrantes = $integrantes_aux->retornar_SELECT()) {
                        ?>
                        <option value="<?php echo $list_integrantes['id_persona'];?>" <?php if($list_integrantes["id_persona"]==$datos_grupo["encargado"]){echo "selected";} ?> ><?php echo $integrante->ver_nombre_completo($list_integrantes["id_persona"]);?></option>
                        <?php 
                        }
                        ?>
					</select>
			    </td>
			</tr>
			<tr>
			    <td colspan="2" >
			        <div id="resultado_cambiar_grupo_<?php echo $id_grupo_env; ?>" >
			            <!-- Aca aparecera la respuesta HTML del ajax -->
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
                    <input type="hidden" name="id_grupo" value="<?php echo $datos_grupo["id_grupo"]; ?>">
				    <input type="hidden" name="boton-guardar-cambios-grupo" value="boton-editar-grupo">
					<input type="submit" id="boton-guardar-cambios-grupo" value="Guardar" >
				</td>
			</tr>
		</table>
</form>
<?php
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>