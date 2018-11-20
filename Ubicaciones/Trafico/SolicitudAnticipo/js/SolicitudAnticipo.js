$(document).ready(function(){

  $('#guardar-solAnticipo').click(function(){
    Suma_Subtotales();
        $('#guardar').prop('disabled',true);
        $('#mensaje').html("Guardando . . .");

        var data = {
          honorarios: {},
          cargos: {},
          pocme: {},
          T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
          Txt_Usuario : $('#Txt_Usuario').val(),
          T_IGED_1 : $('#T_IGED_1').val(),
          T_IGED_2 : $('#T_IGED_2').val(),
          T_IGED_3 : $('#T_IGED_3').val(),
          T_IGED_4 : $('#T_IGED_4').val(),
          T_IGED_5 : $('#T_IGED_5').val(),
          T_IGED_6 : $('#T_IGED_6').val(),
          T_IGED_7 : $('#T_IGED_7').val(),
          T_IGED_8 : $('#T_IGED_8').val(),
          T_IGED_9 : $('#T_IGED_9').val(),
          T_IGED_10 : $('#T_IGED_10').val(),
          T_IGED_11 : $('#T_IGED_11').val(),
          T_IGED_12 : $('#T_IGED_12').val(),
          T_IGED_13 : $('#T_IGED_13').val(),
          T_IGET_1 : $('#T_IGET_1').val(),
          T_IGET_2 : $('#T_IGET_2').val(),
          T_IGET_3 : $('#T_IGET_3').val(),
          T_IGET_4 : $('#T_IGET_4').val(),
          T_IGET_5 : $('#T_IGET_5').val(),
          T_IGET_6 : $('#T_IGET_6').val(),
          T_IGET_7 : $('#T_IGET_7').val(),
          T_IGET_8 : $('#T_IGET_8').val(),
          T_IGET_9 : $('#T_IGET_9').val(),
          T_IGET_10 : $('#T_IGET_10').val(),
          T_IGET_11 : $('#T_IGET_11').val(),
          T_IGET_12 : $('#T_IGET_12').val(),
          T_IGET_13 : $('#T_IGET_13').val(),
          T_ID_Aduana_Oculto : $('#T_ID_Aduana_Oculto').val(),
          T_ID_Almacen_Oculto : $('#T_ID_Almacen_Oculto').val(),
          T_ID_Cliente_Oculto : $('#T_ID_Cliente_Oculto').val(),
          T_Nombre_Cliente : $('#T_Nombre_Cliente').val(),
          T_Cliente_Calle : $('#T_Cliente_Calle').val(),
          T_Cliente_No_Ext : $('#T_Cliente_No_Ext').val(),
          T_Cliente_No_Int : $('#T_Cliente_No_Int').val(),
          T_Cliente_Colonia : $('#T_Cliente_Colonia').val(),
          T_Cliente_CP : $('#T_Cliente_CP').val(),
          T_Cliente_Ciudad : $('#T_Cliente_Ciudad').val(),
          T_Cliente_Estado : $('#T_Cliente_Estado').val(),
          T_Cliente_Pais : $('#T_Cliente_Pais').val(),
          T_Cliente_taxid : $('#T_Cliente_taxid').val(),
          T_Cliente_RFC : $('#T_Cliente_RFC').val(),
          T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
          T_Tipo : $('#T_Tipo').val(),
          T_Valor : $('#T_Valor').val(),
          T_Peso : $('#T_Peso').val(),
          T_Dias : $('#T_Dias').val(),
          T_Valor_Custodia_Aer : $('#T_Valor_Custodia_Aer').val(),
          T_Valor_Manejo_Aer : $('#T_Valor_Manejo_Aer').val(),
          T_Valor_Almacenaje_Aer : $('#T_Valor_Almacenaje_Aer').val(),
          T_Valor_Total_Maniobras : $('#T_Valor_Total_Maniobras').val(),
          T_Subsidio : $('#T_Subsidio').val(),
          T_derechosPagados : $('#T_derechosPagados').val(),
          T_Honorarios_Porcentaje : $('#T_Honorarios_Porcentaje').val(),
          T_Honorarios_Base_Honorarios : $('#T_Honorarios_Base_Honorarios').val(),
          T_Honorarios_Descuento : $('#T_Honorarios_Descuento').val(),
          T_Honorarios_Minimo : $('#T_Honorarios_Minimo_Honorarios').val(),
          T_Honorarios_0 : $('#T_Honorarios_0').val(),
          T_Hcta_0 : $('#T_Hcta_0').val(),
          T_Hps_0 : $('#T_Hps_0').val(),
          T_Honorarios_Importe_0 : $('#T_Honorarios_Importe_0').val(),
          T_Honorarios_IVA_0 : $('#T_Honorarios_IVA_0').val(),
          T_Honorarios_RET_0 : $('#T_Honorarios_RET_0').val(),
          T_Honorarios_Subtotal_0 : $('#T_Honorarios_Subtotal_0').val(),
          T_Total_Importes : $('#T_Total_Importes').val(),
          T_Total_IVA : $('#T_Total_IVA').val(),
          T_IVA_RETENIDO : $('#T_IVA_RETENIDO').val(),
          T_Total_Gral : $('#T_Total_Gral').val(),
          T_Total_MN_Extranjera : $('#T_Total_MN_Extranjera').val(),
          T_SALDO_GRAL : $('#T_SALDO_GRAL').val(),
          T_IVA_Porcentaje : $('#T_IVA_Porcentaje').val(),
          T_SUBTOTAL_HON : $('#T_SUBTOTAL_HON').val(),
          Txt_Total_MN_Extranjera : $('#Txt_Total_MN_Extranjera').val(),
          T_Cta_Gastos : $('#T_Cta_Gastos').val(),
          T_Total_Anticipos : $('#T_Total_Anticipos').val(),
          Txt_Total_Importe : $('#Txt_Total_Importe').val(),
          Txt_Total_IVA : $('#Txt_Total_IVA').val(),
          Txt_SUBTOTAL_HON : $('#Txt_SUBTOTAL_HON').val(),
          Txt_IVA_RETENIDO : $('#Txt_IVA_RETENIDO').val(),
          Txt_Total_Gral : $('#Txt_Total_Gral').val(),
          Txt_Cta_Gastos : $('#Txt_Cta_Gastos').val(),
          Txt_Saldo_Gral : $('#Txt_Saldo_Gral').val(),
          Txt_Total_Pagos : $('#Txt_Total_Pagos').val(),
          T_Total_Pagos : $('#T_Total_Pagos').val(),
          Txt_Honorarios : $('#Txt_Total_Importe').val(),
          T_POCME_Total : $('#T_POCME_Total').val(),
          T_POCME_Tipo_Cambio : $('#T_POCME_Tipo_Cambio').val(),
          T_POCME_Total_MN : $('#T_POCME_Total_MN').val()
        };
/*
        depositos: {},
        CUSTOMS : $('#CUSTOMS').val(),
        T_metodoPago : $('#T_metodoPago').val(),
        T_usoCFDI: $('#T_usoCFDI').val()
        T_FormaPago : $('#T_FormaPago').val(),
        T_CuentaPago : $('#T_CuentaPago').val(),
        T_Moneda : $('#T_Moneda').val(),
        T_monedaTipoCambio : $('#T_monedaTipoCambio').val()
        Total_Letra : $('#total_CuentaGastos').val()
        Txt_Total_Anticipos : $('#Txt_Total_Anticipos').val(),
*/
        $( ".elemento-pocme" ).each(function(i) {
          var parsed_data = {
            cantidad: $(this).find('.cantidad').val(),
            idcuenta: $(this).find('.id-cuenta').val(),
            idconcepto: $(this).find('.id-concepto').val(),
            concepto_esp: $(this).find('.concepto-espanol').val(),
            concepto_ing: $(this).find('.concepto-ingles').val(),
            descripcion: $(this).find('.descripcion').val(),
            importe: $(this).find('.importe').val(),
            subtotal: $(this).find('.subtotal').val()
          }
          data.pocme[i] = parsed_data;
        });

        $( ".elemento-cargos" ).each(function(i) {
          var parsed_data = {
            idcuenta: $(this).find('.id-cuenta').val(),
            idconcepto: $(this).find('.id-concepto').val(),
            concepto_esp: $(this).find('.concepto-espanol').val(),
            subtotal: $(this).find('.subtotal').val()
          }
          data.cargos[i] = parsed_data;
        });

        $( ".elemento-honorarios" ).each(function(i) {
          var parsed_data = {
            idcuenta: $(this).find('.id-cuenta').val(),
            idcveprod: $(this).find('.id-cveProd').val(),
            concepto_esp: $(this).find('.concepto-espanol').val(),
            importe: $(this).find('.importe').val(),
            iva: $(this).find('.iva').val(),
            ret: $(this).find('.ret').val(),
            subtotal: $(this).find('.subtotal').val()
          }
          data.honorarios[i] = parsed_data;
        });
/*
        $( ".elemento-depositos" ).each(function(i) {
          var parsed_data = {
            idDeposito: $(this).find('.id-deposito').val(),
            importe: $(this).find('.importe').val(),
            dep_aplic: $(this).find('.dep_aplic').val(),
          }
          data.depositos[i] = parsed_data;
        });
*/
        console.log(data);

        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/solAnticipo_agregar.php",
          data: data,
          success: 	function(r){
            r = JSON.parse(r);
            if (r.code == 1) {
              folio = r.data;
              alertify.alert('Folio: '+folio, 'Generado correctamente' , function(){
                //setTimeout('document.location.reload()',700);
                setTimeout("window.location.replace('/conta6/Ubicaciones/Trafico/SolicitudAnticipo/SolAnticipo.php')",700);
              });
            } else {
              console.error(r.message);
            }
          },
          error: function(x){
            console.error(x);
          }
        });
  });




});

