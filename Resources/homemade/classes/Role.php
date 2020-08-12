<?php

/**
 *  Class Role handles the roles-permissions relationships.
 */
class Role
{

 protected $permissions = [];
 public $error;

  function __construct(){}

  function addRole(string $roleName, array $permissions){
    $db = new Queryi();


    try {
      $db->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITED;");
      $db->query("LOCK TABLES spectrum_tbl_roles, spectrum_tbl_roles_permissions WRITE;");
      $db->begin_transaction();
      $role_id = $db->insert("spectrum_tbl_roles", ["role_name"=>$roleName]);

      if (!$role_id) {
        throw new \Exception("Error insertando el rol.", 1);
      }


      foreach ($permissions as $permission => $token) {
        error_log("El id del rol es $role_id");
        error_log("El permiso es $permission");

        $token_value = + $token;
        $insert = $db->insert("spectrum_tbl_roles_permission", ["fkid_role"=>$role_id, "fkid_permission"=>$permission]);
        error_log($insert);
        if (!$insert) {
          throw new \Exception("Error insertando el permiso: $db->error", 1);
        }
      }

      $db->commit();
      $return_value = true;
    } catch (\Exception $e) {

      error_log($e->getMessage());
      $this->error = $db->last_error;
      $db->rollback();
      $return_value = false;

    } finally {

      $db->query("UNLOCK TABLES");
      return true;
    }


  }

  function editRole($roleId, string $roleName, array $permissions){
    $db = new Queryi();

    if ($roleName == "" ||$roleName == NULL) {
      $this->error = "El nombre del rol no puede estar vacío.";
      return false;
    }

    if (count($permissions) == 0 ||!is_array($permissions)) {
      $this->error = "No se pasaron los permisos para este rol";
      return false;
    }

    $nameChanged = $db->update("spectrum_tbl_roles", ["pkid_role", $roleId], ["role_name"=>$roleName]);
    if (!$nameChanged) {
      $this->error = "No se pudo cambiar el nombre del rol.";
      return false;
    }

    // $insert_recor = "UPDATE spectrum_tbl_roles_permission SET active = ? WHERE fkid_role = ? fkid_permission = ?";
    // $stmt = $db->prepare($query);

    foreach ($permissions as $permission => $token) {
      $token_value = + $token;
      // error_log("DELETE FROM spectrum_tbl_roles_permission WHERE fkid_role = $roleId AND fkid_permission = $permission");
      if ($token_value == 1) {
        $db->insert("spectrum_tbl_roles_permission", ["fkid_role"=>$roleId, "fkid_permission"=>$permission]);
      } else {
        $db->query("DELETE FROM spectrum_tbl_roles_permission WHERE fkid_role = $roleId AND fkid_permission = '$permission'");
      }
    }

    return true;
  }

  function validateRoleName(string $roleName, $except_id = NULL){
    if ($roleName == NULL) {
      $this->error = "$roleName no es un nombre válido";
      return false;
    }

    $db = new Queryi();

    if ($except_id === NULL) {
      $query = "SELECT role_name FROM spectrum_tbl_roles WHERE role_name = ?";
      $stmt = $db->prepare($query);
      $stmt->bind_param("s", $roleName);
    } else {
      $query = "SELECT role_name FROM spectrum_tbl_roles WHERE role_name = ? AND pkid_role <> ?";
      $stmt = $db->prepare($query);
      $stmt->bind_param("ss", $roleName, $except_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $this->error = "El nombre del rol ya existe.";
      return false;
    } else {
      return true;
    }

  }

  function getFullRole($role_id){
    $db = new Queryi();
    $return_array = [];

    $query = "SELECT r.pkid_role pkid_role , r.role_name role_name , GROUP_CONCAT(rp.fkid_permission) permissions FROM spectrum_tbl_roles r LEFT JOIN spectrum_tbl_roles_permission rp ON r.pkid_role = rp.fkid_role WHERE r.pkid_role = ? GROUP BY pkid_role";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $return_array['role_name'] = $row['role_name'];
        $return_array['permissions'] = $row['permissions'];
      }
    }

    return $return_array;
  }

  function listRoles(){
    $db = new Queryi();
    $return_array = [];

    $query = "SELECT r.pkid_role pkid_role , r.role_name role_name , GROUP_CONCAT(rp.fkid_permission, '|', rp.active) permissions FROM spectrum_tbl_roles r LEFT JOIN spectrum_tbl_roles_permission rp ON r.pkid_role = rp.fkid_role GROUP BY pkid_role";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $return_array[$row['pkid_role']]['role_name'] = $row['role_name'];
        $return_array[$row['pkid_role']]['permissions'] = $row['permissions'];
      }
    }

    return $return_array;
  }

  function listRolesbyUser($user_id = NULL){
    $db = new Queryi();
    $return_array = [];

    $query = "SELECT r.pkid_role pkid_role , r.role_name role_name FROM spectrum_tbl_roles r LEFT JOIN spectrum_tbl_roles_user ru ON r.pkid_role = ru.fkid_role";

    $stmt = $db->prepare($query);
    if (!$stmt) {
      error_log($db->error);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $return_array[$row['pkid_role']]['role_name'] = $row['role_name'];
        $return_array[$row['pkid_role']]['active'] = false;
      }
    }

    $query = "SELECT fkid_role FROM spectrum_tbl_roles_user WHERE fkid_user = ?";

    $stmt = $db->prepare($query);
    if (!$stmt) {
      error_log($db->error);
    }

    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $return_array[$row['fkid_role']]['active'] = "active";
      }
    }



    return $return_array;
  }

  function assignRole($user_id, $role_id, $action = false){
    $db = new Queryi();
    if ($action == "true") {
      $insert = $db->insert("spectrum_tbl_roles_user", ["fkid_user"=>$user_id, "fkid_role"=>$role_id]);
      if ($insert) {
        error_log($db->error);
        return true;
      } else {
        error_log($db->error);
        return false;
      }
    } else {
      $stmt = $db->prepare("DELETE FROM spectrum_tbl_roles_user WHERE fkid_role = ? AND fkid_user = ?");
      if (!$stmt) {
        error_log($db->error);
        return false;
      }

      if (!$stmt->bind_param("ss", $role_id, $user_id)) {
        error_log($stmt->error);
        return false;
      }

      if (!$stmt->execute()) {
        error_log($stmt->error);
        return false;
      }

      return true;
    }
  }

  function hasPermission($user_id = 0, $permission = 0){
    $db = new Queryi();
    $query = "SELECT rp.fkid_permission FROM spectrum_tbl_roles_user ru LEFT JOIN spectrum_tbl_roles_permission rp ON rp.fkid_role = ru.fkid_role WHERE ru.fkid_user = ? AND rp.fkid_permission = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $user_id, $permission);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }
}


 ?>
