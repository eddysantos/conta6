$(document).ready(function(){
  fetch_formaPago_sat();
  polReg_Det();

  fetch_catalogoBancosSAT();
  fetch_catalogoBancosExt();


  // TODO: Eliminar si funciona

  // $('.personas').click(function(){
  //     var accion = $(this).attr('accion');
  //     var status = $(this).attr('status');

    // CONSULTAR PERSONAS
    // switch (accion) {

      // PERSONAS FISICAS O MORALES
      // case "clientes":
      // $('#buscarClt').fadeIn();
      // $('#SeleccionarAccion').slideUp();
      //   break;
    //   case "proveedores":
    //   $('#buscarProv').fadeIn();
    //   $('#SeleccionarAccion').slideUp();
    //     break;
    //   case "Corresponsales":
    //   $('#buscarCorresp').fadeIn();
    //   $('#SeleccionarAccion').slideUp();
    //     break;
    //
    //   default:
    //     console.error("Something went terribly wrong...");
    // }


    //**************************** si cambio los nombres .visualizar Ver-cliente  ya no funciona ****** revisar
    //CONSULTAR CLIENTES
  //   $('.visualizar').click(function(){
  //     var accion = $(this).attr('accion');
  //     var status = $(this).attr('status');
  //
  //     switch (accion) {
  //       case "Ver-cliente":
  //       if (status == 'cerrado') {
  //         $('#detalleCliente').fadeIn();
  //         $(this).attr('status', 'abierto');
  //         $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //         $(this).css('font-size', '20px');
  //       } else {
  //         $('#detalleCliente').fadeOut();
  //         $(this).attr('status', 'cerrado');
  //         $(this).css('color', "");
  //         $(this).css('font-size', "");
  //       }
  //       break;
  //
  //       case "Ver-iEmbarque":
  //       if (status == 'cerrado') {
  //         $('#detalleEmbarque').fadeIn();
  //         $(this).attr('status','abierto');
  //         $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //         $(this).css('font-size', '20px');
  //       }else {
  //         $('#detalleEmbarque').fadeOut();
  //         $(this).attr('status','cerrado');
  //         $(this).css('color', "");
  //         $(this).css('font-size', "");
  //       }
  //       break;
  //       case "datinfo":
  //       if (status == 'cerrado') {
  //         $('#contornoInfo').fadeIn();
  //         $(this).attr('status','abierto');
  //         $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //         $(this).css('font-size', '20px');
  //       }else {
  //         $('#contornoInfo').fadeOut();
  //         $(this).attr('status','cerrado');
  //         $(this).css('color', "");
  //         $(this).css('font-size', "");
  //       }
  //       break;
  //       case "Ver-iUsuario":
  //       if (status == 'cerrado') {
  //         $('#detalleUsuario').fadeIn();
  //         $(this).attr('status','abierto');
  //         $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
  //         $(this).css('font-size', '20px');
  //       }else {
  //         $('#detalleUsuario').fadeOut();
  //         $(this).attr('status','cerrado');
  //         $(this).css('color', "");
  //         $(this).css('font-size', "");
  //       }
  //       break;
  //
  //       default:
  //         console.error("Something went terribly wrong...");
  //     }
  //
  //   });
  //
  //
  // });


  // se utiliza en global
  $('#btn-buscarClientePersonas').click(function(){
    id_cliente = $('#bClt-persona').attr('db-id');
    if (id_cliente == "") {
      alertify.error("Selecciona un cliente");
    }else {
      // window.location.replace('/Ubicaciones/Contabilidad/AdminContable/actions/datosCliente.php?id_cliente='+id_cliente);
      window.location.replace('/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Clientes/index.php?id_cliente='+id_cliente);
    }
  });
  // se utiliza en global

  // $('#btn_guardarTaxID').click(function(){
  //   taxid = $('#T_Cliente_taxid').val();
  //   pais = $('#T_Cliente_Pais').val();
  //
  //   if( pais == 'MEX' ){
  //     alertify.error("Cliente Mexicano no requiere taxID");
  //     $('#T_Cliente_taxid').val('');
  //     return false;
  //   }
  //   if( taxid == '' && pais != 'MEX') {
  //     alertify.error("Tax ID es requerido para extranjeros");
  //     $('#T_Cliente_taxid').focus();
  //     return false;
  //   }
  //
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     taxid: taxid
  //   }
  //
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_actualizarTaxID.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "taxID se actualizó correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });

  // $('#btn_actualizarDiasCredito').click(function(){
  //   dias = $('#diasCredito').val();
  //
  //   if( dias == '' ) {
  //     alertify.error("Número de días es requerido");
  //     $('#diasCredito').focus();
  //     return false;
  //   }
  //
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     dias: dias
  //   }
  //
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_actualizarDiasCredito.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Días de crédito se actualizó correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });

  // $('#btn_guaradrDiasCredito').click(function(){
  //   dias = $('#diasCredito').val();
  //
  //   if( dias == '' ) {
  //     alertify.error("Número de días es requerido");
  //     $('#diasCredito').focus();
  //     return false;
  //   }
  //
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     dias: dias
  //   }
  //
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_guardarDiasCredito.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Días de crédito se guardo correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });


  // $('#btn_actualizarDatosCFDI').click(function(){
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     email : $('#email_Factura').val(),
  //     status : $('#ID_status').val(),
  //     pdf : $('#envio_PDF').val(),
  //     xml : $('#envio_xml').val()
  //   }
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_actualizarDatosCFDI.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Datos de CFDI se actualizó correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });


  // $('#btn_agregarMetPago').click(function(){
  //   metPago = $('#Lst_metPago').val();
  //   parte = metPago.split('+');
  //   idmetpago = parte[0];
  //   concepto = parte[1];
  //
  //
  //   if( idmetpago == '' ){
  //     alertify.error("Método de pago es requerido");
  //     $('#Lst_metPago').focus();
  //     return false;
  //   }
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     metPago : idmetpago,
  //     concepto : concepto
  //   }
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_guardarMetodoPago.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Método de pago se guardo correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });

  // $('.remove-metPagoCLT').click(function(){
  //   partida = $(this).parents('tr').find('.partidaMetPago').val();
  //
  //   swal({
  //   title: "Estas Seguro?",
  //   text: "Ya no se podra recuperar el registro! "+ partida +" ",
  //   type: "warning",
  //   showCancelButton: true,
  //   confirmButtonClass: "btn-danger",
  //   confirmButtonText: "Si, Eliminar",
  //   cancelButtonText: "No, cancelar",
  //   closeOnConfirm: false,
  //   closeOnCancel: false
  //   },
  //   function(isConfirm) {
  //     if (isConfirm) {
  //       var data = {
  //         partida : partida
  //       }
  //       $.ajax({
  //         type: "POST",
  //         url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_eliminarMetodoPago.php",
  //         data: data,
  //         success: 	function(r){
  //           r = JSON.parse(r);
  //           if (r.code == 1) {
  //             swal("Exito", "Método de pago se elimino correctamente.", "success");
  //             setTimeout('location.reload()',700);
  //           } else {
  //             console.error(r.message);
  //           }
  //         },
  //         error: function(x){
  //           console.error(x);
  //         }
  //       });
  //     }else{
  //       swal("Cancelado", "El registro esta a salvo :)", "error");
  //     }
  //   });
  // });

  // $('#Lst_Bancos').change(function(){
  //   alert('cambie');
  //   metPago = $('#Lst_Bancos').val();
  //   parte = metPago.split('+');
  //   idbanco = parte[0];
  //
  //   if( idbanco == '999' ){
  //     $('#nom_banco_ext').prop( 'disabled',false);
  //   }else{
  //     $('#nom_banco_ext').prop( 'disabled',true ).val('');
  //   }
  // });

  // $('#btn_agregarctasbancosCLT').click(function(){
  //   metPago = $('#Lst_Bancos').val();
  //   parte = metPago.split('+');
  //   idbanco = parte[0];
  //
  //   nomBanco = $('#nom_banco_ext').val();
  //   cta_banco = $('#cta_banco').val();
  //
  //   if( idbanco == '999' && nomBanco == '' ){
  //     alertify.error("Nombre del banco es requerido");
  //     $('#nom_banco_ext').focus();
  //     return false;
  //   }
  //   if( idbanco != '999' && cta_banco == '' ){
  //     alertify.error("Cuenta bancaria es requerido");
  //     $('#cta_banco').focus();
  //     return false;
  //   }
  //
  //   var data = {
  //     id_cliente : $('#T_ID_Cliente_Oculto').val(),
  //     idbanco : idbanco,
  //     nomBanco : nomBanco,
  //     cta_banco : cta_banco
  //   }
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_guardarCtasBancosCLT.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Cuenta bancaria se guardo correctamente.", "success");
  //         setTimeout('location.reload()',700);
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //   });
  // });

  // $('.remove-ctasbancosCLT').click(function(){
  //   partida = $(this).parents('tr').find('.partidactasbancosCLT').val();
  //
  //   swal({
  //   title: "Estas Seguro?",
  //   text: "Ya no se podra recuperar el registro! "+ partida +" ",
  //   type: "warning",
  //   showCancelButton: true,
  //   confirmButtonClass: "btn-danger",
  //   confirmButtonText: "Si, Eliminar",
  //   cancelButtonText: "No, cancelar",
  //   closeOnConfirm: false,
  //   closeOnCancel: false
  //   },
  //   function(isConfirm) {
  //     if (isConfirm) {
  //       var data = {
  //         partida : partida
  //       }
  //       $.ajax({
  //         type: "POST",
  //         url: "/Ubicaciones/Contabilidad/AdminContable/actions/admonPersonas_eliminarctasbancosCLT.php",
  //         data: data,
  //         success: 	function(r){
  //           r = JSON.parse(r);
  //           if (r.code == 1) {
  //             swal("Exito", "Método de pago se elimino correctamente.", "success");
  //             setTimeout('location.reload()',700);
  //           } else {
  //             console.error(r.message);
  //           }
  //         },
  //         error: function(x){
  //           console.error(x);
  //         }
  //       });
  //     } else {
  //       swal("Cancelado", "El registro esta a salvo :)", "error");
  //     }
  //   });
  // });



  /* Proveedores */
  // $('#btn_genProv').click(function(){
  //   nombre = $('#nombreN_prov').val();
  //   persona = $('#personaN_prov').val();
  //   rfc = $('#rfcN_prov').val();
  //   curp = $('#curpN_prov').val();
  //   taxid = $('#taxidN_prov').val();
  //   direccion = $('#direccionN_prov').val();
  //
  //   if( nombre == "" ){
  //     alertify.error("Nombre es requerido");
  //     $('#nombreN_prov').focus();
  //     return false;
  //   }
  //   if( persona == "" ){
  //       alertify.error("Persona es requerido");
  //       $('#personaN_prov').focus();
  //       return false;
  //    }
  //   if( persona == "fisica" ){
  //       alertify.error("CURP es requerido");
  //       $('#curpN_prov').focus();
  //       return false;
  //    }
  //
  //    if( rfc == "" ){
  //       alertify.error("RFC es requerido");
  //       $('#rfcN_prov').focus();
  //       return false;
  //     }
  //     if( rfc == "XEXX010101000" && taxid == '' ){
  //        alertify.error("taxID es requerido");
  //        $('#taxidN_prov').focus();
  //        return false;
  //      }
  //
  //     var data = {
  //       nombre : nombre,
  //       persona : persona,
  //       rfc : rfc,
  //       curp : curp,
  //       taxid : taxid,
  //       direccion : direccion
  //     }
  //
  //     $.ajax({
  //       type: "POST",
  //       url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregar.php",
  //       data: data,
  //       success: 	function(r){
  //         r = JSON.parse(r);
  //         if (r.code == 1) {
  //           swal("Exito", "Se generó correctamente.", "success");
  //           setTimeout('document.location.reload()',700);
  //         } else {
  //           swal("RFC existe en sistema", r.data, "error");
  //           console.error(r.message);
  //         }
  //       },
  //       error: function(x){
  //         console.error(x);
  //       }
  //
  //     });
  // });

  // $('#btn_genProv').click(function(){
  // nombre = $('#nombreN_prov').val();
  // persona = $('#personaN_prov').val();
  // rfc = $('#rfcN_prov').val();
  // curp = $('#curpN_prov').val();
  // taxid = $('#taxidN_prov').val();
  // direccion = $('#direccionN_prov').val();
  //
  // if( nombre == "" ){
  //   alertify.error("Nombre es requerido");
  //   $('#nombreN_prov').focus();
  //   return false;
  // }
  // if( persona == "" ){
  //     alertify.error("Persona es requerido");
  //     $('#personaN_prov').focus();
  //     return false;
  //  }
  // if( persona == "fisica" && curp == ""){
  //     alertify.error("CURP es requerido");
  //     $('#curpN_prov').focus();
  //     return false;
  //  }
  //
  //  if( rfc == "" ){
  //     alertify.error("RFC es requerido");
  //     $('#rfcN_prov').focus();
  //     return false;
  //   }
  //   if( rfc == "XEXX010101000" && taxid == '' ){
  //      alertify.error("taxID es requerido");
  //      $('#taxidN_prov').focus();
  //      return false;
  //    }
  //
  //   var data = {
  //     nombre : nombre,
  //     persona : persona,
  //     rfc : rfc,
  //     curp : curp,
  //     taxid : taxid,
  //     direccion : direccion
  //   }
  //
  //   $.ajax({
  //     type: "POST",
  //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregar.php",
  //     data: data,
  //     success: 	function(r){
  //       r = JSON.parse(r);
  //       if (r.code == 1) {
  //         swal("Exito", "Se generó correctamente.", "success");
  //         $('.modal').modal('hide');
  //         // setTimeout('document.location.reload()',700);
  //       } else {
  //         swal("RFC existe en sistema", r.data, "error");
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  //
  //   });
  // });

  $('#bcoSATprov').change(function(){
    banco = $('#bcoSATprov').attr('db-id');
    if( banco == '999' ){
      $('#nomBcoExtj').prop( 'disabled',false );
      $('#nomBco').prop( 'disabled',false );
    }else{
      $('#nomBcoExtj').prop( 'disabled',true )
                      .prop( 'db-id','' )
                      .prop( 'value','' );

      $('#nomBco').prop( 'disabled',true )
                      .prop( 'db-id','' )
                      .prop( 'value','' );
    }
  });

  $('#nomBcoExtj').change(function(){
    bancoExtj = $('#nomBcoExtj').attr('db-id');
    $('#nomBco').val(bancoExtj);
  });

  // $('#btn_agrCtaBcoProv').click(function(){
  //   id_prov = $('#cat-prov').attr('db-id');
  //   banco = $('#bcoSATprov').attr('db-id');
  //   cuenta = $('#cinter').val();
  //   nomBan = $('#nomBco').val();
  //
  //
  //   if( id_prov == "" ){
  //       alertify.error("Seleccione un Proveedor");
  //       $('#cat-prov').focus();
  //       return false;
  //    }
  //
  //    if( banco == "" ){
  //       alertify.error("Seleccione un banco");
  //       $('#bcoSAT').focus();
  //       return false;
  //     }
  //
  //     if( banco == "999" && nomBan == "" ){
  //        alertify.error("Es requerido el nombre del banco");
  //        $('#bcoSAT').focus();
  //        return false;
  //      }
  //
  //     valid_cuenta = validarCtaBancaria($('#cinter'));
  //     if( cuenta == "" || valid_cuenta == false ){
  //        alertify.error("Formato Cuenta bancaria Incorrecto");
  //        $('#cinter').focus();
  //        return false;
  //      }
  //
  //     var data = {
  //         id_prov: id_prov,
  //         banco: banco,
  //         cuenta: cuenta,
  //         nomBan: nomBan
  //     }
  //
  //     $.ajax({
  //       type: "POST",
  //       url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregarBcoCta.php",
  //       data: data,
  //       success: 	function(r){
  //         console.log(data);
  //         r = JSON.parse(r);
  //         if (r.code == 1) {
  //           swal("Exito", "Se generó correctamente.", "success");
  //           $('#cat-prov').change();
  //         } else {
  //           swal("Error", r.data, "error");
  //           console.error(r.message);
  //         }
  //       },
  //       error: function(x){
  //         console.error(x);
  //       }
  //
  //     });
  // });

