<?php
require_once 'includes/_functions.php';
require_once 'includes/_head.php';
?>
<base href="<?php echo base_url; ?>">
<?php
require_once 'includes/_menu.php';
?>
<div class="home bck-blog">
    <div class="box">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <?php 
                        $black = "black";
                        require_once 'includes/_book_box.php'; ?>
                    </div>
                    <div class="col-sm-6">
                        <h2>TRAVEL ARTICLES</h2>
                        <div class="h20"></div>
                        <h3>Our experienced writers travel the world to bring you informative and inspirational features, destination roundups, travel ideas, tips and beautiful photos in order to help you plan your next holiday.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h40"></div>
<div class="container">
    <div class="row">
        <?php 
        $noticias =  $database->select("noticias","*", ["status_not" => 0]);
        foreach ($noticias as $noticias => $not) {
            ?>

            <div class="col-sm-12">
                <div class="pleca-blog">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="imagen" style="background-image: url('img/noticias/<?php echo $not["portada_not"]; ?>');"></div>
                        </div>

                        <div class="col-sm-9">
                            <div class="contenido">
                                <h3><?php echo $not["titulo_not"]; ?></h3>
                                <div class="h20"></div>
                                <p><?php echo $not["intro_not"]; ?></p>
                                <a href="<?php echo base_url; ?>blog/<?php echo $not["url_not"]; ?>" class="fright a-blue">READ MORE <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="h40"></div>

<?php
require_once 'includes/_share.php';?>

<div class="h40"></div>

<?php
require_once 'includes/_footer.php';?>
<script>
    $(document).ready(function () {
        $('.slider-principal .bxslider').bxSlider({
            mode: "fade",
            pager: false,
            controls: true,
            auto: true
        });
        $('#noticias').bxSlider({
            pager: false,
            controls: true,
            auto: true
        });
        $('#contenedor-destacados').slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 4,
          dots: true,
          controls: false
      });
    });
</script>
</body>
</html>
