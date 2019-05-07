<div class="menu sb-toggle-left">
    <div class="menu-cont">
        <span id="iconomenu" class="glyphicon glyphicon-th-list sb-toggle-left"></span>
        <span id="textomenu" class="sb-toggle-left">Menú</span>
    </div>
</div>

<div class="sb-slidebar sb-left">
    <h4 class="uppercase">Módulos</h4>
    <ul>
        <li><a href="<?=base_url?>escritorio">Inicio</a></li>
        <?php if (in_array("todos", $sec) || in_array("noticias", $sec)) {?><li><a href="<?=base_url?>modulo/noticias/">Noticias</a></li> <?php }?>
    </ul>
    <div class="h50"></div>
    <h4 class="uppercase">Configuración</h4>
    <ul>
        <?php if ($_SESSION['nivel'] === "1") {?><li><a href="<?=base_url?>modulo/usuarios/">Usuarios</a></li> <?php }?>
    </ul>
</div>
