<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        require_once ("../require/grupos_class.php");
        require_once ("../require/fecha_text_func.php");
        
        $deudas = new deudas();
        $grupos = new grupos();
        $integrantes = new integrantes();
        $id_deuda = $_POST["id_deuda"];
        $datos_deuda = $deudas->ver_deuda($id_deuda);
        
        
?>
        <table align="center" width="400" >
			<tr >
				<td class="tabla2_encabezado" >
					Nombre de la deuda:
				</td>
			    <td class="tabla2_informacion" >
                    <?php echo $datos_deuda["nombre_deuda"]; ?>
				</td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Fecha creada:
				</td>
			</tr>
			<tr class="tabla2_informacion" >
                <td colspan="2" >
                    <?php echo fecha_text($datos_deuda["fecha_creada"]); ?>
                </td>
			</tr>
			<tr class="tabla2_encabezado" >
				<td colspan="2" >
					Ultimo dia de pago:
				</td>
			</tr>
			<tr class="tabla2_informacion" >
                <td colspan="2" >
                    <?php echo fecha_text($datos_deuda["fecha_final"]); ?>
                </td>
			</tr>
			<tr >
				<td class="tabla2_encabezado" >
					Cantidad de Pago(Soles):
				</td>
			    <td class="tabla2_informacion" >
					<?php echo $datos_deuda["monto_total"]; ?>
				</td>
			</tr>
			<tr id="tabla2_encabezado" >
				<td colspan="2" >
					Encargado de Cobrar:
				</td>
			</tr>
			<tr id="tabla2_informacion">
			    <td colspan="2" >
						<?php echo $integrantes->ver_nombre_completo($datos_deuda["id_cobrador"]); ?>
				</td>
			</tr>
			<tr id="tabla2_encabezado" >
				<td colspan="2" >
					Grupo:
				</td>
			</tr>
			<tr id="tabla2_informacion">
			    <td colspan="2" >
                        <?php echo $grupos->ver_nom_grupo($datos_deuda["id_grupo"]); ?>
                </td>
			</tr>
		</table>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>