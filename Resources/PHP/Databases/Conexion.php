<?php

//
// $datab = 'SpectrumTools';
// $host = 'localhost';
// $port = 3306;
// $usr = 'stools_connection';
// $pwd = '$t0olsC0nn3c71on';

// $datab = 'Dev_SpectrumTools';
// // $host = 'localhost';
// $host = '10.1.4.31';
// $port = 3306;
// $usr = 'stools_connection';
// $pwd = '$t0olsC0nn3c71on';


/* PUERTOS LOCALES PARA DESARROLLO */
// $datab = 'SpectrumTools';
// $host = 'localhost';
// $port = 8889;
// $usr = 'root';
// $pwd = 'root';

/** TEST DATABASE ADRIANA **/
$datab = 'SpectrumTools';
$host = 'localhost';
$port = 3306;
$usr = 'root';
$pwd = '';

$db = new mysqli($host, $usr, $pwd, $datab, $port) or die ('Could not connect to the database server ' . $login->error );



// date_default_timezone_set('America/Monterrey');
//
// function exit_script($input_array){
//   $json_string = json_encode($input_array, JSON_UNESCAPED_UNICODE);
//   echo $json_string;
//   global $db;
//   $db->close();
//   die();
// }

?>
