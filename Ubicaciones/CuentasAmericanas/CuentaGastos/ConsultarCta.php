<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <div class="col-md-12 text-center" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datcliente" status="cerrado">DATOS CLIENTE</a>
    </div>
  </div>
  <div class="col-md-1 text-center" style="padding:15px">
    <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
  </div>
  <div id="contornoCliente" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS CLIENTES</h5>
    <table class="table text-center" id="eCliente">
      <thead>
        <tr class="row">
          <td class="col-md-12 tRepoNom">MOTORES ELECTRICOS SUMERGIBLES DE MEXICO S. DE R.L DE C.V</td>
        </tr>
        <tr class="row">
          <td class="col-md-6 subtext">Direccion</td>
          <td class="col-md-6 subtext">Proveedor</td>
        </tr>
      </thead>
      <tbody class="text-normal">
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
  <div id="contornoInfo" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">INFO GENERAL</h5>
    <table class="table text-center" id="eInfo">
      <thead>
        <tr class="row">
          <td class="col-md-12 tRepoNom">INFORMACION GENERAL NO EDITABLE</td>
        </tr>
        <tr class="row">
          <td class="col-md-2 subtext">No.solicitud</td>
          <td class="col-md-2 subtext">Almacen</td>
          <td class="col-md-1 subtext">Aduana</td>
          <td class="col-md-1 subtext">Tipo</td>
          <td class="col-md-2 subtext">Valor</td>
          <td class="col-md-1 subtext">Peso</td>
          <td class="col-md-2 subtext">Volumen</td>
          <td class="col-md-1 subtext">Dias</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row">
          <td class="col-md-2 text-center">280380</td>
          <td class="col-md-2 text-center">Sin Nombre</td>
          <td class="col-md-1 text-center">240</td>
          <td class="col-md-1 text-center">IMP</td>
          <td class="col-md-2 text-center">906600.7667</td>
          <td class="col-md-1 text-center">4660</td>
          <td class="col-md-2 text-center">20000</td>
          <td class="col-md-1 text-center">1</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="contorno">
    <div class="container-fluid">
      <table class="table text-center w-50" style="float:left">
        <tr class="row m-0">
          <td class="col-md-11 backpink">REFERENCE</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6"><input class="text-right noborder" type="text" value="Reference :" readonly></td>
          <td class="col-md-5"><input class="noborder" type="text" value="N17003012" readonly></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6"><input class="text-right noborder" type="text" value="Freight Bill :" readonly></td>
          <td class="col-md-5"><input class="noborder" type="text" value="316140370" readonly></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6"><input class="text-right noborder" type="text" value="Quantity :" readonly></td>
          <td class="col-md-5"><input class="noborder" type="text" value="22" readonly></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6"><input class="text-right noborder" type="text" value="Type :" readonly></td>
          <td class="col-md-5"><input class="noborder" type="text" value="IN" readonly></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6"><input class="text-right noborder" type="text" value="Description :" readonly></td>
          <td class="col-md-5"><input class="noborder" type="text" value="Materia Prima" readonly></td>
          <td class="col-md-1"></td>
        </tr>
      </table>

      <table class="table text-center  w-50" style="float:right">
        <tr class="row m-0">
          <td class="col-md-12 backpink">GENERAL</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3"><input class="text-right noborder" type="text" value="Invoince No :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="544268" readonly></td>

          <td class="col-md-3"><input class="text-right noborder" type="text" value="Invoince Value :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="46722.98" readonly></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3"><input class="text-right noborder" type="text" value="Proforma :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="280380" readonly></td>

          <td class="col-md-3"><input class="text-right noborder" type="text" value="Date :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="15/11/2017" readonly></td>
        </tr>

        <tr class="row m-0">
          <td class="col-md-3"><input class="text-right noborder" type="text" value="Weight :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="4660.00" readonly></td>

          <td class="col-md-3"><input class="text-right noborder" type="text" value="Customer Invoice :" readonly></td>
          <td class="col-md-3"><input class="noborder" type="text" value="47352,47353,47354,47355" readonly></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="contorno brx4">
    <h5 class="titulo" style="font-size:15px">EDITAR CTA GASTOS</h5>
    <div class="tRepoNom text-center" data-toggle="collapse" href="#collapseOne">
      <a  id="bread">ACCOUNT CHARGES</a>
    </div>
      <form class="form1">
        <table class="table text-center">
          <tbody>
            <tr class="row ml-0 mr-0">
              <td class="col-md-1 text-center iap">SERV.</td>
              <td class="col-md-3 text-center iap">CONCEPTO</td>
              <td class="col-md-3 text-center iap">DESCRIPTION</td>
              <td class="col-md-3 text-center iap"></td>
              <td class="col-md-1 text-center iap">AMOUNT</td>
              <td class="col-md-1 text-center iap">SUBTOTAL</td>
            </tr>
            <tr class="row ml-0 mr-0">
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" value="1">
              </td>
              <td class="col-md-3">
                <input class="inpReg noborder noborder" type="text" value="Onforwarding Fees">
              </td>
              <td class="col-md-3">
                <input class="inpReg noborder noborder" type="text">
              </td>
              <td class="col-md-3"></td>
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" value="$ 236.00">
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" value="$ 236.00">
              </td>
            </tr>

            <tr class="row ml-0 mr-0">
              <td class="col-md-1 offset-md-9"></td>
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" disabled>
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" disabled>
              </td>
            </tr>

            <tr class="row ml-0 mr-0">
              <td class="col-md-2 offset-md-8">
                <input class="text-right noborder" type="text" value="Less Advance 1 :" readonly>
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder" type="text" value="0.00">
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder" type="text" value="0.00">
              </td>
            </tr>

            <tr class="row ml-0 mr-0">
              <td class="col-md-2 offset-md-8">
                <input class="text-right noborder" type="text" value="Less Advance 2 :" readonly>
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder" type="text" value="0.00">
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder" type="text" value="0.00">
              </td>
            </tr>

            <tr class="row ml-0 mr-0">
              <td class="col-md-2 offset-md-9">
                <input class="text-right noborder" type="text" value="Total :" readonly>
              </td>
              <td class="col-md-1">
                <input class="inpReg noborder noborder" type="text" value="$ 611.00" disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
</div>


<script src="js/CuentaGastos.js"></script>