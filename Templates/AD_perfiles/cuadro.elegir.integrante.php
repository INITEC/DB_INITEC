<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/integrantes_class.php");
        
        $integrantes_aux = new integrantes();
        
?>

<script>
    function cargar_cuadro_editar_integrante (id_persona){
        $parametros = {
            'boton-ver-cuadro-editar-integrante' : true,
            'id_persona' : id_persona
        };
        $.ajax({
            url: 'AD_perfiles_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro_integrante").html(datos);
            }
        });
    }
    
    $(function(){
        $("#id_persona").change(function(){
            var id_persona = $("#id_persona").val();
            if(id_persona == ""){
                $("#cuadro_integrante").empty();
            } else {
                cargar_cuadro_editar_integrante(id_persona);
            }
        });
    });
</script>
<div>
    <table align="center" width="400" >		
        <tr id="tabla2_informacion">
            <td colspan="2" >
                <select name="id_persona" id="id_persona" class="mayuscula" >
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
    </table>
</div>
<div id="cuadro_integrante">
    
</div>

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>