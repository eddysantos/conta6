<!--EDITAR DATOS DEL CORRESPONSAL-->
<!-- Se comento js. porque causa conflicto -->
<div class="modal fade text-center" id="MonitordeOficinas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Monitor de Oficinas  -- Datos falsos pendiente modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="contorno">
          <form id="BuscarMonOfi" class="form1">
            <table class="table mt-3">
              <tbody class="font14">
                <tr class="row">
                  <td class="col-md-4 offset-md-2 input-effect mt-3">
                    <input class="efecto tiene-contenido" type="date" id="imp-fechaIn1">
                    <label for="imp-fechaIn1">Fecha Inicial</label>
                  </td>
                  <td class="col-md-4 input-effect mt-3">
                    <input class="efecto tiene-contenido" type="date" id="imp-fechaFin1">
                    <label for="imp-fechaFin1">Fecha Final</label>
                  </td>
                  <td class="col-md-1 text-left mt-3">
                    <a class="btn-block trafico" accion="botonverDetalle" role="button"><img src= "/Resources/iconos/magnifier.svg" class="icomediano"></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>

          <table id="VerMonitorOficinas" class="table mt-3" style="display:none">
            <tr class="row encabezado">
              <td class="col-md-1">
                <a class="trafico" accion="cerrarMonitorOficinas" role="button"><img src= "/Resources/iconos/cross.svg" class="icochico"></a>
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
      </div>
    </div>
  </div>
</div>

<!-- <script src="/Ubicaciones/Trafico/js/Trafico.js"></script> -->
