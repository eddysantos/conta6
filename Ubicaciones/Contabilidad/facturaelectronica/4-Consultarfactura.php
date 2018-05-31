<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid" id="buscarfactura">
  <div class="col-md-1 offset-md-11 p-0 mt-5">
    <a class="atras" href="#ConsultarFactura" data-toggle="modal">
      <i class="back fa fa-arrow-left">Regresar</i>
    </a>
  </div>

  <div class="contorno" id="m-factura">
    <form>
      <table class="table text-center">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-12 font18">FACTURAS</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row backpink">
            <td class="col-md-1"></td>
            <td class="col-md-1">FECHA</td>
            <td class="col-md-1">FACTURA</td>
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">CANCELADA</td>
            <td class="col-md-1">CTA.GASTOS</td>
            <td class="col-md-1">REFERENCIA</td>
            <td class="col-md-4">CLIENTE</td>
            <td class="col-md-1"></td>
          </tr>
          <tr class="row borderojo font14">
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a>
              <a><img class="icomediano ml-4" src="/conta6/Resources/iconos/pdf.svg"></a>
            </td>
            <td class="col-md-1">17-07-2017</td>
            <td class="col-md-1">77166</td>
            <td class="col-md-1">252815</td>
            <td class="col-md-1">252815</td>
            <td class="col-md-1">77919</td>
            <td class="col-md-1">N17003012</td>
            <td class="col-md-4">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
            <td class="col-md-1">
              <a class="ver" accion="cuadroConsultar"><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
              <a><img class="icomediano ml-5" src="/conta6/Resources/iconos/printer.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div><!--/Termina Container FLuid-->


<div id="ConsulFactura" style="display:none">
  <div class="container-fluid">
    <div class="row submenuMed text-center m-0">
      <div class="col-md-4" role="button">
        <a  id="submenuMed" class="visualizar" accion="Ver-cliente" status="cerrado">DATOS CLIENTE</a>
      </div>
      <div class="col-md-4">
        <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
      </div>
      <div class="col-md-4">
        <a id="submenuMed" class="visualizar" accion="Ver-iUsuario" status="cerrado">USUARIO</a>
      </div>
    </div>
  </div>

  <div class="col-md-2 p-4">
    <a href="4-Consultarfactura.php">
      <img class="icomediano ml-4" src="/conta6/Resources/iconos/left.svg">
    </a>
    <a href="" class="ml-4">
      <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
    </a>
  </div>

<div class="container-fluid">
  <div id="detalleCliente" class="contorno" style="display:none">
    <table class="table form1 text-center">
      <thead>
        <tr class="row encabezado font16">
          <td class="col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row backpink font16">
          <td class="col-md-6">Direccion</td>
          <td class="col-md-6">Proveedor</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-6">Ave.Industrial Alimentaria 2001</td>
          <td class="col-md-6">EC, DBA KECO</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6">Parque Industrial Linares</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6">Linares Nuevo Leon C.P 67735</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6">MES0204122KA</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="detalleEmbarque" class="contorno" style="display:none">
    <table class="table form1 text-center">
      <thead>
        <tr class="row encabezado font16">
          <td class="col-md-12">INFORMACION GENERAL</td>
        </tr>
        <tr class="row backpink font16">
          <td class="col-md-4">Aduana</td>
          <td class="col-md-4">Solicitud</td>
          <td class="col-md-4">Fecha</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row borderojo">
          <td class="col-md-4">240</td>
          <td class="col-md-4">280380</td>
          <td class="col-md-4">02/05/2017</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Nuestra Referencia:</td>
          <td class="col-md-6 text-left">N17003012</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Descripcion General:</td>
          <td class="col-md-6 text-left">Hidroxido de Aluminio</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Peso en Kg:</td>
          <td class="col-md-6 text-left">4660</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Tipo de Operacion:</td>
          <td class="col-md-6 text-left">IN</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Talones, Guia o B/Ls:</td>
          <td class="col-md-6 text-left">316140370</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Facturas:</td>
          <td class="col-md-6 text-left">47352,47353,47354,47355,47...</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Fecha Arribo o Salida:</td>
          <td class="col-md-6 text-left">01/05/2017</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Procedencia o Destino:</td>
          <td class="col-md-6 text-left"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">No.Pedimento:</td>
          <td class="col-md-6 text-left">7003386</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Caja:</td>
          <td class="col-md-6 text-left"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Valor en M.N:</td>
          <td class="col-md-6 text-left">906,601/00</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="detalleUsuario" class="contorno" style="display:none">
    <table  class="table form1 text-center">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-6">GENERADO POR:</td>
          <td class="col-md-6">MODIFICADO POR:</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-6">Vgonzalez</td>
          <td class="col-md-6">Vgonzalez</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">02/05/2017 09:06:00</td>
          <td class="col-md-6">02/05/2017 09:06:00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!--Esta informacion si estara visible SOLICITUD DE ANTICIPO-->
