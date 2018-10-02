<?php

/** PRODUCTION DATABASE **/

// $datab = 'plsuite';
// $host = '10.1.4.10';
// $port = 3306;
// $usr = 'prolog';
// $pwd = 'f4Tnps.03';

/** TEST DATABASE **/
$datab = 'cplaa_v6';
$host = 'localhost';
$port = 3306;
$usr = 'root';
$pwd = '';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $login->error );

 ?>
