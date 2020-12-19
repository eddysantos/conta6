<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_cheque = $_GET['id_cheque'];
  $id_cuentaMST = $_GET['id_cuentaMST'];

  // error_log($id_cheque,$id_cuentaMST);
  // echo $id_cheque,$id_cuentaMST;


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


    // $query = "SELECT * FROM conta_t_polizas_det WHERE fk_cheque = ? ORDER BY pk_partida";
    //
    // $stmtContDetalle = $db->prepare($query);
    // $stmtContDetalle->bind_param('s',$id_cheque);
    // $stmtContDetalle->execute();
    // $rsltContDetalle = $stmtContDetalle->get_result();
    // // $contenidoDetalle = "";
    // if ($rsltContDetalle->num_rows  == 0) {
    //   $contenidoDetalle = '<div class="container-fluid pantallaGris">
    //     <div class="tituloSinRegistros">NO HAY DETALLE DE ESTE CHEQUE</div>
    //   </div>';
    //
    // }else{
    //
    //   while ($rowContDetalle = $rsltContDetalle->fetch_assoc()) {
    //
    //     $contenidoDetalle = "
    //     <tr class='row borderojo'>
    //       <td class='p-1' width='9%'>$rowContDetalle[fk_id_cuenta]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_gastoAduana]</td>
    //       <td class='p-1' width='6%'>$rowContDetalle[fk_id_proveedor]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_referencia]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_id_cliente]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[s_folioCFDIext]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_factura]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_ctagastos]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_pago]</td>
    //       <td class='p-1' width='6%'>$rowContDetalle[fk_nc]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_anticipo]</td>
    //       <td class='p-1' width='7%'>$rowContDetalle[fk_id_cheque]</td>
    //       <td class='p-1' width='8%'>$rowContDetalle[n_cargo]</td>
    //       <td class='p-1' width='8%'>$rowContDetalle[n_abono]</td>
    //
    //       <td class='p-1 b' width='9%'><b>Descripción :</b></td>
    //       <td class='p-1 text-left' width='80%'>$rowContDetalle[s_desc]</td>
    //     </tr>";
    //
    //   }
    // }


    //detalle cheque
    // $sql_DET = mysqli_query($db,"SELECT * FROM conta_t_polizas_det WHERE fk_cheque = $id_cheque");
    $sql_DET = mysqli_query($db,"SELECT * FROM conta_t_cheques_det WHERE fk_id_cheque = $id_cheque AND fk_id_cuentaM = '$id_cuentaMST' ORDER BY pk_partida");
    $totalRegistrosDET = mysqli_num_rows($sql_DET);

    $contenidoDetalle = "";
    if( $totalRegistrosDET > 0 ){
      while ($row = mysqli_fetch_array($sql_DET)){
        $contenidoDetalle = "
        <tr class='row borderojo'>
          <td class='p-1' width='9%'>$row[fk_id_cuenta]</td>
          <td class='p-1' width='7%'>$row[fk_gastoAduana]</td>
          <td class='p-1' width='6%'>$row[fk_id_proveedor]</td>
          <td class='p-1' width='7%'>$row[fk_referencia]</td>
          <td class='p-1' width='7%'>$row[fk_id_cliente]</td>
          <td class='p-1' width='7%'>$row[s_folioCFDIext]</td>
          <td class='p-1' width='7%'>$row[fk_factura]</td>
          <td class='p-1' width='7%'>$row[fk_ctagastos]</td>
          <td class='p-1' width='7%'>$row[fk_pago]</td>
          <td class='p-1' width='6%'>$row[fk_nc]</td>
          <td class='p-1' width='7%'>$row[fk_anticipo]</td>
          <td class='p-1' width='7%'>$row[fk_id_cheque]</td>
          <td class='p-1' width='8%'>$row[n_cargo]</td>
          <td class='p-1' width='8%'>$row[n_abono]</td>

          <td class='p-1 b' width='9%'><b>Descripción :</b></td>
          <td class='p-1 text-left' width='80%'>$row[s_desc]</td>

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
    <h5 class="titulo font14">DATOS DEL CHEQUE</h5>
    <form class="form1">
      <table class="table">
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
            <td class="col-md-1"><?php echo trim($rowMST['fk_id_poliza']); ?>
              <!-- No borrar, necesarios para imprimir -->
              <input type="hidden" class="efecto h22" id="dchPoliza" value="<?php echo $rowMST['fk_id_poliza']; ?>">
              <input type="hidden" id="dchIdcheque" value="<?php echo $rowMST['pk_id_cheque']; ?>">
              <input type="hidden" id="dchCtaMST" value="<?php echo $rowMST['fk_id_cuentaMST']; ?>">
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
          <tr class="row mt-4 b">
            <td class="col-md-2 text-right font12"><b>Concepto :</b></td>
            <td class="col-md-8 text-left "><?php echo $rowMST['s_concepto']; ?></td>
          </tr>
          <tr class="row mt-2 backpink">
            <td class="col-md-2 text-right"><b>Beneficiario :</b></td>
            <td class="col-md-1 text-left"><?php echo $rowMST['fk_idOrd']; ?></td>
            <td class="col-md-8 text-left"><?php echo $rowMST['s_nomOrd']; ?></td>
          </tr>

        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="font14">
    <div class="row m-0 mt-4"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row m-0 mt-3">
      <?php if( $tienePoliza == true ){ ?>
      <div class="col-md-1">
        <a href="#" id="btn_printChe" class="boton border-0"><img class="icomediano ml-5" src= "/Resources/iconos/printer.svg"></a>
      </div>
      <?php } ?>
      <div class="col-md-2 offset-md-6">
        <input class="efecto" value="<?php echo number_format($sumaCargos,2,'.',','); ?>" readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto" value="<?php echo number_format($sumaC,2,'.',','); ?>" readonly>
      </div>
    </div>
    <div class="row m-0">
      <div class="col-md-4 offset-md-7"><?PHP echo $txtStatus; ?></div>
    </div>
  </form>
  <div class="contorno" style='<?php echo $marginbottom ?>'>
    <table class="table table-hover">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">CONSULTA DE CHEQUE</td>
        </tr>
        <tr class="row sub3 font12 b">
          <td width="9%">CUENTA</td>
          <td width="7%">GASTO</td>
          <td width="6%">PROV</td>
          <td width="7%">REFERENCIA</td>
          <td width="7%">CLIENTE</td>
          <td width="7%">DOC</td>
          <td width="7%">FACTURA</td>
          <td width="7%">CTA GASTOS</td>
          <td width="7%">PAGO ELECT</td>
          <td width="6%">NOTACRED</td>
          <td width="7%">ANTICIPO</td>
          <td width="7%">CHEQUE</td>
          <td width="8%">CARGO</td>
          <td width="8%">ABONO</td>
        </tr>
      </thead>
      <tbody class="font12"><?php echo $contenidoDetalle; ?></tbody>
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

require $root . '/Ubicaciones/footer.php';

?>
<script src="/Ubicaciones/Contabilidad/cheques/js/Cheques.js" charset="utf-8"></script>
