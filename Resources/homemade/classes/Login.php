<?php
/**
 * Handler for the Login of the user.
 */
class Login
{
  public $error = "";
  public $error_code = "";
  private $loginToken = NULL;

  function __construct(){}
  function encrypt($password = NULL){
    $cipher = "AES-256-CBC";
    $sha = 'sha256';
    $hashing = 'ewgdhfjjluo3pip4l';
    $hashing_iv = 'sdfkljsadf567890saf';

    $key = hash($sha, $hashing);
    $iv = substr(hash($sha, $hashing_iv), 0, 16);
    // $key = hash('sha256', "ewgdhfjjluo3pip4l");
    // $iv = substr(hash('sha256', "sdfkljsadf567890saf"), 0, 16);
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
  function setToken($token){
    $this->loginToken = $token;
  }
  function login($user = NULL, $password = NULL){
    $db = new Queryi();
    $query = "SELECT * FROM spectrum_tbl_usuarios WHERE s_usuario = ? AND i_activo = 1";

    if ($this->loginToken !== NULL) {
      $token = $this->decrypt($this->loginToken);
      $token = json_decode($token);
      $u = $token[0];
      $p = $token[1];
    } else {
      $u = $user;
      $p = $password;
    }

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $this->error = $db->last_error;
      $this->error_code = 500;
      return false;
    }

    $stmt->bind_param('s',$u);
    if (!($stmt)) {
      $this->error = $db->last_error;
      $this->error_code = 500;
      return false;
    }

    if (!($stmt->execute())) {
      $this->error = $db->last_error;
      $this->error_code = 500;
      return false;
    }

    $rslt = $stmt->get_result();
    $row = $rslt->fetch_assoc();

    $pass = $row['s_pwd'];

    if(password_verify($p,$pass)){
      $token_return = array($row['s_usuario'], $p);
      $token_return = json_encode($token_return);
      $token_return = encrypt($token_return);

      $_SESSION['user'] = $row;
      setcookie("loginToken",$token_return, time()+43200, "/");
      return true;
    } else {
      $this->error_code = 200;
      $this->error = "Contraseña incorrecta";
      return false;
    }
  }

}


?>
