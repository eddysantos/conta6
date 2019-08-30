$(document).ready(function(){
listaEmpleados();

// MOSTRAR / OCULTAR DIVS
  $('.emp').click(function(){
    var accion = $(this).attr('accion');

  switch (accion) {
      case "dgen":
        $('#contorno1').fadeIn();
        $('#contorno2,#contorno3,#sueldos,#hos_has').hide();
        $('.dlab, .dsal, .suel, .hon').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
        break;
			case "dlab":/*Comienza Editar Datos Laborales*/
        $('#contorno2').fadeIn();
        $('#contorno1, #contorno3,#sueldos,#hos_has').hide();
        $('.dgen, .dsal, .suel, .hon').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
        break;
			case "dsal":/*Comienza Editar Distribucion de Salario*/
        $('#contorno3').fadeIn();
        $('#contorno1, #contorno2,#sueldos,#hos_has').hide();
        $('.dlab, .dgen, .suel, .hon').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
				break;
			case "dsuel": /*Comienza Editar Distribucion de Salario*/
        $('#sueldos').fadeIn();
        $('#contorno1, #contorno2,#contorno3,#hos_has').hide();
        $('.dlab, .dgen, .dsal, .hon').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
				break;
      case "hon":
         $('#hon_has').fadeIn();
         $('#contorno1, #contorno2, #contorno3, #sueldos').hide();
         $('.dlab, .dgen, .dsal, .suel').css('cssText', 'color: #a1a0a0 !important');
         $(this).css('cssText', 'color: #d11c1c !important');
         break;
			case "perc":// ******** PERMANENTES *********** ///*Comienza Editar percepciones*/
        $('#contorno5').fadeIn();
        $('#contorno6').hide();
        $('.deduc').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
				break;
			case "deduc":/*Comienza Editar Deducciones*/
        $('#contorno6').fadeIn();
        $('#contorno5').hide();
        $('.perc').css('cssText', 'color: #a1a0a0 !important');
        $(this).css('cssText', 'color: #d11c1c !important');
				break;
      default:
      console.error("Something went terribly wrong...");
    }
  });
  // TERMINA MOSTRAR / OCULTAR DIVS

$(function(){
  $('#distribucionSalario').on('change','#n_salario_AER_add,#n_salario_MAN_add,#n_salario_NL_add,#n_salario_VER_add,#n_salario_LTX_add',function(){
    var n_salario_AER_add = parseInt($('#n_salario_AER_add').val());
    var n_salario_MAN_add = parseInt($('#n_salario_MAN_add').val());
    var n_salario_NL_add = parseInt($('#n_salario_NL_add').val());
    var n_salario_VER_add = parseInt($('#n_salario_VER_add').val());
    var n_salario_LTX_add = parseInt($('#n_salario_LTX_add').val());
    if (isNaN(n_salario_AER_add)) {
      n_salario_AER_add = 0;
    }
    if (isNaN(n_salario_MAN_add)) {
      n_salario_MAN_add = 0;
    }
    if (isNaN(n_salario_NL_add)) {
      n_salario_NL_add = 0;
    }
    if (isNaN(n_salario_VER_add)) {
      n_salario_VER_add = 0;
    }
    if (isNaN(n_salario_LTX_add)) {
      n_salario_LTX_add = 0;
    }
    var suma = n_salario_AER_add + n_salario_MAN_add + n_salario_NL_add + n_salario_VER_add +n_salario_LTX_add;

    $('#n_porcentajeTotal_add').val(suma);
  });
});

$(function(){
  $('#distSalarioModal').on('change','#n_salario_AER,#n_salario_MAN,#n_salario_NL,#n_salario_VER,#n_salario_LTX',function(){
    var n_salario_AER = parseInt($('#n_salario_AER').val());
    var n_salario_MAN = parseInt($('#n_salario_MAN').val());
    var n_salario_NL = parseInt($('#n_salario_NL').val());
    var n_salario_VER = parseInt($('#n_salario_VER').val());
    var n_salario_LTX = parseInt($('#n_salario_LTX').val());
    if (isNaN(n_salario_AER)) {
      n_salario_AER = 0;
    }
    if (isNaN(n_salario_MAN)) {
      n_salario_MAN = 0;
    }
    if (isNaN(n_salario_NL)) {
      n_salario_NL = 0;
    }
    if (isNaN(n_salario_VER)) {
      n_salario_VER = 0;
    }
    if (isNaN(n_salario_LTX)) {
      n_salario_LTX = 0;
    }
    var suma = n_salario_AER + n_salario_MAN + n_salario_NL + n_salario_VER +n_salario_LTX;

    $('#n_porcentajeTotal').val(suma);
  });
});



// SELECCION DE REGIMEN FUNCIONANDO
$('#fk_id_regimen_add').change(function(){
  if ($('#fk_id_regimen_add').val() == 2) {
    $('#regimen').show();
    $('#txtSueldos').show();
    $('#txtHon').hide();
  }else if ($('#fk_id_regimen_add').val() == 9) {
    $('#regimen').show();
    $('#txtHon').show();
    $('#txtSueldos').hide();
  }
});
// VALIDACIONES
$('#validarDtosGenerales').click(function(){

  validacionDatosGenerales =   $('#s_nombre_add').val() == "" ||
                               $('#s_apellidoP_add').val() == "" ||
                               $('#s_apellidoM_add').val() == "" ||
                               $('#d_fechaNacido_add').val() == "" ||
                               $('#s_CURP_add').val() == "" ||
                               $('#s_RFC_add').val() == "" ||
                               $('#s_email_personal_add').val() == "" ||
                               $('#s_calle_add').val() == "" ||
                               $('#s_no_ext_add').val() == "" ||
                               $('#s_colonia_add').val() == "" ||
                               $('#s_municipio_add').val() == "" ||
                               $('#s_estado_add').val() == 0 ||
                               $('#s_codigo_add').val() == "" ||
                               $('#s_id_entfed_add').val() == 0 ||
                               $('#fk_id_formapago_add').val() == 0;

  if (validacionDatosGenerales) {
    swal("Error","Los campos marcados con (*), son obligatorios","error");
  }else{
    if ($('#fk_id_formapago_add').val() == "03" && ($('#s_cta_banco_add').val() == "" || $('#fk_id_banco_add').val() == 0)) {
      alertify.error("Banco y número de cuenta es requerido");
       return false;
    }
    $('#datosGenerales').hide();
    $('#datosLaborales').show();
    $(this).hide();
  }
});

$('#validarDtosLaborales').click(function(){
  validacionDatosLaborales =  $('#fk_id_depto_add').val() == "" ||
                              $('#s_puesto_actividad_add').val() == "" ||
                              $('#d_fechaContrato_add').val() == "" ||
                              $('#fk_id_contrato_add').val() == "" ||
                              $('#fk_id_jornada_add').val() == "" ||
                              $('#fk_id_riesgo_add').val() == 0 ||
                              $('#fk_id_pago_add').val() == 0 ||
                              $('#s_activo_add').val() == 0 ||
                              $('#s_pagar_add').val() == 0 ;

  if (validacionDatosLaborales) {
    swal("Error","Los campos marcados con (*), son obligatorios","error");
  }else {
    if ($('#s_activo_add').val() == "N" && $('#d_fechaBaja_add').val()== "") {
      alertify.error("La fecha de baja es requerida");
      return false;
    }
    if ($('#s_activo_add').val() == "S" && $('#d_fechaContrato_add').val()== "") {
      alertify.error("La fecha de contrato es requerida");
      return false;
    }
    $('#datosLaborales').hide();
    $('#distribucionSalario').show();
  }
});

$('#validarDistSalarios').click(function(){
  validarDistSalarios = $('#n_porcentajeTotal_add').val() == "" ||
                        $('#n_porcentajeTotal_add').val() != "100";

  if (validarDistSalarios) {
    swal("Error","Favor de verificar el campo total debe ser 100%","error");
  }else {
    $('#distribucionSalario').hide();
    if ($('#fk_id_regimen_add').val() == 2) {
      $('#sueldosySalarios').show();
      $('#honorariosAsim').hide();
    }else if ($('#fk_id_regimen_add').val() == 9) {
      $('#honorariosAsim').show();
      $('#sueldosySalarios').hide();
    }
  }
});

// function agregarEmpleado(){
  $('.agregarEmpleado').click(function(){
    var regimen = $('#fk_id_regimen_add').val();
    if (regimen == 2 || regimen ==  '02') {
      if ($('#s_IMSS_add').val() == "") {
        alertify.error("IMSS es requerido");
        $('#s_IMSS_add').focus();
        return false;
      }else if ($('#n_salario_mensual_add').val() == "") {
        alertify.error("Salario Mensual es requerido");
        $('#n_salario_mensual_add').focus();
        return false;
      }
      isr = 0;
      salario_semanal = $('#n_salario_semanal_add').val();
    }else if (regimen == 9 || regimen ==  '09') {
      if ($('#n_salario_semanal_hon').val() == "") {
        alertify.error("Salario es requerido");
        $('#n_salario_semanal_hon').focus();
        return false;
      }
      isr = $('#n_ISR_add').val();
      salario_semanal = $('#n_salario_semanal_hon').val();
    }

    var data = {
      s_nombre_add: $('#s_nombre_add').val(),
      s_apellidoP_add: $('#s_apellidoP_add').val(),
      s_apellidoM_add: $('#s_apellidoM_add').val(),
      d_fechaNacido_add: $('#d_fechaNacido_add').val(),
      s_CURP_add: $('#s_CURP_add').val(),
      s_RFC_add: $('#s_RFC_add').val(),
      s_telefono_add: $('#s_telefono_add').val(),
      s_email_personal_add: $('#s_email_personal_add').val(),
      s_calle_add: $('#s_calle_add').val(),
      s_no_ext_add: $('#s_no_ext_add').val(),
      s_no_int_add: $('#s_no_int_add').val(),
      s_colonia_add: $('#s_colonia_add').val(),
      s_localidad_add: $('#s_localidad_add').val(),
      s_municipio_add: $('#s_municipio_add').val(),
      s_estado_add: $('#s_estado_add').val(),
      s_codigo_add: $('#s_codigo_add').val(),
      s_id_entfed_add: $('#s_id_entfed_add').val(),
      s_fk_c_pais_add: $('#s_fk_c_pais_add').val(),
      fk_id_formapago_add: $('#fk_id_formapago_add').val(),
      s_cta_banco_add: $('#s_cta_banco_add').val(),
      fk_id_banco_add: $('#fk_id_banco_add').val(),
      fk_id_aduana_add: $('#fk_id_aduana_add').val(),
      fk_id_depto_add: $('#fk_id_depto_add').val(),
      s_puesto_actividad_add: $('#s_puesto_actividad_add').val(),
      d_fechaContrato_add: $('#d_fechaContrato_add').val(),
      fk_id_contrato_add: $('#fk_id_contrato_add').val(),
      fk_id_jornada_add: $('#fk_id_jornada_add').val(),
      fk_id_riesgo_add: $('#fk_id_riesgo_add').val(),
      fk_id_pago_add: $('#fk_id_pago_add').val(),
      fk_id_regimen_add: regimen,
      s_email_laboral_add: $('#s_email_laboral_add').val(),
      s_observaciones_add: $('#s_observaciones_add').val(),
      s_activo_add: $('#s_activo_add').val(),
      d_fechaBaja_add: $('#d_fechaBaja_add').val(),
      s_pagar_add: $('#s_pagar_add').val(),
      fk_usuario_alta_add: $('#fk_usuario_alta_add').val(),
      d_fecha_alta_add: $('#d_fecha_alta_add').val(),
      n_salario_AER_add: $('#n_salario_AER_add').val(),
      n_salario_MAN_add: $('#n_salario_MAN_add').val(),
      n_salario_NL_add: $('#n_salario_NL_add').val(),
      n_salario_VER_add: $('#n_salario_VER_add').val(),
      n_salario_LTX_add: $('#n_salario_LTX_add').val(),
      s_IMSS_add: $('#s_IMSS_add').val(),
      s_INFONAVIT_add: $('#s_INFONAVIT_add').val(),
      n_desc_infonavit_porcent_add: $('#n_desc_infonavit_porcent_add').val(),
      n_desc_infonavit_cuota_add: $('#n_desc_infonavit_cuota_add').val(),
      n_desc_infonavit_VSM_add: $('#n_desc_infonavit_VSM_add').val(),
      n_salario_mensual_add: $('#n_salario_mensual_add').val(),
      n_salario_semanal_add: salario_semanal,
      n_factor_integracion_add: $('#n_factor_integracion_add').val(),
      n_cuota_integral_salario_add: $('#n_cuota_integral_salario_add').val(),
      n_salario_integrado_add: $('#n_salario_integrado_add').val(),
      n_ISR_add: isr
    }

    $.ajax({
      type: "POST",
      url: "actions/agregar.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          swal("Exito", "Se guardo correctamente.", "success");
          location.reload();
        } else {
          console.error(r.message);
        }
      }
    });
  });

