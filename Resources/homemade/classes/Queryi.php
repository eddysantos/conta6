<?php

/*
 This class handles files uploads and downloads or metadata editing.
 */
class Queryi extends mysqli
{
  public $orderby = NULL;
  public $groupby = NULL;

  //DML Properties
  private $fields;
  private $table;
  private $left_joins = [];
  private $wheres = []; //To store the conditions of the query.
  private $wheres_values = [];

  //MySqli objects will be stored here.
  private $stmt;
  private $rslt;
  public $aff_rows;

  public $rows_returned;
  public $dataset = [];

  public $last_error = "";
  public $last_id;

  //Properties for encryption and decryption
  private $cipher = "AES-256-CBC";
  private $sha = 'sha256';
  private $hashing = 'ewgdhfjjluo3pip4l';
  private $hashing_iv = 'sdfkljsadf567890saf';

  function __construct($specific_server = NULL){
    $db_configuration = parse_ini_file('db_config.ini', true);

    if ($specific_server != NULL and array_key_exists($specific_server, $db_configuration)) {
      $db_config = $db_configuration[$specific_server];
    } else {
      $db_config = $db_configuration['spectrum_tools'];
    }

    if ($db_config ) {
      // code...
    }

    parent::__construct($db_config['host'],$db_config['user'],$db_config['password'],$db_config['database'],$db_config['port']);

    if ($this->errno) {
      error_log($this->last_error = "MySql Connection Error ($this->errno): $this->error");
    }
  }

  function insert(string $table, array $data){
    $num_params = count($data);
    $s = str_repeat("s", $num_params);

    $bind_params = [$s];
    foreach ($data as $field => $value) {
      $bind_params[] =& $data[$field];
    }

    $fields = implode(",", array_keys($data));

    $value_tokens = str_repeat("?,", $num_params);
    $value_tokens = rtrim($value_tokens, ",");

    $query = "INSERT IGNORE INTO $table ($fields) VALUES ($value_tokens)";

    $this->stmt = $this->prepare($query);

    if (!$this->stmt) {
      $this->last_error = "MySql error ($this->errno): $this->error";
      error_log("Queryi error: $this->error");
      return false;
    }

    // error_log("4 $table");
    call_user_func_array(array($this->stmt, 'bind_param'), $bind_params);
    if (!$this->stmt) {
      $this->last_error = "MySql error ($this->errno): $this->error";
      error_log("Queryi error: $this->error");
      return false;
    }

    if ($this->stmt->execute()) {
      $this->aff_rows = $this->stmt->affected_rows;
      $this->last_id = $this->stmt->insert_id == 0 ? "true" :  $this->stmt->insert_id;
      return $this->last_id;
    } else {

      $this->last_error = "MySql error ({$this->stmt->errno}): {$this->stmt->error}";
      return false;
    }
  }

  function update(string $table, array $id, array $data){
    $num_params = count($data);
    $s = str_repeat("s", $num_params + 1);
    $field_value_tokens = "";
    $id_token = "$id[0] = ?";

    $bind_params = [$s];
    foreach ($data as $field => $value) {
      $field_value_tokens .= " $field = ?,";
      $bind_params[] =& $data[$field];
    }
    $bind_params[] =& $id[1];

    $field_value_tokens = rtrim($field_value_tokens, ",");

    $query = "UPDATE $table SET$field_value_tokens WHERE $id_token";
    $this->stmt = $this->prepare($query);

    if (!$this->stmt) {
      $this->last_error = "MySql error ($this->errno): $this->error";
      return false;
    }

    call_user_func_array(array($this->stmt, 'bind_param'), $bind_params);
    if (!$this->stmt) {
      $this->last_error = "MySql error ($this->errno): $this->error";
      return false;
    }

    if ($this->stmt->execute()) {
      $this->aff_rows = $this->stmt->affected_rows;
      $this->last_id = $this->stmt->insert_id;
      return true;
    } else {
      error_log($this->stmt->error);
      $this->aff_rows = $this->stmt->affected_rows;
      $this->last_error = "MySql error ($this->errno): $this->error";
      return false;
    }
  }

