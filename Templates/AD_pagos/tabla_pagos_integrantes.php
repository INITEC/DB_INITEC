<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        require_once ("../require/pagos_class.php");
        
        $deudas = new deudas();
        $pagos = new pagos();
        $integrantes = new integrantes();
        $integrantes_aux = new integrantes();
        
?>
    <script type='text/javascript' languaje='javascript'>
	function generar_cuadro_pago_integrante (id_persona, id_deuda, id_respuesta){
        $parametros = {
            'boton-generar-cuadro-pago-integrante' : true,
            'id_persona' : id_persona,
            'id_deuda' : id_deuda
        };
        $.ajax({
            url: 'AD_pagos_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $(id_respuesta).html(datos);
            }
        });
    }
    </script>
    
    <table align="center" >
        
        <tr class="tabla2_encabezado" >
            <td>
                No
            </td>
            <td>
                Foto
            </td>
            <td>
                Integrante
            </td>
            <?php
            $deudas->ver_deudas($id_temporada,"ASC");
            while ($dato_deuda = $deudas->retornar_SELECT()){
            ?>
                <td class="rotate" >
                    <?php echo $dato_deuda["nombre_deuda"];?>
                </td>
            <?php
            }
            ?>
            <td class="rotate" height="100px" >
                Deuda Total
            </td>
        </tr>
        
        <?php
        $integrantes->ver_datos_integrantes();
        $cont_int = 0;
        $deuda_total = 0;
        while($dato_integrante = $integrantes->retornar_SELECT()) {
            $id_persona_dt = $dato_integrante["id_persona"];
            $cont_int++;
        ?>
            <tr class="tabla2_informacion" >
                <td>
                    <?php echo $cont_int;?>
                </td>
				<td >
				    <img src="<?php echo $integrantes_aux->ver_foto($id_persona_dt);?>" width="60" height="48" >
				</td>
				<td class="mayuscula" >
				    <?php echo $integrante->ver_nombre_corto($id_persona_dt);?>
				</td>
                    <?php
                    $deuda_integrante = 0;
                    $deudas->ver_deudas($id_temporada,"ASC");
                    while ($dato_deuda = $deudas->retornar_SELECT()){
                        $id_deuda = $dato_deuda["id_deuda"];
                        if( $pagos->verificar_pago_int($id_persona_dt,$id_deuda) != 0){
                            $dato_pago = $pagos->ver_pago_int ($id_persona_dt,$id_deuda);
                            $deuda_parcial_int = $dato_deuda["monto_total"] - $dato_pago["pago"];
                            $deuda_integrante = $deuda_integrante + $deuda_parcial_int;
                            ?>
                            <td class="<?php echo $pagos->ver_class_cond($dato_pago["id_cond_pago"]);?>" id="cd_<?php echo $id_persona_dt;?>_<?php echo $id_deuda;?>" ondblclick="generar_cuadro_pago_integrante('<?php echo $id_persona_dt;?>','<?php echo $id_deuda;?>','#cd_<?php echo $id_persona_dt;?>_<?php echo $id_deuda;?>');" >
                                <?php echo $dato_pago["pago"]."/".$dato_deuda["monto_total"];?>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                -
                            </td>
                        <?php
                        }
                        ?>
		<?php
                    }
        ?>
                <td >
				    <?php 
                        echo $deuda_integrante;
                        $deuda_total = $deuda_total + $deuda_integrante;
                    ?>
				</td>
            </tr>
        <?php    
        }
        ?>
    </table>

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>