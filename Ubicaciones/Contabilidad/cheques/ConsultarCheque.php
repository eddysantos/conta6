<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $id_cheque = $_GET['id_cheque'];
  $id_cuentaMST = $_GET['id_cuentaMST'];

  $sql_Select = "SELECT * from conta_t_cheques_mst Where pk_id_cheque = ? AND fk_id_cuentaMST = ?";
  $stmt = $db->prepare($sql_Select);
  if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
  if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
  if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
  $rslt = $stmt->get_result();
  $rows = $rslt->num_rows;

  if( $rows > 0 ){
    $rowMST = $rslt->fetch_assoc();
    $cancela = $rowMST['s_cancela']; // 0=Activo 1=Cancelado
    $id_poliza = $rowMST['fk_id_poliza'];
    $importeChe = $rowMST['n_valor'];

    //totales
    $oRst_STPD_sql = "SELECT fk_id_cheque,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS
                      from conta_t_cheques_det
                      where fk_id_cheque = ? AND fk_id_cuentaM = ?
                      group by fk_id_cheque ";
    $stmtTotales = $db->prepare($oRst_STPD_sql);
    if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
    $stmtTotales->bind_param('ss', $id_cheque,$id_cuentaMST);
    if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
    if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
    $rsltTotales = $stmtTotales->get_result();
    $rowsTotales = $rsltTotales->num_rows;
    if( $rowsTotales > 0 ){
      $oRst_STPD = $rsltTotales->fetch_assoc();
      $sumaCargos = $oRst_STPD['SUMA_CARGOS'];
      $sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
      $sumaC = number_format($sumaAbonos,2,'.','') + number_format($importeChe,2,'.','') ;
      $Status_Cheque =  number_format($sumaC - $sumaCargos,2,'.','');
      $statusGeneraPoliza = false;

      if( $Status_Cheque == 0 ){
        $txtStatus = '<b><font face="Trebuchet MS" size="2" color="#000000">CUADRADA</font></b>';
        $statusGeneraPoliza = true;
      }else{
        $txtStatus = '<b><font color="#E52727" face="Trebuchet MS" size="2"><?php echo $Status_Cheque; ?> CHEQUE SIN CUADRAR</font></b>';
        $statusGeneraPoliza = false;
      }
    }else{
      $sumaCargos = 0;
      $sumaAbonos = 0;
      $sumaC = 0;
      $Status_Cheque = 0;
    }

    //validaciones
    if( $cancela == 0 ){ $txt_cancela = "Activo"; }else{ $txt_cancela = "Cancelado"; }
    if( $oRst_permisos["s_correcciones_mst_cheques"] == 1 && $cancela == 0 ){ $mostrar = true; }else{ $mostrar = false; }
    if( $oRst_permisos["s_descancelar_cheques"] == 1 ){ $mostrarCancela = true; }else{ $mostrarCancela = false; }
    if( $cancela == 1 ){ $clase = 'class="efecto disabled readonly" disabled'; }
    if( $id_poliza > 0){ $tienePoliza = true; }else{ $tienePoliza = false;}
    if( $oRst_permisos["s_editar_cheques_det_pol"] == 1 && $cancela == 0 && $id_poliza > 0 ){
      $mostrarEditConPol = true;
    }else{
      if( $cancela == 0 && is_null($id_poliza) ){
        $mostrarEditConPol = true;
      }else{
      $mostrarEditConPol = false;
      }
    }

    //detalle cheque
    $sql_DET = mysqli_query($db,"SELECT * FROM conta_t_cheques_det WHERE fk_id_cheque = $id_cheque AND fk_id_cuentaM = '$id_cuentaMST' ORDER BY pk_partida");
    $totalRegistrosDET = mysqli_num_rows($sql_DET);

    if( $totalRegistrosDET > 0 ){
      while ($row = mysqli_fetch_array($sql_DET)){
        $contenidoDetalle = "
        <tr class='row borderojo'>
          <td class='xs'></td>
          <td class='small pt-3 p-0'>$row[fk_id_cuenta]</td>
          <td class='ssm pt-3 p-0'>$row[fk_gastoAduana]</td>
          <td class='ssm pt-3 p-0'>$row[fk_id_proveedor]</td>
          <td class='small pt-3 p-0'>$row[fk_referencia]</td>
          <td class='small pt-3 p-0'>$row[fk_id_cliente]</td>
          <td class='small pt-3 p-0'>$row[s_folioCFDIext]</td>
          <td class='ssm pt-3 p-0'>$row[fk_factura]</td>
          <td class='ssm pt-3 p-0'>$row[fk_ctagastos]</td>
          <td class='ssm pt-3 p-0'>$row[fk_pago]</td>
          <td class='small pt-3 p-0'>$row[fk_nc]</td>
          <td class='small pt-3 p-0'>$row[fk_anticipo]</td>
          <td class='ssm pt-3 p-0'>$row[fk_id_cheque]</td>
          <td class='med pt-3 p-0'>$row[s_desc]</td>
          <td class='small pt-3 p-0'>$row[n_cargo]</td>
          <td class='small pt-3 p-0'>$row[n_abono]</td>
          <td class='xs'></td>
        </tr>";
      }
    }else{
      $contenidoDetalle = '<div class="container-fluid pantallaGris">
        <div class="tituloSinRegistros">NO HAY DETALLE DE ESTE CHEQUE</div>
      </div>';
    }
  }
