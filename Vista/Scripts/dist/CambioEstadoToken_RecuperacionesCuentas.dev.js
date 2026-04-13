"use strict";

$("#cambioestadotoken").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var url = "../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=cambio-estado-token";
  var TokenAcceso = $(this).data('id'); // ID ENVIADA POR GET DESDE EL CONTROLADOR HACIA EL MODELO  

  $.ajax({
    type: "POST",
    url: url,
    data: 'token=' + TokenAcceso,
    success: function success(data) {
      location.href = "../controlador/InicioSesionUsuarios_Controlador.php?laboratorios=cambio-contrasenia-usuarios&token=" + TokenAcceso;
    }
  });
});
//# sourceMappingURL=CambioEstadoToken_RecuperacionesCuentas.dev.js.map
