<?php
require_once 'includes/_functions.php';

require_once 'includes/_head.php';
// Incruste contenido adicional dentro de <head></head> si requiere agregar CSS o cualquier otra etiqueta
require_once 'includes/_menu.php';

require_once 'includes/_paginador.php';

$numero_items_mostar = 6;
// Hace el conteo para la paginacion de la tabla que usaremos para mostrar datos
$count = $database->count("noticias", ["status_not" => "0"]);
$pages = new Paginator($numero_items_mostar, 'p');
$pages->set_total($count);
$pages->set_withLinkInCurrentLi(true);
$pages->set_paginatorStartChar("< Anterior");
$pages->set_paginatorEndChar("Siguiente >");
// Consulta de la tabla de los datos que se van a mostrar
$noticias = $database->select("noticias", '*', ['LIMIT' => [$pages->get_start(), $numero_items_mostar]]);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?= $pages->page_links() ?>
        </div>
    </div>
</div>
<div class="h40"></div>
<div class="container">
    <div class="row">
        <!-- Imprime todos los resultados que se va a mostrar -->
        <?php foreach ($noticias as $not) { ?>
        <div class="col-sm-4 noticia-item">
            <figure class="noticia-imagen" style="background-image: url(<?=base_url;?>uploads/noticias/thumb/<?=$not["portada_not"]?>);"></figure>
            <div class="noticia-descripcion">
                <h4><?=$not["titulo_not"]?></h4>
                <p><?=custom_echo(strip_tags($not["descripcion_not"]), $length = 150)?></p>
                <div class="noticia-lnk"><a href="<?=base_url;?>noticias/<?=$not["url_not"]?>" class="btn-gral amarillo">Leer más</a></div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="h90"></div>

<?php require_once 'includes/_share.php'; ?>

<div class="h90"></div>

<?php require_once 'includes/_footer.php'; ?>

</body>
</html>
