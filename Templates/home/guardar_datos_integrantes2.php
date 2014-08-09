<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {		
	if( !empty($_POST)){
		require_once ("../require/personal_class.php");

		$personal = new personal();
		$est_civil = new est_civil();
		$distrito = new distrito();
		$provincia = new provincia();
		$region = new region();
		$categoria = new categorias();
		$adm_pension = new adm_pension();
		$nivel_educ = new nivel_educ();
		$banco = new banco();
		$grupo_sanguineo = new grupo_sanguineo();
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
				
				/* Datos Primarios */
				$primer_nombre = $_POST["primer_nombre"];
				$segundo_nombre = $_POST["segundo_nombre"];
				$ap_paterno = $_POST["ap_paterno"];
				$ap_materno = $_POST["ap_materno"];
				$fecha_nac = $_POST["fecha_nac"];
				$edad = $_POST["edad"];
				$DNI = $_POST["DNI"];
				$sexo = $_POST["sexo"];
				
				/* Datos Secundarios */
				if(strcmp ( $_POST["id_est_civil"] , 'otro' ) == 0) {
					$id_est_civil = $est_civil->nuevo_estado_civil($_POST["otro_est_civil"]);
				} else {
					$id_est_civil = $_POST["id_est_civil"];
				}
				
				if(strcmp ( $_POST["id_grupo_sanguineo"] , 'otro' ) == 0) {
					$id_grupo_sanguineo = $grupo_sanguineo->nuevo_grupo($_POST["otro_grupo_sanguineo"]);
				} else {
					$id_grupo_sanguineo = $_POST["id_grupo_sanguineo"];
				}
				$num_hijos = $_POST["num_hijos"];
				$num_escolares = $_POST["num_escolares"];
				$telefono = $_POST["telefono"];
				$celular = $_POST["celular"];
				$e_mail = $_POST["e_mail"];
				
				/* Datos Vivienda */
				if(strcmp ( $_POST["id_distrito"] , 'otro' ) == 0) {
					$id_distrito = $distrito->nuevo_distrito($_POST["otro_distrito"]);
				} else {
					$id_distrito = $_POST["id_distrito"];
				}
				
				if(strcmp ( $_POST["id_provincia"] , 'otro' ) == 0) {
					$id_provincia = $provincia->nuevo_provincia($_POST["otro_provincia"]);
				} else {
					$id_provincia = $_POST["id_provincia"];
				}
				
				if(strcmp ( $_POST["id_region"] , 'otro' ) == 0) {
					$id_region = $region->nuevo_region($_POST["otro_region"]);
				} else {
					$id_region = $_POST["id_region"];
				}
				$direccion = $_POST["direccion"];
				
				/* Datos Terciarios */
				
				if(strcmp ( $_POST["id_adm_pension"] , 'otro' ) == 0) {
					$id_adm_pension = $adm_pension->nuevo_adm_pension($_POST["otro_adm_pension"]);
				} else {
					$id_adm_pension = $_POST["id_adm_pension"];
				}
				
				if(strcmp ( $_POST["id_nivel_educ"] , 'otro' ) == 0) {
					$id_nivel_educ = $nivel_educ->nuevo_nivel_educ($_POST["otro_nivel_educ"]);
				} else {
					$id_nivel_educ = $_POST["id_nivel_educ"];
				}
				
				if(strcmp ( $_POST["id_banco_sueldo"] , 'otro' ) == 0) {
					$id_banco_sueldo = $banco->nuevo_banco($_POST["otro_banco_sueldo"]);
				} else {
					$id_banco_sueldo = $_POST["id_banco_sueldo"];
				}
				
				if(strcmp ( $_POST["id_categoria"] , 'otro' ) == 0) {
					$id_categoria = $categoria->nuevo_categoria($_POST["otro_categoria"]);
				} else {
					$id_categoria = $_POST["id_categoria"];
				}
				$cuenta_sueldo = $_POST["cuenta_sueldo"];
				$num_CUSPP = $_POST["num_CUSPP"];
				
				/* Alergias */
				$alergias = $_POST["alergias"];
				
				$personal->ingresar_alergias($id_persona_env, $alergias);
				
				/* Datos Ropa */
				$talla_botas = $_POST["talla_botas"];
				$talla_pantalon = $_POST["talla_pantalon"];
				$talla_camisa = $_POST["talla_camisa"];
				
				
				/* Datos emergencia */
				$telf_emergencia = $_POST["telf_emergencia"];
				$nom_emergencia = $_POST["nom_emergencia"];
				
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
								LOS DATOS HAN SIDO ENVIADOS CORRECTAMENTE
				</div>
				<?php 
				} else {
				?>
				<div id="dato_incorrecto">
								LOS DATOS NO SE HAN PROCESADO CORRECTAMENTE
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
else {
		echo "No se puede acceder.";
		}
?>