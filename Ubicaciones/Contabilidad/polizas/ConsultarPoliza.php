<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';


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
    	$sumaCargos = $oRst_STPD["SUMA_CARGOS"];
      $sumaAbonos = $oRst_STPD["SUMA_ABONOS"];
  }

?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>
  <div id="datospoliza" class="contorno" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DE LA POLIZA</h5>
    <form class="form1">
      <table class="table text-center">
        <thead>
          <tr class="row  encabezado font16">
            <td class="col-md-2">POLIZA</td>
            <td class="col-md-2">USUARIO</td>
            <td class="col-md-2">FECHA POLIZA</td>
            <td class="col-md-2">GENERACION</td>
            <td class="col-md-2">ADUANA</td>
            <td class="col-md-2">CANCELACIÓN</td>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row">
            <td class="col-md-2"><?php echo $oRst_Select['pk_id_poliza']; ?></td>
            <td class="col-md-2"><?php echo $oRst_Select['fk_usuario']; ?></td>
            <td class="col-md-2"><?php echo $oRst_Select['d_fecha']; ?></td>
            <td class="col-md-2"><?php echo $oRst_Select['d_fecha_alta']; ?></td>
            <td class="col-md-2"><?php echo $oRst_Select['fk_id_aduana']; ?></td>
            <td class="col-md-2"><?php echo $txt_cancela; ?></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-12 mt-5">
              <input id="concep" class="noborder efecto tiene-contenido" value="<?php echo $oRst_Select['s_concepto']; ?>" type="text" readonly>
              <label for="concep">CONCEPTO</label>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form  class="font14">
    <div class="row text-center"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a  class="boton" style="border:none"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
      </div>
      <div class="col-md-2 offset-md-5 mt-3">
        <input  class="text-normal form-control efecto" value="<?php echo $sumaCargos; ?>" readonly>
      </div>
      <div class="col-md-2 input-effect mt-3">
        <input  class="text-normal form-control efecto" value="<?php echo $sumaAbonos; ?>" readonly>
      </div>
    </div>
  </form>


  <div id="detallepoliza" class="contorno mt-5">
    <table class="table table-hover text-center">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">DETALLE POLIZA</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="small">TIPO</td>
          <td class="small">CUENTA</td>
          <td class="small">GASTO</td>
          <td class="small">PROV</td>
          <td class="small">REFERENCIA</td>
          <td class="small">CLIENTE</td>
          <td class="small">DOCUMENTO</td>
          <td class="small">FACTURA</td>
          <td class="small">CTAGTOS</td>
          <td class="small">PAGOELECT</td>
          <td class="small">NOTACRED</td>
          <td class="small">ANTICIPO</td>
          <td class="small">CHEQUE</td>
          <td class="med">DESCRIPCION</td>
          <td class="small">CARGO</td>
          <td class="small">ABONO</td>
          <td class="small">FECHA</td>
        </tr>

    <?php
      if( $totalRegistrosPOLDET > 0 ){
        while ($oRst_POLDET = mysqli_fetch_array($sql_POLDET)){
    ?>
        <tr class="row borderojo">
          <td class="small"><?php echo $oRst_POLDET['fk_tipo']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_id_cuenta']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_gastoAduana']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_id_proveedor']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_referencia']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_id_cliente']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['s_folioCFDIext']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_factura']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_ctagastos']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_pago']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_nc']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_anticipo']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['fk_cheque']; ?></td>
          <td class="med"><?php echo $oRst_POLDET['s_desc']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['n_cargo']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['n_abono']; ?></td>
          <td class="small"><?php echo $oRst_POLDET['d_fecha']; ?></td>
        </tr>
    <?php
      }
    }else{
    ?>
    <tr class="row borderojo">
      <td colspan="15" class="med" align="center">NO HAY DETALLE DE ESTA PÓLIZA</td>
    </tr>

    <?php
    }
    ?>
      </tbody>
    </table>
  </div>
</div><!--/Termina continermov-->
<?php
}else{
?>
<br><br><br><br><br>
	<p align="center"><font face="Trebuchet MS" size="2" align="center" >NO EXISTE LA PÓLIZA</font></p>
	<p align="center">&nbsp;</p>
<?php
}
?>


<script src="js/Polizas.js"></script>
<script src="/conta6/Ubicaciones/Contabilidad/js/validarFechaCierre.js"></script>
