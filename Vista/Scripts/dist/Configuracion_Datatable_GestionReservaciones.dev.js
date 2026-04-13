"use strict";

var tabladata;
tabladata = $("#consulta-reservaciones-aprobadas-gestion-reservaciones").DataTable({
  responsive: {
    details: {
      type: 'column',
      target: 'button'
    }
  },
  ordering: true,
  dom: 'BfrZltip',
  buttons: [{
    extend: 'copyHtml5',
    text: '<i class="icofont icofont-file-text"></i> Copiar',
    titleAttr: 'Copiar Datos',
    className: 'btn btn-primary',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    }
  }, {
    extend: 'excelHtml5',
    text: '<i class="icofont icofont-file-excel"></i> Excel',
    titleAttr: 'Exportar a Excel',
    title: 'Consolidado Reservaciones Pendientes',
    className: 'btn btn-success',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    }
  }, {
    extend: 'pdfHtml5',
    text: '<i class="icofont icofont-file-pdf"></i> PDF',
    titleAttr: 'Exportar a PDF',
    className: 'btn btn-danger',
    title: 'Consolidado Reservaciones Pendientes',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    },
    customize: function customize(doc) {
      // Ajustar el tamaño de fuente a 8
      doc.defaultStyle.fontSize = 8; // Ajustar la orientación de página a landscape

      doc.pageOrientation = 'landscape'; // Ajustar los márgenes

      doc.pageMargins = [40, 60, 40, 60]; // Cambiar el tema de las columnas

      var colCount = doc.content[1].table.body[0].length;

      for (var i = 0; i < colCount; i++) {
        doc.content[1].table.body[0][i].style = 'tableHeader';
      }
    }
  }, {
    extend: 'print',
    customize: function customize(win) {
      $(win.document.body).css('font-size', '8pt');
      $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
    },
    text: '<i class="icofont icofont-printer"></i> Imprimir',
    title: 'Consolidado Reservaciones Pendientes',
    titleAttr: 'Imprimir',
    className: 'btn btn-info',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    }
  }],
  "rowsGroup": [0, 10],
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
  }
});
//# sourceMappingURL=Configuracion_Datatable_GestionReservaciones.dev.js.map
