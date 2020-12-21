<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_anticipo = $_GET['id_anticipo'];

  $sql_Select = "SELECT * FROM conta_t_anticipos_mst WHERE pk_id_anticipo = ? AND fk_id_aduana = ?";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('ss', $id_anticipo,$aduana);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

	if( $rows > 0 ){
		$rowMST = $rslt->fetch_assoc();
		$cancela = $rowMST['s_cancela']; // 0=Activo 1=Cancelado
    $id_poliza = $rowMST['fk_id_poliza'];
    $importeAnt = $rowMST['n_valor'];

    //totales
	 	$oRst_STPD_sql = "SELECT fk_id_anticipo, SUM(n_cargo) AS SUMA_CARGOS, SUM(n_abono) AS SUMA_ABONOS FROM conta_t_anticipos_det WHERE fk_id_anticipo = ? GROUP BY fk_id_anticipo ";
		$stmtTotales = $db->prepare($oRst_STPD_sql);
		if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
		$stmtTotales->bind_param('s', $id_anticipo);
		if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
		if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
		$rsltTotales = $stmtTotales->get_result();
		$rowsTotales = $rsltTotales->num_rows;
    $txtStatus = '';
		if( $rowsTotales > 0 ){
			$oRst_STPD = $rsltTotales->fetch_assoc();
			$sumaCargos = $oRst_STPD['SUMA_CARGOS'];
			$sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
      $sumaC = number_format($sumaCargos,2,'.','') + number_format($importeAnt,2,'.','') ;
		  $Status_Anticipo =  number_format($sumaC - $sumaAbonos,2,'.','');
      $statusGeneraPoliza = false;

      if( $Status_Anticipo == 0 ){
        $txtStatus = 'style="color: #000000"';
        $statusGeneraPoliza = true;
		  }else{
				$txtStatus = 'style="color: red"';
        $statusGeneraPoliza = false;
			}
		}else{
			$sumaCargos = 0;
			$sumaAbonos = 0;
      $sumaC = 0;
      $Status_Anticipo = 0;
		}

		//validaciones
		if( $cancela == 0 ){ $txt_cancela = "Activo"; }else{ $txt_cancela = "Cancelado"; }
		if( $oRst_permisos["s_correcciones_mst_anticipos"] == 1 && $cancela == 0 ){ $mostrar = true; }else{ $mostrar = false; }
		if( $oRst_permisos["s_descancelar_anticipos"] == 1 ){ $mostrarCancela = true; }else{ $mostrarCancela = false; }
		if( $cancela == 1 ){ $clase = 'class="efecto disabled readonly" disabled'; }
		if( $id_poliza > 0){
      $tienePoliza = true;
      $txt_disabled = '';
    }else{
      $tienePoliza = false;
      $txt_disabled = 'disabled';
    }
		if( $oRst_permisos["s_editar_anticipos_det_pol"] == 1 && $cancela == 0 && $id_poliza > 0 ){
		  $mostrarEditConPol = true;
		}else{
		  if( $cancela == 0 && is_null($id_poliza) ){
			  $mostrarEditConPol = true;
		  }else{
			$mostrarEditConPol = false;
		  }
		}
	}
?>

<div class="text-center mb-10">
  <div class="row m-0 backpink">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link dant" id="submenuMed" status="cerrado" accion="dtosant">DATOS DE ANTICIPO</a>
      </li>
    </ul>
  </div>
