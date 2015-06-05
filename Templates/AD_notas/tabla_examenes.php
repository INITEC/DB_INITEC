<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/examenes_class.php");
        require_once ("../require/dia_text_func.php");
        
        $examenes = new examenes();
        $examenes_aux = new examenes();
        $id_temporada = $_SESSION["id_temporada"];
        
?>

<script type='text/javascript' languaje='javascript'>
	function tabla_editar_notas (divid){
        $(divid).submit();
    }
    
    function tabla_notas_examen (divid, id_examen){
        var div_ancho = $(divid).width();
        $parametros = {
            'boton-ver-notas-examen' : true,
            'id_examen' : id_examen, 
            'div_ancho' : div_ancho
        };
        $.ajax({
            url: 'AD_notas_aux.php',
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
				Nota Maxima
				</td>
				<td align="center" valign="top" width="150" >
				Nota Aprobatoria
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
			</tr>
<?php 
        $examenes->ver_examenes($id_temporada);
        while($datos_examen = $examenes->retornar_SELECT()){
?>
			<tr class="registros_tabla" >
				<td >
					<?php echo dia_text($datos_examen["fecha"]); ?>
				</td>
				<td >
					<?php echo $datos_examen["fecha"]; ?>
				</td>
				<td >
					<?php echo $datos_examen["n_maxima"]; ?>
				</td>
				<td >
					<?php echo $datos_examen["n_aprobatoria"]; ?>
				</td>
				<td >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="tabla_notas_examen('#ver_mas_<?php echo $datos_examen["id_examen"]; ?>','<?php echo $datos_examen["id_examen"]; ?>' )">
				</td>
				<td >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="limpiar_elemento('ver_mas_<?php echo $datos_examen["id_examen"]; ?>');">
				</td>
				<td >
				    <form action="AD_notas_aux.php" method="POST" id="editar_notas_<?php echo $datos_examen["id_examen"]; ?>" >
					    <img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="tabla_editar_notas('#editar_notas_<?php echo $datos_examen["id_examen"]; ?>' )">
					    <input type="hidden" name="boton-editar-notas" value="boton" >
					    <input type="hidden" name="id_examen" value="<?php echo $datos_examen["id_examen"]; ?>" >
					</form>
				</td>
			</tr>
			<tr>
				<td colspan="7" >
				<div id="ver_mas_<?php echo $datos_examen["id_examen"]; ?>" >
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