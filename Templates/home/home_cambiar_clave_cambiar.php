<?php 
if($acceso == 1) {
    require_once ("../require/usuarios_class.php");
    $usuarios = new usuarios();
    $clave_antigua = $_POST["clave_antigua"];
    $clave_nueva = $_POST["clave1"];
    
    if ($usuarios->cambiar_clave_persona($id_persona, $clave_antigua, $clave_nueva)){
        echo "<script type=''>
			alert('La contraseña fue cambiada exitosamente');
			window.location='home.php';
			</script>";
    } else {
        echo "<script type=''>
			alert('La contraseña no fue cambiada exitosamente, intentelo de nuevo');
			window.location='home.php';
			</script>";
    }
}
?>
