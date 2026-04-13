"use strict";

var tabladata;
tabladata = $("#consulta-reservaciones-estado-denegadas-registradas").DataTable({
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
    title: 'Consolidado Reservaciones Denegadas',
    className: 'btn btn-success',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    }
  }, {
    extend: 'pdfHtml5',
    text: '<i class="icofont icofont-file-pdf"></i> PDF',
    titleAttr: 'Exportar a PDF',
    className: 'btn btn-danger',
    title: 'Consolidado Reservaciones Denegadas',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    },
    customize: function customize(doc) {
      // Ajustar el tamaño de fuente a 8
      doc.defaultStyle.fontSize = 9; // Ajustar la orientación de página a landscape

      doc.pageOrientation = 'landscape'; // Ajustar los márgenes

      doc.pageMargins = [70, 60, 40, 60]; // Cambiar el tema de las columnas

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
    title: 'Consolidado Reservaciones Denegadas',
    titleAttr: 'Imprimir',
    className: 'btn btn-info',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    },
    autoPrint: true
  }],
  "rowsGroup": [0, 10],
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
  }
}); // Obtener referencia al input de fecha

var fechaInput = $('#fecha-input'); // Agregar un listener para detectar cambios en el input de fecha

fechaInput.on('change', function () {
  // Obtener el valor seleccionado
  var fechaSeleccionada = fechaInput.val(); // Convertir la fecha a formato dd/mm/yyyy

  var fechaMoment = moment(fechaSeleccionada, "DD/MM/YYYY"); // Verificar si la conversión fue exitosa

  if (!fechaMoment.isValid()) {
    console.log("Fecha inválida: " + fechaSeleccionada);
    return;
  } // Filtrar las filas de la tabla según la fecha ingresada


  var filtroFecha = {
    search: fechaMoment.format("DD/MM/YYYY")
  };
  tabladata.columns(7).search(filtroFecha.search); // Mover las filas que cumplen el filtro a la primera página

  tabladata.page.len(-1).draw();
  tabladata.page(0).draw(false); // Volver a aplicar el ordenamiento

  tabladata.order([4, 'asc']).draw();
});
//# sourceMappingURL=Configuracion_Datatable_ReservacionesDenegadas.dev.js.map
