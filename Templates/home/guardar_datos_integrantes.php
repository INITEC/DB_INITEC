<?php 
session_start();
if($acceso == 1) {

    $id_persona = $_SESSION["id_persona"];
    if( !empty($_POST)){
        require_once ("../require/integrantes_class.php");
        
        if(isset($_POST['id_persona'])){
			$id_persona_env = $_POST["id_persona"];
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
                $linkedin = $_POST["likedin"];
                $DNI = $_POST["DNI"];
                $direccion = $_POST["direccion"];
                $cod_universitario = $_POST["cod_universitario"];
                $usuario = $_POST["usuario"];
                
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
					$correos->hacer_predeterminado( $_POST["id_correo"]);
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
                
                $foto_tipo=$_FILES["foto"]["type"];
                
                if($foto_tipo != ""){
                    $foto_temp=$_FILES["foto"]["tmp_name"];
                    $integrantes_editar->guardar_foto_int($foto_tipo, $foto_temp);
                }
                
                
				
				if(
				$personal->ingresar_datos_primarios($id_persona_env ,$primer_nombre, $segundo_nombre, $ap_paterno, $ap_materno, $fecha_nac, $edad, $DNI, $sexo) and
				$personal->ingresar_datos_secundarios($id_persona_env, $num_hijos, $num_escolares, $id_est_civil, $id_grupo_sanguineo, $telefono, $celular, $e_mail) and
				$personal->ingresar_datos_vivienda($id_persona_env, $id_distrito, $id_provincia, $id_region, $direccion) and
				$personal->ingresar_datos_terciarios($id_persona_env, $id_adm_pension, $id_nivel_educ, $id_banco_sueldo, $cuenta_sueldo, $num_CUSPP, $id_categoria ) and
				$personal->ingresar_datos_ropa($id_persona_env, $talla_botas, $talla_pantalon, $talla_camisa) and
				$personal->ingresar_datos_emergencia($id_persona_env, $nom_emergencia, $telf_emergencia)
				){
				?>
				<div id="dato_correcto">
								SE GUARDARON LOS DATOS CORRECTAMENTE
				</div>
				<?php 
				} else {
				?>
				<div id="dato_incorrecto">
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