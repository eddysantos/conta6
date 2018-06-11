<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $id_poliza = $_GET['id_poliza'];
  $tipo = $_GET['tipo'];

  $sql_Select = mysqli_query($db,"Select * from conta_t_polizas_mst Where pk_id_poliza = $id_poliza AND fk_id_aduana = '$aduana'");
  $totalRegistrosSelect = mysqli_num_rows($sql_Select);
?>
<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>
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
<input type="hidden" id="usuario_activo" db-id="" autocomplete="new-password" value="<?php echo $usuario; ?>">
<input type="hidden" id="aduana_activa"  db-id="" autocomplete="new-password" value="<?php echo $aduana; ?>">

<div id="datospoliza" class="contorno mt-5" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
  <!-- style="display:none" -->
  <h5 class="titulo">DATOS DE LA POLIZA</h5>
  <form class="form1">
    <table class="table text-center font14">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-2">TIPO</td>
          <td class="col-md-2">POLIZA</td>
          <td class="col-md-2">USUARIO</td>
          <td class="col-md-2">FECHA POLIZA</td>
          <td class="col-md-2">GENERACION</td>
          <td class="col-md-2">ADUANA</td>
          <td class="col-md-2">ESTATUS</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row m-0">
          <td class="col-md-2 pt-4"><input <?php echo $claseAdmin; ?> id="mstpol-tipo" type="text" db-id="" autocomplete="new-password" value="<?php echo $tipo; ?>"></td>
          <td class="col-md-2 pt-4"><input class="efecto disabled readonly" id="id_poliza" type="text" db-id="" autocomplete="new-password" disabled value="<?php echo $id_poliza; ?>"></td>
          <td class="col-md-2 pt-4"><?php echo trim($oRst_Select["fk_usuario"]); ?></td>
          <td class="col-md-2 pt-4"><input <?php echo $clase; ?> type="date" id="mstpol-fecha" value="<?php echo trim($oRst_Select["d_fecha"]); ?>"></td>
          <td class="col-md-2 pt-4"><?php echo trim($oRst_Select["d_fecha_alta"]); ?></td>
          <td class="col-md-2 pt-4"><input class="efecto disabled readonly" id="mstpol-aduana" type="text" db-id="" autocomplete="new-password" disabled value="<?php echo trim($oRst_Select["fk_id_aduana"]); ?>"></td>
          <td class="col-md-2 pt-4"><select size="1" name="mstpol-cancela" id="mstpol-cancela" onchange="cambiarStatus()">
							<?php if( $cancela == 0 ){
									echo "<option value='0' selected>Activo</option>";
									echo "<option value='1'>Cancelado</option>";
								  }else{
								  	echo "<option value='0'>Activo</option>";
								  	echo "<option value='1' selected>Cancelado</option>";
								  } ?>
									</select>
		  <!--input class="efecto disabled readonly" id="mstpol-cancela" type="text" db-id="" autocomplete="new-password" disabled value="<?php echo $cancela; ?>"--></td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-11 mt-4">
            <input id="mstpol-concepto" <?php echo $clase; ?> value="<?php echo trim($oRst_Select["s_concepto"]); ?>" type="text">
            <label for="concep">CONCEPTO</label>
          </td>
          <td class="col-md-1 mt-4 text-left">
		  	<?php if( $oRst_permisos["s_correcciones_mst_polizas"] == 1 && $cancela == 0 ){ ?>
            <a href="#" id="guardarPolMST" class="btn-block mt-1"> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
			<?php } ?>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div><!--/Termina DETALLE DATOS DE POLIZA-->


