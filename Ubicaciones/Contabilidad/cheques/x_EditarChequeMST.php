<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $id_cheque = $_GET['id_cheque'];
  $id_cuentaMST = $_GET['id_cuentaMST'];

  $sql_Select = "SELECT * from conta_t_cheques_mst Where pk_id_cheque = ? AND fk_id_cuentaMST = ?";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt->bind_param('ss', $id_cheque,$id_cuentaMST);
	if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();
  $rowMST = $rslt->fetch_assoc();

?>
<!--Editar Datos de Anticipo-->
<!--div class="modal fade text-center" id="ch-editarRegMST" style="margin-top:50px"-->
<div class="text-center" id="ch-editarRegMST" style="margin-top:50px">
  <!--div class="modal-dialog modal-xl"-->
  <div>
    <!--div class="modal-content"-->
    <div>
      <!--div class="modal-header"-->
      <div>
        <!--button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button-->
        <h5 class="modal-tittle">Editar Datos de Cheque</h5>
      </div>
      <!--div class="modal-body"-->
      <div>
        <div class="contorno" id="contorno">
          <table class="table form1 font14">
            <tbody>
              <td class="col-md-3 input-effect">
       		  	    <input class="efecto popup-input" id="chCta" type="text" id-display="#popup-display-chCta" action="cuentas_mst_0100_oficina" db-id="" autocomplete="new-password">
                 	<div class="popup-list" id="popup-display-chCta" style="display:none"></div>
                 	<label for="chCta">Seleccione una Cuenta</label>
       		    </td>
              <tr class="row m-0 mt-5">
                  <td class="col-md-3 input-effect">Páguese a la orden de:</td>
              </tr>
              <tr class="row m-0 mt-5">
                  <td class="col-md-6 input-effect">
                    <input class="efecto popup-input" id="chBen" type="text" id-display="#popup-display-chBen" action="beneficiarios" db-id="" autocomplete="new-password">
                  	<div class="popup-list" id="popup-display-chBen" style="display:none"></div>
                  	<label for="chBen">Beneficiario</label>
        		       </td>
                   <td class="col-md-3 input-effect">
         		  	    <input class="efecto popup-input" id="chClt" type="text" id-display="#popup-display-chClt" action="clientes" db-id="" autocomplete="new-password">
                   	<div class="popup-list" id="popup-display-chClt" style="display:none"></div>
                   	<label for="chClt">Cliente</label>
         		      </td>
              </tr>
        		  <tr class="row m-0 mt-5">
                  <td class="col-md-3 input-effect">
          		  	  <input class="efecto popup-input" id="chEmp" type="text" id-display="#popup-display-chEmp" action="empleados" db-id="" autocomplete="new-password">
                  	<div class="popup-list" id="popup-display-chEmp" style="display:none"></div>
                  	<label for="chEmp">Empleado</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <input class="efecto popup-input" id="chProv" type="text" id-display="#popup-display-chProv" action="proveedores" db-id="" autocomplete="new-password">
                  	<div class="popup-list" id="popup-display-chProv" style="display:none"></div>
                  	<label for="chProv">Proveedor</label>
        		      </td>
              </tr>

              <tr class="row m-0 mt-5">
                <td class="col-md-3">
                  <input class="efecto tiene-contenido" type="text"  value="3345">
                  <label for="ch-fecha">Cheque</label>
                </td>

                <td class="col-md-3">
                  <input id="ch-fecha" class="efecto tiene-contenido" type="date" value="<?php echo $rowMST['d_fecha']; ?>">
                  <label for="ch-fecha">Fecha</label>
                </td>

                <td class="col-md-3">
                  <input class="efecto tiene-contenido" type="text" value="<?php echo $rowMST['n_valor']; ?>">
                  <label for="ch-fecha">Importe</label>
                </td>

                <td class="col-md-3">
                  <input id="ch-cuenta" class="efecto tiene-contenido" type="text" readonly
                   value="<?php echo $rowMST['fk_id_cuentaMST']; ?>" db-id="<?php echo $rowMST['fk_id_cuentaMST']; ?>">
                  <label for="ch-cuenta">Cuenta</label>
                </td>
              </tr>
              <tr class="row mt-5 m-0">
                <td class="col-md-6">
                  <input type="text" class="efecto tiene-contenido" id="ch-beneficiario" readonly
                  value="<?php echo $rowMST['s_nomOrd']; ?>" db-id="<?php echo $rowMST['fk_idOrd']; ?>">
                  <label for="ch-beneficiario">Páguese a la orden de:</label>
                </td>
                <td class="col-md-6">
                  <input id="ch-concep" class="efecto tiene-contenido" value="<?php echo $rowMST['s_concepto']; ?>" type="text">
                  <label for="ch-concep">CONCEPTO</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!--div class="modal-footer"-->
      <div>
        <input type="hidden" id="opcAct" db-id="<?php echo $rowMST['s_tipoOrdenante']; ?>">
        <a href="" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Ubicaciones/footer.php';

?>
