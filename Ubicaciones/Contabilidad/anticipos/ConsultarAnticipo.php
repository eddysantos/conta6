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
        $txtStatus = '';
        $statusGeneraPoliza = true;
		  }else{
        $txtStatus = '<b><font color="#E52727">SIN CUADRAR</font></b>';
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
    if( $id_poliza > 0){ $tienePoliza = true; }else{ $tienePoliza = false;}

    //detalle anticipo
    $sql_DET = mysqli_query($db,"SELECT * FROM conta_t_anticipos_det WHERE fk_id_anticipo = '$id_anticipo' ORDER BY pk_partida");
    $totalRegistrosDET = mysqli_num_rows($sql_DET);


    if( $totalRegistrosDET > 0 ){
      while ($row = mysqli_fetch_array($sql_DET)){

        $headDetalle ="
        <tr class='row sub3 font12 b'>
          <td class='p-1' width='10%'>CUENTA</td>
          <td class='p-1' width='10%'>REFERENCIA</td>
          <td class='p-1' width='10%'>CLIENTE</td>
          <td class='p-1' width='10%'>FACTURA</td>
          <td class='p-1' width='10%'>CTA GASTOS</td>
          <td class='p-1' width='10%'>PAGO ELECT</td>
          <td class='p-1' width='10%'>NOTACRED</td>
          <td class='p-1' width='15%'>CARGO</td>
          <td class='p-1' width='15%'>ABONO</td>
        </tr>";
        $contenidoDetalle = "
        <tr class='row borderojo'>
          <td class='p-1' width='10%'>$row[fk_id_cuenta]</td>
          <td class='p-1' width='10%'>$row[fk_referencia]</td>
          <td class='p-1' width='10%'>$row[fk_id_cliente_antdet]</td>
          <td class='p-1' width='10%'>$row[fk_factura]</td>
          <td class='p-1' width='10%'>$row[fk_ctagastos]</td>
          <td class='p-1' width='10%'>$row[fk_pago]</td>
          <td class='p-1' width='10%'>$row[fk_nc]</td>
          <td class='p-1' width='15%'>$ $row[n_cargo]</td>
          <td class='p-1' width='15%'>$ $row[n_abono]</td>

          <td class='p-1 b' width='9%'><b>Descripción :</b></td>
          <td class='p-1 text-left' width='80%'>$row[s_desc]</td>
        </tr>";
      }
    }else{
      $headDetalle = "";
      $contenidoDetalle = '<div class="font18" style="color:red">ESTE ANTICIPO NO TIENE DETALLE</div>';
    }
  }
?>
<?php
  if( $rows > 0 ){
?>

<div class="text-center">
  <div class="row m-0 backpink">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link dant" id="submenuMed" status="cerrado" accion="dtosant">DATOS DE ANTICIPO</a>
      </li>
    </ul>
  </div>

  <input type="hidden" id="mst-anticipo" value="<?php echo $rowMST['pk_id_anticipo']; ?>">
<!--Comienza DETALLE DATOS DE POLIZA-->
  <div id="datosanticipo" class="contorno" style="display:none">
    <h5 class="titulo">DATOS DE ANTICIPO</h5>
    <table class="table form1">
      <thead>
        <tr class="row encabezado font12">
          <td class="col-md-2">POLIZA</td>
          <td class="col-md-1">USUARIO</td>
          <td class="col-md-2">ANTICIPO</td>
          <td class="col-md-2">FECHA REGISTRO</td>
          <td class="col-md-2">FECHA ANTICIPO</td>
          <td class="col-md-1">OFICINA</td>
          <td class="col-md-2">CANCELACION</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-2"><?php echo $rowMST['fk_id_poliza']; ?></td>
          <td class="col-md-1"><?php echo $rowMST['fk_usuario']; ?></td>
          <td class="col-md-2"><?php echo $rowMST['pk_id_anticipo']; ?></td>
          <td class="col-md-2"><?php echo $rowMST['d_fecha_alta']; ?></td>
          <td class="col-md-2"><?php echo $rowMST['d_fecha']; ?></td>
          <td class="col-md-1"><?php echo $rowMST['fk_id_aduana']; ?></td>
          <td class="col-md-2 pt-1"><?php echo $txt_cancela; ?></td>
        </tr>
        <tr class="row sub2 mt-4 font12">
          <td class="col-md-2">Valor</td>
          <td class="col-md-1">Cliente</td>
          <td class="col-md-1">Banco</td>
          <td class="col-md-1">Cuenta</td>
          <td class="col-md-7">Concepto</td>
        </tr>
        <tr class="row">
          <td class="col-md-2"><?php echo number_format($rowMST['n_valor'],2,'.',','); ?></td>
          <td class="col-md-1"><?php echo $rowMST['fk_id_cliente_antmst']; ?></td>
          <td class="col-md-1"><?php echo $rowMST['s_bancoOri']; ?></td>
          <td class="col-md-1"><?php echo $rowMST['s_ctaOri']; ?></td>
          <td class="col-md-7"><?php echo $rowMST['s_concepto']; ?></td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="font14">
    <div class="row mt-4 m-0">
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row m-0">
      <div class="col-md-1">
        <?php if( $tienePoliza == true ){ ?>
        <a href="#" id="btn_prinAnt" class="boton border-0"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg"></a>
        <?php } ?>
      </div>
      <div class="col-md-2 offset-md-6">
        <input class="efecto" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto" value="<?php echo number_format($sumaAbonos,2,'.',','); ?>" readonly>
      </div>
      <div class="row m-0">
        <div class="col-md-4 offset-md-8"><?PHP echo $txtStatus; ?></div>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno" style="<?php echo $marginbottom ?>">
    <table class="table table-hover">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12 p-2">DETALLE DE ANTICIPO</td>
        </tr>
        <?php echo $headDetalle ?>
      </thead>
      <tbody class="font12" id="tabla_detalleanticipoConsulta"><?php echo $contenidoDetalle; ?></tbody>
    </table>
  </div>

</div>

<?php
}else{ #$rows?>
  <div class="container-fluid pantallaGris">
    <div class="tituloSinRegistros">NO EXISTE EL ANTICIPO O ES DE OTRA OFICINA</div>
  </div>
<?php
} #$rows

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/footer.php';
?>
