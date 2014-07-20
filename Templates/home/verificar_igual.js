function verificar_igual(){
		var form=document.form;
		if (form.clave1.value==form.clave2.value && form.clave1.value!=0 && form.clave2.value!=0){
			document.form.submit();
			}
		else {
			document.getElementById("div_clave").innerHTML="<font color='#ff0000'>Las claves nuevas no coinciden o estan vacias</font>";
			form.clave1.value="";
			form.clave2.value="";
			form.clave1.focus();
			return false;
			}
	}