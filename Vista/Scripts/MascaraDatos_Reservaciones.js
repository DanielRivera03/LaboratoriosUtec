var HoraInicioMask = IMask(
    document.getElementById('txtHoraInicio'), {
        mask: '00:00'
    });

var HoraFinalizacionMask = IMask(
    document.getElementById('txtHoraFinalizacion'), {
        mask: '00:00'
    });

var DiaInicioMask = IMask(
    document.getElementById('txtInicioReservacion'), {
        mask: '0000-00-00'
    });