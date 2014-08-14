<script>
    $(function(){
        $("#boton-crear").click(function(){
            $url = "AD_reuniones_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $("#nueva_reunion").serialize(),
                success: function(data){
                    $("#resultado_nueva_reunion").html(data);
                }
            });
            
            return false;
        });
    });
    
    
</script>

<form method="post" id="nueva_reunion" >
        <br>
		<table align="center" width="400" >
			<tr class="tabla2_encabezado" >
                <td colspan="2" >
                    <?php 
                        date_default_timezone_set('America/Los_Angeles');
                        $dia=date(d);
                        $mes=date(n);
                        $year=date(Y);
                    ?>
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
			
			<tr>
				<td class="tabla2_encabezado" >
					Hora de inicio:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="hora_inicio" value="00:00:00" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td class="tabla2_encabezado" >
					Hora de finalizacion:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="hora_final" value="00:00:00" >
					<div id="div_hora_fin" ></div>
				</td>
			</tr>
			<tr>
			    <td class="tabla2_encabezado" >
			        Grupo
			    </td>
			    <td class="tabla2_informacion" >
                    <select name="id_grupo" id="id_grupo" >
                        <?php 
                        if($grupo->numero_grupos() == 0) {
                        ?>
                            <option value="">Vacio</option>
                        <?php
                        } else { 												
                            $grupo->ver_grupos();
                            while($op_grupo = $grupo->retornar_SELECT()) {
                            ?>
                            <option value="<?php echo $op_grupo['id_grupo'];?>"><?php echo $op_grupo['nom_grupo']?></option>
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
					<input type="text" name="lugar" value="OFICINA INITEC - RESIDENCIA UNI" >
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
					<input type="text" name="asunto" value="REUNION DE INFORMACION Y COORDINACION" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
			<tr>
			    <td colspan="2" >
			        <div id="resultado_nueva_reunion" >
			            <!-- Aca aparecera la respuesta HTML del ajax -->
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
				    <input type="hidden" name="boton-crear-reunion" value="boton-crear-reunion">
					<input type="submit" id="boton-crear" value="Crear" >
				</td>
			</tr>
		</table>
</form>