//   $('#btn_agrCtaBcoProv').click(function(){
//   id_prov = $('#cat-prov').attr('db-id');
//   banco = $('#bcoSATprov').attr('db-id');
//   cuenta = $('#cinter').val();
//   nomBan = $('#nomBco').val();
//
//   if( id_prov == "" ){
//     alertify.error("Seleccione un Proveedor");
//     $('#cat-prov').focus();
//     return false;
//   }
//
//   if( banco == "" ){
//     alertify.error("Seleccione un banco");
//     $('#bcoSAT').focus();
//     return false;
//   }
//
//   if( banco == "999" && nomBan == "" ){
//     alertify.error("Es requerido el nombre del banco");
//     $('#bcoSAT').focus();
//     return false;
//   }
//
//   valid_cuenta = validarCtaBancaria($('#cinter'));
//   if( cuenta == "" || valid_cuenta == false ){
//     alertify.error("Formato Cuenta bancaria Incorrecto");
//     $('#cinter').focus();
//     return false;
//   }
//
//   var data = {
//     id_prov: id_prov,
//     banco: banco,
//     cuenta: cuenta,
//     nomBan: nomBan
//   }
//
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregarBcoCta.php",
//     data: data,
//     success: 	function(r){
//       r = JSON.parse(r);
//       if (r.code == 1) {
//         swal("Exito", "Se generó correctamente.", "success");
//         $('#cat-prov').change();
//       } else {
//         swal("Error", r.data, "error");
//         console.error(r.message);
//       }
//     },
//     error: function(x){
//       console.error(x);
//     }
//   });
// }); // agregar cuenta banco proveedor




  // $('#cat-prov').change(function() {
  //   var $this = $(this);
  //   var dbid = $this.attr('db-id');
  //
  //   if (dbid != "") {
  //     buscarDatosProv(dbid);
  //     buscarCtasProv(dbid);
  //   }
  // });

  // $('#btn_printProv').click(function(){
  //   window.open('/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_impresion.php');
  // });








