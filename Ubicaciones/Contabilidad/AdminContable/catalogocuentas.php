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
  <div class="row submenuMed">
    <div class="col-12 text-center" role="button">
      <a  id="submenuMed" class="consultar" accion="eCap" status="cerrado">CATÁLOGO DE CUENTAS</a>
    </div>
  </div>

  <div id="contorno" class="contorno">
    <div class="acordeon2 text-center">
      <div class="encabezado h35 font16" data-toggle="collapse" href="#CuentasMaestras">
        <a  id="bread">GENERAR CUENTAS MAESTRAS (Primer Nivel)</a>
      </div>
      <div id="CuentasMaestras" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table mb-0">
            <tbody class="cuerpo">
<!-- <<<<<<< HEAD -->
              <tr class="row mt-4 m-0">
                <td class="col-md-4 input-effect">
                  <input  list="cuentasSAT" class="text-normal efecto"  id="ctaSAT">
                  <datalist id="cuentasSAT">
      				  	<?php
          					$sql_CuentasSAT = mysqli_query($conn,"SELECT * FROM conta_cs_sat_cuentas WHERE s_activo = 'S' ORDER BY s_ctaNombre");
          					while($oRst_CuentasSAT = $sql_CuentasSAT->fetch_assoc()) {
                      echo '<option value='.trim($oRst_CuentasSAT['pk_codAgrup']).'>'.htmlentities(trim($oRst_CuentasSAT['s_ctaNombre'])).' ----- '.trim($oRst_CuentasSAT['pk_codAgrup']).'</option>';
          				  }
                  ?>
                  </datalist>
<!-- ======= -->
              <tr class="row brx2">
                <td class="col-md-12 input-effect">
                  <input  list="cuentasSAT" class="text-normal efecto text-center" id="ctaSAT">
                  <datalist id="cuentasSAT" href="#lst_conta_cs_cuentas_mst"></datalist>
<!-- >>>>>>> documetacion -->
                  <label for="ctaSAT">CUENTAS SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  list="NSAT" class="text-normal efecto text-center"  id="naturSAT">
                  <datalist id="NSAT" href="#lst_conta_cs_sat_natur_cuentas"></datalist>
                  <label for="naturSAT">NATURALEZA SAT</label>
                </td>
<!-- <<<<<<< HEAD -->
                <td class="col-md-2 input-effect">
                  <input  list="cta-mtraTipo" class="text-normal efecto text-center"  id="tipo">
<!-- ======= -->
                <td class="col-md-3 input-effect">
                  <input list="cta-mtraTipo" class="text-normal efecto text-center" id="tipo">
<!-- >>>>>>> documetacion -->
                  <datalist id="cta-mtraTipo">
                    <option value="A">Activo</option>
          					<option value="P">Pasivo</option>
          					<option value="C">Capital</option>
          					<option value="G">Gastos</option>
          					<option value="I">Ingresos</option>
          					<option value="O">Cuentas de Orden</option>
                  </datalist>
                  <label for="tipo">TIPO</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctamaestra" class="efecto text-center" type="text" maxlength="10">
                  <label for="ctamaestra">CUENTA MAESTRA</label>
                </td>
<!-- <<<<<<< HEAD -->
                <td class="col-md-2 input-effect">
                  <input id="concepto" class="efecto text-center" type="text">
<!-- ======= -->
                <td class="col-md-3 input-effect">
                  <input id="concepto" class="efecto text-center" type="text" maxlength="100">
<!-- >>>>>>> documetacion -->
                  <label for="concepto">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-2 offset-md-5 brx2">
                  <a href="#" id="generarCtaMst" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                  <div id="respuestaCtasMST"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center mt-3">
      <div class="encabezado h35 font16" data-toggle="collapse" href="#collapsetwo">
        <a  id="bread">GENERAR CUENTAS DE DETALLE (Segundo Nivel)</a>
      </div>
      <div id="collapsetwo" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table mb-0">
            <tbody class="cuerpo">
              <tr class="row mt-4 m-0">
                <td class="col-md-12 input-effect">
				          <input name="Input" class="text-normal efecto"  id="ctaSAT1"  list="cuentasSAT" />
                  <datalist id="cuentasSAT"></datalist>
                  <label for="ctaSAT1">CUENTAS SAT</label>
                </td>
              </tr>
              <tr class="row mt-4 m-0">
                <td class="col-md-3 input-effect">
                  <input  list="NSAT" class="text-normal efecto text-center"  id="naturSAT1">
                  <datalist id="NSAT"></datalist>
                  <label for="naturSAT1">NATURALEZA SAT</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input  list="CuentaMaestra" class="text-normal efecto text-center"  id="tipo1">
