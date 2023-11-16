<?php
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

class DB
{
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

  public function select($table, $where = null)
  {
    $sql = "SELECT * FROM $table" . ($where == null ? '' : "WHERE $where");
    $result = $this->mysql->query($sql);
    $this->fetchSelect($result);
  }

  private function fetchSelect($result)
  {
    $records = array();
    while ($row = $result->fetch_assoc()) {
      array_push($records, $row);
    }
    $this->res = $records;

  }

  public function insert($table, $data)
  {
    $table_columns = implode(',', array_keys($data));
    $table_values = implode("','", $data);
    $sql = "INSERT INTO $table($table_columns) VALUES ('$table_values')";
    $this->res = $this->mysql->query($sql);
  }

  public function checkUsername($uname)
  {
    $sql = "SELECT * FROM users WHERE uname = '" . $uname . "'";
    $this->res = $this->mysql->query($sql);
    echo mysqli_num_rows($this->res);
  }

  //retrieve Username
  
  public function login($uname, $pword) {
    
    $sql1 = "SELECT uname, pword FROM users WHERE uname = '$uname'";
    $result = $this->mysql->query($sql1);
    while ($row = $result->fetch_assoc()) {
      $encPass = $row["pword"];
      $password = $pword;
      $md5Pword = md5($password);
      if($md5Pword == $encPass) {
        $sql2 = "SELECT * FROM users WHERE uname = '$uname'";
        $result2 = $this->mysql->query($sql2);
        $this->fetchSelect($result2);
      }
    }
    
  }

  public function fetchMovies($category,$genre) {
    $sql = "SELECT * FROM movies WHERE ($category) = '$genre'";
    $result = $this->mysql->query($sql);
    if($result->num_rows > 0) {
      $this->fetchSelect($result);
    }
  }


  public function __destruct()
  {
    if ($this->mysql) {
      $this->mysql->close();
    }
  }
}
