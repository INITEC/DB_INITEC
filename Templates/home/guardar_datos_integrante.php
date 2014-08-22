<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        if(isset($_POST['id_persona_editar'])){
			$id_persona_env = $_POST["id_persona_editar"];
		} else {
			$id_persona_env = $id_persona;
        }
        
        $integrantes_editar = new integrantes();
        $telefonos = new telefonos_personas();
        $correos = new correos_personas();
        $universidades = new universidades();
        $facultades = new facultades();
        $especialidades = new especialidades();
        $integrantes_editar->establecer_integrante($id_persona_env);
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $linkedin = $_POST["linkedin"];
                $DNI = $_POST["DNI"];
                $direccion = $_POST["direccion"];
                $cod_universitario = $_POST["cod_universitario"];
                $nom_usuario = $_POST["usuario"];
                
                /* para verificar si se ha ingresado algun otro valor */
                if(strcmp ( $_POST["id_telefono"] , 'otro' ) == 0) {
					$telefonos->nuevo($_POST["otro_telefono"], $id_persona_env);
				} else {
                    $id_telefono = $_POST["id_telefono"];
					$telefonos->hacer_predeterminado($id_telefono, $id_persona_env);
				}
                
                if(strcmp ( $_POST["id_correo"] , 'otro' ) == 0) {
					$correos->nuevo($_POST["otro_correo"],$id_persona_env);
				} else {
					$correos->hacer_predeterminado( $_POST["id_correo"], $id_persona_env);
				}
                
                /* ---------------------------------------------------- */
                
                if(strcmp ( $_POST["id_universidad"] , 'otro' ) == 0) {
					$id_universidad = $universidades->nuevo($_POST["otro_universidad"]);
				} else {
					$id_universidad = $_POST["id_universidad"];
				}
                
                if(strcmp ( $_POST["id_especialidad"] , 'otro' ) == 0) {
					$id_especialidad = $especialidades->nuevo($_POST["otro_especialidad"]);
				} else {
					$id_especialidad = $_POST["id_especialidad"];
				}
                
                if(strcmp ( $_POST["id_facultad"] , 'otro' ) == 0) {
					$id_facultad = $facultades->nuevo($_POST["otro_facultad"]);
				} else {
					$id_facultad = $_POST["id_facultad"];
				}
				
				if(
				$integrantes_editar->guardar_datos_primarios_int ($nombres ,$apellidos) and
				$integrantes_editar->guardar_datos_secundarios_int($linkedin, $DNI, $direccion ) and
				$integrantes_editar->guardar_datos_universitarios_int($id_universidad, $id_facultad, $id_especialidad, $cod_universitario) and
				$integrantes_editar->guardar_nom_usuario_int($nom_usuario)
				){
				?>
				<div class="dato_correcto" id="mensaje" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="dato_incorrecto" id="mensaje" >
								NO SE HA PODIDO GUARDAR LOS DATOS, INTENTE DE NUEVO
				</div>
				<?php 
				}
				?>
			</body>
		</html>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>