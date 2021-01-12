<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
  require $root . '/Resources/PHP/actions/numtoletras.php';

  $lst_cuentas = "";
  #$id_cuentaMST = $_GET['id_cuentaMST'];

  if (isset( $_GET['accion'] )){
    $accion = $_GET['accion'];
  }else{
    $accion = "";
  }
	$sql_Select = "SELECT * from conta_cs_cuentas_mst ORDER BY pk_id_cuenta";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
	$rows = $rslt->num_rows;

	while ($row = $rslt->fetch_assoc()) {
		if( $row['s_cta_status'] == 1 ){ $txt_captura = "Permitido"; }else{ $txt_captura = "Denegado"; }
		if( $row['s_cta_actividad'] == 1 ){
			$img = '<img src="/Resources/iconos/check.svg" style="margin-top:-4px" class="w-25">';
		}else{
			$img = '<img src="/Resources/iconos/cross.svg" style="margin-top:-4px" class="w-25">';
		}

		$lst_cuentas .=
	  "<tr class='row m-0 borderojo pt-2 pb-1 p-0 text-center'>
	      <td class='sm font12 p-0 border-0'>$row[pk_id_cuenta]</td>
	      <td class='text-left font12 gde p-0 border-0'>$row[s_cta_desc]</td>
	      <td class='small p-0 border-0'>$row[s_cta_tipo]</td>
	      <td class='small p-0 border-0'>$row[s_cta_nivel]</td>
	      <td class='small p-0 border-0'>$txt_captura</td>
	      <td class='small p-0 border-0'>$row[fk_codAgrup]</td>
	      <td class='small p-0 border-0'>$row[fk_id_naturaleza]</td>
	      <td class='small p-0 border-0'>$img</td>
	      <td class='small p-0 border-0'>$row[s_cta_identificador_tipo]</td>
	      <td class='small p-0 border-0'>$row[s_cta_identificador]</td>
	    </tr>";
	}


?>


<body <?php if( $accion == "I" ){ echo "onload='print();'"; } ?> >
<table class="table table-hover">
	<thead class="font18">
		<tr class="row encabezado m-0 text-center">
			<td class="col-md-12">Cuentas Contables al&nbsp;<?php echo date("Y-m-d H:i:s"); ?></td>
		</tr>
	</thead>
	<tbody>
		<tr class="row m-0 backpink text-center">
			<td class="sm">CUENTA</td>
			<td class="gde">DESCRIPCION</td>
			<td class="small">TIPO</td>
			<td class="small">NIVEL</td>
			<td class="small">LINEA DE CAPTURA</td>
			<td class="small">CodAgrup SAT</td>
			<td class="small">NATUR SAT</td>
			<td class="small">CON DATOS</td>
			<td class="small">PERTENECE A:</td>
			<td class="small">IDENTIDICADOR</td>
		</tr>
				<?php echo $lst_cuentas; ?>
	</tbody>
</table>

<?php require $root . '/Ubicaciones/footer.php'; ?>
