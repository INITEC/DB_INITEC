var enviar_grupo = new EnvForm();
var adm_integrante = new EnvForm();

window.onload = function(){
	enviar_grupo.loadform('tabla_integrantes_grupo', 'form_grupo', 'AD_grupos_aux.php');
}

function eval_select (id_select, id_input, id_button) {
	evaluar = document.getElementById(id_select);
	cambio  = document.getElementById(id_input);
	boton   = document.getElementById(id_button)
	if (evaluar.value == 'otro') {cambio.type = 'text';
											boton.type  = 'submit';
											document.getElementById('tabla_integrantes_grupo').innerHTML=""; }
	else {cambio.type = 'hidden';
			boton.type  = 'hidden';}
	if (evaluar.value != 'otro' ) {
		enviar_grupo.loadform('tabla_integrantes_grupo', 'form_grupo', 'AD_grupos_aux.php');
	}	
}

function enviar_int(div_resul, id_form, secs){
	enviar_grupo.loadform(div_resul,id_form , 'AD_grupos_aux.php');
	setTimeout(function(){enviar_grupo.loadform('tabla_integrantes_grupo', 'form_grupo', 'AD_grupos_aux.php');},secs*1000);}
