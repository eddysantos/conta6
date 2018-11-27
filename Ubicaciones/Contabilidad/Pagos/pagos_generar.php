<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class='row m-0 submenuMed text-center' style="font-size:13px">
    <div class='col-md-3 mt-2' role='button'>
      <a href="#" class='pgos' accion='Ver-cliente' status='cerrado'>DATOS CLIENTE</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class='pgos' accion='datinfo' status='cerrado'>INFO. GENERAL</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class="pgos" accion="pgos-factura" status="cerrado">PAGOS DE LA MISMA FACTURA</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class="pgos" accion="folio" status="cerrado">FOLIO A SUSTITUIR</a>
    </div>
  </div>

  <div id='detalleCliente' class='contorno' style='display:none'>
    <h5 class='titulo font14'>DATOS CLIENTES</h5>
    <table class='table' id='eCliente'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12 p-0'>
            <input class="eff h22 text-right border-0 bt p-0" type="text" id="T_ID_Cliente_Oculto" value="<?php echo $id_cliente; ?>">
            <input class="eff w-50 h22 text-left border-0 bt" type="text" id="T_Nombre_Cliente" readonly value="<?php echo $CLT_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
          </td>
        </tr>
        <tr class="row sub3 font12 b" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class='col-md-6 p-1'>Direccion</td>
          <td class='col-md-6 p-1'>Proveedor</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row'>
          <td class="col-md-2 text-right b p-0"><b>Calle y No :</b></td>
          <td class="col-md-4 p-0">
            <input class="w-100 border-0 bt text-left" id="T_Cliente_Calle" type="text" readonly value="<?php echo $CLT_calle;?>">
          </td>
          <td class='col-md-6 p-0'>
            <input class="border-0 bt text-center w-100" type="text" id="T_Proveedor_Destinatario" value="<?php echo $nomProv;?>" readonly>
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 text-right b"> <b># Ext :</b></td>
          <td class="text-left p-0">
            <input class="h22 border-0 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $CLT_no_ext;?>" size="5">
          </td>
          <td class="text-right p-0 b"><b># Int :</b></td>
          <td class="col-md-2 text-left p-0">
            <input class="h22 border-0 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $CLT_no_int;?>" size="25">
          </td>
        </tr>
        <tr class='row'>
          <td class="col-md-2 text-right b p-0"><b>Colonia :</b></td>
          <td class='col-md-4 p-0 text-left'>
            <input class="h22 border-0 bt" id="T_Cliente_Colonia" type="text" readonly value="<?php echo $CLT_colonia;?>">
          </td>
        </tr>
        <tr class='row'>
          <td class="col-md-2 p-0 b text-right"><b>Ciudad/Estado :</b> </td>
          <td class='col-md-3 p-0 text-left'>
            <input class="h22 border-0 bt" id="T_Cliente_Estado" type="text" readonly value="<?php echo $CLT_estado;?>">,
            <input class="h22 border-0 bt text-left p-0" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $CLT_ciudad;?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>País :</b></td>
          <td class="col-md-4 p-0 text-left">
            <input  type="text" class="h22 border-0 bt" id="T_Cliente_Pais" value="<?php echo $CLT_pais; ?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>CP :</b></td>
          <td class="p-0 text-left">
            <input class="h22 border-0 bt" id="T_Cliente_CP" type="text" readonly value="<?php echo $CLT_codigo;?>" size="6"></td>
          </td>
          <td class="p-0 b text-right"><b>Tax ID :</b></td>
          <td class="col-md-1 p-0 text-left">
            <input type="text" class="h22 border-0 bt" id="T_Cliente_taxid" value="<?php echo $CLT_taxid; ?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>RFC :</b></td>
          <td class="col-md-4 p-0 text-left">
            <input class="h22 border-0 bt" id="T_Cliente_RFC" type="text" readonly onchange="validarRFCfac(this);" value="<?php echo $CLT_rfc;?>">
          </td>
        </tr>
      </tbody>
    </table>
  </div>



  <div id='InfoPagos' class='contorno' style='display:none'>
    <h5 class='titulo font16'>INFO GENERAL</h5>
    <table class='table mt-5' id='eInfo'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12 p-0'>INFORMACION DEL USUARIO</td>
        </tr>
        <tr class="row sub3 font12 b" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-3 p-1"></td>
          <td class="col-md-3 p-1">Póliza</td>
          <td class="col-md-3 p-1">Usuario</td>
          <td class="col-md-3 p-1">Fecha</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row">
          <td class="p-1 col-md-3 text-left b"><b>Cta. generada <?php echo $pk_id_cuenta_captura; ?></b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Usuario" size="20"value="<?php echo $fk_usuario; ?>" readonly>
          </td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Fecha_Cta" size="20" value="<?php echo date_format(date_create($d_fecha_cta),"d-m-Y h:i:s");?>" readonly>
          </td>
        </tr>

        <tr class="row b">
          <td class="p-1 col-md-3 text-left b"><b>Cta. modificada</b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
        </tr>
        <tr class="row b">
          <td class="p-1 col-md-3 text-left b"><b>Factura generada</b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
        </tr>
        <tr class="row b borderojo">
          <td class="p-1 col-md-3 text-left b"><b></b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id='folioSustituir' class='contorno' style='display:none'>
    <h5 class='titulo font16'>Folio a Sustituir</h5>
    <table class='table'>
      <thead>
        <tr class='row encabezado font16'>
          <td class="col-md-4 p-1">Sustituye al pago</td>
          <td class="col-md-4 p-1">UUID</td>
          <td class="col-md-4 p-1">Tipo de relación</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row">
          <td class="p-1 col-md-4"></td>
          <td class="p-1 col-md-4"></td>
          <td class="p-1 col-md-4"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="pagosMismaFact" class='contorno' style="display:none">
    <table class='table'>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">PAGOS DE LA MISMA FACTURA</td>
        </tr>
        <tr class="row font12 b sub3" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-1 p-1">fecha UUID</td>
          <td class="col-md-1 p-1">No.Pago</td>
          <td class="col-md-1 p-1">Parcialidad</td>
          <td class="col-md-1 p-1">Póliza</td>
          <td class="col-md-1 p-1">no.Doc.Pago</td>
          <td class="col-md-1 p-1">FacturaR</td>
          <td class="col-md-1 p-1">Sust.Pago</td>
          <td class="col-md-1 p-1">Fecha</td>
          <td class="col-md-1 p-1">Pol.Cancela</td>
          <td class="col-md-1 p-1">Saldo Anterior</td>
          <td class="col-md-1 p-1">Importe Pagado</td>
          <td class="col-md-1 p-1">Saldo Insoluto</td>

        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo">
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class='contorno'>
    <table class='table'>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">Datos de Factura Electronica
          <a href="#buscar_factura" data-toggle="modal"><img class='icochico' src='/conta6/Resources/iconos/magnifier.svg' /></a></td>
        </tr>
        <tr class="row sub3 b font12" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-1 p-1">Aduana</td>
          <td class="col-md-1 p-1">Referencia</td>
          <td class="col-md-2 p-1">UUID</td>
          <td class="col-md-1 p-1">Factura</td>
          <td class="col-md-1 p-1">Moneda</td>
          <td class="col-md-1 p-1">Tipo Cambio</td>
          <td class="col-md-2 p-1">Total Honorarios</td>
          <td class="col-md-1 p-1">Metodo Pago</td>
          <td class="col-md-2 p-1">Numero de Parcialidad</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo">
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="contorno mt-5">
    <h5 class='titulo font16'>Captura</h5>
    <table class='table '>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">Captura detalle de pago</td>
        </tr>
        <tr class="row backpink justify-content-center">
          <td class="col-md-2 p-1"><span>*</span> Fecha</td>
          <td class="col-md-2 p-1"><span>*</span> Forma de Pago</td>
          <td class="col-md-1 p-1">Núm.Operación</td>
          <td class="col-md-2 p-1"><span>*</span> Moneda</td>
          <td class="col-md-2 p-1"><span>*</span> Tipo de Cambio</td>
          <td class="col-md-1 p-1"><span>*</span> Importe</td>
          <td class="col-md-1 p-1">IVA</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo pb-3 mt-3 justify-content-center">
          <td class="col-md-2 p-1">
            <input type="date" class="efecto h22">
          </td>
          <td class="col-md-2 p-1">
            <select class="custom-select-s">
              <option value=""></option>
              <option value=""></option>
            </select>
          </td>
          <td class="col-md-1 p-1">
            <input type="text" class="efecto h22">
          </td>
          <td class="col-md-2 p-1">
            <select class="custom-select-s">
              <option value=""></option>
              <option value=""></option>
            </select>
          </td>
          <td class="col-md-2 p-1"><input class="efecto h22" type="text"></td>
          <td class="col-md-1 p-1"><input class="efecto h22" type="text"></td>
          <td class="col-md-1 p-1"><input class="efecto h22" type="text"></td>
          <td class="p-1 pl-3">
            <a href=""><img class="icochico" src="/conta6/Resources/iconos/001-add.svg"></a>
          </td>
        </tr>

        <tr class="row sub2 mt-3">
          <td class="p-1 col-md-1 ls1">RFC Emisor</td>
          <td class="p-1 col-md-3">Cuenta Emisor (min 10 dig.)</td>
          <td class="p-1 col-md-3">Banco Emisor Extranjero</td>
          <td class="p-1 col-md-1 ls1">RFC Receptor</td>
          <td class="p-1 col-md-4">Cuenta (min 10 dig)</td>
        </tr>
        <tr class="row font12">
          <td class="col-md-1"><input class="efecto h22" type="text"></td>
          <td class="col-md-3"><input class="efecto h22" type="text"></td>
          <td class="col-md-3"><input class="efecto h22" type="text"></td>
          <td class="col-md-1"><input class="efecto h22" type="text" value="PLA0906N21" readonly></td>
          <td class="col-md-2">
            <select class="custom-select-s">
              <option value="">Bancos PLAA</option>
            </select>
          </td>
          <td class="col-md-2"><input class="efecto h22" type="text"></td>
        </tr>


        <tr class="row sub2 mt-3">
          <td class="col-md-3 p-1">Tipo Cadena</td>
          <td class="col-md-3 p-1">Certificado</td>
          <td class="col-md-3 p-1">Cadena Original</td>
          <td class="col-md-3 p-1">Sello</td>
        </tr>
        <tr class="row font12">
          <td class="col-md-3">
            <select class="custom-select-s">
              <option value="">Bancos PLAA</option>
            </select>
          </td>
          <td class="col-md-3"><input class="efecto h22" type="text"></td>
          <td class="col-md-3"><input class="efecto h22" type="text"></td>
          <td class="col-md-3"><input class="efecto h22" type="text"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class='row mt-4 sub2'>
          <th class='col-md-2 pt-3'>Saldo Anterior</th>
          <td class='col-md-2'>
            <input class="efecto h22" type="text" id="" size="17" onBlur="validaIntDec(this);" value="0" readonly>
          </td>
          <th class='col-md-2 pt-3'>Importe Pagado</th>
          <td class='col-md-2'>
            <input class="efecto h22" id=""  onBlur="validaIntDec(this);" type="text" size="17" value="0" readonly>
          </td>
          <th class='col-md-2 pt-3'>Saldo Insoluto</th>
          <td class='col-md-2'>
            <input class="efecto h22" type="text" id="" size="17" onBlur="validaIntDec(this);" value="0" readonly>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="contorno mt-5" style="margin-bottom: 100px!important;">
    <div class="row encabezado font16">
      <div class="col-md-12">Detalle de Pagos</div>
    </div>
    <div class="row sub2" style="font-size:12px!important">
      <div class="col-md-2">Fecha :</div>
      <div class="col-md-2"></div>
      <div class="col-md-2">Forma :</div>
      <div class="col-md-2"></div>
      <div class="col-md-2">#Operación :</div>
      <div class="col-md-2"></div>

    </div>
    <div class="row font12 borderojo">
      <div class='col-md-1'></div>
      <div class='col-md-1 text-right b'>T.Cadena :</div>
      <div class='col-md-4 text-left'></div>
      <div class='col-md-1 text-right b p-0'>T.Cambio :</div>
      <div class='col-md-2 text-left'></div>
      <div class='col-md-1 text-right b'>Emisor :</div>
      <div class='col-md-2 text-left'></div>


      <div class='col-md-1'></div>
      <div class='col-md-1 text-right b'>Certificado :</div>
      <div class='col-md-4 text-left'></div>
      <div class='col-md-1 text-right b p-0'>Importe :</div>
      <div class='col-md-2 text-left'></div>
      <div class='col-md-1 text-right b'>Cuenta :</div>
      <div class='col-md-2 text-left'></div>


      <div class='col-md-1'><a href=''>
        <img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'>
      </a></div>
      <div class='col-md-1 text-right b'>Cadena O. :</div>
      <div class='col-md-4 text-left'></div>
      <div class='col-md-1 text-right b p-0'>IVA :</div>
      <div class='col-md-2 text-left'></div>
      <div class='col-md-1 text-right b'>Banco Ext :</div>
      <div class='col-md-2 text-left'></div>

      <div class='col-md-1'></div>
      <div class='col-md-1 text-right b'>Sello :</div>
      <div class='col-md-4 text-left'></div>
      <div class='col-md-1 text-right b p-0'>No.Parcialidad :</div>
      <div class='col-md-2 text-left'></div>
      <div class='col-md-1 text-right b'>Cta.Receptor :</div>
      <div class='col-md-2 text-left'></div>

      <div class='col-md-1'></div>
      <div class='col-md-1 text-right b'>UUID :</div>
      <div class='col-md-4 text-left'></div>
      <div class='col-md-1 text-right b p-0'>Factura :</div>
      <div class='col-md-2 text-left'></div>




    </div>
  </div>
</div>












<script src="/Conta6/Ubicaciones/Contabilidad/Pagos/js/pagos.js" charset="utf-8"></script>

<?php
require_once('modales/buscar_factura.php');
require $root . '/conta6/Ubicaciones/footer.php';?>
