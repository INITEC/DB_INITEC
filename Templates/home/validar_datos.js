function validar_datos(){
		var form=document.form;
		//Esta funcion no esta siendo utilizada
//******************************************************************************************
		if (form.integrante.value==0  || valida_cadena(form.integrante.value)==false ){
			document.getElementById("div_integrante").innerHTML="<font color='#ff0000'>El nombre del integrante no es  valido</font>";
			form.integrante.value="";
			form.integrante.focus();
			return false;
			}
		else {
			document.getElementById("div_integrante").innerHTML="";
			}
//******************************************************************************************
		if (form.usuario.value==0){
			document.getElementById("div_usuario").innerHTML="<font color='#ff0000'>Nombre de usuario no valido</font>";
			form.usuario.value="";
			form.usuario.focus();
			return false;
			}
		else {
			document.getElementById("div_abreviatura").innerHTML="";
			}
//******************************************************************************************
		if (form.cargo.value==0){
			document.getElementById("div_cargo").innerHTML="<font color='#ff0000'>El cargo no es valido</font>";
			form.cargo.value="";
			form.cargo.focus();
			return false;
			}
		else {
			document.getElementById("div_cargo").innerHTML="";
			}
//******************************************************************************************
		if (form.celular.value==0 || valida_numero(form.celular.value)==false){
			document.getElementById("div_celular").innerHTML="<font color='#ff0000'>Numero de celular no valido</font>";
			form.celular.value="";
			form.celular.focus();
			return false;
			}
		else {
			document.getElementById("div_celular").innerHTML="";
			}
//******************************************************************************************
		if (form.gmail.value==0 || valida_correo(form.gmail.value)==false){
			document.getElementById("div_gmail").innerHTML="<font color='#ff0000'>Direccion de correo no valido</font>";
			form.gmail.value="";
			form.gmail.focus();
			return false;
			}
		else {
			document.getElementById("div_gmail").innerHTML="";
			}
//******************************************************************************************
		if (form.e_mail.value==0 || valida_correo(form.e_mail.value)==false){
			document.getElementById("div_e_mail").innerHTML="<font color='#ff0000'>Direccion de correo no valido</font>";
			form.e_mail.value="";
			form.e_mail.focus();
			return false;
			}
		else {
			document.getElementById("div_e_mail").innerHTML="";
			}
//******************************************************************************************
		if (form.direccion.value==0){
			document.getElementById("div_direccion").innerHTML="<font color='#ff0000'>Direccion no valida</font>";
			form.direccion.value="";
			form.direccion.focus();
			return false;
			}
		else {
			document.getElementById("div_direccion").innerHTML="";
			}
//******************************************************************************************
		if (form.facultad.value==0){
			document.getElementById("div_facultad").innerHTML="<font color='#ff0000'>Facultad no valida</font>";
			form.facultad.value="";
			form.facultad.focus();
			return false;
			}
		else {
			document.getElementById("div_facultad").innerHTML="";
			}
//******************************************************************************************
		if (form.especialidad.value==0){
			document.getElementById("div_especialidad").innerHTML="<font color='#ff0000'>Especialidad no valida</font>";
			form.especialidad.value="";
			form.especialidad.focus();
			return false;
			}
		else {
			document.getElementById("div_especialidad").innerHTML="";
			}
//******************************************************************************************
			document.form.submit();
		}