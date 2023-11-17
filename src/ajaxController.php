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

//Getting UserID
if(isset($_POST['getUserId'])) {
  session_start();
  echo $_SESSION['userID'];
}

//Getting UserData
if(isset($_POST['getUserData'])) {
  session_start();
  $userID = $_SESSION['userID'];
  $db->fetchData('users', 'usersInfo', 'users.userID', 'usersInfo.userID');
  echo json_encode($db->res);
}



//Logged In
if(isset($_POST['isLoggedin'])) {
  session_start();
  if($_SESSION != null) {
    echo $_SESSION['userID'];
  }
  else {
    echo "0";
  }

}

//Retrieve User ID
if(isset($_POST['getUserID'])) {
  $dataUname = $_POST['uname'];
  $db->fetchUserID($dataUname);
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

//Adding Movie Into Admin Websit
if(isset($_POST['AddMovie'])) {
  $postData = $_POST['movieData'];
  $dataArray = array(
    'movieTitle'=> $postData['movTitle'], 'movieDescription' => $postData['movDesc'], 'movieGenre' => $postData['movGenre'], 'movieDate' => $postData['movRelease']
  );
  $result = $db->insert('movies', $dataArray);
  echo json_encode($result);

}


//Add User Login Info
if(isset($_POST['addUser'])) {
  $postData = $_POST['datas'];
  $password = $postData['pword'];
  $md5Pass = md5($password);
  $dataArray = array(
    'uname'=> $postData['uname'], 'pword' => $md5Pass, 'email' => $postData['email'],
  );
  $result = $db->insert('users', $dataArray);
  $_SESSION['uname'] = $postData['uname'];
  echo json_encode($_SESSION['uname']);
}


//Add User Info
if (isset($_POST['addUserInfo'])) {
  $userName = $_SESSION['uname'];
  $db->fetchUserID($userName);
  echo json_encode($db->res);
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
  }
}

//Display Movies
if(isset($_POST['displayMovies'])) {
    $db->fetchMovies("movieGenre","Action");
    echo json_encode($db->res);
}

if(isset($_POST['deliveringData'])) {
  session_start();
  $_SESSION['movieId'] = $_POST['dataId'];
  echo $_SESSION['movieId'];
}

if(isset($_POST['getMovieID'])) {
  session_start();
  $movieID = $_SESSION['movieId'];
  echo $movieID;
}

if(isset($_POST['getMovieData'])) {
  $movieID = $_POST['movieId'];
  $db->fetchMovies('movieID',$movieID);
  echo json_encode($db->res);
}

