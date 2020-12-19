<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

  <div class="row backpink m-0">
    <ul class="nav nav-fill w-100">
      <li class="nav-item font18 p-2">
        GENERAR CHEQUE
      </li>
    </ul>
  </div>


<!--COMIENZA CHEQUES  -->
  <div id="cheques" class="contorno text-center">
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
          <td class="col-md-12">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
              <li class="nav-item">
                <button class="w-100 btn btn-light" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Beneficiario</button>
              </li>
              <li class="nav-item mx-2">
                <button class="w-100 btn btn-light" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Cliente</button>
              </li>
              <li class="nav-item">
                <button class="w-100 btn btn-light" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Empleado</button>
              </li>
              <li class="nav-item mx-2">
                <button class="w-100 btn btn-light" id="proveedor-tab" data-toggle="pill" href="#proveedor" role="tab" aria-controls="proveedor" aria-selected="false">Proveedor</button>
              </li>
            </ul>
		      </td>
        </tr>
        <tr class="row mt-3">
          <td class="col-md-12 input-effect">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <input class="efecto popup-input" id="chebeneficiario" type="text" id-display="#popup-display-chebeneficiario" action="beneficiarios" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-chebeneficiario" style="display:none"></div>
                <label for="chebeneficiario">Beneficiario</label>
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <input class="efecto popup-input" id="checliente" type="text" id-display="#popup-display-checliente" action="clientes" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-checliente" style="display:none"></div>
                <label for="checliente">Cliente</label>
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <input class="efecto popup-input" id="cheempleado" type="text" id-display="#popup-display-cheempleado" action="empleados" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cheempleado" style="display:none"></div>
                <label for="cheempleado">Empleado</label>
              </div>

              <div class="tab-pane fade" id="proveedor" role="tabpanel" aria-labelledby="proveedor-tab">
                <input class="efecto popup-input" id="cheproveedor" type="text" id-display="#popup-display-cheproveedor" action="proveedores" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-cheproveedor" style="display:none"></div>
                <label for="cheproveedor">Proveedor</label>
              </div>
            </div>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#chebeneficiario').change(function(){
        $('#opcionActivada').val("BEN");
        $('#checliente,#cheempleado,#cheproveedor').val('');
    });

    $('#checliente').change(function(){
        $('#opcionActivada').val('CLT');
        $('#chebeneficiario,#cheempleado,#cheproveedor').val('');
    });

    $('#cheempleado').change(function(){
        $('#opcionActivada').val('EMPL');
        $('#chebeneficiario,#checliente,#cheproveedor').val('');
    });

    $('#cheproveedor').change(function(){
        $('#opcionActivada').val('PROV');
        $('#chebeneficiario,#cheempleado,#checliente').val('');
    });

    $('#btn_genFolioCheque').click(function(){
      if($('#chefecha').val() == ""){
        alertify.error("Seleccione una fecha");
        $('#chefecha').focus();
        return false;
      }
      if($('#checuenta').attr('db-id') == ""){
        alertify.error("Seleccione una cuenta");
        $('#chequecuenta').focus();
        return false;
      }
      if($('#chenumero').val() == ""){
        alertify.error("Ingrese número de cheque");
        $('#chenumero').focus();
        return false;
      }
      if($('#cheimporte').val() == ""){
        alertify.error("Ingrese valor del cheque");
        $('#cheimporte').focus();
        return false;
      }
      if($('#opcionActivada').val() == ""){
        alertify.error("Seleccione nombre a pagar");
        $('#opcionActivada').focus();
        return false;
      }
      if($('#checoncepto').val() == ""){
        alertify.error("Escriba un concepto");
        $('#checoncepto').focus();
        return false;
      }

      fecha = $('#chefecha').val();
      aduana = $('#txt_aduana').val();
      tipoDoc = 1;
      usuario = $('#txt_usuario').val();
      permiso = "s_generar_x_fecha_cheques";

      var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
      if(continuar == true) {
        genChe();
      }else{
        //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
        return false;
      }
    });
  })

  function genChe(){
    if($('#opcionActivada').val() == "BEN"){ id_expedidor = $('#chebeneficiario').attr('db-id'); }
    if($('#opcionActivada').val() == "CLT"){ id_expedidor = $('#checliente').attr('db-id'); }
    if($('#opcionActivada').val() == "EMPL"){ id_expedidor = $('#cheempleado').attr('db-id'); }
    if($('#opcionActivada').val() == "PROV"){ id_expedidor = $('#cheproveedor').attr('db-id'); }

    id_cuentaMST = $('#checuenta').attr('db-id');

    var data = {
  		fecha: $('#chefecha').val(),
      cuenta: $('#checuenta').attr('db-id'),
      cheque: $('#chenumero').val(),
      importe: $('#cheimporte').val(),
      concepto: $('#checoncepto').val(),
      opcion: $('#opcionActivada').val(),
      id_expedidor: id_expedidor
  	}

  	tipo = 5;
  	$.ajax({
  		type: "POST",
  		url: "/Ubicaciones/Contabilidad/cheques/actions/generarFolioCheque.php",
  		data: data,
  		success: 	function(r){
  		r = JSON.parse(r);
      if (r.code == 1) {
          console.log(r.data);
          id_cheque = r.data;
          window.location.replace('Detallecheque.php?id_cheque='+id_cheque+'&id_cuentaMST='+id_cuentaMST);
        } else {
          if( r.message == 'Cheque Existe'){
            swal("Ya Existe", r.message , "warning");
          }else{
            console.error(r.message);
          }
        }
      },
      error: function(x){
        console.error(x);
      }
  	});
  }
</script>
