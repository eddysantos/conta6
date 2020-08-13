<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class='container-fluid'>
  <div class='row m-0 backpink text-center'>
    <div class='col-md-6' role='button'>
      <a  id='submenuMed' class='trafico' accion='datcliente' status='cerrado'>DATOS CLIENTE</a>
    </div>
    <div class='col-md-6'>
      <a id='submenuMed' class='trafico' accion='datinfo' status='cerrado'>INFO. GENERAL</a>
    </div>
  </div>

  <div class='col-md-1 text-center font16 m-3'>
    <a href='SolAnticipo.php'>
      <img class='icomediano' src='/Resources/iconos/left.svg'>
    </a>
    <a href='#' style='margin-left:30px'><img class='icomediano' src='/Resources/iconos/printer.svg'></a>
  </div>

  <div id='contornoCliente' class='contorno' style='display:none'>
    <h5 class='titulo font14'>DATOS CLIENTES</h5>
    <table class='table text-center' id='eCliente'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12'>MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class='row backpink font16'>
          <td class='col-md-6'>Direccion</td>
          <td class='col-md-6'>Proveedor</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row'>
          <td class='col-md-6'>Ave.Industrial Alimentaria 2001</td>
          <td class='col-md-6'>EC, DBA KECO</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>Parque Industrial Linares</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>Linares Nuevo Leon C.P 67735</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>MES0204122KA</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id='contornoInfo' class='contorno' style='display:none'>
    <h5 class='titulo font16'>INFO GENERAL</h5>
    <table class='table text-center' id='eInfo'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12'>INFORMACION GENERAL NO EDITABLE</td>
        </tr>
        <tr class='row backpink font14'>
          <td class='col-md-2'>No.solicitud</td>
          <td class='col-md-2'>Almacen</td>
          <td class='col-md-1'>Aduana</td>
          <td class='col-md-1'>Tipo</td>
          <td class='col-md-2'>Valor</td>
          <td class='col-md-1'>Peso</td>
          <td class='col-md-2'>Volumen</td>
          <td class='col-md-1'>Dias</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row'>
          <td class='col-md-2'>280380</td>
          <td class='col-md-2'>Sin Nombre</td>
          <td class='col-md-1'>240</td>
          <td class='col-md-1'>IMP</td>
          <td class='col-md-2'>906600.7667</td>
          <td class='col-md-1'>4660</td>
          <td class='col-md-2'>20000</td>
          <td class='col-md-1'>1</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class='contorno'>
  <h5 class='titulo font14'>EDITAR SOLICITUD</h5>
  <div class='container-fluid'>
    <div class='acordeon2'>
      <div class='encabezado font16' data-toggle='collapse' href='#collapseOne'>
        <a  id='bread'>PAGOS O CARGOS EN MONEDA EXTRANJERA</a>
      </div>
      <div id='collapseOne' class='card-block collapse'>
        <form class='form1'>
          <table class='table text-center'>
            <tbody>
              <tr class='row mt-3 m-0'>
                <td class='col-md-6'>
                  <select class='custom-select'>
                    <option selected>Tarifa del Cliente</option>
                    <option>Acarreo Local</option>
                    <option>Cruce</option>
                    <option>Cuenta Mexicana</option>
                    <option>Declaracion de Exportacion de USA a MEX (Shipper)</option>
                    <option>Documentacion: Importacion / Exportacion (Aduana Americana)</option>
                    <option>Entrada Garantizada (In-Bond)</option>
                    <option>Entradas Adicionales</option>
                    <option>Flete</option>
                    <option>Maniobras Especiales</option>
                    <option>Otros Pagos a Terceros</option>
                    <option>Rectificacion de Pedimento</option>
                    <option>Servicio Extraordinario</option>
                    <option>Tarimas</option>
                  </select>
                </td>
                <td class='col-md-6 text-center'>
                  <select class='custom-select'>
                    <option selected>Tarifa del General</option>
                    <option>Acarreo Local</option>
                    <option>Almacenaje</option>
                    <option>Bodega Fiscal</option>
                    <option>Cambio de Regimen</option>
                    <option>Conectividad</option>
                    <option>Correccion de Factura</option>
                    <option>Cruce</option>
                    <option>Cuenta Mexicana</option>
                    <option>Declaracion de Exportacion de USA a MEX (Shipper)</option>
                    <option>Demoras</option>
                    <option>Descarga a Piso</option>
                    <option>Descarga y Carga</option>
                    <option>Documentacion</option>
                    <option>Documentacion: Importacion / Exportacion (Aduana Americana)</option>
                    <option>Entrada Garantizada (In-Bond)</option>
                    <option>Entradas Adicionales</option>
                    <option>Etiquetado</option>
                    <option>Flete</option>
                    <option>Impuestos o Derechos</option>
                    <option>Inventario</option>
                    <option>Manejo (Clientes no Frecuentes)</option>
                    <option>Manejo de Bodega</option>
                    <option>Maniobras Especiales</option>
                    <option>Maniobras para Envio</option>
                    <option>Otros</option>
                    <option>Permisos Especiales</option>
                    <option>Previo</option>
                    <option>Rectificacion de Pedimento</option>
                    <option>Reexpedicion</option>
                    <option>Rojo (Reconocimiento Aduanero)</option>
                    <option>Servicio Extraordinario</option>
                    <option>Tarimas</option>
                    <option>Traspaleo</option>
                    <option>USDA (Certificacion en USA)</option>
                    <option>VUCEM</option>
                  </select>
                </td>
              </tr>
              <tr class='row mt-3 m-0'>
                <td class='col-md-1'></td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-6'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-1'></td>
              </tr>
            </tbody>
          </table>

          <table class='table text-center'>
            <tbody>
              <tr class='row mt-4 m-0 backpink'>
                <td class='col-md-1'>SERV.</td>
                <td class='col-md-4'>CONCEPTO</td>
                <td class='col-md-3'>DESCRIPCION</td>
                <td class='col-md-2'>IMPORTE</td>
                <td class='col-md-2'>SUBTOTAL</td>
              </tr>
              <tr class='row m-0'>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-4'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-3'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text'>
                </td>
              </tr>
              <tr class='row m-0'>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-4'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-3'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text'>
                </td>
              </tr>
              <tr class='row mt-4 m-0 sub2'>
                <th class='col-md-2'>Total</th>
                <td class='col-md-2'>0.00</td>
                <th class='col-md-2'>Al Tipo de Cambio</th>
                <td class='col-md-2'>0.00</td>
                <th class='col-md-2'>Total MN</th>
                <td class='col-md-2'>0.00</td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class='acordeon2 mt-3'>
      <div class='encabezado font16' data-toggle='collapse' href='#collapseTwo'>
        <a  id='bread'>PAGOS REALIZADOS POR SU CUENTA</a>
      </div>
      <div id='collapseTwo' class='card-block collapse'>
        <form class='form1'>
          <table class='table text-center'>
            <tbody>
              <tr class='row m-0'>
                <td class='col-md-1'>Almacen</td>
                <td class='col-md-4'><span>Tarifa no Capturada</span></td>
              </tr>
              <tr class='row m-0'>
                <td class='col-md-1 pt-4'>Libres</td>
                <td class='col-md-4'>
                  <select class='custom-select'>
                    <option selected>Seleccione un Concepto</option>
                    <option>Almacenaje</option>
                    <option>Descosolidacion</option>
                    <option>Flete Aereo</option>
                    <option>Flete Maritimo</option>
                    <option>Flete Terrestre</option>
                    <option>Flete Terrestre Franja Fronteriza</option>
                    <option>Lavado de Contenedor</option>
                    <option>Maniobras</option>
                    <option>Montacargas</option>
                    <option>Muellaje</option>
                    <option>Otros Gastos Comprobados</option>
                    <option>Previo</option>
                    <option>Reconocimiento Aduanero</option>
                    <option>Rectificacion de Pedimentos</option>
                    <option>THC</option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <table class='table text-center'>
            <tbody>
              <tr class='row mt-4 m-0 backpink'>
                <th class='col-md-6'>CONCEPTO</th>
                <th class='col-md-1'>IMPORTE</th>
                <th class='col-md-1'></th>
                <th class='col-md-1'>CUSTODIA</th>
                <th class='col-md-1'>MANIOBRAS</th>
                <th class='col-md-1'>ALMACENAJE</th>
                <th class='col-md-1'>TOTAL</th>
              </tr>
              <tr class='row m-0'>
                <td class='col-md-6'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text'>
                </td>
              </tr>

              <tr class='row borderojo m-0'></tr>

              <tr class='row mt-3 m-0 sub'>
                <th class='col-md-6'>CONCEPTOS</th>
                <th class='col-md-1'></th>
                <th class='col-md-2'>IMPORTE</th>
                <th class='col-md-1'>16%IVA</th>
                <th class='col-md-2'>SUBTOTAL</th>
              </tr>
              <tr class='row m-0'>
                <td class='col-md-6'>
                  <input class='efecto' type='text' value='Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/Resources/iconos/001-delete.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text' value='$450.00'>
                </td>
                <td class='col-md-1'>
                  <input class='efecto' type='text' value='$72.00'>
                </td>
                <td class='col-md-2'>
                  <input class='efecto' type='text' value='$522.00'>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class='acordeon2 mt-3'>
      <div class='encabezado font16' data-toggle='collapse' href='#collapseThree'>
        <a  id='bread'>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</a>
      </div>
      <div id='collapseThree' class='panel-collapse collapse'>
        <div class='card-block'>
          <form class='form1'>
            <table class='table text-center font14'>
              <tbody>
                <tr class='row m-0'>
                  <td class='col-md-1 pt-4'>Honorarios</td>
                  <td class='col-md-4'>
                    <select class='custom-select'>
                      <option selected>Seleccione un Concepto</option>
                      <option>Cambios de Regimen o R1 Imputable a la Agencia</option>
                      <option>Documentacion y Despacho</option>
                      <option>documentacion  y Fotostaticas</option>
                      <option>Elaboracion de Pedimento (R1)</option>
                      <option>Honararios</option>
                      <option>Manifestacion de Valor</option>
                      <option>Reconocimiento Aduanero</option>
                      <option>Tramites y Servicios</option>
                      <option>VUCEM</option>
                    </select>
                  </td>
                </tr>
                <tr class='row m-0'>
                  <td class='col-md-1 pt-4'>Libres</td>
                  <td class='col-md-4'>
                    <select class='custom-select'>
                      <option selected>Seleccione un Concepto</option>
                      <option>Almacenaje</option>
                      <option>Descosolidacion</option>
                      <option>Flete Aereo</option>
                      <option>Flete Maritimo</option>
                      <option>Flete Terrestre</option>
                      <option>Flete Terrestre Franja Fronteriza</option>
                      <option>Lavado de Contenedor</option>
                      <option>Maniobras</option>
                      <option>Montacargas</option>
                      <option>Muellaje</option>
                      <option>Otros Gastos Comprobados</option>
                      <option>Previo</option>
                      <option>Reconocimiento Aduanero</option>
                      <option>Rectificacion de Pedimentos</option>
                      <option>THC</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class='table text-center'>
              <tbody>
                <tr class='row m-0 mt-4 backpink'>
                  <td class='col-md-6'>CONCEPTO</td>
                  <td class='col-md-2'>IMPORTE</td>
                  <td class='col-md-1'></td>
                  <td class='col-md-3'>MINIMO DE HONORARIOS</td>
                </tr>
                <tr class='row m-0'>
                  <td class='col-md-6'>
                    <input class='efecto' type='text'>
                  </td>
                  <td class='col-md-2'>
                    <input class='efecto' type='text'>
                  </td>
                  <td class='col-md-1 text-left'>
                    <a href=''><img src='/Resources/iconos/002-plus.svg' class='icomediano'></a>
                  </td>
                  <td class='col-md-3'>
                    <input class='efecto' type='text'>
                  </td>
                </tr>

                <tr class='row borderojo m-0'></tr>

                <tr class='row m-0 mt-4 sub'>
                  <th class='col-md-6'>CONCEPTOS</th>
                  <th class='col-md-1'></th>
                  <th class='col-md-2'>IMPORTE</th>
                  <th class='col-md-1'>16%IVA</th>
                  <th class='col-md-2'>SUBTOTAL</th>
                </tr>
                <tr class='row m-0'>
                  <td class='col-md-6'>
                    <input class='efecto' type='text' value='Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.'>
                  </td>
                  <td class='col-md-1 text-left'>
                    <a href=''><img src='/Resources/iconos/001-delete.svg' class='icomediano'></a>
                  </td>
                  <td class='col-md-2'>
                    <input class='efecto' type='text' value='$450.00'>
                  </td>
                  <td class='col-md-1'>
                    <input class='efecto' type='text' value='$72.00'>
                  </td>
                  <td class='col-md-2'>
                    <input class='efecto' type='text' value='$522.00'>
                  </td>
                </tr>
                <tr class='row borderojo m-0'></tr>
              </tbody>
            </table>
            <table class='table text-center mt-3 font14'>
              <tbody>
                <tr class='row m-0'>
                  <td class='col-md-6 text-right pt-4'>Totales</td>
                  <td class='col-md-1'>
                    <input class='boton' type='button' value='Calcular'>
                  </td>
                  <td class='col-md-2 pt-4'>$450.00</td>
                  <td class='col-md-1 pt-4'>$72.00</td>
                  <td class='col-md-2 pt-4'>$522.00</td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
