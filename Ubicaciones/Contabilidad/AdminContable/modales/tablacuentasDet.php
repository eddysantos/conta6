<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "SELECT * FROM conta_cs_cuentas_mst WHERE (pk_id_cuenta LIKE ? and s_cta_nivel = '1')  OR (s_cta_desc LIKE ? and s_cta_nivel = '1')";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $text, $text);
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
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  // $system_callback['data'] .=
  // "<p db-id='$row[pk_id_cuenta]'>$row[pk_id_cuenta] - $row[s_cta_desc]</p>";

  $system_callback['data'] .=
  '<tr class="row text-center m-0 borderojo">
   <td class="col-md-1 text-center">
      <a href="#EditarCatalogo" data-toggle="modal">
        <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
      </a>
    </td>
    <td class="col-md-1">'$row[pk_id_cuenta]'</td>
    <td class="col-md-4 text-left">'$row[s_cta_desc]'</td>
    <td class="col-md-1">'$row[s_cta_tipo]'</td>
    <td class="col-md-1">'$row[s_cta_nivel]'</td>
    <td class="col-md-1">'$row[s_cta_status]'</td>
    <td class="col-md-1">'$row[fk_codAgrup]'</td>
    <td class="col-md-1">'[fk_id_naturaleza]'</td>
    <td class="col-md-1">
    </td>
  </tr>';
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>


 <?php

  // $sql_consultaCuentas = mysqli_query($db,"SELECT * FROM conta_cs_cuentas_mst limit 5");
  // while($oRst_consultaCuentas = $sql_consultaCuentas->fetch_assoc()) {
  //   $id_cuenta = trim($oRst_consultaCuentas['pk_id_cuenta']);
  //   $actividad = trim($oRst_consultaCuentas['s_cta_actividad']);
?>
  <!--tr class="row text-center m-0 borderojo">
   <td class="col-md-1 text-center">
      <a href="#EditarCatalogo" data-toggle="modal">
        <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
      </a>
    </td>
    <td class="col-md-1"><?php #echo $id_cuenta; ?></td>
    <td class="col-md-4 text-left"><?php #echo trim($oRst_consultaCuentas['s_cta_desc']); ?></td>
    <td class="col-md-1"><?php #echo trim($oRst_consultaCuentas['s_cta_tipo']); ?></td>
    <td class="col-md-1"><?php #echo trim($oRst_consultaCuentas['s_cta_nivel']); ?></td>
    <td class="col-md-1"><?php /*if( $oRst_consultaCuentas['s_cta_status'] == 0 ){
                                  echo "Inactivo";
                                }else{
                                  echo "Activo";
                                }*/
                              ?>
    </td>
    <td class="col-md-1"><?php #echo trim($oRst_consultaCuentas['fk_codAgrup']); ?></td>
    <td class="col-md-1"><?php #echo trim($oRst_consultaCuentas['fk_id_naturaleza']); ?></td>
    <td class="col-md-1"><?php /*if($actividad == 1){
                                echo 'Con registros';
                              }else{
                                if( $oRst_permisos['s_modificar_ctas'] == 1){ ?>
                                  <a style="text-decoration:none;" onClick="borrar('<?php echo $id_cuenta; ?>')">
                                    <img border="0" src="/conta6/Resources/iconos/delete.svg" alt="Borrar">
                                  </a><div id="borrar_<?php echo $id_cuenta; ?>"></div>
                              <?php }} */?>
    </td>
  </tr-->
<?php// } #while($oRst_consultaCuentas ?>
