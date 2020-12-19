<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<input type="hidden" id="diaaduana" value="<?php echo $aduana;?>">
<input type="hidden" id="diausuario" value="<?php echo $usuario;?>">

<div class="text-center">
  <div class="row backpink m-0">
    <ul class="nav nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link pol" status='cerrado' accion="poldiario">POLIZA DE DIARIO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pol" status='cerrado' accion="polingreso">POLIZA DE INGRESO</a>
      </li>
    </ul>
  </div>

  <div id="gpoliza" class="contorno" style="display:none">
    <table class="table font14">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12 p-1">GENERAR POLIZA</td>
        </tr>
      </thead>
      <tbody >
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido pl-5" type="date" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="diaconcepto" class="efecto" type="text" maxlength="300" onchange="eliminaBlancosIntermedios(this)">
            <label for="diaconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="diatipo" class="efecto tiene-contenido" readonly>
            <label for="diatipo">Tipo</label>
          </td>
        </tr>
        <tr class="row justify-content-center mt-5">
          <td class="col-md-3">
            <a href="#" id="genFolioPolDia" class="boton p-1"><img src= "/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php
require $root . '/Ubicaciones/footer.php';
?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.pol').click(function(){
      var accion = $(this).attr('accion');
      var status = $(this).attr('status');

      $('#selecTipoPoliza').find('a').css('color', "");
      $('#selecTipoPoliza').find('a').css('font-size', "");
      $(this).attr('status', 'abierto');
  		$(this).css('cssText', 'color: #58595b!important');
      $(this).css('cssText', 'font-weight: bold!important');
      $(this).css('font-size', '18px');


      switch (accion) {
        case "poldiario":
  				$('#gpoliza').fadeIn();
  				$('#diatipo').val('4 Diario');
  				$('#diatipo').attr('db-id','4');
          break;

        case "polingreso":
  				$('#gpoliza').fadeIn();
  				$('#diatipo').val('2 Ingreso');
  				$('#diatipo').attr('db-id','2');
          break;

          // case "dtospol":
          // if (status == 'cerrado') {
          //   $('#datospoliza').fadeIn();
          //   $(this).attr('status', 'abierto');
          //   $(this).css('cssText', 'color: #58595b!important');
  				// 	$(this).css('cssText', 'font-weight: bold!important');
          //   $(this).css('font-size', '18px');
          // } else {
          //   $('#datospoliza').fadeOut();
          //   $(this).attr('status', 'cerrado');
          //   $(this).css('color', "");
          //   $(this).css('font-size', "");
          // }
          //   break;
        default:
        console.error("Something went terribly wrong...");

      }

    });

    $('#genFolioPolDia').click(function(){
			if($('#diafecha').val() == ""){
				alertify.error("Seleccione una fecha");
				$('#diafecha').focus();
				return false;
			}

			if($('#diaconcepto').val() == ""){
				alertify.error("Escriba un concepto");
				$('#diaconcepto').focus();
				return false;
			}

			fecha = $('#diafecha').val();
			aduana = $('#diaaduana').val();
			tipoDoc = $('#diatipo').attr('db-id');
			usuario = $('#diausuario').val();
			permiso = "s_generar_x_fecha_polizas";

			var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
			if(continuar == true) {
				genPol(); //funsion para generar poliza
			}else{
				return false;
			}
		});
  })

  function genPol(){
  	var data = {
  		diafecha: $('#diafecha').val(),
  		diaconcepto: $('#diaconcepto').val(),
  		diaaduana: $('#diaaduana').val(),
  		diatipo: $('#diatipo').attr('db-id')
  	}

  	tipo = $('#diatipo').attr('db-id');
  	$.ajax({
  		type: "POST",
  		url: "/Ubicaciones/Contabilidad/polizas/actions/generarFolioPoliza.php",
  		data: data,
  		success: 	function(request){
  			r = JSON.parse(request);
  				if (r.code == 1) {
  					console.log(r);
  					id_poliza = r.data;
  					window.location.replace('Detallepoliza.php?id_poliza='+id_poliza+'&tipo='+tipo);
  				} else {
  					console.error(r.message);
  				}
  			},
  			error: function(x){
  				console.error(x);
  			}

  	});
  }
</script>