<!-- <<<<<<< HEAD -->
                  <datalist id="CuentaMaestra">
        				  <?php
        					$sql_Cuentas = mysqli_query($conn,"SELECT * FROM conta_cs_cuentas_mst
        													WHERE pk_id_cuenta LIKE '%-00000'
        													and pk_id_cuenta not like '0108%'
        													and pk_id_cuenta not like '0208%'
        													and pk_id_cuenta not like '0106%'
        													and pk_id_cuenta not like '0203%'
        													and pk_id_cuenta not like '0206%'
        													ORDER BY pk_id_cuenta");

        					while($oRst_Cuentas = $sql_Cuentas->fetch_assoc()) {
        					       echo '<option value="'.trim($oRst_Cuentas['pk_id_cuenta']).'">'.trim($oRst_Cuentas['pk_id_cuenta']).' ----- '.htmlentities(trim($oRst_Cuentas['s_cta_desc'])).'</option>';
        				  }
                  ?>
                  </datalist>
                  <label for="tipo1">CUENTA MAESTRA</label>
                </td>
<!-- ======= -->
                  <datalist id="CuentaMaestra" href="#lst_conta_cs_cuentas_mst_1niv"></datalist>
                  <label for="tipo1">CUENTA MAESTRA</label>                </td>
<!-- >>>>>>> documetacion -->
                <td class="col-md-3 input-effect">
                  <input id="concepto1" class="efecto text-center" type="text">
                  <label for="concepto1">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-4 offset-md-4 mt-4">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR CUENTA DETALLE</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center mt-3">
      <div class="encabezado h35 font16" data-toggle="collapse" href="#collapsetres">
        <a  id="bread">GENERAR CUENTAS DE CLIENTES (Segundo Nivel)</a>
      </div>
      <div id="collapsetres" class="card-block collapse ml-20 mr-20">
        <form class="form1">
          <table class="table mb-0">
            <tbody class="cuerpo">
              <tr class="row mt-4 m-0">
                <td class="col-md-10 input-effect">
                  <input  list="Clientes" class="text-normal efecto"  id="clt">
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
                <td class="col-md-2">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <div id="contornoEmp" class="contorno" style="display:none">
    <h5 class="titulo font14">CATALOGO</h5>
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
    <table class="table table-hover text-center" id="empleadosCap">
      <thead>
        <tr class="row m-0 encabezado">
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
      <tbody class="text-normal">
<!-- <<<<<<< HEAD -->
        <?php
        	$sql_consultaCuentas = mysqli_query($conn,"SELECT * FROM conta_cs_cuentas_mst LIMIT 5");
      		while($oRst_consultaCuentas = $sql_consultaCuentas->fetch_assoc()) {
      			$id_cuenta = trim($oRst_consultaCuentas['pk_id_cuenta']);
      			$actividad = trim($oRst_consultaCuentas['s_cta_actividad']);
    		?>
	  	  <tr class="row m-0 borderojo">
    			 <td class="col-md-1">
    				<a href="#EditarCatalogo" data-toggle="modal">
    				  <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
    				</a>
    			  </td>
    			  <td class="col-md-1"><?php echo $id_cuenta; ?></td>
    			  <td class="col-md-4"><?php echo trim($oRst_consultaCuentas['s_cta_desc']); ?></td>
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
<!-- ======= -->
	  	<tr class="row text-center m-0 borderojo">
		<?php
    	$sql_consultaCuentas = mysqli_query($db,"SELECT * FROM conta_cs_cuentas_mst");
  		while($oRst_consultaCuentas = $sql_consultaCuentas->fetch_assoc()) {
  			$id_cuenta = trim($oRst_consultaCuentas['pk_id_cuenta']);
  			$actividad = trim($oRst_consultaCuentas['s_cta_actividad']);
		?>
			 <td class="col-md-1 text-center">
				<a href="#EditarCatalogo" data-toggle="modal">
				  <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
				</a>
			  </td>
			  <td class="col-md-1"><?php echo $id_cuenta; ?></td>
			  <td class="col-md-4"><?php echo trim($oRst_consultaCuentas['s_cta_desc']); ?></td>
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
		<?php } #while($oRst_consultaCuentas ?>
		</tr>
<!-- >>>>>>> documetacion -->
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
