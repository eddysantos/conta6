<?php

$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];


$accion = trim($_POST['accion']);

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';

//CUENTAS DE PRIMER NIVEL - CUENTA MAESTRA
if( $accion == 'MST' ){
    $ctaSAT = trim($_POST['ctaSAT']);
    $natur = trim($_POST['naturSAT']);
    $Tipo = trim($_POST['tipo']);
    $Cta_Mta = trim($_POST['ctamaestra']);
    $Descripcion_Cta = $_POST['concepto'] ;


    mysqli_query($db,"INSERT INTO conta_cs_cuentas_mst(pk_id_cuenta,s_cta_desc,s_cta_tipo,s_cta_nivel,fk_codAgrup,fk_id_naturaleza,s_usuario_alta)
    VALUES ('$Cta_Mta','$Descripcion_Cta','$Tipo','1','$ctaSAT','$natur','$usuario')");

    echo $descripcion = "Se Genero la Cuenta Maestra: $Cta_Mta, $Descripcion_Cta";
}



//HISTORIAL
$clave = 'admonCtas';
$folio = $Cta_Mta;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

?>
