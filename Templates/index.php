<html>
	<head>
	<title>..::INTEC::..</title>
	<link href="../Estilos/index_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="index/validar_log.js" ></script>
	</head>
	<body>
	
		<div id="contenedor">
		
		<div id="cabecera">
			<img height="100%" src="../Imagenes/initec_presentacion.jpg" >
		</div>
		
		<div id="cuerpo">
			<div id="izquierda">
	
			</div>
			<div id="centro">
				<form action="logueo.php" name="form" method="post">
					<div id="texto_1" >
						<h2>INGRESE EL USUARIO</h2>
					</div> 
					<div id="texto_1" >
						Usuario
					</div>
					<div align="center" valign="center" >
						<input type="text" name="usuario" >
					</div>
					<div id="div_usuario" align="center" style=" background-color:#CDE8F3; color:#FF0000" ></div> 
					<br>
					<div id="texto_1" >
						Clave del Usuario
					</div>
					<div align="center" valign="center" >
						<input type="password" name="clave" >
					</div>
					<div id="div_clave" align="center" style="background-color:#CDE8F3; color:#FF0000" ></div>
					<br>
					<div align="center" valign="center" >
						<a href="javascript:void(0)" border="0" onClick="validar_login()" >
							<img height="40px" src="../Imagenes/ingresar.png">
						</a>
					</div>
				</form>
			</div>
			<div id="derecha">
			</div>
		</div>
		</div>
		
		<div id="pie_pagina">
			<?php include_once("../Include/pie_pagina.php");?>
		</div>
	
	</body>
</html>