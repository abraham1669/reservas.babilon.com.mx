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
                        <h2>CONTACTO</h2>
                        <div class="h20"></div>
                        <h3>Contáctanos para poder resolver cualquier duda o comentario que pudieras tener.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h40"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 tcenter">
            <h1 class="tprimario interna">Contáctanos</h1>
            <h2 class="interna">Escríbenos, para asesorarte en tu próximo viaje.</h2>
            <div class="h20"></div>
            <div class="relative">
                <div class="bic"></div>
            </div>
        </div>

        <div class="h60"></div>

        <div class="formulario-informacion">
            <div class="col-sm-4">
                <input type="text" name="nombre" placeholder="Nombre completo: *" />
                <input type="text" name="empresa" placeholder="Empresa:" />
                <input type="email" name="email" placeholder="Correo electrónico: *" />
                <input type="hidden" name="forma" value="Contacto" id="forma-nombre" />
            </div>
            <div class="col-sm-4">
                <input type="tel" name="telefono" placeholder="Teléfono: *" />
                <div class="select">
                    <select name="estado">
                        <option value="" selected>Seleccione el Estado: *</option>
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California Sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Coahuila">Coahuila</option>
                        <option value="Colima">Colima</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Ciudad de México">Ciudad de México</option>
                        <option value="Durango">Durango</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="México">México</option>
                        <option value="Michoacán">Michoacán</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Querétaro">Querétaro</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosí">San Luis Potosí</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Yucatán">Yucatán</option>
                        <option value="Zacatecas">Zacatecas</option>
                    </select>
                </div>
                <div class="select">
                    <select name="fuente">
                        <option value="" selected>¿Cómo supo de nosotros? *</option>
                        <option value="Búsqueda en Google">Búsqueda en Google</option>
                        <option value="Redes Sociales">Redes Sociales</option>
                        <option value="Publicidad Impresa">Publicidad Impresa</option>
                        <option value="Visita de un Ejecutivo">Visita de un Ejecutivo</option>
                        <option value="Recomendación / Referencia">Recomendación / Referencia</option>
                        <option value="Mailing">Mailing</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <textarea name="mensaje" placeholder="Mensaje:"></textarea>
            </div>

            <div class="col-sm-4">
                <p>
                    <strong>IMPORTANTE:</strong><br/>
                    Los campos marcados con un * asterisco son obligatorios
                    para el envío de su mensaje.
                </p>
            </div>

            <div class="col-sm-4">
                <div class="g-recaptcha inline" data-sitekey="<?php echo captcha_front; ?>"></div>
            </div>
            <div class="col-sm-4">
                <input type="button" value="Enviar" id="frm-gral"/>
            </div>
        </div>
    </div>
</div>
<div class="h40"></div>

<?php
require_once 'includes/_share.php';?>

<div class="h40"></div>

<?php
require_once 'includes/_footer.php';?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
