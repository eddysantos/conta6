<!--EDITAR DATOS DEL CORRESPONSAL-->
<div class="modal fade" id="MonitordeOficinas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Monitor de Oficinas</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div class="contorno">
            <form id="BuscarMonOfi">
              <table class="table text-center brx1">
                <tbody class="cuerpo">
                  <tr class="row">
                    <td class="col-md-4 offset-md-2 input-effect brx2">
                      <input class="efecto data-date" type="text" onfocus="(this.type='date')" id="imp-fechaIn1">
                      <label for="imp-fechaIn1">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect brx2">
                      <input class="efecto data-date" type="text" onfocus="(this.type='date')" id="imp-fechaFin1">
                      <label for="imp-fechaFin1">Fecha Final</label>
                    </td>
                    <td class="col-md-1 text-left brx2">
                      <a class="btn-block trafico" accion="botonverDetalle" role="button"><img src= "/conta6/Resources/iconos/magnifier.svg" class="icomediano"></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>

            <table id="VerMonitorOficinas" class="table text-center brx3" style="display:none">
              <tr class="row tRepoNom">
                <td class="col-md-1">
                  <a class="trafico" accion="cerrarMonitorOficinas" role="button"><img src= "/conta6/Resources/iconos/cross.svg" class="icochico"></a>
                </td>
                <td class="col-md-2">ADUANA</td>
                <td class="col-md-3">TOTAL DE TRÁFICOS</td>
                <td class="col-md-3">TOTAL DE FACTURAS</td>
                <td class="col-md-3">IMPORTE DE FACTURAS (MN)</td>
              </tr>
              <tr class="row borderojo">
                <td class="col-md-2 offset-md-1">160</td>
                <td class="col-md-3">45</td>
                <td class="col-md-3">45</td>
                <td class="col-md-3">30967822.49</td>
              </tr>
              <tr class="row borderojo">
                <td class="col-md-2 offset-md-1">240</td>
                <td class="col-md-3">895</td>
                <td class="col-md-3">2704</td>
                <td class="col-md-3">40130549.88</td>
              </tr>
              <tr class="row borderojo">
                <td class="col-md-2 offset-md-1">430</td>
                <td class="col-md-3">33</td>
                <td class="col-md-3">38</td>
                <td class="col-md-3">3555015.48</td>
              </tr>
              <tr class="row borderojo">
                <td class="col-md-2 offset-md-1">470</td>
                <td class="col-md-3">62</td>
                <td class="col-md-3">83</td>
                <td class="col-md-3">1844315.78</td>
              </tr>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>

<script src="../js/Trafico.js"></script>
