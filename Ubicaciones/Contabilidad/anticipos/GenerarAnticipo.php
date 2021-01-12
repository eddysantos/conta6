<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="row backpink m-0">
  <ul class="nav nav-pills nav-fill w-100">
    <li class="nav-item font18 p-2">
      GENERAR ANTICIPO
    </li>
  </ul>
</div>

<input type="hidden" id="txt_usuario" value="<?php echo $usuario;?>">
<input type="hidden" id="txt_aduana" value="<?php echo $aduana;?>">

<div id="anticipos" class="contorno text-center">
  <table class="table form1 font14">
    <tbody>
      <tr class="row m-0 mt-3">
        <td class="col-md-2 input-effect">
          <input class="efecto tiene-contenido" type="date" id="antfecha">
          <label for="antfecha">Fecha Anticipo</label>
        </td>
        <td class="col-md-2 input-effect">
          <input id="antimporte" class="efecto" type="text" onchange="validaSoloNumeros(this)">
          <label for="antimporte">Importe</label>
        </td>
        <td class="col-md-8 input-effect">
          <input class="efecto popup-input" id="antcliente" type="text" id-display="#popup-display-antcliente" action="clientes" db-id="" autocomplete="off"
            onblur="Actualiza_Expedido_Cliente()">
          <div class="popup-list" id="popup-display-antcliente" style="display:none"></div>
          <label for="antcliente">Cliente</label>
        </td>
      </tr>
      <tr class="row m-0 mt-4">
        <td class="col-md-4 input-effect">
          <select class="custom-select" size='1' name='antbcocliente' id='antbcocliente'>
            <option selected value='0'>Seleccione Banco</option>
          </select>
        </td>
        <td class="col-md-8 input-effect">
          <select class="custom-select" size='1' name='antcuenta' id='antcuenta'>
            <option selected value='0'>Seleccione una Cuenta</option>
          </select>
        </td>
      </tr>
      <tr class="row  m-0 mt-4">
        <td class="col-9 input-effect">
          <input id="antconcepto" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this)">
          <label for="antconcepto">Concepto</label>
        </td>
        <td class="col-md-3">
          <a href="#" id="genFolioAnticipo" class="boton"><img src= "/Resources/iconos/001-add.svg" class="icochico"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
        </td>
      </tr>
    </tbody>
  </table>
</div><!--/Termina Generar Poliza de Ingreso-->

<?php
require $root . '/Ubicaciones/footer.php';
?>


<script type="text/javascript">
$(document).ready(function(){

  $('#genFolioAnticipo').click(function(){

    if($('#antfecha').val() == ""){
      alertify.error("Seleccione una fecha");
      $('#antfecha').focus();
      return false;
    }

    if($('#antimporte').val() == "" || $('#antimporte').val() == 0){
      alertify.error("Ingrese un importe");
      $('#antimporte').focus();
      return false;
    }

    if($('#antcliente').attr('db-id') == ""){
      alertify.error("Seleccione un cliente");
      $('#antcliente').focus();
      return false;
    }

    if($('#antbcocliente').val() == "" || $('#antbcocliente').val() == 0){
      alertify.error("Seleccione un banco");
      $('#antbcocliente').focus();
      return false;
    }

    if($('#antcuenta').val() == "" || $('#antcuenta').val() == 0){
      alertify.error("Seleccione una cuenta");
      $('#antcuenta').focus();
      return false;
    }

    if($('#antconcepto').val() == ""){
      alertify.error("Ingrese un concepto");
      $('#antconcepto').focus();
      return false;
    }

    fecha = $('#antfecha').val();
    aduana = $('#txt_aduana').val();
    tipoDoc = 5;
    usuario = $('#txt_usuario').val();
    permiso = "s_generar_x_fecha_anticipos";

    var continuar = validarFechaCierre(fecha,aduana,tipoDoc,usuario,permiso);
    //console.log(continuar);
    if(continuar == true) {
      genAnt();
    }else{
      //swal("Oops!", "Solicite cambio de fechas a Contabilidad", 'error');
      return false;
    }
  });

  function Actualiza_Expedido_Cliente(){
    id_cliente = $('#antcliente').attr('db-id');
    lstCuentas('antGenClt',id_cliente);
    bcosClientes(id_cliente);
  }

  function lstCuentas(modulo,id_cliente){
    var data = {
      id_cliente: id_cliente,
      modulo: modulo
    }

    $.ajax({
      type: "POST",
      url: "/Ubicaciones/Contabilidad/anticipos/actions/lst_cuentas.php",
      data: data,
      success: 	function(r){

        r = JSON.parse(r);
        if (r.code == 1) {
          //console.log(r.data);
          $('#antcuenta').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }

  function bcosClientes(id_cliente){
    var data = {
      id_cliente: id_cliente
    }

    $.ajax({
      type: "POST",
      url: "/Resources/PHP/actions/lst_bancos_clientes.php",
      data: data,
      success: 	function(r){
        r = JSON.parse(r);
        if (r.code == 1) {
          $('#antbcocliente').html(r.data);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
    });
  }



});
</script>
