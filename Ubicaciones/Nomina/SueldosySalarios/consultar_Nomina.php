<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="row submenuMed m-0 font16">
    <div class="col-md-6">
      <a  href="/conta6/ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php">GENERAR NOMINA</a>
    </div>
    <div class="col-md-6">
      <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/Parametros.php" >PARAMETROS</a>
    </div>
  </div>


  <div class="">
    <form class="form1">
      <table class="table">
        <tr class="row mt-5">
          <td class="col-md-2 offset-md-5 input-effect">
            <input  list="listanios" class="font14 efecto" id="anios">
            <datalist id="listanios">
              <option value="1"></option>
              <option value="2"></option>
              <option value="3"></option>
              <option value="3"></option>
              <option value="3"></option>
            </datalist>
            <label for="anios">Buscar</label>
          </td>
        </tr>
      </table>
    </form>

    <div  class="contorno mt-5">
      <table class="table table-hover mb-0">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">NOMINA</td>
            <td class="col-md-1">EMPLEADOS</td>
            <td class="col-md-1">CFDI</td>
            <td class="col-md-1">CANCELADOS</td>
            <td class="col-md-2">PERCEPCIONES</td>
            <td class="col-md-2">DEDUCCIONES</td>
            <td class="col-md-2">TOTAL</td>
            <td class="col-md-2">TOTAL NETO</td>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row">
            <td class="col-md-1"><a href="#">1</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
          <tr class="row">
            <td class="col-md-1"><a href="">2</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="row">
            <td class="col-md-2 offset-md-5 mt-5">
              <nav>
                <ul class="pagination">
                  <li class="page-item"><as class="page-link" href="#">Atras</a></li>
                  <li class="page-item"><as class="page-link" href="#">1</a></li>
                  <li class="page-item active">
                    <a href="#" class="page-link" href="#">2<span class="sr-only"></span></a>
                  </li>
                  <li class="page-item"><as class="page-link" href="#">3</a></li>
                  <li class="page-item"><as class="page-link" href="#">4</a></li>
                  <li class="page-item"><as class="page-link" href="#">5</a></li>
                  <li class="page-item"><as class="page-link" href="#">Sig.</a></li>
                </ul>
              </nav>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script src="js/SueldosySalarios.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
