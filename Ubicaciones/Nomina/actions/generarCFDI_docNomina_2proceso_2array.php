<?php
$xml = '';
$ret = '';
$comprobante = '';
$nodo = 'Comprobante';

$fechaFactura = date("Y-m-d\TH:i:s");

require $root . '/conta6/Resources/PHP/actions/consultaDatosGrales_CFDI.php'; #$CFDversion,$regimen,$cveIVA
require $root . '/conta6/Ubicaciones/Nomina/actions/consultaDatosCFDI_docNomina_captura.php'; #$total_consultaDatosCaptura
if( $total_consultaDatosCaptura > 0 ){
  $row_consultaDatosCaptura = $rslt_consultaDatosCaptura->fetch_assoc();

  $descNomina = $row_consultaDatosCaptura['s_descNomina'];
  $tipoNomina = $row_consultaDatosCaptura['s_tipoNomina'];
  $semana = $row_consultaDatosCaptura['n_semana'];
  $anio = $row_consultaDatosCaptura['n_anio'];
  $id_empleado = $row_consultaDatosCaptura['fk_id_empleado'];
  $nombre = $row_consultaDatosCaptura['s_nombre'];
  $apellidoP = $row_consultaDatosCaptura['s_apellidoP'];
  $apellidoM = $row_consultaDatosCaptura['s_apellidoM'];
  $nombreEmpleado = $nombre.' '.$apellidoP.' '.$apellidoM;
  $RFC = $row_consultaDatosCaptura['s_RFC'];
  $CURP = $row_consultaDatosCaptura['s_CURP'];
  $id_regimen = $row_consultaDatosCaptura['fk_id_regimen']; # 02 Sueldos, 09 Honorarios
  $Reg_Patronal = $row_consultaDatosCaptura['s_Reg_Patronal'];
  $estado_entFed = $row_consultaDatosCaptura['fk_c_estado_entFed'];
  $IMSS = $row_consultaDatosCaptura['s_IMSS'];
  $INFONAVIT = $row_consultaDatosCaptura['s_INFONAVIT'];
  $mesCorresponde = $row_consultaDatosCaptura['n_mesCorresponde'];
  $fechaPago = $row_consultaDatosCaptura['d_fechaPago'];
  $fechaInicio = $row_consultaDatosCaptura['d_fechaInicio'];
  $fechaFinal = $row_consultaDatosCaptura['d_fechaFinal'];
  $numDiasPagados = $row_consultaDatosCaptura['n_numDiasPagados'];
  $departamento = $row_consultaDatosCaptura['s_departamento'];
  $id_formapago = $row_consultaDatosCaptura['fk_id_formapago'];
  $metodoPago = $row_consultaDatosCaptura['fk_c_MetodoPago'];
  $CLABE = $row_consultaDatosCaptura['s_CLABE'];
  $id_banco = $row_consultaDatosCaptura['fk_id_banco'];
  $FechaInicioRelLaboral = $row_consultaDatosCaptura['d_FechaInicioRelLaboral'];
  $antiguedad = $row_consultaDatosCaptura['s_antiguedad'];
  $puesto = $row_consultaDatosCaptura['s_puesto_actividad'];
  $id_contrato = $row_consultaDatosCaptura['fk_id_contrato'];
  $id_jornada = $row_consultaDatosCaptura['fk_id_jornada'];
  $id_pago = $row_consultaDatosCaptura['pk_id_pago'];
  $UsoCFDI = $row_consultaDatosCaptura['fk_c_UsoCFDI'];
  $salarioBaseCotApor = $row_consultaDatosCaptura['n_salarioBaseCotApor'];
  $id_riesgo = $row_consultaDatosCaptura['fk_id_riesgo'];
  $salarioDiarioIntegrado = $row_consultaDatosCaptura['n_salarioDiarioIntegrado'];
  $cantidad = $row_consultaDatosCaptura['n_cantidad'];
  $unidad = $row_consultaDatosCaptura['s_unidad'];
  $moneda = $row_consultaDatosCaptura['s_moneda'];
  $ClaveProdServ = $row_consultaDatosCaptura['s_ClaveProdServ'];
  $descripcion = $row_consultaDatosCaptura['s_descripcion'];
  $valor_unitario = $row_consultaDatosCaptura['n_valor_unitario'];
  $importe = $row_consultaDatosCaptura['n_importe'];
  $tipoDeComprobante = $row_consultaDatosCaptura['s_tipoDeComprobante']; #N=nomina
  $id_aduana = $row_consultaDatosCaptura['fk_id_aduana'];

}

