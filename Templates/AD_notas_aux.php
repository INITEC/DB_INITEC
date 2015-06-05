<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
$id_temporada = $_SESSION["id_temporada"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "AD_NOTAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {

		if( !empty($_POST)) {
			$acceso = 1;
			if (isset($_POST['cambiar_clave'])){	
				include_once ("home/home_cambiar_clave.php");
			}elseif(isset($_POST['boton-editar-notas'])) {
				include_once ("AD_notas/AD_notas_marcar.php");
			}elseif(isset($_POST['boton-ver-examenes'])) {
				include_once ("AD_notas/tabla_examenes.php");
			}elseif(isset($_POST['boton-ver-cuadro-marcar-notas'])){
                include_once ("AD_notas/tabla_marcar_notas.php");
            }elseif(isset($_POST["boton-enviar-nota"])){
                include_once ("AD_notas/guardar_datos_nota.php");
            }elseif(isset($_POST["boton-cambiar-nota"])){
                include_once ("AD_notas/cambiar_datos_nota.php");
            }elseif(isset($_POST["boton-guardar-datos-integrante"])){
                include_once ("home/guardar_datos_integrante.php");
            } else {
                echo "Algo salio mal";
            } 
		}elseif(!empty($_GET)) {
			$acceso = 1;
			if (isset($_GET['estado'])) {
				include_once ("AD_grupos/cambiar_estado_grupo.php");
			} else {
                echo "Algo salio mal";
            }
		}
		else {
			include_once ("../Include/no_dato_POST.php");
		}		
			
	}
	else {
			include_once ("../Include/no_tarea.php");
			}	
}
else {
		include_once ("../Include/no_acceso.php");
		}
?>