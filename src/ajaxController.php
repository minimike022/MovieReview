<?php
require "db/movieDB.php";

$db = new DB();

if (isset($_POST['getStudents'])) {
  $db->select('users');
  echo json_encode($db->res);
}

//Login Authentication Users
if(isset($_POST["loggingIn"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $db->login($username, $password);
  $datas = $db->res;
  echo json_encode($datas);
}

//Getting UserID
if(isset($_POST['datas'])) {
  session_start();
  $_SESSION['userID'] = $_POST['datas'];
  echo $_SESSION['userID'];
}

if(isset($_POST['isLoggedin'])) {
  if(isset($_SESSION['userID'])) {
    echo json_encode(1);
    
  }else {
    echo json_encode(0);
  }

}


//Check if the username is available
if (isset($_POST['uname'])) {
  $username = $_POST['uname'];
  $result = $db->checkUsername($username);
  if ($result > 0) {
    echo json_encode($result);
    exit();
  }
}

if(isset($_POST['AddMovie'])) {
  $postData = $_POST['movieData'];
  $dataArray = array(
    'movieTitle'=> $postData['movTitle'], 'movieDescription' => $postData['movDesc'], 'movieGenre' => $postData['movGenre'], 'movieDate' => $postData['movRelease']
  );
  $result = $db->insert('movies', $dataArray);
  echo json_encode($result);

}

if(isset($_POST['addUser'])) {
  $postData = $_POST['datas'];
  $password = $postData['pword'];
  $md5Pass = md5($password);
  $dataArray = array(
    'uname'=> $postData['uname'], 'pword' => $md5Pass, 'email' => $postData['email'],
  );
  $result = $db->insert('users', $dataArray);
  echo json_encode($result);

}



if (isset($_POST['addUserInfo'])) {
  $postData = $_POST['datas'];

  if (empty($postData['lname']) || empty($postData['fname']) || empty($postData['mname']) || empty($postData['bday']) || empty($postData['address']) || empty($postData['cnum'])) {
    echo json_encode(array('error' => 'Please fill in all fields.'));

  } else {
    $data = array(
      'firstName' => $postData['fname'],
      'lastName' => $postData['lname'],
      'middleName' => $postData['mname'],
      'birthday' => $postData['bday'],
      'gender' => $postData['gender'],
      'contactNumber' => $postData['cnum'],
      'address' => $postData['address'],
    );

    $db->insert('usersinfo', $data);
    echo json_encode($db->res);
  }
}

if(isset($_POST['displayMovies'])) {
    $db->fetchMovies();
    echo json_encode($db->res);
}
