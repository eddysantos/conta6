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
/* no borrar
  function TildesHtml($cadena)
     {
         $texto = str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
                            array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
                                  "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);
         return($texto);
     }
     function elimina_acentos($cadena){
     		$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
     		$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
     		$texto = strtr($cadena,$tofind,$replac);
     		return($texto);
     	}

*/
?>
