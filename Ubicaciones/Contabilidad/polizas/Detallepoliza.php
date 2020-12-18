<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_poliza = $_GET['id_poliza'];
  $tipo = $_GET['tipo'];

  $sql_Select = mysqli_query($db,"Select * from conta_t_polizas_mst Where pk_id_poliza = $id_poliza AND fk_id_aduana = '$aduana'");
  $totalRegistrosSelect = mysqli_num_rows($sql_Select);
?>

<div class="text-center mb-10">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link pol" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>

<?PHP
if( $totalRegistrosSelect > 0 ){
	$oRst_Select = mysqli_fetch_array($sql_Select);
	$pol_cancela = trim($oRst_Select["s_cancela"]);

	$cancela = $oRst_Select['s_cancela'];

	if( $oRst_permisos["s_correcciones_mst_polizas"] == 1 ){ $clase = 'class="efecto tiene-contenido"'; }else{ $clase = 'class="efecto disabled readonly" disabled'; }
	if( $oRst_permisos["s_admdor_sistema"] == 1 ){ $claseAdmin = 'class="efecto tiene-contenido"'; }else{ $claseAdmin = 'class="efecto disabled readonly" disabled'; }

	if( $cancela == 1 ){ $clase = 'class="efecto disabled readonly" disabled'; $claseAdmin = 'class="efecto disabled readonly" disabled'; }


	$oRst_STPD_sql = mysqli_query($db,"select fk_id_poliza,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS from conta_t_polizas_det where fk_id_poliza = $id_poliza group by fk_id_poliza ");
	$totalRegistrosSTPD = mysqli_num_rows($oRst_STPD_sql);
	if( $totalRegistrosSTPD > 0 ){
		$oRst_STPD = mysqli_fetch_array($oRst_STPD_sql);
		$sumaCargos = $oRst_STPD['SUMA_CARGOS'];
		$sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
	}else{
		$sumaCargos = 0;
		$sumaAbonos = 0;
	}

  if( $sumaCargos == $sumaAbonos ){
    $txtStatus = 'style="color: #000000"';
  }else{
    $txtStatus = 'style="color: rgb(209, 28, 28)"';
  }
?>

<input type="hidden" id="usuario_activo" db-id="" autocomplete="off" value="<?php echo $usuario; ?>">
<input type="hidden" id="aduana_activa"  db-id="" autocomplete="off" value="<?php echo $aduana; ?>">

<!--Comienza DETALLE DATOS DE POLIZA-->
<div id="datospoliza" class="contorno mt-4" style="display:none">
  <div class="titulo" style='margin-top:-25px'>DATOS DE LA POLIZA</div>
  <table class="table font14">
    <thead>
      <div class="row encabezado b fw-bold p-1 font14">
        <div class="col-md-1">TIPO</div>
        <div class="col-md-1">POLIZA</div>
        <div class="col-md-2">USUARIO</div>
        <div class="col-md-2">FECHA POLIZA</div>
        <div class="col-md-2">GENERACION</div>
        <div class="col-md-2">ADUANA</div>
        <div class="col-md-2">ESTATUS</div>
      </div>
    </thead>
    <tbody>
      <tr class="row align-items-center">
        <td class="col-md-1">
          <input class="efecto h22" <?php echo $claseAdmin; ?> id="mstpol-tipo" type="text" db-id="" autocomplete="off" value="<?php echo $tipo; ?>">
        </td>
        <td class="col-md-1">
          <input class="efecto h22 border-0" id="id_poliza" type="text" db-id="" autocomplete="off" disabled value="<?php echo $id_poliza; ?>">
        </td>
        <td class="col-md-2"><?php echo trim($oRst_Select["fk_usuario"]); ?></td>
        <td class="col-md-2">
          <input class="efecto h22 pl-5" <?php echo $clase; ?> type="date" id="mstpol-fecha" value="<?php echo trim($oRst_Select["d_fecha"]); ?>">
        </td>
        <td class="col-md-2"><?php echo trim($oRst_Select["d_fecha_alta"]); ?></td>
        <td class="col-md-2">
          <input class="efecto h22 border-0" id="mstpol-aduana" type="text" db-id="" autocomplete="off" disabled value="<?php echo trim($oRst_Select["fk_id_aduana"]); ?>">
        </td>
        <td class="col-md-2">
          <select class="custom-select-s" size="1" name="mstpol-cancela" id="mstpol-cancela" onchange="cambiarStatus()">
            <?php if( $cancela == 0 ){
                echo "<option value='0' selected>Activo</option>";
                echo "<option value='1'>Cancelado</option>";
                }else{
                  echo "<option value='0'>Activo</option>";
                  echo "<option value='1' selected>Cancelado</option>";
                } ?>
          </select>
          <!--input class="efecto disabled readonly" id="mstpol-cancela" type="text" db-id="" autocomplete="off" disabled value="<?php echo $cancela; ?>"-->
        </td>
      </tr>
      <tr class="row mt-4 align-self-center">
        <td class="col-md-11">
          <input id="mstpol-concepto" <?php echo $clase; ?> value="<?php echo trim($oRst_Select["s_concepto"]); ?>" type="text" onchange="eliminaBlancosIntermedios(this)">
          <label for="concep">CONCEPTO</label>
        </td>
        <td class="col-md-1 text-left">
        <?php if( $oRst_permisos["s_correcciones_mst_polizas"] == 1 && $cancela == 0 ){ ?>
          <a href="#" id="guardarPolMST"> <img src= "/Resources/iconos/save.svg" class="icomediano"></a>
        <?php } ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<!--/Termina DETALLE DATOS DE POLIZA-->



<div class="text-center">
  <ul class="nav row text-center m-0 mt-5" role="tablist">
    <li class="nav-item col-md-4">
      <a class="nav-link pills active" id="CapturaPoliza-tab" data-toggle="tab" href="#CapturaPoliza" role="tab" aria-controls="CapturaPoliza" aria-selected="true">Captura Detalle de Póliza</a>
    </li>
    <li class="nav-item col-md-4">
      <a class="detallepoliza nav-link pills" data-toggle="tab" href="#Detalle" role="tab" aria-controls="Detalle" aria-selected="false">Detalle de Póliza</a>
    </li>
    <li class="nav-item col-md-4">
      <?php if( $oRst_permisos['s_consultar_ContaElect'] == 1 ){ ?>
      <a class="nav-link pills" id="infPartida" data-toggle="tab" href="#InfoAdd" role="tab" aria-controls="InfoAdd" aria-selected="false" onclick="infAdd_detalle(<?php echo $id_poliza; ?>)">Información de la Partida</a>
      <input type="hidden" id="mst-poliza" value="<?php echo $id_poliza; ?>">
      <?php } ?>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="CapturaPoliza" role="tabpanel" aria-labelledby="home-tab">

      <div id="capturapoliza" class="contorno text-center">
        <table class="table form1 font14">
          <thead>
            <tr class="row m-0 encabezado font18">
              <td class="col-md-12 p-0">CAPTURA DETALLE POLIZA</td>
            </tr>
          </thead>
          <tbody>
            <tr class="row m-0 mt-4">
              <td class="col input-effect">
                <?php if( $oRst_permisos["s_lstCompletaCtas_polizas"] == 1 ){
                echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                }else{
                  if($tipo == 2){
                    echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv_limitada_paraTipo2" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                  }else{
                    echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv_limitada" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                  }
                }?>
                <div class="popup-list" id="popup-display-detpol-cuenta" style="display:none"></div>
                <label for="detpol-cuenta">Seleccione una Cuenta</label>
              </td>
              <td class="gto col-md-2 input-effect " style="display:none">
                <input class="efecto popup-input" id="detpol-gtoficina" type="text" id-display="#popup-display-detpol-gtoficina" action="oficinas" db-id="" autocomplete="off" onChange="valDescripOficina()">
                <div class="popup-list" id="popup-display-detpol-gtoficina" style="display:none"></div>
                <label for="detpol-gtoficina">Gasto Oficina</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4 align-items-center">
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input" id="detpol-referencia" type="text" id-display="#popup-display-detpol-referencia" action="referencias" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-detpol-referencia" style="display:none"></div>
                <label for="detpol-referencia">Referencia</label>
              </td>

              <td class="col-md-8 input-effect">
                <div id="detpol-lstClientes">
                  <input class="efecto popup-input" id="detpol-cliente" type="text" id-display="#popup-display-detpol-cliente" action="clientes" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-detpol-cliente" style="display:none"></div>
                  <label for="detpol-cliente">Cliente</label>
                </div>
                <div id="detpol-lstClientesCorresp" style="display:none">
                  <select class="custom-select" size='1' id="detpol-clienteCorresp">
                    <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                  </select>
                </div>
              </td>

              <td class="col-md-2" role="button">
                <a href="#detpol-buscarfacturas" class="buscarFacturas-polizas boton icochico border-0" data-toggle="modal"> <img src= "/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
              </td>
            </tr>

            <!-- funcionando  pendiente saber si se utiliza-->
            <!-- <tr class="row m-0">
              <td class="col-md-12 input-effect">
                <div id="lstClientesCorrespCtas">
                  <select class="custom-select" size='1' id="detpol-clienteCorrespCtas">
                      <option selected value='0'>Seleccione</option>
                  </select>
                </div>
              </td>
            </tr> -->
            <tr class="gto row m-0 mt-4" style="display:none">
              <td class="col-md-12 input-effect">
                <input class="efecto popup-input" id="detpol-proveedores" type="text" id-display="#popup-display-detpol-proveedores" action="proveedores" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-detpol-proveedores" style="display:none"></div>
                <label for="detpol-proveedores">Proveedor</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-12 input-effect">
                <input class="efecto tiene-contenido" id="detpol-concepto" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                <label for="detpol-concepto">Concepto</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-2 input-effect">
                <input class="efecto" id="detpol-documento" onchange="validaSoloNumeros(this);">
                <label for="detpol-documento">Documento</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input " id="detpol-factura" type="text" id-display="#popup-display-detpol-factura" action="facturas_cfdi" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-detpol-factura" style="display:none"></div>
                <label for="detpol-factura">Factura</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input " id="detpol-anticipo" type="text" id-display="#popup-display-detpol-anticipo" action="anticipos_mst" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-detpol-anticipo" style="display:none"></div>
                <label for="detpol-anticipo">Anticipo</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto popup-input " id="detpol-cheque" type="text" id-display="#popup-display-detpol-cheque" action="cheques_mst" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-detpol-cheque" style="display:none"></div>
                <label for="detpol-cheque">Cheque</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto tiene-contenido" id="detpol-cargo" value="0" onchange="validaIntDec(this);">
                <label for="detpol-cargo">Cargo</label>
              </td>
              <td class="col-md-2 input-effect">
                <input class="efecto tiene-contenido" id="detpol-abono" value="0" onchange="validaIntDec(this);">
                <label for="detpol-abono">Abono</label>
              </td>
            </tr>
            <tr class="row justify-content-center mt-4">
              <td class="col-md-2">
                <a href="#" type="button" class="boton p-1" id="detpol-btnguardar"><img src= "/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row mt-3 justify-content-center m-0">
        <div class="col-md-2">SUMA DE CARGOS</div>
        <div class="col-md-2">SUMA DE ABONOS</div>
      </div>
      <div class="row justify-content-center mt-3 font14 m-0">
        <div class="col-md-2">
          <input class="efecto" value="<?php echo $sumaCargos; ?>" <?php echo $txtStatus; ?> readonly>
        </div>
        <div class="col-md-2">
          <input class="efecto" value="<?php echo $sumaAbonos; ?>" <?php echo $txtStatus; ?> readonly>
        </div>
      </div>

      <div class="contorno mt-5">
        <table class="table font12 table-hover">
          <thead>
            <tr class="row sub2 b">
              <td class='p-1' width="3%"></td>
              <td class='p-1' width="8%">CUENTA</td>
              <td class='p-1' width="8%">GASTO</td>
              <td class='p-1' width="8%">PROV</td>
              <td class='p-1' width="8%">REFERENCIA</td>
              <td class='p-1' width="8%">CLIENTE</td>
              <td class='p-1' width="8%">DOCUMENTO</td>
              <td class='p-1' width="8%">FACTURA</td>
              <td class='p-1' width="8%">NOTACRED</td>
              <td class='p-1' width="8%">ANTICIPO</td>
              <td class='p-1' width="6%">CHEQUE</td>
              <td class='p-1' width="8%">CARGO</td>
              <td class='p-1' width="8%">ABONO</td>
              <td class='p-1' width="3%"></td>
            </tr>
          </thead>
          <tbody id="ultimosRegistros"></tbody>
        </table>
      </div>


    </div>

    <div class="tab-pane fade" id="Detalle" role="tabpanel" aria-labelledby="Detalle-tab">
      <div class="row d-flex flex-row-reverse mt-4 m-0">
        <div class="col-md-2">SUMA DE CARGOS</div>
        <div class="col-md-2">SUMA DE ABONOS</div>
      </div>
      <div class="row font14 mt-3 m-0">
        <div class="col-md-3">
          <a href="#detpol-Sueldos" class="buscarFacturas-sueldos" data-toggle="modal"><img src="/Resources/iconos/magnifier.svg"> CFDI SUELDOS Y SALARIOS</a>
        </div>
        <div class="col-md-3">
          <a href="#detpol-Honorarios" class="buscarFacturas-honorarios" data-toggle="modal"><img src="/Resources/iconos/magnifier.svg"> CFDI HONORARIOS</a>
        </div>
        <div class="col-md-2">
          <a href="#" onclick="btn_printPoliza(<?php echo $id_poliza; ?>,<?php echo $aduana; ?>)" class="boton border-0"><img class="icomediano" src="/Resources/iconos/printer.svg"></a>
        </div>
        <div class="col-md-2">
          <input id="sumaCargos" class="efecto" value="<?php echo $sumaCargos; ?>" <?php echo $txtStatus; ?> readonly>
        </div>
        <div class="col-md-2">
          <input id="sumaAbonos" class="efecto" value="<?php echo $sumaAbonos; ?>" <?php echo $txtStatus; ?> readonly>
        </div>
      </div>

      <div class="contorno mt-4">
        <table class="table table-hover">
          <thead>
            <tr class="row encabezado font18">
              <td class="col-md-12 p-0">DETALLE POLIZA</td>
            </tr>
          </thead>
          <thead>
            <tr class="row sub2 font12 b">
              <td class='p-1' width="3%"></td>
              <td class='p-1' width="8%">CUENTA</td>
              <td class='p-1' width="8%">GASTO</td>
              <td class='p-1' width="8%">PROV</td>
              <td class='p-1' width="8%">REFERENCIA</td>
              <td class='p-1' width="8%">CLIENTE</td>
              <td class='p-1' width="8%">DOCUMENTO</td>
              <td class='p-1' width="8%">FACTURA</td>
              <td class='p-1' width="8%">NOTACRED</td>
              <td class='p-1' width="8%">ANTICIPO</td>
              <td class='p-1' width="6%">CHEQUE</td>
              <td class='p-1' width="8%">CARGO</td>
              <td class='p-1' width="8%">ABONO</td>
              <td class='p-1' width="3%"></td>
            </tr>
          </thead>
          <tbody id="tabla_detallepoliza" class="font12"></tbody>
        </table>
      </div>
    </div>


    <div class="tab-pane fade" id="InfoAdd" role="tabpanel" aria-labelledby="InfoAdd-tab">
      <?php if( $oRst_permisos['s_consultar_ContaElect'] == 1 ){
        require $root . '/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_det.php';
      } ?>
    </div>
  </div>
</div>

</div>

<script src="/Ubicaciones/Contabilidad/infAdd_ContaElec/js/infAdd_ContaElec.js"></script>
<script src="/Ubicaciones/Contabilidad/js/OpcionesSelect.js"></script>
<script src="/Ubicaciones/Contabilidad/polizas/js/Polizas.js"></script>
<?php
require $root . '/Ubicaciones/footer.php'; // el footer contiene el archivo scripts.php
require_once('modales/EditarRegistro.php');
require_once('modales/buscarFacturas.php');
?>

<?PHP
}else{ #$totalRegistrosSelect?>

  <div class="container-fluid pantallaGris">
    <div class="tituloSinRegistros">NO HAY DATOS DE ESTA P&Oacute;LIZA, O ES P&Oacute;LIZA DE OTRA OFICINA</div>
  </div>

<?php
} #$totalRegistrosSelect
?>
