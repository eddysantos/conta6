<?php

/**
 *  Esta clase maneja a los clientes
 */
class Client
{
  public $error;
  public $error_code;
  public $affected_rows;

  public $multiple_errors = [];

  //This properties hold the client information for further method calling.
  private $pkid = NULL;

  private $documentos_fiscales = [
    "actaConstitutiva"=>"actaConstitutiva",
    "registroPublicoPropiedad"=>"registroPublicoPropiedad",
    "poderRepLegal"=>"poderRepLegal",
    "identificacionRepLegal"=>"identificacionRepLegal",
    "calidadMigratoriaRepLegal"=>"calidadMigratoriaRepLegal",
    "curpRepLegal"=>"curpRepLegal",
    "rfcRepLegal"=>"rfcRepLegal",
    "constanciaSituacionFiscalEmpresa"=>"constanciaSituacionFiscalEmpresa",
    "inscripcionRFCEmpresa"=>"inscripcionRFCEmpresa",
    "comprobanteDomicilioEmpresa"=>"comprobanteDomicilioEmpresa",
    "constCambioDomicilioFiscal"=>"constCambioDomicilioFiscal",
    "cartaEncomiendaAnual"=>"cartaEncomiendaAnual",
    "verificacionDomicilioFiscal"=>"verificacionDomicilioFiscal",
    "opinionDeCumplimiento"=>"opinionDeCumplimiento",
    "solicitudEncargoConferido"=>"solicitudEncargoConferido",
    "fotografiasEmpresa"=>"fotografiasEmpresa",
  ];

  function __construct(){}

  function addClient($client_data){
      $db = new Queryi();
      $client_id = $db->insert("tbl_cliente", $client_data);

      if ($client_id) {

        $fiscales = $this->getCatalogoFiscales();
        foreach ($fiscales as $fiscal) {
          if ($fiscal['por_default'] == "No") {
            continue;
          }
          $insert_fiscal = [
            'fkid_archivo' => $fiscal['pkid_tipo_fiscal'],
            'fkid_cliente' => $client_id
          ];
          $db->insert('tbl_cliente_fiscales_solicitados', $insert_fiscal);
        }
        $db->close();
        return $client_id;
      } else {
        $this->error = $db->last_error;
        $db->close();
        return false;
      }
  }

  function addContacts($contact_data){
    $db = new Queryi();

    $password = password_hash("Password!", PASSWORD_DEFAULT);
    $contact_data['password'] = $password;

    $contact_id = $db->insert('tbl_cliente_contacto', $contact_data);

    if ($contact_id){
      $db->close();
      return $contact_id;
    } else {
      $this->error = $db->last_error;
      $db->close();
      return false;
    }
  }

  function getClientList(){
    $db = new Queryi();
    $query = "SELECT * FROM tbl_cliente";

    $dataset = [];

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    $system_callback['data'] = "";
    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      return 0;
    }

    while ($row = $rslt->fetch_assoc()) {
      $mysqli_row = [];
      foreach ($row as $field => $value) {
        if ($field == "pkid_cliente") {
          $mysqli_row[$field] = $db->encrypt($value);
        } else {
          $mysqli_row[$field] = $value;
        }
      }
      $dataset[] = $mysqli_row;
    }

