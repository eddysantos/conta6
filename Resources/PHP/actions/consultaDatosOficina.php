<?php
    $query_oficina = "SELECT pk_id_aduana,s_nombre FROM conta_t_oficinas where s_Pais = 'MEX' ORDER BY s_nombre";
    $stmt_oficina = $db->prepare($query_oficina);
    if (!($stmt_oficina)) { die("Error during query prepare [$db->errno]: $db->error"); }
    if (!($stmt_oficina->execute())) { die("Error during query prepare [$stmt_oficina->errno]: $stmt_oficina->error"); }
    $rslt_oficina = $stmt_oficina->get_result();

    $lst_oficinasPermitidas = "<option value='0'>ADUANA</option>";
    while ($row_oficina = $rslt_oficina->fetch_assoc()){

      if($row_oficina['pk_id_aduana'] == 160 && $oRst_permisos['s_contab_Per_160'] == 1 ){
        if($aduana == 160 ){
          $lst_oficinasPermitidas .= "<option select value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }else{
          $lst_oficinasPermitidas .= "<option value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }
      }

      if($row_oficina['pk_id_aduana'] == 240 && $oRst_permisos['s_contab_Per_240'] == 1 ){
        if($aduana == 240 ){
          $lst_oficinasPermitidas .= "<option select value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }else{
          $lst_oficinasPermitidas .= "<option value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }
      }

      if($row_oficina['pk_id_aduana'] == 241 && $oRst_permisos['s_contab_Per_241'] == 1 ){
        if($aduana == 241 ){
          $lst_oficinasPermitidas .= "<option select value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }else{
          $lst_oficinasPermitidas .= "<option value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }
      }

      if($row_oficina['pk_id_aduana'] == 430 && $oRst_permisos['s_contab_Per_430'] == 1 ){
        if($aduana == 430 ){
          $lst_oficinasPermitidas .= "<option select value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }else{
          $lst_oficinasPermitidas .= "<option value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }
      }

      if($row_oficina['pk_id_aduana'] == 470 && $oRst_permisos['s_contab_Per_470'] == 1 ){
        if($aduana == 470 ){
          $lst_oficinasPermitidas .= "<option select value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }else{
          $lst_oficinasPermitidas .= "<option value='$row_oficina[pk_id_aduana]'>$row_oficina[s_nombre]</option>";
        }
      }

    }


?>
