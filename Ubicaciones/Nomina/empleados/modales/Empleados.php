
<!-- PENDIENTES SOLO SELECT  -->
<div class="modal fade" id="modDatosEmp" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content text-center m_bordenegro">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos de Empleado</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
      <!--********************************Submenu*******************************-->
          <div class="row submenuMed ">
            <div class="col-md-3" role="button">
              <a  id="submenuModal" class="emp dgen" accion="dgen">Datos Generales</a>
            </div>
            <div class="col-md-3">
              <a id="submenuModal" class="emp dlab" accion="dlab">Datos Laborales</a>
            </div>
            <div class="col-md-3">
              <a id="submenuModal" class="emp dsal" accion="dsal">Distr. Salario</a>
            </div>
            <div class="col-md-3 suelysal-1">
              <a id="submenuModal" class="emp suel" accion="dsuel">Sueldos y Salarios</a>
            </div>
            <div class="col-md-3 honorariosAsim-1">
              <a id="submenuModal" class="emp hon" accion="hon">Honorarios Asimilados</a>
            </div>
          </div><!--Termina el Submenu-->

            <div id="contorno1" class="contorno" style="display:none">
              <form class="form1">
                <table class="table " id="dtosgenerales">
                  <tbody>
                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input type="hidden" id="pk_id_empleado" db-id="">
                        <input type="hidden" id="fk_usuario_modifi" usuario="<?php echo $usuario; ?>">
                        <input id="s_nombre" class="efecto">
                        <label for="s_nombre">Nombre <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_apellidoP" class="efecto">
                        <label for="s_apellidoP">Apellido Paterno <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_apellidoM" class="efecto">
                        <label for="s_apellidoM">Apellido Materno <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="d_fechaNacido" class="efecto" type="date">
                        <label for="d_fechaNacido">Fecha Nacimiento <span>*</span></label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input id="s_CURP" class="efecto" onchange="validaCURP(this)">
                        <label for="s_CURP">Curp <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_RFC" class="efecto" onchange="validaRFC(this)">
                        <label for="s_RFC">RFC <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_telefono" class="efecto">
                        <label for="s_telefono">Telefono</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_email_personal" class="efecto">
                        <label for="s_email_personal">Correo Electronico <span>*</span></label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input id="s_calle" class="efecto">
                        <label for="s_calle">Calle <span>*</span></label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="s_no_ext" class="efecto">
                        <label for="s_no_ext">No.Ext <span>*</span></label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="s_no_int" class="efecto">
                        <label for="s_no_int">No.Int</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="s_colonia" class="efecto">
                        <label for="s_colonia">Colonia <span>*</span></label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="s_localidad" class="efecto">
                        <label for="s_localidad">Localidad</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_municipio" class="efecto">
                        <label for="s_municipio">Municipio o Delegación <span>*</span></label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <select class="custom-select" id="s_estado">
                          <?php echo $estado ?>
                        </select>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="s_codigo" class="efecto">
                        <label for="s_codigo">Codigo Postal <span>*</span></label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <select class="custom-select" id="s_id_entfed">
                          <?php echo $entidadFederativa ?>
                        </select>
                      </td>
                      <td class="col-md-3 input-effect">
                        <select class="custom-select" id="fk_id_formapago">
                          <?php echo $formaPago; ?>
                        </select>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-6 input-effect">
                        <input id="s_cta_banco" class="efecto">
                        <label for="s_cta_banco">Cuenta / Clabe Interbancaria</label>
                      </td>
                      <td class="col-md-6 input-effect">
                        <select class="custom-select" id="fk_id_banco">
                          <?php echo $bancos ?>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              </div>
            </div><!--termina el Container-Fluid-->

            <div id="contorno2" class="contorno" style="display:none">
              <form class="form1">
                <table class="table " id="dtoslaborales">
                  <tbody>
                    <tr class="row mt-4">
                      <td class="col-md-2 input-effect">
                        <input id="fk_id_aduana" class="efecto tiene-contenido">
                        <label for="fk_id_aduana">Oficina</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <select class="custom-select" id="fk_id_depto">
                          <?php echo $departamentos ?>
                        </select>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="s_puesto_actividad" class="efecto">
                        <label for="s_puesto_actividad">Puesto o Actividades <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input class="efecto tiene-contenido" type="date" id="d_fechaContrato">
                        <label for="d_fechaContrato">Fecha Contrato <span>*</span></label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-6 input-effect">
                        <select class="custom-select" id="fk_id_contrato">
                          <?php echo $tipoContrato ?>
                        </select>
                      </td>
                      <td class="col-md-3 input-effect">
                        <select class="custom-select" id="fk_id_jornada">
                          <?php echo $jornada ?>
                        </select>
                      </td>
                      <td class="col-md-3 input-effect">
                        <select class="custom-select" id="fk_id_riesgo">
                          <?php echo $riesgoTrabajo ?>
                        </select>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-4 input-effect">
                        <select class="custom-select" id="fk_id_pago">
                          <?php echo $periodoPago ?>
                        </select>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="s_email_laboral" class="efecto" type="email">
                        <label for="s_email_laboral">Correo Asignado</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto" id="s_observaciones">
                        <label for="s_observaciones">Observaciones</label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-4 input-effect">
                        <select class="custom-select" id="s_activo">
                          <option value="0">Estatus</option>
                          <option value="S">Activo</option>
                          <option value="N">Baja</option>
                        </select>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto tiene-contenido" type="date" id="d_fechaBaja">
                        <label for="d_fechaBaja">Fecha de Baja</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <select class="custom-select" id="s_pagar">
                          <option value="0">Pagar</option>
                          <option value="S">Si</option>
                          <option value="N">No</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="contorno3" class="contorno" style="display:none">
              <form class="form1">
                <table class="table " id="distsalarios">
                  <tbody>
                    <tr class="row mt-5" id="distSalarioModal">
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_AER" class="efecto">
                        <label for="n_salario_AER">Aeropuerto</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_MAN" class="efecto">
                        <label for="n_salario_MAN">Manzanillo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_NL" class="efecto">
                        <label for="n_salario_NL">Nuevo Laredo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_VER" class="efecto">
                        <label for="n_salario_VER">Veracruz</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_LTX" class="efecto">
                        <label for="n_salario_LTX">Laredo Texas</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_porcentajeTotal" class="efecto tiene-contenido" value="100" readonly>
                        <label for="n_porcentajeTotal">Total</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="sueldos" class="contorno suelysal" style="display:none">
              <form class="form1" style="letter-spacing:2px">
                <table class="table " id="sueldosysalarios">
                  <tbody>
                    <tr class="row mt-5">
                      <td class="col-md-3 input-effect">
                        <input id="s_IMSS" class="efecto">
                        <label for="s_IMSS">IMSS <span>*</span></label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="s_INFONAVIT" class="efecto">
                        <label for="s_INFONAVIT">INFONAVIT</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_desc_infonavit_porcent" class="efecto">
                        <label for="n_desc_infonavit_porcent">Descuento %</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_desc_infonavit_cuota" class="efecto">
                        <label for="n_desc_infonavit_cuota">Cuota</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_desc_infonavit_VSM" class="efecto">
                        <label for="n_desc_infonavit_VSM">VSM</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_mensual" class="efecto" onblur="Salario_Int()">
                        <label for="n_salario_mensual">Salario Mensual</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_semanal" class="efecto" readonly>
                        <label for="n_salario_semanal">Salario Diario</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="n_factor_integracion" class="efecto">
                        <label for="n_factor_integracion">Factor de Integración</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="n_cuota_integral_salario" class="efecto" onblur="Salario_Int()">
                        <label for="n_cuota_integral_salario">Cuota Adic al Salario Intgra.</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="n_salario_integrado" class="efecto" readonly>
                        <label for="n_salario_integrado">Salario Integral</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="hon_has" class="contorno  honorariosAsim" style="display:none">
              <form class="form1">
                <table class="table">
                  <tbody>
                    <tr class="row mt-4 justify-content-center">
                      <td class="col-md-3 offset-md-1 input-effect">
                        <input type="hidden" id="fk_id_regimen">
                        <input id="h_salario_mensual" class="efecto tiene-contenido" onchange="calcularISRmodal()">
                        <label for="h_salario_mensual">Salario</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="n_ISR" class="efecto tiene-contenido" readonly>
                        <label for="n_ISR">ISR</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="n_salario_pago" class="efecto tiene-contenido" readonly>
                        <label for="n_salario_pago">Salario a Pagar</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

          </div>
        <div class="modal-footer">
          <a href="#" id="medit-empleado" class="medit-empleado linkbtn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="permanentes" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Editar Datos</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
      <!--********************************Submenu*******************************-->

          <ul class="nav row sub2 font14 text-center" id="myTab" role="tablist">
            <li class="nav-item pills col">
              <a class="nav-link active" id="uno-tab" data-toggle="tab" href="#uno" role="tab" aria-controls="uno" aria-selected="true">Percepciones</a>
            </li>
            <li class="nav-item pills col">
              <a class="nav-link" id="dos-tab" data-toggle="tab" href="#dos" role="tab" aria-controls="dos" aria-selected="false">Deducciones</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="uno" role="tabpanel" aria-labelledby="uno-tab">
              <div id="contorno5" class="contorno">
                <form class="form1">
                  <table class="table mb-0 text-center" id="percepciones">
                    <tbody>
                      <tr class="row align-items-center">
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 ls0 efecto-select">Incapacidad</label>
                          <select class="custom-select" id="s_incapacidad_pgo">
                            <option value="0">Incapacidad</option>
                            <option value="S">Si</option>
                            <option value="N" selected>No</option>
                          </select>
                        </td>
                        <td class="col-md-1 input-effect mt-3">
                          <input id="n_incapacidad_dias" class="efecto" placeholder="Días">
                        </td>
                        <td class="col-md-2 input-effect">
                          <label class="mb-0 font14 efecto-select">Motivo</label>
                          <select class="custom-select" id="fk_tipoIncapacidad">
                            <?php echo $incapacidad ?>
                          </select>
                        </td>
                        <td></td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select">Vales</label>
                          <select class="custom-select" id="s_valesDespensa_pgo">
                            <option value="0">Pagar</option>
                            <option value="S" selected>Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select">Días</label>
                          <select class="custom-select" id="n_valesDespensa_dias">
                            <option value="0">Días</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15" selected>15</option>
                          </select>
                        </td>
                        <td></td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select">Renta</label>
                          <select class="custom-select" id="s_ayudaRenta_pgo">
                            <option value="0">Renta</option>
                            <option value="S">Si</option>
                            <option value="N" selected>No</option>
                          </select>
                        </td>
                        <td class="col-md-1 input-effect mt-3">
                          <input id="n_ayudaRenta" class="efecto" placeholder="Importe">
                        </td>
                        <td class="col-md-2 input-effect">
                          <label class="mb-0 font14 efecto-select" >Subsidio</label>
                          <select class="custom-select" id="s_subsidioPago">
                            <option value="0">Subsidio</option>
                            <option value="S">Si</option>
                            <option value="N" selected>No</option>
                          </select>
                        </td>
                        <td class="col input-effect mt-3">
                          <input id="n_compensacion" class="efecto" placeholder="Compensación">
                        </td>
                      </tr>


                      <tr class="row align-items-center">
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_vacaciones_dias" class="efecto" placeholder="Vacaciones">
                        </td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select ls0">Prima Vac.</label>
                          <select class="custom-select" id="s_vacPrim_Pgo">
                            <option value="0">Pagar</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td class="col-md-1 input-effect mt-3">
                          <input class="efecto" type="text" id="n_vacPrim_dias" value="5" placeholder="Días">
                          <!-- <label for="n_vacPrim_dias">Días</label> -->
                        </td>
                        <td></td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select ls0">Asistencia</label>
                          <select class="custom-select" id="s_asistencia_pgo">
                            <option value="0">Pagar</option>
                            <option value="S" selected>Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td class="col-md-1 input-effect">
                          <label class="mb-0 font14 efecto-select ls0">Puntualidad</label>
                          <select class="custom-select" id="s_puntualidad_pgo">
                            <option value="0">Pagar</option>
                            <option value="S" selected>Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td></td>
                        <td class="col-md-2 input-effect">
                          <label class="mb-0 font14 efecto-select">Aguinaldo</label>
                          <select class="custom-select" id="s_aguinaldo_Pgo">
                            <option value="0">Pagar</option>
                            <option value="S" selected>Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_aguinaldo_dias" class="efecto" placeholder="293 días trabajados">
                          <!-- <label for="n_aguinaldo_dias" class="ls1">293 días trabajados</label> -->
                        </td>
                        <td class="col input-effect mt-3">
                          <input id="n_faltas_dias" class="efecto" placeholder="Faltas (max. 3 dec)">
                          <!-- <label for="n_faltas_dias" class="ls0">Faltas (max. 3 dec)</label> -->
                        </td>
                      </tr>


                      <tr class="row justify-content-center align-items-center">
                        <td class="col-md-6 input-effect">
                          <label class="mb-0 font14 efecto-select">Cuentas Deudores</label>
                          <select class="custom-select" id="s_prestamoCta">
                            <?php echo $ctasDeudores ?>
                          </select>
                        </td>
                        <td class="col-md-2 input-effect">
                          <label class="mb-0 font14 efecto-select">Prestamo</label>
                          <select class="custom-select" id="s_prestamo_pgo">
                            <option value="0">Pagar</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                          </select>
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_prestamo" class="efecto" placeholder="Importe">
                          <!-- <label for="n_prestamo">Importe</label> -->
                        </td>
                      </tr>



                      <tr class="row mt-3 justify-content-center align-items-center">
                        <td class="col-md-2 mt-4">Horas Extras : </td>
                        <td class="col-md-1">
                          <label class="font14 efecto-select">Días</label>
                          <select class="custom-select" id="n_hrsExtra_dobles_dias">
                            <option value="0">Días</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </td>
                        <td class="col-md-1">
                          <label class="font14 efecto-select">Dobles</label>
                          <select class="custom-select" id="n_hrsExtra_dobles">
                            <option value="0">Horas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                          </select>
                        </td>

                        <td class="col-md-1">
                          <label class="font14 efecto-select">Días</label>
                          <select class="custom-select" id="n_hrsExtra_triples_dias">
                            <option value="0">Días</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </td>
                        <td class="col-md-1">
                          <label class="font14 efecto-select">Triples</label>
                          <select class="custom-select" id="n_hrsExtra_triples">
                            <option value="0">Horas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                          </select>
                        </td>

                        <td class="col-md-1">
                          <label class="font14 efecto-select">Días</label>
                          <select class="custom-select" id="n_hrsExtra_simples_dias">
                            <option value="0">Días</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </td>
                        <td class="col-md-1">
                          <label class="font14 efecto-select">Triples</label>
                          <select class="custom-select" id="n_hrsExtra_simples">
                            <option value="0">Horas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>

            <div class="tab-pane fade" id="dos" role="tabpanel" aria-labelledby="dos-tab">
              <div id="contorno6" class="contorno">
                <form class="form1">
                  <table class="table mb-0 text-center" id="deducciones">
                    <tbody>
                      <tr class="row align-items-center">
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_descuentos" class="efecto" placeholder="Descuentos">
                          <!-- <label for="n_desc_descuentos">Descuentos</label> -->
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_prestamo" class="efecto" placeholder="Prestamos">
                          <!-- <label for="n_desc_prestamo">Prestamos</label> -->
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_infonavit" class="efecto" placeholder="INFONAVIT">
                          <!-- <label for="n_desc_infonavit">INFONAVIT</label> -->
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_fonacot" class="efecto" placeholder="FONACOT">
                          <!-- <label for="n_desc_fonacot">FONACOT</label> -->
                        </td>
                        <td class="col-md-2 input-effect pt-2">
                          <label class="mb-2 font14 efecto-select">Por Renta:</label>
                          <select class="custom-select" id="s_desc_renta_pgo">
                            <option value="0">Pagar</option>
                            <option value="S">Si</option>
                            <option value="N" selected>No</option>
                          </select>
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_renta" class="efecto" placeholder="Importe">
                          <!-- <label for="n_desc_renta">Importe</label> -->
                        </td>
                      </tr>


                      <tr class="row mt-3 align-items-center">
                        <td class="col-md-2 input-effect pt-2">
                          <label class="mb-2 font14 efecto-select">Pensión</label>
                          <select class="custom-select" id="s_desc_pensionAlim_pago">
                            <option value="0">Pensión</option>
                            <option value="S">Si</option>
                            <option value="N" selected>No</option>
                          </select>
                        </td>
                        <td class="col-md-2 input-effect mt-3">
                          <input id="n_desc_pensionAlim_porcent" class="efecto" placeholder="Porcentaje">
                          <!-- <label for="n_desc_pensionAlim_porcent">Porcentaje</label> -->
                        </td>
                        <td class="col-md-4 input-effect mt-3">
                          <input id="s_desc_pensionAlim_otorgado" class="efecto" placeholder="Otorgado al menor:">
                          <!-- <label for="s_desc_pensionAlim_otorgado">Otorgado al menor:</label> -->
                        </td>
                        <td class="col-md-4 input-effect mt-3">
                          <input id="s_desc_pensionAlim_entregado" class="efecto" placeholder="Entregado a:">
                          <!-- <label for="s_desc_pensionAlim_entregado">Entregado a:</label> -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 mt-3">
          <a href="#" id="medit-empleado" class="medit-empleado linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
