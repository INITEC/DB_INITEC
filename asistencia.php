<html>
<head>
<title>..::DATOS DE REUNION::..</title>
<script type="text/javascript" language="javascript" src="js/funciones.js" ></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.form;
//******************************************************************************************
		if (form.dia_semana.value == "0" ){
			document.getElementById("div_dia_semana").innerHTML="<font color='#ff0000'>Eliga un dia de la semana</font>";
			form.dia_semana.value="0";
			form.dia_semana.focus();
			return false;
			}
		else {
			document.getElementById("div_dia_semana").innerHTML="";
			}
//******************************************************************************************
		if (form.dia.value=="00"){
			document.getElementById("div_dia").innerHTML="<font color='#ff0000'>Escriba un dia</font>";
			form.dia.value="";
			form.dia.focus();
			return false;
			}
		else {
			document.getElementById("div_dia").innerHTML="";
			}
//******************************************************************************************
		if (form.mes.value=="00"){
			document.getElementById("div_mes").innerHTML="<font color='#ff0000'>Escriba un mes</font>";
			form.mes.value="";
			form.mes.focus();
			return false;
			}
		else {
			document.getElementById("div_mes").innerHTML="";
			}
//******************************************************************************************
		if (form.hora_inicio.value=="00:00:00"){
			document.getElementById("div_hora_inicio").innerHTML="<font color='#ff0000'>Hora no valida, ingrese a partir de 00:00:01</font>";
			form.hora_inicio.value="00:00:01";
			form.hora_inicio.focus();
			return false;
			}
		else {
			document.getElementById("div_hora_inicio").innerHTML="";
			}
//******************************************************************************************
		if (form.hora_fin.value=="00:00:00" ){
			document.getElementById("div_hora_fin").innerHTML="<font color='#ff0000'>Hora no valida, ingrese a partir de 00:00:01</font>";
			form.hora_fin.value="";
			form.hora_fin.focus();
			return false;
			}
		else {
			document.getElementById("div_hora_fin").innerHTML="";
			}
//******************************************************************************************
		if (form.lugar.value==0){
			document.getElementById("div_lugar").innerHTML="<font color='#ff0000'>Lugar no valido</font>";
			form.lugar.value="OFICINA INITEC - RESIDENCIA UNI";
			form.lugar.focus();
			return false;
			}
		else {
			document.getElementById("div_lugar").innerHTML="";
			}
//******************************************************************************************
		if (form.asunto.value==0){
			document.getElementById("div_asunto").innerHTML="<font color='#ff0000'>Coloque el asunto de la reunion</font>";
			form.asunto.value="OFICINA INITEC - RESIDENCIA UNI";
			form.asunto.focus();
			return false;
			}
		else {
			document.getElementById("div_asunto").innerHTML="";
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
<form action="cargar_reunion.php" method="post" name="form">

<table align="center" width="400" >
<tr>
<td valign="top" align="center" width="400" colspan="2"	>
<h3>REUNION INITEC</h3>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Dia de la semana:
</td>
<td valign="top" align="left" width="200" >
<select name="dia_semana">
<option value="0">Selecione un dia</option>
<option value="Lunes">Lunes</option>
<option value="Martes">Martes</option>
<option value="Miercoles">Miercoles</option>
<option value="Jueves">Jueves</option>
<option value="Viernes">Viernes</option>
<option value="Sabado">Sabado</option>
<option value="Domingo">Domingo</option>
</select>
<div id="div_dia_semana" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Dia:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="dia" value="00" >
<div id="div_dia" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Mes:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="mes" value="00" >
<div id="div_mes" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Año:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="ano" value="2013" >
<div id="div_ano" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Hora de inicio:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="hora_inicio" value="00:00:00" >
<div id="div_hora_inicio" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Hora de finalizacion:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="hora_fin" value="00:00:00" >
<div id="div_hora_fin" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Lugar:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="lugar" value="OFICINA INITEC - RESIDENCIA UNI" >
<div id="div_lugar" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Asunto:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="asunto" value="REUNION DE INFORMACION Y COORDINACION" >
<div id="div_asunto" ></div>
</td>
</tr>

<tr>
<td align="center" valign="top" width="400" colspan="2" >
<input type="button" title="volver" value="volver" onClick="history.back();" >
&nbsp;&nbsp; || &nbsp;&nbsp;
<input type="button" title="Guardar" value="Guardar" onClick="validar_datos()" >

</table>
</form>
</body>
</html>