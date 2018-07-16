<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $id_anticipo = $_GET['id_anticipo'];

  $sql_Select = "SELECT * from conta_t_anticipos_mst Where pk_id_anticipo = ? AND fk_id_aduana = ?";
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
	 	$oRst_STPD_sql = "select fk_id_anticipo,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS from conta_t_anticipos_det where fk_id_anticipo = ? group by fk_id_anticipo ";
		$stmtTotales = $db->prepare($oRst_STPD_sql);
		if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
		$stmtTotales->bind_param('s', $id_anticipo);
		if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
		if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
		$rsltTotales = $stmtTotales->get_result();
		$rowsTotales = $rsltTotales->num_rows;
		if( $rowsTotales > 0 ){
			$oRst_STPD = $rsltTotales->fetch_assoc();
			$sumaCargos = $oRst_STPD['SUMA_CARGOS'];
			$sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
      $sumaC = number_format($sumaCargos,2,'.','') + number_format($importeAnt,2,'.','') ;
		  $Status_Anticipo =  number_format($sumaC - $sumaAbonos,2,'.','');
      $statusGeneraPoliza = false;

      if( $Status_Anticipo == 0 ){
        $txtStatus = '<b><font face="Trebuchet MS" size="2" color="#000000">CUADRADA</font></b>';
        $statusGeneraPoliza = true;
		  }else{
				$txtStatus = '<b><font color="#E52727" face="Trebuchet MS" size="2"><?php echo $Status_Anticipo; ?> ANTICIPO SIN CUADRAR</font></b>';
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
		if( $id_poliza > 0){ $tienePoliza = true; }else{ $tienePoliza = false;}
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
  <div class="row m-0 submenuMed">
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
    <h5 class="titulo">DATOS DE ANTICIPO</h5>
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

          <tr class="row">
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_poliza']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['pk_id_anticipo']; ?></td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fecha']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['n_valor']; ?></td>
            <td class="col-md-2 pt-1">
      				<?php if( $mostrarCancela == true ){ ?>
      					<select class="custom-select-ch" size="1" id="ant-cancela">
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
    		  <tr  class="row">
			      <td class="col-md-2"><?php echo $rowMST['fk_id_cuentaMST']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_id_cliente_antmst']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['s_bancoOri'].'/'.$rowMST['s_ctaOri']; ?></td>
            <td class="col-md-6"><?php echo $rowMST['s_concepto']; ?></td>
            <td class="col-md-1">
              <?php if( $mostrar == true ){ ?>
              <!-- <a href='#ant-editarRegMST' data-toggle='modal'> -->
              <a href='#ant-editarRegMST' class='editar-anticipoMST' db-id='<?php echo $id_anticipo; ?>' role='button'>
                <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
              </a>
              <?php }?>
            </td>
          </tr>

        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE ANTICIPO-->

  <div class="movible m-4">
    <nav>
      <ul class="nav nav-pills nav-fill w-100 mt-5 mb-3">
        <li class="nav-item">
          <a class="nav-link pills">Captura Detalle de Anticipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pills" id="detalleanticipo">Detalle de Anticipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pills">Información de la Partida</a>
        </li>
      </ul>
    </nav> <!--links de desplazamiento-->
    <div class="containermov">
      <div class="contenedor-movible">
        <div id="one"><!--CAPTURA DE POLIZAS-->
          <div id="capturapoliza" class="contorno-mov">
            <table class="table form1">
              <thead>
                <tr class="row m-0 encabezado font16">
                  <td class="col-md-12">CAPTURA DETALLE DE ANTICIPO</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-5">
                  <td class="col-md-2 input-effect">
                    <input class="efecto tiene-contenido popup-input" id="ant-referencia" type="text" id-display="#popup-display-referencia" action="referencias" value="SN" db-id="SN" autocomplete="off">
                    <div class="popup-list" id="popup-display-referencia" style="display:none"></div>
                    <label for="ant-referencia">Referencia</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <div id="lstClientes">
                      <input class="efecto popup-input" id="ant-cliente" type="text" id-display="#popup-display-clientes" action="clientes" db-id="" autocomplete="off">
                      <div class="popup-list" id="popup-display-clientes" style="display:none"></div>
                      <label for="ant-cliente">Cliente</label>
                    </div>
                    <div id="lstClientesCorresp">
                      <select class="custom-select" size='1' id='ant-clienteCorresp'>
                          <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                      </select>
                    </div>
                  </td>
                  <td class="col-md-2" role="button">
                    <?php if( $mostrarEditConPol == true ){ ?>
					          <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                    <?php } ?>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-8 input-effect">
                    <div id="lstClientesCorrespCtas">
                      <select class="custom-select" size='1' id='ant-clienteCorrespCtas'>
                          <option selected value='0'>Seleccione</option>
                      </select>
                    </div>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto" id="ant-cargo">
                    <label for="ant-cargo">Cargo</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto" id="ant-abono">
                    <label for="ant-abono">Abono</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-2 offset-md-5">
                    <?php if( $mostrarEditConPol == true ){ ?>
                    <a href="#" id="btnRegDetAnt" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
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
          <div class="row">
            <div class="col-md-2 offset-md-4">
              <input class="efecto" id="sumCargos2" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
            </div>
            <div class="col-md-2">
              <input class="efecto" id="sumCargos2" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" readonly>
            </div>
            <?php
             echo $txtStatus;
             ?>
          </div>
        </div>

        <div id="two"><!--DETALLE DE ANTICIPO-->
          <div class="row">
            <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row font14">
            <div class="col-md-3 mt-3">
              <?php if( $oRst_permisos["s_reusar_anticipos"] == 1 ){ ?>
              <a href="#" id="btn_reusarAnt" class="boton"><img src= "/conta6/Resources/iconos/refresh-button.svg"> REUSAR ANTICIPO</a>
              <?php } ?>
            </div>
            <div class="col-md-3 mt-3">
              <?php if( $tienePoliza == false && $statusGeneraPoliza == true ){ ?>
              <a href="#" id="btn_generarPolAnt" class="boton"><img src= "/conta6/Resources/iconos/add.svg"> GENERAR POLIZA</a>
              <?php } ?>
            </div>
            <div class="col-md-2 mt-3">
              <?php if( $tienePoliza == true ){ ?>
              <a href="#" id="btn_prinAnt" class="boton border-0"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg"></a>
              <?php } ?>
            </div>
            <div class="col-md-2 mt-3">
              <input class="efecto" id="sumCargos1" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
            </div>
            <div class="col-md-2 mt-3">
              <input class="efecto" id="sumAbonos1" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" readonly>
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
              </thead>
              <tbody class="font16">
                <tr class="row backpink m-0">
                  <td class="p-0 pt-2 xs"></td>
                  <td class="p-0 pt-2 small">CUENTA</td>
                  <td class="p-0 pt-2 small">REFERENCIA</td>
                  <td class="p-0 pt-2 small">CLIENTE</td>
                  <td class="p-0 pt-2 small">FACTURA</td>
                  <td class="p-0 pt-2 small">CTA GASTOS</td>
		              <td class="p-0 pt-2 small">PAGO ELECT</td>
                  <td class="p-0 pt-2 small">NOTACRED</td>
                  <td class="p-0 pt-2 gde">DESCRIPCION</td>
                  <td class="p-0 pt-2 small">CARGO</td>
                  <td class="p-0 pt-2 small">ABONO</td>
                  <td class="p-0 pt-2 xs"></td>
                </tr>
                <tbody id="tabla_detalleanticipo" class="font12"></tbody>
              </tbody>
            </table>
          </div>
        </div>

        <div id="three"><!--INFORMACION DE LA PARTIDA-->
          <form class="opcion">
            <table class="table">
              <tr class="row justify-content-center">
                <td class="col-md-4">
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
            <table class="table form1">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CFD / CBB</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-4">
                  <td class="col-md-2 input-effect">
                    <input id="dpol-rfc" class="efecto" type="text">
                    <label for="dpol-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <input id="dpol-razonsocial" class="efecto" type="text">
                    <label for="dpol-razonsocial">Razón Social</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="dpol-serie" class="efecto" type="text">
                    <label for="dpol-serie">Serie</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="dpol-folio" class="efecto" type="text">
                    <label for="dpol-folio">Folio</label>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-3 input-effect">
                    <input id="dpol-subtotal" class="efecto" type="text">
                    <label for="dpol-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="dpol-iva" class="efecto" type="text">
                    <label for="dpol-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="dpol-total" class="efecto" type="text">
                    <label for="dpol-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="dpol-aplicar" class="efecto" type="text">
                    <label for="dpol-aplicar">Aplicar</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div id="capturapoliza" class="contorno-mov cfdi"><!--solo aparece al seleccionar CFDI-->
            <table class="table form1">
              <thead>
                <tr class="row encabezado m-0 font18">
                  <td class="col-md-12">CFDI</td>
                </tr>
                <tr class="row m-0 mt-3">
                  <td class="col-md-12 ">
                    <input type="file">
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
          </div>

          <div id="capturapoliza" class="contorno-mov cheque"><!--solo aparece al seleccionar CHEQUES-->
            <table class="table form1">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CHEQUES</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-4">
                  <td class="col-md-5 input-effect">
                    <input list="ch-origen" class="efecto" id="chorigen">
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
                    <input  list="numcheques" class="efecto" id="ch-cheques">
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
                    <input  list="chmoneda" class="efecto" id="ch-moneda">
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
                    <input id="ch-importe" class="efecto" type="text">
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
          </div>

          <div id="capturapoliza" class="contorno-mov compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
            <table class="table form1">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">Comprobante Extranjero</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-4">
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
                    <input  list="comext-mon" class="efecto" id="comext-moneda">
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
          </div>

          <div id="capturapoliza" class="contorno-mov otro"><!--solo aparece al seleccionar Otro-->
            <form class="form1">
              <table class="table ">
                <thead>
                  <tr class="row m-0 encabezado font18">
                    <td class="col-md-12">Otro</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row m-0 mt-4">
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
                      <input class="efecto tiene-contenido" type="date" id="otr-fecha">
                      <label for="otr-fecha">Fecha</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="otr-imp" class="efecto" type="text">
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
            <table class="table form1">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">Transferencia</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-4">
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
                    <input  list="transf-ben" class="efecto h22"  id="transf-benef">
                    <datalist id="transf-ben">
                      <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
                      <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
                    </datalist>
                    <label class="pt-1" for="transf-benef">BANCOS BENEFICIARIOS</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <input  list="transf-cli" class="efecto h22"  id="transf-clientes">
                    <datalist id="transf-cli">
                      <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
                      <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
                    </datalist>
                    <label class="pt-1" for="transf-clientes">BANCOS CLIENTES</label>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-6 input-effect">
                    <input  list="transf-emp" class="efecto h22"  id="transf-empleados">
                    <datalist id="transf-emp">
                      <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
                      <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
                    </datalist>
                    <label class="pt-1" for="transf-empleados">EMPLEADOS</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <input  list="transf-prov" class="efecto h22"  id="transf-proveedores">
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
                    <input class="border-0 pt-1" type="text" value="012">
                  </td>
                  <td class="col-md-4">
                    <input class="efecto h22" type="text" value="012821011521461544">
                  </td>
                  <td class="col-md-5">
                    <input  class="efecto h22" type="text" value="Martinez Martinez">
                  </td>
                  <td class="col-md-2">
                    <input class="efecto h22" type="text" value="MAMD800330DQ3">
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
                <tr class="row m-0 mt-3">
                  <td class="col-md-12 sub">Origen</td>
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
                <tr class="row m-0">
                  <td class="col-md-12 sub">Destino</td>
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
                  <td class="col-md-3">
                    <input id="trans-emext" class="efecto h22" type="text">
                    <label class="pt-1" for="trans-emext">Bco. Emisor Extranjero</label>
                  </td>

                  <td class="col-md-3">
                    <input id="trans-desext" class="efecto h22" type="text">
                    <label class="pt-1" for="trans-desext">Bco. Destino Extranjero</label>
                  </td>
                  <td class="col-md-2">
                    <input id="trans-tc" class="efecto h22" type="text">
                    <label class="pt-1" for="trans-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-4">
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
                  <td class="col-md-3">
                    <input class="efecto h22 tiene-contenido" type="date" id="trans-fecha">
                    <label class="pt-1" for="trans-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2">
                    <input id="trans-imp" class="efecto h22" type="text">
                    <label class="pt-1" for="trans-imp">Importe</label>
                  </td>
                  <td class="col-md-7">
                    <input id="trans-observ" class="efecto h22" type="text">
                    <label class="pt-1" for="trans-observ">Observaciones</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <table class="table-hover mt-4">
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
                <td>
                  <a href="">
                    <img class="icochico" src="/conta6/Resources/iconos/001-add.svg">
                  </a>
                </td>
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
                    <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
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


<?PHP
require $root . '/conta6/Ubicaciones/footer.php';
  require_once('modales/editarDatosAnticipo.php');
  require_once('modales/editarRegistro.php');
  require_once('modales/buscarFacturasAnt.php');



}else{ #$rows?>
	<br><br>
	<p align="center"><u>
	<font face="Trebuchet MS" size="2" align="center" >NO EXISTE EL ANTICIPO O ES DE OTRA OFICINA</font></u></p>
	<p align="center">&nbsp;</p>
<?php
} #$rows
?>
