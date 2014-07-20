<?php
if($acceso == 1) {
	
	if( !empty($_GET)) {	
		if(isset($_GET['Validar_horas_trabajo'])) {
			$id_grupo_env = $_GET["id_grupo_env"];
			$id_integrante_env = $_GET["id_integrante_env"];
			$id_horas_trab = $_GET['id_horas_trab'];
			if($integrante->verificar_activo($id_integrante_env) != 0) {
				if($horas_trabajo->validar_horas_trabajo ($id_horas_trab, $id_temporada)){
					?>
					<div id="dato_correcto">
						LAS HORAS HAN SIDO VALIDADAS
					</div>
					<?php
				}else {
					?>
					<div id="dato_incorrecto">
						NO SE HA PODIDO VALIDAR LAS HORAS
					</div>
					<?php
				}
			}
		}
	}
}
?>