$('#modificar-solAnticipo').click(function(){
  folio = $('#id_cuenta_captura').val();

  Suma_Subtotales();
      $('#mensaje').html("Guardando . . .");

      var data = {
        folio: folio,
        T_No_calculoTarifa : $('#T_No_calculoTarifa').val(),
        Txt_Usuario : $('#Txt_Usuario').val(),
        T_IGED_1 : $('#T_IGED_1').val(),
        // T_IGED_2 : $('#T_IGED_2').val(),
        T_ID_Aduana_Oculto : $('#T_ID_Aduana_Oculto').val(),
        T_ID_Almacen_Oculto : $('#T_ID_Almacen_Oculto').val(),
        T_ID_Cliente_Oculto : $('#T_ID_Cliente_Oculto').val(),
        T_Nombre_Cliente : $('#T_Nombre_Cliente').val(),
        T_Cliente_Calle : $('#T_Cliente_Calle').val(),
        T_Cliente_No_Ext : $('#T_Cliente_No_Ext').val(),
        T_Cliente_No_Int : $('#T_Cliente_No_Int').val(),
        T_Cliente_Colonia : $('#T_Cliente_Colonia').val(),
        T_Cliente_CP : $('#T_Cliente_CP').val(),
        T_Cliente_Ciudad : $('#T_Cliente_Ciudad').val(),
        T_Cliente_Estado : $('#T_Cliente_Estado').val(),
        T_Cliente_Pais : $('#T_Cliente_Pais').val(),
        T_Cliente_taxid : $('#T_Cliente_taxid').val(),
        T_Cliente_RFC : $('#T_Cliente_RFC').val(),
        T_Proveedor_Destinatario : $('#T_Proveedor_Destinatario').val(),
        T_Tipo : $('#T_Tipo').val(),
        T_Valor : $('#T_Valor').val(),
        T_Peso : $('#T_Peso').val(),
        T_Dias : $('#T_Dias').val(),
        T_Valor_Custodia_Aer : $('#T_Valor_Custodia_Aer').val(),
        T_Valor_Manejo_Aer : $('#T_Valor_Manejo_Aer').val(),
        T_Valor_Almacenaje_Aer : $('#T_Valor_Almacenaje_Aer').val(),
        T_Valor_Total_Maniobras : $('#T_Valor_Total_Maniobras').val(),
        T_Subsidio : $('#T_Subsidio').val(),
        T_derechosPagados : $('#T_derechosPagados').val(),
        T_Honorarios_Porcentaje : $('#T_Honorarios_Porcentaje').val(),
        T_Honorarios_Base_Honorarios : $('#T_Honorarios_Base_Honorarios').val(),
        T_Honorarios_Descuento : $('#T_Honorarios_Descuento').val(),
        T_Honorarios_Minimo : $('#T_Honorarios_Minimo_Honorarios').val(),
        T_Total_Importes : $('#T_Total_Importes').val(),
        T_Total_IVA : $('#T_Total_IVA').val(),
        T_IVA_RETENIDO : $('#T_IVA_RETENIDO').val(),
        T_Total_Gral : $('#T_Total_Gral').val(),
        T_Total_MN_Extranjera : $('#T_Total_MN_Extranjera').val(),
        T_SALDO_GRAL : $('#T_SALDO_GRAL').val(),
        T_IVA_Porcentaje : $('#T_IVA_Porcentaje').val(),
        T_SUBTOTAL_HON : $('#T_SUBTOTAL_HON').val(),
        Txt_Total_MN_Extranjera : $('#Txt_Total_MN_Extranjera').val(),
        T_Cta_Gastos : $('#T_Cta_Gastos').val(),
        T_Total_Anticipos : $('#T_Total_Anticipos').val(),
        Txt_Total_Importe : $('#Txt_Total_Importe').val(),
        Txt_Total_IVA : $('#Txt_Total_IVA').val(),
        Txt_SUBTOTAL_HON : $('#Txt_SUBTOTAL_HON').val(),
        Txt_IVA_RETENIDO : $('#Txt_IVA_RETENIDO').val(),
        Txt_Total_Gral : $('#Txt_Total_Gral').val(),
        Txt_Cta_Gastos : $('#Txt_Cta_Gastos').val(),
        Txt_Total_Anticipos : $('#Txt_Total_Anticipos').val(),
        Txt_Saldo_Gral : $('#Txt_Saldo_Gral').val(),
        Txt_Total_Pagos : $('#Txt_Total_Pagos').val(),
        T_Total_Pagos : $('#T_Total_Pagos').val(),
        Txt_Honorarios : $('#Txt_Total_Importe').val(),
        T_POCME_Total : $('#T_POCME_Total').val(),
        T_POCME_Tipo_Cambio : $('#T_POCME_Tipo_Cambio').val(),
        T_POCME_Total_MN : $('#T_POCME_Total_MN').val(),
        dge: {},
        pocme: {},
        cargos: {},
        honorarios: {},
        pocmeDelete: {},
        cargoDelete: {},
        honDelete: {}
      }

      console.log(data);
/*
depositos: {},
depositosDisponibles: {}
CUSTOMS : $('#CUSTOMS').val(),
T_metodoPago : $('#T_metodoPago').val(),
T_usoCFDI: $('#T_usoCFDI').val(),
T_FormaPago : $('#T_FormaPago').val(),
T_CuentaPago : $('#T_CuentaPago').val(),
T_Moneda : $('#T_Moneda').val(),
T_monedaTipoCambio : $('#T_monedaTipoCambio').val(),
Total_Letra : $('#total_CuentaGastos').val(),
*/
      $( ".elementos-dge" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          descripcion: $(this).find('.descripcion').val()
        }
        data.dge[i] = parsed_data;
      });

      $( ".elemento-pocme" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          cantidad: $(this).find('.cantidad').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          concepto_ing: $(this).find('.concepto-ingles').val(),
          descripcion: $(this).find('.descripcion').val(),
          importe: $(this).find('.importe').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.pocme[i] = parsed_data;
      });

      $( ".elemento-pocme-eliminar" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val()
        }
        data.pocmeDelete[i] = parsed_data;
      });

      $( ".elemento-cargos" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idconcepto: $(this).find('.id-concepto').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.cargos[i] = parsed_data;
      });

      $( ".elemento-honorarios" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idcuenta: $(this).find('.id-cuenta').val(),
          idcveprod: $(this).find('.id-cveProd').val(),
          concepto_esp: $(this).find('.concepto-espanol').val(),
          importe: $(this).find('.importe').val(),
          iva: $(this).find('.iva').val(),
          ret: $(this).find('.ret').val(),
          subtotal: $(this).find('.subtotal').val()
        }
        data.honorarios[i] = parsed_data;
      });
