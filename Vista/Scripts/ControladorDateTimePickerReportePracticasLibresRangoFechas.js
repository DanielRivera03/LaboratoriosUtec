"use strict";
(function($) {
    "use strict";
    // INICIO RESERVACION
    var today = new Date();
    var minDate = new Date(2023, 0, 1); // January 1st, 2023
    var currentMonthFirstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    var nextMonthFirstDay = new Date(today.getFullYear(), today.getMonth() + 1, 1);
    nextMonthFirstDay.setDate(nextMonthFirstDay.getDate() + 14);
    $('#txtInicioReservacionPL').datepicker({
        language: 'en',
        minDate: minDate,
        maxDate: nextMonthFirstDay,
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                return {}
            }
        }
    });

    $('#txtFinReservacionPL').datepicker({
        language: 'en',
        minDate: minDate,
        maxDate: nextMonthFirstDay,
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                return {}
            }
        }
    });

   

    var disabledDays = [0, 7];

    $('#disabled-days').datepicker({
        language: 'en',
        minDate: minDate,
        maxDate: nextMonthFirstDay,
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                var isDisabled = date.getMonth() !== today.getMonth() || disabledDays.indexOf(date.getDay()) !== -1;
                return {
                    disabled: isDisabled
                }
            }
        }
    });
})(jQuery);
