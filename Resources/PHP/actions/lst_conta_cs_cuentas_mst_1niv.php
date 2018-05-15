<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$query = "SELECT * FROM conta_cs_cuentas_mst
                WHERE pk_id_cuenta LIKE '%-00000'
                and pk_id_cuenta not like '0108%'
                and pk_id_cuenta not like '0208%'
                and pk_id_cuenta not like '0106%'
                and pk_id_cuenta not like '0203%'
                and pk_id_cuenta not like '0206%'
                ORDER BY pk_id_cuenta";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .=
  "<option value=".trim($row['pk_id_cuenta']).">".trim($row['pk_id_cuenta'])." ----- ".htmlentities(trim($row['s_cta_desc']))."</option>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
