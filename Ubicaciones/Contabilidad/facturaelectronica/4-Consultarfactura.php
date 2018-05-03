<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid" id="buscarfactura">
  <div class="col-md-1 offset-md-11 p-0 brx2">
    <a class="atras" href="#ConsultarFactura" data-toggle="modal">
      <i class="back fa fa-arrow-left">Regresar</i>
    </a>
  </div>

  <div class="contorno" id="m-factura">
    <form method="post">
      <table class="table">
        <thead>
          <tr class="row tRepoNom">
            <td class="col-md-12 text-center" style="font-size:18px">FACTURAS</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row">
            <td class="col-md-1 text-center iap"></td>
            <td class="col-md-1 text-center iap">FECHA</td>
            <td class="col-md-1 text-center iap">FACTURA</td>
            <td class="col-md-1 text-center iap">POLIZA</td>
            <td class="col-md-1 text-center iap">CANCELADA</td>
            <td class="col-md-1 text-center iap">CTA.GASTOS</td>
            <td class="col-md-1 text-center iap">REFERENCIA</td>
            <td class="col-md-4 text-center iap">CLIENTE</td>
            <td class="col-md-1 text-center iap"></td>
          </tr>
          <tr class="row borderojo" style="font-size:14px!important">
            <td class="col-md-1 text-center" style="padding:5px">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a>
              <a><img class="icomediano mleftx2" src="/conta6/Resources/iconos/pdf.svg"></a>
            </td>
            <td class="col-md-1 text-center">17-07-2017</td>
            <td class="col-md-1 text-center">77166</td>
            <td class="col-md-1 text-center">252815</td>
            <td class="col-md-1 text-center">252815</td>
            <td class="col-md-1 text-center">77919</td>
            <td class="col-md-1 text-center">N17003012</td>
            <td class="col-md-4 text-center">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
            <td class="col-md-1 text-center" style="padding:5px">
              <a class="ver" accion="cuadroVer"><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
              <a><img class="icomediano mleftx2" src="/conta6/Resources/iconos/printer.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div><!--/Termina Container FLuid-->




<div id="ConsulFactura" style="display:none">
<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-4 text-center" role="button">
      <a  id="submenuMed" class="visualizar" accion="Ver-cliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="visualizar" accion="Ver-iUsuario" status="cerrado">USUARIO</a>
    </div>
  </div>
</div>

<div class="col-md-2" style="padding:10px">
  <a href="4-Consultarfactura.php">
    <img class="icomediano mleftx2" src="/conta6/Resources/iconos/left.svg">
  </a>
  <a href="" class="mleftx3">
    <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
  </a>
</div>

<div class="container-fluid">
  <div id="contorno1" class="contorno" style="display:none">
    <table class="table" id="detalleCliente" style="display:none">
      <thead>
        <tr class="row m-0">
          <td class="col-md-12 text-center tRepo2">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-center subtext">Direccion</td>
          <td class="col-md-6 text-center subtext">Proveedor</td>
        </tr>
      </thead>
      <tbody class="contenidorow cuerpo">
        <tr class="row m-0">
          <td class="col-md-6 text-center">Ave.Industrial Alimentaria 2001</td>
          <td class="col-md-6 text-center">EC, DBA KECO</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-center">Parque Industrial Linares</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-center">Linares Nuevo Leon C.P 67735</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-center">MES0204122KA</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="contorno2" class="contorno" style="display:none">
    <table class="table" style="display:none" id="detalleEmbarque">
      <thead>
        <tr class="row tRepo2 m-0">
          <td class="col-md-12 text-center">INFORMACION GENERAL</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-4 subtext">Aduana</td>
          <td class="col-md-4 subtext">Solicitud</td>
          <td class="col-md-4 subtext">Fecha</td>
        </tr>
      </thead>
      <tbody class="contenidorow cuerpo">
        <tr class="row m-0 borderojo">
          <td class="col-md-4 text-center">240</td>
          <td class="col-md-4 text-center">280380</td>
          <td class="col-md-4 text-center">02/05/2017</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Nuestra Referencia:</td>
          <td class="col-md-6 text-left">N17003012</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Descripcion General:</td>
          <td class="col-md-6 text-left">Hidroxido de Aluminio</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Peso en Kg:</td>
          <td class="col-md-6 text-left">4660</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Tipo de Operacion:</td>
          <td class="col-md-6 text-left">IN</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Talones, Guia o B/Ls:</td>
          <td class="col-md-6 text-left">316140370</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Facturas:</td>
          <td class="col-md-6 text-left">47352,47353,47354,47355,47...</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Fecha Arribo o Salida:</td>
          <td class="col-md-6 text-left">01/05/2017</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Procedencia o Destino:</td>
          <td class="col-md-6 text-left"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">No.Pedimento:</td>
          <td class="col-md-6 text-left">7003386</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Caja:</td>
          <td class="col-md-6 text-left"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Valor en M.N:</td>
          <td class="col-md-6 text-left">906,601/00</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="contorno3" class="contorno" style="display:none">
    <table  class="table" style="display:none;" id="detalleUsuario">
      <thead>
        <tr class="row m-0 tRepo2">
          <td class="col-md-6 text-center">GENERADO POR:</td>
          <td class="col-md-6 text-center">MODIFICADO POR:</td>
        </tr>
      </thead>
      <tbody class="contenidorow cuerpo">
        <tr class="row m-0">
          <td class="col-md-6">Vgonzalez</td>
          <td class="col-md-6">Vgonzalez</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6">02/05/2017 09:06:00</td>
          <td class="col-md-6">02/05/2017 09:06:00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!--Esta informacion si estara visible SOLICITUD DE ANTICIPO-->
