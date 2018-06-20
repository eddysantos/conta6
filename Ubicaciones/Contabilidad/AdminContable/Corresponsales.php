<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $query = "SELECT * FROM conta_t_corresponsales order by s_nombre";
  $stmt = $db->prepare($query);
  if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
  if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }

  $rslt = $stmt->get_result();
  $rows = $rslt->num_rows;
  while($row = $rslt->fetch_assoc()){
    $pk_id_corresp = $row['pk_id_corresp'];
    $tablaCorresponsales .=
    "<tr class='row m-0 borderojo'>
      <td class='col-md-1'>
        <a href='#' onclick='correspAsignar($pk_id_corresp)' data-toggle='modal'>
          <img class='icochico ml-5' src='/conta6/Resources/iconos/001-add.svg'>
        </a>
      </td>
      <td class='col-md-4'>$pk_id_corresp</td>
      <td class='col-md-4'>$row[fk_id_cliente]</td>
      <td class='col-md-5'>$row[s_nombre]</td>
    </tr>";
  }

?>

<div class="container-fluid text-center">
  <div class="contorno mt-5">
    <h5 class="titulo font14">CATÁLOGO</h5>
    <table class="table">
      <tbody class="font14">
        <tr class="row m-0">
          <td class="col-md-1">
            <a><img class="icomediano ml-2" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
          <td class="col-md-3 offset-md-8">
            <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoEsCorresponsal" db-id="" autocomplete="new-password">
            <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
            <label for="corp-cliente">Cliente</label>
            <a href="#" id="genCorresponsal" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico">  AGREGAR NUEVO CORRESPONSAL</a>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-hover font14">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-1"></td>
          <td class="col-md-4">CORRESPONSAL</td>
          <td class="col-md-4">CLIENTE</td>
          <td class="col-md-5">NOMBRE</td>
        </tr>
      </thead>
      <tbody><?php echo $tablaCorresponsales; ?></tbody>
    </table>
  </div>
</div>

 <?php
 require_once('modales/ModalCorresponsales.php');
 require $root . '/conta6/Ubicaciones/footer.php';
 
?>
