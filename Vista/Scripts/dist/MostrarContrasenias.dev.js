"use strict";

// MOSTRAR CONTRASEÑAS -> QUITAR MASCARA DE SEGURIDAD
function mostrarPassword() {
  var cambio = document.getElementById("txtnuevaclaveusuarios");

  if (cambio.type == "password") {
    cambio.type = "text";
    $('.show-password').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    $('.background-password').removeClass('btn-primary').addClass('btn btn-danger-gradien');
  } else {
    cambio.type = "password";
    $('.show-password').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    $('.background-password').removeClass('btn btn-danger-gradien').addClass('btn btn-primary');
  }
}

function mostrarPassword_InicioSesion() {
  var cambio = document.getElementById("txtcontrasenia");

  if (cambio.type == "password") {
    cambio.type = "text";
    $('.show-password').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    $('.background-password').removeClass('btn-primary').addClass('btn btn-danger-gradien');
  } else {
    cambio.type = "password";
    $('.show-password').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    $('.background-password').removeClass('btn btn-danger-gradien').addClass('btn btn-primary-gradien');
  }
}
//# sourceMappingURL=MostrarContrasenias.dev.js.map
