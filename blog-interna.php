<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
require_once 'includes/_menu.php';
$registro = $database->get("noticias","*",["url_not"=>$_GET["secc"]]);
?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="tcenter">
                <a href="<?=base_url;?>blog" class="a-blue"><i class="fas fa-chevron-left"></i> BLOG</a>
                <div class="h20"></div>
                <h1 class="tsecundario"><?php echo $registro["titulo_not"]; ?></h1>
            </div>
            <div class="h20"></div>
            <p class=""><?php echo $registro["intro_not"]; ?></p>
            <div class="h30"></div>
            <div class="tcenter">
                <img src="<?php echo base_url;?>img/noticias/<?php echo $registro["portada_not"]; ?>" class="img-responsive dib">
            </div>
            <div class="h30"></div>
            <p><?php echo $registro["descripcion_not"]; ?></p>
        </div>

    </div>
</div>

<div class="h60"></div>

<?php
require_once 'includes/_share.php';?>

<div class="h40"></div>
<?php
require_once 'includes/_footer.php';
?>
<script type="text/javascript">

    $("#header-main").addClass("Clor");
</script>
</body>
</html>
