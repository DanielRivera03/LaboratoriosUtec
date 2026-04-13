// CALENDARIO
"use strict";

(function ($) {
  "use strict"; // INICIO RESERVACION

  var today = new Date();
  /***************************************************************
   * -> DECOMENTAR SEGUN CICLO EN CURSO
   * NO MODIFICAR VALORES DE MESES, UNICAMENTE VALORES DE DIAS
   * EL CONTEO DE MESES INICIA EN CERO
   ***************************************************************/
  // CICLO 01 

  var startDate = new Date(today.getFullYear(), 0, 19);
  var endDate = new Date(today.getFullYear(), 5, 11); // CICLO 03
  //var startDate = new Date(today.getFullYear(), 5, 13);
  //var endDate = new Date(today.getFullYear(), 6, 21);
  // CICLO 02
  //var startDate = new Date(today.getFullYear(), 6, 24);
  //var endDate = new Date(today.getFullYear(), 11, 17);

  $('#txtInicioReservacion').datepicker({
    language: 'en',
    minDate: startDate,
    maxDate: endDate,
    onRenderCell: function onRenderCell(date, cellType) {
      if (cellType == 'day') {
        var day = date.getDate(),
            isDisabled = date < startDate || date > endDate;
        return {
          disabled: isDisabled
        };
      }
    }
  });
  $('#fecha-input').datepicker({
    language: 'en',
    //minDate: today,
    //maxDate: nextMonthFirstDay,
    minDate: startDate,
    maxDate: endDate,
    onRenderCell: function onRenderCell(date, cellType) {
      if (cellType == 'day') {
        var day = date.getDate(),
            isDisabled = date < today && !isSameDay(date, today);
        return {
          disabled: isDisabled
        };
      }
    }
  });
  $('#txtFinalizacionReservacion').datepicker({
    language: 'en',
    //minDate: today,
    //maxDate: nextMonthFirstDay,
    minDate: startDate,
    maxDate: endDate,
    onRenderCell: function onRenderCell(date, cellType) {
      if (cellType == 'day') {
        var day = date.getDate(),
            isDisabled = date < startDate || date > endDate;
        return {
          disabled: isDisabled
        };
      }
    }
  });
  var disabledDays = [0, 7];
  $('#disabled-days').datepicker({
    language: 'en',
    minDate: startDate,
    maxDate: endDate,
    onRenderCell: function onRenderCell(date, cellType) {
      if (cellType == 'day') {
        var day = date.getDate(),
            isDisabled = date.getMonth() !== today.getMonth() || disabledDays.indexOf(date.getDay()) !== -1;
        return {
          disabled: isDisabled
        };
      }
    }
  });

  function isSameDay(date1, date2) {
    return date1.getFullYear() === date2.getFullYear() && date1.getMonth() === date2.getMonth() && date1.getDate() === date2.getDate();
  }
})(jQuery); // RELOJ


'use strict';

$('#txtHoraInicio').clockpicker({
  placement: 'top',
  align: 'right',
  autoclose: true
});
$('#txtHoraFinalizacion').clockpicker({
  placement: 'top',
  align: 'right',
  autoclose: true
});

if (/Mobile/.test(navigator.userAgent)) {
  $('input').prop('readOnly', true);
}
//# sourceMappingURL=ControladorDateTimePicker.dev.js.map
