function validaIntDec(frmObj){
	importe = $(frmObj).val();

	if( String(importe).search(/^\d+$/) != -1 || String(importe).search(/^\d+(\.\d+)?$/) != -1 ){
    $(frmObj).val(importe);
	}else{
		alertify.error("Ingrese solo enteros o decimales");
		$(frmObj).focus();
	}
}
