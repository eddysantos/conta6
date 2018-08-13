// MOSTRAR DETALLE DE ANTICIPO
function infAdd_detallePoliza(id_poliza){
      var data = {
        id_poliza: id_poliza
      }
      $.ajax({
        type: "POST",
        url: "/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/tabla_detallepoliza_infAdd.php",
        data: data,
        success: 	function(request){
					r = JSON.parse(request);
          console.log(r);
					if (r.code == 1) {
						$('#infAddtabla_detallePoliza').html(r.data);
					}
        }
      });
};
