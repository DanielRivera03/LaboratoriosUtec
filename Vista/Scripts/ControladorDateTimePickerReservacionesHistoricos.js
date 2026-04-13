"use strict";
(function($) {
    "use strict";
    // INICIO RESERVACION
    var today = new Date();
    var janFirst = new Date(today.getFullYear(), 0, 1);
    var junTen = new Date(today.getFullYear(), 5, 10);
    $('#fecha-input').datepicker({
        language: 'en',
        minDate: janFirst,
        maxDate: junTen,
        dateFormat: 'dd/mm/yyyy', // formato de fecha
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                var day = date.getDate(),
                    isDisabled = date < janFirst || date > junTen;
                return {
                    disabled: isDisabled
                }
            }
        }
    });

    // Configurar el datepicker para el input de fecha
$('#fecha-input').datepicker({
    dateFormat: 'dd/mm/yy',
    onSelect: function(dateText) {
        fechaInput.val(dateText);
        fechaInput.trigger('change');
    }
});

    var disabledDays = [0, 7];

    $('#disabled-days').datepicker({
        language: 'en',
        minDate: today,
        maxDate: junTen,
        dateFormat: 'dd/mm/yyyy', // formato de fecha
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                var day = date.getDate(),
                    isDisabled = date.getMonth() !== today.getMonth() || disabledDays.indexOf(date.getDay()) !== -1;
                return {
                    disabled: isDisabled
                }
            }
        }
    });

    function isSameDay(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getDate() === date2.getDate();
    }
})(jQuery);
