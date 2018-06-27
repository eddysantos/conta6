function validaSoloNumeros(frmObj){
  campo = $(frmObj).val();
  if( (!/^([0-9])*$/.test(campo)) || campo == "" ){
    alertify.error("Ingrese solo numeros")
		$(frmObj).focus();

  }else{
		$(frmObj).val(campo);
  }
}