// BENEFICIARIOS
// $('#btn_printBenef').click(function(){
//   window.open('/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_impresion.php');
// });

$('#ben_razonsocial').change(function(){
  eliminaBlancosIntermedios(this);
  todasMayusculas(this);
});

$('#ben_mrfc').change(function(){
  eliminaBlancosIntermedios(this);
  todasMayusculas(this);
  validaRFC(this);
});

// $('.btn_agregarBeneficiario').click(function(){
//   ben = $('#ben_razonsocial').val();
//   rfc = $('#ben_mrfc').val();
//
//   if( ben == "" ){
//     alertify.error("Escriba un Nombre");
//     $('#ben_razonsocial').focus();
//     return false;
//    }
//
//    validRFC = validaRFC($('#ben_mrfc'));
//    if( rfc == "" || validRFC == false ){
//      $('#ben_mrfc').focus();
//      return false;
//     }
//
//   	var data = {
//   		ben: ben,
//   		rfc: rfc,
//       taxid: $('#ben_taxid').val()
//     }
//
//     $.ajax({
//       type: "POST",
//       url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_agregar.php",
//       data: data,
//       success: 	function(r){
//         r = JSON.parse(r);
//         if (r.code == 1) {
//           swal("Exito", "Se generó correctamente.", "success");
//           $('.modal').modal('hide');
//         } else if (r.code == 500) {
// 			    swal("RFC existe en sistema", r.data, "error");
//           console.error(r.message);
//         }else {
//           swal("No se agrego, favor de reportar", r.data, "error");
//           console.error(r.message);
//         }
//       },
//       error: function(x){
//         console.error(x);
//       }
//     });
//   });

 //  $('#btn_agrCtaBcoBen').click(function(){
  // id_ben = $('#cat-benef').attr('db-id');
  // banco = $('#bcoSATben').attr('db-id');
  // cuenta = $('#cinterben').val();
  // nomBan = $('#nomBcoben').attr('db-id');
  //
  // if( id_ben == "" ){
  //   alertify.error("Seleccione un Beneficiario");
  //   $('#cat-benef').focus();
  //   return false;
  //  }
  //
  //  if( banco == "" ){
  //    alertify.error("Seleccione un banco");
  //    $('#bcoSATben').focus();
  //    return false;
  //  }
  //
  //  if( banco == "999" && nomBan == "" ){
  //    alertify.error("Es requerido el nombre del banco");
  //    $('#bcoSATben').focus();
  //    return false;
  //  }
  //
  //  valid_cuenta = validarCtaBancaria($('#cinterben'));
  //  if( cuenta == "" || valid_cuenta == false ){
  //    alertify.error("Formato Cuenta bancaria Incorrecto");
  //    $('#cinterben').focus();
  //    return false;
  //  }
  //
  //  var data = {
  //    id_ben: id_ben,
  //    banco: banco,
  //    cuenta: cuenta,
  //    nomBan: nomBan
  //  }
 //
 //   $.ajax({
 //     type: "POST",
 //     url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_agregarBcoCtaBen.php",
 //     data: data,
 //     success: 	function(r){
 //       r = JSON.parse(r);
 //       if (r.code == 1) {
 //         swal("Exito", "Se generó correctamente.", "success");
 //         $('#cat-benef').change();
 //       } else {
 //         swal("Error", r.data, "error");
 //         console.error(r.message);
 //       }
 //     },
 //     error: function(x){
 //       console.error(x);
 //     }
 //   });
 // });




