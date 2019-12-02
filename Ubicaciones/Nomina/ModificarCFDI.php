<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $idDocNomina = trim($_GET['idDocNomina']);

  $sql_datosCaptura = "select * from conta_t_nom_captura WHERE pk_id_docNomina = ?";
  $stmt_datosCaptura = $db->prepare($sql_datosCaptura);
  if (!($stmt_datosCaptura)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmt_datosCaptura->bind_param('s', $idDocNomina);
  if (!($stmt_datosCaptura)) { die("Error during query prepare [$stmt_datosCaptura->errno]: $stmt_datosCaptura->error");	}
  if (!($stmt_datosCaptura->execute())) { die("Error during query prepare [$stmt_datosCaptura->errno]: $stmt_datosCaptura->error"); }
  $rslt_datosCaptura = $stmt_datosCaptura->get_result();
  $rows_datosCaptura = $rslt_datosCaptura->num_rows;

  if( $rows_datosCaptura > 0 ){
    $row_datosCaptura = $rslt_datosCaptura->fetch_assoc();

    $id_docNomina = $row_datosCaptura['pk_id_docNomina'];
    $id_aduana = $row_datosCaptura['fk_id_aduana'];
    $descNomina = $row_datosCaptura['s_descNomina'];
    $tipoNomina = $row_datosCaptura['s_tipoNomina'];
    $semana = $row_datosCaptura['n_semana'];
    $anio = $row_datosCaptura['n_anio'];
    $id_empleado = $row_datosCaptura['fk_id_empleado'];
    $nombre = $row_datosCaptura['s_nombre'];
    $apellidoP = $row_datosCaptura['s_apellidoP'];
    $apellidoM = $row_datosCaptura['s_apellidoM'];
    $RFC = $row_datosCaptura['s_RFC'];
    $CURP = $row_datosCaptura['s_CURP'];
    $id_regimen = $row_datosCaptura['fk_id_regimen'];
    $Reg_Patronal = $row_datosCaptura['s_Reg_Patronal'];
    $estado_entFed = $row_datosCaptura['fk_c_estado_entFed'];
    $IMSS = $row_datosCaptura['s_IMSS'];
    $INFONAVIT = $row_datosCaptura['s_INFONAVIT'];
    $fechaPago = $row_datosCaptura['d_fechaPago'];
    $fechaInicio = $row_datosCaptura['d_fechaInicio'];
    $fechaFinal = $row_datosCaptura['d_fechaFinal'];
    $numDiasPagados = $row_datosCaptura['n_numDiasPagados'];
    $departamento = $row_datosCaptura['s_departamento'];
    $id_formapago = $row_datosCaptura['fk_id_formapago'];
    $metodoPago = $row_datosCaptura['fk_c_MetodoPago'];
    $CLABE = $row_datosCaptura['s_CLABE'];
    $id_banco = $row_datosCaptura['fk_id_banco'];
    $FechaInicioRelLaboral = $row_datosCaptura['d_FechaInicioRelLaboral'];
    $antiguedad = $row_datosCaptura['s_antiguedad'];
    $puesto_actividad = $row_datosCaptura['s_puesto_actividad'];
    $id_contrato = $row_datosCaptura['fk_id_contrato'];
    $id_jornada = $row_datosCaptura['fk_id_jornada'];
    $id_pago = $row_datosCaptura['pk_id_pago'];
    $UsoCFDI = $row_datosCaptura['fk_c_UsoCFDI'];
    $salarioBaseCotApor = $row_datosCaptura['n_salarioBaseCotApor'];
    $id_riesgo = $row_datosCaptura['fk_id_riesgo'];
    $salarioDiarioIntegrado = $row_datosCaptura['n_salarioDiarioIntegrado'];
    $cantidad = $row_datosCaptura['n_cantidad'];
    $unidad = $row_datosCaptura['s_unidad'];
    $moneda = $row_datosCaptura['s_moneda'];
    $ClaveProdServ = $row_datosCaptura['s_ClaveProdServ'];
    $descripcion = utf8_encode($row_datosCaptura['s_descripcion']);
    $valor_unitario = $row_datosCaptura['n_valor_unitario'];
    $importe = $row_datosCaptura['n_importe'];
    $regimenFiscal = $row_datosCaptura['s_regimenFiscal'];
    $lugarExpedicion = $row_datosCaptura['s_lugarExpedicion'];
    $lugarExpediciotxt = $row_datosCaptura['s_lugarExpedicion_txt'];
    $usuario_docNomina = $row_datosCaptura['fk_usuario_docNomina'];
    $fecha_docNomina = $row_datosCaptura['d_fecha_docNomina'];
    $usuario_docNomina_modifi = $row_datosCaptura['fk_usuario_docNomina_modifi'];
    $fecha_docNomina_modifi = $row_datosCaptura['d_fecha_docNomina_modifi'];

    if($tipoNomina == 'O'){ $txt_tipoNomina = 'Ordinaria'; }else{ $txt_tipoNomina = 'Extraodinaria'; }

    require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_periodoPago.php'; #$descripcionPago
    require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_riesgotrabajo.php'; #$descripcionRiesgotrabajo
    require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_banco.php'; #$descripcionBanco
    require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_datosEmpleado.php'; #$PRESTAMOCTA
    require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_percepciones.php'; #$consultaPercepConcep
    require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_percepcionesOtrosPagos.php'; #$consultaPercepConcepOP
    require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_percepcionesHorasExtra.php'; #$consultaPercepConcepHrExtra
    require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_deducciones.php'; #$consultaDeducConcep
    require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_incapacidad.php'; #$incapacidad

    $datosGenerales = "
      <td class='col-md-1'>$id_empleado</td>
      <td class='col-md-2'>$nombre</td>
      <td class='col-md-3'>$apellidoP $apellidoM</td>
      <td class='col-md-2'>$CURP</td>
      <td class='col-md-1'>$RFC</td>
      <td class='col-md-2'>$IMSS</td>
      <td class='col-md-1'>$INFONAVIT</td>";

    $datosLaborales = "
      <td class='col-md-2'>$id_pago $descripcionPago</td>
      <td class='col-md-2'>$id_riesgo $descripcionRiesgotrabajo</td>
      <td class='col-md-2'>$departamento</td>
      <td class='col-md-1'><input id='idRegimen' class='efecto h22 border-0' type='text' value='$id_contrato' readonly></td>
      <td class='col-md-2'>$FechaInicioRelLaboral</td>
      <td class='col-md-2'>$antiguedad</td>
      <td class='col-md-1'>$puesto_actividad</td>";

    $datosPago = "
      <td class='col-md-2'>$semana</td>
      <td class='col-md-2'>$txt_tipoNomina</td>
      <td class='col-md-3'>$fechaInicio al $fechaFinal</td>
      <td class='col-md-2'><input id='fechaPago' class='efecto' type='date' value='$fechaPago'></td>
      <td class='col-md-2'><input id='doc' class='efecto h22 border-0' type='text' value='$id_docNomina' readonly></td>";
    $datosPago2 = "
      <td class='col-md-2'>$metodoPago</td>
      <td class='col-md-2'>$id_banco $descripcionBanco</td>
      <td class='col-md-3'>$CLABE</td>
      <td class='col-md-2'>$salarioBaseCotApor</td>
      <td class='col-md-2'>$salarioDiarioIntegrado</td>";
      $datosPago3 = "
        <td class='col-md-2'>$cantidad</td>
        <td class='col-md-2'>$unidad</td>
        <td class='col-md-3'>$descripcion</td>
        <td class='col-md-2'><input id='valorUnitario' class='efecto h22 border-0' type='text' value='$valor_unitario' readonly></td></td>
        <td class='col-md-2'><input id='valorImporte' class='efecto h22 border-0' type='text' value='$importe' readonly></td></td>";



  }

  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaPercepciones.php'; #$detalle_PERCEP
  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaPercepcionesOtrosPagos.php'; #$detalle_PERCEPOP
  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaPercepcionesHorasExtra.php'; #$detalle_PERCEPHrExtra
  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaDeducciones.php'; #$detalle_DEDUC
  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaTotales.php'; #$detalle_TOTALES

?>

<div class="text-center">
  <div class="row submenuMed m-0">
    <div class="col-md-4" role="button">
      <a  id="submenuMed" class="sueldosysalarios" accion="dgenerales" status="cerrado">DATOS GENERALES</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="sueldosysalarios" accion="dlaborales" status="cerrado">DATOS LABORALES</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="sueldosysalarios" accion="dpago" status="cerrado">DATOS DEL PAGO</a>
    </div>
  </div>

  <div class="col-md-1 mt-4">
    <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
  </div>

  <div id="contornogen" class="contorno" style="display:none">
    <h5 class="titulo font14">DATOS GENERALES</h5>
    <table class="table">
      <thead class="font16">
        <tr class="row m-0 encabezado">
          <td class="col-md-1">No.</td>
          <td class="col-md-2">Nombre</td>
          <td class="col-md-3">Apellidos</td>
          <td class="col-md-2">CURP</td>
          <td class="col-md-1">RFC</td>
          <td class="col-md-2">No. IMSS</td>
          <td class="col-md-1">Infonavit</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0">
          <?php echo $datosGenerales; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornolab" class="contorno" style="display:none">
    <h5 class="titulo font14">DATOS LABORALES</h5>
    <table class="table">
      <thead class="font16">
        <tr class="row m-0 encabezado">
          <td class="col-md-2">Periosidad del Pagó</td>
          <td class="col-md-2">Riesgo de Trabajo</td>
          <td class="col-md-2">Departamento</td>
          <td class="col-md-1">Regimen</td>
          <td class="col-md-2">Fecha Contrato</td>
          <td class="col-md-2">Antiguedad Semanas</td>
          <td class="col-md-1">Puesto</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0">
          <?php echo $datosLaborales; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornopago" class="contorno" style="display:none">
    <h5 class="titulo font14">DATOS DEL PAGO</h5>
    <table class="table">
      <thead class="font16">
        <tr class="row m-0 encabezado">
          <td class="col-md-2">Semana</td>
          <td class="col-md-2">Tipo</td>
          <td class="col-md-3">Fecha</td>
          <td class="col-md-2">Fecha Pago</td>
          <td class="col-md-2">Documento</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0">
          <?php echo $datosPago; ?>
        </tr>
      </tbody>
    </table>
    <table class="table">
      <thead class="font16">
        <tr class="row m-0 encabezado">
          <td class="col-md-2">Método de pago</td>
          <td class="col-md-2">Banco</td>
          <td class="col-md-3">Cuenta / Clabe Interbancaria</td>
          <td class="col-md-2">Salario Base</td>
          <td class="col-md-2">Salario Diario</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0">
          <?php echo $datosPago2; ?>
        </tr>
      </tbody>
    </table>
    <table class="table">
      <thead class="font16">
        <tr class="row m-0 encabezado">
          <td class="col-md-2">Cantidad</td>
          <td class="col-md-2">Unidad</td>
          <td class="col-md-3">Descripción</td>
          <td class="col-md-2">Valor Unitario</td>
          <td class="col-md-2">Importe</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0">
          <?php echo $datosPago3; ?>
        </tr>
      </tbody>
    </table>
  </div>

<!--ACORDEON DE PERCEPCIONES-->
    <div class="acordeon2 mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#percep">
        <a href="#">PERCEPCIONES</a>
      </div>
      <div id="percep" class="collapse">
        <div>
          <div class="row mt-3">
            <div class="col-md-6 text-right">
              <select class="custom-select-s" name="select" id="percepcionConceptos" onchange="concepPercepciones()">
               <?php echo $consultaPercepConcep; ?>
              </select>
            </div>
            <div class="col-md-6">
              <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/help.svg"></a>
            </div>
          </div>
          <div class="row mt-4 align-items-center justify-content-center">
            <div class='col-md-1'>
              <input type="text" class="efecto h22 border-0" id="claveSATpercepcion" readonly>
              <input type="hidden" id="ordenReportePercepcion">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto h22 border-0" id="claveInternaPercepcion" readonly>
            </div>
            <div class='col-md-4'>
              <input type="text" class="efecto" id="desPercepcion">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto" id="importeGravadoPercepcion" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto" id="importeExentoPercepcion" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-1 text-left'>
              <a onclick="agregarPercep()" id="Btn_agregar">
                <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
              </a>
            </div>
          </div>
        </div>
        <form class="form1">
          <table class="table">
            <thead>
              <tr class="row mt-4 m-0 backpink">
                <td class="col-md-1">Cve. SAT</td>
                <td class="col-md-2">Cuenta Contable</td>
                <td class="col-md-4">Concepto o Descripción</td>
                <td class="col-md-2">Importe Gravado</td>
                <td class="col-md-2">Importe Exento</td>
              </tr>
            </thead>
            <tbody id='tbodyPercepciones'><?php echo $detalle_PERCEP; ?></tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON DE OTROS PAGOS-->
    <div class="acordeon2 mt-3" id='formOtrospagos'>
      <div class="encabezado font16" data-toggle="collapse" href="#otrospagos">
        <a href="#">OTROS PAGOS</a>
      </div>
      <div id="otrospagos" class="collapse">
        <div>
          <div class="row mt-3">
            <div class="col-md-6 text-right">
              <select class="custom-select-s" name="select" id="percepcionConceptosOP" onchange="concepPercepcionesOP()">
               <?php echo $consultaPercepConcepOP; ?>
              </select>
            </div>
            <div class="col-md-6">
              <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/help.svg"></a>
            </div>
          </div>
          <div class="row mt-4 align-items-center justify-content-center">
            <div class='col-md-1'>
              <input type="text" class="efecto h22 border-0" id="claveSATpercepcionOP" readonly>
              <input type="hidden" id="ordenReportePercepcionOP">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto h22 border-0" id="claveInternaPercepcionOP" readonly>
            </div>
            <div class='col-md-4'>
              <input type="text" class="efecto" id="desPercepcionOP">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto" id="importeExentoPercepcionOP" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto h22 border-0" id="anioPercepcionOP" value="0" readOnly>
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto h22 border-0" id="saldoFavorPercepcionOP" value="0" readonly>
            </div>
            <div class='col-md-1 text-left'>
              <a onclick="agregarPercepOtrosPagos()" id="Btn_agregar">
                <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
              </a>
            </div>
          </div>
        </div>
        <form class="form1">
          <table class="table">
              <thead>
                <tr class="row mt-4 m-0 backpink">
                  <td class="col-md-1">Cve. SAT</td>
                  <td class="col-md-2">Cuenta Contable</td>
                  <td class="col-md-4">Concepto o Descripción</td>
                  <td class="col-md-1">Importe</td>
                  <td class="col-md-1">Año</td>
                  <td class="col-md-2">Saldo a favor</td>
                </tr>
              </thead>
              <tbody id='tbodyPercepcionesOP'><?php echo $detalle_PERCEPOP; ?></tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON HORAS EXTRAS-->
    <div class="acordeon2 mt-3" id="formHorasextras">
      <div class="encabezado font16" data-toggle="collapse" href="#horasextras">
        <a href="#">HORAS EXTRAS</a>
      </div>
      <div id="horasextras" class="collapse">
        <div>
          <div class="row mt-3">
            <div class="col-md-6 text-right">
              <select class="custom-select-s" name="select" id="percepcionConceptosHrExtra" onchange="concepPercepcionesHrExtra()">
               <?php echo $consultaPercepConcepHrExtra; ?>
              </select>
            </div>
            <div class="col-md-6">
              <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/help.svg"></a>
            </div>
          </div>
          <div class="row mt-4 align-items-center justify-content-center">
            <div class='col-md-1'>
              <input type="text" class="efecto h22 border-0" id="claveSATpercepcionHrExtra" readonly>
              <input type="hidden" id="ordenReportepercepcionHrExtra">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto h22 border-0" id="claveInternapercepcionHrExtra" readonly>
            </div>
            <div class='col-md-4'>
              <input type="text" class="efecto" id="despercepcionHrExtra">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto" id="diaspercepcionHrExtra" value="0">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto" id="hrpercepcionHrExtra" value="0">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto" id="importeGravadopercepcionHrExtra" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-1'>
              <input type="text" class="efecto" id="importeExentopercepcionHrExtra" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-1 text-left'>
              <a onclick="agregarPercepHrExtra()" id="Btn_agregar">
                <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
              </a>
            </div>
          </div>
        </div>
        <form class="form1">
          <table class="table">
              <thead>
                <tr class="row mt-4 m-0 backpink">
                  <td class="col-md-1">Cve. SAT</td>
                  <td class="col-md-2">Cuenta Contable</td>
                  <td class="col-md-4">Concepto o Descripción</td>
                  <td class="col-md-1">Días</td>
                  <td class="col-md-1">Horas</td>
                  <td class="col-md-1">Importe Gravado</td>
                  <td class="col-md-1">Importe Exento</td>
                </tr>
              </thead>
              <tbody id='tbodyPercepcionesHrExtra'><?php echo $detalle_PERCEPHrExtra; ?></tbody>
          </table>
        </form>



        <!--form class="form1">
          <table class="table">
            <tbody>


              <tr class="row mt-5 m-0">
                <td class="col-md-1 input-effect">
                  <input id="cve2" class="efecto">
                  <label for="cve2">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon2" class="efecto">
                  <label for="ctacon2">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc2" class="efecto">
                  <label for="concdesc2">Concepto o Descripción</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="dias" class="efecto">
                  <label for="dias">Días</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="horas" class="efecto">
                  <label for="horas">Horas</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="gravado" class="efecto">
                  <label for="gravado">$ Gravado</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="exento" class="efecto">
                  <label for="exento">$ Exento</label>
                </td>
                <td><a><img class="icomediano" src="/conta6/Resources/iconos/002-plus.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form-->
      </div>
    </div>

<!--ACORDEON DEDUCCIONES-->
    <div class="acordeon2 mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#deduc">
        <a href="#">DEDUCCIONES</a>
      </div>
      <div id="deduc" class="collapse">
        <div>
          <div class="row mt-3">
            <div class="col-md-6 text-right">
              <select class="custom-select-s" name="select" id="deduccionConceptos" onchange="concepDeducciones()">
               <?php echo $consultaDeducConcep; ?>
              </select>
            </div>
            <div class="col-md-6">
              <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/help.svg"></a>
            </div>
          </div>
          <div class="row mt-4 align-items-center justify-content-center">
            <div class='col-md-1'>
              <input type="text" class="efecto h22 border-0" id="claveSATDeduccion" readonly>
              <input type="hidden" id="ordenReporteDeduccion">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto h22 border-0" id="claveInternaDeduccion" readonly>
            </div>
            <div class='col-md-4'>
              <input type="text" class="efecto" id="desDeduccion">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto" id="importeGravadoDeduccion" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-2'>
              <input type="text" class="efecto" id="importeExentoDeduccion" value="0" onchange="sumaGeneralNomina()">
            </div>
            <div class='col-md-1 text-left'>
              <a onclick="agregarDeduc()" id="Btn_agregar">
                <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
              </a>
            </div>
          </div>
        </div>

        <form class="form1">
          <table class="table">
            <thead>
              <tr class="row mt-4 m-0 backpink">
                <td class="col-md-1">Cve. SAT</td>
                <td class="col-md-2">Cuenta Contable</td>
                <td class="col-md-4">Concepto o Descripción</td>
                <td class="col-md-2">Importe Gravado</td>
                <td class="col-md-2">Importe Exento</td>
              </tr>
            </thead>
            <tbody id='tbodyDeducciones'><?php echo $detalle_DEDUC; ?></tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON PENSION ALIMENTICIA-->
    <div class="acordeon2 mt-3" id='formPension'>
      <div class="encabezado font16" data-toggle="collapse" href="#pension">
        <a href="#">PENSIÓN ALIMENTICIA</a>
      </div>
      <div id="pension" class="collapse">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-3">
                <td class="col-md-6 offset-md-3">
                  <select class="custom-select">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>Pensión Alimenticia -- 007 -- 0213-00005</option>
                  </select>
                </td>
              </tr>
              <tr class="row mt-4 m-0">
                <td class="col-md-1 input-effect">
                  <input id="cve4" class="efecto">
                  <label for="cve4">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon4" class="efecto">
                  <label for="ctacon4">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc4" class="efecto">
                  <label for="concdesc4">Concepto o Descripción</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="base" class="efecto">
                  <label for="base">Base</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="porcent" class="efecto">
                  <label for="porcent">Porcentaje</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="gravado2" class="efecto">
                  <label for="gravado2">$ Gravado</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="exento2" class="efecto">
                  <label for="exento2">$ Exento</label>
                </td>
                <td>
                  <a><img class="icomediano" src="/conta6/Resources/iconos/002-plus.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON TOTALES-->
    <div class="acordeon2 mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#totales">
        <a href="#">TOTALES</a>
      </div>
      <div id="totales" class="collapse">
        <form class="form1">
          <table class="table">
            <tbody style="letter-spacing:1px">
              <?php echo $detalle_TOTALES; ?>



              <!--tr class="row m-0 mt-5">
                <td class="col-md-4 sub2 font14 pt-4">INCAPACIDAD :</td>
                <td class="col-md-1 input-effect">

                </td>
                <td class="col-md-1 input-effect">

                </td>
                <td class="col-md-1 input-effect">

                </td>
                <td class="col-md-1 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
              </tr>

              <tr class="row mt-5 m-0">
                <td class="col-md-2 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
                <td class="col-md-1 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
                <td class="col-md-2 input-effect">

                </td>
                <td>
                  <a><img class="icomediano" src="/conta6/Resources/iconos/002-trash.svg"></a>
                </td>
              </tr-->
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 offset-md-4 mt-5 font16">
          <a href="" class="boton">GUARDAR</a>
      </div>
    </div>
  </div> <!--Termina el contorno-->
</div> <!--Termina el Container-Fluid-->

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
