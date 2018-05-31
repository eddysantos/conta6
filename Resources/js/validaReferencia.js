function validaReferencia(frmObj){
  Referencia = $(frmObj).val();

	if( (!/^([A-Za-z]\d[0-9]{6,8}|0)$/.test(Referencia)) ){
		if (Referencia == "SN" || Referencia == "sn"){
		    $(frmObj).val(Referencia);
        $(frmObj).attr('db-id',Referencia)
		}else{
			alertify.error("Referencia: Z12345678\nReferencia: 0\nReferencia: SN");
			$(frmObj).focus();
		}
    $(frmObj).val(Referencia);
  }
}
