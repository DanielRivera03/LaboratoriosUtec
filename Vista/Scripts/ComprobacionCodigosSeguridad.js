function comprobarCodigoSeguridad() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "../Modelo/ConsultaCodigoSeguridad_RecuperacionCuentas_Modelo.php",
	data:'txtcodigoseguridad='+$("#txtcodigoseguridad").val(),
	type: "POST",
	success:function(data){
        setTimeout(function(){
            $("#estadousuario").html(data); // MOSTRAR ESTADO USUARIO
            $("#loaderIcon").hide(); // EFECTO DE CARGA PROCESANDO INFORMACION
			if(data==1){
				let CodigoEncontrado = document.getElementById('validacion_boton').innerHTML;
				document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-success outline alert-dismissible fade show mt-2' role='alert'><i class='icofont icofont-checked'></i>" + 
				"El c&oacute;digo de seguridad ingresado es v&aacute;lido. Favor haga clic en el bot&oacute;n para finalizar la recuperaci&oacute;n de su cuenta.</p>" + 
				"<button type='submit' class='btn btn-primary btn-block mt-2'> Comprobar C&oacute;digo de Recuperaci&oacute;n</button></div>";
			}else{
				let CondigoNoEncontrado = document.getElementById('validacion_boton').innerHTML;
				document.getElementById('validacion_boton').innerHTML = "<div class='alert alert-danger outline alert-dismissible fade show mt-2' role='alert'>" + 
				"<i class='icofont icofont-close-circled'></i>Lo sentimos, el c&oacute;digo de seguridad ingresado no es v&aacute;lido. Ingrese el &uacute;ltimo c&oacute;digo de seguridad recibido si ha realizado m&uacute;ltiples peticiones. [Error: Expirado y/o Inv&aacute;lido].</p>";
			}
			if($("#estadousuario").val() == ""){
				$("#estadousuario").hide();
			}
        }, 2000);	
	},
	});
    
}