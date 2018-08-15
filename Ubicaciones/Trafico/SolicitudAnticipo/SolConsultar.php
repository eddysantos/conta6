<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class='text-center'>
  <div class='row submenuMed m-0'>
    <div class='col-md-4' role='button'>
      <a  id='submenuMed' class='trafico' accion='cliente' status='cerrado'>DATOS CLIENTE</a>
    </div>
    <div class='col-md-4'>
      <a id='submenuMed' class='trafico' accion='iEmbarque' status='cerrado'>INFO. DEL EMBARQUE</a>
    </div>
    <div class='col-md-4'>
      <a id='submenuMed' class='trafico' accion='iUsuario' status='cerrado'>USUARIO</a>
    </div>
  </div>

  <div class='col-md-1 ml-3 mt-4'>
    <a href='SolAnticipo.php'>
      <img class='icomediano' src='/conta6/Resources/iconos/left.svg'>
    </a>
    <a href='SolConsultar.php' class='ml-5'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a>
  </div>

  <div id='contornodCliente' class='contorno' style='display:none'>
    <h5 class='titulo'>DATOS CLIENTES</h5>
    <table class='table' id='dCliente'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12'>MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class='row backpink font14'>
          <td class='col-md-6 p-0 pt-2'>Direccion</td>
          <td class='col-md-6 p-0 pt-2'>Proveedor</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class='row'>
          <td class='col-md-6 p-0 pt-2'>Ave.Industrial Alimentaria 2001</td>
          <td class='col-md-6 p-0 pt-2'>EC, DBA KECO</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-2'>Parque Industrial Linares</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-2'>Linares Nuevo Leon C.P 67735</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-2'>MES0204122KA</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id='contornodEmbarque' class='contorno' style='display:none'>
    <h5 class='titulo font14'>DATOS EMBARQUE</h5>
    <table class='table mt-4' id='dEmbarque'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-4'>ADUANA</td>
          <td class='col-md-4'>SOLICITUD</td>
          <td class='col-md-4'>FECHA</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row  borderojo'>
          <td class='col-md-4'>240</td>
          <td class='col-md-4'>280380</td>
          <td class='col-md-4'>02/05/2017</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Nuestra Referencia:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;N17003012</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Descripcion General:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;Hidroxido de Aluminio</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Peso en Kg:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;4660</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Tipo de Operacion:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;IN</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Talones, Guia o B/Ls:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;316140370</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Facturas:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;47352,47353,47354,47355,47...</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Fecha Arribo o Salida:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;01/05/2017</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Procedencia o Destino:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>No.Pedimento:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;7003386</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Caja:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6 p-0 pt-3 text-right'>Valor en M.N:&nbsp;</td>
          <td class='col-md-6 p-0 pt-3 text-left'>&nbsp;906,601/00</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id='contornodUsuario' class='contorno' style='display:none'>
    <h5 class='titulo font14'>DATOS USUARIO</h5>
    <table  class='table mt-3' id='dUsuario'>
      <thead>
        <tr class='row encabezado font14'>
          <td class='col-md-6'>GENERADO POR:</td>
          <td class='col-md-6'>MODIFICADO POR:</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row'>
          <td class='col-md-6'>Vgonzalez</td>
          <td class='col-md-6'>Vgonzalez</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>02/05/2017 09:06:00</td>
          <td class='col-md-6'>02/05/2017 09:06:00</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!--Esta informacion si estara visible SOLICITUD DE ANTICIPO-->
  <div class='contorno'>
    <h5 class='titulo font14'>SOLICITUD ANTICIPO</h5>
    <table class='table font14 mt-4'>
      <thead>
        <tr class='row encabezado'>
          <td class='col-md-6'>PAGOS O CARGOS EN USD</td>
          <td class='col-md-2'>IMPORTE</td>
          <td class='col-md-2'>AL T.C</td>
          <td class='col-md-2'>SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class='font16'>
        <tr class='row'>
          <td class='col-md-6'>1 Reexpedicion</td>
          <td class='col-md-2'>$ 236.00</td>
          <td class='col-md-2'>$ 19.07</td>
          <td class='col-md-2'>$ 4,500.52</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>1 Cruce</td>
          <td class='col-md-2'>$ 125.00</td>
          <td class='col-md-2'>$ 19.07</td>
          <td class='col-md-2'>$ 2,383.75</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>2 Servicio Extraordinario</td>
          <td class='col-md-2'>$ 240.00</td>
          <td class='col-md-2'>$ 19.07</td>
          <td class='col-md-2'>$ 4,576.80</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>1 Declaracion de Exportacion de USA a MEX (Shipper)</td>
          <td class='col-md-2'>$ 10.00</td>
          <td class='col-md-2'>$ 19.07</td>
          <td class='col-md-2'>$ 190.07</td>
        </tr>
      </tbody>
    </table>

    <table class='table mt-5'>
      <thead>
        <tr class='row encabezado font14'>
          <td class='col-md-6'>PAGOS POR CUENTA CLIENTE</td>
          <td class='col-md-2'>IMPORTE</td>
          <td class='col-md-2'>IVA</td>
          <td class='col-md-2'>SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class='font16'>
        <tr class='row'>
          <td class='col-md-6'>Impuestos y/o Derechos Pagados o Garantizados al Com.Ext.</td>
          <td class='col-md-2'>$ 267.00</td>
          <td class='col-md-2'>$ 0.00</td>
          <td class='col-md-2'>$ 267.00</td>
        </tr>
      </tbody>
    </table>

    <table class='table mt-5'>
      <thead>
        <tr class='row encabezado font14'>
          <td class='col-md-6'>HONORARIOS Y SERVICIOS</td>
          <td class='col-md-2'>IMPORTE</td>
          <td class='col-md-2'>IVA</td>
          <td class='col-md-2'>SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class='font16'>
        <tr class='row'>
          <td class='col-md-6'>0.2% de Honorarios Sobre la Base de: 918,517.94</td>
          <td class='col-md-2'>$ 1,837.04</td>
          <td class='col-md-2'>$ 292.93</td>
          <td class='col-md-2'>$ 2,130.97</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>Documentacion y Despacho</td>
          <td class='col-md-2'>$ 200.00</td>
          <td class='col-md-2'>$ 32.00</td>
          <td class='col-md-2'>$ 232.00</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>Tramites y Servicios</td>
          <td class='col-md-2'>$ 450.00</td>
          <td class='col-md-2'>$ 72.00</td>
          <td class='col-md-2'>$ 522.00</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>Manifestacion de Valor</td>
          <td class='col-md-2'>$ 150.00</td>
          <td class='col-md-2'>$ 24.00</td>
          <td class='col-md-2'>$ 174.00</td>
        </tr>
        <tr class='row'>
          <td class='col-md-6'>VUCEM</td>
          <td class='col-md-2'>$ 2,250.00</td>
          <td class='col-md-2'>$ 360.00</td>
          <td class='col-md-2'>$ 2,610.00</td>
        </tr>
      </tbody>
      <tfoot class="font16">
        <tr class='row'>
          <td class='col-md-6 text-right'>Total</td>
          <td class='col-md-2'>$ 5,154.00</td>
          <td class='col-md-2'>$ 781.93</td>
          <td class='col-md-2'>$ 17,587.74</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
