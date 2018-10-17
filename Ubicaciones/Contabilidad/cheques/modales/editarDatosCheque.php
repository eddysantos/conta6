<?php


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

  $opcion = $rowMST['s_tipoOrdenante'];
  if( $opcion == "BEN"){
    $idBen = $rowMST['fk_idOrd'];
    $nomBen = $rowMST['s_nomOrd'];
  }
  if( $opcion == "CLT"){
    $idClt = $rowMST['fk_idOrd'];
    $nomClt = $rowMST['s_nomOrd'];
  }
  if( $opcion == "EMPL"){
    $idEmp = $rowMST['fk_idOrd'];
    $nomEmp = $rowMST['s_nomOrd'];
  }
  if( $opcion == "PROV"){
    $idProv = $rowMST['fk_idOrd'];
    $nomProv = $rowMST['s_nomOrd'];
  }
echo $opcion;


?>
<!--Editar Datos de Anticipo-->
<div class="modal fade text-center" id="ch-editarRegMST" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos de Cheque</h5>
      </div>
      <div class="modal-body">
        <div>
          <div class="contorno">
            <table class="table form1 font14">
              <tbody>
                <tr class="row m-0 mt-3">
                  <td class="col-md-12 sub2" style="font-size:14px!important">Páguese a la orden de:</td>
                </tr>
                <tr class="row m-0 mt-5">
                  <td class="col-md-6 input-effect">
                    <input class="efecto popup-input tiene-contenido" id="chBen" type="text" id-display="#popup-display-chBen" action="beneficiarios" autocomplete="off"
                      value="<?php echo $nomBen; ?>" db-id="<?php echo $idBen; ?>">
                    <div class="popup-list" id="popup-display-chBen" style="display:none"></div>
                    <label for="chBen">Beneficiario</label>
                   </td>
                   <td class="col-md-6 input-effect">
                    <input class="efecto popup-input tiene-contenido" id="chClt" type="text" id-display="#popup-display-chClt" action="clientes" autocomplete="off"
                      value="<?php echo $nomClt; ?>" db-id="<?php echo $idClt; ?>">
                    <div class="popup-list" id="popup-display-chClt" style="display:none"></div>
                    <label for="chClt">Cliente</label>
                  </td>
                </tr>
                <tr class="row m-0 mt-5">
                    <td class="col-md-6 input-effect">
                      <input class="efecto popup-input tiene-contenido" id="chEmp" type="text" id-display="#popup-display-chEmp" action="empleados" autocomplete="off"
                        value="<?php echo $nomEmp; ?>" db-id="<?php echo $idEmp; ?>">
                      <div class="popup-list" id="popup-display-chEmp" style="display:none"></div>
                      <label for="chEmp">Empleado</label>
                    </td>
                    <td class="col-md-6 input-effect">
                      <input class="efecto popup-input tiene-contenido" id="chProv" type="text" id-display="#popup-display-chProv" action="proveedores" autocomplete="off"
                        value="<?php echo $nomProv; ?>" db-id="<?php echo $idProv; ?>">
                      <div class="popup-list" id="popup-display-chProv" style="display:none"></div>
                      <label for="chProv">Proveedor</label>
                    </td>
                </tr>

                <tr class="row m-0 mt-5">
                  <td class="col-md-3">
                    <input id="chNum" class="efecto tiene-contenido" type="text" value="<?php echo $rowMST['pk_id_cheque']; ?>" onchange="validaSoloNumeros(this)">
                    <label for="chNum">Cheque</label>
                    <input id="idcheque_folControl" type="hidden" value="<?php echo $rowMST['pk_idcheque_folControl']; ?>">
                  </td>

                  <td class="col-md-3">
                    <input id="chFecha" class="efecto tiene-contenido" type="date" value="<?php echo $rowMST['d_fechache']; ?>">
                    <label for="chFecha">Fecha</label>
                  </td>

                  <td class="col-md-3">
                    <input id="chImporte" class="efecto tiene-contenido" type="text" value="<?php echo $rowMST['n_valor']; ?>" onchange="validaSoloNumeros(this)">
                    <label for="chImporte">Importe</label>
                  </td>

                  <td class="col-md-3">
                    <input class="efecto tiene-contenido popup-input" id="chCta" type="text" id-display="#popup-display-chCta" action="cuentas_mst_0100_oficina" autocomplete="off"
                      value="<?php echo $rowMST['fk_id_cuentaMST']; ?>" db-id="<?php echo $rowMST['fk_id_cuentaMST']; ?>">
                    <div class="popup-list" id="popup-display-chCta" style="display:none"></div>
                    <label for="chCta">Cuenta</label>
                  </td>
                </tr>
                <tr class="row mt-5 m-0">
                  <td class="col-md-12">
                    <input id="chConcep" class="efecto tiene-contenido" value="<?php echo $rowMST['s_concepto']; ?>" type="text" onchange="eliminaBlancosIntermedios(this);">
                    <label for="chConcep">Concepto</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="opcAct" value="<?php echo $opcion; ?>">
        <a href="#" id="medit-chequeMST" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
