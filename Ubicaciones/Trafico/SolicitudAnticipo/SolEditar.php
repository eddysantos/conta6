<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class='container-fluid'>
  <div class='row m-0 submenuMed'>
    <div class='col-md-6 text-center' role='button'>
      <a  id='submenuMed' class='trafico' accion='datcliente' status='cerrado'>DATOS CLIENTE</a>
    </div>
    <div class='col-md-6 text-center'>
      <a id='submenuMed' class='trafico' accion='datinfo' status='cerrado'>INFO. GENERAL</a>
    </div>
  </div>

  <div class='col-md-1 text-center' style='padding:15px'>
    <a href='SolAnticipo.php'>
      <img class='icomediano' src='/conta6/Resources/iconos/left.svg'>
    </a>
    <a href='#' style='margin-left:30px'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a>
  </div>

  <div id='contornoCliente' class='contorno brx4' style='display:none'>
    <h5 class='titulo font14'>DATOS CLIENTES</h5>
    <table class='table text-center' id='eCliente'>
      <thead>
        <tr class='row encabezado'>
          <td class='col-md-12'>MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 subtext'>Direccion</td>
          <td class='col-md-6 subtext'>Proveedor</td>
        </tr>
      </thead>
      <tbody class='cuerpo'>
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
  <div id='contornoInfo' class='contorno brx4' style='display:none'>
    <h5 class='titulo' style='font-size:15px'>INFO GENERAL</h5>
    <table class='table text-center' id='eInfo'>
      <thead>
        <tr class='row'>
          <td class='col-md-12 encabezado'>INFORMACION GENERAL NO EDITABLE</td>
        </tr>
        <tr class='row'>
          <td class='col-md-2 subtext'>No.solicitud</td>
          <td class='col-md-2 subtext'>Almacen</td>
          <td class='col-md-1 subtext'>Aduana</td>
          <td class='col-md-1 subtext'>Tipo</td>
          <td class='col-md-2 subtext'>Valor</td>
          <td class='col-md-1 subtext'>Peso</td>
          <td class='col-md-2 subtext'>Volumen</td>
          <td class='col-md-1 subtext'>Dias</td>
        </tr>
      </thead>
      <tbody class='cuerpo'>
        <tr class='row'>
          <td class='col-md-2 text-center'>280380</td>
          <td class='col-md-2 text-center'>Sin Nombre</td>
          <td class='col-md-1 text-center'>240</td>
          <td class='col-md-1 text-center'>IMP</td>
          <td class='col-md-2 text-center'>906600.7667</td>
          <td class='col-md-1 text-center'>4660</td>
          <td class='col-md-2 text-center'>20000</td>
          <td class='col-md-1 text-center'>1</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class='contorno brx4'>
  <h5 class='titulo' style='font-size:15px'>EDITAR SOLICITUD</h5>
  <div class='container-fluid'>
    <div class='acordeon2'>
      <div class='encabezado text-center' data-toggle='collapse' href='#collapseOne'>
        <a  id='bread'>PAGOS O CARGOS EN MONEDA EXTRANJERA</a>
      </div>
      <div id='collapseOne' class='card-block collapse'>
        <form class='form1'>
          <table class='table m0b0'>
            <tbody>
              <tr class='row brx1 ml-0 mr-0'>
                <td class='col-md-6 text-center'>
                  <select class='form-control'>
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
                  <select class='form-control'>
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
              <tr class='row ml-0 mr-0'>
                <td class='col-md-1'></td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-6'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-1'></td>
              </tr>
            </tbody>
          </table>

          <table class='table m0b0'>
            <tbody>
              <tr class='row brx3 ml-0 mr-0'>
                <td class='col-md-1 text-center iap'>SERV.</td>
                <td class='col-md-4 text-center iap'>CONCEPTO</td>
                <td class='col-md-3 text-center iap'>DESCRIPCION</td>
                <td class='col-md-2 text-center iap'>IMPORTE</td>
                <td class='col-md-2 text-center iap'>SUBTOTAL</td>
              </tr>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-4'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-3'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text'>
                </td>
              </tr>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-4'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-3'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text'>
                </td>
              </tr>
              <tr class='row brx3 text-normal ml-0 mr-0'>
                <th class='col-md-2 text-center text-normal sub2'>Total</th>
                <td class='col-md-2'>0.00</td>
                <th class='col-md-2 text-center text-normal sub2'>Al Tipo de Cambio</th>
                <td class='col-md-2'>0.00</td>
                <th class='col-md-2 text-center text-normal sub2'>Total MN</th>
                <td class='col-md-2'>0.00</td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class='acordeon2 brx1'>
      <div class='encabezado text-center' data-toggle='collapse' href='#collapseTwo'>
        <a  id='bread'>PAGOS REALIZADOS POR SU CUENTA</a>
      </div>
      <div id='collapseTwo' class='card-block collapse'>
        <form class='form1'>
          <table class='table m0b0'>
            <tbody>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-1'>Almacen</td>
                <td class='col-md-4'><span>Tarifa no Capturada</span></td>
              </tr>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-1'>Libres</td>
                <td class='col-md-4 text-center'>
                  <select class='form-control'>
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
          <table class='table m0b0'>
            <tbody>
              <tr class='row brx2 ml-0 mr-0'>
                <th class='col-md-6 text-center iap'>CONCEPTO</th>
                <th class='col-md-1 text-center iap'>IMPORTE</th>
                <th class='col-md-1 text-center iap'></th>
                <th class='col-md-1 text-center iap'>CUSTODIA</th>
                <th class='col-md-1 text-center iap'>MANIOBRAS</th>
                <th class='col-md-1 text-center iap'>ALMACENAJE</th>
                <th class='col-md-1 text-center iap'>TOTAL</th>
              </tr>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-6'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text'>
                </td>
              </tr>

              <tr class='row borderojo ml-0 mr-0'></tr>

              <tr class='row brx2 ml-0 mr-0'>
                <th class='col-md-6 text-center sub'>CONCEPTOS</th>
                <th class='col-md-1'></th>
                <th class='col-md-2 text-center sub'>IMPORTE</th>
                <th class='col-md-1 text-center sub'>16%IVA</th>
                <th class='col-md-2 text-center sub'>SUBTOTAL</th>
              </tr>
              <tr class='row ml-0 mr-0'>
                <td class='col-md-6'>
                  <input class='inpReg' type='text' value='Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.'>
                </td>
                <td class='col-md-1 text-left'>
                  <a href=''>
                    <img src='/conta6/Resources/iconos/001-delete.svg' class='icomediano'>
                  </a>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text' value='$450.00'>
                </td>
                <td class='col-md-1'>
                  <input class='inpReg' type='text' value='$72.00'>
                </td>
                <td class='col-md-2'>
                  <input class='inpReg' type='text' value='$522.00'>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class='acordeon2 brx1'>
      <div class='encabezado text-center' data-toggle='collapse' href='#collapseThree'>
        <a  id='bread'>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</a>
      </div>
      <div id='collapseThree' class='panel-collapse collapse'>
        <div class='card-block'>
          <form class='form1'>
            <table class='table m0b0' style='font-size:12px'>
              <tbody>
                <tr class='row ml-0 mr-0'>
                  <td class='col-md-1'>Honorarios</td>
                  <td class='col-md-4 text-center'>
                    <select class='form-control'>
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
                <tr class='row ml-0 mr-0'>
                  <td class='col-md-1'>Libres</td>
                  <td class='col-md-4 text-center'>
                    <select class='form-control '>
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
            <table class='table m0b0'>
              <tbody>
                <tr class='row brx2 ml-0 mr-0'>
                  <td class='col-md-6 text-center iap'>CONCEPTO</td>
                  <td class='col-md-2 text-center iap'>IMPORTE</td>
                  <td class='col-md-2 text-center iap'></td>
                  <td class='col-md-2 text-center iap'>MINIMO DE HONORARIOS</td>
                </tr>
                <tr class='row ml-0 mr-0'>
                  <td class='col-md-6'>
                    <input class='inpReg' type='text'>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg' type='text'>
                  </td>
                  <td class='col-md-2 text-left'>
                    <a href=''>
                      <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                    </a>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg' type='text'>
                  </td>
                </tr>

                <tr class='row borderojo ml-0 mr-0'></tr>

                <tr class='row brx2 ml-0 mr-0'>
                  <th class='col-md-6 text-center sub'>CONCEPTOS</th>
                  <th class='col-md-1'></th>
                  <th class='col-md-2 text-center sub'>IMPORTE</th>
                  <th class='col-md-1 text-center sub'>16%IVA</th>
                  <th class='col-md-2 text-center sub'>SUBTOTAL</th>
                </tr>
                <tr class='row ml-0 mr-0'>
                  <td class='col-md-6'>
                    <input class='inpReg ' type='text' value='Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.'>
                  </td>
                  <td class='col-md-1 text-left'>
                    <a href=''>
                      <img src='/conta6/Resources/iconos/001-delete.svg' class='icomediano'>
                    </a>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg' type='text' value='$450.00'>
                  </td>
                  <td class='col-md-1'>
                    <input class='inpReg' type='text' value='$72.00'>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg' type='text' value='$522.00'>
                  </td>
                </tr>
                <tr class='row borderojo ml-0 mr-0'></tr>
              </tbody>
            </table>
            <table class='table brx1'>
              <tbody>
                <tr class='row ml-0 mr-0'>
                  <td class='col-md-6 text-right p-0'>Totales</td>
                  <td class='col-md-1'>
                    <input class='btn-block btn-dpol' type='button' style='height:18px' value='Calcular'>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg noborder' type='text' value='$450.00'>
                  </td>
                  <td class='col-md-1'>
                    <input class='inpReg noborder' type='text' value='$72.00'>
                  </td>
                  <td class='col-md-2'>
                    <input class='inpReg noborder' type='text' value='$522.00'>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
