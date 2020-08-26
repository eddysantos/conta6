$(document).ready(function(){

  // NOTE: Todo lo comentado en este .js se paso al archivo catalogoCuentas.js
  // fetch_cuentas_sat();
  // cuentas_Det();



  $('.aconta').click(function(){
    var accion = $(this).attr('accion');
    var status = $(this).attr('status');

    switch (accion) {
	     //CIERRE DE MES Y CATALOGO
        // case "eCap":
        // if (status == 'cerrado') {
        //   $('#contornoEmp').fadeIn();
        //   $('#empleadosCap').fadeIn();
        //   $(this).attr('status', 'abierto');
        //   $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        //   $(this).css('font-size', '20px');
        // } else {
        //   $('#contornoEmp').fadeOut();
        //   $('#empleadosCap').fadeOut();
        //   $(this).attr('status', 'cerrado');
        //   $(this).css('color', "");
        //   $(this).css('font-size', "");
        // }
        //   break;

    		//CIERRE DE MES
    		case "generar":
    		if (status == 'cerrado') {
    		  $('#contornoGen').fadeIn();
    		  $(this).attr('status', 'abierto');
    		  $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
    		  $(this).css('font-size', '20px');
    		} else {
    		  $('#contornoGen').fadeOut();
    		  $(this).attr('status', 'cerrado');
    		  $(this).css('color', "");
    		  $(this).css('font-size', "");
    		}
    		  break;

        case "modificar":
        if (status == 'cerrado') {
          $('#contornoMod').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoMod').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;

        case "consultar":
        if (status == 'cerrado') {
          $('#contornoCon').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoCon').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;

        case "eCap":
        if (status == 'cerrado') {
          $('#contornoEmp').fadeIn();
          $('#empleadosCap').fadeIn();
          $(this).attr('status', 'abierto');
          $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
          $(this).css('font-size', '20px');
        } else {
          $('#contornoEmp').fadeOut();
          $('#empleadosCap').fadeOut();
          $(this).attr('status', 'cerrado');
          $(this).css('color', "");
          $(this).css('font-size', "");
        }
          break;
            default:
              console.error("Something went terribly wrong...");
      }
    });



    $('#genCorresponsal').click(function(){

			if($('#corp-cliente').attr('db-id') == ""){
				alertify.error("Seleccione un cliente");
				$('#corp-cliente').focus();
				return false;
			}

      txt_cliente = $('#corp-cliente').val();
      cliente = $('#corp-cliente').attr('db-id');

      parte = txt_cliente.split(cliente);
      cliente = parte[0];
      nombre = parte[1];

      var data = {
    		id_cliente: $('#corp-cliente').attr('db-id'),
        s_nombre: nombre
    	}


    	$.ajax({
    		type: "POST",
    		url: "/Ubicaciones/Contabilidad/AdminContable/actions/agregarCorresponsal.php",
    		data: data,
    		success: 	function(request){
    			r = JSON.parse(request);
          if (r.code == 1) {
  					swal("Exito", "Se guardo correctamente.", "success");
  					location.reload();
  				} else {
  					console.error(r.message);
  				}

    		}
    	});
    });




    // $('#ctamaestra').click(function(){
    //   $(this).val('0000-00000').attr('value', '0000-00000').prop('value', '0000-00000').select();
    // });

    // $('#generarCtaMst').click(function(){
    //
    //   if($('#ctaSAT').attr('db-id') == ""){
    //     alertify.error("Seleccione Cuenta del SAT");
    //     $('#ctaSAT').focus();
    //     return false;
    //   }
    //
    //   if($('#naturSAT').attr('db-id') == ""){
    //     alertify.error("Seleccione Naturaleza de la cuenta");
    //     $('#naturSAT').focus();
    //     return false;
    //   }
    //
    //   if($('#tipo').val() == ""){
    //     alertify.error("Seleccione un Tipo");
    //     $('#tipo').focus();
    //     return false;
    //   }
    //
    //   if($('#ctamaestra').val() == ""){
    //     alertify.error("Asigne una cuenta");
    //     $('#ctamaestra').focus();
    //     return false;
    //   }
    //
    //   if($('#concepto').val() == ""){
    //     alertify.error("Asigne una descripción");
    //     $('#concepto').focus();
    //     return false;
    //   }
    //
    //
    //     var data = {
    //       ctaSAT: $('#ctaSAT').attr('db-id'),
    //       naturSAT: $('#naturSAT').attr('db-id'),
    //       tipo: $('#tipo').val(),
    //       ctamaestra: $('#ctamaestra').val(),
    //       concepto: $('#concepto').val(),
    //       accion: 'MST'
    //     }
    //
    //     $.ajax({
    // 			type: "POST",
    // 			url: "/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    // 			data: data,
    // 			success: 	function(request, settings){
    //         //$('#respuestaCtasMST').html(request);
    //         mensaje = request;
    //         if (mensaje.indexOf("Error") > -1) {
    //           swal("Error", mensaje, "error");
    //
    //         // if(mensaje.indexOf("Error during query execution [1062]") > -1){
  	// 				// 	swal("La cuenta ya existe");
    //           // console.error(request);
  	// 					return false;
  	// 				}else{
    //           swal("Exito", "La cuenta se agrego correctamente.", "success");
    //           setTimeout('document.location.reload()',700);
    //           return true;
    // 		    }
    //       }
    // 	});
    // });


    // $('#generarCtaDet').click(function(){
    //     if($('#ctaSAT1').attr('db-id') == ""){
    //       alertify.error("Seleccione Cuenta del SAT");
    //       $('#ctaSAT1').focus();
    //       return false;
    //     }
    //
    //     if($('#naturSAT1').attr('db-id') == ""){
    //       alertify.error("Seleccione Naturaleza de la cuenta");
    //     	$('#naturSAT1').focus();
    //     	return false;
    //     }
    //
    //     if($('#ctamaestra1').attr('db-id') == ""){
    //       alertify.error("Asigne una cuenta");
    //       $('#ctamaestra1').focus();
    //       return false;
    //     }
    //
    //     if($('#concepto1').val() == ""){
    //     	alertify.error("Asigne una descripción");
    //     	$('#concepto1').focus();
    //     	return false;
    //     }
    //
    //     id_cuenta = $('#ctamaestra1').attr('db-id');
    //     parteCuentaMST = id_cuenta.split('-');
    //
    //     // cuando selecciona 0100-BANCOS
    //     if (parteCuentaMST[0] == '0100'){
    //       if($('#banSAT').attr('db-id') == ""){
    //       	alertify.error("Seleccione un banco");
    //       	$('#banSAT').focus();
    //       	return false;
    //       }
    //       if( $('#banSAT').attr('db-id') == "999" && $('#nomBcoExt').val() == "" ){
    //          alertify.error("Es requerido el nombre del banco");
    //          $('#nomBcoExt').focus();
    //          return false;
    //        }
    //
    //       if( $('#noCuenta').val() == ""){
    //         alertify.error("Escriba numero de cuenta");
    //       	$('#noCuenta').focus();
    //       	return false;
    //       }
    //       if($('#oficina').attr('db-id') == ""){
    //       	alertify.error("Seleccione oficina");
    //       	$('#oficina').focus();
    //       	return false;
    //       }
    //
    //       var data = {
    //         ctaSAT: $('#ctaSAT1').attr('db-id'),
    //         naturSAT: $('#naturSAT1').attr('db-id'),
    //         ctamaestra: $('#ctamaestra1').attr('db-id'),
    //         concepto: $('#concepto1').val(),
    //         accion: 'DET',
    //         banSAT: $('#banSAT').attr('db-id'),
    //         nomBcoExt: $('#nomBcoExt').val(),
    //         noCuenta: $('#noCuenta').val(),
    //         oficinaAsignar: $('#oficina').attr('db-id'),
    //         obser: $('#obser').val()
    //       }
    //     }
    //
    //     // cuando selecciona 0115-DEUDORES
    //     if (parteCuentaMST[0] == '0115'){
    //       if($('#identID').val() == ""){
    //       	alertify.error("Seleccione cliente o empleado");
    //       	$('#cliente0115').focus();
    //       	return false;
    //       }
    //
    //       var data = {
    //         ctaSAT: $('#ctaSAT1').attr('db-id'),
    //         naturSAT: $('#naturSAT1').attr('db-id'),
    //         ctamaestra: $('#ctamaestra1').attr('db-id'),
    //         concepto: $('#concepto1').val(),
    //         accion: 'DET',
    //         identID: $('#identID').val(),
    //         identTipo: $('#identTipo').val()
    //       }
    //     }
    //
    //     if (parteCuentaMST[0] == '0206'){
    //       if($('#prov0206').attr('db-id') == ""){
    //       	alertify.error("Seleccione proveedor");
    //       	$('#prov0206').focus();
    //       	return false;
    //       }
    //
    //       var data = {
    //         ctaSAT: $('#ctaSAT1').attr('db-id'),
    //         naturSAT: $('#naturSAT1').attr('db-id'),
    //         ctamaestra: $('#ctamaestra1').attr('db-id'),
    //         concepto: $('#concepto1').val(),
    //         accion: 'DET',
    //         prov: $('#prov0206').attr('db-id')
    //       }
    //     }
    //
    //     if (parteCuentaMST[0] != '0100' && parteCuentaMST[0] != '0115' && parteCuentaMST[0] != '0206'){
    //       var data = {
    //         ctaSAT: $('#ctaSAT1').attr('db-id'),
    //         naturSAT: $('#naturSAT1').attr('db-id'),
    //         ctamaestra: $('#ctamaestra1').attr('db-id'),
    //         concepto: $('#concepto1').val(),
    //         accion: 'DET'
    //       }
    //     }
    //     $.ajax({
    // 			type: "POST",
    // 			url: "/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    // 			data: data,
    // 			success: 	function(request, settings){
    //         mensaje = request;
    //         if(mensaje.indexOf("Error") > -1){
    //           swal("Error", mensaje, "error");
  	// 					// $('#respuestaCtasDET').html(request);
    //           // console.error(request);
  	// 					return false;
  	// 				}else{
    //           swal("Exito", "La cuenta se guardo correctamente.", "success");
    //           // cuentas_Det();
    //           setTimeout('document.location.reload()',700);
    //           return true;
    // 		    }
    // 		  }
    //     });
    //
    //   });




      // $('#generarCtaCLT').click(function(){
      //   if($('#clt').attr('db-id') == ""){
      //     alertify.error("Seleccioe un cliente");
      //     $('#clt').focus();
      //     return false;
      //   }
      //
      //   var data = {
      //     cliente: $('#clt').attr('db-id'),
      //     accion: 'cliente'
      //   }
      //
      //   $.ajax({
    	// 		type: "POST",
    	// 		url: "/Ubicaciones/Contabilidad/AdminContable/actions/agregar.php",
    	// 		data: data,
    	// 		success: 	function(request, settings){
      //       mensaje = request;
      //       if (mensaje.indexOf("Error") > -1) {
      //         swal("Error", mensaje, "error");
      //       }else {
      //         swal("Exito", "La cuenta se agrego correctamente.", "success");
      //         setTimeout('document.location.reload()',700);
      //         // return true;
      //       }
    	// 	  }
      //   });
      //
      // });


  // $('tbody').on('click', '.editar-cuenta', function(){
  //   var dbid = $(this).attr('db-id');
  //   var tar_modal = $($(this).attr('href'));
  //   var fetch_cuenta = $.ajax({
  //     method: 'POST',
  //     data: {dbid: dbid},
  //     url: 'actions/fetchCuentaDetalle.php'
  //   });
  //
  //   fetch_cuenta.done(function(r){
  //     r = JSON.parse(r);
  //     if (r.code == 1) {
  //
  //     for (var key in r.data) {
  //       if ($('#' + key).is('select')) {
  //         continue;
  //       }
  //
  //       if (r.data.hasOwnProperty(key)) {
  //         $('#' + key).html(r['data'][key]).val(r['data'][key]).addClass('tiene-contenido');
  //         if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
  //           $('#' + key).attr('db-id', r['data'][key]);
  //         }
  //       }
  //     }
  //
  //     $('#s_cta_status').val(r.data.s_cta_status);
  //     $('#medit-ctas').attr('db-id', r.data.pk_id_cuenta);
  //
  //     tar_modal.modal('show');
  //     } else {
  //       console.error(r);
  //     }
  //   })
  //
  // })

  // $('#medit-ctas').click(function(){
  //   //Código para editar el modal, declaración de variables y ajax.
  //
  //
  //     if($('#medit-ctaSAT').attr('db-id') == ""){
  //       alertify.error("Seleccione cuenta del SAT");
  //       $('#medit-ctaSAT').focus();
  //       return false;
  //     }
  //
  //     if($('#medit-concepto').val() == ""){
  //       alertify.error("Asigne un concepto");
  //       $('#medit-concepto').focus();
  //       return false;
  //     }
  //
  //     if($('#medit-status').val() == ""){
  //       alertify.error("Seleccione el estatutus de captura");
  //       $('#medit-status').focus();
  //       return false;
  //     }
  //
  //
  //     if($('#medit-naturSAT').attr('db-id') == ""){
  //       alertify.error("Seleccione Naturaleza de la cuenta");
  //       $('#medit-naturSAT').focus();
  //       return false;
  //     }
  //
  //     if($('#medit-prodServ').attr('db-id') == ""){
  //       alertify.error("Seleccione clave de producto");
  //       $('#medit-prodServ').focus();
  //       return false;
  //     }
  //
  //       var data = {
  //         id_cuenta: $('#pk_id_cuenta').attr('db-id'),
  //         cuenta_sat: $('#fk_codAgrup').attr('db-id'),
  //         concepto: $('#s_cta_desc').val(),
  //         status: $('#s_cta_status').val(),
  //         naturSAT: $('#fk_id_naturaleza').attr('db-id'),
  //         prodServ: $('#fk_c_ClaveProdServ').attr('db-id'),
  //       }
  //
  //       $.ajax({
  //         type: "POST",
  //         url: "/Ubicaciones/Contabilidad/AdminContable/actions/editar.php",
  //         data: data,
  //         success: 	function(r){
  //           console.log(r);
  //           r = JSON.parse(r);
  //           if (r.code == 1) {
  //             cuentas_Det();
  //             swal("Exito", "La cuenta se actualizó correctamente.", "success");
  //             $('.real-time-search').keyup();
  //           } else {
  //             console.error(r.message);
  //           }
  //         },
  //         error: function(x){
  //           console.error(x);
  //         }
  //       });
  //     $('.modal').modal('hide');
  //   })


  // $('.real-time-search').keyup();
});

// function CLTasignado(){
//   cliente = $('#client0115').attr('db-id');
//   $('#identTipo').val('cliente');
//   $('#identID').val(cliente);
//
//   nom = $('#client0115').val();
//   parte = nom.split('-');
//   $('#concepto1').val(parte[1]);
// }
//
// function empAsignado(){
//   empleado = $('#emp0115').attr('db-id');
//   $('#identTipo').val('empleado');
//   $('#identID').val(empleado);
//
//   nom = $('#emp0115').val();
//   parte = nom.split('-');
//   $('#concepto1').val(parte[1]);
// }
//
// function provAsignado(){
//   nom = $('#prov0206').val();
//   parte = nom.split('-');
//   $('#concepto1').val(parte[1]);
// }
//
// function asigCorresponsal(id_corresp,id_cliente){
//     if(id_corresp > 0){
//       if($('#corp-cliente').attr('db-id') == ""){
//         alertify.error("Seleccione un cliente");
//         $('#corp-cliente').focus();
//         return false;
//       }
//
//       var data = {
//         id_cliente: $('#corp-cliente').attr('db-id'),
//         id_corresp: $('#id_corresp').val()
//       }
//
//     }else{
//       var data = {
//         id_cliente: id_cliente,
//         id_corresp: id_corresp
//       }
//     }
//
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/AdminContable/actions/asignarCorresponsalAcliente.php",
//     data: data,
//     success: 	function(request){
//       r = JSON.parse(request);
//       console.log(r);
//       if (r.code == 1) {
//         swal("Exito", "Operación realizada correctamente.", "success");
//         location.reload();
//       } else {
//         console.error(r.message);
//       }
//
//     }
//   });
// }
//
//
// function correspAsignar(id_corresp){
//   window.location.replace('/Ubicaciones/Contabilidad/AdminContable/CorresponsalesAsignar.php?id_corresp='+id_corresp);
// }
// function fetch_cuentas_sat(){
//     $.ajax({
//       method: 'POST',
//       url: '/Resources/PHP/actions/lst_conta_cs_sat_cuentas.php',
//       success: function(r){
//         r = JSON.parse(r);
//         if (r.code == 1) {
//           $('#catalogo-sat-helper').html(r.data);
//         } else {
//           console.error(r.message);
//         }
//       }
//     })
// }

// function cuentas_Det(){
//   $.ajax({
//     method: 'POST',
//     url: '/Ubicaciones/Contabilidad/AdminContable/actions/tablacuentasDet.php',
//     success: function(r){
//       r = JSON.parse(r);
//       if (r.code == 1) {
//         $('#tabla_cuentas').html(r.data);
//       } else {
//         console.error(r.message);
//       }
//     }
//   })
// }

// function valida_ctamaestra(){
//   var ctamaestra = $('#ctamaestra').val();
//   // 0400-00000
//   if( (!/^(\d{4})\-(\d{5})+$/.test(ctamaestra)) || ctamaestra == "" ){
//      alertify.error("La Cuenta Maestra no corresponde al formato: 0000-00000");
//      $('#ctamaestra').focus();
//     return false;
//   }else{
//     if(ctamaestra == '0000-00000'){
//       swal("Ingrese una cuenta");
//        $('#ctamaestra').focus();
//        return false;
//     }else{
//       $('#respuestaCtasMST').html("");
//       return true;
//     }
//   }
// }
