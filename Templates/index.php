<html>
	<head>
	<title>..::INTEC::..</title>
    
    <?php include_once("../Include/header.general.php"); ?>    
    
    <!-- Especific   -->
	<link href="index/index.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="index/index.js" ></script>
	</head>
	<body>
		
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card " src="../img/Logo_INITEC_338x216.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" action="logueo.php" name="form" method="post" >
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Correo electr&oacute;nico" name="usuario" required autofocus>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a" name="clave" required >
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
		
		<footer class="footer">
          <div class="container">
            <p class="text-muted">P&aacute;gina desarrollada por JIBF</p>
          </div>
        </footer>
	</body>
</html>