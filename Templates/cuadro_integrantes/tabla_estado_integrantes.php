<?php
if($acceso == 1) {
?>
    <head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >	
		<link href="../Estilos/cuadro_inasistencias.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_POST)) {
        require_once ("../require/asistencias_class.php");
        require_once ("../require/temporadas_class.php");
        require_once ("../require/amonestaciones_class.php");
        
        require_once ("../require/ajuste_primera_palabra_func.php");
        
        include_once("../Include/cuadro_amonestaciones_int_func.php");
        include_once("../Include/cuadro_inasistencias_int_func.php");
        
        $div_ancho = $_POST["div_ancho"];
        $tabla_integrante = new integrantes();
        $asistencias = new asistencias();
        $temporadas = new temporadas();
        $amonestaciones = new amonestaciones();
        
        $num_col = round($div_ancho/330);
        
        $nombre = "DAVID";
        $apellido = "FERNANDEZ VILLANUEVA";
        
        $num_integrantes = 7;
        
        $num_row = round($num_integrantes/$num_col);
        
        
        ?>
        <table align="center" width="100%" >
            <?php
            for ($i=0; $i<14; $i++){
            ?>
            <tr id="tabla2_encabezado" >
                <?php
                for ($j=0; $j<$num_col; $j++){
                ?>
                <td>
                    <img src="../foto_integrantes/JB.jpg" height="75px" height="60px" >
                </td>
                <td width="100" >
                    <?php
                    echo ajuste_primera_palabra($nombre);
                    echo "<br>";
                    echo ajuste_primera_palabra($apellido);
                    ?>
                </td>
                <td>
                    <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona, $temporadas, $id_temporada,20,15,'home_aux.php',0);
                ?>
                <?php
                    cuadro_inasistencias_int($asistencias, $id_persona, $temporadas, $id_temporada,20,15,'home_aux.php',0)
                ?>
                <?php
                    cuadro_inasistencias_int($asistencias, $id_persona, $temporadas, $id_temporada,20,15,'home_aux.php',0)
                ?>		
                </td>
                <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
        </table>
<?php
	}
}
?>