    return $dataset;

  }

  function getClientInfo($client_id){
    $db = new Queryi();
    $query = "SELECT * FROM tbl_cliente c WHERE c.pkid_cliente = ? LIMIT 1";
    if (strlen($client_id) > 4) {
      $id_cliente = $db->decrypt($client_id);
    } else {
      $id_cliente = $client_id;
    }

    $dataset = [
      'clientData' => [],
      'contactCards' => [],
      'fiscalesAsignados' => []
    ];

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('s', $id_cliente);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    $system_callback['data'] = "";
    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      return false;
    }

    $dataset['clientData'] = $rslt->fetch_assoc();
    $this->pkid = $id_cliente;

    $dataset['salesExec'] = $this->getSalesExecData($dataset['clientData']['added_by']);

    if (!$dataset['salesExec']) {
      error_log($this->error);
    }

    $query = "SELECT * FROM tbl_cliente_contacto WHERE fkid_cliente = ?";

    $stmt = $db->prepare($query);
    if ($stmt) {
      $stmt->bind_param('s', $id_cliente);
    }
    if ($stmt) {
      $stmt->execute();
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows > 0) {
      while ($contactCard = $rslt->fetch_assoc()) {
        $mysqli_row = [];
        foreach ($contactCard as $field => $value) {
          if ($field == "pkid_contacto") {
            $mysqli_row[$field] = $db->encrypt($value);
          } else {
            $mysqli_row[$field] = $value;
          }
        }
        $dataset['contactCards'][] = $mysqli_row;
      }
    }

    $query = "SELECT * FROM tbl_cliente_fiscales_solicitados WHERE fkid_cliente = ?";

    $stmt = $db->prepare($query);
    if ($stmt) {
      $stmt->bind_param('s', $id_cliente);
    }
    if ($stmt) {
      $stmt->execute();
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows > 0) {
      while ($row = $rslt->fetch_assoc()) {
        $dataset['fiscalesAsignados'][] = $row['fkid_archivo'];
      }
    }

    $db->close();
    return $dataset;
  }

  function editClient($client_id, $data){
    $db = new Queryi();
    $client_id = $db->decrypt($client_id);
    $result = $db->update('tbl_cliente', ['pkid_cliente',$client_id], $data);

    $forlog = ($result) ? "true" : "false" ;
    error_log($forlog);


    if ($result) {
      $db->close();
      $this->affected_rows = $db->aff_rows;
      return $db->aff_rows;
    } else {
      $this->affected_rows = $db->aff_rows;
      $this->error = $db->last_error;
      $db->close();
      return false;
    }

  }

  function contactList($client_id){
    $db = new Queryi();
    $id_cliente = $db->decrypt($client_id);

    $dataset = [
      'contactCards' => []
    ];

    $query = "SELECT * FROM tbl_cliente_contacto WHERE fkid_cliente = ?";

    $stmt = $db->prepare($query);
    if ($stmt) {
      $stmt->bind_param('s', $id_cliente);
    }
    if ($stmt) {
      $stmt->execute();
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows > 0) {
      while ($contactCard = $rslt->fetch_assoc()) {
        $mysqli_row = [];
        foreach ($contactCard as $field => $value) {
          if ($field == "pkid_contacto") {
            $mysqli_row[$field] = $db->encrypt($field);
          } else {
            $mysqli_row[$field] = $value;
          }
        }
        $dataset['contactCards'][] = $mysqli_row;
      }
    }

    $db->close();
    return $dataset;
  }

  function getContactDetails($contact_id){
    $db = new Queryi();
    $id_contacto = $db->decrypt($contact_id);
    $dataset = [];

    $query = "SELECT * FROM tbl_cliente_contacto WHERE pkid_contacto = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('s', $id_contacto);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();


    if ($rslt->num_rows > 0) {
      while ($contactCard = $rslt->fetch_assoc()) {
        $mysqli_row = [];
        foreach ($contactCard as $field => $value) {
          if ($field == "pkid_contacto") {
            $mysqli_row[$field] = $db->encrypt($field);
          } else {
            $mysqli_row[$field] = $value;
          }
        }
        $dataset = $mysqli_row;
      }
    } else {
      $this->error = "There is no results.";
      return false;
    }

    $db->close();
    return $dataset;
  }

  function contactEmailExists($email){
    $db = new Queryi();

    $query = "SELECT * FROM tbl_cliente_contacto WHERE contactoCorreo = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('s', $email);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();
    $num_rows = $rslt->num_rows;

    $db->close();
    if ($num_rows > 0) {
      $this->error = "El correo electrónico ya existe.";
      return "Yes";
    } else {
      return "No";
    }
  }

  function getFiscalReason($fkid_fiscal = NULL){
    $db = new Queryi();

    $dataset = [];
    $query = "SELECT justificacion, nombre_fiscal FROM cat_tipo_fiscales tf WHERE pkid_tipo_fiscal = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('s', $fkid_fiscal);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      $this->error_code = "2";
      return false;
    } else {
      $reason = $rslt->fetch_assoc();
      return $reason;
    }
  }

  function getRejectionReason($id_cliente = NULL, $id_fiscal = NULL){
    $db = new Queryi();

    // $id_cliente = strlen($id_cliente) > 10 ? $db->decrypt($id_cliente) : $id_cliente;
    $id_fiscal = strlen($id_fiscal) > 10 ? $db->decrypt($id_fiscal) : $id_fiscal;
    if ($this->pkid != NULL) {
      $id_cliente = $this->pkid;
    } else {
      $id_cliente = $db->decrypt($id_cliente);
    }

    $dataset = [];
    $query = "SELECT feedbackRechazo FROM tbl_cliente_fiscales_solicitados WHERE fkid_cliente = ? AND fkid_archivo = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }

    $stmt->bind_param('ss', $id_cliente, $id_fiscal);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      $this->error_code = "2";
      return false;
    } else {
      $reason = $rslt->fetch_assoc();
      return $reason['feedbackRechazo'];
    }
  }

  function assignFiscal($fkid_fiscal, $fkid_cliente){
    $db = new Queryi();
    $fkid_cliente = $db->decrypt($fkid_cliente);

    $query = "INSERT INTO tbl_cliente_fiscales_solicitados (fkid_archivo, fkid_cliente) VALUES (?, ?) ON DUPLICATE KEY UPDATE requested = 1";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('ss', $fkid_fiscal, $fkid_cliente);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $affected_rows = $stmt->affected_rows;
    $db->close();
    if ($affected_rows > 0) {
      return true;
    } else {
      return false;
    }

    $id_cliente = $db->decrypt($id_cliente);

    $updated = $db->update('tbl_cliente', ['pkid_cliente', $id_cliente], $datos);

    if ($updated) {
      return true;
    } else {
      $this->error = $db->last_error;
      return false;
    }

  }

  function unAssignFiscal($fkid_fiscal, $fkid_cliente){
    $db = new Queryi();
    $fkid_cliente = $db->decrypt($fkid_cliente);

    $query = "UPDATE tbl_cliente_fiscales_solicitados SET requested = 0 WHERE fkid_archivo = ? AND fkid_cliente = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('ss', $fkid_fiscal, $fkid_cliente);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $affected_rows = $stmt->affected_rows;
    $db->close();
    if ($affected_rows > 0) {
      return true;
    } else {
      return false;
    }

  }

  function getFiscales($id_cliente = NULL){
    $db = new Queryi();

    $dataset = [];
    $query = "SELECT fs.fkid_archivo, tf.nombre_fiscal, fs.fileid, fs.status, fs.feedbackRechazo FROM tbl_cliente_fiscales_solicitados fs LEFT JOIN cat_tipo_fiscales tf ON fs.fkid_archivo = tf.pkid_tipo_fiscal  WHERE fs.fkid_cliente = ? AND fs.requested = 1";
    if ($this->pkid != NULL) {
      $id_cliente = $this->pkid;
    } else {
      $id_cliente = $db->decrypt($id_cliente);
    }

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('s', $id_cliente);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      $this->error_code = "2";
      return false;
    } else {
      while ($row = $rslt->fetch_assoc()) {
        $dataset[] = $row;
      }
      return $dataset;
    }
  }

  function getFiscalesPendingReview(){
      $db = new Queryi();

      $dataset = [];
      $query = "SELECT cfs.fkid_cliente idCliente,c.sRazonSocialCliente razonSocial, GROUP_CONCAT(tf.nombre_fiscal) nombreArchivos, GROUP_CONCAT(cfs.fkid_fiscal) idArchivos FROM tbl_cliente_fiscales_subidos cfs LEFT JOIN tbl_cliente_fiscales_solicitados solicitados ON solicitados.fkid_cliente=cfs.fkid_cliente AND solicitados.fkid_archivo=cfs.fkid_fiscal LEFT JOIN tbl_cliente c ON c.pkid_cliente=cfs.fkid_cliente LEFT JOIN cat_tipo_fiscales tf ON tf.pkid_tipo_fiscal=cfs.fkid_fiscal WHERE solicitados.`status` IS NULL GROUP BY idCliente,razonSocial";

      $stmt = $db->prepare($query);
      if (!($stmt)) {
        $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
        return false;
      }

      if (!($stmt->execute())) {
        $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
        return false;
      }

      $rslt = $stmt->get_result();

      if ($rslt->num_rows == 0) {
        $this->error = "There is no results.";
        $this->error_code = "2";
        $db->close();
        return false;
      } else {
        while ($row = $rslt->fetch_assoc()) {
          $dataset[] = $row;
        }
        $db->close();
        return $dataset;
      }



  }

  function getFileList($id_cliente = NULL, $id_fiscal = NULL){
    $db = new Queryi();
    $dataset = [];

    // $id_cliente = strlen($id_cliente) > 10 ? $db->decrypt($id_cliente) : $id_cliente;
    $id_fiscal = strlen($id_fiscal) > 10 ? $db->decrypt($id_fiscal) : $id_fiscal;


    $query = "SELECT fc.pkid_file fileId, fc.s_original_file_name fileName FROM tbl_cliente_fiscales_subidos cfs LEFT JOIN spectrum_tbl_file_catalogue fc ON cfs.fkid_file_catalogue=fc.pkid_file WHERE cfs.fkid_cliente= ? AND cfs.fkid_fiscal= ?";
    if ($this->pkid != NULL) {
      $id_cliente = $this->pkid;
    } else {
      $id_cliente = $db->decrypt($id_cliente);
    }

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('ss', $id_cliente, $id_fiscal);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();


    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      $this->error_code = "2";
      return false;
    } else {
      while ($row = $rslt->fetch_assoc()) {
        $array = [];
        foreach ($row as $field => $value) {
          if ($field == "fileId") {
            $array[$field] = $db->encrypt($value);
          } else {
            $array[$field] = $value;
          }
        }
        $dataset[] = $array;
      }
      return $dataset;
    }
  }

  function getCatalogoFiscales(){
    $db = new Queryi();
    $query = "SELECT * FROM cat_tipo_fiscales";

    $dataset = [];

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    $system_callback['data'] = "";
    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      return 0;
    }

    while ($row = $rslt->fetch_assoc()) {
      $dataset[] = $row;
    }

    return $dataset;

  }

  function addFilePath($fkid_fiscal, $fkid_cliente){
    $db = new Queryi();



    $db->close();
  }

  function uploadFiscal($file_object, array $ids_Fiscales, $fkid_cliente = NULL){
    $file = new File();
    $db = new Queryi();
    $db2 = new Queryi();
    // $root = '/Applications/MAMP/htdocs/SpectrumTools';
    $root = '/var/www/html/SpectrumTools';


    $fileTmpPath = $file_object['file']['tmp_name'];
    $fileName = $file_object['file']['name'];
    $fileSize = $file_object['file']['size'];
    $fileType = $file_object['file']['type'];
    $fileExtension = pathinfo($file_object['file']['name'],PATHINFO_EXTENSION);
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadDir = $root . "/Resources/uploads/";
    $filePath = $uploadDir . $newFileName;

    $fkid_cliente = strlen($fkid_cliente) > 10 ? $db->decrypt($fkid_cliente) : $fkid_cliente;

    $file_uploaded = move_uploaded_file($fileTmpPath, $filePath);

    if (!$file_uploaded) {
      $this->error = "El archivo no se pudo subir.";
      return false;
    }

    $id_file = $file->uploadFile($fileName, $fileSize, $fileType, $filePath);
    if (!$id_file) {
      foreach ($archivo->errors as $key => $value) {
        error_log("$value[0]: $value[1]");
      }
      throw new \Exception("Error Processing Request on File Query", 1);
    }

    $query = "UPDATE tbl_cliente_fiscales_solicitados SET status = ?, fileid = ? WHERE fkid_archivo = ? AND fkid_cliente = ?";
    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }

    $file_status = NULL;

    foreach ($ids_Fiscales as $id_fiscal) {

      $db2->insert('tbl_cliente_fiscales_subidos', [
        'fkid_cliente'=>$fkid_cliente,
        'fkid_fiscal'=>$id_fiscal,
        'fkid_file_catalogue'=>$id_file
      ]);

      $stmt->bind_param('ssss', $file_status, $id_file, $id_fiscal, $fkid_cliente);
      if (!($stmt)) {
        $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
        return false;
      }

      if (!($stmt->execute())) {
        $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
        return false;
      }

      $affected_rows = $stmt->affected_rows;

      if ($affected_rows == 0) {
        $this->multiple_errors[] = "Archivo: $fkid_fiscal no se modificó.";
      }
    }

    $error_count = count($this->multiple_errors);

    if ($error_count == 0) {
      return 1;
    } elseif ($error_count > 0) {
      return 2;
    }

  }

  function changeFiscalStatus($fkid_fiscal, $fkid_cliente, $status = NULL, $comment = NULL){
    $db = new Queryi();
    $fkid_cliente = strlen($fkid_cliente) > 10 ? $db->decrypt($fkid_cliente) : $fkid_cliente;
    $fkid_fiscal = strlen($fkid_fiscal) > 10 ? $db->decrypt($fkid_fiscal) : $fkid_fiscal;

    error_log("Cliente: " . $fkid_cliente);
    error_log("Fiscal: " . $fkid_fiscal);

    $query = "UPDATE tbl_cliente_fiscales_solicitados SET status = ?, feedbackRechazo = ? WHERE fkid_archivo = ? AND fkid_cliente = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }


    $stmt->bind_param('ssss', $status, $comment, $fkid_fiscal, $fkid_cliente);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $affected_rows = $stmt->affected_rows;
    $db->close();
    if ($affected_rows > 0) {
      return true;
    } else {
      $this->error = "No se identificó registro para actualizar.";
      return false;
    }

  }

  function getSalesExecData($fkid_sales_executive){
    $db = new Queryi();

    // $id_cliente = strlen($id_cliente) > 10 ? $db->decrypt($id_cliente) : $id_cliente;
    $fkid_sales_executive = strlen($fkid_sales_executive) > 10 ? $db->decrypt($fkid_sales_executive) : $fkid_sales_executive;

    $dataset = [];
    $query = "SELECT s_nombres, s_apellidoP, s_movil, s_email_laboral FROM spectrum_tbl_usuarios WHERE pk_usuario = ?";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = "Error durante la preparacion del query [$db->errno]: $db->error";
      return false;
    }

    $stmt->bind_param('s', $fkid_sales_executive);
    if (!($stmt)) {
      $this->error = "Error al pasar variables [$stmt->errno]: $stmt->error";
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
      return false;
    }

    $rslt = $stmt->get_result();

    if ($rslt->num_rows == 0) {
      $this->error = "There is no results.";
      $this->error_code = "2";
      return false;
    } else {
      $data = $rslt->fetch_assoc();
      return $data;
    }
  }

  function emailSalesExec($email_body, $email = NULL){

    $mail_template =
    "<body style='background-color:whitesmoke'>
      <div style='width: 60%;margin-left: auto;margin-right: auto;margin-top: 8%;border-radius: 15px;padding: 1rem;border: 1px solid #ccc;background-color:white;color:black'>
        <img src='https://apps.prolog-mex.com/Resources/imagenes/sww_logo.png' width='150' style='position: absolute;margin-top: -90px;margin-left: -20px;'>
        <div style='font-size:18px;color:rgba(139, 3, 4, 0.6)'> <i>¡Nueva publicación!</i> </div>
        <br><br>
        <b></b>
        <div style='font-size:24px;letter-spacing: 1px;'>Titulo</div>
        <br><br><br>
        <div style='text-align:center'>
          <a href='https://apps.prolog-mex.com/Bienvenido.php' style='background-color:#58595b;padding: 10px;padding-left:28px;padding-right:28px;border-radius: 5px;color: white;text-decoration: none;'><b>  Ingresar </b> </a>
        </div>
        <br/>
      </div>
      <div style='text-align:center'>
        <p style='font-size:10px;color:rgba(87, 88, 91, 0.6)'>Este email se a generado de manera autómatica</p>
      </div>
    </body>";

    $mail = new PHPMailer();
    try {
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8';

      $mail->Host       = "smtp.office365.com";
      $mail->SMTPDebug  = 0;
      $mail->SMTPAuth   = true;
      $mail->Port       = 587;
      $mail->Username   = 'no_reply@gowithspectrum.com';
      $mail->Password   = 'N0Repli!';
      $mail->setFrom('no_reply@gowithspectrum.com', 'Spectrum Worldwide');

      $mail->addAddress($email);
      $mail->isHTML(true);

      $mail->Subject    = "Solicitud de Información de Cliente!";
      $mail->Body       = $mail_template;

      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      $mail->Send();
    } catch (phpmailerException $e) {
      $this->error = "PHP Mailer Exception: " . $e->errorMessage();
      return false;
    } catch (Exception $e) {
      $this->error = "Unidentified Exception: " . $e->getMessage();
      return false;
    }

    return true;
  }
}


?>
