$(document).ready(function () {
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    // GENERAL PARA PAGINA ATRAS
    $('.regresar').click(function () {
        window.history.back();
    });

    // REMOVER CLASE ERROR //
    $('input, textarea').keyup(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
            return false;
        }
    });
    
    $('select').change(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
            return false;
        }
    });


    // ABRE EL MODAL
    $(".me-interesa").click(function(){
        var interes = $(this).data("interes");
        $("#formulario-leads").fadeIn();
        $("body").addClass("no-scroll");
        $(".interesado-en").text(interes);
        $("#interes").val(interes);
    });

    $(".cerrar-leads").click(function(){
        $("#formulario-leads").fadeOut();
        $("body").removeClass("no-scroll");
    });

    // MENU
    $(".menu-mobil").click(function () {
        $(".menu-main").slideToggle();
        $("body").addClass("no-scroll");
    });
    $(".closebtn").click(function () {
        $(".menu-main").slideToggle();
        $("body").removeClass("no-scroll");
    });

    // MAGNIFIC POP UP
    // A UN CONTENEDOR EN ESPECIFICO CON VARIAS FOTOS
    $('.galerias, .galeria').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            mainClass: 'mfp-with-zoom',
            gallery: {
                enabled: true // read about this option in next Lazy-loading section
            }
        });
    });
    
    // A UN LINK EN ESPECIFICO
    $(".lb-link").magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        gallery: {
            enabled: true // read about this option in next Lazy-loading section
        }
    });

    //VALIDACION DE FORMULARIO
    $("#frm-gral").click(function () {
        $("#frm-gral").fadeOut();
        $("#ajaxBusy").fadeIn(300);
        var pass = "1";
        var obj = {
            'accion': 'contacto',
            'forma': 'solicitar'
        };
        
        $('.formulario-informacion input, .formulario-informacion textarea, .formulario-informacion select').each(function () {
            var data = $(this).val();
            if (data !== "") {
                obj[$(this).attr('name')] = data;
            }
            $(this).removeClass('error');
            if (data === '' && (!$(this).hasClass('norequired'))) {
                $(this).addClass('error');
                pass = "0";
                return false;
            }
        });

        if (pass !== "0") {
            $.post($url + 'includes/_functions.php', obj, function (data) {
                if (data.status === "bad") {
                    $("#ajaxBusy").fadeOut(300);
                    $("#frm-gral").fadeIn();
                }else{
                    window.location.replace($url+"thanks");
                }
            });
        }else{
            $("#ajaxBusy").fadeOut(300);
            $("#frm-gral").fadeIn();
        }
    });

    // LOADER FULL SCREEN
    $('body').append('<div id="ajaxBusy"><div class="ui-widget-overlay"></div><img src="' + $url + 'img/load.gif">      </div>');

    $('#ajaxBusy').css({
        display: "none",
        position: "fixed",
        top: "0px",
        left: "0px",
        height: $(window).height(),
        width: "100%",
        backgroundColor: "#fff",
        textAlign: "center",
        zIndex: "999"
    });

    $('#ajaxBusy img').css({
        paddingTop: "17%"
    });

    $('.select').append('<i class="fas fa-chevron-down"></i>');


    $( "#destino" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
            url: $url + "includes/_destinos.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                search: request.term
            },
            success: function( data ) {
                response( data );
            }
        });
    },
    select: function (event, ui) {
        $('#destino').val(ui.item.label); 
        $('#valor').val(ui.item.value); 
        return false;
    }
});


    function dinamico(){
        var head = $("#header-main").innerHeight();
        var footer = $("#footer-main").innerHeight();
        var ventana = $(window).height();
        var final = ventana - (head+footer);
        
        if($(".dinamico").innerHeight() < final ){
            $(".dinamico").innerHeight(final);
        }
    }

    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    })

    //DATE PICKER
    //    $(".datepicker").datepicker({
    //        minDate: "+0D",
    //        closeText: 'Cerrar',
    //        prevText: '<Ant',
    //        nextText: 'Sig>',
    //        currentText: 'Hoy',
    //        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    //        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    //        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    //        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    //        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    //        weekHeader: 'Sm',
    //        dateFormat: 'd MM yy',
    //        firstDay: 0,
    //        isRTL: false,
    //        showMonthAfterYear: false,
    //        yearSuffix: ''
    //    });
});