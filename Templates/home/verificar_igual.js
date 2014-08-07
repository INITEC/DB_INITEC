function verificar_igual(id_form, div_msg){
		var form = document.getElementById(id_form);
        var div = document.getElementById(div_msg); 
		if (form.clave1.value==form.clave2.value && form.clave1.value!=0 && form.clave2.value!=0){
            div.innerHTML="las claves coinciden";
            div.className = 'dato_correcto_small';
			form.cambiar_clave_cambiar.type = 'submit';
			}
		else {
			div.innerHTML="Las claves nuevas no coinciden o estan vacias";
            div.className = 'dato_incorrecto_small';
			form.cambiar_clave_cambiar.type = 'hidden';
			}
        setTimeout(function(){verificar_igual(id_form,div_msg);},300);
	}