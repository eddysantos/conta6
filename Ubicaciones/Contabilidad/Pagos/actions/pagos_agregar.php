<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
require $root . '/conta6/Resources/PHP/actions/consultaDatosOficinaActiva.php';
$ex_estado = limpiarBlancos($row_oficinaActiva['s_estado']);
$ex_cp = limpiarBlancos($row_oficinaActiva['s_codigo']);
$lugarExpedicion = $ex_cp;
$lugarExpedicionTxt = $ex_cp.' '.$ex_estado;

$ID_Cliente = trim($_POST['T_ID_Cliente_Oculto']);
$Fac_Nombre = utf8_decode(trim($_POST['T_Nombre_Cliente']));
$Fac_Calle = utf8_decode(trim($_POST['T_Cliente_Calle']));
$Fac_No_Ext = trim($_POST['T_Cliente_No_Ext']);
$Fac_No_Int = trim($_POST['T_Cliente_No_Int']);
$Fac_Colonia = utf8_decode(trim($_POST['T_Cliente_Colonia']));
$Fac_CP = trim($_POST['T_Cliente_CP']);
$Fac_Ciudad = utf8_decode(trim($_POST['T_Cliente_Ciudad']));
$Fac_Estado = trim($_POST['T_Cliente_Estado']);
$Fac_Pais = trim($_POST['T_Cliente_Pais']);
$Fac_taxid = trim($_POST['T_Cliente_taxid']);
$Fac_RFC = utf8_decode(trim($_POST['T_Cliente_RFC']));
$Proveedor_Destinatario = utf8_decode(trim($_POST['T_Proveedor_Destinatario']));
$idPago_sust = trim($_POST['idPago_sust']);
$uuid_sust = trim($_POST['uuid_sust']);
$tipoRel_sust = trim($_POST['tipoRel_sust']);


//DATOS PRINCIPALES
$query_mst="INSERT INTO conta_t_pagos_captura(
                                                  fk_id_aduana,
                                                  fk_usuario_alta,
                                                  fk_id_cliente,
                                                  s_nombre,
                                                  s_calle,
                                                  s_no_ext,
                                                  s_no_int,
                                                  s_colonia,
                                                  s_codigo,
                                                  s_ciudad,
                                                  s_estado,
                                                  s_pais,
                                                  s_rfc,
                                                  s_taxid,
                                                  n_lugarExpedicion_codigo,
                                                  s_lugarExpedicion_txt,
                                                  fk_c_TipoRelacion,
                                                  n_folioPagoSustituir,
                                                  s_UUIDpagoSustituir
                                                )values(?,?,?,?,?,?,?,?,?,?,
                                                        ?,?,?,?,?,?,?,?,?)";

$stmt_mst = $db->prepare($query_mst);
if (!($stmt_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare captura [$db->errno]: $db->error";
  exit_script($system_callback);
}


$stmt_mst->bind_param('sssssssssssssssssss',
                                                $aduana,
                                                $usuario,
                                                $ID_Cliente,
                                                $Fac_Nombre,
                                                $Fac_Calle ,
                                                $Fac_No_Ext,
                                                $Fac_No_Int,
                                                $Fac_Colonia,
                                                $Fac_CP ,
                                                $Fac_Ciudad ,
                                                $Fac_Estado ,
                                                $Fac_Pais ,
                                                $Fac_RFC,
                                                $Fac_taxid ,
                                                $lugarExpedicion ,
                                                $lugarExpedicionTxt,
                                                $tipoRel_sust,
                                                $idPago_sust ,
                                                $uuid_sust );


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

$nfolio = $db->insert_id;

require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/pagos_agregar_detalle.php';


$system_callback['hon'] = $query_mst;
$system_callback['code'] = 1;
$system_callback['data'] = $nfolio;
$system_callback['message'] = "Script called successfully!";

exit_script($system_callback);




?>
