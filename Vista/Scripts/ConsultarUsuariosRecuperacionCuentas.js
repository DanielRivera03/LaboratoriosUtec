// COMPROBAR EXISTENCIAS DE USUARIOS -> RECUPERACION DE CUENTAS
$("#loader-box").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION
function comprobarUsuario() {
	$("#loaderIcon").show(); // EFECTO DE CARGA PROCESANDO INFORMACION
	$("#loader-box").show(); // EFECTO DE CARGA PROCESANDO INFORMACION
	jQuery.ajax({
	url: "../Modelo/ConsultaCorreoUsuarios_RecuperacionCuentas_Modelo.php",
	data:'txtcorreoconsulta_recuperaciones='+$("#txtcorreoconsulta_recuperaciones").val(),
	type: "POST",
	success:function(data){
		setTimeout(function(){
            $("#estadousuario").html(data); // MOSTRAR ESTADO USUARIO
            $("#loaderIcon").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION
			$("#loader-box").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION
			if(data==1){
				let UsuarioEncontrado = document.getElementById('validacion_boton').innerHTML;
				document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-success outline alert-dismissible fade show mt-2' role='alert'>" + 
				"<i class='icofont icofont-checked'></i>Usuario encontrado con &eacute;xito, puedes continuar con el proceso de recuperaci&oacute;n.</p>" + 
				"<button id='enviodatos' type='submit' class='btn btn-primary btn-block mt-2' >Recuperar Contrase&ntilde;a</button></div>";
			}else{
				let UsuarioNoEncontrado = document.getElementById('validacion_boton').innerHTML;
				document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-danger outline alert-dismissible fade show mt-2' role='alert'>" + 
				"<i class='icofont icofont-close-circled'></i>Lo sentimos, no podemos proceder con la recuperación. Usuario no encontrado y/o registrado.</p>" + 
				"<button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>";
			}
			if($("#estadousuario").val() == ""){
				$("#estadousuario").hide();
			}
        }, 2000);	// -> 2 SEGUNDOS EFECTO CARGA
	},
	});
}