<div class="container-fluid movible m-5">
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
          <table class="table text-center">
            <thead>
              <tr class="row m-0 encabezado font18">
                <td class="col-md-12">CAPTURA DETALLE POLIZA</td>
              </tr>
            </thead>
            <tbody class="cuerpo">
              <tr class="row m-0 font14">
                <td class="col-md-10 input-effect mt-5">
                  <?php if( $oRst_permisos["s_lstCompletaCtas_polizas"] == 1 ){
                  echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                  }else{
                    if( $tipo == 2){
                      echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv_limitada_paraTipo2" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                    }else{
                      echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv_limitada" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                    }
                  }?>
                  <div class="popup-list" id="popup-display-cuentas_mst_2niv" style="display:none"></div>
                  <label for="detpol-cuenta">Seleccione una Cuenta</label>
                </td>
                <td class="col-md-2 input-effect mt-5">
                  <input class="efecto popup-input" id="detpol-gtoficina" type="text" id-display="#popup-display-oficina" action="oficinas" db-id="" autocomplete="new-password" onChange="valDescripOficina()">
                  <div class="popup-list" id="popup-display-oficina" style="display:none"></div>
                  <label for="detpol-gtoficina">Gasto Oficina</label>
                </td>
              </tr>
              <tr class="row m-0 font14">
                <td class="col-md-10 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-cliente" type="text" id-display="#popup-display-clientes_sinCtaDet" action="clientes" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-clientes_sinCtaDet" style="display:none"></div>
                  <label for="detpol-cliente">Cliente</label>
                </td>
                <td class="col-md-2 mt-4" role="button">
                  <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico"  style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                </td>
              </tr>
              <tr class="row m-0 font14">
                <td class="col-md-12 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-proveedores" type="text" id-display="#popup-display-proveedores" action="proveedores" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-proveedores" style="display:none"></div>
                  <label for="detpol-proveedores">Proveedor</label>
                </td>
              </tr>
              <tr class="row m-0 font14">
                <td class="col-md-12 input-effect mt-4">
                  <input  class="efecto" id="detpol-concepto" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                  <label for="detpol-concepto">Concepto</label>
                </td>
              </tr>
              <tr class="row m-0 font14">
                <td class="col-md-2 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-referencia" type="text" id-display="#popup-display-referencia" action="referencias" db-id="" autocomplete="new-password" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaReferencia(this);">
                  <div class="popup-list" id="popup-display-referencia" style="display:none"></div>
                  <label for="detpol-referencia">Referencia</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input class="efecto" id="detpol-documento" onchange="validaSoloNumeros(this);">
                  <label for="detpol-documento">Documento</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-factura" type="text" id-display="#popup-display-factura" action="facturas_cfdi" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-factura" style="display:none"></div>
                  <label for="detpol-factura">Factura</label>
                </td>
                <td class="col-md-1 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-anticipo" type="text" id-display="#popup-display-anticipo" action="anticipos_mst" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-anticipo" style="display:none"></div>
                  <label for="detpol-anticipo">Anticipo</label>
                </td>
                <td class="col-md-1 input-effect mt-4">
                  <input class="efecto popup-input" id="detpol-cheque" type="text" id-display="#popup-display-cheque" action="cheques_mst" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cheque" style="display:none"></div>
                  <label for="detpol-cheque">Cheque</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input class="efecto" id="detpol-cargo" value="0" onchange="validaIntDec(this);">
                  <label for="detpol-cargo">Cargo</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input class="efecto" id="detpol-abono" value="0" onchange="validaIntDec(this);">
                  <label for="detpol-abono">Abono</label>
                </td>
              </tr>
              <tr class="row justify-content-center">
                <td class="col-md-2 mt-4">
                  <a href="#" class="boton" id="detpol-btnguardar"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mt-3 justify-content-center text-center">
          <div class="col-md-2">SUMA DE CARGOS</div>
          <div class="col-md-2">SUMA DE ABONOS</div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-2 mt-3">
            <input class="font14 efecto" value="<?php echo $sumaCargos; ?>" readonly>
          </div>
          <div class="col-md-2 mt-3">
            <input class="font14 efecto" value="<?php echo $sumaAbonos; ?>" readonly>
          </div>
        </div>
      </div>

      <div id="two"><!--DETALLE DE POLIZAS-->
        <div class="row d-flex flex-row-reverse text-center">
          <div class="col-md-2">SUMA DE CARGOS</div>
          <div class="col-md-2">SUMA DE ABONOS</div>
        </div>
        <div class="row text-center font14">
          <div class="col-md-3 mt-3">
            <a href="#detpol-Sueldos" data-toggle="modal" class="boton"><img src="/conta6/Resources/iconos/magnifier.svg"> CFDI SUELDOS Y SALARIOS</a>
          </div>
          <div class="col-md-3 mt-3">
            <a href="#detpol-Honorarios" data-toggle="modal" class="boton"><img src="/conta6/Resources/iconos/magnifier.svg"> CFDI HONORARIOS</a>
          </div>
          <div class="col-md-2 mt-3">
		  	<!--a href='#detpol-editarRegPolDiario?id_poliza=174&aduana=470' data-toggle='modal' class="boton" style="border:none"><img class="icomediano" src="/conta6/Resources/iconos/printer.svg" style="border:none"></a-->
          <a href='#detpol-editarRegPolDiario' data-toggle='modal' class="boton" style="border:none"><img class="icomediano" src="/conta6/Resources/iconos/printer.svg" style="border:none"></a>
          </div>
          <div class="col-md-2 mt-3">
            <input class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
          </div>
          <div class="col-md-2 mt-3">
            <input class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
          </div>
        </div>

        <div class="contorno-mov mt-4">
          <table class="table table-hover text-center">
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

      <div id="three"><!--INFORMACION DE LA PARTIDA-->
        <form class="opcion">
          <table class="table">
            <tr class="row justify-content-center">
              <td class="col-md-4">
                <select name="selector" id="opcionespolizas">
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
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CFD / CBB</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-rfc" class="efecto" type="text">
                    <label for="dpol-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input id="dpol-razonsocial" class="efecto" type="text">
                    <label for="dpol-razonsocial">Razón Social</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-serie" class="efecto" type="text">
                    <label for="dpol-serie">Serie</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-folio" class="efecto" type="text">
                    <label for="dpol-folio">Folio</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-subtotal" class="efecto" type="text">
                    <label for="dpol-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-iva" class="efecto" type="text">
                    <label for="dpol-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-total" class="efecto" type="text">
                    <label for="dpol-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-aplicar" class="efecto" type="text">
                    <label for="dpol-aplicar">Aplicar</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov cfdi"><!--solo aparece al seleccionar CFDI-->
          <form class="form1">
            <table class="table text-center">
              <thead>
                <tr class="row encabezado m-0 font18">
                  <td class="col-md-12">CFDI</td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 mt-3">
                    <input type="file">
                  </td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-2 input-effect mt-3">
                    <input id="cfdi-rfc" class="efecto" type="text">
                    <label for="cfdi-rfc">RFC</label>
                  </td>
                  <td class="col-md-5 input-effect mt-3">
                    <input id="cfdi-razonsocial" class="efecto" type="text">
                    <label for="cfdi-razonsocial">Nombre / Razón Social</label>
                  </td>
                  <td class="col-md-5 input-effect mt-3">
                    <input id="cfdi-uuid" class="efecto" type="text">
                    <label for="cfdi-uuid">UUID</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-subtotal" class="efecto" type="text">
                    <label for="cfdi-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-iva" class="efecto" type="text">
                    <label for="cfdi-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-total" class="efecto" type="text">
                    <label for="cfdi-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
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
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CHEQUES</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-5 input-effect mt-4">
                    <input list="ch-origen" class="efecto" id="chorigen">
                    <datalist id="ch-origen">
                      <option value="Banamex - 002 - 7658424"></option>
                      <option value="Banamex - 002 - 79033561"></option>
                      <option value="Banamex - 002 - 7355485"></option>
                      <option value="Bancomer - 012 - 0192655497"></option>
                    </datalist>
                    <label for="chorigen">Seleccione una Cuenta (Origen)</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-banco" class="efecto tiene-contenido" type="text" value="002">
                    <label for="ch-banco">Banco</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="ch-ncuenta" class="efecto tiene-contenido" type="text" value="7865432">
                    <label for="ch-ncuenta">No.Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
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
                <tr class="row m-0">
                  <td class="col-md-5 input-effect mt-4">
                    <input id="ch-emextran" class="efecto" type="text">
                    <label for="ch-emextran">Emisor Extranjero</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-tc" class="efecto" type="text">
                    <label for="ch-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
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
                <tr class="row m-0">
                  <td class="col-md-1 input-effect mt-4">
                    <input id="ch-cheque1" class="efecto" type="text">
                    <label for="ch-cheque1">Cheque</label>
                  </td>
                  <td class="col-md-1 input-effect mt-4">
                    <input id="ch-importe" class="efecto" type="text">
                    <label for="ch-importe">Importe</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input class="efecto tiene-contenido" type="date" id="ch-fecha">
                    <label for="ch-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-rfcbenef" class="efecto" type="text">
                    <label for="ch-rfcbenef">RCF</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
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
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">Comprobante Extranjero</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-4 input-effect mt-4">
                    <input id="comext-tax" class="efecto" type="text">
                    <label for="comext-tax">Tax ID</label>
                  </td>
                  <td class="col-md-8 input-effect mt-4">
                    <input id="comext-razsocial" class="efecto" type="text">
                    <label for="comext-razsocial">Nombre / Razón Social</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="comext-fact" class="efecto" type="text">
                    <label for="comext-fact">Número de Factura</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="comext-mon" class="efecto"  id="comext-moneda">
                    <datalist id="comext-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="comext-moneda">Seleccione una Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="comext-tc" class="efecto" type="text">
                    <label for="comext-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
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
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">Otro</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input  list="otr-metpago" class="efecto"  id="otr-pago">
                    <datalist id="otr-metpago">
                      <option value="Bienes -- 09"></option>
                      <option value="Cancelacion -- 16"></option>
                      <option value="Compesacion -- 17"></option>
                      <option value="Dacion en Pago -- 12"></option>
                    </datalist>
                    <label for="otr-pago">Metodo Pago</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="otr-rfc" class="efecto" type="text">
                    <label for="otr-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input id="otr-benef" class="efecto" type="text">
                    <label for="otr-benef">Beneficiario</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input class="efecto tiene-contenido" type="date" id="otr-fecha">
                    <label for="otr-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="otr-imp" class="efecto" type="text">
                    <label for="otr-imp">Importe</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="otr-mon" class="efecto"  id="otr-moneda">
                    <datalist id="otr-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="otr-moneda">Moneda</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
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
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">Transferencia</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-6 input-effect mt-4">
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
                  <td class="col-md-6 input-effect mt-4">
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
                <tr class="row m-0">
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-ben" class="efecto h22"  id="transf-benef">
                    <datalist id="transf-ben">
                      <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
                      <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
                    </datalist>
                    <label class="pt-1" for="transf-benef">BANCOS BENEFICIARIOS</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-cli" class="efecto h22"  id="transf-clientes">
                    <datalist id="transf-cli">
                      <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
                      <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
                    </datalist>
                    <label class="pt-1" for="transf-clientes">BANCOS CLIENTES</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-emp" class="efecto h22"  id="transf-empleados">
                    <datalist id="transf-emp">
                      <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
                      <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
                    </datalist>
                    <label class="pt-1" for="transf-empleados">EMPLEADOS</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
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
                    <input class="noborder pt-1" type="text" value="012">
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

                <tr class="row m-0">
                  <td class="col-md-4 mt-3"></td>
                  <td class="col-md-2 mt-3">
                    <button  type="button" class="boton">
                      <i class="fa fa-plus-circle"></i> ORIGEN
                    </button>
                  </td>
                  <td class="col-md-2 mt-3">
                    <button  type="button" class="boton">
                      <i class="fa fa-plus-circle"></i> DESTINO
                    </button>
                  </td>
                  <td class="col-md-4 mt-3"></td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 sub mt-3">Origen</td>
                </tr>
                <tr class="row m-0 sub2">
                  <th class="col-md-1">BANCO</th>
                  <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-4">NOMBRE / RAZON SOCIAL (opcional)</th>
                  <th class="col-md-3">RFC (opcional)</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="noborder" type="text" value="012">
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
                    <input class="noborder" type="text" value="012">
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
          </form>
        </div>


        <div class="container-fluid xl mt-4">
          <form>
            <table class="text-center">
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
          </form>
        </div>
      </div><!--Termina desplazamiento numero 3-->
    </div><!--/Termina contenedor-movible-->
  </div><!--/Termina continermov-->
</div><!--/Termina container-fluid movible-->

<?php
require_once('modales/EditarRegistro.php');
require_once('modales/buscarFacturas.php');
?>

<!--***************ESTILOS*****************-->
<link rel="stylesheet" href="/conta6/Resources/css/sweetalert.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/alertify.min.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/themes/default.css">

<script src="js/Polizas.js"></script>
<script src="/conta6/Resources/js/eliminaBlancosIntermedios.js"></script>
<script src="/conta6/Resources/js/todasMayusculas.js"></script>
<script src="/conta6/Resources/js/validaSoloNumeros.js"></script>
<script src="/conta6/Resources/js/validaReferencia.js"></script>
<script src="/conta6/Resources/js/validaIntDec.js"></script>

<script src="/conta6/Ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>
<script src="/conta6/Ubicaciones/Contabilidad/js/OpcionesSelect.js"></script>
<script src="/conta6/Resources/js/popup-list-plugin.js"></script>
<script src="/conta6/Resources/js/table-fetch-plugin.js"></script>

<?PHP
}else{ #$totalRegistrosSelect?>
	<br><br>
	<p align="center"><u>
	<font face="Trebuchet MS" size="2" align="center" >NO HAY DATOS DE ESTA P&Oacute;LIZA, O ES P&Oacute;LIZA DE OTRA OFICINA</font></u></p>
	<p align="center">&nbsp;</p>
<?php
} #$totalRegistrosSelect
?>
