        <?php
        include 'includes/_header.php';
        $seccion_actual = "escritorio";
        include 'includes/_session.php';
        ?>

        <div class="container escritorio">
            <div class="col-sm-12 col-md-10 col-lg-8 col-lg-offset-2 col-md-offset-1  center">
                <div class="spacescritorio"></div>
                <img class="img-escritorio" src="<?= base_url ?>img/escritorio.jpg" alt="Escritorio" />
                <h1>Bienvenido a su Sistema Administrador de Contenidos</h1>
                <h4>
                    Desde este panel podrá <b>AÑADIR</b> / <b>MODIFICAR</b> o <b>ELIMINAR</b> el contenido <br class="hidden-xs"/>
                    de las diferenres secciones de su página mediante los módulos contratados.
                </h4>
                <div class="spacerver"></div>
            </div>
        </div>

        <?php include 'includes/_footer.php' ?>