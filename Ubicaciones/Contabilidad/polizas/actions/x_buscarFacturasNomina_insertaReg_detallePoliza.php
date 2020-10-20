<?PHP
# http://localhost:88/conta6/ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_insertaReg_detallePoliza.php?id_poliza=607&concepto=pago nomina 1 NL&fecha=2020-07-28&tipo=4&factura=98&nombre=Sanjuana LorenaPrunedaMontes&importe=3667.31&regimen=02&accion=insertar
# http://localhost:88/conta6/ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_insertaReg_detallePoliza.php?id_poliza=607&concepto=pago nomina 1 NL&fecha=2020-07-28&tipo=4&factura=98&nombre=Sanjuana LorenaPrunedaMontes&importe=3667.31&regimen=02&accion=borrar
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$poliza = trim($_POST['id_poliza']);
$concepto = trim($_POST['concepto']);
$fecha_pol  = trim($_POST['fecha']);
$tipo  = trim($_POST['tipo']);
$factura  = trim($_POST['factura']);
$nombre = trim($_POST['nombre']);
$importe = trim($_POST['importe']);
$regimen = trim($_POST['regimen']);
$accion  = trim($_POST['accion']);
$doc = '0';
$gastoOficina = '0';
$proveedor = '0';
$anticipo = '0';
$cheque = '0';
$desc = "SUELDOS POR PAGAR ".$concepto." ".$nombre;

#if($regimen == '02'){ $cuenta = "0213-00001"; }
#if($regimen == '09'){ $cuenta = "0213-00003"; }
require $root . '/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_ctas0213pagos.php'; #$cuenta

$id_poliza = $poliza;
$fecha = $fecha_pol;
$id_referencia = '0';
$id_cliente = '0';
$documento = '0';


