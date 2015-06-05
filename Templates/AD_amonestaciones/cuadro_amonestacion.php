<?php 
if($acceso == 1) {

    if( !empty($_POST)){
?>

<div class="btn-danger col-md-6 col-md-offset-3" id="cuadroRespuesta" >
    
</div>

<div class="btn-danger col-md-6 col-md-offset-3" >
    <br>
    <p class="text-center">INSTITUTO DE INNOVACI&Oacute;N TECNOL&Oacute;GICA.</p>
    <p class="text-left">Direcci&oacute;n de Talento Humano</p>
    <br>
    <form name="formulario-datos-amonestacion" >
        <p class="text-right" >Fecha de la falta:</p>
        <fieldset class="col-md-4 col-md-offset-8">
            <input type="text" id="fecha_falta" name="fecha_falta" class="form-control" >
        </fieldset>
        
        <div class="form-group">
            <label>Integrante(s):</label>
            <br>
            <div class="row show-grid" id="ShowIntAmon" >
                <!--  Aca estaran los integrantes que se van colocando -->
            </div>
            <input type="text" class="form-control" id="PartName" placeholder="ingrese el integrante">
            <div id="ResultListBusquedaNombre" >
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <label >Tipo de Amonestación:</label>
            <select class="form-control" name="id_tipo_amonestacion">
                <option value="1" >Leve</option>
                <option value="2" >Grave</option>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <label >Reglamento:</label>
            <select class="form-control" name="id_reglamento">
                <option value="1" >Estatuto INITEC
                </option>
            </select>
        </div>
        <div class="form-group col-md-12 col-xs-12">
            <label >Motivo</label>
            <textarea class="form-control" name="motivo">
            </textarea>
        </div>
        <div class="form-group col-md-12 col-xs-12">
            <button type="button" id="enviarAmonestacion" class="btn btn-default">Enviar</button>    
        </div>
      
    </form>
</div>

<script>
    
    function PutDate (dateObject) {
        var d = new Date();
        var day = d.getDate();
        var month = d.getMonth()+1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = year + "-" + month + "-" + day;

        $(dateObject).val(date);
    };
    
    var ArrayIntAmon = [];
    var NumIntAmon = 0;
    
    function AddArrayAmon (IdInt){
        ArrayIntAmon[NumIntAmon] = IdInt;
        NumIntAmon++;
        $("#ver").html(NumIntAmon);
    };
    
    function RemvArrayAmon (IdPer){
        var IdTemp = 0;
                ArrayIntAmon.splice(ArrayIntAmon.indexOf(IdPer), 1);
        
        NumIntAmon--;
    };
    
    function RemvIntAmon (IdPer){
        $( "#Per"+IdPer ).remove();
        RemvArrayAmon (IdPer);
    };
    
    function AddIntAmon (IdInt, smName){
        AddArrayAmon (IdInt);
        //var IdPer = NumIntAmon - 1;
        var IdPer = IdInt;
        $( "#ShowIntAmon" ).append( "<pre class='col-md-4 btn-xs' id='Per"+IdPer+"' >"+smName+"<button type='button' class='close' onclick='RemvIntAmon("+IdPer+")' >&times;</button></pre>" );
    };
    
    function PutIntList (){
        var listIntAmon = "";
        for (var i=0; i<NumIntAmon; i++){
            listIntAmon = listIntAmon + " " + ArrayIntAmon[i];
        }
        $( "#FormAmonInt" ).append( "<input type='hidden' name='listIntAmon' value='"+listIntAmon+"' >" );
        $("#ver").html(listIntAmon);
    }
    
    function CargarListaBusqueda (IdInput){
        var PartName = $(IdInput).val();
        
        $parametros = {
            'boton-ver-lista-busqueda-nombre' : true,
            'part_nombre' : PartName
        };
        $.ajax({
            url: 'AD_amonestaciones_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#ResultListBusquedaNombre").html(datos);
            }
        });

    }
    
    $(function(){
        $("#PartName").keyup(function(){
            if($("#PartName").val() == ""){
                $("#ResultListBusquedaNombre").html("");
            }else {
                CargarListaBusqueda ("#PartName");
            }
        });
        
        $("#enviarAmonestacion").click(function() {
            sendDataAmonestacion ();
        });
        
    });
    
    function sendDataAmonestacion (){
        var dataAmonestacion = new FormData(document.forms.namedItem("formulario-datos-amonestacion"));
        dataAmonestacion.append("listIntegrantes", ArrayIntAmon);
        dataAmonestacion.append("numIntegrantes", NumIntAmon);
        dataAmonestacion.append("boton-guardar-amonestaciones", true);
        
        $url = "AD_amonestaciones_aux.php";
        $.ajax({
            type: "POST",
            url: $url,
            data: dataAmonestacion,
            contentType: false,   // tell jQuery not to set contentType
            processData: false,  // tell jQuery not to process the data
            success: function(data){
                $("#cuadroRespuesta").html(data);
            }
        });
        
    }
    
    PutDate("#fecha_falta");
    
</script>

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>