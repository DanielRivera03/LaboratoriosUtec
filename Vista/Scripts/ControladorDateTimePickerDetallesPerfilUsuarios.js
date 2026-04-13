// CALENDARIO
"use strict";
(function($) {
    "use strict";
    $('#txtfechanacimiento_usuarios').datepicker({
        language: 'en',
        onRenderCell: function(date, cellType) {
            if (cellType == 'day') {
                return {
                    disabled: false
                };
            }
        }
    });

    var disabledDays = [0, 7];

    $('#disabled-days').datepicker({
        language: 'en',
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
})(jQuery);

