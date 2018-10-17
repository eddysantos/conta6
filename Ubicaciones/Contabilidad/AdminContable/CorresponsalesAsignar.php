<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $id_corresp = trim($_GET['id_corresp']);
  $nombre ="";

  $queryCorresp = "SELECT * FROM conta_t_corresponsales WHERE pk_id_corresp = ?";
  $stmtCorresp = $db->prepare($queryCorresp);
  if (!($stmtCorresp)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmtCorresp->bind_param('s', $id_corresp);
  if (!($stmtCorresp)) {die("Error during variables binding [$stmtCorresp->errno]: $stmtCorresp->error");}
  if (!($stmtCorresp->execute())) { die("Error during query prepare [$stmtCorresp->errno]: $stmtCorresp->error"); }
  $rsltCorresp = $stmtCorresp->get_result();
  $rowCorresp = $rsltCorresp->fetch_assoc();
  $nombre = $rowCorresp['s_nombre'];



  $query = "SELECT * FROM conta_replica_clientes WHERE fk_id_corresp = ? order by s_nombre";
  $stmt = $db->prepare($query);
  if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmt->bind_param('s', $id_corresp);
  if (!($stmt)) {die("Error during variables binding [$stmt->errno]: $stmt->error");}
  if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }

  $rslt = $stmt->get_result();
  $rows = $rslt->num_rows;
  while($row = $rslt->fetch_assoc()){
    $pk_id_cliente = '"'.$row['pk_id_cliente'].'"';
    $correp=0;
    $tablaClienteCorresponsales .=
    '<tr class="row m-0 borderojo">
      <td class="col-md-1">
        <a href="#" onclick="asigCorresponsal(0,'.$pk_id_cliente.')"><img class="icochico" src="/conta6/Resources/iconos/002-trash.svg"></a>
      </td>
      <td class="col-md-4">'.$row['pk_id_cliente'].'</td>
      <td class="col-md-5">'.$row['s_nombre'].'</td>
    </tr>';
  }

?>

<div class="text-center mb-10 font14">
  <div class="contorno mt-5">
    <h5 class="titulo">CATÁLOGO</h5>
    <table class="table form1">
      <tbody>
        <tr class="row m-0">
          <td class="col-md-2 text-left"><a href="/Conta6/Ubicaciones/Contabilidad/AdminContable/Corresponsales.php"><img src= "/conta6/Resources/iconos/left.svg" class="icochico"> REGRESAR</a></td>
          <td class="col-md-8 input-effect">
            <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoTieneCorresponsal" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
            <label for="corp-cliente">Cliente</label>
          </td>
          <td class="col-md-2">
            <input id="id_corresp" type="hidden" value="<?php echo $id_corresp;?>">
            <a href="#" onclick="asigCorresponsal(<?php echo $id_corresp;?>,0)" class="boton border-0 text-left"><img src= "/conta6/Resources/iconos/add.svg" class="icochico">  AGREGAR</a>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-hover fixed-table">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-12">CLIENTES ASIGNADOS AL CORRESPONSAL //   <span class="colorRosa"><?php echo $id_corresp.' '.$nombre; ?></span> </td>
        </tr>
        <tr class="row m-0 sub2 font14">
          <td class="col-md-1"></td>
          <td class="col-md-4">CLIENTE</td>
          <td class="col-md-5">NOMBRE</td>
        </tr>
      </thead>
      <tbody><?php echo $tablaClienteCorresponsales; ?></tbody>
    </table>
  </div>
</div>

<?php
 require_once('modales/ModalCorresponsales.php');
 require $root . '/conta6/Ubicaciones/footer.php';
?>
