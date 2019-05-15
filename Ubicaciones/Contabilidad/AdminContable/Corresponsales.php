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
    '<tr class="row m-0 borderojo">
      <td class="col-md-1">
        <a href="#" onclick="correspAsignar('.$pk_id_corresp.')" data-toggle="modal">
          <img class="icochico ml-5" src="/conta6/Resources/iconos/001-add.svg">
        </a>
      </td>
      <td class="col-md-2">'.$pk_id_corresp.'</td>
      <td class="col-md-2">'.$row['fk_id_cliente'].'</td>
      <td class="col-md-7">'.$row['s_nombre'].'</td>
    </tr>';
  }

?>

<div class="text-center mb-10 font14">
  <div class="contorno mt-5">
    <h5 class="titulo">CATÁLOGO</h5>
    <table class="table form1">
      <tbody>
        <tr class="row m-0 align-items-center">
          <td class="col-md-1">
            <a><img class="icomediano ml-2" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
          <td class="col-md-8 input-effect">
            <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoEsCorresponsal" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
            <label for="corp-cliente">Cliente</label>
          </td>
          <td class="col-md-3">
            <a href="#" id="genCorresponsal" class="boton border-0 text-left"><img src= "/conta6/Resources/iconos/add.svg" class="icochico">  NUEVO CORRESPONSAL</a>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-hover fixed-table">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-1"></td>
          <td class="col-md-2">CORRESPONSAL</td>
          <td class="col-md-2">CLIENTE</td>
          <td class="col-md-7">NOMBRE</td>
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
