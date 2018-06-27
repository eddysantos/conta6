<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <table class="table mt-5">
    <tr class="row m-0">
      <td class="col-md-6 offset-md-2">
        <select class="custom-select">
          <option>Seleccione un Almacen</option>
          <option>Motores electricos sumergibles de México S. de R.L de C.V ---  CLT_5448</option>
          <option>Motores Franklin S.A de C.V --- CLT_6967</option>
          <option>Proyectos y Desarrollos de Infraestructura S.A.P.I de C.V --- CLT_7108</option>
          <option>Servicios Integrales en Equipo Medico S.A de C.V  --- CLT_6246</option>
        </select>
      </td>
      <td class="col-md-2">
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
    <h5 class="titulo">GENERAR CONCEPTO</h5>
    <table class="table form1">
      <tbody class="font14">
        <tr class="row mt-5">
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
              <option value="101 -- Varios Registros con 1 Limite Inferior, 1 Limite Superior y 1 Importe (por valor)"></option>
              <option value="102 -- Un solo Registro y un solo Importe"></option>
              <option value="103 -- Exclusivo para Honorarios con un Cargo Mínimo"></option>
              <option value="104 -- Varios Registros con 1 Limite Superior, Importe y 1 Factor"></option>
              <option value="105 -- Varios Registros con 1 Limite Inferior, 1 Limite Superor y 1 Importe (por peso)"></option>
              <option value="106 -- Exclusivo para Honorarios con un Cargo Mínimo y un Descuento"></option>
              <option value="107 -- Exclusivo para Honorarios con un Cargo Mínimo y un Máximo"></option>
            </datalist>
            <label for="tipo">Tipo</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="lista-cargo" class="efecto" id="cargo">
            <datalist id="lista-cargo">
              <option value="0400-00001 -- Honorarios"></option>
              <option value="0400-00002 -- Tramites y Servicios"></option>
              <option value="0400-00003 -- Reconocimiento Aduanero"></option>
              <option value="0400-00004 -- Precios"></option>
              <option value="0400-00005 -- Elaboración de Pedimento"></option>
              <option value="0400-00006 -- Documentación y/o Fotostaticas"></option>
              <option value="0400-00007 -- Entregas de Mercancia"></option>
              <option value="0400-00008 -- Descosolidación"></option>
              <option value="0400-00009 -- Ingresos por Otros Conceptos"></option>
              <option value="0400-00010 -- Sellos Fiscales"></option>
              <option value="0400-00011 -- Manifestación de Valor"></option>
              <option value="0400-00012 -- Maniobras"></option>
              <option value="0400-00013 -- Vucem"></option>
            </datalist>
            <label for="cargo">Cargar a :</label>
          </td>
        </tr>
        <tr class="row justify-content-center mt-4">
          <td class="col-md-3">
            <a role="button" class="boton">
              <img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR CONCEPTO
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="contorno">
    <div class="justify-content-center w-25 mt-4 mb-4">
      <select class="custom-select">
        <option>Selecciona un concepto</option>
        <option>Cambios de Regimen o R1 Imputable a la Agencia</option>
        <option>Cruce de Puente o Arrastre</option>
        <option>Documentación y Despacho</option>
        <option>Documentación y Fotostaticas</option>
        <option>Elaboración de Pedimento (R1)</option>
        <option>Honorarios</option>
        <option>Manifestación de Valor</option>
        <option>Otros Gastos (Conectividad)</option>
        <option>Reconocimiento Aduanero</option>
        <option>Tramites y Servicios</option>
        <option>VUCEM</option>
      </select>
    </div>

    <table class="table">
      <tbody>
        <tr class="row encabezado font16">
          <td class="col-md-12">470 4 AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-1">ADUANA</td>
          <td class="col-md-1">CONCEPTO</td>
          <td class="col-md-4">OBSERVACIONES</td>
          <td class="col-md-2">REALIZA CALCULO</td>
          <td class="col-md-3">CLASIFICACIÓN DEL INGRESO</td>
          <td class="col-md-1">ACCIONES</td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Almacenaje</td>
          <td class="col-md-4">Almacenaje = KG * Factor * Dias</td>
          <td class="col-md-2">Almacenaje (Aeropuerto)</td>
          <td class="col-md-3">0110-00006 Almacenaje</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
            </a>
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/magnifier.svg">
            </a>
            <a href="#EditarTarifaCliente" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Custodia</td>
          <td class="col-md-4">1050 + 15 pesos por cada $25000 adicionales y a partir de la segunda semana el 15% adicional a esta cuota por semana o fraccion</td>
          <td class="col-md-2">Custodia (Aeropuerto)</td>
          <td class="col-md-3">0110-00011 Otros Gastos Comprobados</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
            </a>
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/magnifier.svg">
            </a>
            <a href="#EditarTarifaCliente" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">470</td>
          <td class="col-md-1">Maniobras</td>
          <td class="col-md-4">Los Valores con Factor 1 es KG * Factor 1</td>
          <td class="col-md-2">Manejo (Aeropuerto)</td>
          <td class="col-md-3">0110-00009 Maniobras</td>
          <td class="col-md-1">
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
            </a>
            <a href="Buscartarifa.php">
              <img class="icochico" src="/conta6/Resources/iconos/magnifier.svg">
            </a>
            <a href="#EditarTarifaCliente" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<?php require_once('modales/editarTarifaCliente.php'); ?>
