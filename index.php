<html>
<head>
<title>..::INTEC::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" > 
function validar_login(){
	  var form=document.form;
	 //******************************************************************************************
	  if (form.usuario.value == 0 ){
		 		document.getElementById("div_usuario").innerHTML="<font color='#ff0000'>Escriba un usuario</font>";
		 		form.usuario.value="";
				form.usuario.focus();
				return false;
				}
			else {
				document.getElementById("div_usuario").innerHTML="";
				}
	//******************************************************************************************
	  if (form.clave.value == 0 ){
		 		document.getElementById("div_clave").innerHTML="<font color='#ff0000'>Escriba su clave</font>";
		 		form.clave.value="";
				form.clave.focus();
				return false;
				}
			else {
				document.getElementById("div_clave").innerHTML="";
				}
			document.form.submit();}
//*************************************************************************************************
function observador(){
	window.location="observador_integrantes.php";
}
</script>
</head>
<body style="background-color:#275096">

<div id="contenedor">

<div id="cabecera">
<img height="100%" src="ima/initec_presentacion.jpg" >
</div>

<div id="cuerpo">
<div id="izquierda">
<div id="texto_1" ><h2>No deseo administrar la pagina</h2></div>
<br>

<div align="center" valign="center" ><a href="javascript:void(0)" border="0" onClick="observador()" ><img height="60px" src="ima/entrar_observador.png"></a></div>

</div>
<div id="centro">
<form action="logueo.php" name="form" method="post">
<div id="texto_1" ><h2>INGRESE EL USUARIO</h2></div> 
<div id="texto_1" >Usuario</div>
<div align="center" valign="center" ><input type="text" name="usuario" ></div>
<div id="div_usuario" align="center" style=" background-color:#CDE8F3; color:#FF0000" ></div> 
<br>
<div id="texto_1" >Clave del Usuario</div>
<div align="center" valign="center" ><input type="password" name="clave" ></div>
<div id="div_clave" align="center" style="background-color:#CDE8F3; color:#FF0000" ></div>
<br>
<div align="center" valign="center" ><a href="javascript:void(0)" border="0" onClick="validar_login()" ><img height="40px" src="ima/ingresar.png"></a></div>
</form>

</div>
<div id="derecha"></div>
</div>

<div id="pie">Pagina programada por JIBF</div>
</div> 

</body>
</html>