// FIN BENEFICIARIOS


});

function fetch_formaPago_sat(){
    $.ajax({
      method: 'POST',
      url: '/Resources/PHP/actions/lst_conta_cs_sat_formapago_2.php',
      success: function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#formaPago-sat-helper').html(r.data);
        } else {
          console.error(r.message);
        }
      }
    })
}



/**** PROVEEDORES ****/


// function buscarCtasProv(id){
//   var data = {
//     id_prov: id
//   }
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_asignarCtasBancarias.php",
//     data: data,
//     success: 	function(r){
//       r = JSON.parse(r);
//       if (r.code == 1) {
//         $('#datosCtasProv').html(r.data);
//       } else {
//           console.error(r.message);
//       }
//     },
//     error: function(x){
//       console.error(x);
//     }
//
//   });
// }


// function btn_bcprov(partida,prov){
//   swal({
//   title: "Estas Seguro?",
//   text: "Ya no se podra recuperar el registro! "+ partida +" ",
//   type: "warning",
//   showCancelButton: true,
//   confirmButtonClass: "btn-danger",
//   confirmButtonText: "Si, Eliminar",
//   cancelButtonText: "No, cancelar",
//   closeOnConfirm: false,
//   closeOnCancel: false
//   },
//   function(isConfirm) {
//     if (isConfirm) {
//       var data = {
//         partida: partida,
//         prov: prov
//       }
//       $.ajax({
//         type: "POST",
//         url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_eliminarCtaBancaria.php",
//         data: data,
//
//           success: 	function(r){
//             r = JSON.parse(r);
//           if (r.code == 1) {
//             swal("Eliminado!", "Se elimino correctamente.", "success");
//             $('#cat-prov').change();
//
//           } else {
//             console.error(r.message);
//           }
//         },
//         error: function(x){
//           console.error(x)
//         }
//       });
//     } else {
//       swal("Cancelado", "El registro esta a salvo :)", "error");
//     }
//   });
// }


