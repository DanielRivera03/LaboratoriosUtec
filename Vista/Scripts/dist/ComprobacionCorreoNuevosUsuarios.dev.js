"use strict";

// COMPROBAR EXISTENCIAS DE CORREOS USUARIOS -> REGISTRO DE NUEVOS USUARIOS AL SISTEMA
$("#loader-box").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

function comprobarUsuario() {
  $("#loaderIcon").show(); // EFECTO DE CARGA PROCESANDO INFORMACION

  $("#loader-box").show(); // EFECTO DE CARGA PROCESANDO INFORMACION

  jQuery.ajax({
    url: "../Modelo/ConsultaCorreoUsuarios_RegistroNuevosUsuarios_Modelo.php",
    data: 'txtcorreo_usuarios=' + $("#txtcorreo_usuarios").val(),
    type: "POST",
    success: function success(data) {
      setTimeout(function () {
        $("#estadousuario").html(data); // MOSTRAR ESTADO USUARIO

        $("#loaderIcon").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

        $("#loader-box").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

        if (data == 1) {
          UsuarioEncontrado = document.getElementById('validacion_boton').innerHTML;
          document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-danger outline alert-dismissible fade show mt-2' role='alert'>" + "<i class='icofont icofont-close-circled'></i>Lo sentimos, este correo ya se encuentra registrado y en uso.</p>" + "</div>";
          $("#envio-datosusuarios").hide();
        } else {
          // NO MOSTRAR ALERTA SI NO EXISTE NADA EN EL CAMPO
          if ($("#txtcorreo_usuarios").val() != "") {
            UsuarioNoEncontrado = document.getElementById('validacion_boton').innerHTML;
            document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-success outline alert-dismissible fade show mt-2' id='alerta-noencontrado' role='alert'>" + "<i class='icofont icofont-checked'></i>Perfecto, puedes hacer uso de este correo.</p>" + "";
            var CorreoUsuarios = $('#txtcorreo_usuarios').val(); // CORREO DE USUARIO

            if (CorreoUsuarios.length >= 1) {
              $("#envio-datosusuarios").show();
            }
          } else if ($("#txtcorreo_usuarios").val() === "") {
            $("#alerta-noencontrado").hide();
            $("#envio-datosusuarios").hide();
          }
        }

        if ($("#estadousuario").val() == "") {
          $("#estadousuario").hide();
        }
      }, 2000); // -> 2 SEGUNDOS EFECTO CARGA
    }
  });
}
//# sourceMappingURL=ComprobacionCorreoNuevosUsuarios.dev.js.map
