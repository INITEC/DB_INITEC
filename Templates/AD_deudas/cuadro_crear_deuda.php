<?php
if ($acceso == 1){
    if( !empty($_POST)){
        
        require_once ("../require/mes_text_func.php");
        
        $integrantes_aux = new integrantes();
        
        date_default_timezone_set('America/Los_Angeles');
        $dia=date(d);
        $mes=date(n);
        $year=date(Y);
        $fecha_hoy = $year."-".$mes."-".$dia;
?>
<script>
    $(function(){
        $("#boton_crear_nueva_deuda").click(function(){
            $url = "prueba2.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $("#crear_deuda").serialize(),
                success: function(data){
                    $("#respuesta_crear_deuda").html(data);
                }
            });
            setTimeout(function(){
                cargar_cuadro_crear_deuda();
                cargar_cuadro_ver_deudas();
            },3000);
            return false;
        });
    });
    
    
</script>

<form method="post" id="crear_deuda" >
		<table align="center" width="400" >
			<tr >
				<td class="tabla2_encabezado" >
					Nombre de la deuda:
				</td>
			    <td class="tabla2_informacion" >
					<input type="text" name="nombre_deuda" value="<?php echo mes_text($fecha_hoy); ?>" >
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
                    <input type="input" name="fecha" id="fecha" value="<?php echo $year."-".$mes."-".$dia; ?>" />
                    <br>
                    <span style="background-color: #ffc; cursor:default; padding:.3em; border:thin solid #ff0; text-decoration:underline; color: blue;" 
    onmouseover="this.style.cursor='pointer'; this.style.cursor='hand'; this.style.backgroundColor='#ff8'; this.style.textDecoration='none';"
    onmouseout="this.style.backgroundColor='#ffc'; this.style.textDecoration='underline';"
    id="fecha_usuario">
                       Elegir fecha
                    </span>
                    
                    <script type="text/javascript">
                        Calendar.setup({
                        inputField: "fecha",
                        ifFormat:   "%Y-%m-%d",
                        weekNumbers: false,
                        displayArea: "fecha_usuario",
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
					<input type="text" name="cantidad" value="20" >
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
						<select name="cobrador" id="cobrador" >
                           <option value="" >Nadie</option>
                            <?php			
                            $integrantes_aux->ver_datos_integrantes();
                            while($list_integrantes = $integrantes_aux->retornar_SELECT()) {
                            ?>
                            <option value="<?php echo $list_integrantes['id_persona'];?>" ><?php echo $integrante->ver_nombre_completo($list_integrantes["id_persona"]);?></option>
                            <?php 
                            }
                            ?>
                        </select>
				</td>
			</tr>
			<tr>
			    <td colspan="2" >
			        <div id="respuesta_crear_deuda" >
			            
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" colspan="2" >
					<input type="hidden" name="fecha_creada" value="<?php echo "$fecha_hoy"; ?>" >
                    <input type="hidden" name="boton_crear_nueva_deuda" value="boton" >
					<input type="button" id="boton_crear_nueva_deuda" value="Crear" >
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