<div class="contorno brx4">
  <h5 class="titulo" style="font-size:14px">SOLICITUD ANTICIPO</h5>
    <div class="container-fluid">
      <table class="table brx2">
        <thead>
          <tr class="row tRepo2 m-0">
            <td class="col-md-6 text-center">PAGOS O CARGOS EN USD</td>
            <td class="col-md-2 text-center">IMPORTE</td>
            <td class="col-md-2 text-center">AL T.C</td>
            <td class="col-md-2 text-center">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="contenidorow">
          <tr class="row m-0">
            <td class="col-md-6 text-center">1 Reexpedicion</td>
            <td class="col-md-2 text-center">$ 236.00</td>
            <td class="col-md-2 text-center">$ 19.07</td>
            <td class="col-md-2 text-center">$ 4,500.52</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">1 Cruce</td>
            <td class="col-md-2 text-center">$ 125.00</td>
            <td class="col-md-2 text-center">$ 19.07</td>
            <td class="col-md-2 text-center">$ 2,383.75</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">2 Servicio Extraordinario</td>
            <td class="col-md-2 text-center">$ 240.00</td>
            <td class="col-md-2 text-center">$ 19.07</td>
            <td class="col-md-2 text-center">$ 4,576.80</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">1 Declaracion de Exportacion de USA a MEX (Shipper)</td>
            <td class="col-md-2 text-center">$ 10.00</td>
            <td class="col-md-2 text-center">$ 19.07</td>
            <td class="col-md-2 text-center">$ 190.07</td>
          </tr>
        </tbody>
      </table>

      <table class="table brx2">
        <thead>
          <tr class="row tRepo2 m-0">
            <td class="col-md-6 text-center">PAGOS POR CUENTA CLIENTE</td>
            <td class="col-md-2 text-center">IMPORTE</td>
            <td class="col-md-2 text-center">IVA</td>
            <td class="col-md-2 text-center">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="contenidorow">
          <tr class="row m-0">
            <td class="col-md-6 text-center">Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.</td>
            <td class="col-md-2 text-center">$ 267.00</td>
            <td class="col-md-2 text-center">$ 0.00</td>
            <td class="col-md-2 text-center">$ 267.00</td>
          </tr>
        </tbody>
      </table>

      <table class="table brx2">
        <thead>
          <tr class="row tRepo2 m-0">
            <td class="col-md-6 text-center">HONORARIOS Y SERVICIOS</td>
            <td class="col-md-2 text-center">IMPORTE</td>
            <td class="col-md-2 text-center">IVA</td>
            <td class="col-md-2 text-center">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="contenidorow">
          <tr class="row m-0">
            <td class="col-md-6 text-center">0.2% de Honorarios Sobre la Base de: 918,517.94</td>
            <td class="col-md-2 text-center">$ 1,837.04</td>
            <td class="col-md-2 text-center">$ 292.93</td>
            <td class="col-md-2 text-center">$ 2,130.97</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">Documentacion y Despacho</td>
            <td class="col-md-2 text-center">$ 200.00</td>
            <td class="col-md-2 text-center">$ 32.00</td>
            <td class="col-md-2 text-center">$ 232.00</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">Tramites y Servicios</td>
            <td class="col-md-2 text-center">$ 450.00</td>
            <td class="col-md-2 text-center">$ 72.00</td>
            <td class="col-md-2 text-center">$ 522.00</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">Manifestacion de Valor</td>
            <td class="col-md-2 text-center">$ 150.00</td>
            <td class="col-md-2 text-center">$ 24.00</td>
            <td class="col-md-2 text-center">$ 174.00</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-center">VUCEM</td>
            <td class="col-md-2 text-center">$ 2,250.00</td>
            <td class="col-md-2 text-center">$ 360.00</td>
            <td class="col-md-2 text-center">$ 2,610.00</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 text-right">Total</td>
            <td class="col-md-2 text-center">$ 5,154.00</td>
            <td class="col-md-2 text-center">$ 781.93</td>
            <td class="col-md-2 text-center">$ 17,587.74</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
