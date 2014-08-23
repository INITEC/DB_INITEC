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
     <table width="700px" align="center">
            <tr id="tabla2_encabezado" >
                <td width="350">
                Nombres
                </td>
                <td width="50">
                Apellidos
                </td>
                <td width="200" rowspan="4" >
                <img src="<?php echo $tabla_integrante->foto_int(); ?>" width="200px" height="150">
                </td>
            </tr>
            <tr class="tabla2_informacion" >
                <td class="mayuscula" >
                <?php 
                    echo $tabla_integrante->ver_nombre_int();
                ?>
                </td>
                <td class="mayuscula" >
                <?php
                    echo $tabla_integrante->ver_apellido_int();
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="100" >
                Telefono
                </td>
                <td width="300" >
                Correo
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="100" >
                <?php 
                    echo $tabla_integrante->ver_telefono_predeterminado_int();
                ?>
                </td>
                <td width="300" >
                <?php 
                    echo $tabla_integrante->ver_correo_predeterminado_int();
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="400" colspan="2">
                Linkedin
                </td>
                <td width="150" >
                DNI
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="400" colspan="2">
                <a class="enlaces" target="_blank" href="https://<?php echo $tabla_integrante->ver_linkedin_int(); ?>">
                <?php
                    echo $tabla_integrante->ver_linkedin_int();
                ?>  
                </a>
                </td>
                <td width="150" >
                <?php
                    echo $tabla_integrante->ver_DNI_int();
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="300" >
                Universidad
                </td>
                <td width="100" >
                Especialidad
                </td>
                <td width="150" >
                Facultad
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="300" >
                <?php 
                    echo $tabla_integrante->ver_universidad_int();
                ?>
                </td>
                <td width="100" >
                <?php 
                    echo $tabla_integrante->ver_especialidad_int();
                ?>
                </td>
                <td width="150" >
                <?php 
                    echo $tabla_integrante->ver_facultad_int();
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="550" colspan="3">
                    Estado de Amonestaciones				
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="550" colspan="3" align="center">
                <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona, $temporadas, $id_temporada,70,50,'home_aux.php');
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="550" colspan="3">
                    Estado Inasistencias				
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="550" colspan="3" align="center">
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