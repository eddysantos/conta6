<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$id_ben = trim($_POST['id_ben']);
$query = "SELECT * FROM conta_cs_beneficiarios WHERE pk_id_benef = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_ben);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

  $row = $rslt->fetch_assoc();
  $nombre = utf8_encode($row['s_nombre']);
  $rfc = utf8_encode($row['s_rfc']);
  $taxid = utf8_encode($row['s_taxid']);

  if( $oRst_permisos['s_benefModificar_cheques'] == 1 ){
    $btnguardar = "<a href='#' onclick='btn_editBen();'><img src= '/conta6/Resources/iconos/save.svg' class='icomediano'></a>";
  }else{ $btnguardar = ''; }

  $system_callback['data'] .=
  "<div class='contorno font14'>
    <h5 class='titulo '>DATOS GENERALES</h5>
    <table class='table form1'>
      <thead></thead>
      <tbody>
        <tr class='row mt-4'>
          <td class='col-md-4 input-effect'>
            <input id='nombre' class='efecto tiene-contenido' type='text' value='$nombre' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);'>
            <label for='nombre'>PERSONA</label>
          </td>
          <td class='col-md-4 input-effect'>
            <input id='rfc' class='efecto tiene-contenido' type='text' value='$rfc' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);'>
            <label for='rfc'>RCF</label>
          </td>
          <td class='col-md-3 input-effect'>
            <input id='taxid' class='efecto tiene-contenido' type='text' value='$taxid' onblur='eliminaBlancosIntermedios(this);'>
            <label for='taxid'>Tax ID</label>
          </td>
          <td class='col-md-1 mt-2 text-left'>$btnguardar</td>
        </tr>
       </tbody>
      </table>
    </div>";

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
