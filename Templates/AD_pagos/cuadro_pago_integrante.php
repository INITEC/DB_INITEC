<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        require_once ("../require/pagos_class.php");
        
        $deudas = new deudas();
        $pagos = new pagos();
        $integrantes = new integrantes();
        $integrantes_aux = new integrantes();
        $id_persona_env = $_POST["id_persona"];
        $id_deuda_env = $_POST["id_deuda"];
        
        
?>
    <script type='text/javascript' languaje='javascript'>
	
    $(function(){
        $("#div_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>").mouseleave(function(){
            cargar_tabla_pagos_integrantes();
        });
    });    
    
    $(function(){
        $("#boton-registrar-pago-integrante_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>").click(function(){
            $url = "AD_pagos_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $("#formulario_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>").serialize(),
                success: function(data){
                    $("#resultado_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>").html(data);
                }
            });
            setTimeout(function(){cargar_tabla_pagos_integrantes();},3000);
            return false;
        });
    });
    
    </script>
    
    <div id="div_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>" >
        <?php
        if ($deudas->verificar_cobrador($id_persona,$id_deuda_env) != 0 ){
        ?>
        <form id="formulario_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>" >
            <table class="tabla2_encabezado" >
                <tr >
                    <td>
                        <input type="text" name="pago_add" size="5" value="0">
                        <input type="hidden" name="id_persona" value="<?php echo $id_persona_env;?>" >
                        <input type="hidden" name="id_deuda" value="<?php echo $id_deuda_env;?>" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="boton-registrar-pago-integrante" value="boton" >
                        <input type="button" id="boton-registrar-pago-integrante_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>" value="+" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="resultado_<?php echo $id_persona_env?>_<?php echo $id_deuda_env?>" >
                            
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        } else {
        ?>
        <div class="dato_incorrecto" >
            NEGADO
        </div>
        <?php
        }
        ?>
    </div>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>