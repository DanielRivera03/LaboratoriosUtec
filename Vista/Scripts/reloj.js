function startTime() {
    Ahora = new Date();
    Hora = Ahora.getHours();
    Minutos = Ahora.getMinutes();
    Segundos = Ahora.getSeconds();
    Minutos = checkTime(Minutos);
    Segundos = checkTime(Segundos);
    document.getElementById("reloj").innerHTML = Hora + ":" + Minutos;
    t = setTimeout("startTime()", 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
window.onload = function() {
    startTime();
}