<?php

/*
 This class handles files uploads and downloads or metadata editing.
 */
class Query
{

  private $db_config;
  private $s_db;
  private $saved_dml;
  private $params = [];
  private $stmt;
  private $row;
  private $affected;
  private $result;
  public $dataset = array();
  private $isTransaction = false;

  public $last_error = "";
  public $last_id;
  //$db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

  function __construct(){
    $this->db_config = parse_ini_file('db_config.ini', true);
    $this->s_db = new mysqli($this->db_config['spectrum_tools']['host'],$this->db_config['spectrum_tools']['user'],$this->db_config['spectrum_tools']['password'],$this->db_config['spectrum_tools']['database'],$this->db_config['spectrum_tools']['port']);

    if (!$this->s_db) {
      error_log($this->s_db->error);
    }
  }

  function setQuery($dml){
    $this->saved_dml = $dml;
    return true;
  }

  function setParameters($parameters = NULL){
    if ($parameters === NULL) {
      $this->last_error = "No se encontraron parámetros para guardar";
    } else {
      $this->params = $parameters;
    }
  }

  function initiateTransaction($tablesToLock = NULL){
    if ($tablesToLock !== NULL) {
      foreach ($tablesToLock as $table) {
        $this->s_db->query("LOCK TABLES $table WRITE;");
      }
    }
    $this->s_db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITED;");
    $this->s_db->begin_transaction();
  }

  function terminateTransaction($action = 'rollback'){
    if ($action == "rollback") {
      $this->s_db->rollback();
    } elseif ($action == "commit") {
      $this->s_db->commit();
    }
    $this->s_db->query("UNLOCK TABLES");
  }

  function runQuery(){
    $args_required = substr_count($this->saved_dml, '?');
    $bind_params = array();
    $s = "";

    if ($this->saved_dml == "") {
      $this->last_error = "No hay query para ejecutar";
      return false;
    }

    if ($args_required > 0 && count($this->params) == 0) {
      $this->last_error = "Los parametros enviados no coinciden con los parametros requeridos.";
      return false;
    }

    if (!($this->stmt = $this->s_db->prepare($this->saved_dml))) {
      $this->last_error = $this->s_db->error;
      return false;
    }

    if (count($this->params) > 0) {
      foreach ($this->params as $index => $param) {
        $s .= "s";
        $bind_params[] =& $this->params[$index];
        // error_log($param);
        // $bind_params[] =& $param;
      }
      array_unshift($bind_params, $s);
      call_user_func_array(array($this->stmt, 'bind_param'), $bind_params);

      if (!$this->stmt) {
        $this->last_error = $this->stmt->last_error;
        return false;
      }
    }

    if (!$this->stmt->execute()) {
      $this->last_error = $this->stmt->error;
      return false;
    }

    // $this->stmt->execute();
    // $this->last_error = $this->stmt->error;
    // error_log($this->last_error);
    // return false;


    $this->result = $this->stmt->get_result();
    $this->rows = $this->result ? $this->result->num_rows : 0;
    $this->affected = $this->stmt->affected_rows;
    $this->last_id = $this->stmt->insert_id;

    if ($this->rows > 0 ||$this->affected > 0) {
      if ($this->result) {
        while ($row = $this->result->fetch_assoc()) {
          $this->dataset[] = $row;
        }
      }
      // $this->s_db->close();
      return true;
    } else {
      $this->last_error = "El query no devolvió ningún resultado.";
      // $this->s_db->close();
      return false;
    }

    return false;
  }

  function returnResult(){
    $results = $this->dataset;
    $this->dataset = [];

    return $results;
  }


}


 ?>