// PASAR VARIABLES A MODAL
  $('tbody').on('click', '.editar-empleado', function(){
    var dbid = $(this).attr('db-id');
    var regimen  = $(this).attr('regimen');
    var tar_modal = $(this).attr('href');

    if (regimen == 2 || regimen == '02') {
      $('.suelysal-1').show();
      $('.honorariosAsim-1').hide();
    }else if (regimen == 9 || regimen == '09') {
      $('.suelysal-1').hide();
      $('.honorariosAsim-1').show();
    }

    var fetch_empleado = $.ajax({
      method: 'POST',
      data: {dbid: dbid},
      url: 'actions/fetch.php'
    });

    fetch_empleado.done(function(r){
      r = JSON.parse(r);

      if (r.code == 1) {

        console.log(r.data);
        for (var key in r.data) {

          if (r.data.hasOwnProperty(key)) {
            var iterated_element = $('#' + key);
            var element_type = iterated_element.prop('nodeName');
            var dbid = iterated_element.attr('db-id');
            var value = r.data[key];

            iterated_element.val(value).addClass('tiene-contenido');
            if (typeof dbid !== undefined && dbid !== false) {
              iterated_element.attr('db-id', value)
            }
          }
        }
        $('#h_salario_mensual').val(r.data.n_salario_semanal);
        $('#n_salario_pago').val(r.data.n_salario_semanal - r.data.n_ISR);
        tar_modal.modal('show');
      } else {
        console.error(r);
      }
    })
  });

