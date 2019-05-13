<div id="formulario-leads">
    <div class="box">
        <div class="content">
            <div class="container">
                <div class="col-sm-12 tcenter">
                    <a href="javascript:;" class="cerrar-leads"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                    <h5>Envianos tus datos y nos pondremos en contacto a la brevedad.</h5>
                </div>
                <div class="h25"></div>
                <div class="formulario-informacion">
                    <div class="col-sm-4 col-sm-offset-2">
                        <input type="text" name="nombre" autocomplete="Nombre" placeholder="Nombre *" />
                        <input type="email" name="email" autocomplete="E-Mail" placeholder="Correo electrónico *" />
                        <input type="tel" name="telefono" autocomplete="Teléfono" placeholder="Teléfono *" />
                        <div class="select"><select name="estado"><option value="">Estado *</option> <option value="Aguascalientes">Aguascalientes</option> <option value="Baja California">Baja California</option> <option value="Baja California Sur">Baja California Sur</option> <option value="Campeche">Campeche</option> <option value="CDMX">CDMX</option> <option value="Coahuila">Coahuila</option> <option value="Colima">Colima</option> <option value="Chiapas">Chiapas</option> <option value="Chihuahua">Chihuahua</option> <option value="Durango">Durango</option> <option value="Estado de México">Edo México</option> <option value="Guanajuato">Guanajuato</option> <option value="Guerrero">Guerrero</option> <option value="Hidalgo">Hidalgo</option> <option value="Jalisco">Jalisco</option> <option value="Michoacán">Michoacán</option> <option value="Morelos">Morelos</option> <option value="Nayarit">Nayarit</option> <option value="Nuevo León">Nuevo León</option> <option value="Oaxaca">Oaxaca</option> <option value="Puebla">Puebla</option> <option value="Querétaro">Querétaro</option> <option value="Quintana Roo">Quintana Roo</option> <option value="San Luis Potosí">San Luis Potosí</option> <option value="Sinaloa">Sinaloa</option> <option value="Sonora">Sonora</option> <option value="Tabasco">Tabasco</option> <option value="Tamaulipas">Tamaulipas</option> <option value="Tlaxcala">Tlaxcala</option> <option value="Veracruz">Veracruz</option> <option value="Yucatán">Yucatán</option> <option value="Zacatecas">Zacatecas</option></select></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="select">
                            <select name="fuente">
                                <option value="">¿Cómo supiste de nosotros? *</option>
                                <option value="A través de Google">A través de Google</option>
                                <option value="Redes Sociales">Redes Sociales</option>
                                <option value="Publicidad Impresa">Publicidad Impresa</option>
                                <option value="Visita de un Ejecutivo">Visita de un Ejecutivo</option>
                                <option value="Recomendación / Referencia">Recomendación / Referencia</option>
                                <option value="Mailing">Mailing</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <textarea name="mensaje" placeholder="Mensaje" class="norequired"></textarea>
                    </div>


                    <div class="col-sm-12">
                        <input type="hidden" name="area" value="Contacto Web">
                        <input type="hidden" id="interes" name="interes" value="">
                        <div class="tcenter">
                            <div class="h10"></div>
                            <div class="g-recaptcha dib" data-sitekey="<?=captcha_front;?>"></div>
                            <div class="h10"></div>
                            <input id="frm-gral" type="button" value="Enviar" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>