// function btn_editProv(){
//   idprov = $('#id_prov').val();
//   nombre = $('#nombre_prov').val();
//   persona = $('#persona_prov').val();
//   rfc = $('#rfc_prov').val();
//   curp = $('#curp_prov').val();
//   taxid = $('#taxid_prov').val();
//   direccion = $('#direccion_prov').val();
//
//   if( persona == "" ){
//       alertify.error("Persona es requerido");
//       $('#persona_prov').focus();
//       return false;
//    }
//   if( persona == "fisica" && curp == ""){
//       alertify.error("CURP es requerido");
//       $('#curp_prov').focus();
//       return false;
//    }
//
//    if( rfc == "" ){
//       alertify.error("RFC es requerido");
//       $('#rfc_prov').focus();
//       return false;
//     }
//     if( rfc == "XEXX010101000" && taxid == '' ){
//        alertify.error("taxID es requerido");
//        $('#taxid_prov').focus();
//        return false;
//      }
//
//     var data = {
//       idprov : idprov,
//       nombre : nombre,
//       persona : persona,
//       rfc : rfc,
//       curp : curp,
//       taxid : taxid,
//       direccion : direccion
//     }
//
//     $.ajax({
//       type: "POST",
//       url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_editar.php",
//       data: data,
//       success: 	function(r){
//         r = JSON.parse(r);
//         if (r.code == 1) {
//           swal("Exito", "Se modificó correctamente.", "success");
//           $('#cat-prov').change();
//         } else {
//           swal("hubo un error", r.data, "error");
//           console.error(r.message);
//
//         }
//       },
//       error: function(x){
//         console.error(x);
//       }
//
//     });
// }


