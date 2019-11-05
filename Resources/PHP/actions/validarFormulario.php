<?PHP

  function cortarCadena($cadena,$num){
    $cadena = trim(substr(preg_replace('/\s\s+/', ' ',$cadena),0,$num));
    return $cadena;
  }

  function cortarDecimales($valor){
		if(is_float($valor)) {
			$parteValor=explode('.', $valor, 3);
			$entero = $parteValor[0];
			$decimal = rtrim(substr($parteValor[1],0,4),"0");

			if($entero == "" || is_null($entero) ){ $entero = 0; }
			if($decimal == "" || is_null($decimal)){ $decimal = 0;}

			$nuevoValor = $entero.".".$decimal;
		}else{
			if( $valor == "" or $valor == " " ){
				$nuevoValor = 0;
			}else{ $nuevoValor = $valor; }
		}
		return $nuevoValor;
	}

  function limpiarBlancos($txt){
    $txt = trim(preg_replace('/\s\s+/', ' ',$txt));
    return $txt;
  }

  function limpiarNOUSAR($cadena){
    $cadena = trim(preg_replace('/\s\s+/', ' ',preg_replace('/NO USAR/','',$cadena)));
    $cadena = trim(preg_replace('/\s\s+/', ' ',preg_replace('/()/','',$cadena)));
    return $cadena;
  }

  function redondear_dos_decimal($valor) {
    $float_redondeado=round($valor * 100) / 100;
    return $float_redondeado;
  }

  function evaluarCancelarFactura($d_fechaTimbrado,$n_total_gral){
    #falta validar que no tenga NotaCredito o PagosElectronicos. -- NO CANCELABLE
    $fechaTimbrado = date_format(date_create($d_fechaTimbrado),"Y/m/d");
    $fachaSinAceptar = date("Y/m/d",strtotime ( '+3 day' , strtotime ( $d_fechaTimbrado ) ));
    #El total de la factura debe ser maximo 5,000 y se otorgan 3 dias despues del timbrado para cancelar -- SIN ACEPTACION por parte del cliente
    if( $fechaTimbrado <= $fechaSinAceptar && $n_total_gral <= 5000 ){
      return "Sin aceptación";
    }else{
      return "Con aceptación";
    }
  }

  function TildesHtml($cadena){
    $texto = str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
    array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
    "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);
    return($texto);
  }

  function elimina_acentos($cadena){
    $texto = str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
    array("a","e","i","o","u","n","A","E","I","O","U","N"), $cadena);
    return($texto);
  }

  function numeroSemanasTieneUnAno($ano){
      $date = new DateTime;

      # Establecemos la fecha segun el estandar ISO 8601 (numero de semana)
      $date->setISODate("$ano", 53);

      if($date->format("W")=="53")
          return 53;
      else
          return 52;
  }

/*
  function elimina_acentos($cadena){
  	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
  	$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
  	$texto = strtr($cadena,$tofind,$replac);
  	return($texto);
  }
*/


?>
