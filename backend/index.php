<?php
include 'includes/_header.php';
$recovery = $_GET['recovery'];
if ($_SESSION['session'] == "admin") {
    echo "<script>window.location='" . base_url . "escritorio'</script>";
}
?>

<div class="container login">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 nopadding">
            <div class="row">
                <div class="col-lg-12 col-md-12 nopadding">
                    <div class="flashmsg">
                        <div class="logindisabled"><div class="warning"><div class="centerdiv"><div class="utilicons-white utilicons-warning"></div></div></div>
                            <div class="texto">
                                Su cuenta ha sido suspendida.<br/>
                                Contactar al coorporativo para más detalles.
                            </div>
                        </div>
                        <div class="loginfailed"><div class="warning"><div class="centerdiv"><div class="utilicons-white utilicons-warning"></div></div></div>							
                            <div class="texto">
                                Su usuario o contraseña son incorrectos.<br/>
                                Asegúrese que esten escritos correctamente.
                            </div>
                        </div>
                        <div class="loginsent"><div class="warning"><div class="centerdiv"><div class="utilicons-white utilicons-thumbsup"></div></div></div>
                            <div class="texto">
                                ¡Listo! Le hemos enviado un email con su nueva<br/>
                                contraseña de acceso al sistema.
                            </div>
                        </div>
                        <div class="loginrecovery"><div class="warning"><div class="centerdiv"><div class="utilicons-white utilicons-thumbsup"></div></div></div>
                            <div class="texto">
                                Su contraseña ha sido reestablecida correctamente,<br/>
                                ya puede ingresar al sistema.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 nopadding">
            <div class="row">
                <div class="col-lg-6 col-md-6 nopadding alpha">
                    <div class="logo"></div>
                </div>
                <div class="col-lg-6 col-md-6 nopadding omega">
                    <div class="graypart">
                        <div class="gpholder">
                            <?php if ($recovery != "") { ?>
                                <div class="loginfields">
                                    <form>
                                        <div class="logintitle">Cambio de contraseña.</div>Nueva Contraseña:<br/>
                                        <input id="recov1" name="new_pass" type="password" />
                                        <br/>Repetir Contraseña:<br/>
                                        <input id="recov2" name="new_pass_rep" type="password" />
                                        <input id="hash" name="hash" type="hidden" value="<?=$recovery;?>" />
                                        <div class="lostpass"><a id="regresar-login" href="<?=base_url;?>"> < Regresar al login</a></div>
                                        <div class="botonRecovery">Cambiar Contraseña</div>
                                    </form>
                                </div>
                            <?php } else { ?>
                                <div class="loginfields">
                                    <div class="logintitle">Acceso a su panel de cliente.</div>Nombre de usuario: <br/>
                                    <input id="usuario" type="email" name="usuario" autofocus="autofocus"/><br/>Contraseña: <br/>
                                    <input id="password" type="password" name="password"/>
                                    <div class="lostpass"><a href="javascript:;" id="getRecover">He olvidado mi contraseña<span class="utilicons-inherit utilicons-chevron-right"></span></a></div>
                                    <div class="botonIngresar">Ingresar</div>
                                </div>
                                <div class="recoverfields">
                                    <div class="logintitle">Restablecer la contraseña.</div>Para restablecer la contraseña,<br/>
                                    escriba el email que este vinculado<br/>
                                    a su cuenta de acceso.<br/>
                                    <div class="emaillabel">Email de acceso:</div>
                                    <input type="email" name="email" id="recuperaMail"/><br/>
                                    <div id="mandaEmail" class="botonIngresar">Recuperar</div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br/><br/><br/>
<script type="text/javascript" src="<?= base_url ?>js/login.js"></script>

<?php include 'includes/_footer.php' ?>
