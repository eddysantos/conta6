<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <select class="custom-select">
        <option>Seleccione un Almacen</option>
        <option>3 --- Aerobias de Mexico S.A de C.V --- 470</option>
        <option>4 --- Agentes Aduanales Asociados para el Comercio Exterior S.A de C.V --- 470</option>
        <option>5 --- Societe Air France --- 470</option>
        <option>6 --- American Air Line de Mexico S.A de C.V  --- 470</option>
        <option>7 --- Braniff Air Freight and Company S.A de C.V --- 470 </option>
      </select>
    </div>
  </div>

  <div class="contorno mt-5">
    <div class="titulo font14" style='margin-top:-26px'>DATOS GENERALES</div>
    <table class="table">
      <tbody class="font14">
        <tr class="row mt-4">
          <td class="col-md-1 input-effect">
            <input id="aduana" class="efecto" type="text">
            <label for="aduana">Aduana</label>
          </td>
          <td class="col-md-1 input-effect">
            <input id="almacen" class="efecto" type="text">
            <label for="almacen">Almacen</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="concepto" class="efecto" type="text">
            <label for="concepto">Concepto</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="observaciones" class="efecto" type="text">
            <label for="observaciones">Observaciones</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-6 input-effect">
            <input  list="calculo-tarif" class="efecto" id="tipo">
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
          <td class="col-md-6 input-effect">
            <input  list="lista-cargo" class="efecto" id="cargo">
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
        <tr class="row justify-content-center mt-4">
          <td class="col-md-3">
            <a class="boton"><img src="/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR CONCEPTO</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="row mt-5">
    <div class="col-md-3 ml-5">
      <select class="custom-select">
        <option>Filtro por Conceptos</option>
        <option>Almacenaje</option>
        <option>Custodia</option>
        <option>Maniobras</option>
      </select>
    </div>
  </div>

  <form class="contorno">
    <table class="table">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12 font14 p-1">240 CLT_6967 MOTORES FRANKLIN S.A DE C.V</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="p-1 col-md-1">Aduana</td>
          <td class="p-1 col-md-1">Concepto</td>
          <td class="p-1 col-md-4">Observaciones</td>
          <td class="p-1 col-md-2">Realiza calculo</td>
          <td class="p-1 col-md-3">Clasificación del ingreso</td>
          <td class="p-1 col-md-1">Acciones</td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Almacenaje</td>
          <td class="col-md-4">Almacenaje = KG * Factor * Dias</td>
          <td class="col-md-2">Almacenaje (Aeropuerto)</td>
          <td class="col-md-3">0110-00006 Almacenaje</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php" class="icochico"><img src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href="#EditarTarifa" data-toggle="modal" class="icochico ml-2"><img src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<?php require_once('modales/editarTarifa.php'); ?>
