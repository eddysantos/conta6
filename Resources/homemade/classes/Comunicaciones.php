

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . "/Resources/homemade/classes/Query.php";
require $root . "/Resources/homemade/classes/Queryi.php";


  class comunicaciones{

    private $db_config;
    private $s_db;
    public $db;
    public $db_old;

    public $errors = array();
    public $last_error;

    function __construct($withTransaction = false){
      $this->db = new Queryi();
      $this->db_old = new Query();
    }


    function agregar_publicacion($titulo,$articulo,$fecha_publicado,$estado,$notificacion,$id_file,$ver_160,$ver_240,$ver_241,$ver_242,$ver_243,$ver_430,$ver_470,$login_pk_usuario,$fecha_reg){
      $column_values = [
        "s_titulo"=> $titulo,
        "s_articulo"=>$articulo,
        "d_fecha_publicado"=>$fecha_publicado,
        "i_estado"=>$estado,
        "i_notificacion"=>$notificacion,
        "fkid_file"=>$id_file,
        "i_ver_160"=>$ver_160,
        "i_ver_240"=>$ver_240,
        "i_ver_241"=>$ver_241,
        "i_ver_242"=>$ver_242,
        "i_ver_243"=>$ver_243,
        "i_ver_430"=>$ver_430,
        "i_ver_470"=>$ver_470,
        "fk_usuario"=>$login_pk_usuario,
        "d_fecha_agrego"=>$fecha_reg,
      ];

      $return_id = $this->db->insert("spectrum_tbl_publicaciones", $column_values);

      if ($return_id) {
        return $return_id;
      } else {
        return $this->db->last_error;
      }

    }


    // function actualizar($table,$pk_publicacion,$estado){
    //   $id = [
    //     'pk_publicacion'=>$pk_publicacion,
    //   ];
    //   $data = [
    //     "i_estado"=> $estado,
    //   ];
    //   $return_id = $this->db->update($table, $id, $data);
    //   if ($return_id) {
    //     return $return_id;
    //   } else {
    //     return $this->db->last_error;
    //   }
    // }

    function actualizar($pk_publicacion,$s_titulo,$s_articulo,$d_fecha_publicado,$i_estado,$i_notificacion,$i_ver_160,$i_ver_240,$i_ver_241,$i_ver_242,$i_ver_243,$i_ver_430,$i_ver_470){
      $params = [$pk_publicacion,$s_titulo,$s_articulo,$d_fecha_publicado,$i_estado,$i_notificacion,$i_ver_160,$i_ver_240,$i_ver_241,$i_ver_242,$i_ver_243,$i_ver_430,$i_ver_470];
      $this->db_old->setQuery("UPDATE spectrum_tbl_publicaciones
                               SET s_titulo = ?,
                                   s_articulo = ?,
                                   d_fecha_publicado = ?,
                                   i_estado = ?,
                                   i_notificacion = ?,
                                   i_ver_160 = ?,
                                   i_ver_240 = ?,
                                   i_ver_241 = ?,
                                   i_ver_242 = ?,
                                   i_ver_243 = ?,
                                   i_ver_430 = ?,
                                   i_ver_470 = ?
                               WHERE pk_publicacion = ?");


      $this->db_old->setParameters($params);
      $this->db_old->runQuery();
    }


    function uploadImage($fileName, $fileSize, $fileType, $path, $table){
      $spectrum_table = $table;
      $column_values = [
        "s_original_file_name"=> $fileName,
        "i_file_size"=>$fileSize,
        "s_file_type"=>$fileType,
        "s_file_path"=>$path,
      ];
      $return_id = $this->db->insert($spectrum_table, $column_values);

      if ($return_id) {
        return $return_id;
      } else {
        return $this->db->last_error;
      }
    }





    // function actualizar($s_nombre_politica,$login_usuario,$fecha_reg,$pk_politica){
    //   $params = [$s_nombre_politica,$login_usuario,$fecha_reg,$pk_politica];
    //   $this->db_old->setQuery("UPDATE spectrum_tbl_politicas
    //                       SET s_nombre_politica = ?,
    //                           s_usuario_edito = ?,
    //                           d_usuario_edito = ?
    //                       WHERE pk_politica = ?");
    //   $this->db_old->setParameters($params);
    //   $this->db_old->runQuery();
    // }






  }
?>
