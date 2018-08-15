<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $id_poliza = $_GET['id_poliza'];
  $tipo = $_GET['tipo'];

  $sql_Select = mysqli_query($db,"Select * from conta_t_polizas_mst Where pk_id_poliza = $id_poliza AND fk_id_aduana = '$aduana'");
  $totalRegistrosSelect = mysqli_num_rows($sql_Select);
?>
<div class="text-center mb-10">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link pol" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
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
?>
<input type="hidden" id="usuario_activo" db-id="" autocomplete="off" value="<?php echo $usuario; ?>">
<input type="hidden" id="aduana_activa"  db-id="" autocomplete="off" value="<?php echo $aduana; ?>">

  <div id="datospoliza" class="contorno mt-5" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <!-- style="display:none" -->
    <h5 class="titulo">DATOS DE LA POLIZA</h5>
    <table class="table form1 font14">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-1">TIPO</td>
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-2">USUARIO</td>
          <td class="col-md-2">FECHA POLIZA</td>
          <td class="col-md-2">GENERACION</td>
          <td class="col-md-2">ADUANA</td>
          <td class="col-md-2">ESTATUS</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row m-0">
          <td class="col-md-1">
            <input class="efecto h22" <?php echo $claseAdmin; ?> id="mstpol-tipo" type="text" db-id="" autocomplete="off" value="<?php echo $tipo; ?>">
          </td>
          <td class="col-md-1">
            <input class="efecto h22 border-0" id="id_poliza" type="text" db-id="" autocomplete="off" disabled value="<?php echo $id_poliza; ?>">
          </td>
          <td class="col-md-2 pt-4"><?php echo trim($oRst_Select["fk_usuario"]); ?></td>
          <td class="col-md-2">
            <input class="efecto h22" <?php echo $clase; ?> type="date" id="mstpol-fecha" value="<?php echo trim($oRst_Select["d_fecha"]); ?>">
          </td>
          <td class="col-md-2 pt-4"><?php echo trim($oRst_Select["d_fecha_alta"]); ?></td>
          <td class="col-md-2">
            <input class="efecto h22 border-0" id="mstpol-aduana" type="text" db-id="" autocomplete="off" disabled value="<?php echo trim($oRst_Select["fk_id_aduana"]); ?>">
          </td>
          <td class="col-md-2">
            <select class="custom-select-ch" size="1" name="mstpol-cancela" id="mstpol-cancela" onchange="cambiarStatus()">
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
        <tr class="row m-0 mt-4">
          <td class="col-md-11">
            <input id="mstpol-concepto" <?php echo $clase; ?> value="<?php echo trim($oRst_Select["s_concepto"]); ?>" type="text" onchange="eliminaBlancosIntermedios(this)">
            <label for="concep">CONCEPTO</label>
          </td>
          <td class="col-md-1 text-left">
		  	<?php if( $oRst_permisos["s_correcciones_mst_polizas"] == 1 && $cancela == 0 ){ ?>
            <a href="#" id="guardarPolMST" class="btn-block mt-1"> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
			<?php } ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->


  <div class="movible m-4">
    <nav>
      <ul class="nav nav-pills nav-fill w-100 m-15">
        <li class="nav-item">
          <a class="nav-link pills" >Captura Detalle Póliza</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pills" id="detallepoliza">Detalle de Póliza</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pills" >Información Adicional</a>
        </li>
      </ul>
    </nav> <!--links de desplazamiento-->
    <div class="containermov">
      <div class="contenedor-movible">
        <div id="one"><!--CAPTURA DE POLIZAS-->
          <div id="capturapoliza" class="contorno-mov">
            <table class="table form1 font14">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CAPTURA DETALLE POLIZA</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 mt-5">
                  <td class="col input-effect ">
                    <?php if( $oRst_permisos["s_lstCompletaCtas_polizas"] == 1 ){
                    echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                    }else{
                      if( $tipo == 2){
                        echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv_limitada_paraTipo2" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                      }else{
                        echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-detpol-cuenta" action="cuentas_mst_2niv_limitada" db-id="" autocomplete="off" onchange="Actualiza_Cuenta()">';
                      }
                    }?>
                    <div class="popup-list" id="popup-display-detpol-cuenta" style="display:none"></div>
                    <label for="detpol-cuenta">Seleccione una Cuenta</label>
                  </td>
                  <td  class="gto col-md-2 input-effect " style="display:none">
                    <input class="efecto popup-input" id="detpol-gtoficina" type="text" id-display="#popup-display-detpol-gtoficina" action="oficinas" db-id="" autocomplete="off" onChange="valDescripOficina()">
                    <div class="popup-list" id="popup-display-detpol-gtoficina" style="display:none"></div>
                    <label for="detpol-gtoficina">Gasto Oficina</label>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-10 input-effect ">
                    <input class="efecto popup-input" id="detpol-cliente" type="text" id-display="#popup-display-detpol-cliente" action="clientes" db-id="" autocomplete="off">
                    <div class="popup-list" id="popup-display-detpol-cliente" style="display:none"></div>
                    <label for="detpol-cliente">Cliente</label>
                  </td>
                  <td class="col-md-2" role="button">
                    <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="gto col-md-12 input-effect " style="display:none">
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
                    <input class="efecto popup-input " id="detpol-referencia" type="text" id-display="#popup-display-detpol-referencia" action="referencias" db-id="" autocomplete="off" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaReferencia(this);">
                    <div class="popup-list" id="popup-display-detpol-referencia" style="display:none"></div>
                    <label for="detpol-referencia">Referencia</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input class="efecto" id="detpol-documento" onchange="validaSoloNumeros(this);">
                    <label for="detpol-documento">Documento</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input class="efecto popup-input " id="detpol-factura" type="text" id-display="#popup-display-detpol-factura" action="facturas_cfdi" db-id="" autocomplete="off">
                    <div class="popup-list" id="popup-display-detpol-factura" style="display:none"></div>
                    <label for="detpol-factura">Factura</label>
                  </td>
                  <td class="col-md-1 input-effect">
                    <input class="efecto popup-input " id="detpol-anticipo" type="text" id-display="#popup-display-detpol-anticipo" action="anticipos_mst" db-id="" autocomplete="off">
                    <div class="popup-list" id="popup-display-detpol-anticipo" style="display:none"></div>
                    <label for="detpol-anticipo">Anticipo</label>
                  </td>
                  <td class="col-md-1 input-effect">
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
                    <a href="#" class="boton" id="detpol-btnguardar"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row mt-3 justify-content-center">
            <div class="col-md-2">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row justify-content-center mt-3 font14">
            <div class="col-md-2">
              <input class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2">
              <input class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
            </div>
          </div>

          <div class="contorno-mov mt-5">
            <table class="table">
              <tbody id="ultimosRegistros"></tbody>
            </table>
          </div>
        </div>




        <div id="two"><!--DETALLE DE POLIZAS-->
          <div class="row d-flex flex-row-reverse mt-4">
            <div class="col-md-2">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row font14 mt-3">
            <div class="col-md-3">
              <a href="#detpol-Sueldos" data-toggle="modal" class="boton"><img src="/conta6/Resources/iconos/magnifier.svg"> CFDI SUELDOS Y SALARIOS</a>
            </div>
            <div class="col-md-3">
              <a href="#detpol-Honorarios" data-toggle="modal" class="boton"><img src="/conta6/Resources/iconos/magnifier.svg"> CFDI HONORARIOS</a>
            </div>
            <div class="col-md-2">
              <a href="#" onclick="btn_printPoliza(<?php echo $id_poliza; ?>,<?php echo $aduana; ?>)" class="boton border-0"><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
            </div>
            <div class="col-md-2">
              <input class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
            </div>
            <div class="col-md-2">
              <input class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
            </div>
          </div>

          <div class="contorno-mov mt-4">
            <table class="table table-hover">
              <thead>
                <tr class="row encabezado m-0 font18">
                  <td class="col-md-12">DETALLE POLIZA</td>
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
                  <td class="small">NOTACRED</td>
                  <td class="small">ANTICIPO</td>
                  <td class="small">CHEQUE</td>
                  <td class="med">DESCRIPCION</td>
                  <td class="small">CARGO</td>
                  <td class="small">ABONO</td>
                  <td class="xs"></td>
                </tr>
                <tbody id="tabla_detallepoliza"></tbody>
              </tbody>
            </table>
          </div>
        </div>

        <?php if( $id_poliza > 0 ){
          require $root . '/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_det.php';
            // require $root . '/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_detallePoliza.php';
          } ?>

      </div><!--/Termina contenedor-movible-->
    </div><!--/Termina continermov-->
  </div><!--/Termina container-fluid movible-->
</div>
<?php
require $root . '/conta6/Ubicaciones/footer.php';
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