<div class="contorno mt-5">
  <h5 class="titulo font14">SOLICITUD ANTICIPO</h5>
    <div class="container-fluid">
      <table class="table form1 mt-4 text-center">
        <thead>
          <tr class="row encabezado font14">
            <td class="col-md-6">PAGOS O CARGOS EN USD</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">AL T.C</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-6">1 Reexpedicion</td>
            <td class="col-md-2">$ 236.00</td>
            <td class="col-md-2">$ 19.07</td>
            <td class="col-md-2">$ 4,500.52</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">1 Cruce</td>
            <td class="col-md-2">$ 125.00</td>
            <td class="col-md-2">$ 19.07</td>
            <td class="col-md-2">$ 2,383.75</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">2 Servicio Extraordinario</td>
            <td class="col-md-2">$ 240.00</td>
            <td class="col-md-2">$ 19.07</td>
            <td class="col-md-2">$ 4,576.80</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">1 Declaracion de Exportacion de USA a MEX (Shipper)</td>
            <td class="col-md-2">$ 10.00</td>
            <td class="col-md-2">$ 19.07</td>
            <td class="col-md-2">$ 190.07</td>
          </tr>
        </tbody>
      </table>

      <table class="table form1 text-center mt-5">
        <thead>
          <tr class="row encabezado font14">
            <td class="col-md-6">PAGOS POR CUENTA CLIENTE</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">IVA</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-6">Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.</td>
            <td class="col-md-2">$ 267.00</td>
            <td class="col-md-2">$ 0.00</td>
            <td class="col-md-2">$ 267.00</td>
          </tr>
        </tbody>
      </table>

      <table class="table form1 text-center mt-5">
        <thead>
          <tr class="row encabezado font14">
            <td class="col-md-6">HONORARIOS Y SERVICIOS</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">IVA</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-6">0.2% de Honorarios Sobre la Base de: 918,517.94</td>
            <td class="col-md-2">$ 1,837.04</td>
            <td class="col-md-2">$ 292.93</td>
            <td class="col-md-2">$ 2,130.97</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">Documentacion y Despacho</td>
            <td class="col-md-2">$ 200.00</td>
            <td class="col-md-2">$ 32.00</td>
            <td class="col-md-2">$ 232.00</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">Tramites y Servicios</td>
            <td class="col-md-2">$ 450.00</td>
            <td class="col-md-2">$ 72.00</td>
            <td class="col-md-2">$ 522.00</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">Manifestacion de Valor</td>
            <td class="col-md-2">$ 150.00</td>
            <td class="col-md-2">$ 24.00</td>
            <td class="col-md-2">$ 174.00</td>
          </tr>
          <tr class="row">
            <td class="col-md-6">VUCEM</td>
            <td class="col-md-2">$ 2,250.00</td>
            <td class="col-md-2">$ 360.00</td>
            <td class="col-md-2">$ 2,610.00</td>
          </tr>
          <tr class="row">
            <td class="col-md-6 text-right">Total</td>
            <td class="col-md-2">$ 5,154.00</td>
            <td class="col-md-2">$ 781.93</td>
            <td class="col-md-2">$ 17,587.74</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
