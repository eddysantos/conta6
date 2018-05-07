<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

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

<div class="container-fluid">
  <div class="contorno brx2">
    <h5 class="titulo">DATOS GENERALES</h5>
    <form class="form1">
      <table class="table text-center brx1">
        <tbody class="cuerpo">
          <tr class="row">
            <td class="col-md-1 input-effect brx2">
              <input id="aduana" class="efecto text-normal w-100" type="text">
              <label for="aduana">Aduana</label>
            </td>
            <td class="col-md-1 input-effect brx2">
              <input id="almacen" class="efecto text-normal w-100" type="text">
              <label for="almacen">Almacen</label>
            </td>
            <td class="col-md-5 input-effect brx2">
              <input id="concepto" class="efecto text-normal w-100" type="text">
              <label for="concepto">Concepto</label>
            </td>
            <td class="col-md-5 input-effect brx2">
              <input id="observaciones" class="efecto text-normal w-100" type="text">
              <label for="observaciones">Observaciones</label>
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-6 input-effect brx2">
              <input  list="calculo-tarif" class="text-normal efecto text-center" id="tipo">
              <datalist id="calculo-tarif">
                <option value="1 -- Custodia (Aeropuerto)"></option>
                <option value="2 -- Manejo (Aeropuerto)"></option>
                <option value="3 -- Almacenje (Aeropuerto)"></option>
                <option value="4 -- Un solo Registro y un solo Importe"></option>
                <option value="5 -- Un solo Registro sin Importe"></option>
                <option value="6 -- Un solo Registro con Importe x Fracción"></option>
                <option value="7 -- Varios Registros con 1 Limite Inferior y 1 Superior"></option>
                <option value="8 -- Un solo Registro y un solo Importe, x día (5 días libres)"></option>
                <option value="9 -- Un solo Registro con Importe y un cargo mínimo"></option>
                <option value="10 -- Un solo Registro con Importe por cada KG (5 días libres)"></option>
                <option value="11 -- Un solo Registro con Importe Fijo y Cuota por Tonelada o Fracción"></option>
                <option value="12 -- Un solo Registro con Importe Fijo por Tonelada o Fracción con un cargo mínimo"></option>
              </datalist>
              <label for="tipo">Tipo</label>
            </td>
            <td class="col-md-6 input-effect brx2" >
              <input  list="lista-cargo" class="text-normal efecto text-center" id="cargo">
              <datalist id="lista-cargo">
                <option value="0110-00001 -- Impuestos"></option>
                <option value="0110-00002 -- Fletes Terrestres"></option>
                <option value="0110-00003 -- Corresponsal"></option>
                <option value="0110-00004 -- Flete Aereo"></option>
                <option value="0110-00005 -- Flete Maritimo"></option>
                <option value="0110-00006 -- Almacenaje"></option>
                <option value="0110-00007 -- Descosolidación"></option>
                <option value="0110-00008 -- Montacargas"></option>
                <option value="0110-00009 -- Maniobras"></option>
                <option value="0110-000010 -- Muellaje"></option>
                <option value="0110-000011 -- Otros Gastos Comprobados"></option>
                <option value="0110-000012 -- Rectificación de Pedimento"></option>
                <option value="0110-000013 -- Previo"></option>
                <option value="0110-000014 -- Reconocimiento Aduanero"></option>
                <option value="0110-000015 -- Lavado de Contenedor"></option>
              </datalist>
              <label for="cargo">Cargar a :</label>
            </td>
          </tr>
          <tr class="row justify-content-center">
            <td class="col-md-3 brx2">
              <a role="button" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR CONCEPTO</a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>

<div class="container-fluid cont brx2">
  <form>
    <table class="table text-center brx1">
      <tbody>
        <tr class="row">
          <td class="col-md-3">
            <select class="input-dpol form-control  border">
              <option>Filtro por Conceptos</option>
              <option>Almacenaje</option>
              <option>Custodia</option>
              <option>Maniobras</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <form>
    <table class="table text-center">
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-12 text-center">240 CLT_6967 MOTORES FRANKLIN S.A DE C.V</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-md-1 iap">ADUANA</td>
          <td class="col-md-1 iap">CONCEPTO</td>
          <td class="col-md-4 iap">OBSERVACIONES</td>
          <td class="col-md-2 iap">REALIZA CALCULO</td>
          <td class="col-md-3 iap">CLASIFICACIÓN DEL INGRESO</td>
          <td class="col-md-1 iap">ACCIONES</td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Almacenaje</td>
          <td class="col-md-4">Almacenaje = KG * Factor * Dias</td>
          <td class="col-md-2">Almacenaje (Aeropuerto)</td>
          <td class="col-md-3">0110-00006 Almacenaje</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php"><img class="file" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href="#EditarTarifa" data-toggle="modal"><img class="file" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>

        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Custodia</td>
          <td class="col-md-4">1050 + 15 pesos por cada $25000 adicionales y a partir de la segunda semana el 15% adicional a esta cuota por semana o fraccion</td>
          <td class="col-md-2">Custodia (Aeropuerto)</td>
          <td class="col-md-3">0110-00011 Otros Gastos Comprobados</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php"><img class="file" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href="#EditarTarifa" data-toggle="modal"><img class="file" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>

        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Maniobras</td>
          <td class="col-md-4">Los Valores con Factor 1 es KG * Factor 1</td>
          <td class="col-md-2">Manejo (Aeropuerto)</td>
          <td class="col-md-3">0110-00009 Maniobras</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php"><img class="file" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href="#EditarTarifa" data-toggle="modal"><img class="file" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>


<?php require_once('modales/editarTarifa.php'); ?>
