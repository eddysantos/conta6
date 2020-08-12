<?php


  class Usuario{

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


    function nuevoUsuario($usuario,$pwd_cifrada,$id_file,$sexo,$nombres,$apellidoP,
      $apellidoM,$id_aduana,$activo,$fecha_ingreso,$telefono,
      $movil,$email_laboral,$email_personal,$calle,$colonia,$ciudad,
      $entidad,$cp,$afiliacion_imss,$sdi_imss,$sdi_infonavit,$lugar_nacimiento,
      $fecha_nacimiento,$nivel_estudios,$profesion,$RFC,$CURP,$fecha_salario,
      $metodo_pago,$tipo_salario,$salario_diario,$cambio_sdi,$banco_nomina,$cta_nomina,$control_nomina,
      $comentarios,$login_usuario,$fecha_reg,$puestos){

        $column_values = [
          "s_usuario"=> $usuario,
          "s_pwd"=> $pwd_cifrada,
          "fkid_file"=> $id_file,
          "s_sexo"=> $sexo,
          "s_nombres"=> $nombres,
          "s_apellidoP"=> $apellidoP,
          "s_apellidoM"=> $apellidoM,
          "fk_id_aduana"=> $id_aduana,
          "i_activo"=> $activo,
          "d_fecha_ingreso"=> $fecha_ingreso,
          "s_telefono"=> $telefono,
          "s_movil"=> $movil,
          "s_email_laboral"=> $email_laboral,
          "s_email_personal"=> $email_personal,
          "s_calle"=> $calle,
          "s_colonia"=> $colonia,
          "s_ciudad"=> $ciudad,
          "s_entidad"=> $entidad,
          "i_cp"=> $cp,
          "s_afiliacion_imss"=> $afiliacion_imss,
          "s_sdi_imss"=> $sdi_imss,
          "s_sdi_infonavit"=> $sdi_infonavit,
          "s_lugar_nacimiento"=> $lugar_nacimiento,
          "d_fecha_nacimiento"=> $fecha_nacimiento,
          "s_nivel_estudios"=> $nivel_estudios,
          "s_profesion"=> $profesion,
          "s_RFC"=> $RFC,
          "s_CURP"=> $CURP,
          "d_fecha_salario"=>$fecha_salario,
          "s_metodo_pago"=>$metodo_pago,
          "s_tipo_salario"=>$tipo_salario,
          "s_salario_diario"=>$salario_diario,
          "s_cambio_sdi"=>$cambio_sdi,
          "s_banco_nomina"=>$banco_nomina,
          "s_control_nomina"=>$control_nomina,
          "s_cta_nomina"=>$cta_nomina,
          "s_comentarios"=>$comentarios,
          "s_user_agrego"=> $login_usuario,
          "d_user_agrego"=> $fecha_reg,
          "i_notificacion_mail"=> 1,
        ];


      $return_id = $this->db->insert("spectrum_tbl_usuarios", $column_values);

      foreach ($puestos as $puesto) {
        $validate = $this->db->insert("spectrum_tbl_usuarios_puesto", ["fk_usuario"=>$return_id, "fk_puesto"=>$puesto]);
        if (!$validate) {
          console_log($this->db->last_error);
          return $this->db->last_error;
        }
      }

      return $return_id;
    }




    function lista_politicas_asignadas($fk_usuario){
      $params = [$fk_usuario];
      $this->db_old->setQuery("SELECT  pa.pk_politicasAsignadas,
                                   pa.fk_politica,
                                   pa.fk_usuario,
                                   pa.i_ens_enviado,
                                   pa.i_ens_autorizado,
                                   p.s_nombre_politica
                           FROM spectrum_tbl_politicas_asignadas pa
                           LEFT JOIN spectrum_tbl_politicas p ON p.pk_politica = pa.fk_politica
                           WHERE pa.fk_usuario = ?");
      $this->db_old->setParameters($params);
      $this->db_old->runQuery();
      $polAsig_dataset['polAsig_data'] = $this->db_old->returnResult();
      return $polAsig_dataset;
    }


    function agregarPuestos($pk_usuario,$puestos){

      foreach ($puestos as $puesto) {
        $validate = $this->db->insert("spectrum_tbl_usuarios_puesto", ["fk_usuario"=>$pk_usuario, "fk_puesto"=>$puesto]);
        if (!$validate) {
          console_log($this->db->last_error);
          return $this->db->last_error;
        }
      }
    }


  } // fin de la clase usuario



?>
