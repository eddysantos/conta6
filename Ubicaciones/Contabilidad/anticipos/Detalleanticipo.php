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

		$cancela = $rowMST['s_cancela'];
		if( $cancela == 0 ){ $txt_cancela = "Activo"; }else{ $txt_cancela = "Cancelado"; }

		if( $oRst_permisos["s_correcciones_mst_anticipos"] == 1 && $cancela == 0 ){
			$mostrar = true;
		}else{
			$mostrar = false;
		}

		if( $cancela == 1 ){ $clase = 'class="efecto disabled readonly" disabled'; $claseAdmin = 'class="efecto disabled readonly" disabled'; }



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
		}else{
			$sumaCargos = 0;
			$sumaAbonos = 0;
		}





	}
?>

<div class="text-center mb-10">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link visualizar" id="submenuMed" status="cerrado" accion="dtosant">DATOS DE ANTICIPO</a>
      </li>
    </ul>
  </div>
<?php
if( $rows > 0 ){
?>
<input type="hidden" id="usuario_activo" value="<?php echo $usuario; ?>">
<input type="hidden" id="aduana_activa" value="<?php echo $aduana; ?>">

  <!--Comienza DETALLE DATOS DE POLIZA-->
  <div id="datosanticipo" class="contorno" >
  <!--style="display:none"-->
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

          <tr class="row">
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_poliza']; ?>
              <!-- <input class="h22 efecto disabled readonly" id="ant-poliza" type="text" db-id="" autocomplete="new-password" disabled value=""> -->
            </td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['pk_id_anticipo']; ?>
              <!-- <input class="h22 efecto disabled readonly" id="id_anticipo" type="text" db-id="" autocomplete="new-password" disabled value=""> -->
            </td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-2 pt-3"><?php echo $rowMST['d_fecha']; ?>
            </td>
            <td class="col-md-1 pt-3"><?php echo $rowMST['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['n_valor']; ?></td>
            <td class="col-md-2 pt-1">
      				<?php if( $mostrar == true ){ ?>
      					<select class="custom-select-ch" size="1" name="ant-cancela" id="ant-cancela" onchange="cambiarStatus()">
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
            <td class="col-md-1"><?php echo $rowMST['fk_id_cliente']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['s_bancoOri'].'/'.$rowMST['s_ctaOri']; ?></td>
            <td class="col-md-6"><?php echo $rowMST['s_concepto']; ?></td>
            <td class="col-md-1">
              <a href='#ant-editarRegMST' data-toggle='modal' db-id='$partida' role='button'>
                <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
              </a>
            </td>
          </tr>
		      <?php if( $mostrar == true ){ ?><?php }?>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <div class="movible container-fluid">
    <nav>
      <ul class="nav nav-pills nav-fill w-100 mt-5 mb-3">
        <li class="nav-item">
          <a class="nav-link pills">Captura Detalle de Anticipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pills">Detalle de Anticipo</a>
        </li>
      </ul>
    </nav> <!--links de desplazamiento-->
    <div class="containermov">
      <div class="contenedor-movible">
        <div id="one"><!--CAPTURA DE POLIZAS-->
          <div id="capturapoliza" class="contorno-mov">
            <table class="table form1 ">
              <thead>
                <tr class="row m-0 encabezado font16">
                  <td class="col-md-12">CAPTURA DETALLE DE ANTICIPO</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-5">
                  <td class="col-md-2 input-effect">
                    <input  class="efecto" id="ant-referencia">
                    <label for="ant-referencia">Referencia</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <input  list="ant-cli" class="efecto" id="ant-clientes">
                    <datalist id="ant-cli">
                      <option value="REPRESENTACIONES ASESORIA MANTENIMIENTO Y SERVICIOS ANEXOS S.A DE C.V -- CLT_6921"></option>
                      <option value="SERVICIOS INTEGRALES EEN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA S.C -- CLT_7596"></option>
                      <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                      <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                    </datalist>
                    <label for="ant-clientes">Seleccione un Cliente</label>
                  </td>
                  <td class="col-md-2" role="button">
                    <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-8 input-effect">
                    <input  list="ant-cta" class="efecto"  id="ant-cuenta2">
                    <datalist id="ant-cta">
                      <option value="0108-06967 -- MOTORES FRANKLIN S.A DE C.V"></option>
                      <option value="0207-00004 -- CUENTAS AMERICANAS"></option>
                      <option value="0207-00005 -- TRANSFER"></option>
                      <option value="0208-06967 -- MOTORES FRANKLIN S.A DE CV"></option>
                    </datalist>
                    <label for="ant-cuenta2">Seleccione una Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto"  id="ant-cargo">
                    <label for="ant-cargo">Cargo</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto"  id="ant-abono">
                    <label for="ant-abono">Abono</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-2 offset-md-5">
                    <a href="" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
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
              <input  class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2">
              <input  class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
            </div>
          </div>
        </div>

        <div id="two" class=""><!--DETALLE DE POLIZAS-->
          <div class="row">
            <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row font14">
            <div class="col-md-3 mt-3">
              <a href="#" class="boton"><img src= "/conta6/Resources/iconos/refresh-button.svg"> ACTUALIZAR ANTICIPO</a>
            </div>
            <div class="col-md-3 mt-3">
              <a href="#" class="boton"><img src= "/conta6/Resources/iconos/add.svg"> GENERAR ANTICIPO</a>
            </div>
            <div class="col-md-2 mt-3">
              <a href="#" class="boton border-0"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg"></a>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
            </div>
          </div>

          <div id="detallepoliza" class="contorno-mov mt-4">
            <table class="table table-hover">
              <thead>
                <tr class="row encabezado font16 m-0">
                  <td class="col-md-12">DETALLE ANTICIPO</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row backpink m-0">
                  <td class="xs"></td>
                  <td class="sm">CUENTA</td>
                  <td class="sm">REFERENCIA</td>
                  <td class="sm">CLIENTE</td>
                  <td class="sm">FACTURA</td>
                  <td class="sm">NOTACRED</td>
                  <td class="sm">ANTICIPO</td>
                  <td class="med">DESCRIPCION</td>
                  <td class="sm">CARGO</td>
                  <td class="sm">ABONO</td>
                  <td class="xs"></td>
                </tr>

                <tr class="row m-0 borderojo">
                  <td class="xs">
                    <a href=""><img class="icochico" src="/conta6/Resources/iconos/002-trash.svg"></a>
                  </td>
                  <td class="sm">0110-00001</td>
                  <td class="sm">N17008098</td>
                  <td class="sm">CLT_7118</td>
                  <td class="sm">2222</td>
                  <td class="sm">2222</td>
                  <td class="sm">2222</td>
                  <td class="med">T.DE LA FED.PTO.7003459</td>
                  <td class="sm">111,133,299</td>
                  <td class="sm">33,299</td>
                  <td class="xs">
                    <a href="#detpol-editar" data-toggle="modal">
                      <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><!--/Termina contenedor-movible-->
    </div><!--/Termina continermov-->
  </div><!--/Termina container-fluid movible-->
</div>


<?PHP
require $root . '/conta6/Ubicaciones/footer.php';
  require_once('modales/editarDatosAnticipo.php');
  require_once('modales/editarRegistroAnt.php');
  require_once('modales/buscarFacturasAnt.php');



}else{ #$rows?>
	<br><br>
	<p align="center"><u>
	<font face="Trebuchet MS" size="2" align="center" >NO EXISTE EL ANTICIPO O ES DE OTRA OFICINA</font></u></p>
	<p align="center">&nbsp;</p>
<?php
} #$rows
?>
