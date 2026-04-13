$("#aviso_usuarios").hide();
$("#asignar_laboratorios").hide();
let alertaImpresa = false;
function ValidacionTipoUsuarios(){
    // VALIDACION SELECCION SEGUN ROLES DE USUARIOS
    if(document.getElementById("sltroles_usuarios").value == 1){
        $("#aviso_usuarios").show();
        $("#asignar_laboratorios").hide();
        $("#laboratorios_asignados").hide();
        // SI SELECCION ES UNO -> TIENE POR DEFECTO ASIGNADOS TODOS LOS LABORATORIOS
        let AlertaUsuarios = '<div class="alert alert-info outline fade show" role="alert">* Por favor tome en cuenta, que este usuario al ser un coordinador de laboratorios, posee por defecto asignados todos los laboratorios de inform&aacute;tica. Ya que este tipo de usuario no posee ninguna restricci&oacute;n.</p></div>';
        document.getElementById('aviso_usuarios').innerHTML = AlertaUsuarios;
        // SI SELECCION ES DOS -> TDEBE SELECCIONAR LABORATORIOS ASIGNADOS
    }else if(document.getElementById("sltroles_usuarios").value == 2){
        $("#aviso_usuarios").show();
        $("#asignar_laboratorios").show();
        // SI EL MENSAJE AUN NO SE HA IMPRESO, IMPRIMIRLO
        if (!alertaImpresa) {
            let AlertaUsuarios = '<div class="alert alert-warning outline fade show mt-4" role="alert">* Por favor seleccione los laboratorios que este usuario tiene asignado.</p></div>';
            document.getElementById('aviso_usuarios').innerHTML = AlertaUsuarios;
            alertaImpresa = true;
        }
    }else if(document.getElementById("sltroles_usuarios").value == 3){
        $("#aviso_usuarios").show();
        $("#asignar_laboratorios").hide();
        $("#laboratorios_asignados").hide();
        // SI SELECCION ES TRES -> NO POSEE ASIGNADO NINGUN LABORATORIO
        let AlertaUsuarios = '<div class="alert alert-danger outline fade show" role="alert">* Por favor tome en cuenta, que este tipo de usuario, por defecto no posee ning&uacute;n laboratorio asignado.</p></div>';
        document.getElementById('aviso_usuarios').innerHTML = AlertaUsuarios;
    }
};

$(document).ready(function() {
    // CONTROLADOR EVENTO KEYPRESS
    $(document).on('keypress', function(event) {
        if($("#txtrolusuarioactual").val() == document.getElementById("sltroles_usuarios").value){
            // EVITAR DUPLICADOS, SOLAMENTE MOSTRAR LABORATORIOS SELECCIONADOS
            // ES DECIR [EVITAR IMPRESION DUPLICADA DE NUEVA SELECCION DE LABORATORIOS]
            $("#asignar_laboratorios").hide();
            $("#laboratorios_asignados").show();
        }
    });

    // BLOQUEAR PRIMERA OPCION SELECCIONADA
    const select = document.getElementById('sltroles_usuarios');
    select.addEventListener('change', () => {
        if (select.selectedIndex === 0) {
            select.selectedIndex = -1;
        }
    });
});
