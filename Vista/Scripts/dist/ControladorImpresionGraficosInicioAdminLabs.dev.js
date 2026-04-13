"use strict";

// GRAFICO POR FACULTAD
function ImpresionGraficoReservacionesAprobadasPorFacultad() {
  var divElement = document.getElementById('combo-chart'); // Clonar el elemento div para evitar modificar el contenido original

  var clonedDiv = divElement.cloneNode(true); // Abrir una nueva ventana o pestaña

  var newWindow = window.open(); // Escribir el contenido clonado en la nueva ventana

  newWindow.document.write('<html><head><title>Reservaciones Aprobadas Por Facultades 2023</title></head><body><h5>Reservaciones Aprobadas 2023</h5>');
  newWindow.document.write('<div>' + clonedDiv.innerHTML + '</div>');
  newWindow.document.write('<p><code>Consolidado de reservaciones aprobadas por facultades en el año en curso 2023</code></p>');
  newWindow.document.write('</body></html>'); // Llamar directamente a la función de impresión

  newWindow.onload = function () {
    newWindow.print();
    newWindow.close();
  };
}
//# sourceMappingURL=ControladorImpresionGraficosInicioAdminLabs.dev.js.map
