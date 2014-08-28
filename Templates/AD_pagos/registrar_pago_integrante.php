<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        require_once ("../require/pagos_class.php");
        
        $deudas = new deudas();
        $pagos = new pagos();
        $id_persona_env = $_POST["id_persona"];
        $id_deuda_env = $_POST["id_deuda"];
        $pago = $_POST["pago_add"];
        $monto_deuda = $deudas->ver_monto_total($id_deuda_env);
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                if($deudas->verificar_cobrador($id_persona,$id_deuda_env) != 0 ) {
                    if($pagos->registrar_pago_int($id_persona_env, $id_deuda_env, $pago, $monto_deuda)){
                    ?>
                    <div class="dato_correcto" id="mensaje-cambio-grupo" >
                                    OK
                    </div>
                    <?php 
                    } else {
                    ?>
                    <div class="dato_incorrecto" id="mensaje-cambio-grupo" >
                                    FALLO
                    </div>
                    <?php 
                    }
                    ?>
                    <script>
                        // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                        // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                        setTimeout(function(){$("#mensaje-cambio-grupo").slideUp(500)},2000);
                    </script>
                <?php
                } else {
                ?>
                <div class="dato_incorrecto" id="mensaje-cambio-grupo" >
                    NEGADO
                </div>
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