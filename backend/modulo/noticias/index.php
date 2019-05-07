<?php
include '../../includes/_header.php';
$seccion_actual = "noticias";
include '../../includes/_session.php';
?>
<input type="hidden" id="eliminar" name="eliminar" class="norequired" />
<input type="hidden" id="ruta_imagen" value="../../../img/noticias/" class="norequired"/>
<input type="hidden" id="parent" class="norequired"/>
<input type="hidden" id="imagen-eliminar" class="norequired"/>

<div class="container models">
    <h1>
        <strong class="glyphicon glyphicon-bullhorn"></strong>Noticias
        <!--<a class="ordenar nuevo_menu" href="javascript:;"><span>Guardar</span></a>-->
        <a class="ordenar nuevo" href="javascript:;"><span>Nueva Noticia</span></a>
    </h1>
    <div class="row activeDiv">
        <div id="seccionTabla">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <section class="activeList">
                    <h2>Noticias Actuales</h2>
                    <table cellspacing="1" class="tablesorter">
                        <thead>
                            <tr>
                                <th style="width: 90%;">Nombre<span class="ordenholder"></span></th>
                                <th class="acciones padd">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="pager" class="pager">
                        <form>
                            <img src="<?=base_url?>img/first.png" class="first"/>
                            <img src="<?=base_url?>img/prev.png" class="prev"/>
                            <input type="text" class="pagedisplay" readonly/>
                            <img src="<?=base_url?>img/next.png" class="next"/>
                            <img src="<?=base_url?>img/last.png" class="last"/>
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
        </div>
        <div id="seccionEditable">
            <section class="activeModel form_usuario">
                <div class="col-sm-12">
                    <h2><span class="alea">Nueva</span> Noticia</h2>
                    <input type="hidden" id="editado" name="id" class="norequired"/>
                    <div class="row">
                        <div class="datos-usr">
                            <div class="col-sm-6">
                                <label>
                                    Título: *
                                    <input name="titulo" type="text" id="titulo" class="required" />
                                </label>

                                <div class="clearfix"></div>

                                <label>
                                    Texto introductorio: *
                                    <textarea name="intro" id="intro" class="required" ></textarea>
                                </label>

                                <div class="clearfix"></div>
                                <div id="foto-stand">
                                    <h5>Foto de portada:</h5>
                                    <form method="post" id="formulario" enctype="multipart/form-data" class="datos-usr">
                                        <input type="text" id="url-archivo" name="fotoportada"  />
                                        <label class="cargar">Subir</label>
                                        <input type="file" id="portada" name="portada" class="norequired"/>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div id="respuesta"></div>
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Texto noticia: *
                                    <textarea name="descripcion" id="descripcion"></textarea>
                                </label>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="salvarBton">
                                <div class="utilicons-inherit utilicons-save"></div>Guardar
                                <a href="javascript:;" class="nuevo_menu"></a>
                            </div>
                        </div>

                        <div class="col-md-12 nomevez errorHandle">
                            <div class="alert"></div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include '../../includes/_footer.php';?>
<script type="text/javascript" src="<?=base_url?>js/bundles/paginador/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?=base_url?>js/bundles/paginador/jquery.tablesorter.pager.js"></script>

<!-- TINYMCE -->
<script type="text/javascript" src="<?=base_url?>js/bundles/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    // tinymce.init({
    //     selector: "textarea",
    //     plugins: [
    //         "advlist autolink lists link image charmap print preview anchor",
    //         "searchreplace visualblocks code fullscreen",
    //         "insertdatetime media table contextmenu paste"
    //     ],
    //     toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    // });
    tinyMCE.init({
        selector: "#descripcion",
        mode: "textareas",
        plugins: "paste image link",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        theme_advanced_buttons3_add: "pastetext,pasteword,selectall",
        paste_auto_cleanup_on_paste: true
    });
</script>

<div id="alerta" style="display: none;" title="Eliminar Noticia">
    <p>¿Realmente desea eliminar este Noticia?</p>
</div>

<div id="alerta2" style="display: none;"title="Eliminar Imagen">
    <p>¿Desea eliminar la imagen?</p>
</div>

