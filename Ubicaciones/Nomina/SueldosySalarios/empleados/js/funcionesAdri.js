
// <!DOCTYPE html>
// <html lang="es">
// 	<head>
// 	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
// 	<title>Alta Empleados</title>
// 				<style>
// 			body{
// 				font-family: Trebuchet MS;
// 			}
// 			.sombrearAzul{ background-color: #E6EEEE;}
// 		</style>
// 		<script src="../../include/validaRFC.js"></script>
// 		<script src="../../include/validaCURP.js"></script>
// 		<script src="../../include/primeraMayuscula.js"></script>
// 		<script src="../../include/todasMayusculas.js"></script>
// 		<script src="../../include/eliminaBlancoIni.js"></script>
// 		<script src="../../include/eliminaBlancoFin.js"></script>
// 		<script src="../../include/eliminaBlancosIntermedios.js"></script>
// 		<script src="../../include/validaSoloNumeros.js"></script>
// 		<script src="../../include/validaIntDec.js"></script>
// 		<script>
			function objetoAjax(){
				var xmlhttp=false;
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
					   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (E) {
						xmlhttp = false;
					}
				}

				if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp = new XMLHttpRequest(); }
				return xmlhttp;
			}

			function altaEmpleados(id_regimen){
				usuario = 'apinales';
				oficina = 240;
				formulario = 'alta';
				id_empleado = 0;

				div_altaEmpleados = document.getElementById('altaEmpleado');
				div_altaEmpleados.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
				ajax_altaEmpleados=objetoAjax();
				ajax_altaEmpleados.open("POST", "empleadosAlta.php",true);

				ajax_altaEmpleados.onreadystatechange=function() {

					if (ajax_altaEmpleados.readyState==1) {
						div_altaEmpleados.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
					}else if (ajax_altaEmpleados.readyState==4){
						div_altaEmpleados.innerHTML = ajax_altaEmpleados.responseText;

					}
				}
				ajax_altaEmpleados.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax_altaEmpleados.send("oficina="+oficina+"&id_regimen="+id_regimen+"&usuario="+usuario+"&formulario="+formulario+"&id_empleado="+id_empleado)
			}

			function regimenContrato(id_regimen){
				usuario = 'apinales';
				oficina = 240;
				formulario = 'alta';
				id_empleado = 0;

				//2 Sueldos - 9 Honorarios
				//id_regimen = document.getElementById('regimen').value;
				if(id_regimen == 2){ pagina = "empleadosAlta_regimenSueldos.php"; }
				if(id_regimen == 9){ pagina = "empleadosAlta_regimenHonorarios.php"; }

				div_regimenContrato = document.getElementById('datosRegimen');
				div_regimenContrato.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
				ajax_regimenContrato=objetoAjax();
				ajax_regimenContrato.open("POST", pagina,true);

				ajax_regimenContrato.onreadystatechange=function() {

					if (ajax_regimenContrato.readyState==1) {
						div_regimenContrato.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
					}else if (ajax_regimenContrato.readyState==4){
						div_regimenContrato.innerHTML = ajax_regimenContrato.responseText;

					}
				}
				ajax_regimenContrato.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax_regimenContrato.send("oficina="+oficina+"&usuario="+usuario+"&formulario="+formulario+"&id_empleado="+id_empleado)

			}

			function calculoISR(){
				Salario_Diario = document.empleados.Txt_Salario.value;
				if (Salario_Diario > 0){
						//donde se mostrar� el resultado
						divResultadoCtas = document.getElementById('ResultadoCtas');
						divResultadoCtas.innerHTML = "<img src='../../Imagenes/loader.gif' align='center'><font size=2 color=#FF0000> ESPERE . . .";
						//instanciamos el objetoAjax
						ajaxCtas=objetoAjax();
						ajaxCtas.open("POST", "empleadosAlta_CalculoISR.php?Salario_Diario="+Salario_Diario,true);

						ajaxCtas.onreadystatechange=function() {
							if (ajaxCtas.readyState==1) {
								divResultadoCtas.innerHTML = "<img src='../../Imagenes/loader.gif' align='center'><font size=2 color=#FF0000> ESPERE . . .";
							}else if (ajaxCtas.readyState==4){
								divResultadoCtas.innerHTML = "<input type='text' value='"+ajaxCtas.responseText+"' id='TxT_ISR_1' maxlength='10' size='10' style='font-family: Trebuchet MS; font-size: 8pt; color: #000000; text-align: left; background-color: #FFFFFF' readonly>";
								document.empleados.Txt_ISR.value = ajaxCtas.responseText;
								document.empleados.Txt_Salario_Pagar.value = document.empleados.Txt_Salario.value  - ajaxCtas.responseText
								}
							}
						ajaxCtas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajaxCtas.send(null)
				}else{
					document.empleados.Txt_Salario.focus();
				   return false;
				}
			}

			function Salario_Int(){
				Sal_Diario = document.empleados.Txt_Salario_Mensual.value / 30;
				document.empleados.Txt_Salario.value = Sal_Diario;
				Sal_Int =  document.empleados.Txt_Salario.value * document.empleados.Txt_Fac_Int.value;
				document.empleados.Txt_Salario_Int.value = Sal_Int + parseFloat(document.empleados.Txt_Adic_Int.value);
			}

			function distribuirSalario(){
				document.empleados.Txt_SUMATOTAL.value = parseFloat(document.empleados.Txt_AER.value) + parseFloat(document.empleados.Txt_MAN.value) + parseFloat(document.empleados.Txt_NL.value) + parseFloat(document.empleados.Txt_VER.value) + parseFloat(document.empleados.Txt_LTX.value);
			}


		   function valForm(){
		   	formulario = 'alta';
				id_empleado = 0;
		   	usuario = document.empleados.usuario.value;
				Txt_Nombre_Empleado = document.empleados.Txt_Nombre_Empleado.value;
				Txt_Apellido_Paterno = document.empleados.Txt_Apellido_Paterno.value;
				Txt_Apellido_Materno = document.empleados.Txt_Apellido_Materno.value;
				Txt_Fecha_Nac = document.empleados.Txt_Fecha_Nac.value;
				Txt_CURP = document.empleados.Txt_CURP.value;
				Txt_RFC = document.empleados.Txt_RFC.value;
				Txt_Telefono = document.empleados.Txt_Telefono.value;
				Txt_mail_personal = document.empleados.Txt_mail_personal.value;
				Txt_Calle = document.empleados.Txt_Calle.value;
				Txt_noExt = document.empleados.Txt_noExt.value;
				Txt_noInt = document.empleados.Txt_noInt.value;
				Txt_Colonia = document.empleados.Txt_Colonia.value;
				Txt_Localidad = document.empleados.Txt_Localidad.value;
				Txt_Municipio = document.empleados.Txt_Municipio.value;
				Txt_Estado = document.empleados.Txt_Estado.value;
				Txt_Codigo = document.empleados.Txt_Codigo.value;
				entidad = document.empleados.entidad.value;
				banco = document.empleados.banco.value;
				Txt_ctaBanco = document.empleados.Txt_ctaBanco.value;
				Txt_oficina = document.empleados.Txt_oficina.value;
				depto = document.empleados.depto.value;
				Txt_puesto = document.empleados.Txt_puesto.value;
				Txt_fechaContrato = document.empleados.Txt_fechaContrato.value;
				Txt_fechaBaja = document.empleados.Txt_fechaBaja.value;
				contrato = document.empleados.contrato.value;
				jornada = document.empleados.jornada.value;
				riesgoTrabajo = document.empleados.riesgoTrabajo.value;
				periodoPago = document.empleados.periodoPago.value;
				Txt_mail = document.empleados.Txt_mail.value;
				Txt_observaciones = document.empleados.Txt_observaciones.value;
				regimen = document.empleados.regimen.value;
				metodoPago = document.empleados.metodoPago.value;
				sttus = document.empleados.sttus.value;
				pagar = document.empleados.pagar.value;
				Txt_AER = document.empleados.Txt_AER.value;
				Txt_MAN = document.empleados.Txt_MAN.value;
				Txt_NL = document.empleados.Txt_NL.value;
				Txt_VER = document.empleados.Txt_VER.value;
				Txt_LTX = document.empleados.Txt_LTX.value;
				Txt_Salario = document.empleados.Txt_Salario.value;
				Txt_SUMATOTAL = document.empleados.Txt_SUMATOTAL.value;

				divResultadoAlertas = document.getElementById('resultadoAlertas');

				if (Txt_Nombre_Empleado == ""){	divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Nombre es requerido"; 				document.empleados.Txt_Nombre_Empleado.focus(); 	return false;}
				if (Txt_Apellido_Paterno == ""){divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Apellido Paterno es requerido";		document.empleados.Txt_Apellido_Paterno.focus(); 	return false;}
				if (Txt_Fecha_Nac == ""){		divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Fecha de Nacimiento es requerido";	document.empleados.Txt_Fecha_Nac.focus(); 			return false;}
				if (Txt_CURP == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>CURP es requerido";					document.empleados.Txt_CURP.focus(); 				return false;}
				if (Txt_RFC == ""){				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>RFC es requerido";					document.empleados.Txt_RFC.focus(); 				return false;}
				if (Txt_Calle == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Calle es requerido";				document.empleados.Txt_Calle.focus(); 				return false;}
				if (Txt_noExt == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>N�mero Exterior es requerido";		document.empleados.Txt_noExt.focus(); 				return false;}
				if (Txt_Colonia == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Colonia es requerido";				document.empleados.Txt_Colonia.focus(); 			return false;}
				//if (Txt_Localidad == ""){		divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Localidad es requerido";			document.empleados.Txt_Localidad.focus(); 			return false;}
				if (Txt_Municipio == ""){		divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Municipio es requerido";			document.empleados.Txt_Municipio.focus(); 			return false;}
				if (Txt_Codigo == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>C�digo Postal es requerido";		document.empleados.Txt_Codigo.focus(); 				return false;}
				if (Txt_puesto == ""){			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Puesto o Actividad es requerido";	document.empleados.Txt_puesto.focus(); 				return false;}

				if (Txt_Estado == 0){ 			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Estado es requerido"; 				document.empleados.Txt_Estado.focus(); 				return false;}
				if (entidad == 0){ 				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Entidad federativa es requerido"; 	document.empleados.entidad.focus();					return false;}
				if (depto == 0){   				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Departamento es requerido";  	 	document.empleados.depto.focus(); 					return false;}
				if (contrato == 0){				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Tipo de Contrato es requerido"; 	document.empleados.contrato.focus(); 				return false;}
				if (jornada == 0){ 				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Tipo de Jornada es requerido"; 		document.empleados.jornada.focus(); 				return false;}
				if (riesgoTrabajo == 0){		divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Riesgo de Trabajo es requerido"; 	document.empleados.riesgoTrabajo.focus(); 			return false;}
				if (periodoPago == 0){ 			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Periodicidad de Pago es requerido"; document.empleados.periodoPago.focus(); 			return false;}
				if (metodoPago == 0){  			divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>M�todo de Pago es requerido"; 		document.empleados.metodoPago.focus(); 				return false;}
				if (sttus == 0){ 				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Estatus es requerido"; 				document.empleados.sttus.focus(); 					return false;}
				if (pagar == 0){ 				divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Seleccione Pagar"; 					document.empleados.pagar.focus(); 					return false;}

				//  if (metodoPago == "transferencia" && (banco == 0 || Txt_ctaBanco =="") ){
				// 		divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Banco y n�mero de cuenta es requerido"; document.empleados.banco.focus(); return false;
				// }


				// if( sttus == "N" && Txt_fechaBaja == "" ){
				// 	divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000> Fecha de Baja es requerido"; document.empleados.Txt_fechaBaja.focus(); return false;
				// }

				//Distribucion de salario
				if(Txt_SUMATOTAL != 100){
					divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>La distribuci�n del salario es diferente al 100%"; return false;
				}

				// Sueldos
				if (regimen == 2){
					Txt_IMSS = document.empleados.Txt_IMSS.value;
					Txt_INFONAVIT = document.empleados.Txt_INFONAVIT.value;
					Txt_descPorcent = document.empleados.Txt_descPorcent.value;
					Txt_descCuota = document.empleados.Txt_descCuota.value;
					Txt_descVSM = document.empleados.Txt_descVSM.value;

					Txt_Salario_Mensual = document.empleados.Txt_Salario_Mensual.value;
					Txt_Fac_Int = document.empleados.Txt_Fac_Int.value;
					Txt_Adic_Int = document.empleados.Txt_Adic_Int.value;
					Txt_Salario_Int = document.empleados.Txt_Salario_Int.value;

					if (Txt_IMSS == ""){
						divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>IMSS es requerido"; document.empleados.Txt_IMSS.focus(); return false;
					}

					// if( sttus == "S" && Txt_fechaContrato == "" ){
					// 	divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000> Fecha de Contrato es requerido"; document.empleados.Txt_fechaContrato.focus(); return false;
					// }

					/*if(Txt_INFONAVIT != ""){
						if(Txt_descPorcent == 0 || Txt_descCuota == 0 || Txt_descVSM == 0){
							divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Asigne los datos de Tipo de descuento"; return false;
						}else{return true;}
					}*/

					if (Txt_Salario_Mensual == 0){
						divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Salario es requerido"; document.empleados.Txt_Salario_Mensual.focus(); return false;
					}
				}

				// Honorarios
				if (regimen == 9){
					Txt_ISR = document.empleados.Txt_ISR.value;
					Txt_Salario_Pagar = document.empleados.Txt_Salario_Pagar.value;

					if (Txt_Salario == 0){
						divResultadoAlertas.innerHTML = "<font size=3 color=#FF0000>Salario es requerido"; document.empleados.Txt_Salario.focus(); return false;
					}
				}

				div_valForm = document.getElementById('consultaEmpleado');
				div_valForm.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
				ajax_valForm = objetoAjax();
				ajax_valForm.open("POST", "empleadosGuardarDatos.php",true);

				ajax_valForm.onreadystatechange=function() {

					if (ajax_valForm.readyState==1) {
						div_valForm.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
					}else if (ajax_valForm.readyState==4){
						mensaje = ajax_valForm.responseText
						if (mensaje.indexOf("Error") > -1){
							div_valForm.innerHTML = mensaje;
						}else{
							//div_valForm.innerHTML = mensaje;
							altaEmpleados(regimen);
							regimenContrato(regimen);
							consultaEmpleados(regimen);
						}
					}
				}

				ajax_valForm.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

				// Sueldos
				if (regimen == 2){
					// ajax_valForm.send("usuario="+usuario+"&Txt_Nombre_Empleado="+escape(Txt_Nombre_Empleado)+"&Txt_Apellido_Paterno="+escape(Txt_Apellido_Paterno)+"&Txt_Apellido_Materno="+escape(Txt_Apellido_Materno)+"&Txt_Fecha_Nac="+Txt_Fecha_Nac+"&Txt_CURP="+Txt_CURP+"&Txt_RFC="+Txt_RFC+"&Txt_Telefono="+Txt_Telefono+"&Txt_mail_personal="+Txt_mail_personal+"&Txt_Calle="+escape(Txt_Calle)+"&Txt_noExt="+escape(Txt_noExt)+"&Txt_noInt="+Txt_noInt+"&Txt_Colonia="+escape(Txt_Colonia)+"&Txt_Localidad="+escape(Txt_Localidad)+"&Txt_Municipio="+escape(Txt_Municipio)+"&Txt_Estado="+Txt_Estado+"&Txt_Codigo="+Txt_Codigo+"&entidad="+entidad+"&banco="+banco+"&Txt_ctaBanco="+Txt_ctaBanco+"&Txt_oficina="+Txt_oficina+"&depto="+depto+"&Txt_puesto="+escape(Txt_puesto)+"&Txt_fechaContrato="+Txt_fechaContrato+"&Txt_fechaBaja="+Txt_fechaBaja+"&contrato="+contrato+"&jornada="+jornada+"&riesgoTrabajo="+riesgoTrabajo+"&periodoPago="+periodoPago+"&Txt_mail="+Txt_mail+"&Txt_observaciones="+escape(Txt_observaciones)+"&regimen="+regimen+"&metodoPago="+metodoPago+"&sttus="+sttus+"&pagar="+pagar+"&Txt_AER="+Txt_AER+"&Txt_MAN="+Txt_MAN+"&Txt_NL="+Txt_NL+"&Txt_VER="+Txt_VER+"&Txt_LTX="+Txt_LTX+"&Txt_IMSS="+escape(Txt_IMSS)+"&Txt_INFONAVIT="+escape(Txt_INFONAVIT)+"&Txt_descPorcent="+Txt_descPorcent+"&Txt_descCuota="+Txt_descCuota+"&Txt_descVSM="+Txt_descVSM+"&Txt_Salario_Mensual="+Txt_Salario_Mensual+"&Txt_Fac_Int="+Txt_Fac_Int+"&Txt_Adic_Int="+Txt_Adic_Int+"&Txt_Salario_Int="+Txt_Salario_Int+"&Txt_Salario="+Txt_Salario+"&formulario="+formulario+"&id_empleado="+id_empleado)

					ajax_valForm.send("usuario="+usuario+"&Txt_Nombre_Empleado="+Txt_Nombre_Empleado+"&Txt_Apellido_Paterno="+Txt_Apellido_Paterno+"&Txt_Apellido_Materno="+Txt_Apellido_Materno+"&Txt_Fecha_Nac="+Txt_Fecha_Nac+"&Txt_CURP="+Txt_CURP+"&Txt_RFC="+Txt_RFC+"&Txt_Telefono="+Txt_Telefono+"&Txt_mail_personal="+Txt_mail_personal+"&Txt_Calle="+Txt_Calle+"&Txt_noExt="+Txt_noExt+"&Txt_noInt="+Txt_noInt+"&Txt_Colonia="+Txt_Colonia+"&Txt_Localidad="+Txt_Localidad+"&Txt_Municipio="+Txt_Municipio+"&Txt_Estado="+Txt_Estado+"&Txt_Codigo="+Txt_Codigo+"&entidad="+entidad+"&banco="+banco+"&Txt_ctaBanco="+Txt_ctaBanco+"&Txt_oficina="+Txt_oficina+"&depto="+depto+"&Txt_puesto="+Txt_puesto+"&Txt_fechaContrato="+Txt_fechaContrato+"&Txt_fechaBaja="+Txt_fechaBaja+"&contrato="+contrato+"&jornada="+jornada+"&riesgoTrabajo="+riesgoTrabajo+"&periodoPago="+periodoPago+"&Txt_mail="+Txt_mail+"&Txt_observaciones="+Txt_observaciones+"&regimen="+regimen+"&metodoPago="+metodoPago+"&sttus="+sttus+"&pagar="+pagar+"&Txt_AER="+Txt_AER+"&Txt_MAN="+Txt_MAN+"&Txt_NL="+Txt_NL+"&Txt_VER="+Txt_VER+"&Txt_LTX="+Txt_LTX+"&Txt_IMSS="+Txt_IMSS+"&Txt_INFONAVIT="+Txt_INFONAVIT+"&Txt_descPorcent="+Txt_descPorcent+"&Txt_descCuota="+Txt_descCuota+"&Txt_descVSM="+Txt_descVSM+"&Txt_Salario_Mensual="+Txt_Salario_Mensual+"&Txt_Fac_Int="+Txt_Fac_Int+"&Txt_Adic_Int="+Txt_Adic_Int+"&Txt_Salario_Int="+Txt_Salario_Int+"&Txt_Salario="+Txt_Salario+"&formulario="+formulario+"&id_empleado="+id_empleado)
				}

				// Honorarios
				if (regimen == 9){
					// ajax_valForm.send("usuario="+usuario+"&Txt_Nombre_Empleado="+escape(Txt_Nombre_Empleado)+"&Txt_Apellido_Paterno="+escape(Txt_Apellido_Paterno)+"&Txt_Apellido_Materno="+escape(Txt_Apellido_Materno)+"&Txt_Fecha_Nac="+Txt_Fecha_Nac+"&Txt_CURP="+Txt_CURP+"&Txt_RFC="+Txt_RFC+"&Txt_Telefono="+Txt_Telefono+"&Txt_mail_personal="+Txt_mail_personal+"&Txt_Calle="+escape(Txt_Calle)+"&Txt_noExt="+escape(Txt_noExt)+"&Txt_noInt="+Txt_noInt+"&Txt_Colonia="+escape(Txt_Colonia)+"&Txt_Localidad="+escape(Txt_Localidad)+"&Txt_Municipio="+escape(Txt_Municipio)+"&Txt_Estado="+Txt_Estado+"&Txt_Codigo="+Txt_Codigo+"&entidad="+entidad+"&banco="+banco+"&Txt_ctaBanco="+Txt_ctaBanco+"&Txt_oficina="+Txt_oficina+"&depto="+depto+"&Txt_puesto="+escape(Txt_puesto)+"&Txt_fechaContrato="+Txt_fechaContrato+"&Txt_fechaBaja="+Txt_fechaBaja+"&contrato="+contrato+"&jornada="+jornada+"&riesgoTrabajo="+riesgoTrabajo+"&periodoPago="+periodoPago+"&Txt_mail="+Txt_mail+"&Txt_observaciones="+Txt_observaciones+"&regimen="+regimen+"&metodoPago="+metodoPago+"&sttus="+sttus+"&pagar="+pagar+"&Txt_AER="+Txt_AER+"&Txt_MAN="+Txt_MAN+"&Txt_NL="+Txt_NL+"&Txt_VER="+Txt_VER+"&Txt_LTX="+Txt_LTX+"&Txt_Salario="+Txt_Salario+"&Txt_ISR="+Txt_ISR+"&Txt_Salario_Pagar="+Txt_Salario_Pagar+"&formulario="+formulario+"&id_empleado="+id_empleado)


					ajax_valForm.send("usuario="+usuario+"&Txt_Nombre_Empleado="+Txt_Nombre_Empleado+"&Txt_Apellido_Paterno="+Txt_Apellido_Paterno+"&Txt_Apellido_Materno="+Txt_Apellido_Materno+"&Txt_Fecha_Nac="+Txt_Fecha_Nac+"&Txt_CURP="+Txt_CURP+"&Txt_RFC="+Txt_RFC+"&Txt_Telefono="+Txt_Telefono+"&Txt_mail_personal="+Txt_mail_personal+"&Txt_Calle="+Txt_Calle+"&Txt_noExt="+Txt_noExt+"&Txt_noInt="+Txt_noInt+"&Txt_Colonia="+Txt_Colonia+"&Txt_Localidad="+Txt_Localidad+"&Txt_Municipio="+Txt_Municipio+"&Txt_Estado="+Txt_Estado+"&Txt_Codigo="+Txt_Codigo+"&entidad="+entidad+"&banco="+banco+"&Txt_ctaBanco="+Txt_ctaBanco+"&Txt_oficina="+Txt_oficina+"&depto="+depto+"&Txt_puesto="+Txt_puesto+"&Txt_fechaContrato="+Txt_fechaContrato+"&Txt_fechaBaja="+Txt_fechaBaja+"&contrato="+contrato+"&jornada="+jornada+"&riesgoTrabajo="+riesgoTrabajo+"&periodoPago="+periodoPago+"&Txt_mail="+Txt_mail+"&Txt_observaciones="+Txt_observaciones+"&regimen="+regimen+"&metodoPago="+metodoPago+"&sttus="+sttus+"&pagar="+pagar+"&Txt_AER="+Txt_AER+"&Txt_MAN="+Txt_MAN+"&Txt_NL="+Txt_NL+"&Txt_VER="+Txt_VER+"&Txt_LTX="+Txt_LTX+"&Txt_Salario="+Txt_Salario+"&Txt_ISR="+Txt_ISR+"&Txt_Salario_Pagar="+Txt_Salario_Pagar+"&formulario="+formulario+"&id_empleado="+id_empleado)
				}
		   }
			 // TERMINA VALIDACION




			function consultaEmpleados(id_regimen){
				usuario = 'apinales';
				oficina = 240;

				div_consultaEmpleados = document.getElementById('consultaEmpleado');
				div_consultaEmpleados.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
				ajax_consultaEmpleados=objetoAjax();
				ajax_consultaEmpleados.open("POST", "empleadosConsulta.php",true);

				ajax_consultaEmpleados.onreadystatechange=function() {

					if (ajax_consultaEmpleados.readyState==1) {
						div_consultaEmpleados.innerHTML = "<img src='../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
					}else if (ajax_consultaEmpleados.readyState==4){
						div_consultaEmpleados.innerHTML = ajax_consultaEmpleados.responseText;

					}
				}
				ajax_consultaEmpleados.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax_consultaEmpleados.send("oficina="+oficina+"&id_regimen="+id_regimen+"&usuario="+usuario)
			}

			/* SOMBREAR LOS RENGLONES EN EL DETALLE */
			function cambiar_color_over(fila){
				fila.style.backgroundColor="#FCD6D7"
			}

			function cambiar_color_out(fila){
				fila.style.backgroundColor="#FFFFFF"
			}

			function mostrarAyuda(){
				window.open("lstBancosSAT.php","","scrollbars=YES,toolbar=no,location=no,directories=no,menubar=yes,resizable=yes");
			}
// 		</script>
// 	</head>
// 	<body onLoad="altaEmpleados(2,'alta');regimenContrato(2,'alta');consultaEmpleados(2);">
// 		<small>N&oacute;mina >> Sueldos y Salarios CFDI >> <b>Empleados</b></small>
// 		<hr/><br>
//
// 			<form name="empleados" id="empleados" method="post"><!--onSubmit="return valForm();" action="empleadosGuardarDatos.php" -->
// 		<div id="altaEmpleado"></div>
// 		<br>
// 		<div id="datosRegimen"></div>
// 		<br>
// 		<center><div id="resultadoAlertas"></div></center>
// 		<center><input type="button" value="Guardar" onClick="valForm()"></center>
// 		<br>
// 		</form>
//
// 		<div id="consultaEmpleado"></div>
// 	</body>
// </html>
