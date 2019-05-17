// MOSTRAR DETALLE DE ANTICIPO
// function infAdd_detallePoliza(id_poliza){
//       var data = {
//         id_poliza: id_poliza
//       }
//       $.ajax({
//         type: "POST",
//         url: "/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/tabla_detallepoliza_infAdd.php",
//         data: data,
//         success: 	function(request){
// 					r = JSON.parse(request);
//           console.log(r);
// 					if (r.code == 1) {
// 						// $('#infAddtabla_detallePoliza').html(r.data);
// 					}
//         }
//       });
// };



function processFiles(files) {
			var file = files[0];
			var reader = new FileReader();

			reader.onload = function (e) {
				fileXML = $('#archivo').val();
				if( /\\/.test(fileXML) ){
					numeroLetras = fileXML.length;
					ultimaPosicionSeparador = fileXML.lastIndexOf('\\');
					ultimaPosicionSeparador = ultimaPosicionSeparador + 1;
					fileXML = fileXML.substring(ultimaPosicionSeparador,numeroLetras);
				}

				if( /.xml$/i.test(fileXML) ){
					contenido_XML = e.target.result;
          procesaXML(fileXML,contenido_XML);
				}else{
           alertify.error("No es un XML");
          return false;
				}
			};
			reader.readAsText(file);
}

function procesaXML(fileXML,contenido_XML){
  var data = {
    contenido_XML: contenido_XML,
    fileXML: fileXML,
    tipo: $('#tipoDoc').val(),
    partidaDoc: 0,
    id_poliza:$('#mst-poliza').val()
  }
  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/procesaArchivo.php",
    data: data,
    success: function(r){
      console.log(r);
      r = JSON.parse(r);
        if (r.code == 1) {
          $('#datosUUID').html(r.data);
          cadena = r.data;
          parte = cadena.split('|');
          $('#cfdi-uuid').val(parte[0]);
          $('#cfdi-rfc').val(parte[1]);
          $('#cfdi-total').val(parte[2]);
          $('#cfdi-razonsocial').val(TildesHtml_decode(parte[3]));
          $('#cfdi-subtotal').val(parte[4]);
          $('#cfdi-ivatrasladado').val(parte[5]);
          $('#cfdi-isrretenido').val(parte[6]);
          $('#cfdi-ivaretenido').val(parte[7]);
          $('#cfdi-moneda').val(parte[8]);
          $('#cfdi-tc').val(parte[9]);
        } else {
          console.error(r.message);
        }
      },
      error: function(x){
        console.error(x);
      }
  });
}

function infAddPartida(id_partida){
  seleccion = $('#opcionespolizas').val();
  //CompNal
  if( seleccion == '2' ){
    guardarCompNal(id_partida);
    console.log('CompNal'); }


    // ESTOS METODOS AUN NO FUNCIONAN
  // Cheque
	if( seleccion == '3' ){ guardarCheque(id_partida); }
  //CompExt
	if( seleccion == '4' ){ guardarCompExt(id_partida); }
  //OtrMetodoPago
	if( seleccion == '5' ){ guardarOtrMetodoPago(id_partida); }
  //Transferencia
  if( seleccion == '6' ){ guardarTransfer(id_partida); }
}

function guardarCompNal(id_partida){
  tipoInf = "CompNal";

  UUID = $('#cfdi-uuid').val();
  RFC = $('#cfdi-rfc').val();
  BeneficiarioOpc = $('#cfdi-razonsocial').val();
  aplicar = $('#cfdi-aplicar').val();
  id_poliza = $('#mst-poliza').val();

  if(aplicar == "subtotal"){ importe = $('#cfdi-subtotal').val();}
  if(aplicar == "iva"){ importe = $('#cfdi-ivatrasladado').val();}
  if(aplicar == "isr"){ importe = $('cfdi-isrretenido').val();}
	if(aplicar == "ivaRet"){ importe = $('#cfdi-ivaretenido').val();}
  if(aplicar == "total"){ importe = $('#cfdi-total').val();}

  if(UUID == ""){
    alertify.error("UUID es requerido");
    $('#cfdi-uuid').focus();
    return false;
  }

  if(RFC == ""){
    alertify.error("RFC es requerido");
     $('#cfdi-rfc').focus();
    return false;
  }

  if(importe == 0){
    alertify.error("Importe es requerido");
    return false;
  }

  var data = {
    partidaDoc: id_partida,
    UUID: UUID,
    importe: importe,
    RFC: RFC,
    tipoInf: tipoInf,
    BeneficiarioOpc: BeneficiarioOpc,
    tipo: $('#tipoDoc').val(),
    id_poliza: id_poliza,
    moneda: $('#cfdi-moneda').val(),
    tipoCamb: $('#cfdi-tc').val()
  }
  console.log(data);

  // $.ajax({
  //   type: "POST",
  //   url: "/Conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
  //   data: data,
  //   success: function(r){
  //     console.log(r);
  //     r = JSON.parse(r);
  //       if (r.code == 1) {
  //         alert("se agrego");
  //         console.log("pase por aqui");
  //         // infAdd_detalle(id_poliza);
  //         //$('#infPartida').click();
  //       } else {
  //         console.error(r.message);
  //       }
  //     },
  //     error: function(x){
  //       console.error(x);
  //     }
  // });


	$.ajax({
		type: "POST",
		url: "/Conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/accionesDetalle.php",
		data: data,
		success: 	function(r){
			r = JSON.parse(r);
			if (r.code == 1) {
				swal("Exito", "Se guardo correctamente.", "success");
				infAdd_detalle(id_poliza);

			} else {
				console.error(r.message);
			}
		}
	});
}







function eliminarPartida(partida){
	id_poliza = $('#mst-poliza').val();
	swal({
	title: "Estas Seguro?",
	text: "Ya no se podra recuperar el registro! "+ partida +" ",
	type: "warning",
	showCancelButton: true,
	confirmButtonClass: "btn-danger",
	confirmButtonText: "Si, Eliminar",
	cancelButtonText: "No, cancelar",
	closeOnConfirm: false,
	closeOnCancel: false
	},
	function(isConfirm) {
		if (isConfirm) {
			var data = {
				partida: partida,
        id_poliza: id_poliza
			}

			$.ajax({
				type: "POST",
				url: "/conta6/Resources/PHP/actions/contaElect_eliminarPartida.php",
				data: data,
				success: 	function(r){
	        r = JSON.parse(r);
					swal("Eliminado!", "Se elimino correctamente.", "success");
	        infAdd_detalle(id_poliza);
				},
				error: function(x){
					console.error(x)
				}
			});
		} else {
			swal("Cancelado", "El registro esta a salvo :)", "error");
		}
	});
}



function infAdd_detalle(id_poliza){
  var data = {
    id_poliza: id_poliza
  }
  $.ajax({
    type: "POST",
    url: "/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/tabla_infAdd.php",
    data: data,
    success: 	function(request){
			r = JSON.parse(request);
			if (r.code == 1) {
				$('#infAddtabla_detallePoliza').html(r.data);
			}
    }
  });
}

// <script>
// Add the following code if you want the name of the file appear on select

// </script>
