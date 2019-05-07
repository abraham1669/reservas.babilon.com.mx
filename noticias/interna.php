<?php
require_once '../includes/_functions.php';
require_once '../includes/_head.php';
?>
<style>
    #banner-interna{background-size: cover !important;height: 500px;background-repeat: no-repeat !important; }
</style>
<base href="<?php echo base_url; ?>">
<?php
require_once '../includes/_menu.php';
$registro = $database->get("noticias","*",["url_not"=>$_GET["secc"]]);
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
<div class="">
    <div class="container">
        <div class="row">
            <div class="h80"></div>
            <div class="col-sm-10 col-sm-offset-1">
                <h2 class="">Medios</h2>
                <h1 class=""><?php echo $registro["titulo_not"]; ?></h1>
                <div class="h20"></div>
                <p class=""><?php echo $registro["intro_not"]; ?></p>
            </div>
            <div class="h10"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="banner" id="banner-interna" style="background: url('<?php echo base_url;?>img/noticias/<?php echo $registro["portada_not"]; ?>');"> </div>
            </div>
        </div>
    </div>
    <div class="h25"></div>
</div>
<div class="h80"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <p><?php echo $registro["descripcion_not"]; ?></p>
            
        </div>
    </div>
</div>
<div class="h55"></div>
<?php
require_once '../includes/_footer.php';
?>
</body>
</html>
