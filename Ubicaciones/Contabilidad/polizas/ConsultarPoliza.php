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

<div class="text-center">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>

  <div id="datospoliza" class="contorno"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DE LA POLIZA</h5>
<<<<<<< HEAD
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
            <td class="col-md-2">234567</td>
            <td class="col-md-2">Estefania</td>
            <td class="col-md-2">22/11/2017</td>
            <td class="col-md-2">30/12/2017</td>
            <td class="col-md-2">Nuevo Laredo</td>
            <td class="col-md-2">234567</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-12 mt-5">
              <input id="concep" class="border-0 efecto tiene-contenido" value="Ejemplo del contenido Ejemplo del contenido" type="text">
              <label for="concep">CONCEPTO</label>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
=======
    <table class="table form1 font14">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-2">POLIZA</td>
          <td class="col-md-2">USUARIO</td>
          <td class="col-md-2">FECHA POLIZA</td>
          <td class="col-md-2">GENERACION</td>
          <td class="col-md-2">ADUANA</td>
          <td class="col-md-2">CANCELACIÓN</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-md-2"><?php echo $oRst_Select['pk_id_poliza']; ?></td>
          <td class="col-md-2"><?php echo $oRst_Select['fk_usuario']; ?></td>
          <td class="col-md-2"><?php echo $oRst_Select['d_fecha']; ?></td>
          <td class="col-md-2"><?php echo $oRst_Select['d_fecha_alta']; ?></td>
          <td class="col-md-2"><?php echo $oRst_Select['fk_id_aduana']; ?></td>
          <td class="col-md-2"><?php echo $txt_cancela; ?></td>
        </tr>
        <tr class="row mt-3">
          <td class="col-md-12 backpink">CONCEPTO :</td>
        </tr>
        <tr class="row mt-2">
          <td class="col-md-12"><?php echo $oRst_Select['s_concepto']; ?>
        </tr>
      </tbody>
    </table>
>>>>>>> CSScorresponsales
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form  class="mt-4 font14">
    <div class="row"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row m-0 mt-3">
      <div class="col-md-1">
        <a  class="boton border-0"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg"></a>
      </div>
      <div class="col-md-2 offset-md-7">
        <input  class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
      </div>
      <div class="col-md-2">
        <input  class="efecto" value="<?php echo $sumaAbonos; ?>" readonly>
      </div>
    </div>
  </form>


  <div id="detallepoliza" class="contorno mt-5 pl-4 pr-4">
    <div class="row m-0">
      <div class="col-md-12 encabezado font18">DETALLE POLIZA</div>
    </div>
    <table class="table table-hover">
      <tbody>
        <tr class="backpink">
          <td class="p-0">TIPO</td>
          <td class="p-0">CUENTA</td>
          <td class="p-0">GASTO</td>
          <td class="p-0">PROV</td>
          <td class="p-0">REFERENCIA</td>
          <td class="p-0">CLIENTE</td>
          <td class="p-0">DOCUMENTO</td>
          <td class="p-0">FACTURA</td>
          <td class="p-0">CTAGTOS</td>
          <td class="p-0">PAGOELECT</td>
          <td class="p-0">NOTACRED</td>
          <td class="p-0">ANTICIPO</td>
          <td class="p-0">CHEQUE</td>
          <td class="p-0">DESCRIPCION</td>
          <td class="p-0">CARGO</td>
          <td class="p-0">ABONO</td>
          <td class="p-0">FECHA</td>
        </tr>
        <?php
          if( $totalRegistrosPOLDET > 0 ){
            while ($oRst_POLDET = mysqli_fetch_array($sql_POLDET)){
        ?>
        <tr class="borderojo">
          <td><?php echo $oRst_POLDET['fk_tipo']; ?></td>
          <td><?php echo $oRst_POLDET['fk_id_cuenta']; ?></td>
          <td><?php echo $oRst_POLDET['fk_gastoAduana']; ?></td>
          <td><?php echo $oRst_POLDET['fk_id_proveedor']; ?></td>
          <td><?php echo $oRst_POLDET['fk_referencia']; ?></td>
          <td><?php echo $oRst_POLDET['fk_id_cliente']; ?></td>
          <td><?php echo $oRst_POLDET['s_folioCFDIext']; ?></td>
          <td><?php echo $oRst_POLDET['fk_factura']; ?></td>
          <td><?php echo $oRst_POLDET['fk_ctagastos']; ?></td>
          <td><?php echo $oRst_POLDET['fk_pago']; ?></td>
          <td><?php echo $oRst_POLDET['fk_nc']; ?></td>
          <td><?php echo $oRst_POLDET['fk_anticipo']; ?></td>
          <td><?php echo $oRst_POLDET['fk_cheque']; ?></td>
          <td><?php echo $oRst_POLDET['s_desc']; ?></td>
          <td><?php echo $oRst_POLDET['n_cargo']; ?></td>
          <td><?php echo $oRst_POLDET['n_abono']; ?></td>
          <td><?php echo $oRst_POLDET['d_fecha']; ?></td>
        </tr>
        <?php
          }
        }else{
        ?>
        <!-- <tr class="row borderojo">
          <td colspan="15" class="">NO HAY DETALLE DE ESTA PÓLIZA</td>
        </tr> -->

        <!-- <div class="row font14 mt-5 borderojo">
          <div class="col-md-12">
            NO HAY DETALLE DE ESTA PÓLIZA
          </div>
        </div> -->

        <div class="container-fluid pantallaGris">
          <div class="tituloSinRegistros">NO HAY DETALLE DE ESTA PÓLIZA</div>
        </div>

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
  <!-- <div class="row font14 mt-5">
    <div class="col-md-12">
      NO EXISTE LA PÓLIZA
    </div>
  </div> -->

  <div class="container-fluid pantallaGris">
    <div class="tituloSinRegistros">NO EXISTE LA PÓLIZA</div>
  </div>
<?php
}
?>


<?php
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
<!-- <script src="/conta6/Ubicaciones/Contabilidad/js/validarFechaCierre.js"></script> -->
