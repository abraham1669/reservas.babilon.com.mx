$(document).ready(function() {
    $(".recoverfields, .logindisabled, .loginfailed, .loginsent, .loginrecovery").hide();
    
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    ///////////////// LOGIN /////////////////
    // ENTER
    $('#email, #password').keydown(function(e) {
        if (e.which === 13) {
            var word = $('#email').val();
            var passw = $('#password').val();
            if (word !== "" && passw !== "") {
                $(".botonIngresar").trigger("click");
            }
        }
    });

    $(".botonIngresar").click(function() {
        var email = $("#usuario").val();
        var password = $("#password").val();
        var pass = "1";
        $("#approve").stop().hide();
        
        //  || !emailreg.test(email)
        if (email === "") {
            $("#usuario").addClass("error");
            pass = "0";
            return false;
        } else if (password === "") {
            $("#password").addClass("error");
            return false;
        }
        
        if (pass === "1") {
            $(this).fadeOut(50);
            $("#load").fadeIn(200);

            var obj = {
                accion: "login",
                usuario: email,
                password: password
            };
            
            $.post($url +"includes/_funciones.php", obj, function(data) {
                if (data === "false") {
                    $(".loginfailed").fadeIn(200).delay(5000).fadeOut(400);
                } else if (data === "suspended") {
                    $(".logindisabled").fadeIn(200).delay(5000).fadeOut(400);
                } else if (data === "escritorio") {
                    window.location = "escritorio";
                }
                $(".botonIngresar").delay(100).fadeIn(200);
            });
            
        }
    });

///////////////// OLVIDAR CONTRASEÑA /////////////////
    $('#correo').keydown(function(e) {
        if (e.which === 13) {
            var word = $('#correo').val();
            if (word !== "") {
                $(".forgot .button").trigger("click");
            }
        }
    });

    $(".botonRecovery").click(function() {
        $("#invalid").stop().hide();
        var password = $("#recov1").val();
        var hash = $("#hash").val();
        var pass = "1";

        if ($("#recov1").val() !== $("#recov2").val() || $("#hash").val() === "" || $("#recov1").val() === "" || $("#recov2").val() === "") {
            $("#recov1, #recov2").addClass('error');
            pass = "0";
            return false;
        }

        if (pass === "1") {
            var obj = {
                accion: "recovery",
                password: password,
                hash: hash
            };

            $.post($url +"includes/consultas.php", obj, function(data) {
                if (data === "1") {
                    $(".loginrecovery").fadeIn(200).delay(5000).fadeOut(200);
                    $("#recov1, #recov2").val("");
                    setTimeout(function() {
                        window.location = "/";
                    }, 5000);
                } else {
                    $(".loginfailed").fadeIn(200).delay(7000).fadeOut(200);
                }
            });
        }
    });
});


$("#getRecover").click(function() {
    $(".loginfields").slideUp();
    $(".recoverfields").slideDown();
    return $(".graypart input").val("");
});

$(".graypart input").keydown(function(a) {
    if (a.keyCode === 13) {
        return $(this).closest("form").submit()
    }
});
$("#mandaEmail").click(function() {
    if ($("#recuperaMail").val() === "") {
        return;
    }
    return $.post($url + "includes/_funciones.php", {accion: "forgot", email: $("#recuperaMail").val()}, function() {
        return $(".loginsent").fadeIn(500, function() {
            var a;
            return a = setTimeout(function() {
                $(".loginsent").fadeOut(500);
                $(".loginfields").slideDown();
                $(".recoverfields").slideUp();
                return $(".graypart input").val("");
            }, 2000);
        });
    });
});