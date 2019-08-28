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
        if( $Status_Poliza == 0 ){
          $txt_status = '';
        }else {
          $txt_status = '<b><font color="#E52727">SIN CUADRAR</font></b>';
        }
      	$sumaCargos = $oRst_STPD["SUMA_CARGOS"];
        $sumaAbonos = $oRst_STPD["SUMA_ABONOS"];
    }

?>

<div class="text-center">
  <div class="row font14 m-5">
    <div class="col-md-3 offset-md-9">
      <a href="#" class="boton prov" accion="mostrarDetalle" role="button" id="botondetalle"><img src= "/conta6/Resources/iconos/detalles.svg" class="icochico">DATOS DE POLIZA</a>
    </div>
  </div>

  <form id="MostrarDetPoliza" class="contorno" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <table class="table font14">
      <tbody>
        <tr  class="row backpink">
          <td class="col-md-1">
            <a href="" class="prov" accion="cerrarDetalle" role="button"><img src= "/conta6/Resources/iconos/cross.svg" class="icochico"></a>
          </td>
          <td class="col-md-1">PÓLIZA</td>
          <td class="col-md-2">USUARIO</td>
          <td class="col-md-2">FECHA PÓLIZA</td>
          <td class="col-md-2">GENERACIÓN</td>
          <td class="col-md-2">ADUANA</td>
          <td class="col-md-2">CACELACIÓN</td>
        </tr>
        <tr  class="row">
          <td class="col-md-1"></td>
          <td class="col-md-1"><?php echo $oRst_Select['pk_id_poliza']; ?> <input type="hidden" id="mst-poliza" value="<?php echo $oRst_Select['pk_id_poliza']; ?>"></td>
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

    <div class="row m-0">
      <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row m-0 mt-3">
      <div class="col-md-1"></div>
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

  </form><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="mt-5">
    <table class="table">
      <tr class="row">
        <td class="col-md-6 offset-md-3">
          <input class="efecto popup-input" id="lstProv" type="text" id-display="#popup-display-lstProv" action="proveedores" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-lstProv" style="display:none"></div>
          <label for="lstProv">Proveedores</label>
        </td>
      </tr>
    </table>
  </form>
  <form class="contorno mt-5">
    <table class="table">
      <thead>
        <tr  class="row encabezado">
          <td class="col-md-1">CUENTA</td>
          <td class="col-md-4">DESCRIPCIÓN</td>
          <td class="col-md-1">CARGO</td>
          <td class="col-md-1">ABONO</td>
          <td class="col-md-4">PROVEEDOR</td>
          <td class="col-md-1">ACCIONES</td>
        </tr>
      </thead>
      <tbody id="registrosDetPol"></tbody>
    </table>
  </form>
</div>

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
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
