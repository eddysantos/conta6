<?php

/**
 *  Wrapper for PDO Queries
 */
class QueryPDO extends PDO {

  public function __construct(){
    $db_configuration = parse_ini_file('db_config.ini', true);

    $hostname = $db_configuration['spectrum_tools']['host'];
    $dbname = $db_configuration['spectrum_tools']['database'];
    $port = $db_configuration['spectrum_tools']['port'];
    $username = $db_configuration['spectrum_tools']['user'];
    $password = $db_configuration['spectrum_tools']['password'];

    $dsn = 'mysql:host=' .$hostname. ';dbname=' . $dbname . ';port=' . $port;
    parent::__construct($dsn,$username,$password);
  }

  public function getObjectInfo(){
    return $this;
  }
}


 ?>
