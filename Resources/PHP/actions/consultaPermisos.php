<?php

  $oRst_permisos = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM conta_cu_permisos WHERE pk_usuario = '$usuario' "));

?>
