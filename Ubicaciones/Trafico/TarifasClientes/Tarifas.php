<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <table class="text-center table mt-5">
    <tr class="row mb-4">
      <td class="col-md-6 offset-md-2">
        <select class="custom-select">
          <option>Seleccione un Cliente</option>
          <option>MOTORES ELECTRICOS SUMERGIBLES DE MÉXICO S DE R.L DE C.V -- CLT_6548</option>
          <option>SISTEMAS DE ENERGIA Y SEGURIDAD INTELIGENTE S.A DE C.V -- CLT_6495</option>
          <option>INTEGRADORA DE SERVICIOS MARITIMOS PORTUARIOS S.A DE C.V</option>
        </select>
      </td><td class="col-md-2">
        <select class="custom-select">
          <option>Oficina</option>
          <option>Aeropuerto</option>
          <option>Manzanillo</option>
          <option>Nuevo Laredo</option>
          <option>Veracruz</option>
        </select>
      </td>
    </tr>
  </table>


  <div class="contorno mt-5">
    <h5 class="titulo font14">REGISTRAR TARIFA</h5>
    <form class="form1 ls0">
      <table class="table text-center">
        <tbody>
          <tr class="row">
            <td class="col-md-4 offset-md-4">
              <select class="custom-select">
                <option>Seleccione un concepto</option>
                <option>Cambios de Regimen o R1 Imputable a la Agencia</option>
                <option>Cruce de Puente o Arrastre</option>
                <option>Documentación y Despacho</option>
                <option>Documentación y Fotostáticas</option>
                <option>Elaboración de Pedimento (R1)</option>
                <option>Honorarios</option>
                <option>Manifestación de Valor</option>
                <option>Otros Gastos (Conectividad)</option>
                <option>Reconocimiento Aduanero</option>
                <option>Tramites y Servicios</option>
                <option>VUCEM</option>
              </select>
            </td>
          </tr>
          <tr class="row ml-5 mt-5">
            <td class="col-md-1 input-effect">
              <input  list="lista-uni" class="efecto" id="unidad">
              <datalist id="lista-uni">
                <option value="MN"></option>
                <option value="DLLS"></option>
                <option value="KG"></option>
              </datalist>
              <label for="unidad">Unidad</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="lim-inf" class="efecto" type="text">
              <label for="lim-inf">Lim.Inferior</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="lim-sup" class="efecto" type="text">
              <label for="lim-sup">Lim.Superior</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="imp1" class="efecto" type="text">
              <label for="imp1">Importe 1</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="infdia" class="efecto" type="text">
              <label for="infdia">Inf.Día</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="supdia" class="efecto" type="text">
              <label for="supdia">Sup.Día</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="imp2" class="efecto" type="text">
              <label for="imp2">Importe 2</label>
            </td>
            <td class="col-md-1 input-effect" >
              <input  list="lista-ope" class="efecto" id="operacion">
              <datalist id="lista-ope">
                <option value="IMP"></option>
                <option value="EXP"></option>
              </datalist>
              <label for="operacion">Operación</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="fac1" class="efecto" type="text">
              <label for="fac1">Factor 1</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="fac2" class="efecto" type="text">
              <label for="fac2">Factor 2</label>
            </td>
            <td class="col-md-1 input-effect">
              <input id="fac3" class="efecto" type="text">
              <label for="fac3">Factor 3</label>
            </td>
            <td class="col-md-1 text-left pt-3">
              <a href=""><img src= "/conta6/Resources/iconos/add.svg" class="icomediano"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div class="contorno mt-5">
    <h5 class="titulo font14">VISUALIZAR TARIFA</h5>
    <table class="table text-center mt-5">
      <thead>
        <tr class="row">
          <td class="col-md-1">
            <a href=""><img class="icomediano ml-4" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
          <td class="col-md-3 offset-md-8">
            <select class="custom-select">
              <option>Seleccione un concepto</option>
              <option>Cambios de Regimen o R1 Imputable a la Agencia</option>
              <option>Cruce de Puente o Arrastre</option>
              <option>Documentación y Despacho</option>
              <option>Documentación y Fotostáticas</option>
              <option>Elaboración de Pedimento (R1)</option>
              <option>Honorarios</option>
              <option>Manifestación de Valor</option>
              <option>Otros Gastos (Conectividad)</option>
              <option>Reconocimiento Aduanero</option>
              <option>Tramites y Servicios</option>
              <option>VUCEM</option>
            </select>
          </td>
        </tr>
        <tr class="row encabezado font16 mt-5">
          <td class="col-md-12">470 3 AEROVIAS DE MÉXICO S.A DE C.V</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row text-left">
          <td class="col-md-2">Concepto: </td>
          <td class="col-md-8">Cambios de Regimen o R1 Imputable a la Agencia</td>
        </tr>
        <tr class="row text-left">
          <td class="col-md-2">Realiza un cálculo: </td>
          <td class="col-md-8">Un solo Registro y un solo Importe</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-1">UNIDAD</td>
          <td class="col-md-1">LIM.INF</td>
          <td class="col-md-1">LIM.SUP</td>
          <td class="col-md-1">IMPORTE 1</td>
          <td class="col-md-1">INF.DÍA</td>
          <td class="col-md-1">SUP.DÍA</td>
          <td class="col-md-1">IMPORTE 2</td>
          <td class="col-md-1">OPE.</td>
          <td class="col-md-1">FACTOR 1</td>
          <td class="col-md-1">FACTOR 2</td>
          <td class="col-md-1">FACTOR 3</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
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
            <a><img class="icochico" src="/conta6/Resources/iconos/cross.svg"></a>
            <a href="#EditarRegTarifaCliente" data-toggle="modal"><img class="icochico ml-5" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
        <tr class="row text-left">
          <td class="col-md-2">Concepto:</td>
          <td class="col-md-8">Documentación y Despacho</td>
        </tr>
        <tr class="row text-left">
          <td class="col-md-2">Realiza un cálculo: </td>
          <td class="col-md-8">Un solo Registro y un solo Importe</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-1">UNIDAD</td>
          <td class="col-md-1">LIM.INF</td>
          <td class="col-md-1">LIM.SUP</td>
          <td class="col-md-1">IMPORTE 1</td>
          <td class="col-md-1">INF.DÍA</td>
          <td class="col-md-1">SUP.DÍA</td>
          <td class="col-md-1">IMPORTE 2</td>
          <td class="col-md-1">OPE.</td>
          <td class="col-md-1">FACTOR 1</td>
          <td class="col-md-1">FACTOR 2</td>
          <td class="col-md-1">FACTOR 3</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
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
            <a href="#EditarRegTarifaCliente" data-toggle="modal"><img class="icochico ml-5" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php require_once('modales/editarTarifaCliente.php'); ?>