<!--//SUBIR IMAGENES POR DROPDOWN JS-->
<link href="<?=base_url?>js/bundles/dropfile/style.css" rel="stylesheet" />
<script src="<?=base_url?>js/bundles/dropfile/jquery.knob.js"></script>
<script src="<?=base_url?>js/bundles/dropfile/jquery.ui.widget.js"></script>
<script src="<?=base_url?>js/bundles/dropfile/jquery.iframe-transport.js"></script>
<script src="<?=base_url?>js/bundles/dropfile/jquery.fileupload.js"></script>
<script src="<?=base_url?>js/bundles/dropfile/script.js"></script>
<style type="text/css">
    body{background: #F4F0EC; min-width:330px;}
    #admin_secun ul{
    list-style:none;
    margin:0;
    padding:0;
    float: left;
}
    #admin_secun ul li{
display:block;
        background:#F6F6F6;
        border:1px solid #CCC;
        margin-top:3px;
        min-height:30px;
        padding:5px 7px;
        cursor: pointer;
    }
    #admin_secun .ui-state-highlight{ background:#FFF0A5; border:1px solid #FED22F}
    #admin_secun .msg{
        color: #0C0;
        font:normal 11px Tahoma; position: absolute; top: 2px;
        background: url("../images/info.png") no-repeat center right #BDE5F8;
        border: 1px solid #38AEE5;
        color: #00529B;
        padding: 10px;
        width: 302px;
        font-weight: bold;
        top: 2px;
        display: none;
    }

    #num{text-align: center;}
    #num li{margin-right: 2px;}
    #proyect{width: 285px;}
    #note{padding: 0px; margin-bottom: 10px;margin-top: 5px;}
