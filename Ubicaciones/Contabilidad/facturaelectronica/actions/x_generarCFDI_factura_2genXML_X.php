<?PHP
/* Empezamos con una matriz de datos que puede proceder de cualquier fuente
	(p.e. una lectura de base de datos) */
	$matrizDeObras = array(
		array(
			"obra"=>"Construccion de aparcamiento en el centro",
			"fecha_de_inicio"=>"10/02/2015",
			"fecha_de_finalizacion"=>"31/10/2016",
			"contratista"=>"Actuaciones Urbanas",
			"miembros_tecnicos"=>"3",
			"personal_tecnico"=>array(
				"arquitecto"=>"Pedro Steven De Gloria",
				"aparejador"=>"Manuela Gracia Salmerón",
				"supervisor"=>"Andrés Garrido Fuentes"
			),
			"presupuesto"=>"20.000.000"
		),
		array(
			"obra"=>"Adaptación de estación suburbana",
			"fecha_de_inicio"=>"06/08/2016",
			"fecha_de_finalizacion"=>"01/11/2016",
			"contratista"=>"Obras del Norte",
			"miembros_tecnicos"=>"4",
			"personal_tecnico"=>array(
				"arquitecto"=>"Manuel Alarcón Rodríguez",
				"aparejador"=>"Carlos Torres Fuentes",
				"director_de_tunelacion"=>"María García Pérez",
				"jefe_de_compras"=>"Antonia Bisonette Tristán"
			),
			"presupuesto"=>"6.500.000"
		),
		array(
			"obra"=>"Electrificación de zona restringida",
			"fecha_de_inicio"=>"02/02/2014",
			"fecha_de_finalizacion"=>"26/05/2017",
			"contratista"=>"Iluminación y Electricidad, SA",
			"miembros_tecnicos"=>"2",
			"personal_tecnico"=>array(
				"jefe_de_electricistas"=>"Laura De la Iglesia Cifuentes",
				"responsable_de_control"=>"Yolanda Torres Torres"
			),
			"presupuesto"=>"7.800.000"
		)
	);

	/* Vamos a crear un XML con XMLWriter a partir de la matriz anterior.
	Lo vamos a crear usando programación orientada a objetos.
	Por lo tanto, empezamos creando un objeto de la clase XMLWriter.*/
	$objetoXML = new XMLWriter();

	// Estructura básica del XML
	$objetoXML = new XMLWriter();
	$objetoXML->openURI("c:\\obras.xml");
	$objetoXML->setIndent(true);
	$objetoXML->setIndentString("\t");
	$objetoXML->startDocument('1.0', 'utf-8');
	// Inicio del nodo raíz
	$objetoXML->startElement("obras");

	foreach ($matrizDeObras as $obra){
		$objetoXML->startElement("obra"); // Se inicia un elemento para cada obra.
		// Atributo de la fecha de inicio del elemento obra
		$objetoXML->writeAttribute("inicio", $obra["fecha_de_inicio"]);
		// Atributo de la fecha de final del elemento obra
		$objetoXML->writeAttribute("final", $obra["fecha_de_finalizacion"]);
		// Atributo contratista del elemento obra
		$objetoXML->writeAttribute("contratista", $obra["contratista"]);
		// Atributo presupuesto del elemento obra.
		$objetoXML->writeAttribute("presupuesto", $obra["presupuesto"]);
		// Texto del nombre de la obra, dentro del elemento obra
		$objetoXML->text("\n\t\t".$obra["obra"]."\n");
		// Inicio del elemento anidado del personal técnico
		$objetoXML->startElement("personal_tecnico");
		// Atributo del número de miembros del personal técnico.
		$objetoXML->writeAttribute("miembros", $obra["miembros_tecnicos"]);
		// Para cada miembro del personal técnico se crea un elemento.
		foreach ($obra["personal_tecnico"] as $keyMiembro=>$miembro){
			$objetoXML->startElement("miembro");
			// El cargo es un atributo del elmento del miembro técnico.
			$objetoXML->writeAttribute("cargo", $keyMiembro);
			// El nombre del miembro es el contenido del elemento del miembro técnico
			$objetoXML->text($miembro);
			$objetoXML->endElement();// Finaliza cada elelmento del miembro técnico.
		}
		$objetoXML->endElement(); // Final del elemento que cubre todos los miembros técnicos.
		$objetoXML->fullEndElement (); // Final del elemento "obra" que cubre cada obra de la matriz.
	}
	$objetoXML->endElement(); // Final del nodo raíz, "obras"
	$objetoXML->endDocument(); // Final del documento
	//$out = xmlwriter_output_memory($objetoXML, 0);
	//echo $out;
?>
