<!--MODIFICAR REGISTRO DE TARIFA-->
<div class="modal fade" id="EditarRegTarifaCliente" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Registro de Tarifa</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <form class="form1 ls0">
              <table class="table text-center">
                <tbody>
                  <tr class="row mt-4">
                    <td class="col-md-1 input-effect">
                      <input  list="lista-uni" class="efecto tiene-contenido" id="m-unidad1">
                      <datalist id="lista-uni"></datalist>
                      <label for="m-unidad1">Unidad</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="m-liminf1" class="efecto tiene-contenido" type="text">
                      <label for="m-liminf1">Lim.Inferior</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="m-limsup1" class="efecto tiene-contenido" type="text">
                      <label for="m-limsup1">Lim.Superior</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="m-impo" class="efecto tiene-contenido" type="text">
                      <label for="m-impo">Importe 1</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="m-infdia1" class="efecto tiene-contenido" type="text">
                      <label for="m-infdia1">Inf.Día</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="m-supdia1" class="efecto tiene-contenido" type="text">
                      <label for="m-supdia1">Sup.Día</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="m-impo2" class="efecto tiene-contenido" type="text">
                      <label for="m-impo2">Importe 2</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input  list="lista-ope" class="efecto tiene-contenido" id="m-operacion1">
                      <datalist id="lista-ope"></datalist>
                      <label for="m-operacion1">Operación</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="mt-fact1" class="efecto tiene-contenido" type="text">
                      <label for="mt-fact1">Factor 1</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="mt-fact2" class="efecto tiene-contenido" type="text">
                      <label for="mt-fact2">Factor 2</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="mt-fact3" class="efecto tiene-contenido" type="text">
                      <label for="mt-fact3">Factor 3</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--EDITAR DATOS DEL CORRESPONSAL-->
<div class="modal fade" id="EditarTarifaCliente" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Concepto de Honorarios</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table form1 text-center">
              <tbody class="font14">
                <tr class="row mt-3">
                  <td class="col-md-5 input-effect">
                    <input id="m-concepto1" class="efecto tiene-contenido" type="text">
                    <label for="m-concepto1">Concepto</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="m-cuenta1" class="efecto tiene-contenido" type="text">
                    <label for="m-cuenta1">Cuenta</label>
                  </td>
                  <td class="col-md-5 input-effect" >
                    <input  list="lista-cargo" class="efecto tiene-contenido" id="m-cargo1">
                    <datalist id="lista-cargo">
                      <option value="0400-00001 -- Honorarios"></option>
                      <option value="0400-00002 -- Tramites y Servicios"></option>
                      <option value="0400-00003 -- Reconocimiento Aduanero"></option>
                      <option value="0400-00004 -- Precios"></option>
                      <option value="0400-00005 -- Elaboración de Pedimento"></option>
                      <option value="0400-00006 -- Documentación y/o Fotostaticas"></option>
                      <option value="0400-00007 -- Entregas de Mercancia"></option>
                      <option value="0400-00008 -- Descosolidación"></option>
                      <option value="0400-00009 -- Ingresos por Otros Conceptos"></option>
                      <option value="0400-00010 -- Sellos Fiscales"></option>
                      <option value="0400-00011 -- Manifestación de Valor"></option>
                      <option value="0400-00012 -- Maniobras"></option>
                      <option value="0400-00013 -- Vucem"></option>
                    </datalist>
                    <label for="m-cargo1">Cargar a :</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-5 input-effect">
                    <input id="m-observaciones1" class="efecto tiene-contenido" type="text">
                    <label for="m-observaciones1">Observaciones</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="m-tipo1" class="efecto tiene-contenido" type="text">
                    <label for="m-tipo1">Tipo</label>
                  </td>
                  <td class="col-md-5 input-effect">
                    <input  list="calculo-tarif" class="efecto tiene-contenido" id="m-listipo1">
                    <datalist id="calculo-tarif">
                      <option value="101 -- Varios Registros con 1 Limite Inferior, 1 Limite Superior y 1 Importe (por valor)"></option>
                      <option value="102 -- Un solo Registro y un solo Importe"></option>
                      <option value="103 -- Exclusivo para Honorarios con un Cargo Mínimo"></option>
                      <option value="104 -- Varios Registros con 1 Limite Superior, Importe y 1 Factor"></option>
                      <option value="105 -- Varios Registros con 1 Limite Inferior, 1 Limite Superor y 1 Importe (por peso)"></option>
                      <option value="106 -- Exclusivo para Honorarios con un Cargo Mínimo y un Descuento"></option>
                      <option value="107 -- Exclusivo para Honorarios con un Cargo Mínimo y un Máximo"></option>
                    </datalist>
                    <label for="m-listipo1">Tipo</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
