<?php


$host = 'semillero.site';
$db = 'db4g4hc5vtmf45';
$port = 3306;
$usr = 'uxd9z9upvdg7f';
$pwd = '216Br3$12Q3A';
//$sock = '/tmp/mysqladuanet.sock';

$semillero = new mysqli($host, $usr, $pwd, $db, $port) or die ('No se pudo hacer la conexión al servidor de usuarios ('. $aduanet->errno . '): ' . $aduanet->error);
// $db = new mysqli($host, $usr, $pwd, $db, $port, $sock) or die ('No se pudo hacer la conexión al servidor de usuarios ('. $dbLogin->errno . '): ' . $dbLogin->error);

?>
