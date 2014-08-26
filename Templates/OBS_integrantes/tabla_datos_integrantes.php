<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/lista_grupos_class.php");
        
        $integrantes_aux = new integrantes();
        $lista_grupos = new lista_grupos();
        
        $foto = $_POST["foto"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $nombres_corto = $_POST["nombres_corto"];
        $nombres_completo = $_POST["nombres_completo"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $linkedin = $_POST["linkedin"];
        $DNI = $_POST["DNI"];
        $universidad = $_POST["universidad"];
        $facultad = $_POST["facultad"];
        $especialidad = $_POST["especialidad"];
        $cod_universitario = $_POST["cod_universitario"];
        $id_grupo = $_POST["id_grupo"];
?>
        <table align="center" >
            <tr class="tabla1_encabezado" >
                <td>
                    No
                </td>
                <?php if (isset($foto)){?>
                <td>
                    Foto
                </td>
                <?php } ?>
                <?php if (isset($nombre)){?>
                <td>
                    Nombre
                </td>
                <?php } ?>
                <?php if (isset($apellido)){?>
                <td>
                    Apellidos
                </td>
                <?php } ?>
                <?php if (isset($nombres_corto)){?>
                <td>
                    Nombre y Apellido
                </td>
                <?php } ?>
                <?php if (isset($nombres_completo)){?>
                <td>
                    Nombres y Apellidos
                </td>
                <?php } ?>
                <?php if (isset($telefono)){?>
                <td>
                    Teléfono
                </td>
                <?php } ?>
                <?php if (isset($correo)){?>
                <td>
                    Correo
                </td>
                <?php } ?>
                <?php if (isset($linkedin)){?>
                <td>
                    Linkedin
                </td>
                <?php } ?>
                <?php if (isset($DNI)){?>
                <td>
                    DNI
                </td>
                <?php } ?>
                <?php if (isset($universidad)){?>
                <td>
                    Universidad
                </td>
                <?php } ?>
                <?php if (isset($facultad)){?>
                <td>
                    Facultad
                </td>
                <?php } ?>
                <?php if (isset($especialidad)){?>
                <td>
                    Especialidad
                </td>
                <?php } ?>
                <?php if (isset($cod_universitario)){?>
                <td>
                    Cod. Universitario
                </td>
                <?php } ?>
            </tr>

        <?php
        $lista_grupos->ver_integrantes($id_grupo);
        $cont_lista = 0;
        while ($dato_lista = $lista_grupos->retornar_SELECT()){
            $cont_lista++;
            $id_persona_list = $dato_lista["id_persona"];
        ?>
            <tr class="tabla1_informacion" >
                <td>
                <?php
                echo $cont_lista;
                ?>
                </td>
                <?php if (isset($foto)){?>
                <td>
                    <img src="<?php echo $integrantes_aux->ver_foto($id_persona_list);?>" width="60" height="48">
                </td>
                <?php } ?>
                <?php if (isset($nombre)){?>
                <td class="mayuscula" >
                    <?php echo $integrantes_aux->ver_nombre($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($apellido)){?>
                <td class="mayuscula" >
                    <?php echo $integrantes_aux->ver_apellido($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($nombres_corto)){?>
                <td class="mayuscula" >
                    <?php echo $integrantes_aux->ver_nombre_corto($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($nombres_completo)){?>
                <td class="mayuscula" >
                    <?php echo $integrantes_aux->ver_nombre_completo($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($telefono)){?>
                <td>
                    <?php echo $integrantes_aux->ver_telefono_predeterminado($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($correo)){?>
                <td>
                    <?php echo $integrantes_aux->ver_correo_predeterminado($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($linkedin)){?>
                <td>
                    Linkedin
                </td>
                <?php } ?>
                <?php if (isset($DNI)){?>
                <td>
                    DNI
                </td>
                <?php } ?>
                <?php if (isset($universidad)){?>
                <td>
                    <?php echo $integrantes_aux->ver_telefono_predeterminado($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($facultad)){?>
                <td>
                    <?php echo $integrantes_aux->ver_telefono_predeterminado($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($especialidad)){?>
                <td>
                    <?php echo $integrantes_aux->ver_telefono_predeterminado($id_persona_list); ?>
                </td>
                <?php } ?>
                <?php if (isset($cod_universitario)){?>
                <td>
                    Cod. Universitario
                </td>
                <?php } ?>
            </tr>
        <?php
        }
        ?>
        </table>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>