<?php
include '../../includes/_header.php';
$seccion_actual = "usuarios";
include '../../includes/_session.php';
?>
<input type="hidden" id="eliminar" name="eliminar" class="norequired" />
<div class="container models">
    <h1>
        <div class="utilicons-inherit utilicons-user"></div> Usuarios
    </h1>
    <div class="row activeDiv">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <section class="activeList">
                <h2><span class="alea">Usuarios</span> Activos</h2>
                <table cellspacing="1" class="tablesorter">
                    <thead>
                        <tr>
                            <th style="width: 55%;">Nombre<span class="ordenholder"></span></th>
                            <th class="hidden-xs" style="width: 30%;">Tipo <span class="hidden-sm">Usuario</span><span class="ordenholder"></span></th>
                            <th class="acciones" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="pager" class="pager">
                    <form>
                        <img src="<?= base_url ?>img/first.png" class="first"/>
                        <img src="<?= base_url ?>img/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay" readonly/>
                        <img src="<?= base_url ?>img/next.png" class="next"/>
                        <img src="<?= base_url ?>img/last.png" class="last"/>
                        <select class="pagesize">
                            <option selected="selected"  value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option  value="40">40</option>
                        </select>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <section class="activeModel form_usuario">
                <h2><span class="alea">Nueva</span> Alta nuevo usuario</h2>
                <input type="hidden" id="editado" name="id" class="norequired"/>
                <div class="row">
                    <div class="datos-usr">
                        <div class="col-sm-6">
                            <label>
                                Nombre: *
                                <input name="nombre" type="text" id="nombre" class="required" autofocus />
                            </label>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6">
                                    <label>
                                        Usuario: *
                                        <input name="usuario" id="usuario" type="email" class="required" />
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6">
                                    <label>
                                        Contraseña: *
                                        <input name="password" type="password" id="password" class="required" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>
                                E-mail: *
                                <input name="correo" type="email" id="email" class="required" />
                            </label>

                            <label>
                                Nivel de Usuario: *
                                <select name="nivel" id="nivel" class="required">
                                    <option value="">Seleccionar</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Editor</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="seccions">
                        <div class="col-sm-12">
                            <label class="cinp flab"><input id="todos-cb" type="checkbox" name="seccion" value="todos" />Todos</label>
                        </div>
                        <div class="clearfix"></div>
<!--                        Aqui se definen los nombres de las secciones que se guardaran en la base de datos, estas no deben cambiar
                        en el futuro asi que una vez nombradas y guardadas solo se podra acceder al modulo tal cual el nombre-->
                        <div class="seccions-ind">
                            <div class="col-sm-4">
                                <label class="cinp"><input type="checkbox" name="seccion" value="noticias" />Noticias</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="cinp"><input type="checkbox" name="seccion" value="productos" />Productos</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="cinp"><input type="checkbox" name="seccion" value="secciones" />Secciones</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="cinp"><input type="checkbox" name="seccion" value="slides" />Slides</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="cinp"><input type="checkbox" name="seccion" value="vacantes" />Vacantes</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 nomevez errorHandle">
                        <div class="alert"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="salvarBton">
                            <div class="utilicons-inherit utilicons-save"></div>Guardar
                            <a href="javascript:;" class="nuevo_usuario"></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include '../../includes/_footer.php' ?>
<script type="text/javascript" src="<?= base_url ?>js/bundles/paginador/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?= base_url ?>js/bundles/paginador/jquery.tablesorter.pager.js"></script>

<div id="alerta" style="display: none;"title="Eliminar Prospecto">
    <p>¿Realmente desea eliminar este usuario?</p>
