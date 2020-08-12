<?PHP
	#******************************
	# CONEXION GLOBAL PC NET
	#******************************
	$bd2 = 'bd_demo_13';
	$user2 = 'contabilidad';
	$clave2 = 'mu$h0d!n3r0';
	#$host2 = '12.34.236.229';
	$host2 = '10.1.4.10';
	$port2 = '3306';
	#$domain = '12.34.236.229';
	$domain = '10.1.4.10';

## FUNCIONA CORRECTAMENTE
	$linkPCnet = mysqli_connect($host2, $user2, $clave2, $bd2, $port2);
	if (!$linkPCnet) { die('Error conectando a la base de datos remota: ' . mysqli_error()); }
	
	$linkBD_PCnet = mysqli_select_db($linkPCnet,$bd2);
	if (!$linkBD_PCnet) {
		die ('Error seleccionando la base de datos: ' . mysqli_error());
	}
/*	
if (mysqli_ping(mysqli_connect($host2, $user2, $clave2, $bd2, $port2))) {
    printf ("¡La conexión está bien!\n");
} else {
   echo "error";
}
	
*/		

/*
if ($linkPCnet->connect_errno) {
    printf("Conexión fallida: %s\n", $linkPCnet->connect_error);
    exit();
}
*/
/*
#pingDomain($host2);

#function pingDomain($domain){
    $starttime = microtime(true);
    $file      = @fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $statusConexionGlobalPCnet    = 0;
 
    if(!$file){ $statusConexionGlobalPCnet = -1;  // Site is down
    }else {
        fclose($file);
        $statusConexionGlobalPCnet = ($stoptime - $starttime) * 1000;
        $statusConexionGlobalPCnet = floor($statusConexionGlobalPCnet);
    }
    
    if ($statusConexionGlobalPCnet <> -1) {
        #echo 'Conectado';
		$linkPCnet = mysqli_connect($host2, $user2, $clave2, $bd2, $port2);
		if (!$linkPCnet) { die('Error conectando a la base de datos remota: ' . mysqli_error()); }
		
		$linkBD_PCnet = mysqli_select_db($linkPCnet,$bd2);
		if (!$linkBD_PCnet) {
			die ('Error seleccionando la base de datos: ' . mysqli_error());
		}		
    }/* else {
        echo "<center><font color='#F73A4A'><b>No hay conexión con la réplica de GlobalPC.Net</center></b></font>";
    }*/
    
#}

?>