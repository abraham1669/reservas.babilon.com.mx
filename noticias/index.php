<?php
require_once '../includes/_functions.php';
require_once '../includes/_head.php';
?>
<base href="<?php echo base_url; ?>">
<?php
require_once '../includes/_menu.php';
?>
<div class="home">
    <div class="box">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="book black">
                            <h1>BOOK A HOTEL</h1>
                            <div class="h10"></div>
                            <input type="text" name="destino" placeholder="Destination" />
                            <div class="row">
                                <div class="col-sm-6"><input type="text" id="from" name="from" placeholder="Check-in"></div>
                                <div class="col-sm-6"><input type="text" id="to" name="to" placeholder="Check-out"></div>
                                <div class="col-sm-4">
                                    <label>Rooms</label>
                                    <div class="select"><select><option>0</option></select></div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Adults</label>
                                    <div class="select"><select><option>0</option></select></div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Children</label>
                                    <div class="select"><select><option>0</option></select></div>
                                </div>
                            </div>
                            <a href="javascript:;" class="btn-gral blue">SEARCH HOTELS</a>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <h2>VIAJA POR TODO EL MUNDO</h2>
                        <div class="h20"></div>
                        <h3>Comprometidos en ofrecerle servicios de viaje de la más alta calidad.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="h30"></div>
        <div class="col-sm-9">
            <h2 class="rojo mb4">Artículos de interés</h2>
            <h1 class="tazul">Medios</h1>
            <div class="h20"></div>
            <p>Aquí encontraras todo lo que es de tu interés como cliente de Italimpia, noticias, tips y más.</p>
        </div>
        <div class="h45"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php
        $registros = $database->select("noticias","*",["status_not" => 0]);
        foreach ($registros as $registro => $reg) {
            ?>
            <div class="col-sm-3">
                <a href="noticias/<?php echo $reg["url_not"]; ?>">
                    <div class="img-catalogo">
                        <img src="img/noticias/<?php echo $reg["portada_not"]; ?>" class="img-responsive" alt="">
                    </div>
                    <div class="descripcion-video large">
                        <h4 class="tnegro_oscuro fs-15"><?php echo $reg["titulo_not"]; ?></h4>
                        <p class="fs-14"><?php echo $reg["intro_not"]; ?></p>
                    </div>
                </a>
                <div class="h50"></div>
            </div>
            <?php
        }
        ?>

    </div>
</div>
<div class="h95"></div>
<div class="h110"></div>
<?php
require_once '../includes/_footer.php';?>
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
