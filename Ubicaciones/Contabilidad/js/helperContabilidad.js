function fetch_catalogoBancosSAT(){
  $.ajax({
    method: 'POST',
    // url: '/Resources/PHP/actions/lst_conta_cs_sat_cuentas.php',
    url: '/Resources/PHP/actions/lst_conta_cs_sat_bancos.php',
    success: function(r){
      r = JSON.parse(r);
      if (r.code == 1) {
        $('#catalogo-bancossat-helper').html(r.data);
      } else {
        console.error(r.message);
      }
    }
  })
}
