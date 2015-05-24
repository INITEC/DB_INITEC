<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
?>
    <script>
        $(function(){
            $("#boton-registrar-horas-trabajo").click(function(){
                $url = "horas_trabajo_aux.php";
                $.ajax({
                    type: "POST",
                    url: $url,
                    data: $("#registro-horas-integrante").serialize(),
                    success: function(data){
                        $("#resultado-registro-horas").html(data);
                    }
                });
                setTimeout(function(){
                    cargar_cuadro_ingreso_horas ();
                    cargar_lista_horas_integrante ();
                },3000);
                return false;
            });
        });
    </script>

    <form id="registro-horas-integrante" method="POST">
        <table align="center">
            <tr class="tabla1_encabezado">
                <td>
                    NUMERO DE HORAS
                </td>
                <td>
                    ELIJA SU GRUPO
                </td>
                <td>
                    COMENTARIO (140 caract.)
                </td>
                <td>
                    FECHA
                </td>
                <td>
                </td>
            </tr>
            <tr class="tabla1_informacion">
                <form action="horas_trabajo_aux.php" method="POST" id="form_registro" >
                <td>
                    <input type="text" name="n_horas" value="0">
                </td>
                <td>
                    <select name="id_grupo" id="id_grupo" onchange="eval_select('id_grupo','otro_grupo','id_button')">
                            <?php 
                            if($grupo->numero_grupos() == 0) {
                            ?>
                            <option value="">Vacio</option>
                            <?php
                            }  												
                            $grupo->ver_grupos();
                                    while($op_grupo = $grupo->retornar_SELECT()) {
                            ?>
                            <option value="<?php echo $op_grupo['id_grupo'];?>"><?php echo $op_grupo['nom_grupo']?></option>
                            <?php }?>
                        </select>
                </td>
                <td>
                    <textarea name="comentario" cols="40"></textarea>
                </td>
                <td>
                    <?php 
                        date_default_timezone_set('America/Los_Angeles');
                        $dia=date(d);
                        $mes=date(n);
                        $year=date(Y);
                    ?>
                    <input type="input" name="fecha" id="fecha" value="<?php echo $year."-".$mes."-".$dia; ?>" />
                    <br>
                    <span style="background-color: #ffc; cursor:default; padding:.3em; border:thin solid #ff0; text-decoration:underline; color: blue;" 
    onmouseover="this.style.cursor='pointer'; this.style.cursor='hand'; this.style.backgroundColor='#ff8'; this.style.textDecoration='none';"
    onmouseout="this.style.backgroundColor='#ffc'; this.style.textDecoration='underline';"
    id="fecha_usuario">
                       Elegir fecha
                    </span>
                    
                    <script type="text/javascript">
                        Calendar.setup({
                        inputField: "fecha",
                        ifFormat:   "%Y-%m-%d",
                        weekNumbers: false,
                        displayArea: "fecha_usuario",
                        daFormat:    "%A, %d de %B de %Y"
                        });
                    </script>
                </td>
                <td>
                   <input type="hidden" name="boton-registrar-horas-trabajo" value="boton" >
                    <input type="submit" id="boton-registrar-horas-trabajo" value="Registrar">
                </td>
                </form>
            </tr>
            <tr>
                <td colspan="5" >
                    <div id="resultado-registro-horas">
                        
                    </div>
                </td>
            </tr>
        </table>
    </form>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>