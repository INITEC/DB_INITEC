<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        
        $deudas = new deudas();
        $integrantes_aux = new integrantes();
        
?>

<script>
    $(function(){
        $("#boton-registrar-pago-integrante").click(function(){
            $url = "AD_pagos_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $("#formulario-registrar-pago-integrante").serialize(),
                success: function(data){
                    $("#respuesta-registro-pago-integrante").html(data);
                }
            });
            setTimeout(function(){
                cargar_cuadro_cobros_integrantes();
                cargar_tabla_pagos_integrantes();
            },3000);
            return false;
        });
    });
    
    
</script>


<form id="formulario-registrar-pago-integrante" method="POST" >
    <table align="center" width="750" >
        <tr>
            <td valign="top" width="200" class="tabla2_informacion" >
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

            <td valign="top" width="250" class="tabla2_informacion" >
                <select name="id_deuda" id="id_deuda" >
                    <?php			
                    $deudas->ver_deudas_acargo($id_persona,$id_temporada);
                    while($list_deudas = $deudas->retornar_SELECT()) {
                    ?>
                    <option value="<?php echo $list_deudas['id_deuda'];?>" ><?php echo $list_deudas["nombre_deuda"];?></option>
                    <?php 
                    }
                    ?>
                </select>
            </td>
            <td valign="top" width="200" class="tabla2_informacion" >
                <input type="text" name="pago_add" value="0" >
            </td>
            <td align="center" valign="top" width="100" class="tabla2_informacion">
                <input type="hidden" name="boton-registrar-pago-integrante" title="Pagar" value="Pagar" >
                <input type="button" id="boton-registrar-pago-integrante" title="Pagar" value="Pagar" >
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <div id="respuesta-registro-pago-integrante" >
                    
                </div>
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