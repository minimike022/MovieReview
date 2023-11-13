<?php

    class DB {
        private $servername = "localhost";
        private $hostname = "root";
        private $password = "";
        private $database = "";

        public $res;

        public $mysql;

        public function __construct() {
            try {
                if(!$this->mysql = new mysqli($this->servername, $this->hostname,$this->password,$this->database)) {
                    throw new Exception($this->mysql->connect_error);
                }
            }catch(Exception $e) {
                die("Error: Database connection failed!". $e);
            }
        }


        public function create() {

        }

        public function update() {

        }

        public function delete() {

        }

        public function read() {
            
        }
    }
?>