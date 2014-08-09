<?php 
session_start();
if($acceso == 1) {

    $id_persona = $_SESSION["id_persona"];
    if( !empty($_POST)){
        require_once ("../require/integrantes_class.php");

?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                if(isset($_POST['id_persona'])){
					$id_persona_env = $_POST["id_persona"];
				} else {
					$id_persona_env = $id_persona;
				}
                
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $direccion = $_POST["direccion"];
                $DNI = $_POST["DNI"];
                $linkedin = $_POST["likedin"];
                $cod_universitario = $_POST["cod_universitario"];
                $usuario = $_POST["usuario"];
                
                
                
				
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
								LOS DATOS HAN GUARDADOS CORRECTAMENTE
				</div>
				<?php 
				} else {
				?>
				<div id="dato_incorrecto">
								NO SE HA PODIDO GUARDAR LOS DATOS
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