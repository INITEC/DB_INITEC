<html>
<head>
<title>..::Agregar Integrante::..</title>
<script type="text/javascript" language="javascript" src="js/funciones.js" ></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.form;
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
		if (form.abreviatura.value==0){
			document.getElementById("div_abreviatura").innerHTML="<font color='#ff0000'>La abreviatura no es valida</font>";
			form.abreviatura.value="";
			form.abreviatura.focus();
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
		if (form.foto.value==0){
			document.getElementById("div_foto").innerHTML="<font color='#ff0000'>Seleccione una foto</font>";
			form.foto.value="";
			form.foto.focus();
			return false;
			}
		else {
			document.getElementById("div_foto").innerHTML="";
			}
//******************************************************************************************
			document.form.submit();
		}
	function limpiar(){
		document.form.reset();
		document.form.nom.focus();
		}
</script>
</head>
<body onLoad="limpiar()" >
<form action="add.php" method="post" name="form" enctype="multipart/form-data" >

<table align="center" width="400" >
<tr>
<td valign="top" align="center" width="400" colspan="2"	>
<h3>Agregar Integrante</h3>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Integrante:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="integrante" >
<div id="div_integrante" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Abreviatura:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="abreviatura" >
<div id="div_abreviatura" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Cargo:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="cargo" >
<div id="div_cargo" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Celular:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="celular" >
<div id="div_celular" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Gmail:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="gmail" >
<div id="div_gmail" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
E-Mail:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="e_mail" >
<div id="div_e_mail" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Direccion:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="direccion" >
<div id="div_direccion" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Facultad:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="facultad" >
<div id="div_facultad" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Especialidad:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="especialidad" >
<div id="div_especialidad" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Foto:
</td>
<td valign="top" align="left" width="200" >
<input type="file" name="foto" >
<div id="div_foto" ></div>
</td>
</tr>

<tr>
<td align="center" valign="top" width="400" colspan="2" >
<input type="button" title="volver" value="volver" onClick="history.back();" >
&nbsp;&nbsp; || &nbsp;&nbsp;
<input type="button" title="Agregar Integrante" value="Agregar Integrante" onClick="validar_datos()" >

</table>
</form>
</body>
</html>