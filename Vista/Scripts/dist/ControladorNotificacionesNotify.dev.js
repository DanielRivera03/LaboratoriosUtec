"use strict";

function Notificaciones_NotifyWarning(titulo, mensaje) {
  $.notify({
    title: titulo,
    message: mensaje
  }, {
    type: 'warning',
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 20,
    timer: 2000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animated zoomOut',
      exit: 'animated pulse'
    }
  });
}

function Notificaciones_NotifyDanger(titulo, mensaje) {
  $.notify({
    title: titulo,
    message: mensaje
  }, {
    type: 'danger',
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 20,
    timer: 2000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animated zoomOut',
      exit: 'animated pulse'
    }
  });
}

function Notificaciones_NotifyInfo(titulo, mensaje) {
  $.notify({
    title: titulo,
    message: mensaje
  }, {
    type: 'info',
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 20,
    timer: 2000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animated zoomOut',
      exit: 'animated pulse'
    }
  });
} //-> PARA EFECTOS DE MOSTRAR UNA ALERTA DE TIPO INFO EN MAS TIEMPO


function Notificaciones_NotifyInfoExtensible(titulo, mensaje) {
  $.notify({
    title: titulo,
    message: mensaje
  }, {
    type: 'info',
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 20,
    timer: 4000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animated zoomOut',
      exit: 'animated pulse'
    }
  });
}

function Notificaciones_NotifySuccess(titulo, mensaje) {
  $.notify({
    title: titulo,
    message: mensaje
  }, {
    type: 'success',
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 20,
    timer: 2000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animated zoomOut',
      exit: 'animated pulse'
    }
  });
}
//# sourceMappingURL=ControladorNotificacionesNotify.dev.js.map
