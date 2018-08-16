<?php
    $queryCIA = "SELECT * FROM conta_t_oficinas WHERE s_tipo = 'Principal'";
    $stmtCIA = $db->prepare($queryCIA);
    if (!($stmtCIA)) { die("Error during query prepare [$db->errno]: $db->error"); }
    if (!($stmtCIA->execute())) { die("Error during query prepare [$stmtCIA->errno]: $stmtCIA->error"); }
    $rsltCIA = $stmtCIA->get_result();
    $rowCIA = $rsltCIA->fetch_assoc();


    $rfcCIA = trim($rowCIA['s_RFC']);
    $nombreCIA = trim($rowCIA['s_Razon_Social']);
    $cpCIA = trim($rowCIA['s_codigo']);
    $regPatronalCIA = trim($rowCIA['s_Reg_Patronal']);
?>
