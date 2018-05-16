<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-4 text-center" role="button">
      <a  id="submenuMed" class="trafico" accion="cliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="trafico" accion="iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="trafico" accion="iUsuario" status="cerrado">USUARIO</a>
    </div>
  </div>

  <div class="col-md-1 text-center" style="padding:15px">
    <a href="SolAnticipo.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
    <a href="SolConsultar.php" style="margin-left:30px"><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
  </div>

  <div id="contornodCliente"   class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS CLIENTES</h5>
    <table class="table text-cennter" id="dCliente">
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-12 text-center">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 subtext">Direccion</td>
          <td class="col-md-6 subtext">Proveedor</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row">
          <td class="col-md-6">Ave.Industrial Alimentaria 2001</td>
          <td class="col-md-6">EC, DBA KECO</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">Parque Industrial Linares</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">Linares Nuevo Leon C.P 67735</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">MES0204122KA</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="contornodEmbarque" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS EMBARQUE</h5>
    <table class="table text-center brx2" id="dEmbarque">
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-4">ADUANA</td>
          <td class="col-md-4">SOLICITUD</td>
          <td class="col-md-4">FECHA</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row  borderojo">
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
  <div id="contornodUsuario" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS USUARIO</h5>
    <table  class="table text-center brx1" id="dUsuario">
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-6">GENERADO POR:</td>
          <td class="col-md-6">MODIFICADO POR:</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
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

  <!--Esta informacion si estara visible SOLICITUD DE ANTICIPO-->
  <div class="contorno brx4">
    <h5 class="titulo" style="font-size:15px">SOLICITUD ANTICIPO</h5>
    <div class="container-fluid">
      <table class="table text-center brx2">
        <thead>
          <tr class="row tRepoNom">
            <td class="col-md-6">PAGOS O CARGOS EN USD</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">AL T.C</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody style="font-size:16px">
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

      <table class="table text-center brx2">
        <thead>
          <tr class="row tRepoNom">
            <td class="col-md-6">PAGOS POR CUENTA CLIENTE</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">IVA</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody style="font-size:16px">
          <tr class="row">
            <td class="col-md-6">Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.</td>
            <td class="col-md-2">$ 267.00</td>
            <td class="col-md-2">$ 0.00</td>
            <td class="col-md-2">$ 267.00</td>
          </tr>
        </tbody>
      </table>

      <table class="table text-center brx2">
        <thead>
          <tr class="row tRepoNom ">
            <td class="col-md-6">HONORARIOS Y SERVICIOS</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">IVA</td>
            <td class="col-md-2">SUBTOTAL</td>
          </tr>
        </thead>
        <tbody style="font-size:16px">
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