// function btn_editProv(){
//   idprov = $('#id_prov').val();
//   nombre = $('#nombre_prov').val();
//   persona = $('#persona_prov').val();
//   rfc = $('#rfc_prov').val();
//   curp = $('#curp_prov').val();
//   taxid = $('#taxid_prov').val();
//   direccion = $('#direccion_prov').val();
//
//   if( persona == "" ){
//       alertify.error("Persona es requerido");
//       $('#persona_prov').focus();
//       return false;
//    }
//   if( persona == "fisica" ){
//       alertify.error("CURP es requerido");
//       $('#curp_prov').focus();
//       return false;
//    }
//
//    if( rfc == "" ){
//       alertify.error("RFC es requerido");
//       $('#rfc_prov').focus();
//       return false;
//     }
//     if( rfc == "XEXX010101000" && taxid == '' ){
//        alertify.error("taxID es requerido");
//        $('#taxid_prov').focus();
//        return false;
//      }
//
//     var data = {
//       idprov : idprov,
//       nombre : nombre,
//       persona : persona,
//       rfc : rfc,
//       curp : curp,
//       taxid : taxid,
//       direccion : direccion
//     }
//
//     $.ajax({
//       type: "POST",
//       url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_editar.php",
//       data: data,
//       success: 	function(r){
//         console.log(r);
//         r = JSON.parse(r);
//         if (r.code == 1) {
//           swal("Exito", "Se modificó correctamente.", "success");
//           $('#cat-prov').change();
//         } else {
//           swal("RFC existe en sistema", r.data, "error");
//           console.error(r.message);
//         }
//       },
//       error: function(x){
//         console.error(x);
//       }
//
//     });
// }

