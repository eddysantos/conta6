<?php

#UUID RELACIONADA
$tipoRelacion = '04'; #SUSTITUCION DE CFDI
$cfdiRelacionado = "";
$sql_facRelacionada = mysqli_query($db,"SELECT fk_id_nomina_relacionada,s_UUID_relacionada
                           FROM conta_t_nom_cdi_relacionado
                           WHERE fk_id_docNomina = $pk_id_docNomina
                           ORDER BY pk_id_partida");
$facRelacionada = '';
$UUIDfacRelacionada = '';
$cfdiRelacionado = "";
$tieneDetalle_facRelacionada = mysqli_num_rows($sql_facRelacionada);
if( $tieneDetalle_facRelacionada > 0 ){


  $cfdiRelacionado .= '<br /><br />
                      <table class="border" align="center">
                         <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
                           <td>CFDI RELACIONADO</td>
                         </tr>
                         <tr align="center">
                           <td>04 Sustitución de los CFDI pevios</td>
                         </tr>';
  while($oRst_facRelacionada = mysqli_fetch_array($sql_facRelacionada)){
    $facRelacionada = $oRst_facRelacionada['id_factura_relacionada'];
    $UUIDfacRelacionada = $oRst_facRelacionada['UUID_relacionada'];

    $cfdiRelacionado .= '<tr>
                          <td><b>'.$facRelacionada.'</b></td>
                          <td>'.$UUIDfacRelacionada.'</td>
                        </tr>';
  }

  $cfdiRelacionado .= '</table>';
}

?>
