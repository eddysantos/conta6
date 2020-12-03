<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_cheque = $_GET['id_cheque'];
  $id_cuentaMST = $_GET['id_cuentaMST'];
  $txtStatus = '';

  $sql_Select = "SELECT * from conta_t_cheques_mst Where pk_id_cheque = ? AND fk_id_cuentaMST = ?";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

  $statusGeneraPoliza = false;

	if( $rows > 0 ){
		$rowMST = $rslt->fetch_assoc();
		$cancela = $rowMST['s_cancela']; // 0=Activo 1=Cancelado
    $id_poliza = $rowMST['fk_id_poliza'];
    $importeChe = $rowMST['n_valor'];

    //totales
	 	$oRst_STPD_sql = "SELECT fk_id_cheque,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS
                      from conta_t_cheques_det
                      where fk_id_cheque = ? AND fk_id_cuentaM = ?
                      group by fk_id_cheque ";
		$stmtTotales = $db->prepare($oRst_STPD_sql);
		if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
		$stmtTotales->bind_param('ss', $id_cheque,$id_cuentaMST);
		if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
		if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
		$rsltTotales = $stmtTotales->get_result();
		$rowsTotales = $rsltTotales->num_rows;
		if( $rowsTotales > 0 ){
			$oRst_STPD = $rsltTotales->fetch_assoc();
			$sumaCargos = $oRst_STPD['SUMA_CARGOS'];
			$sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
      $sumaC = number_format($sumaAbonos,2,'.','') + number_format($importeChe,2,'.','') ;
		  $Status_Cheque =  number_format($sumaC - $sumaCargos,2,'.','');

      if( $Status_Cheque == 0 ){
        $txtStatus = 'style="color: #000000"';
        $statusGeneraPoliza = true;
		  }else{
				$txtStatus = 'style="color: rgb(209, 28, 28)"';
        $statusGeneraPoliza = false;
			}
		}else{
			$sumaCargos = 0;
			$sumaAbonos = 0;
      $sumaC = 0;
      $Status_Cheque = 0;
		}

		//validaciones
		if( $cancela == 0 ){ $txt_cancela = "Activo"; }else{ $txt_cancela = "Cancelado"; }
		if( $oRst_permisos["s_correcciones_mst_cheques"] == 1 && $cancela == 0 ){ $mostrar = true; }else{ $mostrar = false; }
		if( $oRst_permisos["s_descancelar_cheques"] == 1 ){ $mostrarCancela = true; }else{ $mostrarCancela = false; }
		if( $cancela == 1 ){ $clase = 'class="efecto disabled readonly" disabled'; }
		if( $id_poliza > 0){
      $tienePoliza = true;
      $txt_disabled = '';
    }else{
      $tienePoliza = false;
      $txt_disabled = 'disabled';
    }
		if( $oRst_permisos["s_editar_cheques_det_pol"] == 1 && $cancela == 0 && $id_poliza > 0 ){
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
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link che" id="submenuMed" status="cerrado" accion="dtosch">DATOS DEL CHEQUE</a>
      </li>
    </ul>
  </div>

  <?php
  if( $rows > 0 ){
  ?>

  <div id="datoscheque" class="contorno mt-5" style="display:none" >
    <div class="titulo" style="width: 200px!important">DATOS DEL CHEQUE
      <?php if( $mostrar == true ){ ?>
      <a href='#ch-editarRegMST' data-toggle='modal' role='button'>
        <img class='icochico' src='/Resources/iconos/003-edit.svg'>
      </a>
      <!--a href="#" id="btn_editDatosCheMST" class="boton border-0"><img class='icochico' src='/Resources/iconos/003-edit.svg'></a-->
      <?php }?>
    </div>
    <form class="form1">
      <table class="table font14">
        <thead>
          <input type="hidden" id="usuario_activo" value="<?php echo $usuario; ?>">
          <input type="hidden" id="aduana_activa" value="<?php echo $aduana; ?>">
          <input type="hidden" id="dchIdcheque_folControl" value="<?php echo $rowMST['pk_idcheque_folControl']; ?>">
          <input type="hidden" id="dchIdcheque" value="<?php echo $rowMST['pk_id_cheque']; ?>">
          <input type="hidden" id="dchFecha" value="<?php echo $rowMST['d_fechache']; ?>">
          <input type="hidden" id="dchPoliza" value="<?php echo $rowMST['fk_id_poliza']; ?>">
          <input type="hidden" id="dchCtaMST" value="<?php echo $rowMST['fk_id_cuentaMST']; ?>">
          <input type="hidden" id="dchConcepto" value="<?php echo $rowMST['s_concepto']; ?>">
          <input type="hidden" id="dchImporte" value="<?php echo $rowMST['n_valor']; ?>">
          <input type="hidden" id="dchCliente" value="<?php echo $rowMST['fk_id_cliente_antmst']; ?>">

          <tr class="row encabezado">
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">USUARIO</td>
            <td class="col-md-1">NO.CHEQUE</td>
            <td class="col-md-2">FECHA REGISTRO</td>
            <td class="col-md-2">FECHA CHEQUE</td>
            <td class="col-md-1">OFICINA</td>
            <td class="col-md-2">IMPORTE</td>
            <td class="col-md-2">CANCELACION</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row align-items-center">
            <td class="col-md-1"><?php echo $rowMST['fk_id_poliza']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['pk_id_cheque']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fechache']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['n_valor']; ?></td>
            <td class="col-md-2">
              <?php if( $mostrarCancela == true ){ ?>
                <select class="custom-select-s" size="1" id="dchCancela" <?php echo $txt_disabled; ?>>
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
          <tr class="row sub2 mt-4 font12 justify-content-center">
            <td class="col-md-2">CUENTA</td>
            <td class="col-md-5">BENEFICIARIO</td>
            <td class="col-md-3">CONCEPTO</td>
          </tr>
          <tr class="row justify-content-center">
            <td class="col-md-2"><?php echo $rowMST['fk_id_cuentaMST']; ?></td>
            <td class="col-md-5"><?php echo $rowMST['s_nomOrd']; ?></td>
            <td class="col-md-3"><?php echo $rowMST['s_concepto']; ?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <ul class="nav row mt-5 m-0" id="myTab" role="tablist">
    <li class="nav-item col-md-4 pills">
      <a class="nav-link active" id="uno-tab" data-toggle="tab" href="#uno" role="tab" aria-controls="uno" aria-selected="true">Captura Detalle de Cheque</a>
    </li>
    <li class="nav-item col-md-4 pills">
      <a class="nav-link" id="detallecheque" data-toggle="tab" href="#dos" role="tab" aria-controls="dos" aria-selected="false">Detalle del Cheque</a>
    </li>
    <?php if( $id_poliza > 0){ ?>
      <li class="nav-item">
        <?php if( $oRst_permisos['s_consultar_ContaElect'] == 1 ){ ?>
        <a class="nav-link pills" id="infPartida" onclick="infAdd_detalle(<?php echo $id_poliza; ?>)" data-toggle="tab" href="#tres" role="tab" aria-controls="tres" aria-selected="false">Información de la Partida</a>
        <input type="hidden" id="mst-poliza" value="<?php echo $id_poliza; ?>">
        <?php } ?>
      </li>
    <?php } ?>
  </ul>



<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="uno" role="tabpanel" aria-labelledby="uno-tab">
    <div id="capturapoliza" class="contorno mt-5">
      <form class="form1">
        <table class="table font14">
          <thead>
            <tr class="row m-0 encabezado font18">
              <td class="col-md-12">CAPTURA DETALLE DE CHEQUE</td>
            </tr>
          </thead>
          <tbody>
            <tr class="row m-0 mt-5">
              <td class="col input-effect">
                <input class="efecto popup-input" id="cdchCuenta" type="text" id-display="#popup-display-cdchCuenta" action="cuentas_mst_2niv" db-id="" autocomplete="off"
                onchange="Actualiza_CuentaCapCh()">
                <div class="popup-list" id="popup-display-cdchCuenta" style="display:none"></div>
                <label for="cdchCuenta">Seleccione una Cuenta</label>
              </td>
              <td class="cdchGtoficina col-md-2 input-effect" style="display:none">
                <input class="efecto popup-input" id="cdchGtoficina" type="text" id-display="#popup-display-cdchGtoficina" action="oficinas" db-id="" autocomplete="off"
                onChange="valDescripOficinaCapCh()">
                <div class="popup-list" id="popup-display-cdchGtoficina" style="display:none"></div>
                <label for="cdchGtoficina">Gasto Oficina</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4 align-items-center">
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input" id="cdchReferencia" type="text" id-display="#popup-display-cdchReferencia" action="referencias" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cdchReferencia" style="display:none"></div>
                <label for="cdchReferencia">Referencia</label>
              </td>

              <td class="col-md-8 input-effect">
                <div id="Ch-lstClientes">
                  <input class="efecto popup-input" id="cdchCliente" type="text" id-display="#popup-display-cdchCliente" action="clientes" db-id="" autocomplete="off">
                  <div class="popup-list ls0" id="popup-display-cdchCliente" style="display:none"></div>
                  <label for="cdchCliente">Cliente</label>
                </div>
                <div id="Ch-lstClientesCorresp" style="display:none">
                  <select class="custom-select" size='1' id="cdch-ClienteCorresp">
                      <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                  </select>
                </div>
              </td>

              <td class="col-md-2" role="button">
                <a href="#detpol-buscarfacturas" class="buscarFacturas-cheques" data-toggle="modal" class="boton icochico border-0"> <img src= "/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
              </td>
            </tr>
            <tr class="cdchProveedores row m-0 mt-4" style="display:none">
              <td class="col-md-12 input-effect">
                <input class="efecto popup-input" id="cdchProveedores" type="text" id-display="#popup-display-cdchProveedores" action="proveedores" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cdchProveedores" style="display:none"></div>
                <label for="cdchProveedores">Proveedor</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-12 input-effect">
                <input  class="efecto tiene-contenido" id="cdchConcepto" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                <label for="cdchConcepto">Concepto</label>
              </td>
            </tr>

            <tr class="row m-0 mt-4">
              <td class="col-md-2 input-effect">
                <input  class="efecto"  id="cdchDocumento" onchange="validaSoloNumeros(this);">
                <label for="cdchDocumento">Documento</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input" id="cdchFactura" type="text" id-display="#popup-display-cdchFactura" action="facturas_cfdi" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cdchFactura" style="display:none"></div>
                <label for="cdchFactura">Factura</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input" id="cdchAnticipo" type="text" id-display="#popup-display-cdchAnticipo" action="anticipos_mst" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cdchAnticipo" style="display:none"></div>
                <label for="cdchAnticipo">Anticipo</label>
              </td>
              <td class="col-md-3 input-effect">
                <input class="efecto tiene-contenido" id="cdchCargo" value="0" onchange="validaIntDec(this);">
                <label for="cdchCargo">Cargo</label>
              </td>
              <td class="col-md-3 input-effect">
                <input class="efecto tiene-contenido" id="cdchAbono" value="0" onchange="validaIntDec(this);">
                <label for="cdchAbono">Abono</label>
              </td>
            </tr>
            <tr class="row mt-5">
              <td class="col-md-2 offset-md-5">
                <a href="#" id="cdch_btnRegistrar" class="boton"><img src= "/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <div class="row mt-3 justify-content-center m-0">
      <div class="col-md-2">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row justify-content-center mt-3 font14 m-0">
      <div class="col-md-2">
        <input class="efecto" id="sumCargos1_ch" value="<?php echo number_format($sumaCargos,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto" id="sumAbonos1_ch" value="<?php echo number_format($sumaC,2,'.',','); ?>"  <?php echo $txtStatus;?> readonly>
      </div>
    </div>

    <div class="contorno mt-5">
      <table class="table table-hover">
        <thead>
          <tr class="row m-0 sub3 font12 b">
            <td width="3%"></td>
            <td width="7%">CUENTA</td>
            <td width="6%">GASTO</td>
            <td width="6%">PROV</td>
            <td width="7%">REFERENCIA</td>
            <td width="7%">CLIENTE</td>
            <td width="7%">DOC</td>
            <td width="6%">FACTURA</td>
            <td width="7%">CTA GASTOS</td>
            <td width="7%">PAGO ELECT</td>
            <td width="6%">NOTACRED</td>
            <td width="7%">ANTICIPO</td>
            <td width="7%">CHEQUE</td>
            <td width="7%">CARGO</td>
            <td width="7%">ABONO</td>
            <td width="3%"></td>
          </tr>
        </thead>
        <tbody id="ultimosRegistrosCheque"></tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="dos" role="tabpanel" aria-labelledby="dos-tab">
    <div id="two"><!--DETALLE DE POLIZAS-->
      <div class="row mt-3 m-0">
        <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
        <div class="col-md-2">SUMA DE ABONOS</div>
      </div>
      <div class="row font14 align-items-center mb-4 m-0">
        <!-- <div class="col-md-3 pt-3">
          <?php if( $oRst_permisos["s_reusar_cheques"] == 1 ){ ?>
          <a href="#detpol-Sueldos" data-toggle="modal" class="boton"><img src= "/Resources/iconos/refresh-button.svg"> REUSAR CHEQUE</a>
          <?php } ?>
        </div> -->
        <div class="col-md-3">
          <?php if( $tienePoliza == false && $statusGeneraPoliza == true ){ ?>
          <a href="#" id="btn_generarPolChe" data-toggle="modal" class="boton"><img src= "/Resources/iconos/add.svg"> GENERAR POLIZA DE CHEQUE</a>
          <?php } ?>
        </div>
        <div class="col-md-2 offset-md-3">
          <?php if( $tienePoliza == true ){ ?>
          <a href="#" id="btn_printChe"  class="boton border-0"><img class="icomediano" src= "/Resources/iconos/printer.svg"></a>
          <?php } ?>
        </div>
        <div class="col-md-2">
          <input  class="efecto" id="sumCargos2_ch" value="<?php echo number_format($sumaCargos,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
        <div class="col-md-2">
          <input  class="efecto" id="sumAbonos2_ch" value="<?php echo number_format($sumaC,2,'.',','); ?>" <?php echo $txtStatus;?> readonly>
        </div>
      </div>

      <div id="detallepoliza" class="contorno mt-3">
        <table class="table table-hover">
          <thead>
            <tr class="row encabezado font18 m-0">
              <td class="col-md-12">DETALLE CHEQUE</td>
            </tr>
            <tr class="row m-0 sub3 font12 b">
              <td width="3%"></td>
              <td width="7%">CUENTA</td>
              <td width="6%">GASTO</td>
              <td width="6%">PROV</td>
              <td width="7%">REFERENCIA</td>
              <td width="7%">CLIENTE</td>
              <td width="7%">DOC</td>
              <td width="6%">FACTURA</td>
              <td width="7%">CTA GASTOS</td>
              <td width="7%">PAGO ELECT</td>
              <td width="6%">NOTACRED</td>
              <td width="7%">ANTICIPO</td>
              <td width="7%">CHEQUE</td>
              <td width="7%">CARGO</td>
              <td width="7%">ABONO</td>
              <td width="3%"></td>
            </tr>
          </thead>
          <tbody id="tabla_detallecheque"></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="tres" role="tabpanel" aria-labelledby="tres-tab">
    <?php if( $id_poliza > 0 ){
      require $root . '/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_det.php';
      } ?>
  </div>
</div>

<?php

  require_once('modales/editarDatosCheque.php');
  require_once('modales/editarRegistro.php');
  require_once('modales/buscarFacturas.php');

}else{ #$rows?>
  <div class="container-fluid pantallaGris" >
      <div class="tituloSinRegistros">NO EXISTE EL CHEQUE O ES DE OTRA OFICINA</div>
  </div>
<?php
} #$rows


require $root . '/Ubicaciones/footer.php';


?>
