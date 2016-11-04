<a href="#menu" id="menuLink" class="menu-link">
    <span></span>
</a>
<div id="menu">
    <div class="pure-menu">
        <a class="pure-menu-heading" href="">Mini´s Wings</a>
        <legend>Administrador</legend>
        <ul class="pure-menu-list">
            <?php
                include('php/inventario.php');
                $cant = new inventario();
            ?>
            <li class="pure-menu-item menu-item-divided">
                <a id="alert" href="alert" class="pure-menu-link"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php /*$cant->contarAlerta();*/ ?></i> Alertas</a>
            </li>
          
            <li class="pure-menu-item menu-item-divided">
                <a href="page" class="pure-menu-link"><i class="fa fa-globe fa-lg" aria-hidden="true"></i> Página Web</a>
            </li>
          
            <li class="pure-menu-item menu-item-divided">
                <a href="orden" class="pure-menu-link"><i class="fa fa-list fa-lg" aria-hidden="true"></i> Órdenes</a>
            </li>
          
            <li class="pure-menu-item">
                <a href="venta" class="pure-menu-link"><i class="fa fa-usd fa-lg" aria-hidden="true"></i> Ventas</a>
            </li>
            
            <li class="pure-menu-item menu-item-divided">
                <a href="promo" class="pure-menu-link"> Promociones</a>
            </li>

            <li class="pure-menu-item">
                <a href="combo" class="pure-menu-link"> Combos</a>
            </li>

            <li class="pure-menu-item ">
                <a href="platillo" class="pure-menu-link"><i class="fa fa-cutlery fa-lg" aria-hidden="true"></i> Platillos</a>
            </li>

            <li class="pure-menu-item">
                <a href="inventario" class="pure-menu-link"><i class="fa fa-cubes fa-lg" aria-hidden="true"></i> Inventario</a>
            </li>

            <li class="pure-menu-item menu-item-divided">
                <a href="empleados" class="pure-menu-link"><i class="fa fa-users fa-lg" aria-hidden="true"></i> Empleados</a>
            </li>
          
            <li class="pure-menu-item menu-item-divided">
                <a href="config" class="pure-menu-link"><i class="fa fa-cogs fa-lg" aria-hidden="true"></i> Configuración</a>
            </li>
          
            <li class="pure-menu-item">
                <a href="out" class="pure-menu-link"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> Salir</a>
            </li>
        </ul>
    </div>
</div>