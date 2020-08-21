<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  require $root .'/Ubicaciones/Nomina/empleados/modales/Empleados.php';
  // require $root .'/Ubicaciones/Nomina/SueldosySalarios/Parametros/modales/Parametros.php';
?>


<div class="text-center">
  <div class="row font16 m-0 pt-4 submenuMed">
    <div class="col-md-6">
      <a href="/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php" >CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6">
      <a  href="/Ubicaciones/Nomina/SueldosySalarios/Parametros/">PARAMETROS</a>
    </div>
  </div>


  <div class="contorno">
    <div class="row font16 mb-3 justify-content-center">
      <div class="col-md-4">
        <a href="#" class="boton icochico border-0"> <img src= "/Resources/iconos/magnifier.svg"> PREVISUALIZAR CFDI'S</a>
      </div>
      <div class="col-md-4">
        <a href="#" class="boton icochico border-0"> <img src= "/Resources/iconos/timbrar.svg"> TIMBRAR TODOS LOS CFDI'S</a>
      </div>
    </div>


    <table class="table table-hover"><!--tabla (ya generada la nomina)-->
      <thead>
        <tr class="row encabezado">
          <td class="col-md-1 text-left">
            <a href="">
              <img class="icomediano ml-3" src="/Resources/iconos/001-delete.svg">
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
            <a href=""><img class="icomediano" src="/Resources/iconos/001-delete.svg"></a>
            <a href="/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/Resources/iconos/003-edit.svg">
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
            <a href=""><img class="icomediano" src="/Resources/iconos/001-delete.svg"></a>
            <a href="/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/Resources/iconos/copy.svg">
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
            <a href=""><img class="icomediano" src="/Resources/iconos/pdf.svg"></a>
            <a href="" class="ml-5"><img class="icomediano" src="/Resources/iconos/xml.svg"></a><!--Estos iconos aparecen al momento de timbrar CFDI-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->
</div>




<script src="/Ubicaciones/Nomina/SueldosySalarios/js/SueldosySalarios.js"></script>
<script src="/Ubicaciones/Nomina/Empleados/js/empleados.js"></script>

<?php
  require $root . '/Ubicaciones/footer.php';
 ?>
