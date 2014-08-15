<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        $horas_trabajo = new horas_trabajo();
        
        $n_horas = $_POST["n_horas"];
        $id_grupo = $_POST["id_grupo"];
        $comentario = $_POST["comentario"];
        $fecha = $_POST["fecha"];
        if(isset($_POST['id_persona_env'])){
            $id_persona_env = $_POST["id_persona_env"];
        } else {
            $id_persona_env = $id_persona;
        }
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                if($integrante->verificar_activo($id_persona_env)) {
                    if($horas_trabajo->registrar_horas_trabajo ($id_persona_env, $id_grupo, $comentario, $fecha, $n_horas)){
                    ?>
                    <div class="dato_correcto" id="mensaje-registro-horas" >
                                    SE GUARDARON LOS DATOS CORRECTAMENTE 
                    </div>
                    <?php 
                    } else {
                    ?>
                    <div class="dato_incorrecto" id="mensaje-registro-horas" >
                                    DATOS INCORRECTOS, NO SE PUEDE GUARDAR EN LA MISMA FECHA
                    </div>
                    <?php 
                    }
                    ?>
                    <script>
                        // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                        // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                        setTimeout(function(){$("#mensaje-registro-horas").slideUp(500)},2000);
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