  function encrypt($password = NULL){
    $cipher = "AES-256-CBC";
    $sha = 'sha256';
    $hashing = 'ewgdhfjjluo3pip4l';
    $hashing_iv = 'sdfkljsadf567890saf';

    $key = hash($sha, $hashing);
    $iv = substr(hash($sha, $hashing_iv), 0, 16);
    $token = openssl_encrypt($password, $cipher, $key, 0, $iv);
    $token = base64_encode($token);
    return $token;
  }

  function decrypt($encrypted){
    $cipher = "AES-256-CBC";
    $sha = 'sha256';
    $hashing = 'ewgdhfjjluo3pip4l';
    $hashing_iv = 'sdfkljsadf567890saf';

    $key = hash($sha, $hashing);
    $iv = substr(hash($sha, $hashing_iv), 0, 16);
    $decrypted = openssl_decrypt(base64_decode($encrypted),$cipher, $key, 0, $iv);
    return $decrypted;
  }

  function select(string $query = NULL){
    $where = "";
    $left_joins = "";
    $bind_params = [];

    if (count($this->left_joins) > 0) {
      foreach ($this->left_joins as $left_join) {
        $left_joins .= " $left_join";
      }
    }

    if (count($this->wheres) > 0) {
      $where = "WHERE ";
      foreach ($this->wheres as $i => $a_where) {
        if ($i != 0) {
          $where .= " AND ";
        }
        $where .= $a_where;
      }
      $num_params = substr_count($where, "?");

      $s = str_repeat("s", $num_params);
      $bind_params = [$s];
      foreach ($this->wheres_values as $value) {
        array_push($bind_params, $value);
      }
    }

    $query = "SELECT $this->fields FROM $this->table $left_joins $where";

    $stmt = $this->prepare($query);
    if (!$stmt) {
      $this->last_error = "MySql error ($this->errno): $this->error";
      return false;
    }

    if ($bind_params != []) {
      call_user_func_array(array($stmt, 'bind_param'), $bind_params);
      if (!$stmt) {
        $this->last_error = "MySql error ($this->errno): $this->error";
        return false;
      }
    }

    if ($stmt->execute()) {
      $this->rows_returned = $stmt->affected_rows;

      if ($this->rows_returned > 0) {
        $rslt = $stmt->get_result();
        while ($row = $rslt->fetch_assoc()) {
          $this->dataset[] = $row;
        }
      }
      return $this->dataset;
    } else {
      $this->last_error = "MySql error ($this->errno): $this->error";
      return false;
    }
  }

  function setTable($table){
    $this->table = $table;
  }

  function setFields(array $fields){
    $this->fields = implode(",", $fields);
  }

  function addEqualTo($field, $value){
    $this->wheres[] = "$field = ?";
    $this->wheres_values[] = $value;
  }

  function addGreaterThan($field, $value){
    $this->wheres[] = "$field > ?";
    $this->wheres_values[] = $value;
  }

  function addLessThan($field, $value){
    $this->wheres[] = "$field < ?";
    $this->wheres_values[] = $value;
  }

  function addBetween($field, $value1, $value2){
    $this->wheres[] = [
      "$field BETWEEN ? AND ?"
    ];
    $this->wheres_values[] = $value1;
    $this->wheres_values[] = $value2;
  }

  function leftJoin($table, ...$joinConditions){
    $fullJoinStatement = "LEFT JOIN $table ON ";
    foreach ($joinConditions as $i => $joinCondition) {
      if ($i !== 0) {
        $fullJoinStatement .= " AND ";
      }
      $fullJoinStatement .= $joinCondition;
    }

    $this->left_joins[] = $fullJoinStatement;
  }

}


 ?>
