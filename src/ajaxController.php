<?php
session_start();
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
  echo json_encode($db->res);
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
