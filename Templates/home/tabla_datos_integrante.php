<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/temporadas_class.php");
        
        include_once("../Include/cuadro_amonestaciones_int_func.php");
        
        $id_persona_tabla = $_GET["id_persona"];
        $tabla_integrante = new integrantes();
        $amonestaciones = new amonestaciones();
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
                <img src="<?php echo $tabla_integrante->foto(); ?>" width="200px" height="150">
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td >
                <?php 
                    echo $tabla_integrante->ver_nombre_int();
                ?>
                </td>
                <td >
                <?php
                    echo $tabla_integrante->ver_apellido_int();
                ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="informacion_extra" >
                Telefono
                </td>
                <td width="300" class="informacion_extra" >
                Correo
                </td>
            </tr>
            <tr>
                <td width="100" class="datos_extra" >
                <?php 
                    echo $tabla_integrante->ver_telefono_predeterminado_int();
                ?>
                </td>
                <td width="300" class="datos_extra" >
                <?php 
                    echo $tabla_integrante->ver_correo_predeterminado_int();
                ?>
                </td>
            </tr>
            <tr>
                <td width="400" class="informacion_extra" colspan="2">
                Linkedin
                </td>
                <td width="150" class="informacion_extra" >
                DNI
                </td>
            </tr>
            <tr>
                <td width="400" class="datos_extra" colspan="2">
                <a class="enlaces" target="_blank" href="https://<?php echo $tabla_integrante->ver_linkedin_int(); ?>">
                <?php
                    echo $tabla_integrante->ver_linkedin_int();
                ?>
                </a>
                </td>
                <td width="150" class="datos_extra" >
                <?php
                    echo $tabla_integrante->ver_DNI_int();
                ?>
                </td>
            </tr>
            <tr>
                <td width="300" class="informacion_extra" >
                Universidad
                </td>
                <td width="100" class="informacion_extra" >
                Especialidad
                </td>
                <td width="150" class="informacion_extra" >
                Facultad
                </td>
            </tr>
            <tr>
                <td width="300" class="datos_extra">
                <?php 
                    echo $tabla_integrante->ver_universidad_int();
                ?>
                </td>
                <td width="100" class="datos_extra" >
                <?php 
                    echo $tabla_integrante->ver_facultad_int();
                ?>
                </td>
                <td width="150" class="datos_extra" >
                <?php 
                    echo $tabla_integrante->ver_especialidad_int();
                ?>
                </td>
            </tr>
            <tr>
                <td width="550" class="informacion_extra" colspan="3">
                    Estado de Amonestaciones				
                </td>
            </tr>
            <tr>
                <td width="550" class="datos_extra" colspan="3" align="center">
                <?php
                    cuadro_amonestaciones_int($amonestaciones, $id_persona, $temporadas, $id_temporada,70,50,'home_aux.php');
                ?>
                </td>
            </tr>
            <tr>
                <td width="550" class="datos_extra" colspan="3" align="center">
                <?php 
                ?>
                <br>
                
                <br>
                <br>
                Usted tiene <?php ?> inasistencia(s)	
                </td>
            </tr>
        </table>
<?php
	}
}
?>