#*************
# CTA ORIGEN
#*************
$sql_ctaOrigen=mysqli_fetch_array(mysqli_query($db,"SELECT a.fk_id_cuenta,b.pk_partida,a.s_nombre,a.fk_id_banco,a.s_ctaOri,a.s_RFC
                                                    FROM conta_cs_bancos_cia a
                                                    INNER JOIN conta_t_polizas_det b
                                                    ON a.fk_id_cuenta = b.fk_id_cuenta
                                                    where   (b.fk_id_cuenta like '0100%' or b.fk_id_cuenta like '0101%') and b.fk_id_poliza = $id_poliza"));
$id_cuentaO = $sql_ctaOrigen['fk_id_cuenta'];
$nombreO = $sql_ctaOrigen['s_nombre'];
$id_bancoO = $sql_ctaOrigen['fk_id_banco'];
$ctaBcoO = $sql_ctaOrigen['s_ctaori'];
$benefO = "Proyeccion Logistica Agencia Aduanal, S.A. de C.V.";
$RFCO = $sql_ctaOrigen['s_RFC'];
$pol_partida = $sql_ctaOrigen['pk_partida'];


#*******************
# DATOS DEL XML
#*******************
$sql_xml=mysqli_fetch_array(mysqli_query($db,"SELECT concat(b.s_nombre,' ',b.s_apellidoP,' ',b.s_apellidoM) as nombre, b.s_RFC, a.d_fecha_generaUUID, a.s_UUID, b.n_importe, b.fk_id_banco, b.s_CLABE
                                              FROM conta_t_nom_cfdi a
                                              INNER JOIN conta_t_nom_captura b
                                              on a.fk_id_docNomina = b.pk_id_docNomina
                                              WHERE pk_id_nomina = $factura"));
$nombreD = $sql_xml['nombre'];
$RFCD = $sql_xml['s_RFC'];
$fechaD = date_format(date_create($sql_xml['d_fecha_generaUUID']),"Y-m-d H:i:s");
$UUID = $sql_xml['s_UUID'];
$id_bancoD = $sql_xml['fk_id_banco'];
$ctaBancoD = $sql_xml['s_CLABE'];



# inertar ++++++++++++++++++++
if( $accion == "insertar" ){
  $cargo = $importe;
  $abono = 0;

  require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
  $pk_partida = mysqli_insert_id($db);

  #*******************
  # INFORMACION ADICIONAL - Contabilidad Electrónica
  #*******************
  // Detalle del CFDI a la cuenta 0213
  $tipoInf = 'CompNal';
  $fk_id_poliza = $poliza;
  $partidaDoc = $pk_partida;
  $beneficiarioOpc = $nombre;
  $moneda = 'MXN';
  $tipoCamb = 1;
  require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';

  #$fk_id_poliza
  $partidaPol = $pk_partida;
  #$tipo
  $tipoDetalle = 'Transferencia';
  $ctaOri = $ctaBcoO;
  $BancoOri = $id_bancoO;
  $BancoOriExt = '';
  $CtaDest = $ctaBancoD;
  $BancoDest = $id_bancoD;
  $BancoDestExt = '';
  $fecha = $fechaD;
  $Beneficiario = $nombreD;
  $RFC = $RFCD;
  $monto = $importe;
  #$moneda
  #$TipCamb
  $BeneficiarioOpc = $nombreO;
  $RFCopc = $RFCO;
  $usuario_modifi = $usuario;
  $observ = '';
  require $root . '/Resources/PHP/actions/contaElect_insertaTransferencia.php';

  // Detalle del CFDI a la cuenta 0100 0 101
  $partidaDoc = $pol_partida;
  require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';

  $partidaPol = $pol_partida;
  require $root . '/Resources/PHP/actions/contaElect_insertaTransferencia.php';

  // Agrego la poliza de pago en Nomina CFDI
  mysqli_query($db,"UPDATE conta_t_nom_cfdi SET fk_id_polizaPago = $id_poliza WHERE pk_id_nomina = $factura");

  $system_callback['data'] = 'Generado';
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

  $descripcion = "Se agrego desde btnBuscarCFDInomina: Poliza: $poliza Nombre: $nombre Factura: $factura Cuenta:$cuenta Cargo: $cargo Abono: $abono ";

}





# borrar ++++++++++++++++++++
if( $accion == "borrar" ){

  $sql_partida=mysqli_fetch_array(mysqli_query($db,"SELECT pk_partida,fk_tipo FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza AND fk_factura = $factura"));
  $partida = $sql_partida['pk_partida'];

  #*******************
  # Transferencia 0213
  #*******************
  require $root . '/Resources/PHP/actions/contaElect_eliminar.php';
            #mysqli_query($db,"DELETE FROM conta_t_polizas_det_contaelec WHERE fk_partidaPol = $partida");

  #*******************
  # Transferencia - Cta del Banco
  #*******************
  mysqli_query($db,"DELETE FROM conta_t_polizas_det_contaelec WHERE s_tipoDetalle = 'Transferencia' AND fk_partidaPol = $pol_partida and s_RFC= '$RFCD' AND n_monto = $importe");
  mysqli_query($db,"DELETE FROM conta_t_polizas_det_contaelec where s_tipoDetalle = 'CompNal' AND fk_partidaPol = $pol_partida and s_UUID_CFDI= '$UUID' ");

  #*******************
  # Registro en Poliza
  #*******************
  mysqli_query($db,"DELETE FROM conta_t_polizas_det WHERE fk_id_poliza = $id_poliza and fk_id_cuenta ='$cuenta' and fk_factura = $factura and n_cargo = $importe");

  #*******************
  # Registro en Nomina CFDI
  #*******************
              #mysqli_query($db,"UPDATE conta_t_nom_cfdi SET fk_id_polizaPago = 0 WHERE pk_id_nomina = $factura");
  require $root . '/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_actualizaPagos.php';


  $system_callback['data'] = 'Borrado';
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

  $descripcion = "Se borro desde btnBuscarCFDInomina: Poliza: $poliza Nombre: $nombre Factura: $factura Cuenta:$cuenta Cargo: $cargo Abono: $abono ";
}


$clave = 'polizas';
$folio = $poliza;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

?>
