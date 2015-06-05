<?php
if($acceso == 1) {
?>
        <div class="list-group">
	<?php
	if( !empty($_POST)) {
        require_once ("../require/amonestaciones_class.php");
        require_once ("../require/temporadas_class.php");
        require_once ("../require/fecha_text_func.php");
        require_once ("../require/integrantes_class.php");
        $part_nombre = $_POST["part_nombre"];
        $integrantes_aux = new integrantes();
        $integrante = new integrantes();
        $integrantes_aux->buscar_integrante_part_nombre($part_nombre);
        
        while ($integrante_date = $integrantes_aux->retornar_SELECT() ){
            $id_persona_date = $integrante_date["id_persona"];
            if ($integrante->verificar_activo($id_persona_date)){
    ?>
            <a class="list-group-item text-uppercase" id="Per<?php echo $id_persona_date; ?>" onclick="AddIntAmon(<?php echo $id_persona_date; ?>, '<?php echo $integrante->ver_nombre_corto($id_persona_date); ?>');" ><?php echo $integrante->ver_nombre_completo($id_persona_date); ?></a>
    <?php
            }
        }
    ?>
        </div>
<?php
	}
}
?>