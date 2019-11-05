<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/vendor/autoload.php';
require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';

  $id_nomina = trim($_GET['semana']);
	$id_aduana = $aduana;
	$id_empleado = trim($_GET['id_empleado']);
	$anio = trim($_GET['anio']);
	$id_regimen = 9;

	#ANUAL 					http://localhost:88/nomina/nominaCFDI/impresion_Nomina_SS_completo.php?id_empleado=Todas&id_nomina=Todas&id_aduana=Todas&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana == 'Todas' ){ $consulta = 'n_anio'.$anio; }
	#ANUAL POR OFICINA		http://localhost:88/nomina/nominaCFDI/impresion_Nomina_SS_completo.php?id_empleado=Todas&id_nomina=Todas&id_aduana=160&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina == 'Todas' && $id_aduana > 0 ){ $consulta = 'n_anio'.$anio.' AND fk_id_aduana ='.$id_aduana; }
	#ANUAL POR EMPLEADO		http://localhost:88/nomina/nominaCFDI/impresion_Nomina_SS_completo.php?id_empleado=1&id_aduana=Todas&anio=2014&id_aduana=470
	if( $id_empleado > 0 && $id_aduana > 0 && $anio > 0 ){ $consulta = 'id_empleado ='.$id_empleado.' AND n_anio'.$anio.' AND fk_id_aduana ='.$id_aduana; }
	#POR OFICINA			http://localhost:88/nomina/nominaCFDI/impresion_Nomina_SS_completo.php?id_empleado=Todas&id_nomina=38&id_aduana=160&anio=2014
	if( $id_empleado == 'Todas' && $id_nomina > 0 && $id_aduana > 0 ){ $consulta = 'n_anio'.$anio.' AND fk_id_aduana ='.$id_aduana.' AND n_semana ='.$id_nomina; }	

?>
