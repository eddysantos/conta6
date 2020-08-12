<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
$system_callback = [];
$id_prov = trim($_POST['id_prov']);
$query = "SELECT * FROM conta_cs_proveedores WHERE pk_id_proveedor = ?";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt->bind_param('s',$id_prov);
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
  $idproveedor = $row['pk_id_proveedor'];
  $nombre = trim($row['s_nombre']);
  $rfc = $row['s_rfc'];
  $curp = $row['s_curp'];
  $persona = $row['s_persona'];
  $direccion = utf8_encode($row['s_direccion']);
  $pais = $row['s_pais'];
  $taxid = $row['s_taxid'];
  if( $persona == 'fisica' ){
    $txtStatus_fisica = 'selected';
    $txtStatus_moral = '';
  }else{
    $txtStatus_fisica = '';
    $txtStatus_moral = 'selected';
  }
  if( $oRst_permisos['s_catalogoPersonasPROV_m'] == 1 ){
    $btnguardar = "<a href='#' onclick='btn_editProv();'><img src= '/conta6/Resources/iconos/save.svg' class='icomediano'></a>";
    $desactivar = '';
  }else{
    $btnguardar = '';
    $desactivar = 'disabled';
  }
  $system_callback['data'] .=
  "<div class='contorno font14'>
    <div class='titulo' style='margin-top: -24px;'>DATOS GENERALES</div>
    <table class='table form1'>
      <thead></thead>
      <tbody>
        <tr class='row'>
          <td class='col-md-4 input-effect mt-4'>
            <input id='id_prov' type='hidden' value='$idproveedor'>
            <input id='nombre_prov' class='efecto tiene-contenido' type='text' value='$nombre' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);' $desactivar>
            <label for='nombre_prov'>Nombre o Razón Social</label>
          </td>
          <td class='col-md-2 input-effect'>
            <label class='' for='persona_prov'>Persona</label>
            <select size='1' id='persona_prov' $desactivar class='custom-select'>
            <option value='fisica' $txtStatus_fisica>Fisica</option>
            <option value='moral' $txtStatus_moral>Moral</option>
            </select>
          </td>
          <td class='col-md-3 input-effect mt-4'>
            <input id='rfc_prov' class='efecto tiene-contenido' type='text' value='$rfc' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);' $desactivar>
            <label for='rfc_prov'>RCF</label>
          </td>
          <td class='col-md-3 input-effect mt-4'>
            <input id='curp_prov' class='efecto tiene-contenido' type='text' value='$curp' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaCURP(this);' $desactivar>
            <label for='curp_prov'>CURP</label>
          </td>
        </tr>
        <tr class='row mt-4 align-items-center'>
          <td class='col-md-2 input-effect'>
            <input id='taxid_prov' class='efecto tiene-contenido' type='text' value='$taxid' onblur='eliminaBlancosIntermedios(this);' $desactivar>
            <label for='taxid_prov'>Tax ID</label>
          </td>
          <td class='col-md-9 input-effect'>
            <input id='direccion_prov' class='efecto tiene-contenido' type='text' value='$direccion' onblur='eliminaBlancosIntermedios(this);' $desactivar>
            <label for='direccion_prov'>Dirección</label>
          </td>
          <td class='col-md-1 text-left'>$btnguardar</td>
        </tr>
       </tbody>
      </table>
    </div>";
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
?>
