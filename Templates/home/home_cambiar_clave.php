<?php 
if($acceso == 1) {
    $trabajos = new trabajos_int();
    $tareas = new tareas_int();
?>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
		<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
		<script type="text/javascript" languaje="javascript" src="../JavaScript/funciones_ajax.js"></script>
		<script type="text/javascript" languaje="javascript" src="home/verificar_igual.js"></script>
	
			<div >
<!-- ******************************************************************* -->
			<form action="home_aux.php" id="cambiar_clave_form" method="POST" >
                <table width="400px" align="center">
                    <tr>
                        <td class="informacion_extra" >
                        Ingrese su clave actual
                        </td>
                    </tr>
                    <tr>
                        <td  class="datos_extra">
                        <input type="password" name="clave_antigua" >
                        </td>
                    </tr>
                    <tr>
                        <td class="informacion_extra" >
                        Ingrese su nueva clave dos veces
                        </td>
                    </tr>
                    <tr>
                        <td  class="datos_extra">
                        <input type="password" name="clave1" >
                        </td>
                    </tr>
                    <tr>
                        <td  class="datos_extra">
                        <input type="password" name="clave2" onkeypress ="verificar_igual('cambiar_clave_form','div_clave');" >
                        <div id="div_clave" ></div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" >
                        <input type="hidden" name="cambiar_clave_cambiar" value="Cambiar" >
                        </td>
                    </tr>
                </table>
			</form>
<!-- ******************************************************************* -->
			</div>
<?php
}
?>