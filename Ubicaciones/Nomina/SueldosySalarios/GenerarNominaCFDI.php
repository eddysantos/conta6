<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="row font16 m-0 pt-4 submenuMed">
    <div class="col-md-6">
      <a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php" >CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6">
      <a  href="/conta6/Ubicaciones/Nomina/SueldosySalarios/Parametros.php">PARAMETROS</a>
    </div>
  </div>


  <div class="contorno">
    <div class="row font16 mb-3 justify-content-center"><!--RUTAS PREVISUALIZAR Y TIMBRAR CFDIS-->
      <div class="col-md-4">
        <a href="#" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> PREVISUALIZAR CFDI'S</a>
      </div>
      <div class="col-md-4">
        <a href="#" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/timbrar.svg"> TIMBRAR TODOS LOS CFDI'S</a>
      </div>
    </div>


    <table class="table table-hover"><!--tabla (ya generada la nomina)-->
      <thead>
        <tr class="row encabezado">
          <td class="col-md-1 text-left">
            <a href="">
              <img class="icomediano ml-3" src="/conta6/Resources/iconos/001-delete.svg">
            </a>
          </td>
          <td class="col-md-1">DOCUMENTO</td>
          <td class="col-md-1">NO.</td>
          <td class="col-md-3">EMPLEADO</td>
          <td class="col-md-1">POL.PAGO</td>
          <td class="col-md-1">CANCELAR</td>
          <td class="col-md-1">POL.CANCEL</td>
          <td class="col-md-1">FACTURA</td>
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-1">CFDI</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1">38089</td>
          <td class="col-md-1">426</td>
          <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1"><a href="">248040</a></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"><a href="">234567</a></td>
          <td class="col-md-1">15804</td>
          <td class="col-md-1"><a href="">248092</a></td>
          <td class="col-md-1">
            <a href="#" class="boton font12">GENERAR</a>
          </td>
        </tr>
        <tr class="row"><!--Esta fila es como se vera al Timbrar CFDI-->
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/conta6/Resources/iconos/copy.svg">
            </a>
          </td>
          <td class="col-md-1">38089</td>
          <td class="col-md-1">426</td>
          <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1"><a href="">248040</a></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"><a href="">234567</a></td>
          <td class="col-md-1">15804</td>
          <td class="col-md-1"><a href="">248092</a></td>
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/pdf.svg"></a>
            <a href="" class="ml-5"><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a><!--Estos iconos aparecen al momento de timbrar CFDI-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->
</div>




<script src="js/SueldosySalarios.js"></script>
<script src="/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/js/parametros.js"></script>
<!-- <script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script> -->
<script src="/Conta6/Ubicaciones/Nomina/Empleados/js/empleados.js"></script>

<?php
require $root .'/conta6/Ubicaciones/Nomina/empleados/modales/Empleados.php';
require $root .'/conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/modales/Parametros.php';
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
