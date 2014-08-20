<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        require_once ("../require/grupos_class.php");
        require_once ("../require/fecha_text_func.php");
        
        $deudas = new deudas();
        $grupos = new grupos();
        $integrantes_aux = new integrantes();
        $id_deuda = $_POST["id_deuda"];
        $datos_deuda = $deudas->ver_deuda($id_deuda);
        
?>
        <script>
            $(function(){
                $("#boton-guardar-cambios-deuda").click(function(){
                    $url = "AD_deudas_aux.php";
                    $.ajax({
                        type: "POST",
                        url: $url,
                        data: $("#cambiar_deuda_<?php echo $id_deuda; ?>").serialize(),
                        success: function(data){
                            $("#resultado_cambiar_deuda_<?php echo $id_deuda; ?>").html(data);
                        }
                    });
                    setTimeout(function(){
                        cargar_cuadro_ver_deudas();
                    },3000);
                    return false;
                });
            });
        </script>

<form method="post" id="cambiar_deuda_<?php echo $id_deuda; ?>" >
        <br>
		<table align="center" width="400" >
			<tr >
				<td class="tabla2_encabezado" >
					Nombre de la deuda:
				</td>
			    <td class="tabla2_informacion" >
					<input type="text" name="nombre_deuda" value="<?php echo $datos_deuda["nombre_deuda"]; ?>" >
					<div id="div_nombre_deuda" ></div>
				</td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Ultimo dia de pago:
				</td>
			</tr>
			<tr class="tabla2_informacion" >
                <td colspan="2" >
                    <input type="input" name="fecha_final" id="fecha_final_<?php echo $id_deuda; ?>" value="<?php echo $datos_deuda["fecha_final"]; ?>" />
                    <br>
                    <span style="background-color: #ffc; cursor:default; padding:.3em; border:thin solid #ff0; text-decoration:underline; color: blue;" 
    onmouseover="this.style.cursor='pointer'; this.style.cursor='hand'; this.style.backgroundColor='#ff8'; this.style.textDecoration='none';"
    onmouseout="this.style.backgroundColor='#ffc'; this.style.textDecoration='underline';"
    id="fecha_usuario_<?php echo $id_deuda; ?>">
                       Elegir fecha
                    </span>
                    
                    <script type="text/javascript">
                        Calendar.setup({
                        inputField: "fecha_final_<?php echo $id_deuda; ?>",
                        ifFormat:   "%Y-%m-%d",
                        weekNumbers: false,
                        displayArea: "fecha_usuario_<?php echo $id_deuda; ?>",
                        daFormat:    "%A, %d de %B de %Y"
                        });
                    </script>
                </td>
			</tr>
			<tr >
				<td class="tabla2_encabezado" >
					Cantidad de Pago(Soles):
				</td>
			    <td class="tabla2_informacion" >
					<input type="text" name="monto_total" value="<?php echo $datos_deuda["monto_total"]; ?>" >
					<div id="div_cantidad" ></div>
				</td>
			</tr>
			<tr id="tabla2_encabezado" >
				<td colspan="2" >
					Encargado de Cobrar:
				</td>
			</tr>
			<tr id="tabla2_informacion">
			    <td colspan="2" >
						<select name="id_cobrador" id="id_cobrador" >
                           <option value="" >Nadie</option>
                            <?php			
                            $integrantes_aux->ver_datos_integrantes();
                            while($list_integrantes = $integrantes_aux->retornar_SELECT()) {
                            ?>
                            <option value="<?php echo $list_integrantes['id_persona'];?>" <?php if($datos_deuda["id_cobrador"]==$list_integrantes['id_persona']){echo "selected";}  ?> ><?php echo $integrante->ver_nombre_completo($list_integrantes["id_persona"]);?></option>
                            <?php 
                            }
                            ?>
                        </select>
				</td>
			</tr>
			<?php /* ?>
			<tr id="tabla2_encabezado" >
				<td colspan="2" >
					Grupo:
				</td>
			</tr>
			<tr id="tabla2_informacion">
			    <td colspan="2" >
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
                        <option value="<?php echo $op_grupo['id_grupo'];?>" <?php if($op_grupo['id_grupo']==$datos_deuda["id_grupo"]){echo "selected";} ?> ><?php echo $op_grupo['nom_grupo']?></option>
                        <?php 
                                }
                        }
                        ?>
                    </select>
                </td>
			</tr>
            <?php */ ?>
			<tr>
			    <td colspan="2" >
			        <div id="resultado_cambiar_deuda_<?php echo $id_deuda; ?>" >
			            
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" colspan="2" >
					<input type="hidden" name="id_deuda" value="<?php echo $datos_deuda["id_deuda"]; ?>">
				    <input type="hidden" name="boton-guardar-cambios-deuda" value="boton-editar-deuda">
					<input type="submit" id="boton-guardar-cambios-deuda" value="Guardar" >
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