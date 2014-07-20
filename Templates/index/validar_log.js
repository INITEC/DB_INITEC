function validar_login(){
	  var form=document.form;
	 /* ***************************************************************************************** */
	  if (form.usuario.value == 0 ){
		 		document.getElementById("div_usuario").innerHTML="<font color='#ff0000'>Escriba un usuario</font>";
		 		form.usuario.value="";
				form.usuario.focus();
				return false;
				}
			else {
				document.getElementById("div_usuario").innerHTML="";
				}
	/* ***************************************************************************************** */
	  if (form.clave.value == 0 ){
		 		document.getElementById("div_clave").innerHTML="<font color='#ff0000'>Escriba su clave</font>";
		 		form.clave.value="";
				form.clave.focus();
				return false;
				}
			else {
				document.getElementById("div_clave").innerHTML="";
				}
			document.form.submit();
}