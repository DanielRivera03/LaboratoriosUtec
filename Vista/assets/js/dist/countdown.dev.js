"use strict"; // Countdown js

var second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24; // CAMBIAR A FECHA DE FINALIZACION DE MANTENIMIENTO

var countDown = new Date('May 26, 2023 00:00:00').getTime(),
    x = setInterval(function () {
  var now = new Date().getTime(),
      distance = countDown - now;
  document.getElementById('days').innerText = Math.floor(distance / day), document.getElementById('hours').innerText = Math.floor(distance % day / hour), document.getElementById('minutes').innerText = Math.floor(distance % hour / minute), document.getElementById('seconds').innerText = Math.floor(distance % minute / second);
}, second);
//# sourceMappingURL=countdown.dev.js.map
