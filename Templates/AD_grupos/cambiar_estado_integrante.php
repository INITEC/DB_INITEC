<?php
if($acceso == 1) {
	
	if( !empty($_GET)) {	
		if(isset($_GET['Quitar_integrante'])) {
			$id_grupo_env = $_GET["id_grupo_env"];
			$id_integrante_env = $_GET["id_integrante_env"];
			if($integrante->verificar_activo($id_integrante_env) != 0) {
				if($grupo->retirar_integrante($id_integrante_env, $id_grupo_env)){
					?>
					<div id="dato_correcto">
						EL INTEGRANTE A SIDO QUITADO
					</div>
					<?php
				}else {
					?>
					<div id="dato_incorrecto">
						NO SE HA PODIDO QUITAR AL INTEGRANTE
					</div>
					<?php
				}
			}
		}elseif(isset($_GET['Agregar_integrante'])) {
			$id_grupo_env = $_GET["id_grupo_env"];
			$id_integrante_env = $_GET["id_integrante_env"];
			if($integrante->verificar_activo($id_integrante_env) != 0) {
				if($grupo->verificar_registrar($id_integrante_env, $id_grupo_env)){
					?>
					<div id="dato_correcto">
						EL INTEGRANTE A SIDO AGREGADO
					</div>
					<?php
				}else {
					?>
					<div id="dato_incorrecto">
						NO SE HA PODIDO AGREGAR AL INTEGRANTE
					</div>
					<?php
				}
			}
		}
	}
}
?>