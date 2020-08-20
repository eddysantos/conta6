<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

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

    require $root . '/Ubicaciones/Nomina/actions/consulta_periodoPago.php'; #$descripcionPago
    require $root . '/Ubicaciones/Nomina/actions/consulta_riesgotrabajo.php'; #$descripcionRiesgotrabajo
    require $root . '/Ubicaciones/Nomina/actions/consulta_banco.php'; #$descripcionBanco
    require $root . '/Ubicaciones/Nomina/actions/consulta_datosEmpleado.php'; #$PRESTAMOCTA

    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_percepciones.php'; #$consultaPercepConcep
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_percepcionesOtrosPagos.php'; #$consultaPercepConcepOP
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_percepcionesHorasExtra.php'; #$consultaPercepConcepHrExtra
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_percepcionesSepIndem.php'; #$consultaPercepConcepINDEM
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_deducciones.php'; #$consultaDeducConcep
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_deducciones_pensionAlimen.php'; #$consultaDeduc_penAlim
    require $root . '/Ubicaciones/Nomina/actions/lst_SAT_incapacidad.php'; #$incapacidad

    require $root . '/Ubicaciones/Nomina/actions/consultaDatosCFDI_docNomina_relacionada.php'; #$total_consultaDatosRelacionada
    $datosFactRelacionada = "";
    if( $total_consultaDatosRelacionada > 0 ){
      while ($row_consultaDatosRelacionada = $rslt_consultaDatosRelacionada->fetch_assoc()) {
        $UUID_relacionado = $row_consultaDatosRelacionada['s_UUID_relacionada'];
        $idFactura_relacionada = $row_consultaDatosRelacionada['fk_id_nomina_relacionada'];

        $datosFactRelacionada .= "
          <tr class='row m-0 justify-content-center'>
            <td class='col-md-2'>$idFactura_relacionada</td>
            <td class='col-md-4'>$UUID_relacionado</td>
          </tr>";
      }
    }


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
      <td class='col-md-1'><input id='idRegimen' class='efecto h22 border-0' type='text' value='$id_regimen' readonly></td>
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

  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaPercepciones.php'; #$detalle_PERCEP
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaPercepcionesOtrosPagos.php'; #$detalle_PERCEPOP
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaPercepcionesHorasExtra.php'; #$detalle_PERCEPHrExtra
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaPercepcionesSepIndem.php'; #$detalle_PERCEPSepIndem
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaDeducciones.php'; #$detalle_DEDUC
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaDeducciones_pensionAlimenticia.php'; #$detalle_DEDUC_penAlim
  require $root . '/Ubicaciones/Nomina/actions/consulta_capturaTotales.php'; #$detalle_TOTALES

?>

