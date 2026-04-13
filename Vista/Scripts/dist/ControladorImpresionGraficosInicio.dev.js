"use strict";

// GRAFICO APROBADOS
function ImpresionGraficoReservacionesAprobadas() {
  var canvas = document.getElementById('ReservacionesAprobadas'); // Obtener la representación de la imagen en formato base64

  var dataURL = canvas.toDataURL();
  var GlobalURL = "http://localhost:90/ControlLaboratorios/Vista/assets/images/logo/ms-icon-70x70.png"; // Abrir una nueva pestaña con la URL de datos

  var newTab = window.open();
  newTab.document.write('<html><head><title>Reservaciones Aprobadas 2023</title></head><body><h5>Reservaciones Aprobadas 2023</h5>');
  newTab.document.write('<img src="' + GlobalURL + '">');
  newTab.document.write('<img src="' + dataURL + '">');
  newTab.document.write('<p><code>Consolidado de reservaciones aprobadas en el a&ntilde;o en curso 2023</code></p>');
  newTab.document.write('</body></html>'); // Llamar directamente a la función de impresión

  newTab.onload = function () {
    newTab.print();
    newTab.close();
  };
} // GRAFICO DENEGADOS


function ImpresionGraficoReservacionesDenegadas() {
  var canvas = document.getElementById('ReservacionesDenegadas'); // Obtener la representación de la imagen en formato base64

  var dataURL = canvas.toDataURL();
  var GlobalURL = "http://localhost:90/ControlLaboratorios/Vista/assets/images/logo/ms-icon-70x70.png"; // Abrir una nueva pestaña con la URL de datos

  var newTab = window.open();
  newTab.document.write('<html><head><title>Reservaciones Denegadas 2023</title></head><body><h5>Reservaciones Aprobadas 2023</h5>');
  newTab.document.write('<img src="' + GlobalURL + '">');
  newTab.document.write('<img src="' + dataURL + '">');
  newTab.document.write('<p><code>Consolidado de reservaciones denegadas en el a&ntilde;o en curso 2023</code></p>');
  newTab.document.write('</body></html>'); // Llamar directamente a la función de impresión

  newTab.onload = function () {
    newTab.print();
    newTab.close();
  };
} // GRAFICO CANCELADOS


function ImpresionGraficoReservacionesCanceladas() {
  var canvas = document.getElementById('ReservacionesCanceladas'); // Obtener la representación de la imagen en formato base64

  var dataURL = canvas.toDataURL();
  var GlobalURL = "http://localhost:90/ControlLaboratorios/Vista/assets/images/logo/ms-icon-70x70.png"; // Abrir una nueva pestaña con la URL de datos

  var newTab = window.open();
  newTab.document.write('<html><head><title>Reservaciones Canceladas 2023</title></head><body><h5>Reservaciones Aprobadas 2023</h5>');
  newTab.document.write('<img src="' + GlobalURL + '">');
  newTab.document.write('<img src="' + dataURL + '">');
  newTab.document.write('<p><code>Consolidado de reservaciones canceladas en el a&ntilde;o en curso 2023</code></p>');
  newTab.document.write('</body></html>'); // Llamar directamente a la función de impresión

  newTab.onload = function () {
    newTab.print();
    newTab.close();
  };
} // GRAFICO POR FACULTAD


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
//# sourceMappingURL=ControladorImpresionGraficosInicio.dev.js.map
