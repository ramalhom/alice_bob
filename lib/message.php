<?php

class Message
{
    private $pdo = null;
    private $stmt = null;

    function __construct()
    {
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

    function __destruct()
    {
        // __destruct() : close connection when done

        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    function get($session_id, $step, $user)
    {
        // get() : get message entry
        // PARAM $id : address book ID
        //
        $sql = "SELECT text,private_key,public_key,crypted_with from t_message INNER JOIN t_game ON t_game.pk_game = t_message.fk_game INNER JOIN t_user ON t_user.pk_user = t_message.fk_user WHERE session = ? AND step = ? AND t_user.name like ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array($session_id, $step, $user));
        $entry = $this->stmt->fetchAll();
        return count($entry) == 0 ? false : $entry[0];
    }

    function crypt($input) {
        $search = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $replace = array('*', '/', '*', 'à', '=', ')', '(', ';', '#', '@', '°', '§', '¦', '%', '¢', '$', '!', '-', '[', ']', ',', '@', '$', '£', 'ü', '¬', '?', 'ö', 'à', 'ç', '#', '_', '[', '&', ']');
        return str_replace($search,$replace, $input);
    }

    function count($session_id, $step, $user)
    {
        $sql = "SELECT text from t_message INNER JOIN t_game ON t_game.pk_game = t_message.fk_game INNER JOIN t_user ON t_user.pk_user = t_message.fk_user WHERE session = ? AND step = ? AND t_user.name like ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array($session_id, $step, $user));
        $entry = $this->stmt->fetchAll();
        return count($entry);
    }

    function getPkGame($session_id) {
        $sql = "SELECT pk_game FROM t_game WHERE session = ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute([$session_id]);
        $entry = $this->stmt->fetchAll();
        return count($entry) == 0 ? false : $entry[0];
    }

    function getPkUser($user){
        $sql = "SELECT pk_user FROM t_user WHERE name like ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute([$user]);
        $entry = $this->stmt->fetchAll();
        return count($entry) == 0 ? false : $entry[0];
    }

    function save($message, $private_key, $public_key, $crypted_with, $session_id, $step, $user)
    {
        // save() : update or add a new entry
        // PARAM $session_id - street address
        //       $country - country
        //       $state - state (optional)
        //       $city - city (optional)
        //       $zip - zip code
        if ($private_key == "") $private_key = 0;
        if ($public_key == "") $public_key = 0;
        $pk_user = $this->getPkUser($user)[0];
        if ($this->count($session_id,$step,$user) == 0){
            $sql = "INSERT INTO t_game (session) VALUES (?)";
            try {
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute(array($session_id));
            } catch (Exception $ex) {
                return false;
            }
            $pk_game = $this->getPkGame($session_id)[0];
            $sql = "INSERT INTO t_message (step,text,private_key,public_key,crypted_with, fk_user,fk_game) VALUES (?,?,?,?,?,?,?)";
            try {
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute(array($step,$message,$private_key,$public_key,$crypted_with,$pk_user,$pk_game));
            } catch (Exception $ex) {
                return false;
            }
        }
        else {
            $pk_game = $this->getPkGame($session_id)[0];
            $sql = "UPDATE t_message SET text = ?, private_key = ?, public_key = ?, crypted_with = ? WHERE step = ? AND fk_user = ? AND fk_game = ?";
            try {
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute(array($message, $private_key, $public_key, $crypted_with, $step, $pk_user, $pk_game));
            } catch (Exception $ex) {
                return false;
            }
        }
        return true;
    }
}

?>