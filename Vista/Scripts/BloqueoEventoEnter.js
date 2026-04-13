$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            Notificaciones_NotifyWarning('<i class="icon-direction"></i> ADVERTENCIA'
,'Estimado(a) usuario, por motivos de seguridad no tiene permitido el uso de la tecla ENTER');
            return false;
        }
    });
});