<?php
include 'includes/_funciones.php';
    $para = $row['correo_usr'];
    $de = 'Genotipo <soporte@genotipo.com>';
    $subjet = 'Cambio de contraseña Nanodepot CRM.';
    $tipo = 'Cambio de contraseña';
    $titulo = 'Cambio de contraseña exitoso.';
    $msg = '
           Estimado(a) <strong>' . $row['nombre_usr'] . '</strong> su cambio de contraseña se ha realizado con &eacute;xito.
           <br/><br/>
           Si usted no ha realizado este proceso favor de contactarse al corporativo para la verificaci&oacute;n de su cuenta.
           <br/><br/>
           Que tenga buen d&iacute;a.';
    $logo = base_url."img/logo_header.png";
    $link = base_url;
    $tlink = "backend.revistaequipar.com";

    $destinatario = $para;
    $asunto = $subjet;
    $color = "#303030";
    echo $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>Documento sin título</title>
                    </head>
                    <body style="background-color: #ddd;">
                        <table id="pageContainer" width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; background-repeat:repeat; "> 
                            <tbody>
                                <tr> 
                                    <td style="padding:30px 20px 40px 20px;"> 
                                        <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                                            <tbody> 
                                                <tr> 
                                                    <td bgcolor="'.$color.'" colspan="2" height="7" style="font-size:2px; line-height:0px;">
                                                        <img alt="" height="7" src="http://www.genotipo.com/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td bgcolor="'.$color.'" width="255" valign="middle" style="padding:25px 28px 25px 28px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:'.$color.';"> 
                                                        <a href="http://www.genotipo.com/"><img alt="Logo" src="' . $logo . '" align="left" border="0" vspace="0" hspace="0" style="display:block;"> </a>
                                                    </td> 
                                                    <td bgcolor="'.$color.'" width="255" valign="middle" style="padding:20px 20px 15px 0; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:100%; color:#777777; text-align:right;"> 
                                                        <table width="254" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;"> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td width="66" valign="top" style="line-height:100%; color:#fff;"> 
                                                                        <img alt="●" src="http://www.genotipo.com/img/mail/calendarIcon.png" height="32" width="32" border="0" vspace="0" hspace="17" style="display:block;"> 
                                                                            ' . ucfirst(strftime("%b %d")) . ' 
                                                                    </td> 
                                                                    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
                                                                        <img alt="" src="http://www.genotipo.com/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
                                                                    </td> 
                                                                    <td width="64" valign="top" style="line-height:100%;"> 
                                                                        <a href="mailto:' . $de . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
                                                                            <img alt="●" src="http://www.genotipo.com/img/mail/forwardIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;"> 
                                                                                Responder
                                                                        </a> 
                                                                    </td> 
                                                                    <td width="20" style="padding:0 10px; line-height:100%; text-align:center;">
                                                                        <img alt="" src="http://www.genotipo.com/img/mail/separatorw.png" width="20" height="50" border="0" style="vertical-align:0px; display:block;">
                                                                    </td> 
                                                                    <td width="54" valign="top" style="line-height:100%;"> 
                                                                        <a href="' . $link . '" style="text-decoration:none; color:#fff; display:block; line-height:100%;">
                                                                            <img alt="●" src="http://www.genotipo.com/img/mail/websiteIcon.png" height="32" width="32" border="0" vspace="0" hspace="11" style="display:block;"> 
                                                                                Backend
                                                                        </a> 
                                                                    </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td colspan="2" height="11" style="font-size:2px; line-height:0px;">
                                                        <img alt="" src="http://www.genotipo.com/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 

                                        <table bgcolor="#ffffff" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                                            <tbody>
                                                <tr> 
                                                    <td style="padding-top:20px; padding-right:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#aaaaaa;"> 
                                                        <img alt="" src="http://www.genotipo.com/img/mail/dateIcon.png" height="14" width="12" border="0" vspace="0" hspace="0" style="vertical-align:-1px;" />&nbsp;&nbsp; ' . date("d.m.y") . ' &nbsp;&nbsp;
                                                        <img alt="" src="http://www.genotipo.com/img/mail/categoryIcon.png" height="14" width="15" border="0" vspace="0" hspace="0" style="vertical-align:-2px;" />&nbsp;&nbsp; ' . $tipo . ' 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding-top:20px; padding-right:40px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                        <p style="font-family: Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif; font-size:30px; line-height:30pt; color:#3b5167; font-weight:300; margin-top:0; margin-bottom:20px !important; padding:0; text-indent:-3px;">' . $titulo . '</p> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding-right:30px; padding-bottom:30px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;">   
                                                        ' . $msg . '
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td height="11" style="font-size:2px; line-height:0px;">
                                                        <img alt="" src="http://www.genotipo.com/img/mail/divider.png" height="11" width="600" align="left" border="0" vspace="0" hspace="0" style="display:block;">
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                        <table bgcolor="#f4f4f4" width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                                            <tbody>
                                                <tr> 
                                                    <td> 
                                                        <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777;"> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td width="30">
                                                                        <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                                    </td> 
                                                                    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                                        Copyright &COPY; ' . date("Y") . '<br/>
                                                                        <a style="text-decoration:underline; color:'.$color.';" href="' . $link . '">' . $tlink . '</a> 
                                                                        <br/>
                                                                        All rights reserved.
                                                                    </td> 
                                                                    <td width="30">
                                                                        <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                                    </td> 
                                                                    <td width="160" valign="top" style="padding-top:34px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:100%; color:#777777;"> 
                                                                            <tbody>
                                                                                <tr> 
                                                                                    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
                                                                                        <img alt="●" src="http://www.genotipo.com/img/mail/homeIcon.png" width="13" height="12" border="0" align="left" style="display:block;">
                                                                                    </td> 
                                                                                    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;"> 
                                                                                        <a href="' . $link . '" style="text-decoration:underline; color:'.$color.'; line-height:9pt;"> ' . $tlink . '</a> 
                                                                                    </td> 
                                                                                </tr> 
                                                                                <tr> 
                                                                                    <td class="footer_list_image" width="20" valign="top" style="padding:0 0 9px 0;">
                                                                                        <img alt="●" src="http://www.genotipo.com/img/mail/emailIcon.png" width="12" height="12" border="0" align="left" style="display:block;">
                                                                                    </td> 
                                                                                    <td class="footer_list" width="140" valign="top" style="padding:0 0 9px 0; line-height:9pt;"> 
                                                                                        <a href="mailto:' . $de . '" style="text-decoration:underline; color:'.$color.'; line-height:9pt;"> ' . $de . '</a> 
                                                                                    </td> 
                                                                                </tr> 
                                                                                <tr> 
                                                                                    <td class="socialIcons" colspan="2" style="padding-top:17px; padding-bottom:5px;"> 
                                                                                        <a href="http://www.facebook.com/Nanotecnologia.Mexico"><img alt="Facebook" src="http://www.genotipo.com/img/mail/facebookIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp; 
                                                                                        <a href="https://twitter.com/nano_depot"><img alt="Twitter" src="http://www.genotipo.com/img/mail/twitterIcon.png" border="0" vspace="0" hspace="0"></a>&nbsp;&nbsp; 
                                                                                    </td> 
                                                                                </tr> 
                                                                            </tbody>
                                                                        </table> 
                                                                    </td> 
                                                                    <td width="30">
                                                                        <img alt="" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                                    </td> 
                                                                    <td width="160" valign="top" style="padding-top:30px; padding-bottom:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#777777;"> 
                                                                        <strong>Email de Notificación</strong><br/> Estos emails unicamente son para referencias futuras.<br/><br/>
                                                                    </td> 
                                                                    <td width="30">
                                                                        <img alt="·" height="10" src="http://www.genotipo.com/img/mail/blank.gif" width="30" align="left" vspace="0" hspace="0" border="0" style="display:block;">
                                                                    </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td bgcolor="'.$color.'" height="7" style="font-size:2px; line-height:0px;"><img alt="" height="7" src="http://www.genotipo.com/img/mail/blank.gif" width="600" align="left" vspace="0" hspace="0" border="0" style="display:block;"></td> 
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </body>
                </html>
                ';
?>
