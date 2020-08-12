<?php

/*
 This class handles policies uploads and downloads or metadata editing.
 */
class Politica
{

  private $db_config;
  private $s_db;
  public $db;
  public $db_old;

  const DIVISION = "spectrum_tbl_politicas_division";
  const DEPARTAMENTO = "spectrum_tbl_politicas_depto";
  const PUESTO = "spectrum_tbl_politicas_puesto";
  const USUARIO = "spectrum_tbl_politicas_usuario";


  public $errors = array();
  public $last_error;

  function __construct($withTransaction = false){
    $this->db = new Queryi();
    $this->db_old = new Query();
  }

  function agregarPolitica($nombre_politica,$login_usuario,$fecha_reg,$id_file){
    $column_values = [
      "s_nombre_politica"=> $nombre_politica,
      "s_usuario_creacion"=> $login_usuario,
      "d_usuario_creacion"=> $fecha_reg,
      "fkid_file"=> $id_file,
    ];

    $return_id = $this->db->insert("spectrum_tbl_politicas", $column_values);

    if ($return_id) {
      return $return_id;
    } else {
      return $this->db->last_error;
    }
  }
  function registrarArchivo($fkid_politica = NULL, $fkid_file = NULL){

    if ($fkid_politica === NULL ||$fkid_file === NULL) {
      $this->errors[] = ['Information missing', "Se tiene que incluir el id de la política y del archivo para registrar correctamente el archivo."];
      return false;
    }

    $column_values = [
      "fkid_politica"=>$fkid_politica,
      "fkid_file"=>$fkid_file,
      "s_added_by"=>$_SESSION['user']['s_usuario']
    ];

    $return_id = $this->db->insert("spectrum_tbl_politicas_file", $column_values);

    if ($return_id) {
      return $return_id;
    } else {
      return $this->db->last_error;
    }
  }


  function actualizarNombre($s_nombre_politica,$login_usuario,$fecha_reg,$pk_politica){
    $params = [$s_nombre_politica,$login_usuario,$fecha_reg,$pk_politica];
    $this->db_old->setQuery("UPDATE spectrum_tbl_politicas
                        SET s_nombre_politica = ?,
                            s_usuario_edito = ?,
                            d_usuario_edito = ?
                        WHERE pk_politica = ?");

    $this->db_old->setParameters($params);
    $this->db_old->runQuery();
  }

  function jalarPolitica(){
    $query = new Queryi();

    $fields = [
      "pk_politica id_politica",
      "s_nombre_politica nombre_politica"
    ];

    $query->setFields($fields);
    $query->setTable("spectrum_tbl_politicas");

    // $query->leftJoin("table2 b", "b.field1 = a.field2");
    // $query->leftJoin("table3 c", "b.field1 = c.field2", "b.field3 = c.field3");

    $query->addEqualTo("pk_politica", "25");
    $query->addEqualTo("politica_status", "Activa");

    $value = $query->select();
    return $value;
    // return $query->select();
  }
  function fetchPolitica($id){
    $params = [$id];
    $this->db_old->setQuery("SELECT s_nombre_politica nombre_politica , i_div1 div1 , i_div2 div2 , i_div3 div3 , i_div4 div4 , i_div5 div5 , i_div6 div6 , i_div7 div7, i_na divNA FROM spectrum_tbl_politicas p WHERE p.pk_politica = ?");
    $this->db_old->setParameters($params);
    if (!$this->db_old->runQuery()) {
      error_log("Error ejecutando el query para fetch_politica");
      return false;
    }
    $politica_dataset['politica_data'] = $this->db_old->returnResult();

    $this->db_old->setQuery("SELECT fc.s_original_file_name file_name, fc.s_file_path path FROM spectrum_tbl_politicas_file pf LEFT JOIN spectrum_tbl_file_catalogue fc ON pf.fkid_file = fc.pkid_file WHERE pf.fkid_politica = ? ORDER BY fc.d_date_uploaded DESC");
    // $this->db_old->runQuery();
    if (!$this->db_old->runQuery()) {
      error_log("Error ejecutando el query para fetch_politica_file");
      error_log($this->db_old->last_error);
      return false;
    }
    $politica_dataset['files'] = $this->db_old->returnResult();

    return $politica_dataset;
  }

  function asignarPolitica($fkid_politica, $fkid_asignar, $tipo_fkid){
    switch ($tipo_fkid) {
      case 'div':
        $valores = array(
          "fk_politica"=>$fkid_politica,
          "fk_division"=>$fkid_asignar
        );
        $this->db->insert(self::DIVISION, $valores);
        break;

      case 'dep':
        $valores = array(
          "fk_politica"=>$fkid_politica,
          "fk_depto"=>$fkid_asignar
        );
        $this->db->insert(self::DEPARTAMENTO, $valores);
        break;

      case 'puesto':
        $valores = array(
          "fk_politica"=>$fkid_politica,
          "fk_puesto"=>$fkid_asignar
        );
        $this->db->insert(self::PUESTO, $valores);
        break;

      case 'usuario':
        $valores = array(
          "fk_politica"=>$fkid_politica,
          "fk_usuario"=>$fkid_asignar
        );
        $this->db->insert(self::USUARIO, $valores);
        break;

      default:
        return false;
        break;
    }
    return true;
  }

  function desAsignarPolitica($fkid_politica, $fkid_desasignar, $tipo_fkid){
    $fkid_politica = $this->db->real_escape_string($fkid_politica);
    $fkid_desasignar = $this->db->real_escape_string($fkid_desasignar);
    switch ($tipo_fkid) {
      case 'div':
        $table = self::DIVISION;
        $field = "fk_division";
        break;

      case 'dep':
        $table = self::DEPARTAMENTO;
        $field = "fk_depto";
        break;

      case 'puesto':
        $table = self::PUESTO;
        $field = "fk_puesto";
        break;

      case 'usuario':
        $table = self::USUARIO;
        $field = "fk_usuario";
        break;
    }
    $this->db->query("DELETE FROM $table WHERE fk_politica = '$fkid_politica' AND $field = '$fkid_desasignar'");

  }

}


 ?>
