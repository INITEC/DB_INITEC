<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	</head>

	<?php
	if( !empty($_GET)) {	
        $id_persona = $_GET["dato"];
        $tabla_integrante = new integrantes();
        $tabla_integrante->establecer_integrante($id_persona);
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
            <tr>
                <td width="350" class="datos_extra" >
                <?php 
                    echo $tabla_integrante->ver_nombre_int();
                ?>
                </td>
                <td width="50" class="datos_extra" >
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
                ?>
                <br>
                <img src="../Imagenes/barra_<?php ?>.png" width="500" >
                <br>
                <br>
                Usted tiene <?php ?> falta(s) leve(s) y <?php?> falta(s) grave(s)	
                </td>
            </tr>
            <tr>
                <td width="550" class="datos_extra" colspan="3" align="center">
                <?php 
                ?>
                <br>
                <img src="../Imagenes/barra_<?php ?>.png" width="500" >
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