"use strict";

var tabladata;
tabladata = $("#consulta-reservaciones-pendientes-gestionreservaciones").DataTable({
  responsive: true,
  ordering: true,
  dom: 'BfrZltip',
  rowGroup: {
    dataSrc: function dataSrc(row) {
      var fechaInicio = moment(row[1], 'DD/MM/YYYY');
      var fechaFin = moment(row[2], 'DD/MM/YYYY');
      var fechaGrupo = fechaInicio.format('YYYY-MM');

      while (fechaGrupo <= fechaFin.format('YYYY-MM')) {
        fechaGrupo += '-01';
        row.push(fechaGrupo);
        fechaGrupo = moment(fechaGrupo, 'YYYY-MM-DD').add(1, 'month').format('YYYY-MM');
      }

      return row[row.length - 1];
    }
  },
  order: [[3, 'asc']],
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
    title: 'Consolidado Reservaciones Pendientes',
    titleAttr: 'Imprimir',
    className: 'btn btn-info',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    },
    autoPrint: true
  }],
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
  }
});
//# sourceMappingURL=Configuracion_Datatable_ReservacionesPendientesGestiones.dev.js.map
