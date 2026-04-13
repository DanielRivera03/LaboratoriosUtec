"use strict";

function mostrarInputs() {
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var resultados = document.getElementById('resultados');
  var inputs = '';

  for (var i = 0; i < checkboxes.length; i++) {
    var checkbox = checkboxes[i];
    var id = checkbox.id;
    var label = checkbox.nextElementSibling;
    var labelText = label.innerText;
    var inlineNumber = id.substring(id.lastIndexOf("-") + 1);
    var inputId = 'inline-' + inlineNumber + '-lab';
    var inputName = 'chklab' + inlineNumber + '-lab';
    inputs += '<div class="col-sm-12 mt-4"><label class="form-label">Ubicaci&oacute;n "' + labelText + '" <span style="color: var(--bs-danger);"></span></label><input id="' + inputId + '" type="text" name="' + inputName + '" placeholder="EJ: Benito Juarez Laboratorio 3" class="form-control input-air-primary form-control-lg"></div>';
  }

  resultados.innerHTML = inputs;
}
//# sourceMappingURL=ControladorUbicacionesLaboratorios.dev.js.map
