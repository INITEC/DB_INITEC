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
        require_once ("../require/pagos_class.php");
        require_once ("../require/cond_pagos_class.php");
        
        require_once ("../require/ajuste_primera_palabra_func.php");
        
        include_once("../Include/cuadro_amonestaciones_int_func.php");
        include_once("../Include/cuadro_inasistencias_int_func.php");
        include_once("../Include/cuadro_pagos_int_func.php");
        
        $div_ancho = $_POST["div_ancho"];
        $tabla_integrante = new integrantes();
        $asistencias = new asistencias();
        $temporadas = new temporadas();
        $amonestaciones = new amonestaciones();
        $pagos = new pagos();
        $pagos_aux = new pagos();
        $integrantes_env = new integrantes();
        
        
        
        $num_integrantes = $tabla_integrante->num_datos_integrantes();
        $num_col = (int)($div_ancho/330);
        $num_row = (int)($num_integrantes/$num_col);
        $rest_row = $num_integrantes%$num_col;
        
        //echo " int:".$num_integrantes." col:".$num_col." row".$num_row." ancho:".$div_ancho;
        
        $tabla_integrante->ver_datos_integrantes();
        
        ?>
        <br>
        <table align="center" width="90%" >
            <?php
            for ($i=0; $i<$num_row; $i++){
            ?>
            <tr >
                <?php
                for ($j=0; $j<$num_col; $j++){
                    $datos_integrantes = $tabla_integrante->retornar_SELECT();
                    $id_persona_env = $datos_integrantes["id_persona"]; 
                    if(($i+$j)%2 == 0){ $class="item1";}
                    else {$class="item2";}
                    
                ?>
                <td class="<?php echo $class;?>" >
                    <img src="<?php echo $integrantes_env->ver_foto($id_persona_env);?>" width="70px" height="60px" >
                </td>
                <td width="100" class="<?php echo $class;?>" >
                    <div class="mayuscula" >
                    <?php
                    $nombre = $integrantes_env->ver_nombre($id_persona_env);
                    $apellido = $integrantes_env->ver_apellido($id_persona_env);
                    echo ajuste_primera_palabra($apellido,7,'.');
                    echo "<br>";
                    echo ajuste_primera_palabra($nombre,7,'.');
                    ?>
                    </div>
                </td>
                <td class="<?php echo $class;?>" >
                    <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona_env, $temporadas, $id_temporada,20,15,'home_aux.php',0);
                ?>
                <?php
                    cuadro_inasistencias_int($asistencias, $id_persona_env, $temporadas, $id_temporada,20,15,'home_aux.php',0);
                ?>
                <?php
                    cuadro_pagos_int($pagos, $id_persona_env, $pagos_aux, $id_temporada,20,15,'home_aux.php',0);
                ?>		
                </td>
                <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
            <tr >
            <?php
            for ($i=0 ; $i<$rest_row ; $i++){
                $datos_integrantes = $tabla_integrante->retornar_SELECT();
                $id_persona_env = $datos_integrantes["id_persona"];
                if(($num_row+$i)%2 == 0){ $class="item1";}
                    else {$class="item2";}
                
                ?>
                <td class="<?php echo $class;?>" >
                    <img src="<?php echo $integrantes_env->ver_foto($id_persona_env);?>" width="70px" height="60px" >
                </td>
                <td width="100" class="<?php echo $class;?>" >
                    <div class="mayuscula" >
                    <?php
                    $nombre = $integrantes_env->ver_nombre($id_persona_env);
                    $apellido = $integrantes_env->ver_apellido($id_persona_env);
                    echo ajuste_primera_palabra($apellido,7,'.');
                    echo "<br>";
                    echo ajuste_primera_palabra($nombre,7,'.');
                    ?>
                    </div>
                </td>
                <td class="<?php echo $class;?>" >
                    <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona_env, $temporadas, $id_temporada,20,15,'home_aux.php',0);
                ?>
                <?php
                    cuadro_inasistencias_int($asistencias, $id_persona_env, $temporadas, $id_temporada,20,15,'home_aux.php',0);
                ?>
                <?php
                    cuadro_pagos_int($pagos, $id_persona_env, $pagos_aux, $id_temporada,20,15,'home_aux.php',0);
                ?>		
                </td>
                
            <?php
            }
            ?>
            </tr>
        </table>
<?php
	}
}
?>