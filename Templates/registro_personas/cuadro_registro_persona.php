<?php
if ($acceso == 1){
?>
<script>
    $cambio=1;
    
    $(function(){
        $("#boton-registrar-integrante").click(function(){
            $cambio = 2;
            $("#resultado_nuevo_integrante").empty();
            $("#resultado_nuevo_integrante").attr("class", "");
            $("#boton-registrar-integrante").attr('type', 'hidden');
            $url = "registro_personas_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $("#nuevo_integrante").serialize(),
                success: function(data){
                    $("#resultado_nuevo_integrante").html(data);
                }
            });
            setTimeout(function(){cargar_cuadro_registro_integrantes();},3000);
            return false;
        });
    });
    
    function verificar_clave(){
        $clave1 = $("#clave1").val();
        $clave2 = $("#clave2").val();
        if($clave1 == $clave2 && $clave1 != "" ){
            $("#boton-registrar-integrante").attr('type', 'submit');
            $("#resultado_nuevo_integrante").html('Las claves coinciden');
            $("#resultado_nuevo_integrante").attr("class", "dato_correcto_small");
        } else if ($clave1 == "" && $clave2 == ""){
            $("#resultado_nuevo_integrante").empty();
        } else {
            $("#boton-registrar-integrante").attr('type', 'hidden');
            $("#resultado_nuevo_integrante").html('Las claves NO coinciden');
            $("#resultado_nuevo_integrante").attr("class", "dato_incorrecto_small" );
        }
        setTimeout(function(){
            if($cambio == 1){
                verificar_clave();
            }
        },300);
    }
    
    $(function(){
        $("#clave2").keypress(function(){
            verificar_clave();
        });
    });
    
</script>

<form method="post" id="nuevo_integrante" >
        <br>
		<table align="center" width="400" >
			<tr>
				<td class="tabla2_encabezado" >
					Nombres:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="nombres" >
					<div id="div_nombres" ></div>
				</td>
			</tr>
			
			<tr>
				<td class="tabla2_encabezado" >
					Apellidos:
				</td>
				<td class="tabla2_informacion" >
					<input type="text" name="apellidos" >
					<div id="div_apellidos" ></div>
				</td>
			</tr>
			<tr>
			    <td class="tabla2_encabezado" >
			        Usuario
			    </td>
			    <td class="tabla2_informacion" >
                    <input type="text" name="usuario" >
					<div id="div_usuario" ></div>
			    </td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Ingrese su clave dos veces
				</td>
			</tr>
			<tr class="tabla2_informacion" >
			    <td colspan="2" >
					<input type="password" name="clave1" id="clave1" >
					<div id="div_clave1" ></div>
				</td>
			</tr>
			<tr class="tabla2_informacion" >
			    <td colspan="2" >
					<input type="password" name="clave2" id="clave2" >
					<div id="div_clave2" ></div>
				</td>
			</tr>
			<tr>
			    <td colspan="2" >
			        <div id="resultado_nuevo_integrante" >
			            <!-- Aca aparecera la respuesta HTML del ajax -->
			        </div>
			    </td>
			</tr>
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
				    <input type="hidden" name="boton-registrar-integrante" value="boton">
					<input type="hidden" id="boton-registrar-integrante" value="Registrar" >
				</td>
			</tr>
		</table>
</form>
<?php
}
?>