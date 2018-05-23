$(document).ready(function(){

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


    $('tbody').on('click', '.editar-cuenta', function(){
      var dbid = $(this).attr('db-id');
      var tar_modal = $($(this).attr('href'));
      var fetch_cuenta = $.ajax({
        method: 'POST',
        data: {dbid: dbid},
        url: 'actions/fetchCuentaDetalle.php'
      });

      fetch_cuenta.done(function(r){
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

        $('#s_cta_status').val(r.data.s_cta_status);
        $('#medit-ctas').attr('db-id', r.data.pk_id_cuenta);

        tar_modal.modal('show');
        } else {
          console.error(r);
        }
      })

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
          $('#respuesta').html(request);
          $('#diapoliza').val(request);
          $('#diapoliza').attr(request);
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




  });
