var ver_horas_trabajo = new EnvForm();

window.onload = function(){
	ver_horas_trabajo.loadform('lista_horas_integrante', 'vacio', 'horas_trabajo_aux.php');
}

function enviar_int(div_resul, id_form, secs){
	ver_horas_trabajo.loadform(div_resul,id_form , 'AD_grupos_aux.php');
	setTimeout(function(){ver_horas_trabajo.loadform('tabla_integrantes_grupo', 'form_grupo', 'AD_grupos_aux.php');},secs*1000);}