<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

  <div class="row backpink m-0">
    <ul class="nav nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link">GENERAR CHEQUE</a>
      </li>
    </ul>
  </div>


<!--COMIENZA CHEQUES  -->
  <div id="cheques" class="contorno text-center" style="<?php echo $marginbottom ?>">
    <table class="table font14">
      <tbody>
        <tr class="row mt-3">
          <td class="col-md-3 input-effect">
  		  	  <input type="hidden" id="txt_aduana" value="<?php echo $aduana; ?>">
  			    <input type="hidden" id="txt_usuario" value="<?php echo $usuario; ?>">
            <input class="efecto tiene-contenido" type="date" id="chefecha">
            <label for="chefecha">Fecha Cheque</label>
          </td>
		      <td class="col-md-6 input-effect">
		  	    <input class="efecto popup-input" id="checuenta" type="text" id-display="#popup-display-checuenta" action="cuentas_mst_0100_oficina" db-id="" autocomplete="off">
          	<div class="popup-list" id="popup-display-checuenta" style="display:none"></div>
          	<label for="checuenta">Seleccione una Cuenta</label>
		      </td>
          <td class="col-md-1 input-effect ls1">
            <input id="chenumero" class="efecto" type="text" onchange="validaSoloNumeros(this)">
            <label for="chenumero">No.Cheque</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="cheimporte" class="efecto" type="text" onchange="validaSoloNumeros(this)">
            <label for="cheimporte">Importe</label>
          </td>
        </tr>
        <tr class="row mt-3">
          <td class="col-md-12 sub2 font14 p-0">Páguese a la orden de:</td>
        </tr>
		    <tr class="row mt-1">
          <td class="col-md-3">
            <button type="button" class="chebeneficiario btn-outline-secondary efecto">Beneficiario</button>
		      </td>
          <td class="col-md-3">
            <button type="button" class="checliente btn-outline-secondary efecto">Cliente</button>
		      </td>
          <td class="col-md-3">
            <button type="button" class="cheempleado btn-outline-secondary efecto">Empleado</button>
          </td>
          <td class="col-md-3">
            <button type="button" class="cheproveedor btn-outline-secondary efecto">Proveedor</button>
		      </td>
        </tr>
        <tr class="row mt-3">
          <td class="col-md-12 input-effect" style="display:none" id="chebeneficiario1">
            <input class="efecto popup-input" id="chebeneficiario" type="text" id-display="#popup-display-chebeneficiario" action="beneficiarios" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-chebeneficiario" style="display:none"></div>
            <label for="chebeneficiario">Beneficiario</label>
          </td>

          <td class="col-md-12 input-effect" style="display:none" id="checliente1">
            <input class="efecto popup-input" id="checliente" type="text" id-display="#popup-display-checliente" action="clientes" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-checliente" style="display:none"></div>
            <label for="checliente">Cliente</label>
          </td>

          <td class="col-md-12 input-effect" style="display:none" id="cheempleado1">
            <input class="efecto popup-input" id="cheempleado" type="text" id-display="#popup-display-cheempleado" action="empleados" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-cheempleado" style="display:none"></div>
            <label for="cheempleado">Empleado</label>
          </td>

          <td class="col-md-12 input-effect" style="display:none" id="cheproveedor1">
            <input class="efecto popup-input" id="cheproveedor" type="text" id-display="#popup-display-cheproveedor" action="proveedores" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-cheproveedor" style="display:none"></div>
            <label for="cheproveedor">Proveedor</label>
          </td>
        </tr>
        <tr class="row mt-3">
          <td class="col-9 input-effect">
            <input id="checoncepto" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);">
            <label for="checoncepto">Concepto</label>
          </td>
          <td class="col-md-3">
		  	    <input type="hidden" id="opcionActivada">
            <a href="#" class="boton p-1" id="btn_genFolioCheque"><img src= "/Resources/iconos/001-add.svg" class="icochico"> GENERAR CHEQUE</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

<?php
require $root . '/Ubicaciones/footer.php';
?>
