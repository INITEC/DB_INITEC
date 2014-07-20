<html>
<head>
<title>..::DATOS DEL EXAMEN::..</title>
<script type="text/javascript" language="javascript" src="js/funciones.js" ></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.form;
//******************************************************************************************
		if (form.examen.value == 0 ){
			document.getElementById("div_examen").innerHTML="<font color='#ff0000'>Escriba el titulo del examen</font>";
			form.examen.value="";
			form.examen.focus();
			return false;
			}
		else {
			document.getElementById("div_examen").innerHTML="";
			}
//******************************************************************************************
		if (form.fecha.value==0){
			document.getElementById("div_fecha").innerHTML="<font color='#ff0000'>Escriba la fecha</font>";
			form.fecha.value="";
			form.fecha.focus();
			return false;
			}
		else {
			document.getElementById("div_fecha").innerHTML="";
			}
//******************************************************************************************
		if (form.n_maxima.value== 0){
			document.getElementById("div_n_maxima").innerHTML="<font color='#ff0000'>Escriba la maxima nota posible</font>";
			form.n_maxima.value="20";
			form.n_maxima.focus();
			return false;
			}
		else {
			document.getElementById("div_n_maxima").innerHTML="";
			}
//******************************************************************************************
		if (form.n_aprobatoria.value==0){
			document.getElementById("div_n_aprobatoria").innerHTML="<font color='#ff0000'>Escriba la minima nota aprobatoria</font>";
			form.n_aprobatoria.value="10";
			form.n_aprobatoria.focus();
			return false;
			}
		else {
			document.getElementById("div_n_aprobatoria").innerHTML="";
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
<form action="cargar_examen.php" method="post" name="form">

<table align="center" width="400" >
<tr>
<td valign="top" align="center" width="400" colspan="2"	>
<h3>EXAMEN INITEC</h3>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Nombre del Examen:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="examen" >
<div id="div_examen" ></div>
</td>
</tr>
<?php 
date_default_timezone_set('America/Los_Angeles');
$dia=date(d);
$mes=date(n);
$ano=date(Y);
?>
<tr>
<td align="right" valign="top" width="200" >
Fecha(AAAA-MM-DD):
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="fecha" value="<?php echo "$ano-$mes-$dia";?>" >
<div id="div_fecha" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Examen en base a:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="n_maxima" value="20" >
<div id="div_n_maxima" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Nota Aprobatoria:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="n_aprobatoria" value="10" >
<div id="div_n_aprobatoria" ></div>
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