/*
      $( ".elemento-depositos" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idDeposito: $(this).find('.id-deposito').val(),
          importe: $(this).find('.importe').val(),
        }
        data.depositos[i] = parsed_data;
      });

      $( ".elemento-depositos-disponibles" ).each(function(i) {
        var parsed_data = {
          idpartida: $(this).find('.id-partida').val(),
          idDeposito: $(this).find('.id-deposito').val(),
          importe: $(this).find('.importe').val(),
        }
        data.depositosDisponibles[i] = parsed_data;
      });
*/
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/solAnticipo_modificar.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          if (r.code == 1) {
            console.log(r);
            //folio = r.data;
            alertify.alert('Folio: '+folio, 'Actualizado correctamente' , function(){
              //setTimeout('document.location.reload()',700);
              //setTimeout("window.location.replace('/conta6/Ubicaciones/Trafico/SolicitudAnticipo/SolAnticipo.php')",700);
            });

          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });
});


//BUSCAR PROFORMAS
function solAntModificar(referencia,dias,cliente,almacen,tipo,valor,peso,cuenta,shipper,consolidado,inbond,entradas,flete,reexpedicion,cobrarFlete,status_flete,entradasAdicionales){
  window.location.replace('solAnticipo_modificar.php?referencia='+referencia+'&dias='+dias+'&id_cliente='+cliente+'&almacen='+almacen+'&tipo='+tipo+'&valor='+valor+'&peso='+peso+'&cuenta='+cuenta+'&shipper='+shipper+'&consolidado='+consolidado+'&inbond='+inbond+'&entradas='+entradas+'&flete='+flete+'&reexpedicion='+reexpedicion+'&cobrarFlete='+cobrarFlete
    +'&status_flete='+status_flete+'&entradasAdicionales='+entradasAdicionales);
}

function solAntConsultar(cuenta,accion){
    window.location.replace('solAnticipo_Consultar.php?cuenta='+cuenta+'&accion='+accion);
}
function solAntImprimir(cuenta){
  window.open('solAnticipo_impresion.php?cuenta='+cuenta);
}
function solAntEliminar(partida){
  swal({
  title: "Estas Seguro?",
  text: "Ya no se podra recuperar el registro! "+ partida +" ",
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
        partida: partida
      }
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/solAnticipo_eliminar.php",
        data: data,

          success: 	function(r){
            r = JSON.parse(r);
            console.log(r);
            if (r.code == 1) {
              swal("Eliminado!", "Se elimino correctamente.", "success");
              setTimeout('document.location.reload()',700);
            } else {
                   console.error(r.message);
            }
        },
        error: function(x){
          console.error(x)
        }
      });
    } else {
      swal("Cancelado", "El registro esta a salvo :)", "error");
    }
  });
}
