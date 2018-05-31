function Actualiza_Cuenta(){

		st = $('#detpol-cuenta').val();
    nombreCta = st.split('-');

		if(st.substring(0,2) == '05' || st.substring(0,7) == '0147' || st.substring(0,4) == '0148' || st.substring(0,4) == '0149' || st.substring(0,4) == '0420' || st.substring(0,4) == '0430' || st.substring(0,10) == '0168-00005'
			|| st.substring(0,10) == '0201-00002' || st.substring(0,10) == '0201-00003' || st.substring(0,10) == '0201-00004' || st.substring(0,10) == '0201-00005' || st.substring(0,10) == '0201-00006' || st.substring(0,10) == '0201-00007' ){

        // SI ES LA CUENTA 05,0147,0148,0149 ACTIVAR GASTO OFICINA
        $('#detpol-gtoficina').prop( 'disabled', false );
        $('#detpol-gtoficina').val('');
        $('#detpol-cliente').attr('db-id','')

		}else{
      $('#detpol-gtoficina').prop( 'disabled', true );
      $('#detpol-gtoficina').val('');
			alert("llego1");
		}

		if(st.substring(0,4) == '0110'){
			alert("llego2");
			$('#detpol-referencia').focus();
      alertify.error("Referencia es requerido");
      $('#detpol-cliente').val('');
      $('#detpol-cliente').attr('db-id','');

		}else{
      $('#detpol-cliente').attr('action','clientes');
		}

    $('#detpol-concepto').val($.trim(nombreCta[2]));

}


function Actualiza_Gasto_Oficina(){
		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = $('#detpol-concepto').val();

		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#detpol-gtoficina').val();
    descOficina = "";
		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 0){ descOficina = ""; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

    desc = desc + " " + descOficina;
 		$('#detpol-concepto').val(desc);
}

function descripOficina(){
		desc = $('#detpol-concepto').val();

		/********************************************************************************************************
		PARAMETRO DE DISTINCION EN EL GASTO, NO BASTA SOLO CON ASIGNAR LA OFICINA.
		CUANDO ES EL CASO QUE HAY MAS DE UN REGISTRO IGUAL EN LA MISMA POLIZA, SE REPIDE LA PARTIDA EN EL GASTO;
		PARA EVITAR ESTO SE ASIGNA UN PARAMETRO QUE HACE LA DISTINCION EN LA DESCRIPCION
		*/
		desc = desc.replace(" ::160::","");
		desc = desc.replace(" ::240::","");
		desc = desc.replace(" ::430::","");
		desc = desc.replace(" ::470::","");
		desc = desc.replace(" ::241::","");

		gastoOficina = $('#detpol-gtoficina').val();
		descOficina = "";

		if (gastoOficina == 160){ descOficina = "::160::"; }
		if (gastoOficina == 240){ descOficina = "::240::"; }
		if (gastoOficina == 430){ descOficina = "::430::"; }
		if (gastoOficina == 470){ descOficina = "::470::"; }
		if (gastoOficina == 241){ descOficina = "::241::"; }

 		desc = desc + " " + descOficina;
		$('#detpol-concepto').val(desc);
}


$(document).ready(function(){
	if( $('#mstpol-cancela') == 0){ $('#detpol-btnguardar').prop( 'disabled', false ); }

	$('#detpol-btnguardar').click(function(){
    //Código para editar el modal, declaración de variables y ajax.

        var data = {
					//Usuario = '<?php echo $Usuario; ?>';
					//Aduana = document.formPoliza.T_Aduana.value;
				  id_poliza: $('#id_poliza').val(),
					fecha: $('#mstpol-fecha').val(),
					id_referencia: $('#detpol-referencia').attr('db-id'),
					tipo: $('#mstpol-tipo').val(),
					cuenta: $('#detpol-cuenta').attr('db-id'),
					id_cliente: $('#detpol-cliente').attr('db-id'),
					documento: $('#detpol-documento').val(),
					factura: $('#detpol-factura').attr('db-id'),
					anticipo: $('#detpol-anticipo').attr('db-id'),
					cheque: $('#detpol-cheque').attr('db-id'),
					cargo: $('#detpol-cargo').val(),
					abono: $('#detpol-abono').val(),
					desc: $('#detpol-concepto').val(),
					gastoOficina: $('#detpol-gtoficina').attr('db-id')
        }

        $.ajax({
          type: "POST",
          url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/agregar.php",
          data: data,
          success: 	function(r){
            console.log(r);
            r = JSON.parse(r);
            if (r.code == 1) {
              swal("Exito", "La cuenta se actualizó correctamente.", "success");
              $('.real-time-search').keyup();
            } else {
              console.error(r.message);
            }
          },
          error: function(x){
            console.error(x);
          }

        });


    //$('.modal').modal('hide');
  });

  $('.consultar').click(function(){
        var accion = $(this).attr('accion');
        var status = $(this).attr('status');

        $('#selecTipoPoliza').find('a').css('color', "");
        $('#selecTipoPoliza').find('a').css('font-size', "");
        $(this).attr('status', 'abierto');
        $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
        $(this).css('font-size', '20px');


        switch (accion) {
          case "poldiario":
            $('#polizadiario').fadeIn();
            $('#polizaingresos').hide();
            $('#cheques').hide();
            $('#anticipos').hide();
            break;

          case "polingreso":
            $('#polizaingresos').fadeIn();
            $('#polizadiario').hide();
            $('#cheques').hide();
            $('#anticipos').hide();
            break;
          case "gcheque":
            $('#cheques').fadeIn();
            $('#polizadiario').hide();
            $('#polizaingresos').hide();
            $('#anticipos').hide();
            break;

          case "ganticipo":
            $('#anticipos').fadeIn();
            $('#polizadiario').hide();
            $('#polizaingresos').hide();
            $('#cheques').hide();
            break;

            case "dtospol":
            if (status == 'cerrado') {
              $('#datospoliza').fadeIn();
              $(this).attr('status', 'abierto');
              $(this).css('cssText', 'color: rgb(209, 28, 28) !important');
              $(this).css('font-size', '20px');
            } else {
              $('#datospoliza').fadeOut();
              $(this).attr('status', 'cerrado');
              $(this).css('color', "");
              $(this).css('font-size', "");
            }
              break;
          default:
          console.error("Something went terribly wrong...");

        }

    });


    $('#genFolioPolDia').click(function(){
      if($('#diafecha').val() == ""){
        //alertify.error("Seleccione una fecha");
        alert("Seleccione una fecha");
        $('#diafecha').focus();
        return false;
      }

      if($('#diaconcepto').val() == ""){
        //alertify.error("Escriba un concepto");
        alert("Escriba un concepto");
        $('#diaconcepto').focus();
        return false;
      }

      var data = {
        diafecha: $('#diafecha').val(),
        diaconcepto: $('#diaconcepto').val()
      }

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/generarFolioPoliza.php",
        data: data,
        success: 	function(request){
          $('#diapoliza').val(request);
          $('#diapoliza').attr(request);
        }


      });

    });


    $('#detallepoliza').click(function(){
      alert("llego");
      var data = {
        id_poliza: $('#id_poliza').val()
      }

      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/tabladetallepoliza.php",
        data: data,
        success: 	function(request){
          $('#tabla_detallepoliza').html(request);
        }


      });
    });
