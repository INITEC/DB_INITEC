<?php
if($acceso == 1) {
?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
        <script type="text/javascript" languaje="javascript" src="home/home_editar.js"></script>
<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/from_2_ajax.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/eval_select.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_1_ajax.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_dato_ajax.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/limpiar_elemento.js"></script>
<script type="text/javascript" languaje="javascript" src="../JavaScript/enviar_form_ajax.js"></script>
<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
        
	</head>

	<?php
	if( !empty($_POST)) {

        if(isset($_POST['id_persona'])){
			$id_persona_tabla = $_POST["id_persona"];
		} else {
			$id_persona_tabla = $id_persona;
        }
        $tabla_integrante = new integrantes();
        $telefonos = new telefonos_personas();
        $correos = new correos_personas();
        $universidades = new universidades();
        $facultades = new facultades();
        $especialidades = new especialidades();
        
        
        $tabla_integrante->establecer_integrante($id_persona_tabla);
        ?>
    <body>
    
    <script>
        $(function(){
            $("#boton-guardar-datos-integrante").click(function(){
                var Datos = new FormData(document.forms.namedItem("formulario-datos-integrante")); 
                $url = "home_aux.php";
                $.ajax({
                    type: "POST",
                    url: $url,
                    data: Datos,
                    contentType: false,   // tell jQuery not to set contentType
                    processData: false,  // tell jQuery not to process the data
                    success: function(data){
                        $("#mensaje_registro_integrante").html(data);
                    }
                });
                setTimeout(function(){cargar_cuadro_editar_integrante();},5000);
                return false;
            });
        });
    </script>    
    <form name="formulario-datos-integrante" method="POST" enctype="multipart/form-data" >
    <table class="table table-bordered table-responsive col-md-12 text-center ">
            <tr class="active" >
                <td >
                Nombres
                </td>
                <td >
                Apellidos
                </td>
                <td rowspan="4" >
                <img src="<?php echo $tabla_integrante->foto_int(); ?>" width="200px" height="150">
                <input type="file" name="foto_perfil" >
                </td>
            </tr>
            <tr >
                <td >
                    <input type="text" name="nombres" value="<?php echo $tabla_integrante->ver_nombre_int();?>" />
                </td>
                <td >
                    <input type="text" name="apellidos" value="<?php echo $tabla_integrante->ver_apellido_int();?>" />
                </td>
            </tr>
            <tr class="active" >
                <td >
                Teléfono
                </td>
                <td >
                Correo
                </td>
            </tr>
            <tr >
                <td >
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
                <td >
                    <select name="id_correo" id="id_correo" onchange="eval_select('id_correo','otro_correo');" >
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
                    <input type="hidden" name="otro_correo" id="otro_correo">
                </td>
            </tr>
            <tr class="active" >
                <td colspan="2">
                Linkedin
                </td>
                <td >
                DNI
                </td>
            </tr>
            <tr >
                <td colspan="2" >
                    <input type="text" name="linkedin" value="<?php echo $tabla_integrante->ver_linkedin_int();?>" />
                </td>
                <td >
                    <input type="text" name="DNI" value="<?php echo $tabla_integrante->ver_DNI_int(); ?>" />
                </td>
            </tr>
            <tr class="active" >
                <td >
                Universidad
                </td>
                <td colspan="2" >
                Especialidad
                </td>
            </tr>
            <tr >
                <td >
                    <select name="id_universidad" id="id_universidad" onchange="eval_select('id_universidad','otro_universidad')">
							<?php 
							$universidades->ver_universidades();
							while($op_universidades = $universidades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_universidades['id_universidad'];?>" 
								<?php if ($op_universidades['id_universidad'] == $tabla_integrante->_datos_integrante["id_universidad"]){echo "selected";}?> 
							><?php echo $op_universidades['nom_universidad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if (empty($tabla_integrante->_datos_integrante["id_universidad"])){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_universidad" id="otro_universidad">
                </td>
                <td colspan="2">
                    <select name="id_especialidad" id="id_especialidad" onchange="eval_select('id_especialidad','otro_especialidad')">
							<?php 
							$especialidades->ver_especialidades();
							while($op_especiallidades = $especialidades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_especiallidades['id_especialidad'];?>" 
								<?php if ($op_especiallidades['id_especialidad'] == $tabla_integrante->_datos_integrante["id_especialidad"]){echo "selected";}?> 
							><?php echo $op_especiallidades['nom_especialidad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if (empty($tabla_integrante->_datos_integrante["id_especialidad"])){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_especialidad" id="otro_especialidad">
                </td>
            </tr>
            <tr class="active">
                <td colspan="3" >
                Facultad
                </td>
            </tr>
            <tr>
                <td colspan="3" >
                    <select name="id_facultad" id="id_facultad" onchange="eval_select('id_facultad','otro_facultad')">
							<?php 
							$facultades->ver_facultades();
							while($op_facultades = $facultades->retornar_SELECT() ) { ?>
							<option value="<?php echo $op_facultades['id_facultad'];?>" 
								<?php if ($op_facultades['id_facultad'] == $tabla_integrante->_datos_integrante["id_facultad"]){echo "selected";}?> 
							><?php echo $op_facultades['nom_facultad'];?></option>
							<?php }?>
							<option value="otro">Otro</option>
							<option value="" <?php if (empty($tabla_integrante->_datos_integrante["id_facultad"])){echo "selected";}?> >No especificado</option>
				    </select>
					<input type="hidden" name="otro_facultad" id="otro_facultad">
                </td>
            </tr>
            <tr class="active" >
                <td >
                Direccion
                </td>
                <td >
                Codigo Universitario
                </td>
                <td >
                Usuario
                </td>
            </tr>
            <tr >
                <td >
                    <input type="text" name="direccion" value="<?php echo $tabla_integrante->ver_direccion_int();?>" />
                </td>
                <td >
                    <input type="text" name="cod_universitario" value="<?php echo $tabla_integrante->ver_cod_universitario_int();?>" />
                </td>
                <td >
                    <input type="text" name="usuario" value="<?php echo $tabla_integrante->ver_usuario_int();?>" />
                </td>
            </tr>
        </table>
        <br>
        <div id="mensaje_registro_integrante" >
            <!-- Aqui aparecera la respuesta del AJAX del formulario -->
        </div>
        <div>
            <input type="hidden" name="boton-guardar-datos-integrante" value="boton" >
			<input type="submit" id="boton-guardar-datos-integrante" class="btn btn-success" value="GUARDAR CAMBIOS" />
        </div>
        </form>
<?php
	}
}
?>