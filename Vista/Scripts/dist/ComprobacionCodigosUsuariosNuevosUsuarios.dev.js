"use strict";

// COMPROBAR EXISTENCIAS DE CODIGOS DE USUARIOS -> REGISTRO DE NUEVOS USUARIOS AL SISTEMA
$("#envio-datosusuarios").hide();
$("#loader-boxCodigo").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

function comprobarCodigoUsuario() {
  $("#loaderIconCodigo").show(); // EFECTO DE CARGA PROCESANDO INFORMACION

  $("#loader-boxCodigo").show(); // EFECTO DE CARGA PROCESANDO INFORMACION

  jQuery.ajax({
    url: "../Modelo/ConsultaUsuarioUnico_RegistroNuevosUsuarios_Modelo.php",
    data: 'txtcodigo_usuarios=' + $("#txtcodigo_usuarios").val(),
    type: "POST",
    success: function success(data) {
      setTimeout(function () {
        $("#estadocodigousuario").html(data); // MOSTRAR ESTADO USUARIO

        $("#loaderIconCodigo").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

        $("#loader-boxCodigo").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION

        if (data == 1) {
          UsuarioEncontrado = document.getElementById('validacion_botonCodigo').innerHTML;
          document.getElementById('validacion_botonCodigo').innerHTML = "<div class='alert alert-danger outline alert-dismissible fade show mt-2' role='alert'>" + "<i class='icofont icofont-close-circled'></i>Lo sentimos, este c&oacute;digo de usuario ya se encuentra registrado y en uso.</p>" + "</div>";
          $("#envio-datosusuarios").hide();
        } else {
          // NO MOSTRAR ALERTA SI NO EXISTE NADA EN EL CAMPO
          if ($("#txtcodigo_usuarios").val() != "") {
            UsuarioNoEncontrado = document.getElementById('validacion_botonCodigo').innerHTML;
            document.getElementById('validacion_botonCodigo').innerHTML = "<div class='alert alert-success outline alert-dismissible fade show mt-2' id='alerta-noencontrado' role='alert'>" + "<i class='icofont icofont-checked'></i>Perfecto, puedes hacer uso de este c&oacute;digo de usuario.</p>" + "";
          } else if ($("#txtcodigo_usuarios").val() === "") {
            $("#alerta-noencontrado").hide();
          }
        }

        if ($("#estadocodigousuario").val() == "") {
          $("#estadocodigousuario").hide();
        }
      }, 2000); // -> 2 SEGUNDOS EFECTO CARGA
    }
  });
}
//# sourceMappingURL=ComprobacionCodigosUsuariosNuevosUsuarios.dev.js.map
