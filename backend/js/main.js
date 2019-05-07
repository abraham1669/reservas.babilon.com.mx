$(document).ready(function () {
    // REMOVER CLASES //
    $('input, textarea').keyup(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
            return false;
        }
    });

    $('select').change(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
        }
    });


    // LOADING //
    $('body').append('<div id="ajaxBusy"><div class="overlay"></div><img src="' + $url + 'img/wait.gif"><br/><p>Espere por favor...</p></div>');
    $('#ajaxBusy').css({height: $(document).height()});



});

var ajaxWorking, armalostelefonos, categoriaSelect, displayError, drawTelephones, fromLogin, invisible, logoupload, reloadData, reloadList, reloadModel, salvarAction, urlsafe, visible, __indexOf = [].indexOf || function (c) {
    for (var b = 0, a = this.length; b < a; b++) {
        if (b in this && this[b] === c) {
            return b
        }
    }
    return -1
};
fromLogin = function () {
    return location.reload()
};
ajaxWorking = function (a) {
    $("body").append($("<div/>", {id: "ajaxBusy"}).append($("<div/>", {"class": "conte"}).append($("<img/>", {src: $url + "public/images/layout/loading.gif"})), $("<div/>", {"class": "ui-widget-overlay"})));
    $("#ajaxBusy").css({display: "table", position: "fixed", top: "0px", left: "0px", height: $(window).height(), width: $(window).width(), textAlign: "center"});
    $("#ajaxBusy .conte").css({position: "relative", display: "table-cell", "vertical-align": "middle"});
    return $("#ajaxBusy img").css({"vertical-align": "middle"})
};
logoupload = function (a) {
    $("#ajaxBusy").remove();
    if (a.Estatus === "Ok") {
        $("#" + a.reload).attr({src: $url + a.Path});
        return $("#" + a.reload + "Input").val(a.Path)
    } else {
        $("#errorHandle").html(a.Desc);
        return $("#errorHandle").dialog({modal: true, title: "Error", buttons: {Cerrar: function () {
                    return $(this).dialog("close")
                }}})
    }
};
visible = function (a) {
    a.css({visibility: "visible"});
    return a.animate({opacity: 1}, 0)
};
invisible = function (a) {
    a.css({visibility: ""});
    return a.animate({opacity: 0}, 0)
};
displayError = function (a, b) {
    $(".errorHandle div").removeClass("alert-danger, alert-warning").addClass(b).text(a);
    return $(".errorHandle").fadeIn(function () {
        var c;
        return c = setTimeout(function () {
            return $(".errorHandle").fadeOut(500)
        }, 2000)
    })
};
salvarAction = function (e) {
    var a, b, d, f, c, g;
    f = {};
    a = {};
    b = false;
    c = "";
    e.closest("section").find("input, select, textarea").each(function () {
        var h;
        if ($(this).val() === "" && $(this).hasClass("required")) {
            b = true;
            c = "Todos los campos marcados son requeridos"
        }
        h = $(this).attr("name");
        if (f[h] != null) {
            if (a[h] == null) {
                a[h] = []
            }
            if ($(this).attr("type") === "checkbox") {
                if ($(this).is(":checked")) {
                    a[h].push($(this).val())
                }
            } else {
                a[h].push($(this).val())
            }
            if (f[h] !== "placeholder") {
                a[h].unshift(f[h]);
                f[h] = "placeholder"
            }
        } else {
            if ($(this).attr("type") === "checkbox") {
                if ($(this).is(":checked")) {
                    f[h] = $(this).val()
                }
            } else {
                f[h] = $(this).val()
            }
        }
        return void 0
    });
    if (f.Remail !== void 0) {
        if (f.Email !== f.Remail) {
            b = true;
            c = "El email y la confirmación no coinciden"
        }
    }
    if (f.ID === "-1" && f.Password === "") {
        b = true;
        c = "La contraseña es requerida"
    }
    for (d in a) {
        g = a[d];
        f[d] = g.join(",")
    }
    if (b) {
        return displayError(c, "alert-danger")
    }
    return $.post($url + e.data("action"), f, function (h) {
        h = JSON.parse(h);
        if (h.estado !== "Ok") {
            return displayError(h.mensaje, "alert-warning")
        }
        window.onbeforeunload = null;
        return location.reload()
    })
};
urlsafe = function (b) {
    var a;
    a = b.replace(/[ñ]/gi, "n");
    a = a.replace(/[âäáàã]/gi, "a");
    a = a.replace(/[êëéè]/gi, "e");
    a = a.replace(/[îïíì]/gi, "i");
    a = a.replace(/[ôöóòõ]/gi, "o");
    a = a.replace(/[ûüúù]/gi, "u");
    a = a.replace(/[^a-z0-9]/gi, "-").toLowerCase();
    if (a.substring(a.length - 1) === "-") {
        a = a.substring(0, a.length - 1)
    }
    return a
};
categoriaSelect = function (a) {
    var b;
    b = a.data("modelo");
    return $.post($url + a.data("datos"), {Categoria: a.val(), Negocio: b}, function (h) {
        var j, c, i, d, l, f, k, g, e;
        j = JSON.parse(h);
        i = j.tags;
        d = j.bistags;
        $(".lasetiquetas").html("");
        e = [];
        for (f = 0, k = i.length; f < k; f++) {
            c = i[f];
            l = {type: "checkbox", value: c.ID, name: "Tags"};
            if (g = c.ID, __indexOf.call(d, g) >= 0) {
                l.checked = true
            }
            e.push($(".lasetiquetas").append($("<label/>", {"class": "etiquetas"}).append(c.Nombre_es, $("<input/>", l))))
        }
        return e
    })
};
drawTelephones = function (i) {
    var c, b, g, a, f, e, h, d;
    b = function (k, j) {
        if (k.Tipo < j.Tipo) {
            return -1
        }
        if (k.Tipo > j.Tipo) {
            return 1
        }
        return 0
    };
    i.sort(b);
    $("#telefonosField").val(JSON.stringify(i));
    i.unshift({Tipo: "", Value: ""});
    a = $("#telefonosDiv");
    a.html("");
    d = [];
    for (e = 0, h = i.length; e < h; e++) {
        f = i[e];
        g = $("<div/>", {"class": "delTelephone"}).append($("<div/>", {"class": "utilicons-white utilicons-borrar"}));
        c = $("<div/>", {"class": "addTelephone"}).append($("<div/>", {"class": "utilicons-white utilicons-plus"}));
        if (f.Value !== "") {
            c = false
        }
        if (f.Value === "") {
            g = false
        }
        d.push(a.append($("<div/>", {"class": "telefono"}).append($("<input/>", {name: "telefonoType", "class": "tipo", placeholder: "Oficina", value: f.Tipo}), $("<input/>", {name: "telefonoValue", "class": "valor", placeholder: "(442) 000-0000", value: f.Value}), c, g)))
    }
    return d
};
armalostelefonos = function () {
    var a;
    a = [];
    $("#telefonosDiv .telefono").each(function () {
        var b;
        b = {Tipo: $(this).children(".tipo").val(), Value: $(this).children(".valor").val()};
        if (b.Value !== "" && b.Tipo !== "") {
            a.push(b)
        }
    });
    return drawTelephones(a)
};
reloadData = function (a, b, c) {
    if (c == null) {
        c = false
    }
    return $(a.data("reload")).fadeOut(function () {
        $(a.data("reload")).html(b).fadeIn();
        if (c !== false) {
            return c()
        }
    })
};
reloadList = function (a, b) {
    if (b == null) {
        b = false
    }
    return $.post($url + a.data("datos"), function (c) {
        return reloadData(a, c, b)
    })
};
reloadModel = function (a, b) {
    if (b == null) {
        b = false
    }
    return $.post($url + a.data("datos"), {ID: a.data("item")}, function (c) {
        return reloadData(a, c, b)
    })
};
window.onbeforeunload = function () {
    var b, d, a, c;
    return;
    if ($(".activeModel").length > 0) {
        c = $('.activeModel input[type="text"]');
        for (d = 0, a = c.length; d < a; d++) {
            b = c[d];
            if (b.value !== "") {
                return"Usted tiene cambios sin guardar, desea descartarlos?";
                break
            }
        }
    }
};
$(".layout header").on("click", ".menuHandle", function () {
    return $(".layout header .menuholder .menuBody").toggle()
}).on("click", ".perfilHandle", function () {
    return $(".layout header .perfilholder .perfilBody").toggle()
}).on("mouseenter", ".menuholder", function () {
    $(".layout header .menuholder .menuBody").show();
    return visible($(".layout header .menuholder .menuBody"))
}).on("mouseleave", ".menuholder", function () {
    return invisible($(".layout header .menuholder .menuBody"))
}).on("mouseenter", ".perfilholder", function () {
    $(".layout header .perfilholder .perfilBody").show();
    return visible($(".layout header .perfilholder .perfilBody"))
}).on("mouseleave", ".perfilholder", function () {
    return invisible($(".layout header .perfilholder .perfilBody"))
});
$(".createBton a").click(function () {
    var a;
    a = $(this);
    return reloadModel(a, function () {
        $(".listando, .editando").toggle();
        return categoriaSelect($("#categoriaSelect"))
    })
});
$(".saveBton a").click(function () {
    return salvarAction($(this))
});
$(".activeDiv").on("click", ".activeModel .addTelephone", function () {
    return armalostelefonos()
}).on("click", ".activeModel .delTelephone", function () {
    $(this).parent().remove();
    return armalostelefonos()
}).on("click", ".activeModel .salvarBton a", function () {
    return salvarAction($(this))
}).on("keyup", ".activeModel .generaURL", function () {
    var a, b;
    a = $(this);
    b = urlsafe(a.val());
    return $(a.data("urlfield")).val(b)
}).on("change", ".activeModel .soyurl", function () {
    var a, b;
    a = $(this);
    b = urlsafe(a.val());
    return a.val(b)
}).on("click", ".eliminaElemento", function () {
    var a;
    a = $(this);
    if (!confirm("Confirme eliminación")) {
        return
    }
    return $.post($url + a.data("action"), {ID: a.data("item")}, function () {
        return location.reload()
    })
}).on("click", ".editarElemento", function () {
    var a;
    a = $(this);
    return reloadModel(a)
}).on("click", ".editarElemento2", function () {
    var a;
    a = $(this);
    return reloadModel(a, function () {
        $(".listando, .editando").toggle();
        return categoriaSelect($("#categoriaSelect"))
    })
}).on("click", ".setPage", function () {
    var a;
    a = $(this);
    return $.post($url + "es/backend/" + a.data("modelo") + "/paginacion", {pagina: a.data("pagina")}, function () {
        return reloadList(a)
    })
}).on("click", ".orden", function () {
    var a;
    a = $(this);
    return $.post($url + "es/backend/" + a.data("modelo") + "/ordenamiento", {orden: a.data("orden")}, function () {
        return reloadList(a)
    })
});

