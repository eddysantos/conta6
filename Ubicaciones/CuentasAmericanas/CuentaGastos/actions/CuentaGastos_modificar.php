<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


$ID_calculo = trim($_POST['T_No_calculoTarifa']);
$Usuario_Cta = trim($_POST['Txt_Usuario']);
$ID_Referencia = trim($_POST['T_Referencia']);
$Tipo = trim($_POST['T_Tipo']);
$T_Freight = trim($_POST['T_Freight']);
$T_Quantity = trim($_POST['T_Quantity']);
$T_Type = trim($_POST['T_Type']);
$T_Descripction = trim($_POST['T_Descripction']);
$id_cliente = trim($_POST['T_ID_Cliente_Oculto']);
$Fac_Nombre = utf8_decode(trim($_POST['T_Nombre_Cliente']));
$Fac_Calle = utf8_decode(trim($_POST['T_Cliente_Calle']));
$Fac_No_Ext = trim($_POST['T_Cliente_No_Ext']);
$Fac_No_Int = trim($_POST['T_Cliente_No_Int']);
$Fac_Colonia = utf8_decode(trim($_POST['T_Cliente_Colonia']));
$Fac_CP = trim($_POST['T_Cliente_CP']);
$Fac_Ciudad = utf8_decode(trim($_POST['T_Cliente_Ciudad']));
$Fac_Estado = trim($_POST['T_Cliente_Estado']);
$Fac_Pais = trim($_POST['T_Cliente_Pais']);
$Fac_RFC = utf8_decode(trim($_POST['T_Cliente_RFC']));
$T_ID_Proveedor = trim($_POST['T_ID_Proveedor']);
$T_Proveedor_Nombre = trim($_POST['T_Proveedor_Destinatario']);
$T_Proveedor_Calle = trim($_POST['T_Proveedor_Calle']);
$T_Proveedor_No_Ext = trim($_POST['T_Cliente_No_Ext']);
$T_Proveedor_No_Int = trim($_POST['T_Cliente_No_Int']);
$T_Proveedor_Colonia = trim($_POST['T_Cliente_Colonia']);
$T_Proveedor_Pais = trim($_POST['T_Cliente_Pais']);
$T_Proveedor_Entidad = trim($_POST['T_Cliente_Entidad']);
$T_Proveedor_Ciudad = trim($_POST['T_Cliente_Ciudad']);
$T_Proveedor_Tel = trim($_POST['T_Proveedor_tel']);
$T_Proveedor_Fax = trim($_POST['T_Proveedor_fax']);
$T_Invoice_No = trim($_POST['T_Invoice_No']);
$T_Invoice_Value = trim($_POST['T_Invoice_Value']);
$T_Date = trim($_POST['T_Date']);
$T_Weight = trim($_POST['T_Weight']);
$T_Customer_Order = trim($_POST['T_Customer_Order']);
$statusPago = trim($_POST['T_pagada']);
$T_gasto_Total = trim($_POST['T_gasto_Total']);
$T_gana_Total = trim($_POST['T_gana_Total']);
$T_Sub_Total = trim($_POST['T_Sub_Total']);
$T_Total = trim($_POST['T_Total']);



//DATOS PRINCIPALES
$query_mst="UPDATE contame_t_facturas SET     fk_referencia	= ?,
                                              s_imp_exp	= ?,
                                              d_fecha	= ?,
                                              s_guia_master	= ?,
                                              n_bodegaIn	= ?,
                                              s_descripcion	= ?,
                                              s_tipoRegimen	= ?,
                                              fk_id_cliente	= ?,
                                              s_nombre	= ?,
                                              s_calle	= ?,
                                              s_no_ext	= ?,
                                              s_no_int	= ?,
                                              s_colonia	= ?,
                                              s_codigo	= ?,
                                              s_ciudad	= ?,
                                              s_estado	= ?,
                                              s_pais	= ?,
                                              s_rfc	= ?,
                                              fk_id_proveedor	= ?,
                                              s_prov_nombre	= ?,
                                              s_prov_calle	= ?,
                                              s_prov_no_ext	= ?,
                                              s_prov_no_int	= ?,
                                              s_prov_telefono	= ?,
                                              s_prov_fax	= ?,
                                              s_prov_pais	= ?,
                                              s_prov_entidad	= ?,
                                              s_prov_ciudad	= ?,
                                              n_valor_usd	= ?,
                                              n_peso	= ?,
                                              s_customerOrder	= ?,
                                              s_pagada	= ?,
                                              n_gasto	= ?,
                                              n_ganancia	= ?,
                                              n_subtotal	= ?,
                                              n_total	= ?,
                                              s_usuario_modifi	= ?
                                WHERE pk_id_ctaAme	= ?";

$stmt_mst = $db->prepare($query_mst);
if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare captura [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_mst->bind_param('ssssssssssssssssssssssssssssssssssssss', $ID_Referencia,
                                                                $Tipo,
                                                                $T_Date,
                                                                $T_Freight,
                                                                $T_Quantity,
                                                                $T_Descripction,
                                                                $T_Type,
                                                                $id_cliente,
                                                                $Fac_Nombre,
                                                                $Fac_Calle,
                                                                $Fac_No_Ext,
                                                                $Fac_No_Int,
                                                                $Fac_Colonia,
                                                                $Fac_CP,
                                                                $Fac_Ciudad,
                                                                $Fac_Estado,
                                                                $Fac_Pais,
                                                                $Fac_RFC,
                                                                $T_ID_Proveedor,
                                                                $T_Proveedor_Nombre,
                                                                $T_Proveedor_Calle,
                                                                $T_Proveedor_No_Ext,
                                                                $T_Proveedor_No_Int,
                                                                $T_Proveedor_Tel,
                                                                $T_Proveedor_Fax,
                                                                $T_Proveedor_Pais,
                                                                $T_Proveedor_Entidad,
                                                                $T_Proveedor_Ciudad,
                                                                $T_Invoice_Value,
                                                                $T_Weight ,
                                                                $T_Customer_Order,
                                                                $statusPago,
                                                                $T_gasto_Total,
                                                                $T_gana_Total,
                                                                $T_Sub_Total,
                                                                $T_Total,
                                                                $usuario,
                                                                $T_Invoice_No);


if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding captura [$stmt_mst->errno]: $stmt_mst->error";
  exit_script($system_callback);
}

if (!($stmt_mst->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution captura [$stmt_mst->errno]: $stmt_mst->error";
  //exit_script($system_callback);
}



# Fecha de vencimiento
require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_fechaVencimiento.php';
if( $rows_diasCredCLT > 0 ){
  $credito = trim($row_diasCredCLT["n_dias"]);
  $vencimiento = date("Y-m-d",strtotime("$T_Date + $credito days"));

  mysqli_query($db,"UPDATE contame_t_facturas SET
                    d_fechaVencimiento = '$vencimiento'
                    WHERE pk_id_ctaAme	 = $T_Invoice_No ");
}

require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_modificar_detalle.php';
require $root . '/conta6/Resources/PHP/actions/tarifas_calcula_borrar.php';



#************ historial ************
$descripcion = "Se modifico cuenta: $T_Invoice_No ";

$clave = 'ctaAme_fac';
$folio = $T_Invoice_No;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


//$db->commit();
//$system_callback['hon'] = $T_Date.'+'.$credito.'='.$vencimiento;
$system_callback['code'] = 1;
$system_callback['data'] = $T_Invoice_No;
$system_callback['message'] = "Script called successfully!";

exit_script($system_callback);




?>
