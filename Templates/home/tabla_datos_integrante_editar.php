<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
		<link href="../Estilos/cuadro_amonestaciones.css" type="text/css" rel="stylesheet" >	
		<link href="../Estilos/cuadro_inasistencias.css" type="text/css" rel="stylesheet" >	
	</head>

	<?php
	if( !empty($_GET)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/asistencias_class.php");
        require_once ("../require/temporadas_class.php");
        require_once ("../require/telefonos_personas_class.php");
        require_once ("../require/correos_personas_class.php");
        require_once ("../require/universidades_class.php");
        require_once ("../require/facultades_class.php");
        require_once ("../require/especialidades_class.php");
        
        
        include_once("../Include/cuadro_amonestaciones_int_func.php");
        include_once("../Include/cuadro_inasistencias_int_func.php");
        
        $id_persona_tabla = $_GET["id_persona_editar"];
        $tabla_integrante = new integrantes();
        $amonestaciones = new amonestaciones();
        $asistencias = new asistencias();
        $temporadas = new temporadas();
        $telefonos = new telefonos_personas();
        $correos = new correos_personas();
        $universidades = new universidades();
        $facultades = new facultades();
        $especialidades = new especialidades();
        
        
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
                <input type="file" name="foto" >
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td >
                    <input type="text" name="nombres" class="input_200" value="<?php echo $tabla_integrante->ver_nombre_int();?>" />
                </td>
                <td >
                    <input type="text" name="apellidos" class="input_200" value="<?php echo $tabla_integrante->ver_apellido_int();?>" />
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
                    <select name="id_telefono" id="id_telefono" >
				        <?php 
						if($telefonos->cant_telefonos($id_persona_tabla) == 0) {
						?>
						<option value="">Sin telefono</option>
						<?php
						} else { 												
                            $telefonos->ver_telefonos($id_persona_tabla);
                            while($op_telefonos = $telefonos->retornar_SELECT()) {
						?>
				        <option value="<?php echo $op_telefonos['id_telefono_per']; ?>"><?php echo $op_telefonos['telefono']?></option>
						<?php 
                            }
                        }
                        ?>
				        <option value="otro">Otro</option>
				    </select>
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
                    <input type="text" name="linkedin" class="input_500" value="<?php echo $tabla_integrante->ver_linkedin_int();?>" />
                </td>
                <td width="150" >
                    <input type="text" name="linkedin" class="input_200" value="<?php echo $tabla_integrante->ver_DNI_int(); ?>" />
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
                    echo $tabla_integrante->ver_facultad_int();
                ?>
                </td>
                <td width="150" >
                <?php 
                    echo $tabla_integrante->ver_especialidad_int();
                ?>
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="400" colspan="2">
                Direccion
                </td>
                <td width="150" >
                Usuario
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="400" colspan="2">
                    <input type="text" name="linkedin" class="input_500" value="<?php echo $tabla_integrante->ver_direccion_int();?>" />
                </td>
                <td width="150" >
                    <input type="text" name="linkedin" class="input_200" value="<?php echo $tabla_integrante->ver_usuario_int();?>" />
                </td>
            </tr>
        </table>
        <br>
<?php
	}
}
?>