require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_captura_sumaTotales.php';
# <-- $sumPercepcionesSueldos, $sumPercepcionesImporteGravado, $sumPercepcionesImporteExento, $sumPercepcionesSepIndem,
# <-- $totalDeducciones, $descuentos,	$totalPercepciones, $totalOtrosPagos, $subtotal, $total
# <-- $totalOtrasDeducciones, $totalOtrasDeduccionesISR

require $root . '/conta6/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
$noCertificado = $row_datosCert['pk_id_certificado'];
$certificado = $row_datosCert['s_certificado'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosOficinaActiva.php';
$ex_cp = $row_oficinaActiva['s_codigo'];
$lugarExpedicion = $ex_cp;
$ex_estado = $row_oficinaActiva['s_estado'];
$lugarExpedicionTxt = $ex_cp.' '.$ex_estado;
$registroPatronal = $row_oficinaActiva['s_Reg_Patronal'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosCIA.php';
$e_rfc = trim($rowCIA['s_RFC']);
$e_razon_social = $rowCIA['s_Razon_Social'];
$regimen = trim($rowCIA['fk_id_regimen']); #601


# Datos generaloes de CFDI ************************************************
$array = array( 'Version'=>$CFDversion,
                'Folio'=>$folioFactura,
                'Fecha'=>$fechaFactura,
                'Sello'=>'NA',
                'FormaPago'=>$id_formapago,
                'NoCertificado'=>$noCertificado,
                'Certificado'=>$certificado,
                'SubTotal'=>$subtotal,
                'Descuento'=>$descuentos,
                'Moneda'=>$moneda,
                'Total'=>$total,
                'TipoDeComprobante'=>$tipoDeComprobante,
                'MetodoPago'=>$metodoPago,
                'LugarExpedicion'=>$lugarExpedicion,
                'Emisor' => array('Rfc'=>$e_rfc,
                                  'Nombre'=>$e_razon_social,
                                  'RegimenFiscal'=>$regimen),
                'Receptor' => array('Rfc'=>$RFC,
                                    'Nombre'=>$nombreEmpleado,
                                    'UsoCFDI'=>$UsoCFDI)
              );

# CFDI relacionada ********************************************************
require $root . '/conta6/Ubicaciones/Nomina/actions/consultaDatosCFDI_docNomina_relacionada.php'; #$total_consultaDatosRelacionada
if( $total_consultaDatosRelacionada > 0 ){
  $idFilaDR = 0;
  $array['CfdiRelacionados']['TipoRelacion'] = '04';

  while ($row_consultaDatosRelacionada = $rslt_consultaDatosRelacionada->fetch_assoc()) {
    ++$idFilaDR;
    $UUID_relacionado = $row_consultaDatosRelacionada['s_UUID_relacionada'];
    $array['CfdiRelacionado'][$idFilaDR]['UUID'] = $UUID_relacionado;
  }
}


# concepto en CFDI ********************************************************
$array['Conceptos']['claveProdServ'] = $ClaveProdServ;
$array['Conceptos']['cantidad'] = $cantidad;
$array['Conceptos']['claveUnidad'] = $unidad;
$array['Conceptos']['descripcion'] = $descripcion;
$array['Conceptos']['valorUnitario'] = $valor_unitario;
$array['Conceptos']['importe'] = $importe;
$array['Conceptos']['Descuento'] = $descuentos;


# complemento *************************************************************
$array['Nomina']['Version'] = '1.2';
$array['Nomina']['TipoNomina'] = $tipoNomina;
$array['Nomina']['FechaPago'] = $fechaPago;
$array['Nomina']['FechaInicialPago'] = $fechaInicio;
$array['Nomina']['FechaFinalPago'] = $fechaFinal;
$array['Nomina']['NumDiasPagados'] = $numDiasPagados;
$array['Nomina']['TotalPercepciones'] = $totalPercepciones;
$array['Nomina']['TotalDeducciones'] = $totalDeducciones;

if( $id_regimen == '02' ){
  $array['Nomina']['TotalOtrosPagos'] = $totalOtrosPagos;
  $array['Emisor']['RegistroPatronal'] = $registroPatronal;
}



if( $id_regimen == '02' ){
  $array['Receptor']['Curp'] = $CURP;
  $array['Receptor']['NumSeguridadSocial'] = $IMSS;
  $array['Receptor']['FechaInicioRelLaboral'] = $FechaInicioRelLaboral;
  $array['Receptor']['Antigüedad'] = $antiguedad;
  $array['Receptor']['TipoContrato'] = $id_contrato;
  $array['Receptor']['TipoJornada'] = $id_jornada;
  $array['Receptor']['TipoRegimen'] = $id_regimen;
  $array['Receptor']['NumEmpleado'] = $id_empleado;
  $array['Receptor']['Departamento'] = $departamento;
  $array['Receptor']['Puesto'] = $puesto;
  $array['Receptor']['RiesgoPuesto'] = $id_riesgo;
  $array['Receptor']['PeriodicidadPago'] = $id_pago;
  $array['Receptor']['Banco'] = $id_banco;
  $array['Receptor']['CuentaBancaria'] = $CLABE;
  $array['Receptor']['SalarioBaseCotApor'] = $salarioBaseCotApor;
  $array['Receptor']['SalarioDiarioIntegrado'] = $salarioDiarioIntegrado;
  $array['Receptor']['ClaveEntFed'] = $estado_entFed;
}
if( $id_regimen == '09' ){
  $array['Receptor']['Curp'] = $CURP;
  $array['Receptor']['TipoContrato'] = $id_contrato;
  $array['Receptor']['TipoRegimen'] = $id_regimen;
  $array['Receptor']['NumEmpleado'] = $id_empleado;
  $array['Receptor']['Departamento'] = $departamento;
  $array['Receptor']['Puesto'] = $puesto;
  $array['Receptor']['PeriodicidadPago'] = $id_pago;
  $array['Receptor']['Banco'] = $id_banco;
  $array['Receptor']['CuentaBancaria'] = $CLABE;
  $array['Receptor']['ClaveEntFed'] = $estado_entFed;
}



$array['Percepciones']['TotalSueldos'] = $sumPercepcionesSueldos;
$array['Percepciones']['TotalGravado'] = $sumPercepcionesImporteGravado;
$array['Percepciones']['TotalExento'] = $sumPercepcionesImporteExento;
if( $sumPercepcionesSepIndem > 0 ){
  $array['Percepciones']['TotalSeparacionIndemnizacion'] = $sumPercepcionesSepIndem;
}

require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaPercepciones_array.php';

if( $id_regimen == '02' ){
  $array['Deducciones']['TotalOtrasDeducciones'] = $totalOtrasDeducciones;
}
$array['Deducciones']['TotalImpuestosRetenidos'] = $totalOtrasDeduccionesISR;

require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaDeducciones_array.php';


if( $totalOtrosPagos >= 0 && $id_regimen == '02' ){
  require $root . '/conta6/Ubicaciones/Nomina/actions/consulta_capturaOtrosPagos_array.php';
}


print_r($array);
?>
