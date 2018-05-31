<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed text-center">
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datcliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datinfo" status="cerrado">INFORMACIÓN CLIENTE</a>
    </div>
  </div>
  <div class="col-md-1 text-center p-5">
    <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
  </div>
  <div id="contornoCliente" class="contorno mt-4" style="display:none">
    <h5 class="titulo font16">DATOS CLIENTES</h5>
    <table class="table text-center" id="eCliente">
      <thead class="font14">
        <tr class="row encabezado">
          <td class="col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-6">DIRECCION</td>
          <td class="col-md-6">PROVEEDOR</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-6">Ave.Industrial Alimentaria 2001</td>
          <td class="col-md-6">EC, DBA KECO</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">Parque Industrial Linares</td>
          <td class="col-md-6">SW 15th Street</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">Linares Nuevo Leon C.P 67735</td>
          <td class="col-md-6">Oklahoma City</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">MES0204122KA</td>
          <td class="col-md-6">Phone: 405-745-2145</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="contornoInfo" class="contorno mt-4" style="display:none">
    <h5 class="titulo font16">INFO GENERAL</h5>
    <table class="table text-center font14" id="eInfo">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">INFORMACION GENERAL NO EDITABLE</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-2">No.solicitud</td>
          <td class="col-md-2">Almacen</td>
          <td class="col-md-1">Aduana</td>
          <td class="col-md-1">Tipo</td>
          <td class="col-md-2">Valor</td>
          <td class="col-md-1">Peso</td>
          <td class="col-md-2">Volumen</td>
          <td class="col-md-1">Dias</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-md-2">280380</td>
          <td class="col-md-2">Sin Nombre</td>
          <td class="col-md-1">240</td>
          <td class="col-md-1">IMP</td>
          <td class="col-md-2">906600.7667</td>
          <td class="col-md-1">4660</td>
          <td class="col-md-2">20000</td>
          <td class="col-md-1">1</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="contorno">
    <div class="container-fluid">
      <table class="table text-center w-50" style="float:left">
        <thead>
          <tr class="row m-0 ">
            <td class="col-md-11 backpink font14">REFERENCE</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Reference : </td>
            <td class="col-md-5 pt-1 p-0 text-left"> N17003012</td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Freight Bill :</td>
            <td class="col-md-5 pt-1 p-0 text-left">316140370</td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Quantity :</td>
            <td class="col-md-5 pt-1 p-0 text-left">22</td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Type :</td>
            <td class="col-md-5 pt-1 p-0 text-left">IN</td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Description :</td>
            <td class="col-md-5 pt-1 p-0 text-left">Materia Prima</td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
        </tbody>
      </table>

      <table class="table text-center w-50" style="float:right">
        <thead>
          <tr class="row m-0">
            <td class="col-md-12 backpink font14">GENERAL</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-3 text-right">Invoince No :</td>
            <td class="col-md-3">544268</td>

            <td class="col-md-3 text-right">Invoince Value :</td>
            <td class="col-md-3">46722.98</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-3 text-right">Proforma :</td>
            <td class="col-md-3">280380</td>

            <td class="col-md-3 text-right">Date :</td>
            <td class="col-md-3">15/11/2017</td>
          </tr>

          <tr class="row m-0">
            <td class="col-md-3 text-right">Weight :</td>
            <td class="col-md-3">4660.00<</td>

            <td class="col-md-3 text-right">Customer Invoice :</td>
            <td class="col-md-3">47352,47353,47354,47355</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="contorno mt-5">
    <h5 class="titulo font16">EDITAR CTA GASTOS</h5>
    <div class="encabezado font18">ACCOUNT CHARGES</div>
      <form class="form1">
        <table class="table text-center font14">
          <tbody>
            <tr class="row m-0 backpink">
              <td class="col-md-1">SERV.</td>
              <td class="col-md-3">CONCEPTO</td>
              <td class="col-md-3">DESCRIPTION</td>
              <td class="col-md-3"></td>
              <td class="col-md-1">AMOUNT</td>
              <td class="col-md-1">SUBTOTAL</td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-1">1</td>
              <td class="col-md-3">Onforwarding Fees</td>
              <td class="col-md-3"></td>
              <td class="col-md-3"></td>
              <td class="col-md-1">$ 236.00</td>
              <td class="col-md-1">$ 236.00</td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-1 offset-md-9"></td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right">Less Advance 1 :</td>
              <td class="col-md-1">0.00</td>
              <td class="col-md-1">0.00</td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right">Less Advance 2 :</td>
              <td class="col-md-1">0.00</td>
              <td class="col-md-1">0.00</td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right">Total :</td>
              <td class="col-md-1 offset-md-1">$ 611.00</td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
</div>


<script src="js/CuentaGastos.js"></script>