?>

<div class="text-center">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link che" id="submenuMed" status="cerrado" accion="dtosch">DATOS DEL CHEQUE</a>
      </li>
    </ul>
  </div>

  <?php
    if( $rows > 0 ){
  ?>
  <div id="datoscheque" class="contorno" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DEL CHEQUE</h5>
    <form class="form1">
      <table class="table ">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">USUARIO</td>
            <td class="col-md-2">CUENTA</td>
            <td class="col-md-1">NO.CHEQUE</td>
            <td class="col-md-2">FECHA CHEQUE</td>
            <td class="col-md-1">IMPORTE</td>
            <td class="col-md-2">MODIFICACION</td>
            <td class="col-md-1">CANCELACION</td>
            <td class="col-md-1">OFICINA</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-1"><?php echo $rowMST['fk_id_poliza']; ?>
              <input type="text" class="efecto h22" id="dchPoliza" value="<?php echo $rowMST['fk_id_poliza']; ?>">
              <!-- <input type="text" id="dchIdcheque" value="<?php echo $rowMST['pk_id_cheque']; ?>"> -->
              <!-- <input type="text" id="dchCtaMST" value="<?php echo $rowMST['fk_id_cuentaMST']; ?>"> -->
            </td>
            <td class="col-md-1"><?php echo $rowMST['fk_usuario']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['fk_id_cuentaMST']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['pk_id_cheque']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fechache']; ?></td>
            <td class="col-md-1"><?php echo $rowMST['n_valor']; ?></td>
            <td class="col-md-2"><?php echo $rowMST['d_fecha_alta']; ?></td>
            <td class="col-md-1"><?php echo $txt_cancela; ?></td>
            <td class="col-md-1"><?php echo $rowMST['fk_id_aduana']; ?></td>
          </tr>
          <!-- <tr class="row mt-3">
            <td class="col-md-12 colorRosa">CONCEPTO</td>
          </tr> -->
          <!-- <tr class="row">
            <td class="col-md-2">CONCEPTO</td>
            <td class="col-md-10"><?php echo $rowMST['s_concepto']; ?></td>
          </tr> -->
          <tr class="row mt-3">
            <td class="col-md-1">CONCEPTO:</td>
            <td class="col-md-4 text-left "><?php echo $rowMST['s_concepto']; ?></td>
            <td class="col-md-1"></td>
            <td class="col-md-1 backpink">BENEFICIARIO:</td>
            <td class="col-md-1 backpink"><?php echo $rowMST['fk_idOrd']; ?></td>
            <td class="col-md-4 backpink text-left"><?php echo $rowMST['s_nomOrd']; ?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="font14">
    <div class="row  mt-4"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row pt-3">
      <?php if( $tienePoliza == true ){ ?>
      <div class="col-md-1">
        <a href="#" id="btn_printChe" class="boton border-0"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg"></a>
      </div>
      <?php } ?>
      <div class="col-md-2 offset-md-7">
        <input class="efecto" value="<?php echo $sumaCargos; ?>" readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno">
    <table class="table table-hover">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">DETALLE DE CHEQUE</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="p-0 pt-1 xs"></td>
          <td class="p-0 pt-1 small">CUENTA</td>
          <td class="p-0 pt-1 ssm">GASTO</td>
          <td class="p-0 pt-1 ssm">PROV</td>
          <td class="p-0 pt-1 small">REFERENCIA</td>
          <td class="p-0 pt-1 small">CLIENTE</td>
          <td class="p-0 pt-1 small">DOC</td>
          <td class="p-0 pt-1 ssm">FACT</td>
          <td class="p-0 pt-1 ssm">CTA GASTOS</td>
          <td class="p-0 pt-1 ssm">PAGO ELECT</td>
          <td class="p-0 pt-1 small">NOTACRED</td>
          <td class="p-0 pt-1 small">ANTICIPO</td>
          <td class="p-0 pt-1 ssm">CHEQUE</td>
          <td class="p-0 pt-1 med">DESCRIPCION</td>
          <td class="p-0 pt-1 small">CARGO</td>
          <td class="p-0 pt-1 small">ABONO</td>
          <td class="p-0 pt-1 xxs"></td>
        </tr>
        <tbody class="font14"><?php echo $contenidoDetalle; ?></tbody>
      </tbody>
    </table>
  </div>
</div><!--/Termina continermov-->

<?php
}else{ #$rows?>
	<div class="container-fluid pantallaGris">
      <div class="tituloSinRegistros">NO EXISTE EL CHEQUE O ES DE OTRA OFICINA</div>
  </div>
<?php
} #$rows

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/footer.php';

?>