// Editar Empleado
  $('.medit-empleado').click(function(){

    var regimen = $('#fk_id_regimen').val();
    if (regimen == 2 || regimen ==  '02') {
      if ($('#s_IMSS').val() == "") {
        alertify.error("IMSS es requerido");
        $('#s_IMSS').focus();
        return false;
      }else if ($('#n_salario_mensual').val() == "") {
        alertify.error("Salario Mensual es requerido");
        $('#n_salario_mensual').focus();
        return false;
      }
      isr = 0;
      salario_semanal = $('#n_salario_semanal').val();
    }else if (regimen == 9 || regimen == '09') {
      if ($('#h_salario_mensual').val() == "") {
        alertify.error("Salario es requerido");
        $('#h_salario_mensual').focus();
        return false;
      }
      isr = $('#n_ISR').val();
      salario_semanal = $('#h_salario_mensual').val();
    }

    validacionDatosGenerales =   $('#s_nombre').val() == "" ||
                                 $('#s_apellidoP').val() == "" ||
                                 $('#s_apellidoM').val() == "" ||
                                 $('#d_fechaNacido').val() == "" ||
                                 $('#s_CURP').val() == "" ||
                                 $('#s_RFC').val() == "" ||
                                 $('#s_email_personal').val() == "" ||
                                 $('#s_calle').val() == "" ||
                                 $('#s_no_ext').val() == "" ||
                                 $('#s_colonia').val() == "" ||
                                 $('#s_municipio').val() == "" ||
                                 $('#s_estado').val() == 0 ||
                                 $('#s_codigo').val() == "" ||
                                 $('#s_id_entfed').val() == 0 ||
                                 $('#fk_id_formapago').val() == 0;
   if ($('#fk_id_formapago').val() == "03" && ($('#s_cta_banco').val() == "" || $('#fk_id_banco').val() == 0)) {
     alertify.error("Banco y número de cuenta es requerido");
      return false;
   }

   validacionDatosLaborales =  $('#fk_id_depto').val() == "" ||
                               $('#s_puesto_actividad').val() == "" ||
                               $('#d_fechaContrato').val() == "" ||
                               $('#fk_id_contrato').val() == "" ||
                               $('#fk_id_jornada').val() == "" ||
                               $('#fk_id_riesgo').val() == 0 ||
                               $('#fk_id_pago').val() == 0 ||
                               $('#s_activo').val() == 0 ||
                               $('#s_pagar').val() == 0 ;

    if ($('#s_activo').val() == "N" && $('#d_fechaBaja').val() == "") {
     alertify.error("La fecha de baja es requerida");
     return false;
    }
    if ($('#s_activo').val() == "S" && $('#d_fechaContrato').val() == "") {
     alertify.error("La fecha de contrato es requerida");
     return false;
    }

     validarDistSalarios = $('#n_porcentajeTotal').val() == "" ||
                           $('#n_porcentajeTotal').val() != "100";

    var data = {
      pk_id_empleado: $('#pk_id_empleado').attr('db-id'),
      s_nombre: $('#s_nombre').val(),
      s_apellidoP: $('#s_apellidoP').val(),
      s_apellidoM: $('#s_apellidoM').val(),
      d_fechaNacido: $('#d_fechaNacido').val(),
      s_CURP: $('#s_CURP').val(),
      s_RFC: $('#s_RFC').val(),
      s_telefono: $('#s_telefono').val(),
      s_email_personal: $('#s_email_personal').val(),
      s_calle: $('#s_calle').val(),
      s_no_ext: $('#s_no_ext').val(),
      s_no_int: $('#s_no_int').val(),
      s_colonia: $('#s_colonia').val(),
      s_localidad: $('#s_localidad').val(),
      s_municipio: $('#s_municipio').val(),
      s_estado: $('#s_estado').val(),
      s_codigo: $('#s_codigo').val(),
      s_id_entfed: $('#s_id_entfed').val(),
      fk_id_formapago: $('#fk_id_formapago').val(),
      s_cta_banco: $('#s_cta_banco').val(),
      fk_id_banco: $('#fk_id_banco').val(),
      fk_id_aduana: $('#fk_id_aduana').val(),
      fk_id_depto: $('#fk_id_depto').val(),
      s_puesto_actividad: $('#s_puesto_actividad').val(),
      d_fechaContrato: $('#d_fechaContrato').val(),
      fk_id_contrato: $('#fk_id_contrato').val(),
      fk_id_jornada: $('#fk_id_jornada').val(),
      fk_id_riesgo: $('#fk_id_riesgo').val(),
      fk_id_pago: $('#fk_id_pago').val(),
      fk_id_regimen: regimen,
      s_email_laboral: $('#s_email_laboral').val(),
      s_observaciones: $('#s_observaciones').val(),
      s_activo: $('#s_activo').val(),
      d_fechaBaja: $('#d_fechaBaja').val(),
      s_pagar: $('#s_pagar').val(),
      n_salario_AER: $('#n_salario_AER').val(),
      n_salario_MAN: $('#n_salario_MAN').val(),
      n_salario_NL: $('#n_salario_NL').val(),
      n_salario_VER: $('#n_salario_VER').val(),
      n_salario_LTX: $('#n_salario_LTX').val(),
      s_IMSS: $('#s_IMSS').val(),
      s_INFONAVIT: $('#s_INFONAVIT').val(),
      n_desc_infonavit_porcent: $('#n_desc_infonavit_porcent').val(),
      n_desc_infonavit_cuota: $('#n_desc_infonavit_cuota').val(),
      n_desc_infonavit_VSM: $('#n_desc_infonavit_VSM').val(),
      n_salario_mensual: salario_semanal,
      n_salario_semanal: $('#n_salario_semanal').val(),
      n_factor_integracion: $('#n_factor_integracion').val(),
      n_cuota_integral_salario: $('#n_cuota_integral_salario').val(),
      n_salario_integrado: $('#n_salario_integrado').val(),
      n_ISR: isr,
      s_incapacidad_pgo: $('#s_incapacidad_pgo').val(),
      n_incapacidad_dias: $('#n_incapacidad_dias').val(),
      fk_tipoIncapacidad: $('#fk_tipoIncapacidad').val(),
      s_valesDespensa_pgo: $('#s_valesDespensa_pgo').val(),
      n_valesDespensa_dias: $('#n_valesDespensa_dias').val(),
      n_compensacion: $('#n_compensacion').val(),
      s_ayudaRenta_pgo: $('#s_ayudaRenta_pgo').val(),
      n_ayudaRenta: $('#n_ayudaRenta').val(),
      s_subsidioPago: $('#s_subsidioPago').val(),
      n_vacaciones_dias: $('#n_vacaciones_dias').val(),
      s_vacPrim_Pgo: $('#s_vacPrim_Pgo').val(),
      n_vacPrim_dias: $('#n_vacPrim_dias').val(),
      n_faltas_dias: $('#n_faltas_dias').val(),
      s_asistencia_pgo: $('#s_asistencia_pgo').val(),
      s_puntualidad_pgo: $('#s_puntualidad_pgo').val(),
      s_aguinaldo_Pgo: $('#s_aguinaldo_Pgo').val(),
      n_aguinaldo_dias: $('#n_aguinaldo_dias').val(),
      s_prestamoCta: $('#s_prestamoCta').val(),
      s_prestamo_pgo: $('#s_prestamo_pgo').val(),
      n_prestamo: $('#n_prestamo').val(),
      n_hrsExtra_dobles_dias: $('#n_hrsExtra_dobles_dias').val(),
      n_hrsExtra_dobles: $('#n_hrsExtra_dobles').val(),
      n_hrsExtra_triples_dias: $('#n_hrsExtra_triples_dias').val(),
      n_hrsExtra_triples: $('#n_hrsExtra_triples').val(),
      n_hrsExtra_simples_dias: $('#n_hrsExtra_simples_dias').val(),
      n_hrsExtra_simples: $('#n_hrsExtra_simples').val(),
      n_desc_descuentos: $('#n_desc_descuentos').val(),
      n_desc_prestamo: $('#n_desc_prestamo').val(),
      n_desc_infonavit: $('#n_desc_infonavit').val(),
      n_desc_fonacot: $('#n_desc_fonacot').val(),
      s_desc_renta_pgo: $('#s_desc_renta_pgo').val(),
      n_desc_renta: $('#n_desc_renta').val(),
      s_desc_pensionAlim_pago: $('#s_desc_pensionAlim_pago').val(),
      n_desc_pensionAlim_porcent: $('#n_desc_pensionAlim_porcent').val(),
      s_desc_pensionAlim_otorgado: $('#s_desc_pensionAlim_otorgado').val(),
      s_desc_pensionAlim_entregado: $('#s_desc_pensionAlim_entregado').val()
    }


    if (validacionDatosGenerales) {
      swal("Error","Los campos marcados con (*) en Datos Generales, son obligatorios","error");
    }else if (validacionDatosLaborales) {
      swal("Error","Los campos marcados con (*) en Datos Laborales, son obligatorios","error");
    }else if (validarDistSalarios) {
      swal("Error","Favor de verificar el campo total debe ser 100%","error");
    }
    else{
      $.ajax({
        type: "POST",
        url: "actions/editar.php",
        data: data,
        success: 	function(r){
          r = JSON.parse(r);
          if (r.code == 1) {
            listaEmpleados();
            swal("Exito", "La cuenta se actualizó correctamente.", "success");
            $('.modal').modal('hide');

          } else {
            console.error(r.message);
          }
        },
        error: function(x){
          console.error(x);
        }
      });
    }
  });

  $('#filtroRegimen').change(function(){
    listaEmpleados();
    regimen = $('#filtroRegimen').val();
    $('#empleados_rt_search').data('regimen', regimen);
  });





});



