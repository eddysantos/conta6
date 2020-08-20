<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_cheque = $_GET['id_cheque'];
  $id_cuentaMST = $_GET['id_cuentaMST'];

  $sql_Select = "SELECT * from conta_t_cheques_mst Where pk_id_cheque = ? AND fk_id_cuentaMST = ?";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

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
      $statusGeneraPoliza = false;

      if( $Status_Cheque == 0 ){
        $txtStatus = '<b><font face="Trebuchet MS" size="2" color="#000000">CUADRADA</font></b>';
        $statusGeneraPoliza = true;
		  }else{
				$txtStatus = '<b><font color="#E52727" face="Trebuchet MS" size="2"><?php echo $Status_Cheque; ?> CHEQUE SIN CUADRAR</font></b>';
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
		if( $id_poliza > 0){ $tienePoliza = true; }else{ $tienePoliza = false;}
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

  <div id="datoscheque" class="contorno mt-5" style="display:none" ><!--Comienza DETALLE DATOS DE CHEQUE-->
    <!-- style="display:none" -->
    <h5 class="titulo">DATOS DEL CHEQUE
      <?php if( $mostrar == true ){ ?>
      <a href='#ch-editarRegMST' data-toggle='modal' role='button'>
        <img class='icochico' src='/Resources/iconos/003-edit.svg'>
      </a>
      <!--a href="#" id="btn_editDatosCheMST" class="boton border-0"><img class='icochico' src='/Resources/iconos/003-edit.svg'></a-->
      <?php }?>
    </h5>
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
            <td class="col-md-1">IMPORTE</td>
            <td class="col-md-1">CANCELACION</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row">
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_poliza']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['pk_id_cheque']; ?></td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fechache']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['n_valor']; ?></td>
            <td class="col-md-2 pt-1">
      				<?php if( $mostrarCancela == true ){ ?>
      					<select class="custom-select-s" size="1" id="dchCancela">
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
          <tr class="row sub2 mt-4 font12">
            <td class="col-md-1">CUENTA</td>
            <td class="col-md-6">BENEFICIARIO</td>
            <td class="col-md-3">CONCEPTO</td>
          </tr>
          <tr class="row">
            <td class="col-md-1 p-0 pt-2"><?php echo $rowMST['fk_id_cuentaMST']; ?></td>
            <td class="col-md-6"><?php echo $rowMST['s_nomOrd']; ?></td>
            <td class="col-md-3"><?php echo $rowMST['s_concepto']; ?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->


  <div class="container-fluid movible mt-5">
    <nav>
      <ul class="nav nav-pills nav-fill w-100 m-15 font14">
        <li class="nav-item">
          <a href="#" class="nav-link">Captura Detalle de Cheque</a>
        </li>
        <li class="nav-item">
          <a href="#" id="detallecheque" class="nav-link">Detalle del Cheque</a>
        </li>
        <?php if( $id_poliza > 0  ){ ?>
        <li class="nav-item">
          <a href="#" class="nav-link">Información Adicional</a>
        </li>
        <?php } ?>
      </ul>
    </nav> <!--links de desplazamiento-->
    <div class="containermov">
      <div class="contenedor-movible">
        <div id="one"><!--CAPTURA DE POLIZAS-->
          <div id="capturapoliza" class="contorno-mov mt-5">
            <form class="form1">
              <table class="table font14">
                <thead>
                  <tr class="row m-0 encabezado font18">
                    <td class="col-md-12">CAPTURA DETALLE DE CHEQUE</td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row m-0 mt-5">
                    <td class="col-md-10 input-effect">
                      <input class="efecto popup-input" id="cdchCuenta" type="text" id-display="#popup-display-cdchCuenta" action="cuentas_mst_2niv" db-id="" autocomplete="new-password"
                      onchange="Actualiza_CuentaCapCh()">
                      <div class="popup-list" id="popup-display-cdchCuenta" style="display:none"></div>
                      <label for="cdchCuenta">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="cdchGtoficina" type="text" id-display="#popup-display-cdchGtoficina" action="oficinas" db-id="" autocomplete="new-password"
                      onChange="valDescripOficinaCapCh()">
                      <div class="popup-list" id="popup-display-cdchGtoficina" style="display:none"></div>
                      <label for="detpol-cdchGtoficina">Gasto Oficina</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-10 input-effect">
                      <input class="efecto popup-input" id="cdchCliente" type="text" id-display="#popup-display-cdchCliente" action="clientes" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-cdchCliente" style="display:none"></div>
                      <label for="cdchCliente">Cliente</label>
                    </td>
                    <td class="col-md-2" role="button">
                      <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton border-0"> <img src= "/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input class="efecto popup-input" id="cdchProveedores" type="text" id-display="#popup-display-cdchProveedores" action="proveedores" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-cdchProveedores" style="display:none"></div>
                      <label for="cdchProveedores">Proveedor</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input  class="efecto" id="cdchConcepto" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                      <label for="cdchConcepto">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="cdchReferencia" type="text" id-display="#popup-display-cdchReferencia" action="referencias" db-id="" autocomplete="new-password"
                      onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaReferencia(this);">
                      <div class="popup-list" id="popup-display-cdchReferencia" style="display:none"></div>
                      <label for="cdchReferencia">Referencia</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="cdchDocumento" onchange="validaSoloNumeros(this);">
                      <label for="cdchDocumento">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="cdchFactura" type="text" id-display="#popup-display-cdchFactura" action="facturas_cfdi" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-cdchFactura" style="display:none"></div>
                      <label for="cdchFactura">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="cdchAnticipo" type="text" id-display="#popup-display-cdchAnticipo" action="anticipos_mst" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-cdchAnticipo" style="display:none"></div>
                      <label for="detpol-cdchAnticipo">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto tiene-contenido" id="cdchCargo" value="0" onchange="validaIntDec(this);">
                      <label for="cdchCargo">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect">
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
          <div class="row mt-3">
            <div class="col-md-2 offset-md-4">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row mt-3">
            <div class="col-md-2 offset-md-4">
              <input class="efecto" id="sumCargos1_ch" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2">
              <input class="efecto" id="sumAbonos1_ch" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
            </div>
          </div>
        </div>

        <div id="two"><!--DETALLE DE POLIZAS-->
          <div class="row mt-3">
            <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row font14">
            <div class="col-md-3 pt-3">
              <?php if( $oRst_permisos["s_reusar_cheques"] == 1 ){ ?>
              <a href="#detpol-Sueldos" data-toggle="modal" class="boton"><img src= "/Resources/iconos/refresh-button.svg"> REUSAR CHEQUE</a>
              <?php } ?>
            </div>
            <div class="col-md-3 pt-3">
              <?php if( $tienePoliza == false && $statusGeneraPoliza == true ){ ?>
              <a href="#" id="btn_generarPolChe" data-toggle="modal" class="boton"><img src= "/Resources/iconos/add.svg"> GENERAR POLIZA DE CHEQUE</a>
              <?php } ?>
            </div>
            <div class="col-md-2 pt-3">
              <?php if( $tienePoliza == true ){ ?>
              <a href="#" id="btn_printChe"  class="boton border-0"><img class="icomediano" src= "/Resources/iconos/printer.svg"></a>
              <?php } ?>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" id="sumCargos2_ch" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" id="sumAbonos2_ch" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
            </div>
          </div>

          <div id="detallepoliza" class="contorno-mov mt-3">
            <table class="table table-hover">
              <thead class="font18">
                <tr class="row encabezado m-0">
                  <td class="col-md-12">DETALLE CHEQUE</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 backpink">
                  <td class="xs"></td>
                  <td class="small">CUENTA</td>
                  <td class="small">GASTO</td>
                  <td class="small">PROV</td>
                  <td class="small">REFERENCIA</td>
                  <td class="small">CLIENTE</td>
                  <td class="small">DOCUMENTO</td>
                  <td class="small">FACTURA</td>
                  <td class="small">CTA GASTOS</td>
                  <td class="small">PAGO ELECT</td>
                  <td class="small">NOTACRED</td>
                  <td class="small">ANTICIPO</td>
                  <td class="med">DESCRIPCION</td>
                  <td class="small">CARGO</td>
                  <td class="small">ABONO</td>
                  <td class="xs"></td>
                </tr>
                <tbody id="tabla_detallecheque"></tbody>
                <!--tr class="row m-0 borderojo pt-3 pb-2 p-0">
                  <td class="xs p-0">
                    <a href="">
                      <img class="icochico" src="/Resources/iconos/002-trash.svg">
                    </a>
                  </td>
                  <td class="small p-0">0110-00001</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">CLT_7118</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="small p-0">2222</td>
                  <td class="med p-0">T.DE LA FED.PTO.7003459</td>
                  <td class="small p-0">111,133,299</td>
                  <td class="small p-0">33,299</td>
                  <td class="xs p-0">
                    <a href="#editarRegCheque" data-toggle="modal">
                      <img class="icochico" src="/Resources/iconos/003-edit.svg">
                    </a>
                  </td>
                </tr-->
              </tbody>
            </table>
          </div>
        </div>

        <div id="three"><!--INFORMACION DE LA PARTIDA-->
          <form class="opcion">
            <table class="table">
              <tr class="row">
                <td class="col-md-4 offset-md-4">
                  <select class="custom-select" id="opcionespolizas">
                    <option >Selecciona</option>
                    <option value="1">CFD/CBB</option>
                    <option value="2">CFDI</option>
                    <option value="3">Cheque</option>
                    <option value="4">Comprobante Extranjero</option>
                    <option value="5">Otro</option>
                    <option value="6">Transferencia</option>
                  </select>
                </td>
              </tr>
            </table>
          </form>
          <div id="capturapoliza" class="contorno-mov cfdcbb"><!--solo aparece al seleccionar CFD / CBB-->
            <form class="form1">
              <table class="table">
                <thead>
                  <tr class="row m-0 encabezado font18">
                    <td class="col-md-12">CFD / CBB</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-4">
                    <td class="col-md-2 input-effect">
                      <input id="dch_rfc" class="efecto" type="text">
                      <label for="dch_rfc">RFC</label>
                    </td>
                    <td class="col-md-6 input-effect">
                      <input id="dch_razonsocial" class="efecto" type="text">
                      <label for="dch_razonsocial">Razón Social</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="dch_serie" class="efecto" type="text">
                      <label for="dch_serie">Serie</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="dch_folio" class="efecto" type="text">
                      <label for="dch_folio">Folio</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="dch_subtotal" class="efecto" type="text">
                      <label for="dch_subtotal">Subtotal</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="dch_iva" class="efecto" type="text">
                      <label for="dch_iva">IVA</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="dch_total" class="efecto" type="text">
                      <label for="dch_total">Total</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="dch_aplicar" class="efecto" type="text">
                      <label for="dch_aplicar">Aplicar</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <div id="capturapoliza" class="contorno-mov cfdi"><!--solo aparece al seleccionar CFDI-->
            <form class="form1">
              <table class="table">
                <thead class="font18">
                  <tr class="row encabezado m-0">
                    <td class="col-md-12">CFDI</td>
                  </tr>
                  <tr class="row m-0 mt-3">
                    <td class="col-md-12">
                      <input class="" type="file">
                    </td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-3">
                    <td class="col-md-2 input-effect">
                      <input id="cfdi-rfc" class="efecto" type="text">
                      <label for="cfdi-rfc">RFC</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input id="cfdi-razonsocial" class="efecto" type="text">
                      <label for="cfdi-razonsocial">Nombre / Razón Social</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input id="cfdi-uuid" class="efecto" type="text">
                      <label for="cfdi-uuid">UUID</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="cfdi-subtotal" class="efecto" type="text">
                      <label for="cfdi-subtotal">Subtotal</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="cfdi-iva" class="efecto" type="text">
                      <label for="cfdi-iva">IVA</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="cfdi-total" class="efecto" type="text">
                      <label for="cfdi-total">Total</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="cfdi-aplicar" class="efecto" type="text">
                      <label for="cfdi-aplicar">Aplicar</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <div id="capturapoliza" class="contorno-mov cheque"><!--solo aparece al seleccionar CHEQUES-->
            <form class="form1">
              <table class="table">
                <thead class="font18">
                  <tr class="row m-0 encabezado">
                    <td class="col-md-12">CHEQUES</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-5">
                    <td class="col-md-5 input-effect">
                      <input  list="ch-origen" class="efecto"  id="chorigen">
                      <datalist id="ch-origen">
                        <option value="Banamex - 002 - 7658424"></option>
                        <option value="Banamex - 002 - 79033561"></option>
                        <option value="Banamex - 002 - 7355485"></option>
                        <option value="Bancomer - 012 - 0192655497"></option>
                      </datalist>
                      <label for="chorigen">Seleccione una Cuenta (Origen)</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="ch-banco" class="efecto tiene-contenido" type="text" value="002">
                      <label for="ch-banco">Banco</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="ch-ncuenta" class="efecto tiene-contenido" type="text" value="7865432">
                      <label for="ch-ncuenta">No.Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  list="numcheques" class="efecto"  id="ch-cheques">
                      <datalist id="numcheques">
                        <option value="3421"></option>
                        <option value="3422"></option>
                        <option value="3423"></option>
                        <option value="3424"></option>
                      </datalist>
                      <label for="ch-cheques">Cheques</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-5 input-effect">
                      <input id="ch-emextran" class="efecto" type="text">
                      <label for="ch-emextran">Emisor Extranjero</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="ch-tc" class="efecto" type="text">
                      <label for="ch-tc">Tipo de Cambio</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input  list="chmoneda" class="efecto"  id="ch-moneda">
                      <datalist id="chmoneda">
                        <option value="Peso Mexicano -- MXN"></option>
                        <option value="Boliviano -- BOB"></option>
                        <option value="Peso Cubano -- CUP"></option>
                        <option value="Peso Filipino -- PHP"></option>
                      </datalist>
                      <label for="ch-moneda">Moneda</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-1 input-effect">
                      <input id="ch-cheque1" class="efecto" type="text">
                      <label for="ch-cheque1">Cheque</label>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="ch-importe" class="efecto" type="text" onchange="validaSoloNumeros(this)">
                      <label for="ch-importe">Importe</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input class="efecto tiene-contenido" type="date" id="ch-fecha">
                      <label for="ch-fecha">Fecha</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="ch-rfcbenef" class="efecto" type="text">
                      <label for="ch-rfcbenef">RCF</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input id="ch-nombrebenef" class="efecto" type="text">
                      <label for="ch-nombrebenef">Nombre Beneficiario</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <div id="capturapoliza" class="contorno-mov compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
            <form class="form1">
              <table class="table">
                <thead class="font18">
                  <tr class="row m-0 encabezado">
                    <td class="col-md-12">Comprobante Extranjero</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-5">
                    <td class="col-md-4 input-effect">
                      <input id="comext-tax" class="efecto" type="text">
                      <label for="comext-tax">Tax ID</label>
                    </td>
                    <td class="col-md-8 input-effect">
                      <input id="comext-razsocial" class="efecto" type="text">
                      <label for="comext-razsocial">Nombre / Razón Social</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="comext-fact" class="efecto" type="text">
                      <label for="comext-fact">Número de Factura</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input  list="comext-mon" class="efecto"  id="comext-moneda">
                      <datalist id="comext-mon">
                        <option value="Peso Mexicano -- MXN"></option>
                        <option value="Peso Cubano -- CUP"></option>
                        <option value="Boliviano -- BOB"></option>
                        <option value="Peso Filipino -- PHP"></option>
                      </datalist>
                      <label for="comext-moneda">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="comext-tc" class="efecto" type="text">
                      <label for="comext-tc">Tipo de Cambio</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="comext-total" class="efecto" type="text">
                      <label for="comext-total">Total</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <div id="capturapoliza" class="contorno-mov otro"><!--solo aparece al seleccionar Otro-->
            <form class="form1">
              <table class="table">
                <thead class="font18">
                  <tr class="row m-0 encabezado">
                    <td class="col-md-12">Otro</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-5">
                    <td class="col-md-3 input-effect">
                      <input  list="otr-metpago" class="efecto"  id="otr-pago">
                      <datalist id="otr-metpago">
                        <option value="Bienes -- 09"></option>
                        <option value="Cancelacion -- 16"></option>
                        <option value="Compesacion -- 17"></option>
                        <option value="Dacion en Pago -- 12"></option>
                      </datalist>
                      <label for="otr-pago">Metodo Pago</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="otr-rfc" class="efecto" type="text">
                      <label for="otr-rfc">RFC</label>
                    </td>
                    <td class="col-md-6 input-effect">
                      <input id="otr-benef" class="efecto" type="text">
                      <label for="otr-benef">Beneficiario</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input class="efecto" type="date" id="otr-fecha">
                      <label for="otr-fecha">Fecha</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="otr-imp" class="efecto" type="text" onchange="validaSoloNumeros(this)">
                      <label for="otr-imp">Importe</label>
                    </td>
                    <td class="col-md-5 input-effect">
                      <input  list="otr-mon" class="efecto"  id="otr-moneda">
                      <datalist id="otr-mon">
                        <option value="Peso Mexicano -- MXN"></option>
                        <option value="Boliviano -- BOB"></option>
                        <option value="Peso Cubano -- CUP"></option>
                        <option value="Peso Filipino -- PHP"></option>
                      </datalist>
                      <label for="otr-moneda">Moneda</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="otr-tc" class="efecto" type="text">
                      <label for="otr-tc">Tipo de Cambio</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <div id="capturapoliza" class="contorno-mov transferencia"><!--solo aparece al seleccionar Transferencia-->
            <form class="form1">
              <table class="table">
                <thead class="font18">
                  <tr class="row m-0 encabezado">
                    <td class="col-md-12">Transferencia</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-5">
                    <td class="col-md-6 input-effect">
                      <input  list="transf-bsat" class="efecto h22"  id="transf-bancossat">
                      <datalist id="transf-bsat">
                        <option value="Afirme"></option>
                        <option value="American Express"></option>
                        <option value="Azteca"></option>
                        <option value="Banamex"></option>
                        <option value="Bancopel"></option>
                      </datalist>
                      <label class="pt-1" for="transf-bancossat">BANCOS SAT</label>
                    </td>

                    <td class="col-md-6 input-effect">
                      <input  list="transf-bplaa" class="efecto h22"  id="transf-bancosplaa">
                      <datalist id="transf-bplaa">
                        <option value="BBVA BANCOMER -- 0109722246 -- 430"></option>
                        <option value="BBVA BANCOMER -- 0166627773 -- 430"></option>
                        <option value="BBVA BANCOMER -- 0166795056 -- 160"></option>
                        <option value="BBVA BANCOMER -- 166721346 -- 470"></option>
                        <option value="BBVA BANCOMER -- 0192655497 -- 240"></option>
                      </datalist>
                      <label class="pt-1" for="transf-bancosplaa">BANCOS PLAA</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-6 input-effect">
                      <input  list="transf-ben" class="efecto"  id="transf-benef">
                      <datalist id="transf-ben">
                        <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
                        <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
                      </datalist>
                      <label class="pt-1" for="transf-benef">BANCOS BENEFICIARIOS</label>
                    </td>
                    <td class="col-md-6 input-effect">
                      <input  list="transf-cli" class="efecto"  id="transf-clientes">
                      <datalist id="transf-cli">
                        <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
                        <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
                      </datalist>
                      <label class="pt-1" for="transf-clientes">BANCOS CLIENTES</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-6 input-effect">
                      <input  list="transf-emp" class="efecto"  id="transf-empleados">
                      <datalist id="transf-emp">
                        <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
                        <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
                      </datalist>
                      <label class="pt-1" for="transf-empleados">EMPLEADOS</label>
                    </td>

                    <td class="col-md-6 input-effect">
                      <input  list="transf-prov" class="efecto"  id="transf-proveedores">
                      <datalist id="transf-prov">
                        <option value="Control Integrado de Tratamiendos Cuarentenarios y Plagas S.A de C.V -- CIT0010198Y0 -- 012821001069756749"></option>
                        <option value="Banco Monex S.A Institución de Banca Multiple, Mone Grupo Financiero -- BMI9704113pa -- 6580894"></option>
                      </datalist>
                      <label class="pt-1" for="transf-proveedores">PROVEEDORES</label>
                    </td>
                  </tr>
                  <tr class="row m-0 backpink mt-3">
                    <th class="col-md-1">BANCO</th>
                    <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                    <th class="col-md-5">NOMBRE / RAZON SOCIAL</th>
                    <th class="col-md-2">RFC</th>
                  </tr>
                  <tr class="row m-0">
                    <td class="col-md-1">
                      <input class="border-0" type="text" value="012">
                    </td>
                    <td class="col-md-4">
                      <input class="efecto h22 p-1" type="text" value="012821011521461544">
                    </td>
                    <td class="col-md-5">
                      <input  class="efecto h22 p-1" type="text" value="Martinez Martinez">
                    </td>
                    <td class="col-md-2">
                      <input class="efecto h22 p-1" type="text" value="MAMD800330DQ3">
                    </td>
                  </tr>
                  <tr class="row m-0 mt-3">
                    <td class="col-md-4"></td>
                    <td class="col-md-2">
                      <button  type="button" class="boton">
                        <i class="fa fa-plus-circle"></i> ORIGEN
                      </button>
                    </td>
                    <td class="col-md-2">
                      <button  type="button" class="boton">
                        <i class="fa fa-plus-circle"></i> DESTINO
                      </button>
                    </td>
                    <td class="col-md-4"></td>
                  </tr>
                  <tr class="row m-0 mt-3 sub">
                    <td class="col-md-12">Origen</td>
                  </tr>
                  <tr class="row m-0 sub2">
                    <th class="col-md-1">BANCO</th>
                    <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                    <th class="col-md-4">NOMBRE / RAZON SOCIAL (opcional)</th>
                    <th class="col-md-3">RFC (opcional)</th>
                  </tr>
                  <tr class="row m-0">
                    <td class="col-md-1">
                      <input class="border-0" type="text" value="012">
                    </td>
                    <td class="col-md-4">
                      <input class="efecto h22" type="text" value="012821011521461544">
                    </td>
                    <td class="col-md-4">
                      <input  class="efecto h22" type="text" value="Martinez Martinez">
                    </td>
                    <td class="col-md-3">
                      <input class="efecto h22" type="text" value="MAMD800330DQ3">
                    </td>
                  </tr>
                  <tr class="row m-0 sub">
                    <td class="col-md-12">Destino</td>
                  </tr>
                  <tr class="row m-0 sub2">
                    <th class="col-md-1">BANCO</th>
                    <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                    <th class="col-md-4">NOMBRE / RAZON SOCIAL</th>
                    <th class="col-md-3">RFC</th>
                  </tr>
                  <tr class="row m-0">
                    <td class="col-md-1">
                      <input class="border-0" type="text" value="012">
                    </td>
                    <td class="col-md-4">
                      <input class="efecto h22" type="text" value="012821011521461544">
                    </td>
                    <td class="col-md-4">
                      <input  class="efecto h22" type="text" value="Martinez Martinez">
                    </td>
                    <td class="col-md-3">
                      <input class="efecto h22" type="text" value="MAMD800330DQ3">
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="trans-emext" class="efecto h22" type="text">
                      <label class="pt-1" for="trans-emext">Bco. Emisor Extranjero</label>
                    </td>

                    <td class="col-md-3 input-effect">
                      <input id="trans-desext" class="efecto h22" type="text">
                      <label class="pt-1" for="trans-desext">Bco. Destino Extranjero</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="trans-tc" class="efecto h22" type="text">
                      <label class="pt-1" for="trans-tc">Tipo de Cambio</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input  list="trans-mon" class="efecto h22"  id="trans-moneda">
                      <datalist id="trans-mon">
                        <option value="Peso Mexicano -- MXN"></option>
                        <option value="Boliviano -- BOB"></option>
                        <option value="Peso Cubano -- CUP"></option>
                        <option value="Peso Filipino -- PHP"></option>
                      </datalist>
                      <label class="pt-1" for="trans-moneda">Moneda</label>
                    </td>
                  </tr>
                  <tr class="row m-0 mt-4">
                    <td class="col-md-3 input-effect">
                      <input class="efecto h22 tiene-contenido" type="date" id="trans-fecha">
                      <label class="pt-1" for="trans-fecha">Fecha</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="trans-imp" class="efecto h22" type="text" onchange="validaSoloNumeros(this)">
                      <label class="pt-1" for="trans-imp">Importe</label>
                    </td>
                    <td class="col-md-7 input-effect">
                      <input id="trans-observ" class="efecto h22" type="text">
                      <label class="pt-1" for="trans-observ">Observaciones</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

          <table class="mt-4 table-hover">
            <tbody>
              <tr class="table-bordered sub">
                <th colspan="3"></th>
                <th>Tipo</th>
                <th colspan="4">Cuenta</th>
                <th colspan="10">Descripcion</th>
                <th colspan="2">Cargo</th>
                <th colspan="2">Abono</th>
                <th></th>
              </tr>
              <tr>
                <td colspan="3"></td>
                <td>4</td>
                <td colspan="4">0206-00929</td>
                <td colspan="10">Servicio Ancira Garza S.A de C.V</td>
                <td colspan="2">$ 3,000</td>
                <td colspan="2">0.00</td>
                <td><a href=""><img class="icochico" src="/Resources/iconos/001-add.svg"></a></td>
              </tr>
              <tr class="table-bordered sub">
                <th colspan="3"></th>
                <th colspan="2">Origen</th>
                <th colspan="2">Destino</th>
                <th colspan="8">Documento Nacional</th>
                <th colspan="2">Extranjero</th>
                <th colspan="3">Doc.Extranjero</th>
                <th colspan="3">Opcionales</th>
              </tr>

              <tr class="backpink">
                <th colspan="2"></th>
                <th>Metodo</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th>UUID</th>
                <th>Cheque</th>
                <th>Serie</th>
                <th>CFD/CBB</th>
                <th>Razon Social</th>
                <th>RFC</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th>TaxID</th>
                <th>Moneda</th>
                <th>TC</th>
                <th>&nbsp;&nbsp;Beneficiario&nbsp;&nbsp;</th>
                <th>RFC</th>
                <th>Obser</th>
              </tr>
              <tr class="borderojo">
                <td colspan="2">
                  <a href="">
                    <img class="icochico" src="/Resources/iconos/002-trash.svg">
                  </a>
                </td>
                <td>CompNal</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>0084882-k202-op01-2344826181903kj</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>SAG950408LE8</td>
                <td></td>
                <td>$3,000</td>
                <td></td>
                <td></td>
                <td></td>
                <td>MXN</td>
                <td>1</td>
                <td>Servicio Ancira Garza S.A de C.V</td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div><!--Termina desplazamiento numero 3-->
      </div><!--/Termina contenedor-movible-->
    </div><!--/Termina continermov-->
  </div><!--/Termina container-fluid movible-->
</div>

<?php

  require_once('modales/editarDatosCheque.php');
  require_once('modales/editarRegistro.php');
  require_once('modales/buscarFacturas.php');

}else{ #$rows?>
  <div class="container-fluid pantallaGris">
      <div class="tituloSinRegistros">NO EXISTE EL CHEQUE O ES DE OTRA OFICINA</div>
  </div>
<?php
} #$rows


require $root . '/Ubicaciones/footer.php';


?>
