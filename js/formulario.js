$(function() {
    // Cogemos el formulario
    var form = $('#registro');
    // Y el p donde pondremos el mensaje
    var formAlert = $('#alerta');
    // Ponemos un listener que vigile el formulario
    $(form).submit(function(event) {
    // Detenemos la introducción normal del formulario
        event.preventDefault();
    //Cogemos los datos del formulario
        
        var formData = $(form).serialize();
    // Introducimos el formulario usando AJAX
        $.ajax({
           type: 'POST',
           url: $(form).attr('action'),
           data: formData 
        }).done(function(response){  //Si tiene exito...
    // Nos aseguramos que el div del mensaje tiene la clase success
            $(formAlert).removeClass('fail');
            $(formAlert).addClass('success');
    // Insertamos texto en el div de alerta
            $(formAlert).text(response);
    // Limpiamos el formulario
            $('#login').val('').removeClass('valid');
            $('#password').val('').removeClass('valid');
            $('#nombre').val('').removeClass('valid');
            $('#apellidos').val('').removeClass('valid');
            $('#email').val('').removeClass('valid');
            setTimeout(function() {
             location.href = "../index.php";
            },3000);
        }).fail(function(data){ // Si falla...
    // Nos aseguramos que el div del mensaje tiene la clase fail
            $(formAlert).removeClass('success');
            $(formAlert).addClass('fail');
    // Insertamos texto en el div de alerta
            if (data.responseText !== '') {
                $(formAlert).html(data.responseText);
            } else {
                $(formAlert).text('Ha ocurrido un error. Por favor, rellene todos los campos del formulario y vuelva a intentarlo.');
            }  
        });
    });
});

$(document).ready(function() {
    //Validación en tiempo real
    // El nombre no puede estar en blanco
    $('#login').on('input', function() {
        var input=$(this);
        var is_name=input.val();
        if(is_name){input.removeClass("invalid").removeClass("error").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });

    $('#password').on('input', function() {
        var input=$(this);
        var is_name=input.val();
        if(is_name){input.removeClass("invalid").removeClass("error").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });

    $('#nombre').on('input', function() {
        var input=$(this);
        var is_name=input.val();
        if(is_name){input.removeClass("invalid").removeClass("error").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });

    $('#apellidos').on('input', function() {
        var input=$(this);
        var is_name=input.val();
        if(is_name){input.removeClass("invalid").removeClass("error").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });

    //El email debe ser un email
    $('#email').on('input', function() {
        var input=$(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,}$/;
        var is_email=re.test(input.val());
        if(is_email){input.removeClass("invalid").removeClass("error").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });

    //Validación del formulario despues de enviar el formulario
    $("#registro").submit(function(event){
        var form_data=$("#registro").serializeArray();
        var error_free=true;
        for (var input in form_data){
            var element=$("#"+form_data[input]['name']);
            var valid=element.hasClass("valid");
            if (!valid){element.addClass("error"); error_free=false;}
        }
    });
});

window.onload=function() {
    document.forms[0].reset();
}     
