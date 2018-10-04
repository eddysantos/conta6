<?php
$query_conTarifaPOCMEclienteAutom = "SELECT A.fk_id_concepto,b.s_concepto_eng,s_conceptoesp,n_cantidad,n_importe,A.fk_id_cuenta,B.s_desc_cobros
                                FROM conta_tem_tarifas_calculodetalle A, conta_tarifas_conceptos B
                                WHERE A.fk_id_concepto = B.pk_id_concepto AND A.fk_id_tarifa=$calculoTarifa AND A.s_seccion = 'POCME' and A.fk_id_cliente = '$id_cliente'
                                and B.s_cobro_automatico = 1
                                ORDER BY A.s_Conceptoesp";


$stmt_conTarifaPOCMEclienteAutom = $db->prepare($query_conTarifaPOCMEclienteAutom);
if (!($stmt_conTarifaPOCMEclienteAutom)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_conTarifaPOCMEclienteAutom->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_conTarifaPOCMEclienteAutom->errno]: $stmt_conTarifaPOCMEclienteAutom->error";
  exit_script($system_callback);
}

$idFila=0;
/*
while ($oRst_conTarifaPOCMEclienteAutom = $stmt_conTarifaPOCMEclienteAutom->fetch_assoc()) {
    ++$idFila;
    $ID_CONCEPTOcta = $oRst_conTarifaPOCMEclienteAutom['fk_id_cuenta'];
    $fk_id_concepto = $oRst_conTarifaPOCMEclienteAutom['fk_id_concepto'];
    $CONCEPTOcta = trim($oRst_conTarifaPOCMEclienteAutom['s_conceptoesp']);
    $CONCEPTOctaEng = trim($oRst_conTarifaPOCMEclienteAutom['s_concepto_eng']);
    $cantidad = $oRst_conTarifaPOCMEclienteAutom['n_cantidad'];
    $buscar = 'flete';
    $parteBuscar = strripos($CONCEPTOcta,$buscar);
    $importe = number_format($oRst_conTarifaPOCMEclienteAutom['n_importe'], 2, '.', '');
    $subtotal = number_format($cantidad * $importe, 2, '.', '');
    $descripcion = trim($oRst_conTarifaPOCMEclienteAutom['s_desc_cobros']);

    #if ($parteBuscar !== false) { $descripcion = $transporteUS; }
    if( (is_null($descripcion) || $descripcion == '' ) && $importe == 0 ){ $descripcion = ""; }

    if( (is_null($ID_CONCEPTOcta) || $ID_CONCEPTOcta == '' ) && $importe > 0 ){
      $ID_CONCEPTOcta = 'HNS_11'; #Ingresos por otros conceptos total
    }

    if($docto == "cliente" || $docto == "clt_ame" || $docto == "corresponsal"){
      #EJEMPLO 5 entradas. se cobra: 1 entrada y 4 entradas adicionales. Para mostrar 1 entreda debe en "SI" inbond
      if( $ID_CONCEPTOcta == 'HNS_8' and $entradasAdicionales > 0){ $cantidad = $entradasAdicionales; }
      $subtotal = number_format($cantidad * $importe, 2, '.', '');
    }

    $POCME_automatico .= "
        <tr class='row m-0 trPOCME elemento-pocme' id='$idFila'>
          <td class='col-md-1 p-2'>
            <input type='text' id='T_POCME_Cantidad$idFila' value='$cantidad' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME();' size='4'>
          </td>
          <td class='col-md-3 p-2'>
            <input type='hidden' id='T_POCME_idTipoCta$idFila' value='$ID_CONCEPTOcta' class='T_POCME_CUENTAS id-cuenta'>
            <input type='hidden' id='T_POCME_idConcep$idFilaBlanco' value='$fk_id_concepto' class='T_POCME_idCONCEPTOS id_concepto'>
            <input type='text' id='T_POCME_Concepto$idFila' value='$CONCEPTOcta' class='T_POCME_CONCEPTOS concepto-espanol efecto h22' size='45' readonly>
            <input type='hidden' id='T_POCME_ConceptoEng$idFila' value='$CONCEPTOctaEng' class='T_POCME_CONCEPTOS_ENG concepto-ingles'/>
          </td>
          <td class='col-md-3 p-2'>
            <input type='text' id='T_POCME_Descripcion$idFila' value='$descripcion' maxlength='40' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45'>
          </td>
          <td class='col-md-1 p-2 text-left'>
            <a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
          </td>
          <td class='col-md-2 p-2'>
            <input type='text' id='T_POCME_Importe$idFila' value='$importe' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17'>
          </td>
          <td class='col-md-2 p-2'>
            <input type='text' id='T_POCME_Subtotal$idFila' value='$subtotal' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly/>
          </td>
        </tr>";
    }
*/

?>