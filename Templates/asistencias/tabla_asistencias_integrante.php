<?php
if($acceso == 1) {
?>
    <head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/asistencias_class.php");
        require_once ("../require/reuniones_class.php");
        require_once ("../require/dias_trabajo_class.php");
        require_once ("../require/cond_asist_class.php");
        
        require_once ("../require/dia_text_func.php");
        
        
        $id_persona_env = $_GET["id_persona"];
        $tabla_integrante = new integrantes();
        $asistencias = new asistencias();
        $cond_asist = new cond_asist();
        $dias = new dias_trabajo();
        
        ?>
            <br> 
            <table align="center" width="800px" >
                <tr id="tabla2_encabezado" >
                    <td width="100" >
                        Dia
                    </td>
                    <td width="100" >
                        Fecha
                    </td>
                    <td width="100" >
                        Hora inicio
                    </td>
                    <td width="100" >
                        Hora asistencia
                    </td>
                    <td width="150" >
                        Asistencia
                    </td>
                    <td width="150" >
                        Condicion
                    </td>
                </tr>
        <?php 
        
        $asistencias->ver_asistencias_int($id_persona_env, $id_temporada);
        
        while ($dato_asistencia= $asistencias->retornar_SELECT()){
            $fecha = $dias->ver_fecha($dato_asistencia["id_dia_trabajo"]);
            $color = $cond_asist->ver_cod_color($dato_asistencia["id_cond_asist"]);
        ?>
                <tr bgcolor="<?php echo $color?>" >
                    <td align="center" valign="top" width="100" >
                        <?php echo dia_text($fecha); ?>
                    </td>
                    <td align="center" valign="top" width="50" >
                        <?php echo $fecha; ?>
                    </td>
                    <td align="center" valign="top" width="100" >
                        <?php echo $dato_asistencia["hora_inicio"]; ?>
                    </td>
                    <td align="center" valign="top" width="100" >
                        <?php echo $dato_asistencia["hora_asistencia"]; ?>
                    </td>
                    <td align="center" valign="top" width="150" >
                        <?php echo $cond_asist->ver_asistencia($dato_asistencia["id_cond_asist"]); ?>
                    </td>
                    <td align="center" valign="top" width="150" >
                        <?php echo $cond_asist->ver_nom_condicion($dato_asistencia["id_cond_asist"]); ?>
                    </td>
                </tr>
        <?php 
        }
        ?>
            </table>
<?php
	}
}
?>