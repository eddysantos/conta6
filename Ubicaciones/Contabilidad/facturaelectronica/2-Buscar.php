<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<!--Comienza el breadcrumb-->
<div class="col-md-12">
  <ol class="list-inline" >
    <li class="list-inline-item"><a href="#" id="bread">Contabilidad</a><i class="fa fa-angle-double-right"></i></li>
    <li class="list-inline-item"><a href="#" id="bread">Factura Electronica</a><i class="fa fa-angle-double-right"></i></li>
    <li class="list-inline-item"><a href="#" id="bread">Cuenta de Gastos</a><i class="fa fa-angle-double-right"></i></li>
    <li class="list-inline-item" active>Buscar</li>
  </ol>
</div>

<!--//termina el breadcrumb-->
<a href="CuentaGastos.php" class="btn  brx1" id="btn"><i class="fa fa-angle-double-left fa-lg"></i>Regresar</a>

<div class="container-fluid cont brx2">
  <form method="post" style="letter-spacing:4px;">
    <table class="notable text-center table-bordered m0b0">
      <tbody>
        <tr class="row">
          <th class="col-md-2 text-center sub">Almacen</th>
          <th class="col-md-2 text-center sub">Aduana</th>
          <th class="col-md-2 text-center sub">Tipo</th>
          <th class="col-md-2 text-center sub">Valor</th>
          <th class="col-md-2 text-center sub">Peso</th>
          <th class="col-md-2 text-center sub">Dias</th>
        </tr>
        <tr class="row">
          <td class="col-md-2 text-center ">Sin Nombre</td>
          <td class="col-md-2 text-center ">240</td>
          <td class="col-md-2 text-center ">0</td>
          <td class="col-md-2 text-center ">337274.2563</td>
          <td class="col-md-2 text-center ">19527</td>
          <td class="col-md-2 text-center ">1</td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<div class="container-fluid cont brx1" style="border-bottom:1px solid rgba(190, 91, 106, 0.33)">
  <form style="letter-spacing:4px;">
    <table class="notable">
      <tbody>
        <tr>
          <td>
            <table class="notable" style="margin-top:-170px">
              <tbody>
                <tr class="row">
                  <td class="col-md-11 text-center sub">Cliente</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11">Motores electricos Sumergibles de Mexico S. de R.L de C.V</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11">Ave.Industrial Alimentaria 2001</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11">Parque Industrial Linares</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11">67735 Linares Nuevo Leon</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11">R.F.C MES0204122KA</td>
                </tr>
              </tbody>
            </table>

            <table class="notable brx1">
              <tbody>
                <tr class="row">
                  <td class="col-md-11 text-center sub">PROVEEDOR (IMP) O DESTINATARIO (EXP)</td>
                </tr>
                <tr class="row">
                  <td class="col-md-11 text-center ">J.M HUBER CORPORATION</td>
                </tr>
              </tbody>
            </table>
          </td>
          <td>
            <table class="notable">
              <tbody>
                <tr class="row">
                  <td class="col-md-12 text-center sub">INFORMACION GENERAL DEL EMBARQUE</td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Aduana</td>
                  <td class="col-md-6  text-center">240</td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Nuestra Referencia</td>
                  <td class="col-md-6  text-center">N17003035</td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Descripcion General</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="Hidroxido de Aluminio"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Peso en Kg</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="19527"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Tipo de Operacion</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="IMP"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Talones, Guia o B/Ls</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="1652428"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Facturas</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="934583...."></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Fecha Arribo o Salida</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Procedencia o Destino</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">No.Pedimento</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="7003386"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Su Referencia</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="Solicitud Anticipo 280393"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Clase de Mercancia</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Bill of Lading</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text"></td>
                </tr>
                <tr class="row row-notable">
                  <td class="col-md-6 sub2">Valor en M.N</td>
                  <td class="col-md-6 "><input class="input-dpol form-control  border" type="text" value="337274"></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <br>
</div>

<div class="fieldset brx1">
  <h5 class="titulo2">PAGOS O CARGOS EN MONEDA EXTRANJERA</h5>
  <div class="container-fluid cont">
    <form  action="" method="post" style="letter-spacing:5px;">
      <table class="notable text-center table-bordered m0b0">
        <tbody>
          <tr class="row">
            <th class="col-md-1 text-center sub">SERV.</th>
            <th class="col-md-4 text-center sub">CONCEPTO</th>
            <th class="col-md-3 text-center sub">DESCRIPCION</th>
            <th class="col-md-2 text-center sub">IMPORTE</th>
            <th class="col-md-2 text-center sub">SUBTOTAL</th>
          </tr>
          <tr class="row">
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-4">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control  border" type="text" >
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control  border" type="text" >
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-4">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control  border" type="text" >
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control  border" type="text" >
            </td>
          </tr>
          <tr class="row">
            <th class="col-md-2 text-center sub2">Total</th>
            <td class="col-md-2">0.00</td>
            <th class="col-md-2 text-center sub2">Al Tipo de Cambio</th>
            <td class="col-md-2">0.00</td>
            <th class="col-md-2 text-center sub2">Total MN</th>
            <td class="col-md-2">0.00</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>

