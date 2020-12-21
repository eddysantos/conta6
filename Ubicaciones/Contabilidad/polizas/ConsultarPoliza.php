<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Ubicaciones/barradenavegacion.php';


$id_poliza = trim($_GET['id_poliza']);

$sumaCargos = 0; $sumaAbonos = 0;
$oRst_Select = mysqli_query($db,"SELECT * FROM conta_t_polizas_mst WHERE pk_id_poliza = $id_poliza");
$totalRegistrosSelect = mysqli_num_rows($oRst_Select);

if( $totalRegistrosSelect > 0 ){
  $oRst_Select = mysqli_fetch_array($oRst_Select);
  $cancela = $oRst_Select['s_cancela'];
  if( $cancela == 1 ){ $txt_cancela = 'Cancelada';}else{ $txt_cancela = ''; }

  $sql_POLDET = mysqli_query($db,"SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = '$id_poliza' ORDER BY pk_partida");
  $totalRegistrosPOLDET = mysqli_num_rows($sql_POLDET);

  if( $totalRegistrosPOLDET > 0 ){
      $oRst_STPD = mysqli_query($db,"SELECT fk_id_poliza,SUM(n_cargo)AS SUMA_CARGOS,SUM(n_abono)AS SUMA_ABONOS FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza GROUP BY fk_id_poliza ");
    	$oRst_STPD = mysqli_fetch_array($oRst_STPD);

    	$Status_Poliza = number_format($oRst_STPD["SUMA_CARGOS"] - $oRst_STPD["SUMA_ABONOS"],2,'.','');
      if( $Status_Poliza == 0 ){
        $txt_status = '';
      }else {
        $txt_status = '<b><font color="#E52727">SIN CUADRAR</font></b>';
      }
    	$sumaCargos = $oRst_STPD["SUMA_CARGOS"];
      $sumaAbonos = $oRst_STPD["SUMA_ABONOS"];
  }

?>

<div class="text-center mb-10">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link pol" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>

  <div id="datospoliza" class="contorno" style="display:none">
    <div class="titulo" style="margin-top:-26px">DATOS DE LA POLIZA</div>
    <table class="table font14">
      <thead>
        <tr class="row encabezado">
          <td class="p-1 col-md-2">POLIZA</td>
          <td class="p-1 col-md-2">USUARIO</td>
          <td class="p-1 col-md-2">FECHA POLIZA</td>
          <td class="p-1 col-md-2">GENERACION</td>
          <td class="p-1 col-md-2">ADUANA</td>
          <td class="p-1 col-md-2">CANCELACIÓN</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="p-1 col-md-2"><?php echo $oRst_Select['pk_id_poliza']; ?></td>
          <td class="p-1 col-md-2"><?php echo $oRst_Select['fk_usuario']; ?></td>
          <td class="p-1 col-md-2"><?php echo $oRst_Select['d_fecha']; ?></td>
          <td class="p-1 col-md-2"><?php echo $oRst_Select['d_fecha_alta']; ?></td>
          <td class="p-1 col-md-2"><?php echo $oRst_Select['fk_id_aduana']; ?></td>
          <td class="p-1 col-md-2"><?php echo $txt_cancela; ?></td>
        </tr>
        <tr class="row mt-1">
          <td class="col-md-12 sub2 p-1">CONCEPTO :</td>
        </tr>
        <tr class="row">
          <td class="col-md-12 p-1"><?php echo $oRst_Select['s_concepto']; ?>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <ul class="nav row text-center m-0 mt-3" id="myTab" role="tablist">
    <li class="nav-item col-md-6">
      <a class="nav-link pills active" id="detallepoliza" data-toggle="tab" href="#poliza" role="tab" aria-controls="poliza" aria-selected="true">Detalle de Póliza</a>
    </li>
    <?php if( $oRst_permisos['s_consultar_ContaElect'] == 1 ){ ?>
    <li class="nav-item col-md-6">
      <a class="nav-link pills" id="infPartida" data-toggle="tab" href="#inf" role="tab" aria-controls="inf" aria-selected="false" onclick="infAdd_detalle(<?php echo $id_poliza; ?>)">Información de la Partida</a>
      <input type="hidden" id="mst-poliza" value="<?php echo $id_poliza; ?>">
    </li>
    <?php } ?>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="poliza" role="tabpanel" aria-labelledby="poliza-tab">
      <form  class="mt-4 font14">
        <div class="row m-0">
          <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
          <div class="col-md-2">SUMA DE ABONOS</div>
        </div>
        <div class="row m-0">
          <div class="col-md-1">
            <a href="#" onclick="btn_printPoliza(<?php echo $oRst_Select['pk_id_poliza']; ?>,<?php echo $oRst_Select['fk_id_aduana']; ?>)" class="boton border-0"><img class="icomediano" src= "/Resources/iconos/printer.svg"></a>
          </div>
          <div class="col-md-2 offset-md-7">
            <input  class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
          </div>
          <div class="col-md-2">
            <input  class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
          </div>
        </div>
        <div class="row m-0">
          <div class="col-md-4 offset-md-8"><?PHP echo $txt_status; ?></div>
        </div>
      </form>

      <div id="detallepoliza" class="contorno mt-5 pl-4 pr-4" style='<?php echo $marginbottom ?>'>
        <div class="row m-0">
          <div class="col-md-12 encabezado font16">DETALLE POLIZA</div>
        </div>
        <table class="table table-hover fixed-table font12">
          <thead>
            <tr class="row m-0 sub2">
              <th class="p-0" width="3%">TIPO</th>
              <th class="p-0" width="6%">CUENTA</th>
              <th class="p-0" width="6%">GASTO</th>
              <th class="p-0" width="6%">PROV</th>
              <th class="p-0" width="7%">REFERENCIA</th>
              <th class="p-0" width="7%">CLIENTE</th>
              <th class="p-0" width="7%">DOCUMENTO</th>
              <th class="p-0" width="7%">FACTURA</th>
              <th class="p-0" width="7%">CTAGTOS</th>
              <th class="p-0" width="7%">PAGOELECT</th>
              <th class="p-0" width="7%">NOTACRED</th>
              <th class="p-0" width="7%">ANTICIPO</th>
              <th class="p-0" width="4%">CHEQUE</th>
              <th class="p-0" width="7%">CARGO</th>
              <th class="p-0" width="7%">ABONO</th>
              <th class="p-0" width="5%">FECHA</th>
            </tr>
          </thead>
          <tbody>

            <?php
              if( $totalRegistrosPOLDET > 0 ){
                while ($oRst_POLDET = mysqli_fetch_array($sql_POLDET)){
            ?>
            <tr class="row m-0 borderojo">
              <td class="p-0" width="3%"><?php echo $oRst_POLDET['fk_tipo']; ?></td>
              <td class="p-0" width="6%"><?php echo $oRst_POLDET['fk_id_cuenta']; ?></td>
              <td class="p-0" width="6%"><?php echo $oRst_POLDET['fk_gastoAduana']; ?></td>
              <td class="p-0" width="6%"><?php echo $oRst_POLDET['fk_id_proveedor']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_referencia']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_id_cliente']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['s_folioCFDIext']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_factura']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_ctagastos']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_pago']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_nc']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['fk_anticipo']; ?></td>
              <td class="p-0" width="4%"><?php echo $oRst_POLDET['fk_cheque']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['n_cargo']; ?></td>
              <td class="p-0" width="7%"><?php echo $oRst_POLDET['n_abono']; ?></td>
              <td class="p-0" width="5%"><?php echo $oRst_POLDET['d_fecha']; ?></td>
              <td class='p-0 mt-1' width='8%'><b>DESCRIPCIÓN:</b></td>
              <td class='p-0 mt-1 text-left' width='70%'><?php echo $oRst_POLDET['s_desc']; ?></td></td>
            </tr>
            <?php
              }
            }else{
            ?>
            <div class="container-fluid pantallaGris">
              <div class="tituloSinRegistros">NO HAY DETALLE DE ESTA PÓLIZA</div>
            </div>

            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="inf" role="tabpanel" aria-labelledby="dos-tab">
      <?php if( $oRst_permisos['s_consultar_ContaElect'] == 1 ){
        require $root . '/Ubicaciones/Contabilidad/infAdd_ContaElec/infAdd_det.php';
      } ?>
    </div>
  </div>
</div>
<?php // NOTE: se metio a scripts.php ?>
<!-- <script src="/Ubicaciones/Contabilidad/infAdd_ContaElec/js/infAdd_ContaElec.js"></script> -->
<?php
}else{
?>
  <div class="container-fluid pantallaGris">
    <div class="tituloSinRegistros">NO EXISTE LA PÓLIZA</div>
  </div>
<?php
}
?>

<?php
require $root . '/Ubicaciones/footer.php';
 ?>
<script src="/Ubicaciones/Contabilidad/polizas/js/Polizas.js"></script>
