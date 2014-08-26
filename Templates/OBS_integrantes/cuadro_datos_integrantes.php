<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/grupos_class.php");
        $integrantes_aux = new integrantes();
        $grupo = new grupos();
?>
        
        <script>
            $(function(){
                $("#boton-ver-datos-seleccionados-integrantes").click(function(){
                    $url = "OBS_integrantes_aux.php";
                    $.ajax({
                        type: "POST",
                        url: $url,
                        data: $("#formulario-seleccionar-datos").serialize(),
                        success: function(data){
                            $("#respuesta-datos-seleccionados-integrantes").html(data);
                        }
                    });
                    return false;
                });
            });
        </script>
        <form id="formulario-seleccionar-datos" method="POST" >
        <table align="center" width="90%" >
            
            <tr class="subtitulo1_small" >
                <td>
                    <input type="checkbox" name="foto" value="true" checked >Foto
                    <input type="checkbox" name="nombre" value="true" >Nombres
                    <input type="checkbox" name="apellido" value="true" >Apellidos
                    <input type="checkbox" name="nombres_corto" value="true" checked >Nombres y Apellidos cortos
                    <input type="checkbox" name="nombres_completo" value="true" >Nombres y Apellidos completo
                    <input type="checkbox" name="telefono" value="true" checked >Teléfono
                    <input type="checkbox" name="correo" value="true" checked >Correo
                    <input type="checkbox" name="linkedin" value="true">Linkedin
                    <input type="checkbox" name="DNI" value="true" >DNI
                    <input type="checkbox" name="universidad" value="true">Universidad
                    <input type="checkbox" name="facultad" value="true" >Facultad
                    <input type="checkbox" name="especialidad" value="true" >Especialidad
                    <input type="checkbox" name="cod_universitario" value="true" >Codigo_Universitario
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