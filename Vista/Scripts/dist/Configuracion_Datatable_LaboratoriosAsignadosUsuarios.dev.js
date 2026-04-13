"use strict";

var tabladata;
tabladata = $("#consulta-laboratorios-asignados").DataTable({
  responsive: true,
  ordering: true,
  dom: 'BfrZltip',
  buttons: [{
    extend: 'copyHtml5',
    text: '<i class="icofont icofont-file-text"></i> Copiar',
    titleAttr: 'Copiar Datos',
    className: 'btn btn-primary',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
    }
  }, {
    extend: 'excelHtml5',
    text: '<i class="icofont icofont-file-excel"></i> Excel',
    titleAttr: 'Exportar a Excel',
    title: 'Consolidado Usuarios Asignados Laboratorios',
    className: 'btn btn-success',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
    }
  }, {
    extend: 'pdfHtml5',
    text: '<i class="icofont icofont-file-pdf"></i> PDF',
    titleAttr: 'Exportar a PDF',
    className: 'btn btn-danger',
    title: 'Consolidado Usuarios Asignados Laboratorios',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
    }
  }, {
    extend: 'print',
    customize: function customize(win) {
      $(win.document.body).css('font-size', '8pt');
      $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
      $(win.document).find('h1').css({
        'font-size': '12pt',
        'color': 'grey',
        'text-align': 'center'
      }); // Ocultar elementos no deseados

      $(win.document.body).find('header').hide();
      $(win.document.body).find('footer').hide(); // Abrir ventana de impresión automáticamente

      win.print();
    },
    text: '<i class="icofont icofont-printer"></i> Imprimir',
    title: 'Consolidado Usuarios Laboratorios',
    titleAttr: 'Imprimir',
    className: 'btn btn-info',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
    },
    autoPrint: true
  }],
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
  }
});
//# sourceMappingURL=Configuracion_Datatable_LaboratoriosAsignadosUsuarios.dev.js.map
