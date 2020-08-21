
<div class="modal" id="agregar">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bordenegro border-radius position-fixed" style="top: 0; left:0; right: 0; bottom: 0">
      <div class="modal-header border-0 align-items-center">
        <h3 class="modal-title mx-3 s_gris_100">Agregar Empleado</h3>
        <div id="fk_regimen">
          <select  class="custom-select" id="fk_id_regimen_add">
            <option value="0">Selecciona el regimen</option>
            <option value="2">Sueldos y Salarios</option>
            <option value="9">Honorarios Asimilados</option>
          </select>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>

      <div class="modal-body p-0 text-center">
        <ul class="nav nav-justified backpink" role="tablist" id="regimen" style="display:none">
          <li class="nav-item add_dgen-tab">
            <a class="nav-link active" id="add_dgen-tab" data-toggle="tab" href="#add_dgen" role="tab" aria-controls="add_dgen" aria-selected="true">Datos Generales</a>
          </li>
          <li class="nav-item add_dlab-tab disabled">
            <a class="nav-link disabled" id="add_dlab-tab" data-toggle="tab" href="#add_dlab" role="tab" aria-controls="add_dlab" aria-selected="false">Datos Laborales</a>
          </li>
          <li class="nav-item add_dsal-tab disabled">
            <a class="nav-link disabled" id="add_dsal-tab" data-toggle="tab" href="#add_dsal" role="tab" aria-controls="add_dsal" aria-selected="false">Distr. Salario</a>
          </li>

          <li class="nav-item add_ss-tab disabled">
            <a class="nav-link disabled" id="add_ss-tab" data-toggle="tab" href="#add_ss" role="tab" aria-controls="add_ss" aria-selected="false">Sueldos y Salarios</a>
          </li>

          <li class="nav-item add_hon-tab disabled">
            <a class="nav-link disabled" id="add_hon-tab" data-toggle="tab" href="#add_hon" role="tab" aria-controls="add_hon" aria-selected="false">Honorarios Asimilados</a>
          </li>
        </ul>

        <div class="tab-content contorno" id="add_userTabContent" style="display:none">
          <div class="tab-pane fade show active" id="add_dgen" role="tabpanel" aria-labelledby="add_dgen-tab">
            <table class="table">
              <tbody>
                <tr class="row mt-5">
                  <td class="col-md-3 input-effect">
                    <input type="hidden" id="fk_usuario_alta_add" value="<?php echo $usuario; ?>">
                    <input type="hidden" id="d_fecha_alta_add" value="<?php echo $fecha; ?>">

                    <input id="s_nombre_add" class="efecto firstMayus" required>
                    <label for="s_nombre_add">Nombre <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_apellidoP_add" class="efecto firstMayus" required>
                    <label for="s_apellidoP_add">Apellido Paterno <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_apellidoM_add" class="efecto firstMayus" required>
                    <label for="s_apellidoM_add">Apellido Materno <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input class="efecto tiene-contenido" type="date" id="d_fechaNacido_add" required>
                    <label for="d_fechaNacido_add">Fecha de Nacimiento <span>*</span></label>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-3 input-effect">
                    <input id="s_CURP_add" class="efecto allMayus" onchange="validaCURP(this)" required>
                    <label for="s_CURP_add">Curp <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_RFC_add" class="efecto allMayus" onchange="validaRFC(this)" required>
                    <label for="s_RFC_add">RFC <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_telefono_add" class="efecto">
                    <label for="s_telefono_add">Telefono</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_email_personal_add" class="efecto" required>
                    <label for="s_email_personal_add">Correo Electronico <span>*</span></label>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-3 input-effect">
                    <input id="s_calle_add" class="efecto firstMayus" required>
                    <label for="s_calle_add">Calle <span>*</span></label>
                  </td>
                  <td class="col-md-1 input-effect">
                    <input id="s_no_ext_add" class="efecto" required>
                    <label for="s_no_ext_add">No.Ext <span>*</span></label>
                  </td>
                  <td class="col-md-1 input-effect">
                    <input id="s_no_int_add" class="efecto">
                    <label for="s_no_int_add">No.Int</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="s_colonia_add" class="efecto firstMayus" required>
                    <label for="s_colonia_add">Colonia <span>*</span></label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="s_localidad_add" class="efecto firstMayus">
                    <label for="s_localidad_add">Localidad</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_municipio_add" class="efecto firstMayus" required>
                    <label for="s_municipio_add">Municipio o Delegación <span>*</span></label>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-3 input-effect">
                    <select class="custom-select" id="s_estado_add" required>
                      <?php echo $estado ?>
                    </select>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="s_codigo_add" class="efecto" required>
                    <label for="s_codigo_add">Codigo Postal <span>*</span></label>
                  </td>
                  <td class="col-md-4 input-effect">
                    <select class="custom-select" id="s_id_entfed_add">
                      <?php echo $entidadFederativa ?>
                    </select>
                    <input type="hidden" id="s_fk_c_pais_add" value="Méx">
                  </td>

                  <td class="col-md-3 input-effect">
                    <select class="custom-select"  id="fk_id_formapago_add">
                      <?php echo $formaPago ?>
                    </select>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-6 input-effect">
                    <input id="s_cta_banco_add" class="efecto">
                    <label for="s_cta_banco_add">Cuenta / Clabe Interbancaria</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <select class="custom-select" id="fk_id_banco_add">
                      <?php echo $bancos ?>
                    </select>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="row justify-content-end mt-5">
                  <td class="col-md-2">
                    <a href="#" id="validarDtosGenerales" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="tab-pane fade d-none" id="add_dlab" role="tabpanel" aria-labelledby="add_dlab-tab">
            <table class="table">
              <tbody>
                <tr class="row mt-5">
                  <td class="col-md-2 input-effect">
                    <input id="fk_id_aduana_add" class="efecto tiene-contenido" value="<?php echo $aduana; ?>" readonly>
                    <label for="fk_id_aduana_add">Oficina</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <select class="custom-select" id="fk_id_depto_add">
                      <?php echo $departamentos ?>
                    </select>
                  </td>
                  <td class="col-md-4 input-effect">
                    <input id="s_puesto_actividad_add" class="efecto firstMayus">
                    <label for="s_puesto_actividad_add">Puesto o Actividades <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input class="efecto tiene-contenido" type="date" id="d_fechaContrato_add">
                    <label for="d_fechaContrato_add">Fecha Contrato <span>*</span></label>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-6 input-effect">
                    <select class="custom-select" id="fk_id_contrato_add">
                      <?php echo $tipoContrato ?>
                    </select>
                  </td>

                  <td class="col-md-3 input-effect">
                    <select class="custom-select" id="fk_id_jornada_add">
                      <?php echo $jornada ?>
                    </select>
                  </td>
                  <td class="col-md-3 input-effect">
                    <select class="custom-select" id="fk_id_riesgo_add">
                      <?php echo $riesgoTrabajo ?>
                    </select>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-4 input-effect">
                    <select class="custom-select" id="fk_id_pago_add">
                      <?php echo $periodoPago ?>
                    </select>
                  </td>
                  <td class="col-md-4 input-effect">
                    <input id="s_email_laboral_add" class="efecto" type="email">
                    <label for="s_email_laboral_add">Correo Asignado</label>
                  </td>
                  <td class="col-md-4 input-effect">
                    <input class="efecto firstMayus" id="s_observaciones_add">
                    <label for="s_observaciones_add">Observaciones</label>
                  </td>
                </tr>

                <tr class="row mt-4">
                  <td class="col-md-4 input-effect">
                    <select class="custom-select" id="s_activo_add">
                      <option value="0">Estatus *</option>
                      <option value="S">Activo</option>
                      <option value="N">Baja</option>
                    </select>
                  </td>

                  <td class="col-md-4 input-effect">
                    <input class="efecto tiene-contenido" type="date" id="d_fechaBaja_add">
                    <label for="d_fechaBaja_add">Fecha de Baja</label>
                  </td>

                  <td class="col-md-4 input-effect">
                    <select class="custom-select" id="s_pagar_add">
                      <option value="0">Pagar *</option>
                      <option value="S">Si</option>
                      <option value="N">No</option>
                    </select>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="row justify-content-end mt-5">
                  <td class="col-md-2">
                    <a href="#" id="validarDtosLaborales" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="tab-pane fade d-none" id="add_dsal" role="tabpanel" aria-labelledby="add_dsal-tab"><table class="table">
            <tbody class="">
              <tr class="row mt-5 justify-content-center" id="distribucion">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_AER_add" class="efecto">
                  <label for="n_salario_AER_add">Aeropuerto</label>
                </td>
              </tr>
              <tr class="row mt-3 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_MAN_add" class="efecto">
                  <label for="n_salario_MAN_add">Manzanillo</label>
                </td>
              </tr>
              <tr class="row mt-3 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_NL_add" class="efecto">
                  <label for="n_salario_NL_add">Nuevo Laredo</label>
                </td>
              </tr>
              <tr class="row mt-3 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_VER_add" class="efecto">
                  <label for="n_salario_VER_add">Veracruz</label>
                </td>
              </tr>
              <tr class="row mt-3 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_LTX_add" class="efecto">
                  <label for="n_salario_LTX_add">Laredo Texas</label>
                </td>
              </tr>
              <tr class="row mt-3 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_porcentajeTotal_add" class="efecto tiene-contenido" readonly>
                  <label for="n_porcentajeTotal_add">Total *</label>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" id="validarDistSalarios" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table></div>
          <div class="tab-pane fade d-none" id="add_ss" role="tabpanel" aria-labelledby="add_ss-tab">
            <table class="table">
              <tbody>
                <tr class="row mt-5">
                  <td class="col-md-3 input-effect">
                    <input id="s_IMSS_add" class="efecto allMayus">
                    <label for="s_IMSS_add">IMSS <span>*</span></label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="s_INFONAVIT_add" class="efecto allMayus">
                    <label for="s_INFONAVIT_add">INFONAVIT</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="n_desc_infonavit_porcent_add" class="efecto">
                    <label for="n_desc_infonavit_porcent_add">Descuento %</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="n_desc_infonavit_cuota_add" class="efecto">
                    <label for="n_desc_infonavit_cuota_add">Cuota</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="n_desc_infonavit_VSM_add" class="efecto">
                    <label for="n_desc_infonavit_VSM_add">VSM</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-2 input-effect">
                    <input id="n_salario_mensual_add" class="efecto" onblur="Salario_Int()">
                    <label for="n_salario_mensual_add">Salario Mensual <span>*</span></label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="n_salario_semanal_add" class="efecto tiene-contenido" readonly>
                    <label for="n_salario_semanal_add">Salario Diario</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="n_factor_integracion_add" class="efecto">
                    <label for="n_factor_integracion_add">Factor de Integración</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="n_cuota_integral_salario_add" class="efecto" onblur="Salario_Int()">
                    <label for="n_cuota_integral_salario_add" class="ls1">Cuota Adic al Salario Intgra.</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="n_salario_integrado_add" class="efecto tiene-contenido" readonly>
                    <label for="n_salario_integrado_add">Salario Integral</label>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="row justify-content-end mt-5">
                  <td class="col-md-2">
                    <a href="#" class="agregarEmpleado linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="tab-pane fade d-none" id="add_hon" role="tabpanel" aria-labelledby="add_hon-tab">
            <table class="table">
              <tbody>
                <tr class="row mt-5 justify-content-center">
                  <td class="col-md-3 input-effect">
                    <input id="n_salario_semanal_hon" class="efecto" onchange="calcularISR()">
                    <label for="n_salario_semanal_hon">Salario</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="n_ISR_add" class="efecto tiene-contenido" readonly>
                    <label for="n_ISR_add">ISR</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="hon_spgo" class="efecto tiene-contenido" readonly>
                    <label for="hon_spgo">Salario a Pagar</label>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="row justify-content-end mt-5">
                  <td class="col-md-2">
                    <a href="#" class="agregarEmpleado linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<?php // TODO: eliminar si funciona ?>
    <!-- <div id="regimen" style="display:none" class="text-center"> -->
      <!-- <div class="modal-body p-0 pb-4">
        <div class="row backpink">
          <div class="col-md-3" role="button">
            <a  id="submenuModal">Datos Generales</a>
          </div>
          <div class="col-md-3">
            <a id="submenuModal">Datos Laborales</a>
          </div>
          <div class="col-md-3">
            <a id="submenuModal">Distr. Salario</a>
          </div>

          <div class="col-md-3 txtSueldos" id="txtSueldos" style="display:none">
            <a id="submenuModal">Sueldos y Salarios</a>
          </div>
          <div class="col-md-3 txtHon" id="txtHon" style="display:none">
            <a id="submenuModal">Honorarios Asimilados</a>
          </div>

        </div>
      </div> -->
      <!-- <div class="contorno pb-0 mt-0" id="datosGenerales">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5">
                <td class="col-md-3 input-effect">
                  <input type="hidden" id="fk_usuario_alta_add" value="<?php echo $usuario; ?>">
                  <input type="hidden" id="d_fecha_alta_add" value="<?php echo $fecha; ?>">

                  <input id="s_nombre_add" class="efecto firstMayus" required>
                  <label for="s_nombre_add">Nombre <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_apellidoP_add" class="efecto firstMayus" required>
                  <label for="s_apellidoP_add">Apellido Paterno <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_apellidoM_add" class="efecto firstMayus" required>
                  <label for="s_apellidoM_add">Apellido Materno <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="d_fechaNacido_add" required>
                  <label for="d_fechaNacido_add">Fecha de Nacimiento <span>*</span></label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-3 input-effect">
                  <input id="s_CURP_add" class="efecto allMayus" onchange="validaCURP(this)" required>
                  <label for="s_CURP_add">Curp <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_RFC_add" class="efecto allMayus" onchange="validaRFC(this)" required>
                  <label for="s_RFC_add">RFC <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_telefono_add" class="efecto">
                  <label for="s_telefono_add">Telefono</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_email_personal_add" class="efecto" required>
                  <label for="s_email_personal_add">Correo Electronico <span>*</span></label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-3 input-effect">
                  <input id="s_calle_add" class="efecto firstMayus" required>
                  <label for="s_calle_add">Calle <span>*</span></label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="s_no_ext_add" class="efecto" required>
                  <label for="s_no_ext_add">No.Ext <span>*</span></label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="s_no_int_add" class="efecto">
                  <label for="s_no_int_add">No.Int</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="s_colonia_add" class="efecto firstMayus" required>
                  <label for="s_colonia_add">Colonia <span>*</span></label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="s_localidad_add" class="efecto firstMayus">
                  <label for="s_localidad_add">Localidad</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_municipio_add" class="efecto firstMayus" required>
                  <label for="s_municipio_add">Municipio o Delegación <span>*</span></label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-3 input-effect">
                  <select class="custom-select" id="s_estado_add" required>
                    <?php echo $estado ?>
                  </select>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="s_codigo_add" class="efecto" required>
                  <label for="s_codigo_add">Codigo Postal <span>*</span></label>
                </td>
                <td class="col-md-4 input-effect">
                  <select class="custom-select" id="s_id_entfed_add">
                    <?php echo $entidadFederativa ?>
                  </select>
                  <input type="hidden" id="s_fk_c_pais_add" value="Méx">
                </td>

                <td class="col-md-3 input-effect">
                  <select class="custom-select"  id="fk_id_formapago_add">
                    <?php echo $formaPago ?>
                  </select>
                </td>
              </tr>
              <tr class="row mt-4">
                <td class="col-md-6 input-effect">
                  <input id="s_cta_banco_add" class="efecto">
                  <label for="s_cta_banco_add">Cuenta / Clabe Interbancaria</label>
                </td>
                <td class="col-md-6 input-effect">
                  <select class="custom-select" id="fk_id_banco_add">
                    <?php echo $bancos ?>
                  </select>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" id="validarDtosGenerales" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div> -->
      <!-- <div class="contorno pb-0 mt-0" id="datosLaborales" style="display:none">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5">
                <td class="col-md-2 input-effect">
                  <input id="fk_id_aduana_add" class="efecto tiene-contenido" value="<?php echo $aduana; ?>" readonly>
                  <label for="fk_id_aduana_add">Oficina</label>
                </td>
                <td class="col-md-3 input-effect">
                  <select class="custom-select" id="fk_id_depto_add">
                    <?php echo $departamentos ?>
                  </select>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="s_puesto_actividad_add" class="efecto firstMayus">
                  <label for="s_puesto_actividad_add">Puesto o Actividades <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="d_fechaContrato_add">
                  <label for="d_fechaContrato_add">Fecha Contrato <span>*</span></label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-6 input-effect">
                  <select class="custom-select" id="fk_id_contrato_add">
                    <?php echo $tipoContrato ?>
                  </select>
                </td>

                <td class="col-md-3 input-effect">
                  <select class="custom-select" id="fk_id_jornada_add">
                    <?php echo $jornada ?>
                  </select>
                </td>
                <td class="col-md-3 input-effect">
                  <select class="custom-select" id="fk_id_riesgo_add">
                    <?php echo $riesgoTrabajo ?>
                  </select>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-4 input-effect">
                  <select class="custom-select" id="fk_id_pago_add">
                    <?php echo $periodoPago ?>
                  </select>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="s_email_laboral_add" class="efecto" type="email">
                  <label for="s_email_laboral_add">Correo Asignado</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input class="efecto firstMayus" id="s_observaciones_add">
                  <label for="s_observaciones_add">Observaciones</label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-4 input-effect">
                  <select class="custom-select" id="s_activo_add">
                    <option value="0">Estatus *</option>
                    <option value="S">Activo</option>
                    <option value="N">Baja</option>
                  </select>
                </td>

                <td class="col-md-4 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="d_fechaBaja_add">
                  <label for="d_fechaBaja_add">Fecha de Baja</label>
                </td>

                <td class="col-md-4 input-effect">
                  <select class="custom-select" id="s_pagar_add">
                    <option value="0">Pagar *</option>
                    <option value="S">Si</option>
                    <option value="N">No</option>
                  </select>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" id="validarDtosLaborales" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div> -->

      <!-- <div class="contorno pb-0 mt-0" id="distribucionSalario" style="display:none">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5" id="distribucion">
                <td class="col-md-2 input-effect">
                  <input id="n_salario_AER_add" class="efecto">
                  <label for="n_salario_AER_add">Aeropuerto</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_MAN_add" class="efecto">
                  <label for="n_salario_MAN_add">Manzanillo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_NL_add" class="efecto">
                  <label for="n_salario_NL_add">Nuevo Laredo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_VER_add" class="efecto">
                  <label for="n_salario_VER_add">Veracruz</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_LTX_add" class="efecto">
                  <label for="n_salario_LTX_add">Laredo Texas</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_porcentajeTotal_add" class="efecto tiene-contenido" readonly>
                  <label for="n_porcentajeTotal_add">Total *</label>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" id="validarDistSalarios" class="linkbtn">Siguiente <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div> -->
      <!-- <div class="contorno pb-0 mt-0" id="sueldosySalarios" >
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5">
                <td class="col-md-3 input-effect">
                  <input id="s_IMSS_add" class="efecto allMayus">
                  <label for="s_IMSS_add">IMSS <span>*</span></label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="s_INFONAVIT_add" class="efecto allMayus">
                  <label for="s_INFONAVIT_add">INFONAVIT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_desc_infonavit_porcent_add" class="efecto">
                  <label for="n_desc_infonavit_porcent_add">Descuento %</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_desc_infonavit_cuota_add" class="efecto">
                  <label for="n_desc_infonavit_cuota_add">Cuota</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_desc_infonavit_VSM_add" class="efecto">
                  <label for="n_desc_infonavit_VSM_add">VSM</label>
                </td>
              </tr>
              <tr class="row mt-4">
                <td class="col-md-2 input-effect">
                  <input id="n_salario_mensual_add" class="efecto" onblur="Salario_Int()">
                  <label for="n_salario_mensual_add">Salario Mensual <span>*</span></label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_semanal_add" class="efecto tiene-contenido" readonly>
                  <label for="n_salario_semanal_add">Salario Diario</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="n_factor_integracion_add" class="efecto">
                  <label for="n_factor_integracion_add">Factor de Integración</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="n_cuota_integral_salario_add" class="efecto" onblur="Salario_Int()">
                  <label for="n_cuota_integral_salario_add" class="ls1">Cuota Adic al Salario Intgra.</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="n_salario_integrado_add" class="efecto tiene-contenido" readonly>
                  <label for="n_salario_integrado_add">Salario Integral</label>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" class="agregarEmpleado linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div> -->
      <!-- <div class="contorno pb-0 mt-0" id="honorariosAsim" style="display:none">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="n_salario_semanal_hon" class="efecto" onchange="calcularISR()">
                  <label for="n_salario_semanal_hon">Salario</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="n_ISR_add" class="efecto tiene-contenido" readonly>
                  <label for="n_ISR_add">ISR</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_spgo" class="efecto tiene-contenido" readonly>
                  <label for="hon_spgo">Salario a Pagar</label>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="row justify-content-end mt-5">
                <td class="col-md-2">
                  <a href="#" class="agregarEmpleado linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div> -->
    <!-- </div> -->
