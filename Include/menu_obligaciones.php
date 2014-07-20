<link href="../Estilos/menu_obligaciones.css" type="text/css" rel="stylesheet" >
<div id="menu_obligaciones">
	<ul>
	<?php 
		$obligaciones->buscar_obligaciones($id_trabajo);
		while($menu = $obligaciones->retornar_SELECT()) {
	?>
		<li><a href="<?php echo $menu['url_tarea'];?>"><?php echo $menu['nom_tarea'];?></a></li>
	<?php 
		}
	?>
	</ul>
</div>