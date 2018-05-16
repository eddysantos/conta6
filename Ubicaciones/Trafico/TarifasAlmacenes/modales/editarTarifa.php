<!--EDITAR DATOS DE TARIFA-->
<div class="modal fade" id="EditarTarifa" style="margin-top:50px">
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
            <table class="table text-center brx1">
              <tbody class="cuerpo">
                <tr class="row">
                  <td class="col-md-5 input-effect brx2">
                    <input id="m-concepto" class="efecto text-normal w-100" type="text">
                    <label for="m-concepto">Concepto</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="m-cuenta" class="efecto text-normal w-100" type="text">
                    <label for="m-cuenta">Cuenta</label>
                  </td>
                  <td class="col-md-5 input-effect brx2" >
                    <input  list="lista-cargo" class="text-normal efecto" id="m-cargo">
                    <datalist id="lista-cargo">
                      <option value="0110-00001 -- Impuestos"></option>
                      <option value="0110-00002 -- Fletes Terrestres"></option>
                      <option value="0110-00003 -- Corresponsal"></option>
                      <option value="0110-00004 -- Flete Aereo"></option>
                      <option value="0110-00005 -- Flete Maritimo"></option>
                      <option value="0110-00006 -- Almacenaje"></option>
                      <option value="0110-00007 -- Descosolidación"></option>
                      <option value="0110-00008 -- Montacargas"></option>
                      <option value="0110-00009 -- Maniobras"></option>
                      <option value="0110-000010 -- Muellaje"></option>
                      <option value="0110-000011 -- Otros Gastos Comprobados"></option>
                      <option value="0110-000012 -- Rectificación de Pedimento"></option>
                      <option value="0110-000013 -- Previo"></option>
                      <option value="0110-000014 -- Reconocimiento Aduanero"></option>
                      <option value="0110-000015 -- Lavado de Contenedor"></option>
                    </datalist>
                    <label for="m-cargo">Seleccione una Cuenta</label>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-5 input-effect brx2">
                    <input id="m-observaciones" class="efecto text-normal w-100" type="text">
                    <label for="m-observaciones">Observaciones</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="m-tipo" class="efecto text-normal w-100" type="text">
                    <label for="m-tipo">Tipo</label>
                  </td>
                  <td class="col-md-5 input-effect brx2" >
                    <input  list="calculo-tarif" class="text-normal efecto" id="m-listipo">
                    <datalist id="calculo-tarif">
                      <option value="1 -- Custodia (Aeropuerto)"></option>
                      <option value="2 -- Manejo (Aeropuerto)"></option>
                      <option value="3 -- Almacenje (Aeropuerto)"></option>
                      <option value="4 -- Un solo Registro y un solo Importe"></option>
                      <option value="5 -- Un solo Registro sin Importe"></option>
                      <option value="6 -- Un solo Registro con Importe x Fracción"></option>
                      <option value="7 -- Varios Registros con 1 Limite Inferior y 1 Superior"></option>
                      <option value="8 -- Un solo Registro y un solo Importe, x día (5 días libres)"></option>
                      <option value="9 -- Un solo Registro con Importe y un cargo mínimo"></option>
                      <option value="10 -- Un solo Registro con Importe por cada KG (5 días libres)"></option>
                      <option value="11 -- Un solo Registro con Importe Fijo y Cuota por Tonelada o Fracción"></option>
                      <option value="12 -- Un solo Registro con Importe Fijo por Tonelada o Fracción con un cargo mínimo"></option>
                    </datalist>
                    <label for="m-listipo">Tipo</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>



<!--MODIFICAR REGISTRO DE TARIFA-->
<div class="modal fade" id="EditarRegTarifa" style="margin-top:50px">
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
            <form class="form2" >
              <table class="table text-center">
                <tbody>
                  <tr class="row">
                    <td class="col-md-1 input-effect brx2" >
                      <input  list="lista-uni" class="text-normal efecto" id="m-unidad">
                      <datalist id="lista-uni"></datalist>
                      <label style="left:1px!important" for="m-unidad">Unidad</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-liminf" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-liminf">Lim.Inferior</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input id="m-limSup" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-limSup">Lim.Superior</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-imp1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-imp1">Importe 1</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-infdia" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-infdia">Inf.Día</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-supdia" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-supdia">Sup.Día</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-imp2" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-imp2">Importe 2</label>
                    </td>
                    <td class="col-md-1 input-effect brx2" >
                      <input  list="lista-ope" class="text-normal efecto" id="m-operacion">
                      <datalist id="lista-ope"></datalist>
                      <label style="left:1px!important" for="m-operacion">Operación</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-fact1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-fact1">Factor 1</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-fact2" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-fact2">Factor 2</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-fact3" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-fact3">Factor 3</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a id="btn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
            <table class="table text-center brx1">
              <tbody class="cuerpo">
                <tr class="row">
                  <td class="col-md-5 input-effect brx2">
                    <input id="m-concepto1" class="efecto text-normal w-100" type="text">
                    <label for="m-concepto1">Concepto</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="m-cuenta1" class="efecto text-normal w-100" type="text">
                    <label for="m-cuenta1">Cuenta</label>
                  </td>
                  <td class="col-md-5 input-effect brx2" >
                    <input  list="lista-cargo" class="text-normal  efecto" id="m-cargo1">
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
                <tr class="row">
                  <td class="col-md-5 input-effect brx2">
                    <input id="m-observaciones1" class="efecto text-normal w-100" type="text">
                    <label for="m-observaciones1">Observaciones</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="m-tipo1" class="efecto text-normal w-100" type="text">
                    <label for="m-tipo1">Tipo</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input  list="calculo-tarif" class="text-normal efecto" id="m-listipo1">
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
        <a href="" id="btn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>