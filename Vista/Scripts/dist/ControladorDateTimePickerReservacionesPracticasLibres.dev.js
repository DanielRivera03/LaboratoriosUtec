// CALENDARIO
"use strict";

(function ($) {
  "use strict"; // INICIO RESERVACION

  var today = new Date();
  var currentMonthFirstDay = new Date(today.getFullYear(), today.getMonth(), 1);
  var nextMonthFirstDay = new Date(today.getFullYear(), today.getMonth() + 1, 1);
  nextMonthFirstDay.setDate(nextMonthFirstDay.getDate() + 14);
  $('#txtInicioReservacionPL').datepicker({
    language: 'en',
    minDate: today,
    maxDate: today,
    onRenderCell: function onRenderCell(date, cellType) {
      if (cellType == 'day') {
        var day = date.getDate(),
            isDisabled = !isSameDay(date, today);
        return {
          disabled: isDisabled
        };
      }
    }
  });
  var disabledDays = [0, 7];
  $('#disabled-days').datepicker({
    language: 'en',
    minDate: today,
    maxDate: nextMonthFirstDay,
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

$('#txtHoraInicioPL').clockpicker({
  placement: 'top',
  align: 'right',
  autoclose: true
});

if (/Mobile/.test(navigator.userAgent)) {
  $('input').prop('readOnly', true);
}
//# sourceMappingURL=ControladorDateTimePickerReservacionesPracticasLibres.dev.js.map
