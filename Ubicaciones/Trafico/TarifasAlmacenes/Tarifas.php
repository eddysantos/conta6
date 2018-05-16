<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <table class="text-center table brx4">
    <tr class="row">
      <td class="col-md-6 offset-md-3">
        <select class="input-dpol form-control  border">
          <option>Seleccione un Almacen</option>
          <option>3 --- Aerobias de Mexico S.A de C.V --- 470</option>
          <option>4 --- Agentes Aduanales Asociados para el Comercio Exterior S.A de C.V --- 470</option>
          <option>5 --- Societe Air France --- 470</option>
          <option>6 --- American Air Line de Mexico S.A de C.V  --- 470</option>
          <option>7 --- Braniff Air Freight and Company S.A de C.V --- 470 </option>
        </select>
      </td>
    </tr>
  </table>

  <div class="contorno" style="margin-top:40px!important">
    <h5 class="titulo" style="font-size:15px">REGISTRAR TARIFA</h5>
    <form class="form2">
      <table class="table text-center brx1">
        <tbody>
          <tr class="row">
            <td class="col-md-4 offset-md-4">
              <select class="input-dpol form-control border">
                <option>Seleccione un concepto</option>
                <option>Almacenaje</option>
                <option>Custodia</option>
                <option>Maniobras</option>
                <option>Previo</option>
              </select>
            </td>
          </tr>
          <tr class="row mleftx5">
            <td class="col-md-1 input-effect brx2">
              <input  list="lista-uni" class="text-normal efecto text-center" id="unidad">
              <datalist id="lista-uni">
                <option value="MN"></option>
                <option value="DLLS"></option>
                <option value="KG"></option>
              </datalist>
              <label for="unidad">Unidad</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="lim-inf" class="efecto w-100 text-normal" type="text">
              <label for="lim-inf">Lim.Inferior</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="lim-sup" class="efecto w-100 text-normal" type="text">
              <label for="lim-sup">Lim.Superior</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="imp1" class="efecto w-100 text-normal" type="text">
              <label for="imp1">Importe 1</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="infdia" class="efecto w-100 text-normal" type="text">
              <label for="infdia">Inf.Día</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="supdia" class="efecto w-100 text-normal" type="text">
              <label for="supdia">Sup.Día</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="imp2" class="efecto w-100 text-normal" type="text">
              <label for="imp2">Importe 2</label>
            </td>
            <td class="col-md-1 input-effect brx2" >
              <input  list="lista-ope" class="text-normal efecto text-center" id="operacion">
              <datalist id="lista-ope">
                <option value="IMP"></option>
                <option value="EXP"></option>
              </datalist>
              <label for="operacion">Operación</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="fac1" class="efecto w-100 text-normal" type="text">
              <label for="fac1">Factor 1</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="fac2" class="efecto w-100 text-normal" type="text">
              <label for="fac2">Factor 2</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="fac3" class="efecto w-100 text-normal" type="text">
              <label for="fac3">Factor 3</label>
            </td>
            <td class="col-md-1 brx2 text-left" style="padding:7px!important">
              <a href="" class="btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icomediano"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div class="contorno" style="margin-top:40px!important">
    <h5 class="titulo" style="font-size:15px">VISUALIZAR TARIFA</h5>
    <table class="table brx2">
      <thead>
        <tr class="row">
          <td class="col-md-1">
            <a href=""><img class="icomediano mleftx2" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
          <td class="col-md-2 offset-md-8">
            <select class="input-dpol form-control mleftx10">
              <option>Filtro por Concepto</option>
              <option>Almacenaje</option>
              <option>Custodía</option>
              <option>Maniobras</option>
            </select>
          </td>
        </tr>
        <tr class="row text-center tRepoNom brx2">
          <td class="col-md-12">470 3 AEROVIAS DE MÉXICO S.A DE C.V</td>
        </tr>
        <tr class="row text-center">
          <td class="col-md-1 iap">UNIDAD</td>
          <td class="col-md-1 iap">LIM.INF</td>
          <td class="col-md-1 iap">LIM.SUP</td>
          <td class="col-md-1 iap">IMPORTE 1</td>
          <td class="col-md-1 iap">INF.DÍA</td>
          <td class="col-md-1 iap">SUP.DÍA</td>
          <td class="col-md-1 iap">IMPORTE 2</td>
          <td class="col-md-1 iap">OPE.</td>
          <td class="col-md-1 iap">FACTOR 1</td>
          <td class="col-md-1 iap">FACTOR 2</td>
          <td class="col-md-1 iap">FACTOR 3</td>
          <td class="col-md-1 iap"></td>
        </tr>
      </thead>
      <tbody class="text-normal">
        <tr class="row text-center borderojo">
          <td class="col-md-1">MN</td>
          <td class="col-md-1">0.01</td>
          <td class="col-md-1">2500</td>
          <td class="col-md-1">260</td>
          <td class="col-md-1">1</td>
          <td class="col-md-1">10</td>
          <td class="col-md-1"></td>
          <td class="col-md-1">IMP</td>
          <td class="col-md-1">0.669</td>
          <td class="col-md-1"></td>
          <td class="col-md-1">300</td>
          <td class="col-md-1">
            <a href=""><img class="icochico" src="/conta6/Resources/iconos/cross.svg"></a>
            <a href="#EditarRegTarifa" data-toggle="modal"><img class="icochico mleftx2" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>

    </table>
  </div>
</div>

<?php require_once('modales/editarTarifa.php'); ?>
