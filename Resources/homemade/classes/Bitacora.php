<?php

 class Bitacora{

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

   function registro_bitacora($login_usuario,$fecha_reg,$accion,$seccion){
     $column_values = [
       "usuario"=> $login_usuario,
       "fecha"=> $fecha_reg,
       "accion"=> $accion,
       "seccion"=> $seccion,
     ];

     $return_id = $this->db->insert("spectrum_tbl_bitacora", $column_values);

     if ($return_id) {
       return $return_id;
     } else {
       return $this->db->last_error;
     }
   }

 }//fin de la clase


 ?>
