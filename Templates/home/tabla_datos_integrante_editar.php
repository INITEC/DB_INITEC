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
    <body>    
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
                    <select name="id_telefono" id="id_telefono" onchange="eval_select('id_telefono','otro_telefono');" >
				        <?php 
						if($telefonos->cant_telefonos($id_persona_tabla) == 0) {
						?>
						<option value="">Sin telefono</option>
						<?php
						} else { 												
                            $telefonos->ver_telefonos($id_persona_tabla);
                            while($op_telefonos = $telefonos->retornar_SELECT()) {
						?>
				        <option value="<?php echo $op_telefonos['id_telefono_per']; ?>" <?php if ($op_telefonos['predeterminado'] == 1 ){ echo "selected"; }?> ><?php echo $op_telefonos['telefono']?></option>
						<?php 
                            }
                        }
                        ?>
				        <option value="otro">Agregar</option>
				    </select>
                    <input type="hidden" name="otro_telefono" id="otro_telefono">
                </td>
                <td width="300" >
                    <select name="id_correo" id="id_correo" onchange="eval_select('id_correo','agregar_correo');" >
				        <?php 
						if($correos->cant_correos($id_persona_tabla) == 0) {
						?>
						<option value="">Sin correo</option>
						<?php
						} else { 												
                            $correos->ver_correos($id_persona_tabla);
                            while($op_correos = $correos->retornar_SELECT()) {
						?>
				        <option value="<?php echo $op_correos['id_correo_per']; ?>" <?php if ($op_correos['predeterminado'] == 1 ){ echo "selected"; }?> ><?php echo $op_correos['correo']?></option>
						<?php 
                            }
                        }
                        ?>
				        <option value="otro">Agregar</option>
				    </select>
                    <input type="hidden" name="agregar_correo" id="agregar_correo">
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
                    <input type="text" name="DNI" class="input_200" value="<?php echo $tabla_integrante->ver_DNI_int(); ?>" />
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
                    <select name="id_universidad" id="id_universidad" onchange="eval_select('id_universidad','otro_universidad')">
							<?php 
							$universidades->ver_universidades();
							while($op_universidades = $universidades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_universidades['id_universidad'];?>" 
								<?php if ($op_universidades['id_universidad'] == $tabla_integrante->_datos_integrante["id_universidad"]){echo "selected";}?> 
							><?php echo $op_universidades['nom_universidad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if ($tabla_integrante->_datos_integrante["id_universidad"]==""){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_universidad" id="otro_universidad">
                </td>
                <td width="100" >
                    <select name="id_especialidad" id="id_especialidad" onchange="eval_select('id_especialidad','otro_especialidad')">
							<?php 
							$especialidades->ver_especialidades();
							while($op_especiallidades = $especialidades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_especiallidades['id_especialidad'];?>" 
								<?php if ($op_especiallidades['id_especialidad'] == $tabla_integrante->_datos_integrante["id_especialidad"]){echo "selected";}?> 
							><?php echo $op_especiallidades['nom_especialidad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if ($tabla_integrante->_datos_integrante["id_especialidad"]==""){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_especialidad" id="otro_especialidad">
                </td>
                <td width="150" >
                    <select name="id_facultad" id="id_facultad" onchange="eval_select('id_facultad','otro_facultad')">
							<?php 
							$facultades->ver_facultades();
							while($op_facultades = $facultades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_facultades['id_facultad'];?>" 
								<?php if ($op_facultades['id_facultad'] == $tabla_integrante->_datos_integrante["id_facultad"]){echo "selected";}?> 
							><?php echo $op_facultades['nom_facultad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if ($tabla_integrante->_datos_integrante["id_facultad"]==""){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_facultad" id="otro_facultad">
                </td>
            </tr>
            <tr id="tabla2_encabezado" >
                <td width="400">
                Direccion
                </td>
                <td width="400">
                Codigo Universitario
                </td>
                <td width="150" >
                Usuario
                </td>
            </tr>
            <tr id="tabla2_informacion" >
                <td width="400" >
                    <input type="text" name="direccion" class="input_200" value="<?php echo $tabla_integrante->ver_direccion_int();?>" />
                </td>
                <td width="400">
                    <input type="text" name="cod_universitario" class="input_200" value="<?php echo $tabla_integrante->ver_cod_universitario_int();?>" />
                </td>
                <td width="150" >
                    <input type="text" name="usuario" class="input_200" value="<?php echo $tabla_integrante->ver_usuario_int();?>" />
                </td>
            </tr>
        </table>
        <br>
        <div id="mensaje_registro_integrante" >
            <!-- Aqui aparecera la respuesta del AJAX del formulario -->
        </div>
        <div id="subtitulo1">
			<input type="submit" value="GUARDAR CAMBIOS" name="guardar_datos_integrante" />
        </div>
        <br>
<?php
	}
}
?>