<?php
if( $rows > 0 ){
?>

  <!--Comienza DETALLE DATOS DE ANTICIPO-->
  <div id="datosanticipo" class="contorno" style="display:none">
    <h5 class="titulo font16">DATOS DE ANTICIPO</h5>
    <form class="form1">
      <table class="table">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">USUARIO</td>
            <td class="col-md-1">ANTICIPO</td>
            <td class="col-md-2">FECHA REGISTRO</td>
            <td class="col-md-2">FECHA ANTICIPO</td>
            <td class="col-md-1">OFICINA</td>
            <td class="col-md-2">VALOR</td>
            <td class="col-md-2">CANCELACION</td>
          </tr>
        </thead>
        <tbody class="font14">
          <input type="hidden" id="usuario_activo" value="<?php echo $usuario; ?>">
          <input type="hidden" id="aduana_activa" value="<?php echo $aduana; ?>">
          <input type="hidden" id="mst-anticipo" value="<?php echo $rowMST['pk_id_anticipo']; ?>">
          <input type="hidden" id="mst-fecha" value="<?php echo $rowMST['d_fecha']; ?>">
          <input type="hidden" id="mst-poliza" value="<?php echo $rowMST['fk_id_poliza']; ?>">
          <input type="hidden" id="mst-ctaMST" value="<?php echo $rowMST['fk_id_cuentaMST']; ?>">
          <input type="hidden" id="mst-concepto" value="<?php echo $rowMST['s_concepto']; ?>">
          <input type="hidden" id="mst-importe" value="<?php echo $rowMST['n_valor']; ?>">
          <input type="hidden" id="mst-cliente" value="<?php echo $rowMST['fk_id_cliente_antmst']; ?>">
          <input type="hidden" id="tipoDoc" value="5">

          <tr class="row align-items-center">
            <td class="col-md-1"><?php echo $rowMST['fk_id_poliza']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['pk_id_anticipo']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fecha']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo number_format($rowMST['n_valor'],2,'.',','); ?></td>
            <td class="col-md-2">
      				<?php if( $mostrarCancela == true ){ ?>
      					<select class="custom-select-s" size="1" id="ant-cancela" <?php echo $txt_disabled; ?>>
        					<?php if( $cancela == 0 ){
      							echo "<option value='0' selected>Activo</option>";
      							echo "<option value='1'>Cancelado</option>";
      						  }else{
      							echo "<option value='0'>Activo</option>";
      							echo "<option value='1' selected>Cancelado</option>";
      						  } ?>
      					</select>
      				<?php }else{ echo $txt_cancela; } ?>
      			</td>
          </tr>

		      <tr class="row sub2 font12">
            <td class="col-md-2">CUENTA</td>
			      <td class="col-md-1">CLIENTE</td>
            <td class="col-md-2">BANCO/CUENTA</td>
            <td class="col-md-6">CONCEPTO</td>
          </tr>
    		  <tr  class="row align-items-center">
			      <td class="col-md-2"><?php echo $rowMST['fk_id_cuentaMST']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_id_cliente_antmst']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['s_bancoOri'].'/'.$rowMST['s_ctaOri']; ?></td>
            <td class="col-md-6"><?php echo $rowMST['s_concepto']; ?></td>
            <td class="col-md-1">
              <?php if( $mostrar == true ){ ?>
              <a href='#ant-editarRegMST' class='editar-anticipoMST' db-id='<?php echo $id_anticipo; ?>'>
                <img class='icochico' src='/Resources/iconos/003-edit.svg'>
              </a>
              <?php }?>
            </td>
          </tr>

        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE ANTICIPO-->


  <ul class="nav nav-pills m-3 nav-justified" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="capturaAnticipo-tab" data-toggle="pill" href="#capturaAnticipo" role="tab" aria-controls="capturaAnticipo" aria-selected="true">Captura Detalle de Anticipo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="detalleAnticipo-tab" data-toggle="pill" href="#detalleAnticipo" role="tab" aria-controls="detalleAnticipo" aria-selected="false">Detalle de Anticipo</a>
    </li>
    <?php if( $id_poliza > 0 && $oRst_permisos['s_consultar_ContaElect'] == 1 ){ ?>
    <li class="nav-item">
      <a class="nav-link" id="inforPartidaAnticipo-tab" data-toggle="pill" href="#inforPartidaAnticipo" role="tab" aria-controls="inforPartidaAnticipo" aria-selected="false" onclick="infAdd_detalle(<?php echo $id_poliza; ?>)">Información de la Partida</a>
    </li>
    <?php } ?>
  </ul>
  <div class="tab-content container-fluid" id="pills-tabContent">
    <div class="tab-pane fade show active" id="capturaAnticipo" role="tabpanel" aria-labelledby="capturaAnticipo-tab">
      <div id="capturaAnticipo" class="contorno-mov">
        <table class="table form1">
          <thead>
            <tr class="row m-0 encabezado font16">
              <td class="col-md-12">CAPTURA DETALLE DE ANTICIPO</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row m-0 mt-5">
              <td class="col-md-2 input-effect">
                <input class="efecto tiene-contenido popup-input" id="ant-referencia" type="text" id-display="#popup-display-ant-referencia" action="referencias" value="SN" db-id="SN" autocomplete="off">
                <div class="popup-list" id="popup-display-ant-referencia" style="display:none"></div>
                <label for="ant-referencia">Referencia</label>
              </td>
              <td class="col-md-8 input-effect">
                <div id="lstClientes">
                  <input class="efecto popup-input" id="ant-cliente" type="text" id-display="#popup-display-ant-cliente" action="clientes" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-ant-cliente" style="display:none"></div>
                  <label for="ant-cliente">Cliente</label>
                </div>
                <div id="lstClientesCorresp" style="display:none">
                  <select class="custom-select" size='1' id="ant-clienteCorresp">
                      <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                  </select>
                </div>
              </td>
              <td class="col-md-2" role="button">
                <?php if( $mostrarEditConPol == true ){ ?>
			          <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico border-0"> <img src= "/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                <?php } ?>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-8 input-effect">
                <div id="lstClientesCorrespCtas-detpol">
                  <select class="custom-select" size='1' id="ant-clienteCorrespCtas">
                      <option selected value='0'>Seleccione</option>
                  </select>
                </div>
              </td>
              <td class="col-md-2 input-effect">
                <input  class="efecto tiene-contenido" id="ant-cargo" value="0" onchange="validaIntDec(this);">
                <label for="ant-cargo">Cargo</label>
              </td>
              <td class="col-md-2 input-effect">
                <input  class="efecto tiene-contenido" id="ant-abono" value="0" onchange="validaIntDec(this);">
                <label for="ant-abono">Abono</label>
              </td>
            </tr>
            <tr class="row mt-4">
              <td class="col-md-2 offset-md-5">
                <?php if( $mostrarEditConPol == true ){ ?>
                <a href="#" id="btnRegDetAnt" class="boton"><img src= "/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                <?php } ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row mt-5 ">
        <div class="col-md-2 offset-md-4">SUMA DE CARGOS</div>
        <div class="col-md-2">SUMA DE ABONOS</div>
      </div>
      <div class="row" id="totalesAnticipo2">
        <div class="col-md-2 offset-md-4">
          <input class="efecto" id="sumCargos2" value="<?php echo number_format($sumaC,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
        <div class="col-md-2">
          <input class="efecto" id="sumAbonos2" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
      </div>

      <div class="contorno-mov mt-5">
        <table class="table font12 table-hover">
          <thead>
            <tr class="row sub3 b m-0">
              <td width="4%"></td>
              <td width="10%">CUENTA</td>
              <td width="10%">REFERENCIA</td>
              <td width="10%">CLIENTE</td>
              <td width="10%">FACTURA</td>
              <td width="10%">CTA GASTOS</td>
              <td width="10%">PAGO ELECT</td>
              <td width="10%">NOTACRED</td>
              <td width="11%">CARGO</td>
              <td width="11%">ABONO</td>
              <td width="4%"></td>
            </tr>
          </thead>
          <tbody id="ultimosRegistrosAnticipo"></tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="detalleAnticipo" role="tabpanel" aria-labelledby="detalleAnticipo-tab">
      <div class="row">
        <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
        <div class="col-md-2">SUMA DE ABONOS</div>
      </div>
      <div class="row font14 mt-3">
        <div class="col-md-3">
          <?php if( $oRst_permisos["s_reusar_anticipos"] == 1 ){ ?>
          <a href="#" id="btn_reusarAnt" class="boton"><img src= "/Resources/iconos/refresh-button.svg"> REUSAR ANTICIPO</a>
          <?php } ?>
        </div>
        <div class="col-md-3">
          <?php if( $tienePoliza == false && $statusGeneraPoliza == true ){ ?>
          <a href="#" id="btn_generarPolAnt" class="boton"><img src= "/Resources/iconos/add.svg"> GENERAR POLIZA</a>
          <?php } ?>
        </div>
        <div class="col-md-2">
          <?php if( $tienePoliza == true ){ ?>
          <a href="#" id="btn_prinAnt" class="boton border-0"><img class="icomediano" src= "/Resources/iconos/printer.svg"></a>
          <?php } ?>
        </div>
        <div class="col-md-2">
          <input class="efecto" id="sumCargos1" value="<?php echo number_format($sumaC,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
        <div class="col-md-2">
          <input class="efecto" id="sumAbonos1" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
        <?php
        // echo $txtStatus;
        ?>
      </div>

      <div id="detallepoliza" class="contorno-mov mt-4">
        <table class="table table-hover">
          <thead>
            <tr class="row encabezado font16 m-0">
              <td class="col-md-12">DETALLE ANTICIPO</td>
            </tr>
            <tr class="row sub3 b m-0 font12">
              <td width="4%"></td>
              <td width="10%">CUENTA</td>
              <td width="10%">REFERENCIA</td>
              <td width="10%">CLIENTE</td>
              <td width="10%">FACTURA</td>
              <td width="10%">CTA GASTOS</td>
              <td width="10%">PAGO ELECT</td>
              <td width="10%">NOTACRED</td>
              <td width="11%">CARGO</td>
              <td width="11%">ABONO</td>
              <td width="4%"></td>
            </tr>
          </thead>
          <tbody id="tabla_detalleanticipo" class="font12"></tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="inforPartidaAnticipo" role="tabpanel" aria-labelledby="inforPartidaAnticipo-tab">
      <?php if( $id_poliza > 0 ){
          require $root . '/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_det.php';
        } ?>
    </div>
  </div>

</div>


<?PHP
  require_once('modales/editarDatosAnticipo.php');
  require_once('modales/editarRegistro.php');
  require_once('modales/buscarFacturasAnt.php');



}else{ #$rows?>
  <div class="container-fluid pantallaGris">
      <div class="tituloSinRegistros">NO EXISTE EL ANTICIPO O ES DE OTRA OFICINA</div>
  </div>
<?php
} #$rows

require $root . '/Ubicaciones/footer.php';
?>

<script src="/Ubicaciones/Contabilidad/anticipos/js/Anticipos.js" charset="utf-8"></script>
