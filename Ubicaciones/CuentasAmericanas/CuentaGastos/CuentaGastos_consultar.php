<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $cuenta = trim($_GET['cuenta']);
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosGenerales.php';
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosPOCME.php'; # $datosPOCMEconsultar
  require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosAnticipos.php'; # $datosANTICIPOconsultar


  #************ historial ************
  $descripcion = "Se consulto cuenta: $cuenta ";

  $clave = 'ctaAme_fac';
  $folio = $cuenta;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

?>

<div class="container-fluid">
  <div class="row m-0 submenuMed text-center">
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datcliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="ctagastos" accion="datinfo" status="cerrado">INFORMACIÓN GENERAL</a>
    </div>
  </div>
  <div class="col-md-1 text-center p-5">
    <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
    <a href="#" id="Btn_print_Ame" onclick="ctaGastosAmeImprimir(<?php echo $pk_id_ctaAme; ?>)"><img src='/conta6/Resources/iconos/printer.svg' class='icomediano'></a>
  </div>
  <div id="contornoCliente" class="contorno mt-4" style="display:none">
    <h5 class="titulo font16">DATOS CLIENTES</h5>
    <table class="table text-center" id="eCliente">
      <thead class="font14">
        <tr class="row encabezado">
          <td class="col-md-5"><?php echo $fk_id_cliente.' '.trim($s_nombre);?></td>
          <td class="col-md-5"><?php echo $fk_id_proveedor.' '.trim($s_prov_nombre);?></td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-6">DIRECCION</td>
          <td class="col-md-6">PROVEEDOR</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-6"><?php echo trim($s_calle);?> <?php echo trim($s_no_ext);?> <?php echo trim($s_no_int);?></td>
          <td class="col-md-6"><?php echo trim($s_prov_calle);?> <?php echo trim($s_prov_no_ext);?> <?php echo trim($s_prov_no_int);?></td>
        </tr>
        <tr class="row">
          <td class="col-md-6"><?php echo trim($s_colonia);?></td>
          <td class="col-md-6"><?php echo trim($s_prov_colonia);?></td>
        </tr>
        <tr class="row">
          <td class="col-md-6"><?php echo trim($s_codigo);?> <?php echo trim($s_ciudad);?> <?php echo trim($s_estado);?></td>
          <td class="col-md-6"><?php echo trim($s_prov_codigo);?> <?php echo trim($s_prov_ciudad);?> <?php echo trim($s_prov_estado);?></td>
        </tr>
        <tr class="row">
          <td class="col-md-6"><?php echo trim($s_rfc);?></td>
          <td class="col-md-6">Tel: <?php echo trim($s_prov_telefono);?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="contornoInfo" class="contorno mt-4" style="display:none">
    <h5 class="titulo font16">INFO GENERAL</h5>
    <table class="table text-center font14" id="eInfo">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">INFORMACION GENERAL NO EDITABLE</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="p-1 col-md-3 text-left b"><b>Cta. generada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_alta; ?></td>
        </tr>

        <tr class="row">
          <td class="p-1 col-md-3 text-left b"><b>Cta. modificada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
        </tr>
        <tr class="row borderojo">
          <td class="p-1 col-md-3 text-left b"><b>cta. cancelada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_cancela_usuario; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_cancela_fecha; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="contorno">
    <div class="container-fluid">
      <table class="table text-center w-50" style="float:left">
        <thead>
          <tr class="row m-0 ">
            <td class="col-md-11 backpink font14">REFERENCE</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Reference : </td>
            <td class="col-md-5 pt-1 p-0 text-left"><?php echo $fk_referencia; ?></td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Freight Bill :</td>
            <td class="col-md-5 pt-1 p-0 text-left"><?php echo $s_guia_master; ?></td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Quantity :</td>
            <td class="col-md-5 pt-1 p-0 text-left"><?php echo $n_bodegaIn; ?></td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Type :</td>
            <td class="col-md-5 pt-1 p-0 text-left"><?php echo $s_tipoRegimen;?></td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6 pt-1 p-0 text-right">Description :</td>
            <td class="col-md-5 pt-1 p-0 text-left"><?php echo $s_descripcion;?></td>
            <td class="col-md-1 pt-1 p-0"></td>
          </tr>
        </tbody>
      </table>

      <table class="table text-center w-50" style="float:right">
        <thead>
          <tr class="row m-0">
            <td class="col-md-12 backpink font14">GENERAL</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-3 text-right">Invoince No :</td>
            <td class="col-md-3"><?php echo $pk_id_ctaAme; ?></td>

            <td class="col-md-3 text-right">Invoince Value :</td>
            <td class="col-md-3"><?php echo number_format($n_valor_usd,2,'.',',');?></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-3 text-right">Vencimiento :</td>
            <td class="col-md-3"><?php echo $d_fechaVencimiento; ?></td>

            <td class="col-md-3 text-right">Date :</td>
            <td class="col-md-3"><?php echo $d_fecha; ?></td>
          </tr>

          <tr class="row m-0">
            <td class="col-md-3 text-right">Weight :</td>
            <td class="col-md-3"><?php echo $n_peso; ?></td>

            <td class="col-md-3 text-right">Customer Invoice :</td>
            <td class="col-md-3"><?php echo $s_customerOrder; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="contorno mt-5">
    <h5 class="titulo font16">EDITAR CTA GASTOS</h5>
    <div class="encabezado font18">ACCOUNT CHARGES</div>
      <form class="form1">
        <table class="table text-center font14">
          <tbody>
            <tr class="row m-0 backpink">
              <td class="col-md-1">SERV.</td>
              <td class="col-md-3">CONCEPTO</td>
              <td class="col-md-3">DESCRIPTION</td>
              <td class="col-md-3"></td>
              <td class="col-md-1">AMOUNT</td>
              <td class="col-md-1">SUBTOTAL</td>
            </tr>

            <?php echo $datosPOCMEconsultar; ?>

            <tr class="row m-0">
              <td class="col-md-1 offset-md-9"></td>
              <td class="col-md-1"></td>
              <td class="col-md-1">
                <input class="efecto border-0" type="text" value="<?php echo number_format($n_subtotal,2,'.',',');?>" disabled>
              </td>
            </tr>

            <?php echo $datosANTICIPOconsultar; ?>

            <tr class="row m-0">
              <td class="col-md-2 offset-md-8 text-right">Total :</td>
              <td class="col-md-1 offset-md-1"><?php echo number_format($n_total,2,'.',',');?></td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
</div>


<script src="js/CuentaGastos.js"></script>
