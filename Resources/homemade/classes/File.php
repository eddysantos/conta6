<?php

/*
 This class handles files uploads and downloads or metadata editing.
 */
class File
{

  private $db_config;
  private $s_db;
  public $db;

  public $erros = array();
  public $last_error;

  public $filename;
  public $filesize;
  public $filetype;
  public $filepath;




  function __construct($fileId = NULL){
    $this->db = new Query();
    if ($fileId !== NULL) {
      $db = new Queryi();
      $fileId = $db->decrypt($fileId);
      $fileData = $this->fetchFileData($fileId);

      error_log($fileId);

      $this->filename = $fileData[0]['s_original_file_name'];
      $this->filesize = $fileData[0]['i_file_size'];
      $this->filetype = $fileData[0]['s_file_type'];
      $this->filepath = $fileData[0]['s_file_path'];
    }
  }

  function uploadFile($fileName, $fileSize, $fileType,$path){
    $params = [$fileName, $fileSize, $fileType,$path];
    $this->db->setQuery("INSERT INTO spectrum_tbl_file_catalogue (s_original_file_name, i_file_size, s_file_type, s_file_path) VALUES (?,?,?,?)");
    $this->db->setParameters($params);

    if ($this->db->runQuery()) {
      return $this->db->last_id;
    } else {
      $this->errors[] = ['MySql Error', $this->db->last_error];
      $this->last_error = "Mysql Error {$this->db->last_error}";
      return false;
    }

  }

  function fetchFileData($fileId){
    $params = [$fileId];
    $this->db->setQuery("SELECT s_original_file_name, i_file_size, s_file_type, s_file_path FROM spectrum_tbl_file_catalogue WHERE pkid_file = ?");
    $this->db->setParameters($params);
    if (!$this->db->runQuery()) {
      error_log("Error ejecutando el query para fetch_file_path");
      error_log($this->db->last_error);
      return false;
    }

    return $this->db->returnResult();
  }

  function fetchFilePath($fileId){
    $params = [$fileId];
    $this->db->setQuery("SELECT s_file_path FROM spectrum_tbl_file_catalogue WHERE pkid_file = ?");
    $this->db->setParameters($fileId);
    if (!$this->db->runQuery()) {
      error_log("Error ejecutando el query para fetch_file_path");
      error_log($this->db->last_error);
      return false;
    }

    return $this->db->returnResult();
  }
}


 ?>
