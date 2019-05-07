<div class="container">
    <div class="row layout">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <footer>
                <hr/>
                
                Este Sistema es de uso exclusivo para <a href="<?= base_url ?>"><?= $site_name ?></a> &reg; Todos los Derechos Reservados <?= date('Y') ?>. Diseño y Desarrollo por: <a href="http://genotipo.com/">Genotipo®</a>
            </footer>
        </div>
    </div>
</div>

<!-- Slidebars -->
<script src="<?= base_url ?>js/bundles/slidebars/slidebars.min.js"></script>
<script>
    (function ($) {
        $(document).ready(function () {
            $.slidebars();
        });
    })(jQuery);
</script>
<!-- /container -->      
</body>
</html>