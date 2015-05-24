<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#" id="editarPerfil"><i class="fa fa-user fa-fw"></i> Editar perfil</a>
            </li>
            <li><a href="#" id="cambiarClave"><i class="fa fa-gear fa-fw"></i> Cambiar clave</a>
            </li>
            <li class="divider"></li>
            <li><a href="salir.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>


<script type='text/javascript' languaje='javascript'>
    
$(function() {
    $( "#editarPerfil" ).click(function() {
        $parametros = {
            'boton-ver-cuadro-editar-integrante' : true
        };
        $.ajax({
            url: 'home_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    });
    
    $( "#cambiarClave" ).click(function() {
        $parametros = {
            'cambiar_clave' : true
        };
        $.ajax({
            url: 'home_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    });
    
});
</script>