<body class="d-flex flex-column h-100">
  <div class="text-center">
    <ul class="nav nav-justified backpink" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="dgenerales-tab" data-toggle="tab" href="#dgenerales" role="tab" aria-controls="dgenerales" aria-selected="true">DATOS GENERALES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dlaborales-tab" data-toggle="tab" href="#dlaborales" role="tab" aria-controls="dlaborales" aria-selected="false">DATOS LABORALES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dpago-tab" data-toggle="tab" href="#dpago" role="tab" aria-controls="dpago" aria-selected="false">DATOS DEL PAGO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="sustituye-tab" data-toggle="tab" href="#sustituye" role="tab" aria-controls="sustituye" aria-selected="false">SUSTITUYE</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade" id="dgenerales" role="tabpanel" aria-labelledby="dgenerales-tab">
        <div class="contorno">
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
                <td class="col-md-1">INFONAVIT</td>
              </tr>
            </thead>
            <tbody class="font14">
              <tr class="row m-0">
                <?php echo $datosGenerales; ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="dlaborales" role="tabpanel" aria-labelledby="dlaborales-tab">
        <div class="contorno">
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
      </div>
      <div class="tab-pane fade" id="dpago" role="tabpanel" aria-labelledby="contact-tab">
        <div class="contorno">
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

          <!-- factura relacionada va aqui -->
        </div>
      </div>
      <div class="tab-pane fade" id="sustituye" role="tabpanel" aria-labelledby="sustituye-tab">
        <div class="contorno">
          <h5 class="titulo font14">FACT. RELACIONADA</h5>
        <?php if( $total_consultaDatosRelacionada == 0 ){ ?>
          <p>No hay resultado</p>
        <?php }elseif( $total_consultaDatosRelacionada > 0 ){ ?>
            <table class="table">
              <thead class="font16">
                <tr class="row m-0 encabezado justify-content-center">
                  <td class="col-md-2">Factura Relacionada</td>
                  <td class="col-md-4">UUID</td>
                </tr>
              </thead>
              <tbody class="font14">
                <?php echo $datosFactRelacionada; ?>
              </tbody>
            </table>
        <?php } ?>
        </div>
      </div>
    </div>

    <div class="row d-flex justify-content-start m-3">
      <?PHP if( $id_regimen == '02' ){ ?>
      <a href="/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php">
        <img class="icomediano" src="/Resources/iconos/left.svg">
      </a>
      <?php } ?>
      <?PHP if( $id_regimen == '09' ){ ?>
      <a href="/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php">
        <img class="icomediano" src="/Resources/iconos/left.svg">
      </a>
      <?php } ?>
    </div>


    <div class="px-1 py-1 flex-grow-1 overflow-auto contorno">
      <!--ACORDEON DE PERCEPCIONES-->
      <?php if( $tipoNomina == 'O' or $tipoNomina == 'E' ){ ?>
          <div class="acordeon2 mt-3 mx-3 mx-3">
            <div class="encabezado font16 p-2" data-toggle="collapse" href="#percep">
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
                    <a href='#catalogoComplementoNomina' data-toggle='modal'>
                      <img class='icochico' src='/Resources/iconos/help.svg'>
                    </a>
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
                    <input type="text" class="efecto" id="importeGravadoPercepcion" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-2'>
                    <input type="text" class="efecto" id="importeExentoPercepcion" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-1 text-left'>
                    <a onclick="agregarPercep()" id="Btn_agregar">
                      <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
      <?php } ?>

      <!--ACORDEON DE OTROS PAGOS-->
      <?php if($id_regimen == '02'){ ?>
          <div class="acordeon2 mt-3 mx-3" id='formOtrospagos'>
            <div class="encabezado font16 p-2" data-toggle="collapse" href="#otrospagos">
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
                    <a href='#catalogoComplementoNomina' data-toggle='modal'>
                      <img class='icochico' src='/Resources/iconos/help.svg'>
                    </a>
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
                  <div class='col-md-3'>
                    <input type="text" class="efecto" id="desPercepcionOP">
                  </div>
                  <div class='col-md-1'>
                    <input type="text" class="efecto" id="importeExentoPercepcionOP" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-1' >
                    <input type='text' class="efecto" id='subCausadoPOP' value='0' onblur='validaIntDec(this);'>
                  </div>
                  <div class='col-md-1'>
                    <input type="text" class="efecto h22 border-0" id="anioPercepcionOP" value="0" readOnly>
                  </div>
                  <div class='col-md-2'>
                    <input type="text" class="efecto h22 border-0" id="saldoFavorPercepcionOP" value="0" readonly>
                  </div>
                  <div class='col-md-1 text-left'>
                    <a onclick="agregarPercepOtrosPagos()" id="Btn_agregar">
                      <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
                        <td class="col-md-3">Concepto o Descripción</td>
                        <td class="col-md-1">Importe</td>
                        <td class="col-md-1">Subsidio Causado</td>
                        <td class="col-md-1">Año</td>
                        <td class="col-md-2">Saldo a favor</td>
                      </tr>
                    </thead>
                    <tbody id='tbodyPercepcionesOP'><?php echo $detalle_PERCEPOP; ?></tbody>
                </table>
              </form>
            </div>
          </div>
      <?php } ?>

      <!--ACORDEON HORAS EXTRAS-->
      <?php if($id_regimen == '02'){ ?>
          <div class="acordeon2 mt-3 mx-3" id="formHorasextras">
            <div class="encabezado font16 p-2" data-toggle="collapse" href="#horasextras">
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
                    <a href='#catalogoComplementoNomina' data-toggle='modal'>
                      <img class='icochico' src='/Resources/iconos/help.svg'>
                    </a>
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
                    <input type="text" class="efecto" id="diaspercepcionHrExtra" value="0" onblur="validaSoloNumeros(this);">
                  </div>
                  <div class='col-md-1'>
                    <input type="text" class="efecto" id="hrpercepcionHrExtra" value="0" onblur="validaSoloNumeros(this);">
                  </div>
                  <div class='col-md-1'>
                    <input type="text" class="efecto" id="importeGravadopercepcionHrExtra" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-1'>
                    <input type="text" class="efecto" id="importeExentopercepcionHrExtra" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-1 text-left'>
                    <a onclick="agregarPercepHrExtra()" id="Btn_agregar">
                      <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
            </div>
          </div>
      <?php } ?>

          <!--ACORDEON SEPARACION E INDEMNIZACION-->
      <?php if($id_regimen == '02' and $descNomina == 'Finiquito'){ ?>
              <div class="acordeon2 mt-3 mx-3" id="formSepIndem">
                <div class="encabezado font16 p-2" data-toggle="collapse" href="#sepIndem">
                  <a href="#">SEPARACIÓN E INDEMNIZACIÓN</a>
                </div>
                <div id="sepIndem" class="collapse">
                  <div>
                    <div class="row mt-3">
                      <div class="col-md-6 text-right">
                        <select class="custom-select-s" name="select" id="percepcionConceptosSepIndem" onchange="concepPercepcionesSepIndem()">
                         <?php echo $consultaPercepConcepINDEM; ?>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <a href='#catalogoComplementoNomina' data-toggle='modal'>
                          <img class='icochico' src='/Resources/iconos/help.svg'>
                        </a>
                      </div>
                    </div>
                    <div class="row mt-4 align-items-center justify-content-center">
                      <div class='col-md-1'>
                        <input type="text" class="efecto h22 border-0" id="claveSATpercepcionSepIndem" readonly>
                        <input type="hidden" id="ordenReportepercepcionSepIndem">
                      </div>
                      <div class='col-md-2'>
                        <input type="text" class="efecto h22 border-0" id="claveInternapercepcionSepIndem" readonly>
                      </div>
                      <div class='col-md-4'>
                        <input type="text" class="efecto" id="despercepcionSepIndem">
                      </div>
                      <div class='col-md-1'>
                        <input type="text" class="efecto" id="importeGravadopercepcionSepIndem" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                      </div>
                      <div class='col-md-1'>
                        <input type="text" class="efecto" id="importeExentopercepcionSepIndem" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                      </div>
                      <div class='col-md-1 text-left'>
                        <a onclick="agregarPercepSepIndem()" id="Btn_agregar">
                          <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
                        <tbody id='tbodyPercepcionesSepIndem'><?php echo $detalle_PERCEPSepIndem; ?></tbody>
                    </table>
                  </form>
                </div>
              </div>
      <?php } ?>

      <!--ACORDEON DEDUCCIONES-->
          <div class="acordeon2 mt-3 mx-3">
            <div class="encabezado font16 p-2" data-toggle="collapse" href="#deduc">
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
                    <a href='#catalogoComplementoNomina' data-toggle='modal'>
                      <img class='icochico' src='/Resources/iconos/help.svg'>
                    </a>
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
                    <input type="text" class="efecto" id="importeGravadoDeduccion" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-2'>
                    <input type="text" class="efecto" id="importeExentoDeduccion" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
                  </div>
                  <div class='col-md-1 text-left'>
                    <a onclick="agregarDeduc()" id="Btn_agregar">
                      <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
      <?php if($id_regimen == '02'){ ?>
      <div class="acordeon2 mt-3 mx-3" id='formPension'>
        <div class="encabezado font16 p-2" data-toggle="collapse" href="#pension">
          <a href="#">PENSIÓN ALIMENTICIA</a>
        </div>
        <div id="pension" class="collapse">
          <div>
            <div class="row mt-3">
              <div class="col-md-6 text-right">
                <select class="custom-select-s" name="select" id="deduccionPenAlim" onchange="concepDeducPenAlim()">
                 <?php echo $consultaDeduc_penAlim; ?>
                </select>
              </div>
              <div class="col-md-6">
                <a href='#catalogoComplementoNomina' data-toggle='modal'>
                  <img class='icochico' src='/Resources/iconos/help.svg'>
                </a>
              </div>
            </div>
            <div class="row mt-4 align-items-center justify-content-center">
              <div class='col-md-1'>
                <input type="text" class="efecto h22 border-0" id="claveSATDeduccion_penAlim" readonly>
                <input type="hidden" id="ordenReporteDeduccion_penAlim">
              </div>
              <div class='col-md-2'>
                <input type="text" class="efecto h22 border-0" id="claveInternaDeduccion_penAlim" readonly>
              </div>
              <div class='col-md-4'>
                <input type="text" class="efecto" id="desDeduccion_penAlim">
              </div>
              <div class='col-md-1'>
                <input type="text" class="efecto" id="baseDeduccion_penAlim" value="0" onchange="validaIntDec(this);calcularBase();">
                <!-- Base = totalPer - ( ISPT+IMSS+INFONAVIT ) -->
              </div>
              <div class='col-md-1'>
                <input type="text" class="efecto" id="porcentajeDeduccion_penAlim" value="0" onchange="validaIntDec(this);calcularBase();">
              </div>
              <div class='col-md-1'>
                <input type="text" class="efecto h22 border-0" id="importeGravadoDeduccion_penAlim" value="0" onchange="validaIntDec(this);sumaGeneralNomina()" readonly>
              </div>
              <div class='col-md-1'>
                <input type="text" class="efecto" id="importeExentoDeduccion_penAlim" value="0" onchange="validaIntDec(this);sumaGeneralNomina()">
              </div>
              <div class='col-md-1 text-left'>
                <a onclick="agregarDeducPenAlimen()" id="Btn_agregar">
                  <img src='/Resources/iconos/002-plus.svg' class='icomediano'>
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
                  <td class="col-md-1">Base</td>
                  <td class="col-md-1">Porcentaje</td>
                  <td class="col-md-1">Importe Gravado</td>
                  <td class="col-md-1">Importe Exento</td>
                </tr>
              </thead>
              <tbody id='tbodyDeduccionesPenAlim'><?php echo $detalle_DEDUC_penAlim; ?></tbody>
            </table>
          </form>
        </div>
      </div>
      <?php } ?>

      <!--ACORDEON TOTALES-->
      <div class="acordeon2 mt-3 mx-3">
        <div class="encabezado font16 p-2" data-toggle="collapse" href="#totales">
          <a href="#">TOTALES</a>
        </div>
        <div id="totales" class="collapse">
          <form class="form1">
            <table class="table">
              <tbody style="letter-spacing:1px">
                <?php echo $detalle_TOTALES; ?>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>


      <div class="row m-0">
        <div class="col-md-4 offset-md-4 my-5 font16">
            <input class="efecto boton" type='button' value="GUARDAR" id="guardar-editarDocNomina"/>
        </div>
      </div>
    </div> <!--Termina el contorno-->
  </div> <!--Termina el Container-Fluid-->
</body>

<?php
require $root . '/Ubicaciones/Nomina/Honorarios/modales/catalogoCompNomina.php';
require $root . '/Ubicaciones/footer.php';
?>
