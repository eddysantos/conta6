<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link" id="submenuMed">GENERAR CHEQUE</a>
      </li>
    </ul>
  </div>


<!--COMIENZA CHEQUES  -->
  <div id="cheques" class="contorno text-center">
    <table class="table form1 font14">
      <tbody>
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
  		  	  <input type="hidden" id="txt_aduana" value="<?php echo $aduana; ?>">
  			    <input type="hidden" id="txt_usuario" value="<?php echo $usuario; ?>">
            <input class="efecto tiene-contenido" type="date" id="chefecha">
            <label for="chefecha">Fecha Cheque</label>
          </td>
		      <td class="col-md-4 input-effect">
		  	    <input class="efecto popup-input" id="checuenta" type="text" id-display="#popup-display-checuenta" action="cuentas_mst_0100_oficina" db-id="" autocomplete="new-password">
          	<div class="popup-list" id="popup-display-checuenta" style="display:none"></div>
          	<label for="checuenta">Seleccione una Cuenta</label>
		      </td>
          <td class="col-md-2 input-effect">
            <input id="chenumero" class="efecto" type="text" onchange="validaSoloNumeros(this)">
            <label for="chenumero">No.Cheque</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="cheimporte" class="efecto" type="text" onchange="validaSoloNumeros(this)">
            <label for="cheimporte">Importe</label>
          </td>
        </tr>
        <!-- <tr class="row m-0 mt-5">


          <td class="col-md-6 input-effect"></td>
        </tr> -->
        <tr class="row mt-3 m-0">
          <td class="col-md-12 sub2" style="font-size:14px!important">Páguese a la orden de:</td>
        </tr>
		    <tr class="row m-0 mt-5">
          <!-- <td class="col-md-3 input-effect">&nbsp;</td> -->
          <td class="col-md-3 input-effect">
            <input class="efecto popup-input" id="chebeneficiario" type="text" id-display="#popup-display-chebeneficiario" action="beneficiarios" db-id="" autocomplete="new-password">
          	<div class="popup-list" id="popup-display-chebeneficiario" style="display:none"></div>
          	<label for="chebeneficiario">Beneficiario</label>
		      </td>
        <!-- </tr>
		    <tr class="row m-0 mt-5"> -->
          <td class="col-md-3 input-effect">
		  	    <input class="efecto popup-input" id="checliente" type="text" id-display="#popup-display-checliente" action="clientes" db-id="" autocomplete="new-password">
          	<div class="popup-list" id="popup-display-checliente" style="display:none"></div>
          	<label for="checliente">Cliente</label>
		      </td>
          <td class="col-md-3 input-effect">
		  	    <input class="efecto popup-input" id="cheempleado" type="text" id-display="#popup-display-cheempleado" action="empleados" db-id="" autocomplete="new-password">
          	<div class="popup-list" id="popup-display-cheempleado" style="display:none"></div>
          	<label for="cheempleado">Empleado</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto popup-input" id="cheproveedor" type="text" id-display="#popup-display-cheproveedor" action="proveedores" db-id="" autocomplete="new-password">
          	<div class="popup-list" id="popup-display-cheproveedor" style="display:none"></div>
          	<label for="cheproveedor">Proveedor</label>
		      </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-9 input-effect">
            <input id="checoncepto" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);">
            <label for="checoncepto">Concepto</label>
          </td>
          <td class="col-md-3">
		  	    <input type="hidden" id="opcionActivada" db-id>
            <a href="#" class="boton" id="btn_genFolioCheque"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR CHEQUE</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
