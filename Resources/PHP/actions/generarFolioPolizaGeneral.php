<?PHP
    $root = $_SERVER['DOCUMENT_ROOT'];
    require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

    $system_callback = [];
    $data = $_POST;

    $tipo = trim($_POST['diatipo']);
    $aduana = trim($_POST['diaaduana']);
    $fecha = trim($_POST['diafecha']);
    $concepto = trim($_POST['diaconcepto']);

    $fechaDoc = date_format(date_create($fecha),'Y-m-d');
    if(!isset($mesPoliza)){
      $mesPoliza = date_format(date_create($fecha),'m');
    }

    mysqli_query($db,"INSERT INTO conta_t_polizas_mst (d_fecha,fk_usuario,fk_id_aduana,s_concepto,d_mes)
    		VALUES ('$fechaDoc','$usuario','$aduana','$concepto',$mesPoliza)");

    $nFolio = mysqli_insert_id($db);

    $descripcion = "Se Genero la Poliza: $nFolio Concepto: $concepto";
    $clave = 'polizas';
    $folio = $nFolio;
    require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
?>