<div class="fieldset brx1">
  <h5 class="titulo2">PAGOS REALIZADOS POR SU CUENTA</h5>
  <div class="container-fluid cont">
    <form  action="" method="post" style="letter-spacing:5px;">
      <table class="notable text-center m0b0">
        <tbody>
          <tr class="row row-notable">
            <th class="col-md-9 text-center sub">CONCEPTOS</th>
            <th class="col-md-3 text-center sub">SUBTOTAL</th>
          </tr>
          <tr class="row row-notable">
            <td class="col-md-9">
              <input class="input-dpol form-control " type="text" value="Impuestos Afianzados o Subsidios">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text" value="0.00">
            </td>
          </tr>
          <tr class="row row-notable">
            <td class="col-md-9">
              <input class="input-dpol form-control " type="text" value="Impuestos y/o Derechos Pagados o Garantizados al Com. Ext.">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text" value="$6,209.00">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>

<div class="fieldset brx1">
  <h5 class="titulo2">HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</h5>
  <div class="container-fluid cont" style="border-bottom:1px solid rgba(190, 91, 106, 0.33)">
    <form method="post" style="letter-spacing:5px;">
      <table class="notable text-center m0b0">
        <tbody>
          <tr class="row row-notable">
            <th class="col-md-6 text-center sub">CONCEPTOS</th>
            <th class="col-md-1"></th>
            <th class="col-md-2 text-center sub">IMPORTE</th>
            <th class="col-md-1 text-center sub">16%IVA</th>
            <th class="col-md-2 text-center sub">SUBTOTAL</th>
          </tr>
          <tr class="row row-notable">
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text" value="0.2">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text" value="% de Honorarios sobre la base de:">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="119105.00">
            </td>
            <td class="col-md-1"></td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$450.00">
            </td>
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text" value="$72.00">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$522.00">
            </td>
          </tr>
          <tr class="row row-notable">
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text" value="0.00">
            </td>
            <td class="col-md-3">
              <input class="input-dpol form-control " type="text" value="% de Descuento">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="0.00">
            </td>
            <td class="col-md-1"></td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$0.00">
            </td>
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text" value="$0.00">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$0.00">
            </td>
          </tr>
          <tr class="row row-notable">
            <td class="col-md-6">
              <input class="input-dpol form-control " type="text" value="Tramites y Servicios">
            </td>
            <td class="col-md-1"></td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$450.00">
            </td>
            <td class="col-md-1">
              <input class="input-dpol form-control " type="text" value="$72.00">
            </td>
            <td class="col-md-2">
              <input class="input-dpol form-control " type="text" value="$522.00">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <br>
  </div>

  <div class="container-fluid cont brx1">
    <form method="post" style="letter-spacing:1px;font-size:10px">
      <table class="notable">
        <tbody>
          <tr>
            <td>
              <table class="notable" style="margin-top:-125px">
                <tbody>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Version</th>
                    <td class="col-md-4 text-center ">3.2</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Cta.Gastos</th>
                    <td class="col-md-4 text-center ">75681</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Factura</th>
                    <td class="col-md-4 text-center  sub2">74965</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Poliza</th>
                    <td class="col-md-4 text-center ">246383</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Poliza</th>
                    <td class="col-md-4 text-center ">246383</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Cancelacion</th>
                    <td class="col-md-4 text-center "></td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Certificado PLAA</th>
                    <td class="col-md-4 text-center ">000010000000404750920</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Certificado SAT</th>
                    <td class="col-md-4 text-center ">000010000000404477432</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Generada</th>
                    <td class="col-md-4 text-center ">epinales 05-05-2017 15:05:17</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-4 text-center iap">Modificada</th>
                    <td class="col-md-4 text-center ">epinales 05-05-2017 15:05:17</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-12 text-center iap">UUID</th>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-12 text-center ">D99218FD-3755-40EF-A4BF-45B9F1DA31DD</th>
                  </tr>
                </tbody>
              </table>

              <table class="notable brx2">
                <tbody>
                  <tr class="row row-notable">
                    <td class="col-md-12 text-center sub2">*SIETE MIL OCHOCIENTOS TREINTA Y TRES PESOS 00/100 M.N.*</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-3 text-center sub2">Metodo de Pago</th>
                    <td class="col-md-2 text-center ">03</td>
                    <td class="col-md-2 text-center ">Transferencia</td>
                  </tr>
                  <tr class="row row-notable">
                    <th class="col-md-3 text-center sub2">Cuenta de Pago</th>
                    <td class="col-md-2 text-center ">3336</td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td>
              <table class="notable">
                <tbody>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total Honoarios y Servicios</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$1,400.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">16% IVA sobre Honorarios y Servicios</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$224.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Subtotal Honorarios y Servicios</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$1,624.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Retencion(4%) Impto.IVA</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$1,624.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total Pgos/Cgos en Moneda Extranjera</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total Pagos Realizados por su Cuenta</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$6,209.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total Cuenta de Gastos</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$7,833.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 1</td>
                    <td class="col-md-3 text-center iap">25662</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$7,833.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 2</td>
                    <td class="col-md-3 text-center iap"></td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 3</td>
                    <td class="col-md-3 text-center iap"></td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 4</td>
                    <td class="col-md-3 text-center iap"></td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 5</td>
                    <td class="col-md-3 text-center iap"></td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-3 sub2">Anticipo 6</td>
                    <td class="col-md-3 text-center iap"></td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Total Anticipos</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="$7,833.00"></td>
                  </tr>
                  <tr class="row row-notable">
                    <td class="col-md-1"></td>
                    <td class="col-md-6 sub2">Saldo</td>
                    <td class="col-md-5 "><input class="input-dpol form-control  border" type="text" value="0.00"></td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <br>
 </div>
