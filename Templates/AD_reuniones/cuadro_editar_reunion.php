<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/reuniones_class.php");
        require_once ("../require/grupos_class.php");
        
        $reuniones = new reuniones();
        $grupos = new grupos();
        $id_reunion = $_POST["id_reunion"];
        $datos_reunion = $reuniones->ver_reunion($id_reunion);
        
?>
        <script>
            $(function(){
                $("#boton-guardar-cambios-reunion").click(function(){
                    $url = "AD_reuniones_aux.php";
                    $.ajax({
                        type: "POST",
                        url: $url,
                        data: $("#cambiar_reunion_<?php echo $id_reunion; ?>").serialize(),
                        success: function(data){
                            $("#resultado_cambiar_reunion_<?php echo $id_reunion; ?>").html(data);
                        }
                    });
                    setTimeout(function(){cargar_cuadro_reuniones();},3000);
                    return false;
                });
            });
        </script>

<form method="post" id="cambiar_reunion_<?php echo $id_reunion; ?>" >
        <br>
		<table align="center" width="400" >
			<tr class="tabla2_encabezado" >
                <td colspan="2" >
                    <input type="input" name="fecha" id="fecha_<?php echo $id_reunion; ?>" value="<?php echo $reuniones->ver_fecha_reunion($datos_reunion["id_reunion"]); ?>" />
                    <br>
                    <span style="background-color: #ffc; cursor:default; padding:.3em; border:thin solid #ff0; text-decoration:underline; color: blue;" 
    onmouseover="this.style.cursor='pointer'; this.style.cursor='hand'; this.style.backgroundColor='#ff8'; this.style.textDecoration='none';"
    onmouseout="this.style.backgroundColor='#ffc'; this.style.textDecoration='underline';"
    id="fecha_usuario_<?php echo $id_reunion; ?>">
                       Cambiar fecha
                    </span>
                    
                    <script type="text/javascript">
                        Calendar.setup({
                        inputField: "fecha_<?php echo $id_reunion; ?>",
                        ifFormat:   "%Y-%m-%d",
                        weekNumbers: false,
                        displayArea: "fecha_usuario_<?php echo $id_reunion; ?>",
                        daFormat:    "%A, %d de %B de %Y"
                        });
                    </script>
                </td>
			</tr>
			
			<tr>
				<td class="tabla2_encabezado" >
					Hora de inicio:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="hora_inicio" value="<?php echo $datos_reunion["hora_inicio"]; ?>" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td class="tabla2_encabezado" >
					Hora de finalizacion:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="hora_final" value="<?php echo $datos_reunion["hora_final"]; ?>" >
					<div id="div_hora_final" ></div>
				</td>
			</tr>
			<tr>
			    <td class="tabla2_encabezado" >
			        Grupo
			    </td>
			    <td class="tabla2_informacion" >
                    <select name="id_grupo" id="id_grupo" >
                        <?php 
                        if($grupos->numero_grupos() == 0) {
                        ?>
                            <option value="">Vacio</option>
                        <?php
                        } else { 												
                            $grupos->ver_grupos();
                            while($op_grupo = $grupos->retornar_SELECT()) {
                            ?>
                            <option value="<?php echo $op_grupo['id_grupo'];?>" <?php if($datos_reunion["id_grupo"]==$op_grupo["id_grupo"]){echo "selected";} ?> ><?php echo $op_grupo['nom_grupo']?></option>
                            <?php 
                            }
                        }
                        ?>
					</select>
			    </td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Lugar:
				</td>
			</tr>
			<tr class="tabla2_informacion" >
			    <td colspan="2" >
					<input type="text" name="lugar" value="<?php echo $datos_reunion["lugar"]; ?>" >
					<div id="div_lugar" ></div>
				</td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Asunto:
				</td>
			</tr>
			<tr class="tabla2_informacion" >
			    <td colspan="2" >
					<input type="text" name="asunto" value="<?php echo $datos_reunion["asunto"]; ?>" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
			<tr>
			    <td colspan="2" >
			        <div id="resultado_cambiar_reunion_<?php echo $id_reunion; ?>" >
			            <!-- Aca aparecera la respuesta HTML del ajax -->
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
                    <input type="hidden" name="id_reunion" value="<?php echo $datos_reunion["id_reunion"]; ?>">
				    <input type="hidden" name="boton-guardar-cambios-reunion" value="boton-editar-reunion">
					<input type="submit" id="boton-guardar-cambios-reunion" value="Guardar" >
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