<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/grupos_class.php");
        $integrantes_aux = new integrantes();
        $grupo = new grupos();
?>
        
        <script>
            
            function enviar_datos_seleccionados_integrantes (){
                $url = "OBS_integrantes_aux.php";
                $.ajax({
                    type: "POST",
                    url: $url,
                    data: $("#formulario-seleccionar-datos").serialize(),
                    success: function(data){
                        $("#respuesta-datos-seleccionados-integrantes").html(data);
                    }
                });
            }
            
            $(function(){
                $("#boton-ver-datos-seleccionados-integrantes").click(function(){
                    enviar_datos_seleccionados_integrantes ();
                    return false;
                });
            });
            
            $(function(){
                $("#id_grupo").change(function(){
                    enviar_datos_seleccionados_integrantes ();
                });
            });
            
            $( document ).ready(function() {
                enviar_datos_seleccionados_integrantes ();
            });
            
            
        </script>
        <form id="formulario-seleccionar-datos" method="POST" >
        <table align="center" width="90%" >
            
            <tr class="subtitulo1_small" >
                <td>
                    <input type="checkbox" name="foto" value="true" checked onclick="enviar_datos_seleccionados_integrantes();" >Foto
                    <input type="checkbox" name="nombre" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Nombres
                    <input type="checkbox" name="apellido" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Apellidos
                    <input type="checkbox" name="nombres_corto" value="true" checked onclick="enviar_datos_seleccionados_integrantes();" >Nombres y Apellidos cortos
                    <input type="checkbox" name="nombres_completo" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Nombres y Apellidos completo
                    <input type="checkbox" name="telefono" value="true" checked onclick="enviar_datos_seleccionados_integrantes();" >Teléfono
                    <input type="checkbox" name="correo" value="true" checked onclick="enviar_datos_seleccionados_integrantes();" >Correo
                    <input type="checkbox" name="linkedin" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Linkedin
                    <input type="checkbox" name="DNI" value="true" onclick="enviar_datos_seleccionados_integrantes();" >DNI
                    <input type="checkbox" name="universidad" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Universidad
                    <input type="checkbox" name="facultad" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Facultad
                    <input type="checkbox" name="especialidad" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Especialidad
                    <input type="checkbox" name="cod_universitario" value="true" onclick="enviar_datos_seleccionados_integrantes();" >Codigo_Universitario
                </td>
            </tr>
            <tr class="subtitulo1_small" >
                <td>
                    GRUPO:
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
                        <option value="<?php echo $op_grupo['id_grupo'];?>"><?php echo $op_grupo['nom_grupo']; ?></option>
                        <?php 
                                }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr class="subtitulo1_small" >
                <td>
                    <input type="hidden" name="boton-ver-datos-seleccionados-integrantes" value="boton" >
                    <input type="submit" id="boton-ver-datos-seleccionados-integrantes" value="VER" >
                </td>
            </tr>
            
        </table>
        </form>
        <div id="respuesta-datos-seleccionados-integrantes" >
            <!-- Aca se recibira la respuesta del ajax -->
        </div>
        

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>