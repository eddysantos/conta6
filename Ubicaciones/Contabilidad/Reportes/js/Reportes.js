$(document).ready(function(){

  $( ".opciones_reportes_conta" ).change(function() {
    // alert( "Handler for .change() called." );
      if(this.value == '1' || this.value == '5' || this.value == '6' || this.value == '9' || this.value == '10'){ // SOLO CLIENTES ------ DESABILITADOS
        $('.clientes').prop('disabled',true);
        $('.oficina,.fechas,.cuentas').prop('disabled',false);
      }

      else if (this.value == '3' || this.value == '4' || this.value == '13' || this.value == '59') { // OFICINA Y CUENTAS ------ DESABILITADO
        $('.oficina,.cuentas').prop('disabled',true);
        $('.clientes,.fechas').prop('disabled',false);
      }

      else if (this.value == '7') { // SOLO OFICINA Y FECHAS ------ DESABILITADO
        $('.oficina,.fechas').prop('disabled',true);
        $('.clientes').prop('disabled',false);
      }

      else if (this.value == '8' || this.value == '26') { // SOLO OFICINAS VISIBLES
        $('.fechas,.clientes,.corres').prop('disabled',true);
        $('.oficina').prop('disabled',false);
      }

      else if (this.value == '11' || this.value == '14' || this.value == '32' || this.value == '38' || this.value == '41' || this.value == '42' || this.value == '43') { // SOLO FECHAS VISIBLES 1
        $('.oficina,.clientes,.cuentas,.corres').prop('disabled',true);
        $('.fechas').prop('disabled',false);
      }

      else if (this.value == '45' || this.value == '46' || this.value == '47' || this.value == '48' || this.value == '50' || this.value == '51' || this.value == '52') { // SOLO FECHAS VISIBLES 2
        $('.oficina,.clientes,.cuentas').prop('disabled',true);
        $('.fechas').prop('disabled',false);
      }

      else if (this.value == '53' || this.value == '63' || this.value == '65') { // SOLO FECHAS VISIBLES 3
        $('.oficina,.clientes,.cuentas,.ctasMayor').prop('disabled',true);
        $('.fechas').prop('disabled',false);
      }
      else if (this.value == '70') { // SOLO FECHAS VISIBLES 3
        $('.oficina,.clientes,.cuentas').prop('disabled',true);
        $('.fechas,.ctasMayor').prop('disabled',false);
      }

      else if (this.value == '12'|| this.value == '15' || this.value == '16' || this.value == '17' || this.value == '18' || this.value == '19' || this.value == '20' || this.value == '25'){
        // SOLO OFICINA Y FECHAS VISIBLES 1 / CLIENTE,CUENTAS,CORRESPONSALES DESABILITADOS
        $('.clientes,.cuentas,.corres').prop('disabled',true);
        $('.fechas,.oficina').prop('disabled',false);
      }

      else if (this.value == '27' || this.value == '28' || this.value == '29' || this.value == '31' || this.value == '33' || this.value == '34' || this.value == '39' || this.value == '44'){
        // SOLO OFICINA Y FECHAS VISIBLES 2 / CLIENTE,CUENTAS,CORRESPONSALES DESABILITADOS
        $('.clientes,.cuentas,.corres').prop('disabled',true);
        $('.fechas,.oficina').prop('disabled',false);
      }

      else if (this.value == '58' || this.value == '56' || this.value == '62' || this.value == '64' || this.value == '66' || this.value == '67' || this.value == '69'){
        // SOLO OFICINA Y FECHAS VISIBLES 3 / CLIENTE,CUENTAS,CORRESPONSALES DESABILITADOS
        $('.clientes,.cuentas,.corres,.ctasMayor').prop('disabled',true);
        $('.fechas,.oficina').prop('disabled',false);
      }

      else if (this.value == '21' || this.value == '22' || this.value == '24' || this.value == '35' || this.value == '36') { // OFICINAS Y CORRESPONSALES ----- DESABILITADO
        $('.fechas,.clientes').prop('disabled',false);
        $('.oficina,.corres').prop('disabled',true);
      }

      else if (this.value == '23' || this.value == '37') { // OFICINAS Y CLIENTES ------ DESABILITADOS
        $('.fechas,.corres').prop('disabled',false);
        $('.oficina,.clientes').prop('disabled',true);
      }

      else if (this.value == '30') { // CLIENTES, CORRESPONSAL Y FECHA INICIAL ------- DESABILITADO
        $('#ffinal3,.oficina').prop('disabled',false);
        $('#fini3,.clientes,.corres').prop('disabled',true);
      }

      else if (this.value == '49' || this.value == '57' || this.value == '60') { // SOLO FECHA FINAL -----VISIBLE
        $('#ffinal4,#ffinal5,#ffinal6').prop('disabled',false);
        $('.oficina,.clientes,#fini4,#fini5,#fini6').prop('disabled',true);
      }

      else if (this.value == '40' || this.value == '54' || this.value == '55' || this.value == '45' || this.value == '68') { // SOLO OFICINA Y FECHA FINAL -----VISIBLE
        $('.oficina,#ffinal6').prop('disabled',false);
        $('.clientes,#fini6,.ctasMayor').prop('disabled',true);
      }

      else if (this.value == '61') { // SOLO CLIENTE Y FECHA FINAL -----VISIBLE
        $('.clientes,#ffinal6').prop('disabled',false);
        $('.oficina,#fini6').prop('disabled',true);
      }

      else {
        $('.oficina,.fechas,.clientes,.corres,.ctasMayor').prop('disabled',false);
      }
    });
  }); // fin del documento
