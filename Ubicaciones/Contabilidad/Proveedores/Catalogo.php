<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a href="#NuevoProveedor"  data-toggle="modal" class="nav-link" id="submenuMed">AGREGAR NUEVO</a>
      </li>
    </ul>
  </div>

  <form class="brx4">
    <table class="table">
      <tr class="row">
        <td class="col-md-6 offset-md-3">
          <select class="custom-selector"id="opcion">
            <option >Selecciona</option>
            <option value="1">7-ELEVEN MEXICO SA DE CV -- SEM980701STA -- 261</option>
            <option value="2">ABASTECEDORA Y DISTRIBUIDORA GARA SA DE CV -- ADG0802135RA</option>
            <option value="3">AEROVIAS DE MEXICO SA DE CV -- AME880912189 -- 145</option>
            <option value="4">AGENCIA ADUANAL OLTRA JIMENEZ SA DE CV -- AAO970806K45</option>
          </select>
        </td>
        <td class="col-md-1 text-left">
            <a href="" class="btn-block"><img src= "/conta6/Resources/iconos/printer.svg" class="icomediano"></a>
        </td>
      </tr>
    </table>
  </form>


  <div class="contorno">
    <h5 class="titulo" style="font-size:15px">DATOS GENERALES</h5>
    <table class="table text-center">
      <thead>
        <tr class="row encabezado font14">
          <td class="col-md-12">ABASTECEDORA DE SUPERTIENDAS DE OFICINAS SA DE CV --- 0206-00152</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row mt-4">
          <td class="col-md-4 input-effect">
            <input  list="persona" class="text-normal efecto"  id="per">
            <datalist id="persona">
              <option>Fisica</option>
              <option>Moral</option>
            </datalist>
            <label for="per">PERSONA</label>
          </td>
          <td class="col-md-4 input-effect">
            <input id="rfc" class="efecto text-normal" type="text">
            <label for="rfc">RCF</label>
          </td>
          <td class="col-md-4 input-effect">
            <input id="curp" class="efecto text-normal" type="text">
            <label for="curp">CURP</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-11 input-effect">
            <input id="domfiscal" class="efecto text-normal ml-5" type="text">
            <label for="domfiscal">DOMICILIO FISCAL</label>
          </td>
          <td class="col-md-1 mt-2">
            <a href="" class="btn-block"><img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="contorno brx4">
    <h5 class="titulo2" style="font-size:15px;width:210px" >CUENTAS BANCARIAS</h5>
    <table class="table text-center">
      <tbody class="cuerpo">
        <tr class="row">
          <td class="col-md-4 input-effect mt-4">
            <input  list="cbancarias" class="text-normal efecto text-center"  id="cuentasban">
            <datalist id="cbancarias">
              <option>AFIRME</option>
              <option>AMERICAN EXPRESS</option>
              <option>AAZTECA</option>
              <option>BAJIO</option>
              <option>BANAMEX</option>
              <option>BANCOPPEL</option>
              <option>BANORTE</option>
              <option>BANREGIO</option>
              <option>BANSI</option>
              <option>BBVA BANCOMER</option>
              <option>CB INTERCAM</option>
              <option>CIBANCO</option>
              <option>HSBC</option>
              <option>INBURSA</option>
              <option>IXE</option>
              <option>JP MORGAN</option>
              <option>MIFEL</option>
              <option>MONEXCB</option>
              <option>N/A</option>
              <option>SANTANDER</option>
              <option>SCOTIABANK</option>
              <option>TOKIO</option>
            </datalist>
            <label for="cuentasban">CUENTAS BANCARIAS</label>
          </td>
          <td class="col-md-6 input-effect mt-4">
            <input id="cinter" class="efecto text-center text-normal" type="text">
            <label for="cinter">CUENTA / INTERBANCARIA</label>
          </td>
          <td class="col-md-2 input-effect mt-4">
            <a href="" role="button" class="ver boton" accion="mostrarcta"> <img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR</a>
          </td>
        </tr>
      </tbody>
    </table>
    <div id="MostrarCuenta">
      <table class="table text-center text-normal">
        <tr  class="row backpink mt-4">
          <td class="col-md-1"></td>
          <td class="col-md-2">BANCO</td>
          <td class="col-md-3">CUENTA</td>
          <td class="col-md-3">AGREGÓ</td>
          <td class="col-md-3">MODIFICÓ</td>
        </tr>
        <tr  class="row borderojo">
          <td class="col-md-1">
            <a href="" class="btn-block"><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
          <td class="col-md-2">BBVA BANCOMER</td>
          <td class="col-md-3">0193637166</td>
          <td class="col-md-3">DGAMBOA 10-11-2016 12:52:43</td>
          <td class="col-md-3"></td>
        </tr>
      </table>
    </div>
  </div>
</div>


<script src="js/Proveedores.js"></script>
<?php require_once('modales/Catalogo.php');?>
