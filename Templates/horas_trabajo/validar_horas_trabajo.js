var enviar_grupo = new EnvForm();

window.onload = function(){
	enviar_grupo.loadform('tabla_horas_trabajo', 'form_grupo', 'horas_trabajo_aux.php');
}


function eval_select (id_select) {
	evaluar = document.getElementById(id_select);
	
	if (evaluar.value != 'otro' ) {
		enviar_grupo.loadform('tabla_horas_trabajo', 'form_grupo', 'horas_trabajo_aux.php');
	}	
}

function enviar_int(div_resul, id_form, secs){
	enviar_grupo.loadform(div_resul,id_form , 'horas_trabajo_aux.php');
	setTimeout(function(){enviar_grupo.loadform('tabla_horas_trabajo', 'form_grupo', 'horas_trabajo_aux.php');},secs*1000);}