<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

require $root . '/Resources/PHP/actions/numtoletras.php';

$Total = trim($_POST['total']);


$system_callback = [];

$system_callback['code'] = "1";
$system_callback['data'] = "*** ".numtoletras($Total)." ***";
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
