<?PHP
      #*********************************
			# IMPUESTOS AL COMERCIO EXTERIOR *
			#*********************************

      $query_consultaICEXT = "select n_cargo from conta_t_polizas_det where fk_referencia = ? and fk_id_cliente = ? and fk_tipo = 4 and fk_id_cuenta = '0110-00001'";

      $stmt_consultaICEXT = $db->prepare($query_consultaICEXT);
      if (!($stmt_consultaICEXT)) {
      	$system_callback['code'] = "500";
      	$system_callback['message'] = "Error during query prepare consultaICEXT [$db->errno]: $db->error";
      	exit_script($system_callback);
      }
      $stmt_consultaICEXT->bind_param('ss',$referencia,$cliente);
      if (!($stmt_consultaICEXT)) {
      	$system_callback['code'] = "500";
      	$system_callback['message'] = "Error during variables binding consultaICEXT [$stmt_consultaICEXT->errno]: $stmt_consultaICEXT->error";
      	exit_script($system_callback);
      }
      if (!($stmt_consultaICEXT->execute())) {
      	$system_callback['code'] = "500";
      	$system_callback['message'] = "Error during query execution consultaICEXT [$stmt_consultaICEXT->errno]: $stmt_consultaICEXT->error";
      	exit_script($system_callback);
      }

      $rslt_consultaICEXT = $stmt_consultaICEXT->get_result();
      $total_consultaICEXT = $rslt_consultaICEXT->num_rows;

      if( $total_consultaICEXT > 0 ){

        $row_consultaICEXT = $rslt_consultaICEXT->fetch_assoc();
        $impuesto_CEXT = trim($row_consultaICEXT['n_cargo']);
      }
?>
