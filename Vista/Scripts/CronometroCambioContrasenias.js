// Variables para almacenar el estado del temporizador
let timerId;
let remainingTime;

// Función que se ejecutará cada segundo
function updateTimer() {
  if (remainingTime > 0) {
    remainingTime--;
    // Actualizar la interfaz de usuario con el tiempo restante
    document.getElementById("cronometro").innerHTML = remainingTime;
  } else {
    clearInterval(timerId);
    // Eliminar el elemento del DOM que muestra el tiempo restante
    var element = document.getElementById("cronometro");
    element.parentNode.removeChild(element);
    // Eliminar el valor guardado en local storage
    localStorage.removeItem("remainingTime");
    remainingTime = 120;
    // Redirigir a otra página
    window.location.href = "../controlador/cIniciosSesionesUsuarios.php?cashmanha=expiracion-cambio-contrasenia";
  }
  localStorage.setItem("remainingTime", remainingTime);
}

// Comprobar si hay un temporizador guardado en localStorage
if (localStorage.getItem("remainingTime")) {
  remainingTime = localStorage.getItem("remainingTime");
  timerId = setInterval(updateTimer, 1000);
} else {
  // Iniciar un nuevo temporizador con un tiempo determinado (en segundos)
  remainingTime = 120;
  timerId = setInterval(updateTimer, 1000);
}