</style>
<script>
    $(document).ready(function () {
        $("#gale").sortable({
            placeholder: "ui-state-highlight",
            cursor: 'move'
        });
        $("#gale").disableSelection();

        // ORDENAMIENTO DE DATOS DE LA TABLA
        $(".activeList table").tablesorter();
        // FILTRO DE DATOS PARA TABLA
        filtrar();

        // CAMBIO DE TEXTOS Y ACTIVACION DE DATOS DEPENDIENDO SI AGREGA NUEVO O EDITA
        var toggler = $('.nuevo');
        toggler.text('Nueva Noticia');

        toggler.click(function (e) {
            e.preventDefault();
            $('#seccionTabla').slideToggle('fast', function () {
                if ($(this).is(':visible')) {
                    $(".alea").text("Nuevo");
                    $(".salvarBton .nuevo_menu, .salvarBton .editar_menu").remove();
                    $(".salvarBton").append('<a href="javascript:;" class="nuevo_menu"></a>');
                }
            });
            $('#seccionEditable').slideToggle('fast', function () {
                var togglerLabel = $(this).is(':visible') ? 'Cerrar' : 'Nueva Noticia';
                if ($('#seccionEditable').is(':visible')) {
                    $(".nuevo").addClass("cerrar");
                    $(".ordenar.nuevo_menu").show("fast");
                } else {
                    $(".nuevo").removeClass("cerrar");
                    $(".ordenar.nuevo_menu").hide("fast");
                }
                toggler.text(togglerLabel);
            });
            resetAll();
        });

        // NUEVOS DATOS
        $(".salvarBton").on("click", ".nuevo_menu", function () {
            var content = tinyMCE.get('descripcion').getContent();
            $("#descripcion").val(content);
            $(this).fadeOut(400);
            $("#ajaxBusy").fadeIn(500);
            var pass = '1';
            var obj = {
                'accion': 'guardar'
            };
            $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function () {
                obj[$(this).attr('name')] = $(this).val();
                $(this).removeClass('error');
                if (($(this).val() === '') && (!$(this).hasClass('norequired'))) {
                    $(this).addClass('error');
                    pass = "0";
                    return false;
                }
            });

            var order = "";
            $('#gale li a').each(function () {
                order = order + "**" + $(this).attr("rel");
            });

            if (order === undefined) {
                pass = "0";
            } else {
                obj['galeria'] = order;
            }

            if (pass !== "0") {
                $("#ajaxBusy").fadeOut(500);
                $(".salvarBton .nuevo_menu").fadeIn(400);
                console.log(obj)
                $.post('consultas.php', obj, function (data) {
                    tinyMCE.activeEditor.setContent('');
                    $("#gale").html("");
                    $("#ajaxBusy").fadeOut(500);
                    $(".salvarBton .nuevo_menu").fadeIn(400);
                    $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function () {
                        $(this).val("");
                    });
                    resetAll();
                    filtrar();
                    hideTables();
                });
            } else {
                $("#ajaxBusy").fadeOut(500);
                $(".salvarBton .nuevo_menu").fadeIn(400);
            }
        });

        // CARGAR EDICION DE DATOS
        $('.activeList').on("click", ".editarElemento", function () {
            var id = $(this).attr("rel");
            resetAll();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "consultas.php",
                data: ({accion: "consultar", id: id}),
                success: function (data) {
                    // CAMBIAR BOTONES PARA EDICION
                    hideTables();

                    $(".alea").text("Editar");
                    $(".salvarBton .nuevo_menu, .salvarBton .editar_menu").remove();
                    $(".salvarBton").append('<a href="javascript:;" class="editar_menu"></a>');

                    $('#titulo').val(data[0].titulo);
                    $('#intro').val(data[0].intro);
                    $('#url-archivo').val(data[0].portada);
                    $("#respuesta").html("<img src='../../../img/noticias/" + data[0].portada + "' class='foto-portada'>");
                    tinyMCE.get('descripcion').setContent(data[0].descripcion);
                    $("#LabAutor").hide();

                }
            });
        });

        // GUARDAR EDICION DE DATOS
        $(".salvarBton").on("click", ".editar_menu", function () {
            $(this).fadeOut(400);
            $("#ajaxBusy").fadeIn(500);

            var content = tinyMCE.get('descripcion').getContent();
            $("#descripcion").val(content);

            var pass = '1';
            var obj = {
                'accion': 'editar'
            };

            $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function () {
                obj[$(this).attr('name')] = $(this).val();
                $(this).removeClass('error');
                if (($(this).val() === '') && (!$(this).hasClass('norequired'))) {
                    $(this).addClass('error');
                    pass = "0";
                    return false;
                }
            });

            var order = "";
            $('#gale li a').each(function () {
                order = order + "**" + $(this).attr("rel");
            });

            var remimg = $("#imagen-eliminar").val();
            if (remimg !== "") {
                obj['remimg'] = remimg;
            }

            if (order === undefined) {
                pass = "0";
            } else {
                obj['galeria'] = order;
            }

            if (pass !== "0") {
                $.post('consultas.php', obj, function (data) {
                    $("#ajaxBusy").fadeOut(500);
                    // CAMBIAR BOTONES PARA EDICION
                    $(".alea").text("Nuevo");
                    $(".salvarBton .nuevo_menu, .salvarBton .editar_menu").remove();
                    $(".salvarBton").append('<a href="javascript:;" class="nuevo_menu"></a>');
                    resetAll();
                    filtrar();
                    hideTables();

                    console.log(data);
                });

            } else {
                $("#ajaxBusy").fadeOut(500);
                $(".editar_menu").fadeIn(400);
            }
        });

        // MOSTRAR DATOS EN EL FRONT
        $('.activeList').on("click", ".verStand", function () {
            var id = $(this).attr("id");
            var activo = $(this).attr("rel");
            var obj = {
                'accion': 'ver',
                'id': id,
                'activo': activo
            };

            $.post('consultas.php', obj, function (data) {
                filtrar();
            });
        });


        // DESTACADO EN EL FRONT
        $('.activeList').on("click", ".destacar", function () {
            var id = $(this).attr("id");
            var activo = $(this).attr("rel");
            var obj = {
                'accion': 'destacar',
                'id': id,
                'activo': activo
            };

            $.post('consultas.php', obj, function (data) {
                filtrar();
            });
        });

        // ELIMINAR DATOS

        $(".activeList").on("click", ".eliminaElemento", function (event) {
            event.preventDefault();
            $("#alerta").dialog("open");
            var rem = $(this).attr("rel");
            $("#eliminar").val(rem);
        });

        $("#alerta").dialog({
            autoOpen: false,
            draggable: false,
            modal: true, width: "auto",
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
                click: function () {
                    $("#ajaxBusy").show();
                    var id = $("#eliminar").val();

                    var obj = {
                        'accion': 'eliminar',
                        'id': id
                    };

                    $.post('consultas.php', obj, function (data) {
                        filtrar();
                        $("#ajaxBusy").fadeOut(500);
                    });

                    $(this).dialog("close");
                }
            }, {
                text: "Cancelar",
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });

        // ELIMINAR IMAGEN
        $("#gale").on("click", ".eliminar", function (event) {
            event.preventDefault();
            var elim = $("#imagen-eliminar").val();
            elim = elim + "**" + $(this).attr("rel");

            var cont = $(this).parent().parent().parent();

            $("#alerta2").dialog({
                autoOpen: true,
                draggable: false,
                modal: true, width: "auto",
                show: {
                    effect: "fade",
                    duration: 300
                },
                hide: {
                    effect: "fade",
                    duration: 100
                },
                buttons: [{
                    text: "Eliminar",
                    click: function () {
                        cont.remove();
                        $("#imagen-eliminar").val(elim);
                        $(this).dialog("close");
                    }
                }, {
                    text: "Cancelar",
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
            });
        });

        // FILTRAR DATOS LISTADO DE LA TABLA PRINCIPAL
        function filtrar() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "consultas.php",
                data: ({
                    accion: "listar"
                }),
                success: function (data) {
                    var html = '';
                    if (data.length > 0) {
                        var z = "0";
                        $.each(data, function (i, item) {
                            var desactivado = "";
                            if (item.status === "1") {
                                desactivado = "stat";
                            } else {
                                desactivado = "";
                            }
                            var destacado = "";
                            if(item.destacado === "1"){
                                destacado = "activeDes";
                            }else{
                                destacado = "";
                            }
                            html += '<tr class="activeRow">';
                            html += '<td style="width: 90%;">' + item.titulo + '</td>';
                            html += '<td style="width: 10%;" ><div class="utilicons-inherit utilicons-editar editarElemento" rel="' + item.id + '" title="Editar"></div><div class="ver-ico verStand ' + desactivado + '" rel="' + item.status + '" id="' + item.id + '" title="Mostrar"></div><i class="glyphicon glyphicon-star destacar '+ destacado +'" title="Destacar" rel="'+item.destacado+'" id="' + item.id + '"></i><div class="utilicons-inherit utilicons-borrar eliminaElemento" rel="' + item.id + '" title="Eliminar"></div></td>';
                            html += '</tr>';
                            z++;
                        });
                    }

                    if (html === '')
                        html = '<tr><td colspan="8" align="center">No se encontraron registros..</td></tr>';
                    $(".activeList table tbody").html(html);

                    $(".activeList table").trigger("update");
                    // set sorting column and direction, this will sort on the first and third column
                    var sorting = [[2, 1], [0, 0]];
                    // sort on the first column
                    $(".activeList table").trigger("sorton", [sorting]).tablesorterPager({container: $("#pager")});

                }
            });
        }

        // DEJA EN BLANCO LOS INPUT SELECT O TEXTAREAS
        function resetAll() {
            tinyMCE.get('descripcion').setContent('');
            $("#gale, #respuesta").html("");
            $("#imagen-eliminar, #url-archivo").val("");
            $('.datos-usr input, .datos-usr textarea, .datos-usr select').each(function () {
                $(this).val("");
            });
        }

        // HACE EL TOGGLE DE LOS DATOS QUE SE SOLICITEN SHOW / HIDE
        function hideTables() {
            $('#seccionTabla, #seccionEditable').slideToggle('fast', function () {
                var togglerLabel = $('#seccionEditable').is(':visible') ? 'Cerrar' : 'Nueva Noticia';
                if ($('#seccionEditable').is(':visible')) {
                    $(".nuevo").addClass("cerrar");
                    $(".ordenar.nuevo_menu").show("fast");
                } else {
                    $(".nuevo").removeClass("cerrar");
                    $(".ordenar.nuevo_menu").hide("fast");
                }
                toggler.text(togglerLabel);
            });
        }

        // CARGA LA IMAGEN PRINCIPAL DE PORTADA
        $("#portada").on("change", function () {
            var formData = new FormData($("#formulario")[0]);
            $('#url-archivo').val($(this).val());
            var ruta = "ajax-imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    $("#respuesta").html(datos);
                    $("#url-archivo").val($(".foto-portada").attr('rel'));
                }
            });
        });

    });
</script>