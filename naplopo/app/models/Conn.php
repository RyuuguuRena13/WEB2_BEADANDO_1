<?php

    class Conn {
        private $host = "localhost";
        private $dbName = "naplopo";
        private $charset = "utf8";
        private $userName = "root";
        private $pass = "";
        protected $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}",
                $this->userName, $this->pass);

                /**
                 * a PDO alapértelmezetten nem dob 
                 * hibát, ha valamilyen SQL szintaktikai
                 * vagy egyéb probléma van
                 */
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $ex) {
                die($ex->getMessage());
            }
        }
    }

?>