
function eliminaBlancosIntermedios(frmObj){
  texto = $(frmObj).val();
  texto = $.trim(texto.replace(/\s+/g," "));
  $(frmObj).val(texto);

}
