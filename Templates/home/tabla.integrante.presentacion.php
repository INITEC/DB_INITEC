<?php
if($acceso == 1) {
?>
<!--  
    <head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
-->
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >	
		<link href="../Estilos/cuadro_inasistencias.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_POST)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/asistencias_class.php");
        require_once ("../require/temporadas_class.php");
        
        include_once("../Include/cuadro_amonestaciones_int_func.php");
        include_once("../Include/cuadro_inasistencias_int_func.php");
        
        if(isset($_POST['id_persona'])){
			$id_persona_tabla = $_POST["id_persona"];
		} else {
			$id_persona_tabla = $id_persona;
        }
        $tabla_integrante = new integrantes();
        $amonestaciones = new amonestaciones();
        $asistencias = new asistencias();
        $temporadas = new temporadas();
        
        $tabla_integrante->establecer_integrante($id_persona_tabla);
        ?>
     <table class="table table-bordered table-responsive text-center ">
            <tr class="active" >
                <td >
                Nombres
                </td>
                <td >
                Apellidos
                </td>
                <td rowspan="4" >
                <img src="<?php echo $tabla_integrante->foto_int(); ?>" width="200px" height="150">
                </td>
            </tr>
            <tr >
                <td class="text-uppercase" >
                <?php 
                    echo $tabla_integrante->ver_nombre_int();
                ?>
                </td>
                <td class="text-uppercase" >
                <?php
                    echo $tabla_integrante->ver_apellido_int();
                ?>
                </td>
            </tr>
            <tr class="active" >
                <td >
                Telefono
                </td>
                <td  >
                Correo
                </td>
            </tr>
            <tr >
                <td >
                <?php 
                    echo $tabla_integrante->ver_telefono_predeterminado_int();
                ?>
                </td>
                <td >
                <?php 
                    echo $tabla_integrante->ver_correo_predeterminado_int();
                ?>
                </td>
            </tr>
            <tr class="info" >
                <td colspan="3">
                    Estado de Amonestaciones				
                </td>
            </tr>
            <tr >
                <td colspan="3">
                <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona, $temporadas, $id_temporada,70,50,'home_aux.php');
                ?>
                </td>
            </tr>
            <tr class="info" >
                <td colspan="3">
                    Estado Inasistencias				
                </td>
            </tr>
            <tr >
                <td colspan="3">
                <?php
                    cuadro_inasistencias_int($asistencias, $id_persona, $temporadas, $id_temporada,70,50,'home_aux.php')
                ?>	
                </td>
            </tr>
        </table>
<?php
	}
}
?>