/*
    $('#genFolioPolDia').click(function(){

        if($('#diafecha').val() == ""){
          //alertify.error("Seleccione una fecha");
          alert("Seleccione una fecha");
          $('#diafecha').focus();
          return false;
        }

        if($('#diaconcepto').val() == ""){
          //alertify.error("Escriba un concepto");
          alert("Escriba un concepto");
          $('#diaconcepto').focus();
          return false;
        }

        var data = {
            diafecha: $('#diafecha').val(),
            diaconcepto: $('#diaconcepto').val(),
          }

          $.ajax({
            type: "POST",
            url: "/conta6/Ubicaciones/Contabilidad/polizas/actions/generarFolioPoliza.php",
            data: data,
            success: 	function(r){
              //console.log(r);
              //r = JSON.parse(r);
              if (r.code == 1) {
                  $('#respuesta').html(r);
                  $('#diapoliza').val(r);

                //swal("Exito", "La cuenta se actualizó correctamente.", "success");
                //$('.real-time-search').keyup();
              } else {
                console.error(r.message);
              }
            },
            error: function(x){
              console.error(x);
            }

          });


      //$('.modal').modal('hide');
    });
*/

      $('tbody').on('click', '.consultar-polizaMST', function(){
        //var dbid = $(this).attr('db-id');
        var dbid = $('this').attr('db-id');
        var tar_modal = $($(this).attr('href'));
        var fetch_polizaMSTdiario = $.ajax({
        method: 'POST',
        data: {dbid: dbid},
        url: 'actions/fetchPolizaMST_diario.php'
        });

        fetch_polizaMSTdiario.done(function(r){
            r = JSON.parse(r);
            if (r.code == 1) {

              for (var key in r.data) {
                if ($('#' + key).is('select')) {
                  continue;
                }

                if (r.data.hasOwnProperty(key)) {
                  $('#' + key).html(r['data'][key]).val(r['data'][key]).addClass('tiene-contenido');
                  if ( typeof($('#'+key).attr('db-id')) != 'undefined' && $('#'+key).attr('db-id') !== false) {
                    $('#' + key).attr('db-id', r['data'][key]);
                  }
                }
              }

              $('#pk_id_poliza').val(r.data.pk_id_poliza);
            //  $('#btn_detallePoliza').attr('db-id', r.data.diapoliza);

              tar_modal.modal('show');
            } else {
              console.error(r);
            }
          })

      });




        $('#btn_detallePoliza').click(function(){
          //Código para editar el modal, declaración de variables y ajax.
          $diapoliza= $('#diapoliza').val();
          console.error($diapoliza);


              var data = {
                dia_fecha: $('#diafecha').val(),
                dia_concepto: $('#diaconcepto').val(),
                dia_poliza: $('#diapoliza').val()
              }

              $.ajax({
                type: "POST",
                url: "/conta6/Ubicaciones/Contabilidad/polizas/consultapolizaMST.php",
                data: data,
                success: 	function(r){
                  console.log(r);
                  r = JSON.parse(r);
                  if (r.code == 1) {
                    swal("Exito", "La cuenta se actualizó correctamente.", "success");
                    $('.real-time-search').keyup();
                  } else {
                    console.error(r.message);
                  }
                },
                error: function(x){
                  console.error(x);
                }

              });


          $('.modal').modal('hide');

        })

      //  $('.real-time-search').keyup();

        ///fetch_cuentas_sat();
});
