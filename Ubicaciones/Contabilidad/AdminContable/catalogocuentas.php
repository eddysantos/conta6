<?php
#http://localhost:88/conta6/Ubicaciones/Contabilidad/AdminContable/catalogocuentas.php?usuario=admado
#  $usuario = trim($_GET['usuario']);
//session_start();
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Databases/conexion.php';
  require $root . '/conta6/Resources/PHP/actions/consultaPermisos.php';
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>
<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-12 text-center" role="button">
      <a  id="submenuMed" class="consultar" accion="eCap" status="cerrado">CATÁLOGO DE CUENTAS</a>
    </div>
  </div>

  <div id="contorno" class="contorno">
    <div class="acordeon2">
      <div class="encabezado font16" data-toggle="collapse" href="#CuentasMaestras">
        <a  id="bread">GENERAR CUENTAS MAESTRAS (Primer Nivel)</a>
      </div>
      <div id="CuentasMaestras" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table text-center mb-0">
            <tbody class="font14">
              <tr class="row m-0 mt-5">
                <td class="col-md-12 input-effect">
                  <input  list="cuentasSAT" class="efecto" id="ctaSAT">
                  <datalist id="cuentasSAT" href="#lst_conta_cs_cuentas_mst"></datalist>
                  <label for="ctaSAT" style="padding-top:.10rem">CUENTAS SAT
                    <a href="#"><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-4">
                <td class="col-md-4 input-effect">
                  <input  list="NSAT" class="efecto" id="naturSAT">
                  <datalist id="NSAT" href="#lst_conta_cs_sat_natur_cuentas"></datalist>
                  <label for="naturSAT">NATURALEZA SAT</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input list="cta-mtraTipo" class="efecto" id="tipo">
                  <datalist id="cta-mtraTipo">
                    <option value="Activo -- A"></option>
          					<option value="Pasivo -- P"></option>
          					<option value="Capital -- C"></option>
          					<option value="Gastos -- G"></option>
          					<option value="Ingresos -- I"></option>
          					<option value="Cuentas de Orden -- O"></option>
                  </datalist>
                  <label for="tipo">TIPO</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctamaestra" class="efecto" type="text" maxlength="10">
                  <label for="ctamaestra">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="concepto" class="efecto" type="text" maxlength="100">
                  <label for="concepto">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-5">
                <td class="col-md-2">
                  <a href="#" id="generarCtaMst" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                  <div id="respuestaCtasMST"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetwo">
        <a  id="bread">GENERAR CUENTAS DE DETALLE (Segundo Nivel)</a>
      </div>
      <div id="collapsetwo" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table m-0 mt-4 text-center">
            <tbody class="font14">
              <tr class="row m-0 mt-4">
                <td class="col-md-12 input-effect">
				          <input name="Input" class="efecto"  id="ctaSAT1"  list="cuentasSAT" >
                  <datalist id="cuentasSAT"></datalist>
                  <label for="ctaSAT1" style="padding-top:.10rem">CUENTAS SAT
                    <a href="#"><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-4">
                <td class="col-md-3 input-effect">
                  <input  list="NSAT" class="efecto" id="naturSAT1">
                  <datalist id="NSAT"></datalist>
                  <label for="naturSAT1">NATURALEZA SAT</label>
                </td>
                <td class="col-md-9 input-effect">
                  <input  list="CuentaMaestra" class="efecto"  id="tipo1">
                  <datalist id="CuentaMaestra" href="#lst_conta_cs_cuentas_mst_1niv"></datalist>
                  <label for="tipo1">CUENTA MAESTRA</label>
                </td>
              </tr>

    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0100-0   -->

              <tr class="row m-0 mt-4" style="display:none">
                <td class="col-md-3 input-effect">
                  <input  list="bcoSAT" class="efecto" id="banSAT">
                  <datalist id="bcoSAT">
                    <option value="EJEMPLO DE BANCOS SAT"></option>
                  </datalist>
                  <label for="banSAT" style="padding-top:.10rem">BANCOS SAT
                    <a href="#"><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="noCuenta" class="efecto" type="text">
                  <label for="noCuenta">No. CUENTA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="ofi" class="efecto" id="oficina">
                  <datalist id="ofi">
                    <option value="Nuevo Laredo"></option>
                  </datalist>
                  <label for="oficina">OFICINA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="obser" class="efecto" type="text">
                  <label for="obser">OBSERVACIONES</label>
                </td>
              </tr>
    <!-- termina CUENTA 0100-0   -->


    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0115-0   -->

              <tr class="row m-0 mt-4" style="display:none">
                <td class="col-md-6 input-effect">
                  <input  list="clientes" class="efecto" id="client">
                  <datalist id="clientes"></datalist>
                  <label for="client">CLIENTES</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input  list="empleados" class="efecto" id="emp">
                  <datalist id="empleados">
                    <option value="EJEMPLO DE BANCOS SAT"></option>
                  </datalist>
                  <label for="emp">EMPLEADOS</label>
                </td>
              </tr>
    <!-- termina CUENTA 0115-0   -->

              <tr class="row justify-content-center m-0 mt-4">

    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0206-0   -->
                <td class="col-md-4 input-effect" style="display:none">
                  <input  list="prov" class="efecto" id="proveedores">
                  <datalist id="prov">
                    <option value="Proveedores sin Cuenta"></option>
                  </datalist>
                  <label for="proveedores">PROVEEDORES</label>
                </td>
      <!-- termina CUENTA 0206-0   -->

                <td class="col-md-8 input-effect">
                  <input id="concepto1" class="efecto" type="text">
                  <label for="concepto1">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-5">
                <td class="col-md-4">
                  <a href="" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR CUENTA DETALLE</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetres">
        <a  id="bread">GENERAR CUENTAS DE CLIENTES (Segundo Nivel)</a>
      </div>
      <div id="collapsetres" class="card-block collapse ml-20 mr-20">
        <form class="form1">
          <table class="table text-center ">
            <tbody class="cuerpo">
              <tr class="row m-0 mt-4">
                <td class="col-md-10 input-effect mt-4">
                  <input  list="Clientes" class="efecto"  id="clt">
                  <datalist id="Clientes">
      				  	<?php
      					  $sql_Clientes = mysqli_query($db,"SELECT * FROM conta_replica_clientes WHERE pk_id_cliente NOT IN( SELECT DISTINCT s_cta_identificador  FROM conta_cs_cuentas_mst WHERE s_cta_identificador is not null) ORDER BY s_nombre");
        					while($oRst_Clientes = $sql_Clientes->fetch_assoc()) {
        						echo '<option value='.trim($oRst_Clientes['pk_id_cliente']).'>'.htmlentities(trim($oRst_Clientes['s_nombre'])).' ----- '.trim($oRst_Clientes['pk_id_cliente']).'</option>';
        				  }
                  ?>
                  </datalist>
                  <label for="clt">CLIENTES</label>
                </td>
                <td class="col-md-2 mt-4">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <div id="contornoEmp" class="contorno" style="display:none;">
    <h5 class="titulo font16">CATALOGO</h5>
    <table class="table mt-4">
      <tr class="row m-0">
        <td class="col-md-6">
          <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/005-excel.svg"></a>
          <a href="#"><img class="icomediano ml-4" src="/conta6/Resources/iconos/printer.svg"></a>
          <a href="#"><img class="icomediano ml-4" src="/conta6/Resources/iconos/xml.svg"></a>
        </td>
        <td class="col-md-3 offset-md-3">
          <input class="efecto" type="text" name="search" placeholder="Buscar...">
       </td>
      </tr>
    </table>
    <table class="table table-hover" id="empleadosCap" style="display:none;">
      <thead>
        <tr class="row m-0 encabezado font14">
          <td class="col-md-1"></td>
          <td class="col-md-1">CUENTA</td>
          <td class="col-md-4">DESCRIPCION</td>
          <td class="col-md-1">TIPO</td>
          <td class="col-md-1">NIVEL</td>
          <td class="col-md-1">CAPTURA</td>
          <td class="col-md-1">CodAgrup SAT</td>
          <td class="col-md-1">NATUR SAT</td>
          <td class="col-md-1">ACTIVIDAD</td>
        </tr>
      </thead>
      <tbody>
      <?php
      	$sql_consultaCuentas = mysqli_query($db,"SELECT * FROM conta_cs_cuentas_mst limit 5");
    		while($oRst_consultaCuentas = $sql_consultaCuentas->fetch_assoc()) {
    			$id_cuenta = trim($oRst_consultaCuentas['pk_id_cuenta']);
    			$actividad = trim($oRst_consultaCuentas['s_cta_actividad']);
  		?>
  	  	<tr class="row text-center m-0 borderojo">
  			 <td class="col-md-1 text-center">
    				<a href="#EditarCatalogo" data-toggle="modal">
    				  <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
    				</a>
  			  </td>
  			  <td class="col-md-1"><?php echo $id_cuenta; ?></td>
  			  <td class="col-md-4 text-left"><?php echo trim($oRst_consultaCuentas['s_cta_desc']); ?></td>
  			  <td class="col-md-1"><?php echo trim($oRst_consultaCuentas['s_cta_tipo']); ?></td>
  			  <td class="col-md-1"><?php echo trim($oRst_consultaCuentas['s_cta_nivel']); ?></td>
  			  <td class="col-md-1"><?php if( $oRst_consultaCuentas['s_cta_status'] == 0 ){
                  											echo "Inactivo";
                  										}else{
                  											echo "Activo";
                  										}
                  									?>
  			  </td>
  			  <td class="col-md-1"><?php echo trim($oRst_consultaCuentas['fk_codAgrup']); ?></td>
  			  <td class="col-md-1"><?php echo trim($oRst_consultaCuentas['fk_id_naturaleza']); ?></td>
  			  <td class="col-md-1"><?php if($actividad == 1){
                            					echo 'Con registros';
                            				}else{
                            					if( $oRst_permisos['s_modificar_ctas'] == 1){ ?>
                            						<a style="text-decoration:none;" onClick="borrar('<?php echo $id_cuenta; ?>')">
                            							<img border="0" src="/conta6/Resources/iconos/delete.svg" alt="Borrar">
                            						</a><div id="borrar_<?php echo $id_cuenta; ?>"></div>
                            				<?php }}?>
  			  </td>
  		  </tr>
    <?php } #while($oRst_consultaCuentas ?>
      </tbody>
    </table>
    <ul class="pagination justify-content-center font16 mt-5">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </div>
</div>



<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/AdministracionContable.js"></script>
<?php
require_once('modales/EditarCatalogo.php');
 ?>
<?php
	$db->close();
?>
