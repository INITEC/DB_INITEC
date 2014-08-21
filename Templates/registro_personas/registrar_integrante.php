<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        
        $integrantes_aux = new integrantes();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $usuario = $_POST["usuario"];
                $clave1 = $_POST["clave1"];
                $clave2 = $_POST["clave2"];
                
                if(strcmp($clave1,$clave2) == 0){    
                    if($integrantes_aux->nuevo($nombres, $apellidos, $usuario, $clave1)){
                    ?>
                    <div class="dato_correcto" id="mensaje-nueva-reunion" >
                                    SE GUARDARON LOS DATOS CORRECTAMENTE 
                    </div>
                    <?php 
                    } else {
                    ?>
                    <div class="dato_incorrecto" id="mensaje-nueva-reunion" >
                                    NO SE HA PODIDO GUARDAR LOS DATOS, INTENTE DE NUEVO
                    </div>
                    <?php 
                    }
                    ?>
                    <script>
                        // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                        // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                        setTimeout(function(){$("#mensaje-nueva-reunion").slideUp(500)},2000);
                    </script>
                <?php
                } else {
                ?>
                    <div class="dato_incorrecto" id="mensaje-nueva-reunion" >
                                    NO SE HA PODIDO GUARDAR LOS DATOS, LAS CLAVES NO SON IGUALES
                    </div>
                    <script>
                        // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                        // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                        setTimeout(function(){$("#mensaje-nueva-reunion").slideUp(500)},2000);
                    </script>
                <?php
                }
                ?>
			</body>
		</html>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>