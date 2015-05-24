<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/cond_asist_class.php");
        
        $cond_asist = new cond_asist();
        $asistencia = $_POST["asistencia"];
        $condicion = $_POST["condicion"];
        
?>
    <select name="id_cond_asist">    
        <?php
        $cond_asist->ver_condiciones($asistencia);
        while ($dato_condicion = $cond_asist->retornar_SELECT()){
        ?>
        <option value="<?php echo $dato_condicion["id_cond_asist"];?>" <?php if($dato_condicion["id_cond_asist"] == $condicion ) {echo "selected";} ?> > <?php echo $dato_condicion["nom_condicion"]; ?> </option>
        <?php
        }
        ?>
    </select>
		
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>