function asignarProvRegPol(partida){
    id_prov = $('#lstProv').attr('db-id');
    if( id_prov == '' ){
      alertify.error("Proveedor es requerido");
      $('#lstProv').focus();
      return false;
    }

    var data = {
      id_prov: id_prov,
      partida: partida,
      id_poliza: $('#mst-poliza').val()
    }

    $.ajax({
      type: "POST",
      url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregarProvDetallePoliza.php",
      data: data,
      success: 	function(request){
        r = JSON.parse(request);
        if (r.code == 1) {
          swal("Agregado!", "Se agrego correctamente.", "success");
          polReg_Det();
        }
      }
    })

}

function borrarProvRegPol(partida){
  swal({
	title: "Estas Seguro?",
	text: "Ya no se podra recuperar el Proveedor del registro! "+ partida +" ",
	type: "warning",
	showCancelButton: true,
	confirmButtonClass: "btn-danger",
	confirmButtonText: "Si, Eliminar",
	cancelButtonText: "No, cancelar",
	closeOnConfirm: false,
	closeOnCancel: false
	},
	function(isConfirm) {
		if (isConfirm) {

      var data = {
        partida: partida,
        id_poliza: $('#mst-poliza').val()
      }

      $.ajax({
        type: "POST",
        url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_agregarProvDetallePoliza.php",
        data: data,
        success: 	function(request){
          r = JSON.parse(request);
          if (r.code == 1) {
            swal("Borrado!", "Se borro correctamente.", "success");
            polReg_Det();
          }
        }
      })

    } else {
      swal("Cancelado", "El registro esta a salvo :)", "error");
    }
  });
}

