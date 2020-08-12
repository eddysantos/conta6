<?php
$query_tarifaAutom = "SELECT A.fk_id_concepto,B.s_concepto_eng,A.s_conceptoesp,A.n_cantidad,A.n_importe,A.fk_id_cuenta,B.s_desc_cobros
                                FROM conta_tem_tarifas_calculodetalle A, conta_tarifas_conceptos B
                                WHERE A.fk_id_concepto = B.pk_id_concepto AND A.fk_id_tarifa=? AND A.s_seccion = 'POCME' and A.fk_id_cliente = ?
                                and B.s_cobro_automatico = '1'
                                ORDER BY A.s_Conceptoesp";

$stmt_tarifaAutom = $db->prepare($query_tarifaAutom);
if (!($stmt_tarifaAutom)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_tarifaAutom->bind_param('ss',$calculoTarifa,$id_cliente);
if (!($stmt_tarifaAutom)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_tarifaAutom->errno]: $stmt_tarifaAutom->error";
  exit_script($system_callback);
}

if (!($stmt_tarifaAutom->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_tarifaAutom->errno]: $stmt_tarifaAutom->error";
  exit_script($system_callback);
}

$rslt_tarifaAutom = $stmt_tarifaAutom->get_result();
$rows_tarifaAutom = $rslt_tarifaAutom->num_rows;



#$oRst_permisos
$verGstoGana = $oRst_permisos['s_cta_ame_verGstoGana'];
$txt_verGstoGana = '';
if( $verGstoGana == 0 ){ $txt_verGstoGana = "style='display:none'"; }
$editGstoGana = $oRst_permisos['s_cta_ame_editGstoGana'];
$txt_editGstoGana = '';
$txt_editGstoGana_check = '';
if( $editGstoGana == 0 ){
  $txt_editGstoGana = 'readOnly';
  $txt_editGstoGana_check = 'disabled';
}

$idFila=0;
while ($oRst_tarifaAutom = $rslt_tarifaAutom->fetch_assoc()) {
    ++$idFila;
    $ID_CONCEPTOcta = $oRst_tarifaAutom['fk_id_cuenta'];
    $fk_id_concepto = $oRst_tarifaAutom['fk_id_concepto'];
    $CONCEPTOcta = utf8_encode($oRst_tarifaAutom['s_conceptoesp']);
    $CONCEPTOctaEng = trim($oRst_tarifaAutom['s_concepto_eng']);
    $cantidad = $oRst_tarifaAutom['n_cantidad'];
    $buscar = 'flete';
    $parteBuscar = strripos($CONCEPTOcta,$buscar);
    $importe = number_format($oRst_tarifaAutom['n_importe'], 2, '.', '');
    $subtotal = number_format($cantidad * $importe, 2, '.', '');
    $descripcion = utf8_encode($oRst_tarifaAutom['s_desc_cobros']);


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

    $POCME_automatico_ctaAme .= "<tr class='row m-0 trPOCME elemento-pocme justify-content-center' id='$idFila'>
        <td class='col-md-1 p-2'>
            <input type='text' id='T_POCME_Cantidad$idFila' value='$cantidad' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME_ctaAme();' size='4'/>
          </td>
          <td class='col-md-3 p-2 datos-transferibles'>
            <input type='hidden' id='T_POCME_idTipoCta$idFila'  value='$ID_CONCEPTOcta' class='T_POCME_CUENTAS id-cuenta'>
            <input type='hidden' id='T_POCME_idConcep$idFilaBlanco' value='$fk_id_concepto' class='T_POCME_idCONCEPTOS id-concepto'>
            <input type='text' id='T_POCME_Concepto$idFila' value='$CONCEPTOcta' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' readonly/>
            <input type='hidden' id='T_POCME_ConceptoEng$idFila' value='$CONCEPTOctaEng' class='T_POCME_CONCEPTOS_ENG concepto-ingles'>
          </td>
          <td class='col-md-3 p-2'>
            <input type='text' id='T_POCME_Descripcion$idFila' value='$descripcion' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40'>
          </td>
          <td class=' p-2 text-left'>
            <a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
          </td>
          <td class='pt-2 mt-2' $txt_verGstoGana>
            <input type='checkbox' class='check' $txt_editGstoGana_check>
          </td>
          <td class='col-md-1 p-2 text-left' id='spend_ctaAme' $txt_verGstoGana>
            <input type='text' class='efecto h22 T_POCME_GASTO gasto' name='T_POCME_gasto_$idFila' value='0.00' onblur='validaIntDec(this);gasto_POCME()' $txt_editGstoGana>
          </td>
          <td class='col-md-1 p-2 text-left' id='gain_ctaAme' $txt_verGstoGana>
            <input type='text' class='efecto h22 T_POCME_GANA ganancia' name='T_POCME_gana_$idFila' value='0.00' onblur='validaIntDec(this);gana_POCME()' $txt_editGstoGana>
          </td>
          <td class='col-md-1 p-2'>
            <input type='text' id='T_POCME_Importe$idFila' value='$importe' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME_ctaAme();cortarDecimalesObj(this,2);' size='17' >
          </td>
          <td class='col-md-1 p-2'>
            <input type='text' id='T_POCME_Subtotal$idFila' value='$subtotal' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly>
          </td>
        </tr>";

        $POCME_automatico .= "<tr class='row m-0 trPOCME elemento-pocme' id='$idFila'>
    			<td class='col-md-1 p-2'>
    		    <input type='text' id='T_POCME_Cantidad$idFila' class='T_POCME_CANTIDAD cantidad efecto h22' value='$cantidad' onblur='validaSoloNumeros(this);importe_POCME();' size='4'/>
    				<input class='id-partida' type='hidden' id='T_partida_' value='0'>
    		  </td>
    		  <td class='col-md-3 p-2 datos-transferibles'>
    		    <input type='hidden' id='T_POCME_idTipoCta$idFila' class='T_POCME_CUENTAS id-cuenta' value='$ID_CONCEPTOcta'>
    		    <input type='hidden' id='T_POCME_idConcep$idFila' class='T_POCME_idCONCEPTOS id-concepto' value='$fk_id_concepto'>
    		    <input type='text' id='T_POCME_Concepto$idFila' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' value='$CONCEPTOcta' readonly/>
    		    <input type='hidden' id='T_POCME_ConceptoEng$idFila' class='T_POCME_CONCEPTOS_ENG concepto-ingles' value='$CONCEPTOctaEng'>
    		  </td>
    		  <td class='col-md-3 p-2'>
    		    <input type='text' id='T_POCME_Descripcion$idFila' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40' value='$descripcion'>
    		  </td>
    		  <td class='col-md-1 p-2 text-left'>
    		    <a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
    		  </td>
    		  <td class='col-md-2 p-2'>
    		    <input type='text' id='T_POCME_Importe$idFila' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17' value='$importe' >
    		  </td>
    		  <td class='col-md-2 p-2'>
    		    <input type='text' id='T_POCME_Subtotal$idFila' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly value='$subtotal'>
    		  </td>
    		</tr>";
}

?>
