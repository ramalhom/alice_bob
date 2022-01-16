<?php

class Config
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

    function del()
    {

        $return = true;
        $sql = "DELETE FROM `t_message`";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute();
        } catch (Exception $ex) {
            $return = false;
        }

        $sql = "DELETE FROM `t_form`";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute();
        } catch (Exception $ex) {
            $return = false;
        }

        $sql = "DELETE FROM `t_game`";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute();
        } catch (Exception $ex) {
            $return = false;
        }

        return $return;

    }

    function create($session_id, $form_url)
    {
        $return = true;
        $sql = "INSERT INTO t_game (session) VALUES (?)";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute([$session_id]);
        } catch (Exception $ex) {
            echo $ex;
            $return = false;
        }

        $sql = "INSERT INTO t_form (form_url, fk_session) VALUES (?,?)";
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute([$form_url,$session_id]);
        } catch (Exception $ex) {
            echo $ex;
            $return = false;
        }
        return $return;

    }

    function get($session_id)
    {
        // get() : get message entry
        // PARAM $id : address book ID
        //
        $sql = "SELECT form_url from t_form WHERE fk_session = ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array($session_id));
        $entry = $this->stmt->fetchAll();
        return count($entry) == 0 ? false : $entry[0];
    }

    function displaybd()
    {
        // get() : get message entry
        // PARAM $id : address book ID
        //
        $sql = "SELECT session, form_url FROM t_game LEFT JOIN t_form ON t_game.session = t_form.fk_session";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        $entry = $this->stmt->fetchAll();
        return $entry;
    }
}

?>