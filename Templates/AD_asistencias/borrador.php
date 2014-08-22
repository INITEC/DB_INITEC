</tr>

            <tr class="informacion_extra" >
            <td align="center" valign="top" width="50" >
            Foto
            </td>
            <td align="center" valign="top" width="250" >
            Nombre
            </td>
            <td align="center" valign="top" width="100" >
            Hora
            </td>
            <td align="center" valign="top" width="100" >
            Asistencia
            </td>
            <td align="center" valign="top" width="100" >
            Condicion
            </td>
            <td align="center" valign="top" width="80" >
            &nbsp;
            </td>
            <td align="center" valign="top" width="80" >
            &nbsp;
            </td>
            </tr>
            <?php 
            $sql2="select * from integrantes where estado='activo' order by integrante asc";
            $res2=mysql_query($sql2,$conexion);

            while($reg2=mysql_fetch_array($res2)){
            ?>
                <tr class="datos_extra" >
                    <td align="center" valign="top" width="50" >
                        <img src="../foto_integrantes/<?php echo $reg2["foto"];?>" width="50" heigth="50" border="0" >
                    </td>
                    <td align="center" valign="top" width="250" >
                        <?php 
                        echo $reg2["integrante"];
                        ?>
                    </td>
                    <!-- ********************************************************************* -->
                    <?php 
                    $sql3="select * from asistencias where id_integrante='".$reg2["id_integrante"]."' AND 
                            id_fecha='".$_POST["id_fecha"]."' ";
                    $res3=mysql_query($sql3,$conexion);
                    if($reg3=mysql_fetch_array($res3)){
                    ?>
                        <form action="AD_asistencias_editar_cambiar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
                        <td align="center" valign="top" width="100" >
                            <input type="text" name="hora" value="<?php echo $reg3["hora"];?>" >
                        </td>
                        <td align="center" valign="top" width="100" >
                            <select name="asistencia">
                                <option <?php if($reg3["asistencia"]=="Asistio"){echo "selected";}?> value="Asistio">Asistio</option>
                                <option <?php if($reg3["asistencia"]=="No Asistio"){echo "selected";}?> value="No Asistio">No Asistio</option>
                            </select>
                        </td>
                        <td align="center" valign="top" width="100" >
                            <select name="condicion">
                                <option <?php if($reg3["condicion"]=="Puntual"){echo "selected";}?> value="Puntual">Puntual</option>
                                <option <?php if($reg3["condicion"]=="Retrasado justificado"){echo "selected";}?> value="Retrasado justificado">Retrasado justificado</option>
                                <option <?php if($reg3["condicion"]=="Tarde justificado"){echo "selected";}?> value="Tarde justificado">Tarde justificado</option>
                                <option <?php if($reg3["condicion"]=="Justificado"){echo "selected";}?> value="Justificado">Justificado</option>
                                <option <?php if($reg3["condicion"]=="Retrasado"){echo "selected";}?> value="Retrasado">Retrasado</option>
                                <option <?php if($reg3["condicion"]=="Tarde"){echo "selected";}?> value="Tarde">Tarde</option>
                                <option <?php if($reg3["condicion"]=="Injustificado"){echo "selected";}?> value="Injustificado">Injustificado</option>
                                <option <?php if($reg3["condicion"]=="Apoyo"){echo "selected";}?> value="Apoyo">Apoyo</option>
                            </select>
                        </td>
                        <td align="center" valign="top" width="100" >
                            <input type="submit" value="Cambiar" title="Cambiar"/>
                        </td>
                        <td align="center" valign="top" width="100" >
                            &nbsp;
                        </td>
                    <?php 
                    } else {
                    ?>
                        <form action="AD_asistencias_editar_enviar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
                        <td align="center" valign="top" width="100" class="datos_extra_2" >
                            <input type="text" name="hora" value="<?php echo $reg["hora_inicio"];?>" >
                        </td>
                        <td align="center" valign="top" width="100" class="datos_extra_2" >
                            <select name="asistencia">
                                <option value="Asistio">Asistio</option>
                                <option value="No Asistio">No Asistio</option>
                            </select>
                        </td>
                        <td align="center" valign="top" width="100" class="datos_extra_2" >
                            <select name="condicion">
                                <option value="Puntual">Puntual</option>
                                <option value="Retrasado justificado">Retrasado justificado</option>
                                <option value="Tarde justificado">Tarde justificado</option>
                                <option value="Justificado">Justificado</option>
                                <option value="Retrasado">Retrasado</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Injustificado">Injustificado</option>
                                <option value="Apoyo">Apoyo</option>
                            </select>
                        </td>
                        <td align="center" valign="top" width="100" class="datos_extra_2" >
                            <input type="submit" value="Enviar" title="Enviar"/>
                        </td>
                        <td align="center" valign="top" width="100" class="datos_extra_2" >
                            <input type="button" value="Marcar" title="Marcar" onClick="Marcar(document.form_<?php echo $reg2["id_integrante"]?>)" />
                        </td>
                    <?php 
                    }
                    ?>
                    <!-- *************************************************************************************** -->		
                        </tr>
                        <input type="hidden" name="id_integrante" value="<?php echo $reg2["id_integrante"];?>" >
                        <input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"];?>" >
                        <input type="hidden" name="tarea" value="<?php echo $_POST["tarea"];?>" >
                        </form>
                <!-- ********************************************************************* -->
            <?php 
            }
            ?>
            <form action="AD_asistencias.php" method="post" name="terminar" >
            <tr>
            <td align="center" valign="top" width="700" colspan="6">
            <input type="submit" value="Terminar" title="Terminar de tomar asistencia"/>
            </td>
            </tr>
            </form>