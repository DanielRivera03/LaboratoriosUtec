"use strict";

$("#aviso_usuarios").hide();
$("#asignar_laboratorios").hide();

function ValidacionTipoUsuarios() {
  // VALIDACION SELECCION SEGUN ROLES DE USUARIOS
  if (document.getElementById("sltroles_usuarios").value == 1) {
    $("#aviso_usuarios").show();
    $("#asignar_laboratorios").hide(); // SI SELECCION ES UNO -> TIENE POR DEFECTO ASIGNADOS TODOS LOS LABORATORIOS

    var AlertaUsuarios = '<div class="alert alert-info outline fade show" role="alert">* Por favor tome en cuenta, que este usuario al ser un coordinador de laboratorios, posee por defecto asignados todos los laboratorios de inform&aacute;tica. Ya que este tipo de usuario no posee ninguna restricci&oacute;n.</p></div>';
    document.getElementById('aviso_usuarios').innerHTML = AlertaUsuarios;
  } else if (document.getElementById("sltroles_usuarios").value == 2) {
    $("#aviso_usuarios").show();
    $("#asignar_laboratorios").show(); // SI SELECCION ES DOS -> DEBEN DE SELECCIONAR LOS LABORATORIOS QUE TIENE ASIGNADO DICHO USUARIO

    var _AlertaUsuarios = '<div class="alert alert-warning outline fade show" role="alert">* Por favor seleccione los laboratorios que este usuario tiene asignado.</p></div>';
    document.getElementById('aviso_usuarios').innerHTML = _AlertaUsuarios;
  } else if (document.getElementById("sltroles_usuarios").value == 3) {
    $("#aviso_usuarios").show();
    $("#asignar_laboratorios").hide(); // SI SELECCION ES TRES -> NO POSEE ASIGNADO NINGUN LABORATORIO

    var _AlertaUsuarios2 = '<div class="alert alert-danger outline fade show" role="alert">* Por favor tome en cuenta, que este tipo de usuario, por defecto no posee ning&uacute;n laboratorio asignado.</p></div>';
    document.getElementById('aviso_usuarios').innerHTML = _AlertaUsuarios2;
  }
}

;
//# sourceMappingURL=ConsultarTipoUsuario_RegistroUsuarios.dev.js.map
