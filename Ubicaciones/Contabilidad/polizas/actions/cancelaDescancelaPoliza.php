<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$id_poliza = trim($_POST['id_poliza']);
$status = trim($_POST['statusPoliza']);

require $root . '/Resources/PHP/actions/cancelarPoliza.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
