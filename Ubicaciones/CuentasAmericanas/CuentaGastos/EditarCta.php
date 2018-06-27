<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid text-center">
  <div class="row submenuMed">
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datcliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datinfo" status="cerrado">INFORMACIÓN CLIENTE</a>
    </div>
  </div>

  <div class="col-md-1" style="padding:15px">
    <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
  </div>

  <div id="contornoCliente" class="contorno" style="display:none">
    <h5 class="titulo font16">DATOS CLIENTES</h5>
    <table class="table">
      <thead class="font14">
        <tr class="row encabezado">
          <td class="col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-6">DIRECCIÓN</td>
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

  <div id="contornoInfo" class="contorno font14" style="display:none">
    <h5 class="titulo">INFO GENERAL</h5>
    <table class="table">
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
      <table class="table  w-50" style="float:left;color:black">
        <tr class="row">
          <td class="col-md-11 backpink">REFERENCE</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Reference :</td>
          <td class="col-md-5 text-left">N17003012</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Freight Bill :</td>
          <td class="col-md-5 text-left"><input class="efecto h22 w-50" type="text" value="316140370"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Quantity :</td>
          <td class="col-md-5 text-left"><input class="efecto h22 w-50" type="text" value="22"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Type :</td>
          <td class="col-md-5 text-left">IN</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-6 text-right">Description :</td>
          <td class="col-md-5 text-left">Materia Prima</td>
          <td class="col-md-1"></td>
        </tr>
      </table>

      <table class="table  w-50" style="float:right;color:black">
        <tr class="row m-0">
          <td class="col-md-12 backpink">GENERAL</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3 text-right">Invoince No :</td>
          <td class="col-md-3">544268</td>
          <td class="col-md-3 text-right">Invoince Value :</td>
          <td class="col-md-3"><input class="efecto h22" type="text" value="46722.98"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3 text-right">Proforma :</td>
          <td class="col-md-3">280380</td>
          <td class="col-md-3 text-right">Date :</td>
          <td class="col-md-3"><input class="efecto h22" type="text" value="01/04/2018"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3 text-right">Weight :</td>
          <td class="col-md-3">4660.00</td>
          <td class="col-md-3 text-right">Customer Invoice :</td>
          <td class="col-md-3"><input class="efecto h22" type="text" value="47352,47353,47354,47355"></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="contorno">
    <h5 class="titulo font16">EDITAR CTA GASTOS</h5>
    <div class="encabezado font18">ACCOUNT CHARGES</div>
      <form class="form1">
        <table class="table">
          <tbody>
            <tr class="row m-0 mt-3">
              <td class="col-md-6">
                <select class="custom-select">
                  <option selected>Customer Tariff</option>
                  <option>Additional Entries</option>
                  <option>Blue Letter o In-Bond</option>
                  <option>Cartage</option>
                  <option>Drayage</option>
                  <option>Extraordinary Service</option>
                  <option>Freight</option>
                  <option>Import / Export Documentation Fee (American Custom)</option>
                  <option>Mexican Custom Broker Fees</option>
                  <option>Pallets</option>
                  <option>Pedimento Rectification</option>
                  <option>Shippper Export</option>
                  <option>Special Maneuvers</option>
                  <option>Third Party Billing</option>
                </select>
              </td>
              <td class="col-md-6">
                <select class="custom-select">
                  <option selected>General Tariff</option>
                  <option>Additional Entries</option>
                  <option>Blue Letter o In-Bond</option>
                  <option>Bonded Warehouse</option>
                  <option>Cartage</option>
                  <option>Conectivity</option>
                  <option>Cross - Dock</option>
                  <option>Demurage</option>
                  <option>Documentation</option>
                  <option>Drayage</option>
                  <option>Electronic Process (Paper Less)</option>
                  <option>Extraordinary Service</option>
                  <option>Freight</option>
                  <option>Import / Export Documentation Fee (American Custom)</option>
                  <option>Inspection for Classification</option>
                  <option>Intensive</option>
                  <option>Inventory and Clasification</option>
                  <option>Invoice Corrections</option>
                  <option>Labeling</option>
                  <option>Loading and Unloading</option>
                  <option>Maneuver for Previous</option>
                  <option>Mexican Custom Broker Fees</option>
                  <option>Onforwarding Fees</option>
                  <option>Other</option>
                  <option>Pallets</option>
                  <option>Pedimento Rectification</option>
                  <option>Regime Correction</option>
                  <option>Shipper Export</option>
                  <option>Special Maneuvers</option>
                  <option>Special U.S Permits</option>
                  <option>Storage</option>
                  <option>Tax or Duties</option>
                  <option>Unloading to Floor</option>
                  <option>USA Certification</option>
                  <option>Warehousing</option>
                </select>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-1"></td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-6">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-2">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-2 text-left">
                <a href="">
                  <img src="/conta6/Resources/iconos/002-plus.svg" class="icomediano">
                </a>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="table">
          <tbody>
            <tr class="row m-0 mt-5 backpink">
              <td class="col-md-1">SERV.</td>
              <td class="col-md-3">CONCEPTO</td>
              <td class="col-md-3">DESCRIPTION</td>
              <td class="col-md-1"></td>
              <td class="col-md-1">SPEND</td>
              <td class="col-md-1">GAIN</td>
              <td class="col-md-1">AMOUNT</td>
              <td class="col-md-1">SUBTOTAL</td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-3">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-3">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1"></td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-3">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-3">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1"></td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1">
                <input class="efecto" type="text">
              </td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-1 offset-md-7"></td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right pt-3">Less Advance 1 :</td>
              <td class="col-md-1 pt-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1 pt-1">
                <input class="efecto" type="text">
              </td>
            </tr>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right pt-3">Less Advance 2 :</td>
              <td class="col-md-1 pt-1">
                <input class="efecto" type="text">
              </td>
              <td class="col-md-1 pt-1">
                <input class="efecto" type="text">
              </td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right pt-3">Total :</td>
              <td class="col-md-1 pt-1">
                <input class="boton h30" type="button" value="Calculate">
              </td>
              <td class="col-md-1 pt-1">
                <input class="efecto border-0" type="text" disabled>
              </td>
            </tr>
            <tr class="row mt-5 justify-content-center">
              <td class="col-md-2">
                <a href="" class="boton"><img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR</a>
              </td>
              <td class="col-md-2">
                <a href="" class="boton"> <img src= "/conta6/Resources/iconos/cross.svg" class="icochico"> CALCELAR</a><!--nueva pagina, ingresar datos en poliza-->
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
</div>

<script src="js/CuentaGastos.js"></script>
