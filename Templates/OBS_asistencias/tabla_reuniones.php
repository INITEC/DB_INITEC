<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/reuniones_class.php");
        require_once ("../require/dia_text_func.php");
        
        $reuniones = new reuniones();
        $reuniones_aux = new reuniones();
        $id_temporada = $_SESSION["id_temporada"];
        
?>

<script type='text/javascript' languaje='javascript'>
    
    function tabla_datos_asistencia (divid, id_reunion){
        $div_ancho = $(divid).width();
        $parametros = {
            'boton-ver-datos-asistencia' : true,
            'id_reunion' : id_reunion, 
            'div_ancho' : $div_ancho
        };
        $.ajax({
            url: 'OBS_asistencias_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $(divid).html(datos);
            }
        });
    }
</script>

		<table align="center" width="90%" id="tabla_reuniones" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Dia
				</td>
				<td align="center" valign="top" width="150" >
				Fecha
				</td>
				<td align="center" valign="top" width="150" >
				Hora inicio
				</td>
				<td align="center" valign="top" width="150" >
				Hora final
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
			</tr>
<?php 
        $reuniones->ver_reuniones($id_temporada);
        while($datos_reunion = $reuniones->retornar_SELECT()){
?>
			<tr class="registros_tabla" >
				<td >
					<?php echo dia_text($reuniones_aux->ver_fecha_reunion($datos_reunion["id_reunion"])); ?>
				</td>
				<td >
					<?php echo $reuniones_aux->ver_fecha_reunion($datos_reunion["id_reunion"]); ?>
				</td>
				<td >
					<?php echo $datos_reunion["hora_inicio"]; ?>
				</td>
				<td >
					<?php echo $datos_reunion["hora_final"]; ?>
				</td>
				<td >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="tabla_datos_asistencia('#ver_mas_<?php echo $datos_reunion["id_reunion"]; ?>','<?php echo $datos_reunion["id_reunion"]; ?>' )">
				</td>
				<td >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="limpiar_elemento('ver_mas_<?php echo $datos_reunion["id_reunion"]; ?>');">
				</td>
			</tr>
			<tr>
				<td colspan="6" >
				<div id="ver_mas_<?php echo $datos_reunion["id_reunion"]; ?>" >
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