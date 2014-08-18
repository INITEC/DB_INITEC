<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        
        $deudas = new deudas();
               
?>

<script type='text/javascript' languaje='javascript'>
	function tabla_editar_deuda (divid, id_deuda){
        $parametros = {
            'boton-editar-deuda' : true,
            'id_deuda' : id_deuda };
        $.ajax({
            url: 'prueba2.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $(divid).html(datos);
            }
        });
    }
    function tabla_datos_deuda (divid, id_deuda){
        $parametros = {
            'boton-ver-datos-deuda' : true,
            'id_deuda' : id_deuda };
        $.ajax({
            url: 'prueba2.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $(divid).html(datos);
            }
        });
    }
</script>

		<table align="center" width="650" >				
			<tr class="tabla2_encabezado" >
				<td align="center" valign="top" width="150" >
				Nombre de la Deuda
				</td>
				<td align="center" valign="top" width="150" >
				Fecha creada
				</td>
				<td align="center" valign="top" width="150" >
				Fecha limite
				</td>
				<td align="center" valign="top" width="150" >
				Cantidad
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
			</tr>
            <?php 
            $deudas->ver_deudas($id_temporada);
            while($dato_deuda = $deudas->retornar_SELECT()){
            ?>
			<tr class="tabla2_informacion" >
				<td >
					<?php echo $dato_deuda["nombre_deuda"]; ?>
				</td>
				<td >
					<?php echo $dato_deuda["fecha_creada"]; ?>
				</td>
				<td >
					<?php echo $dato_deuda["fecha_final"]; ?>
				</td>
				<td >
					<?php echo $dato_deuda["cantidad"]; ?>
				</td>
				<td >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="tabla_datos_reunion('#ver_mas_<?php echo $dato_deuda["id_deuda"]; ?>','<?php echo $dato_deuda["id_deuda"]; ?>' )">
				</td>
				<td >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="limpiar_elemento('ver_mas_<?php echo $dato_deuda["id_deuda"]; ?>');">
				</td>
				<td >
					<img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="tabla_editar_reunion('#ver_mas_<?php echo $dato_deuda["id_deuda"]; ?>','<?php echo $dato_deuda["id_deuda"]; ?>' )">
				</td>
			</tr>
			<tr>
				<td colspan="7" >
				<div id="ver_mas_<?php echo $dato_deuda["id_deuda"]; ?>" >
				    <!-- Aca aparecera la respuesta del ajax -->
				</div>	
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