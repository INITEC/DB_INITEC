<?php 
if($acceso == 1) {

    if( !empty($_POST)){
?>

<div class="col-md-6 col-md-offset-3 masthead-danger" >
    <br>
    <p class="text-center">INSTITUTO DE INNOVACI&Oacute;N TECNOL&Oacute;GICA.</p>
    <p class="text-left">Direcci&oacute;n de Talento Humano</p>
    <br>
    <form id="FormAmonInt" >
        <p class="text-right" >Fecha de emision:</p>
        <fieldset disabled class="col-md-4 col-md-offset-8">
            <input type="text" id="fecha_emision" class="form-control " value="hola">
        </fieldset>
        
        <div class="form-group">
            <label>Integrante(s)</label>
            <br>
            <div class="row show-grid" id="ShowIntAmon" >
                <!--  Aca estaran los integrantes que se van colocando -->
            </div>
            <input type="text" class="form-control" id="PartName" placeholder="ingrese el integrante">
            <div id="ResultListBusquedaNombre" >
            </div>
        </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div id="ver">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
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
        var date = day + "/" + month + "/" + year;

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
        for (var i= IdPer; i<NumIntAmon; i++ ){
            ArrayIntAmon[i] = ArrayIntAmon[i+1]; 
        }
        NumIntAmon--;
    };
    
    function RemvIntAmon (IdPer){
        $( "#Per"+IdPer ).remove();
        RemvArrayAmon (IdPer);
    };
    
    function AddIntAmon (IdInt, smName){
        AddArrayAmon (IdInt);
        var IdPer = NumIntAmon - 1;
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
        $("#PartName").keypress(function(){
            CargarListaBusqueda ("#PartName");
        });
    });
    
    PutDate("#fecha_emision");
    
</script>

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>