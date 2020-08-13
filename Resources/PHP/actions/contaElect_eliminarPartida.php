<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$partida = trim($_POST['partida']);
$id_poliza = trim($_POST['id_poliza']);

require $root . '/Resources/PHP/actions/contaElect_eliminar.php';

$descripcion = "Se elimino la Partida: $partida de Contabilidad Electronica";

$clave = 'contaElect';
$folio = $id_poliza;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
