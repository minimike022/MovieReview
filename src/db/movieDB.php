<?php
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

class DB {
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "moviereview";

  public $mysql;
  public $res;

  public function __construct()
  {
    try {
      if (!$this->mysql = new mysqli($this->servername, $this->username, $this->password, $this->dbname)) {
        throw new Exception($this->mysql->connect_error);
      }
    } catch (Exception $e) {
      die("ERROR: Database connection failed! <br>" . $e);
    }
  }

  public function select($table, $row = "*", $where = null) {
    $sql = "SELECT $row FROM $table" . ($where == null ? '' : "WHERE $where");
    $result = $this->mysql->query($sql);
    $this->fetchSelect($result);
  }

  private function fetchSelect($result) {
    $records = array();
    while($row = $result->fetch_assoc()) {
      array_push($records, $row);
    }
    $this->res = $records;
  }

  public function insert($table, $data) {
    $table_columns = implode(',', array_keys($data));
    $table_values = implode("','", $data);
    $sql = "INSERT INTO $table($table_columns) VALUES ('$table_values')";
    $this->res = $this->mysql->query($sql);
  }

  public function checkUsername($uname) {
    $sql = "SELECT * FROM users WHERE username = '". $uname ."'";
    $this->res = $this->mysql->query($sql);
    echo mysqli_num_rows($this->res);  
  }


  public function retrieveID($uname, $pword) {
    $sql = "SELECT userID from users WHERE username = '".$uname."' AND password = '".$pword."'";
    $this->res = $this->mysql->query($sql);
    echo $this->res;
  }

  public function __destruct() {
    if($this->mysql) {
      $this->mysql->close();
    }
  }
}