// MOSTRAR DETALLE DE LA POLIZA
function polReg_Det(){
  var data = {
    id_poliza: $('#mst-poliza').val()
  }
  $.ajax({
    type: "POST",
    url: "/Ubicaciones/Contabilidad/AdminContable/actions/proveedores_detallePoliza.php",
    data: data,
    success: 	function(request){
      r = JSON.parse(request);

      if (r.code == 1) {
        $('#registrosDetPol').html(r.data);
      }
    }
  });
}


function fetch_catalogoBancosSAT(){
    $.ajax({
      method: 'POST',
      url: '/Resources/PHP/actions/lst_conta_cs_sat_bancos.php',
      success: function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#catalogo-bancossat-helper').html(r.data);
        } else {
          console.error(r.message);
        }
      }
    })
}

function fetch_catalogoBancosExt(){
  $.ajax({
    method: 'POST',
    url: '/Resources/PHP/actions/lst_conta_cs_bancos_extranjeros.php',
    success: function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#catalogo-bancosext-helper').html(r.data);
      } else {
        console.error(r.message);
      }
    }
  })
}



// FUNCIONES BENEFICIARIOS
// function btn_editBen(){
//   ben = $('#nombre').val();
//   rfc = $('#rfc').val();
//
//   if( ben == "" ){
//     alertify.error("Escriba un Nombre");
//     $('#nombre').focus();
//     return false;
//    }
//
//    if( rfc == "" ){
//       alertify.error("Escriba un RFC");
//       $('#rfc').focus();
//       return false;
//     }
//
//     var data = {
//       id_ben: $('#cat-benef').attr('db-id'),
//       ben: ben,
//       rfc: rfc
//     }
//
//     $.ajax({
//       type: "POST",
//       url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_editar.php",
//       data: data,
//       success: 	function(r){
//         r = JSON.parse(r);
//         if (r.code == 1) {
//           swal("Exito", "Se modificó correctamente.", "success");
//           $('#cat-benef').change();
//         } else {
//           swal("RFC existe en sistema", r.data, "error");
//           console.error(r.message);
//         }
//       },
//       error: function(x){
//         console.error(x);
//       }
//
//     });
// }

// function btn_bcben(partida,ben){
//   swal({
//   title: "Estas Seguro?",
//   text: "Ya no se podra recuperar el registro! "+ partida +" ",
//   type: "warning",
//   showCancelButton: true,
//   confirmButtonClass: "btn-danger",
//   confirmButtonText: "Si, Eliminar",
//   cancelButtonText: "No, cancelar",
//   closeOnConfirm: false,
//   closeOnCancel: false
//   },
//   function(isConfirm) {
//     if (isConfirm) {
//       var data = {
//         partida: partida,
//         ben: ben
//       }
//       $.ajax({
//         type: "POST",
//         url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_eliminar.php",
//         data: data,
//           success: 	function(r){
//             r = JSON.parse(r);
//           if (r.code == 1) {
//             swal("Eliminado!", "Se elimino correctamente.", "success");
//             $('#cat-benef').change();
//           } else {
//             console.error(r.message);
//           }
//         },
//         error: function(x){
//           console.error(x)
//         }
//       });
//     } else {
//       swal("Cancelado", "El registro esta a salvo :)", "error");
//     }
//   });
// }

// function buscarCtasBenef(id){
//   var data = {
//     id_ben: id
//   }
//
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_asignarCtasBancarias.php",
//     data: data,
//     success: 	function(r){
//       r = JSON.parse(r);
//       if (r.code == 1) {
//         $('#lista_datosCtasBen').html(r.data);
//       } else {
//           console.error(r.message);
//       }
//     },
//     error: function(x){
//       console.error(x);
//     }
//   });
// }

// function buscarDatosBenef(id){
//   var data = {
//     id_ben: id
//   }
//   $.ajax({
//     type: "POST",
//     url: "/Ubicaciones/Contabilidad/AdminContable/actions/beneficiarios_datosGenerales.php",
//     data: data,
//     success: 	function(r){
//       r = JSON.parse(r);
//       if (r.code == 1) {
//         $('#datosGeneralesBen').html(r.data);
//       } else {
//           console.error(r.message);
//       }
//     },
//     error: function(x){
//       console.error(x);
//     }
//
//   });
// }
// FIN FUNCIONES BENEFICIARIOS
