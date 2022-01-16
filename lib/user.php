<?php
class User {
  private $pdo = null;
  private $stmt = null;

  function __construct () {
  // __construct() : connect to the database
  // PARAM : DB_HOST, DB_CHARSET, DB_NAME, DB_USER, DB_PASSWORD

    try {
     /* $this->pdo = new PDO(
          "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => sPDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]
      );*/
      $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD);

      return true;
    } catch (Exception $ex) {
      $this->CB->verbose(0, "DB", $ex->getMessage(), "", 1);
    }
  }

  function __destruct () {
  // __destruct() : close connection when done

    if ($this->stmt !== null) {
      $this->stmt = null;
    }
    if ($this->pdo !== null) {
      $this->pdo = null;
    }
  }

  function get ($id){
  // get() : get users entry
  // PARAM $id : address book ID

   $sql = "SELECT * FROM `t_user` WHERE `pk_user`=?";
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute([$id]);
    $entry = $this->stmt->fetchAll();
    return count($entry)==0 ? false : $entry[0] ;
  }

  function getAll (){
  // get() : get all address book entries

    $sql = "SELECT * FROM `t_user` WHERE 1";
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute();
    $entry = $this->stmt->fetchAll();
    return count($entry)==0 ? false : $entry ;
  }
}
?>