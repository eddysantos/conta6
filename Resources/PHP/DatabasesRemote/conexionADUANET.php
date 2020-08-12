<?PHP
	#******************************
	# CONEXION SAAIWEB
	#******************************


$host = '10.1.4.10';
$db = 'SAAIWEB';
$port = 3308;
$usr = 'phpscripts';
#$usr = 'prolog';
$pwd = 'php$cr1p7';

$aduanet = new mysqli($host, $usr, $pwd, $db, $port) or die ('No se pudo hacer la conexión al servidor de ADUANET ('. $aduanet->errno . '): ' . $aduanet->error);



?>