function Salario_Int(){
  sal_diario = $('#n_salario_mensual_add').val() / 30;
  $('#n_salario_semanal_add').val(sal_diario);

  Sal_Int =  sal_diario * $('#n_factor_integracion_add').val();
  $('#n_salario_integrado_add').val(Sal_Int + parseFloat($('#n_cuota_integral_salario_add').val()));


  sal_diario_m = $('#n_salario_mensual').val() / 30;// CALCULO EN MODAL
  $('#n_salario_semanal').val(sal_diario_m);

  sal_int_m = sal_diario_m * $('#n_factor_integracion').val();
  $('#n_salario_integrado').val(sal_int_m + parseFloat($('#n_cuota_integral_salario').val()));
}


function listaEmpleados(){
  var data = {
    fk_id_aduana : $('#fk_id_aduana_add').val(),
    regimen : $('#filtroRegimen').val()
  }
  $.ajax({
    type: "POST",
    url: "actions/mostrar.php",
    data: data,
    success: 	function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#registrosEmpleados').html(r.data);
        $('#registrosEncabezado').html(r.encabezado);
      }
    }
  });
}

function calcularISR(){
  var data = {
    salario_diario: $('#n_salario_semanal_hon').val()
  }
  if (data.salario_diario > 0) {
    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Nomina/SueldosySalarios/empleados/actions/calculoISR.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#n_ISR_add').val(r.data);
          salarioSemanal =  $('#n_salario_semanal_hon').val();
          isr_add = $('#n_ISR_add').val();
          salario_dia = salarioSemanal - isr_add;
          $('#hon_spgo').val(salario_dia);
        }
      }
    });
  }
}

function calcularISRmodal(){
  var data = {
    salario_diario: $('#h_salario_mensual').val()
  }
  if (data.salario_diario > 0) {
    $.ajax({
      type: "POST",
      url: "/conta6/Ubicaciones/Nomina/SueldosySalarios/empleados/actions/calculoISR.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#n_ISR').val(r.data);
          salarioSemanal =  $('#h_salario_mensual').val();
          isr_add = $('#n_ISR').val();
          salario_dia = salarioSemanal - isr_add;
          $('#hon_spgo').val(salario_dia);
        }
      }
    });
  }
}
