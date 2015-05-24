<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <?php 
            $obligaciones->buscar_obligaciones($id_trabajo);
            while($menu = $obligaciones->retornar_SELECT()) {
            ?>
            <li>
                <a href="<?php echo $menu['url_tarea'];?>"><?php echo $menu['nom_tarea'];?></a>
            </li>
            <?php 
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