</div>
<script>
    $(document).ready(function() {
        $(".activeList table").tablesorter().tablesorterPager({container: $("#pager")});
        filtrarUsuarios();
        // NUEVO USUARIO
        $(".salvarBton").on("click", ".nuevo_usuario", function() {
            $(this).fadeOut(400);
            $("#ajaxBusy").fadeIn(500);
            var pass = '1';
            var secciones = '';
            var obj = {
                'accion': 'guardar_usuario'
            };

            $('input, textarea, select').each(function() {
                obj[$(this).attr('name')] = $(this).val();

                $(this).removeClass('error');
                if (($(this).val() === '') && (!$(this).hasClass('norequired'))) {
                    $(this).addClass('error');
                    pass = "0";
                    return false;
                }
            });

            var secciones = "escritorio";
            var fields = $("input[name='seccion']").serializeArray();
            if (fields.length === 0) {
                alert('Seleccione uno o más modulos.');
                pass = "0";
            } else if ($("#todos-cb").is(":checked")) {
                secciones = $("#todos-cb").val();
            } else {
                $("input[name='seccion']:checked").each(function() {
                    secciones += "-" + $(this).val();
                });
            }

            obj['secciones'] = secciones;

            if (!emailreg.test($("#email").val())) {
                $("#email").addClass('error');
                pass = "0";
            }

            if (pass !== "0") {
                $("#ajaxBusy").fadeOut(500);
                $(".nuevo_usuario").fadeIn(400);
                $.post('consultas.php', obj, function(data) {
                    $("#ajaxBusy").fadeOut(500);
                    $(".nuevo_usuario").fadeIn(400);
                    $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function() {
                        $(this).val("");
                    });
                    $('input[type=checkbox]').prop('checked', false);
                    filtrarUsuarios();
                });
            } else {
                $("#ajaxBusy").fadeOut(500);
                $(".nuevo_usuario").fadeIn(400);
            }
        });

        // CARGAR EDICION USUARIO
        $('.activeList').on("click", ".editarElemento", function() {
            var id = $(this).attr("rel");
            $('input[name=seccion]').prop('checked', false);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "consultas.php",
                data: ({accion: "consultar_usuario", id: id}),
                success: function(data) {
                    // CAMBIAR BOTONES PARA EDICION
                    $(".alea").text("Editar");
                    $(".nuevo_usuario, .editar_usuario").remove();
                    $(".salvarBton").append('<a href="javascript:;" class="editar_usuario"></a>');
                    $('#nombre').val(data[0].nombre);
                    $('#email, #remail').val(data[0].email);
                    $('#usuario').val(data[0].usuario);
                    $('#password').val(data[0].password);
                    $('#nivel').val(data[0].nivel);
                    $('#editado').val(data[0].id);
                    if (data[0].nivel === '1') {
                        $('.seccions').hide();
                    } else {
                        $('.seccions').slideDown();
                    }
                    var secciones = data[0].secciones;

                    if (secciones === "todos") {
                        $('#todos-cb').prop('checked', true);
                        $('.seccions-ind').hide(100);

                    } else {
                        $('.seccions-ind').slideDown(100);
                        var arr = secciones.split('-');
                        jQuery.each(arr, function(i, val) {
                            $("input[name='seccion']").each(function() {
                                if ($(this).val() === val) {
                                    $(this).prop('checked', true);
                                }
                            });
                        });
                    }
                }
            });
        });

        // GUARDAR EDICION USUARIO
        $(".salvarBton").on("click", ".editar_usuario", function() {
            $(this).fadeOut(400);
            $("#ajaxBusy").fadeIn(500);
            var pass = '1';
            var obj = {
                'accion': 'editar_usuario'
            };

            $('input, textarea, select').each(function() {
                obj[$(this).attr('name')] = $(this).val();

                $(this).removeClass('error');
                if (($(this).val() === '') && (!$(this).hasClass('norequired'))) {
                    $(this).addClass('error');
                    pass = "0";
                    return false;
                }
            });

            var secciones = "escritorio";
            var fields = $("input[name='seccion']").serializeArray();
            if (fields.length === 0) {
                alert('Seleccione uno o más modulos.');
                pass = "0";
            } else if ($("#todos-cb").is(":checked")) {
                secciones = $("#todos-cb").val();
            } else {
                $("input[name='seccion']:checked").each(function() {
                    secciones += "-" + $(this).val();
                });
            }

            obj['secciones'] = secciones;

            if (!emailreg.test($("#email").val())) {
                $("#email").addClass('error');
                pass = "0";
            }

            if (pass !== "0") {
                $.post('consultas.php', obj, function(data) {
                    $("#ajaxBusy").fadeOut(500);
                    // CAMBIAR BOTONES PARA EDICION
                    $(".alea").text("Nuevo");
                    $(".nuevo_usuario, .editar_usuario").remove();
                    $(".salvarBton").append('<a href="javascript:;" class="nuevo_usuario"></a>');

                    $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function() {
                        $(this).val("");
                    });

                    $('input[type=checkbox]').prop('checked', false);
                    $('.seccions').slideUp();
                    filtrarUsuarios();
                });
            } else {
                $("#ajaxBusy").fadeOut(500);
                $(".editar_usuario").fadeIn(400);
            }
        });

        $(".activeList").on("click", ".eliminaElemento", function(event) {
            event.preventDefault();
            $("#alerta").dialog("open");
            var rem = $(this).attr("rel");
            $("#eliminar").val(rem);
        });

        $("#alerta").dialog({
            autoOpen: false,
            draggable: false,
            modal: true,
            width: "auto",
            show: {
                effect: "fade",
                duration: 300
            },
            hide: {
                effect: "fade",
                duration: 100
            },
            buttons: [{
                    text: "Confirmar",
                    click: function() {
                        $("#ajaxBusy").show();
                        var id = $("#eliminar").val();

                        var obj = {
                            'accion': 'eliminar_usuario',
                            'id': id
                        };

                        $.post('consultas.php', obj, function(data) {
                            filtrarUsuarios();
                            $("#ajaxBusy").fadeOut(500);
                        });

                        $(this).dialog("close");
                    }
                }, {
                    text: "Cancelar",
                    click: function() {
                        $(this).dialog("close");
                    }
                }]
        });

        function filtrarUsuarios() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "consultas.php",
                data: ({
                    accion: "listar_usuarios"
                }),
                success: function(data) {
                    var html = '';
                    if (data.length > 0) {
                        var z = "0";
                        $.each(data, function(i, item) {
                            html += '<tr class="activeRow">';
                            html += '<td style="width: 55%;">' + item.nombre + '</td>';
                            html += '<td style="width: 30%;" class="hidden-xs">' + item.nivel + '</td>';
                            html += '<td style="width: 15%;"><div class="utilicons-inherit utilicons-editar editarElemento" rel="' + item.id + '" title="Editar"></div><div class="utilicons-inherit utilicons-borrar eliminaElemento" rel="' + item.id + '" title="Eliminar"></div></td>';
                            html += '</tr>';
                            z++;
                        });
                    }
                    if (html === '')
                        html = '<tr><td colspan="8" align="center">No se encontraron registros..</td></tr>';
                    $(".activeList table tbody").html(html);
                    $(".activeList table").trigger("update");
                    return false;
                }
            });
        }

        // OPCIONES POR NIVEL DE USUARIO
        $(".activeModel").on('click', '#todos-cb', function() {
            if ($(this).is(':checked')) {
                $('.seccions-ind').slideUp(100);
                $('.seccions-ind input[type=checkbox]').prop('checked', false);
            } else {
                $('.seccions-ind input[type=checkbox]').prop('checked', false);
                $('.seccions-ind').slideDown(100);
            }
        });

        $('.activeModel select').change(function() {
            if ($(this).val() !== '') {
                $(this).removeClass('error');
            }
            if ($(this).attr('name') === 'nivel' && $(this).val() === '1') {
                $('#todos-cb').prop('checked', true);
                $('.seccions').slideUp();
            } else if ($(this).attr('name') === 'nivel' && $(this).val() === '2') {
                $('.seccions-ind input[type=checkbox], #todos-cb').prop('checked', false);
                $('.seccions').slideDown();
            } else {
                $('.seccions').slideUp();
            }
        });
    });

</script>