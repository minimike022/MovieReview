<?php
require "db/movieDB.php";

$db = new DB();

if(isset($_POST['isGettingGoogleUser'])){
  session_start();
  $userID = $_SESSION['userID'];
  echo $userID;
}

if(isset($_POST['loggedIn'])) {
  session_start();
  $data = $_SESSION['userID'];
  echo json_encode($data);
}

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
  if(isset($_SESSION['userID'])) {
    echo $_SESSION['userID'];
  }
  else {
    echo "0";
  }
}

if(isset($_POST['isRetreiving'])) {
  session_start();
  $userID = $_SESSION['userID'];
  echo json_encode($userID);
}



//Getting UserData
if(isset($_POST['getUserData'])) {
  session_start();
  $userID = $_POST['userID'];
  $db->select("usersInfo", "*", "userID = '$userID'");
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

if(isset($_POST['signUpRetreiveID'])) {
  $uname = $_POST['username'];
  $db->select("users", "*", "uname = '$uname'");
  echo json_encode($db->res);
}

if(isset($_POST['isGettingSent'])) {
  session_start();
  $userID = $_POST['userID'];
  $_SESSION['userID'] = $userID;
  echo json_encode($_SESSION['userID']);
}


//Add User Login Info
if(isset($_POST['addUser'])) {
  $postData = $_POST['datas'];
  $password = $postData['pword'];
  $md5Pass = md5($password);
  $dataArray = array(
    'uname'=> $postData['uname'], 'pword' => $md5Pass, 'email' => $postData['email'],
  );
  $db->insert('users', $dataArray);
  echo json_encode("succeed");
}


//Add User Info
if (isset($_POST['addUserInfo'])) {
  $postData = $_POST['dataArray'];
  $userID = $_POST['userID'];
  if (empty($postData['lname']) || empty($postData['fname']) || empty($postData['mname']) || empty($postData['bday']) || empty($postData['address']) || empty($postData['cnum'])) {
    echo json_encode(array('error' => 'Please fill in all fields.'));
  } else {
    $data = array(
      'userID' => $userID,
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

if(isset($_POST['fetchMovies'])){
  $db->select("movies", "*");
  echo json_encode($db->res);
}

if(isset($_POST['displayMovies'])) {
    $db->select("movies");
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
  $db->select("movies", "*", "movieID = $movieID");
  echo json_encode($db->res);
}

if(isset($_POST['isDeleted'])) {
  $movieID = $_POST['movieID'];
  $db->Delete($movieID);
  echo json_encode($db->res);
}

//Admin
if(isset($_POST['fetchMovieData'])) {
  $movieID = $_POST['dataId'];
  $db->select("movies", "*","movieID = $movieID");
  echo json_encode($db->res);
}

if(isset($_POST['isGettingUpdate'])) {
  $dataID = $_POST['dataId'];
  $db->select("movies", "*", "movieID = $dataID");
  echo json_encode($db->res);
}

if(isset($_POST['isUpdated'])) {
  $images = $_POST['imagePhoto'];
  $fileName = basename($images);
  $location = "images/".$fileName;
  $movieID = $_POST['movieID'];
  $db->Update("movies", $movieID, $_POST['movTitle'], $_POST['movDesc'], $_POST['movDate'], $_POST['movGenre'], $location);
  echo json_encode($db->res);
}

if(isset($_POST['live_Search'])) {
  $liveSearch = $_POST['live_Search'];
  $db->select("movies", "*", "movieTitle LIKE '%".$liveSearch."%'");
  echo json_encode($db->res);
}

//Adding Movie Into Admin Websit
if(isset($_POST['AddMovie'])) {
  $postData = $_POST['movieData'];
  $images = $_POST['imagePhoto'];
  $fileName = basename($images);
  $location = "images/".$fileName;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
  $validExtension = array('jpg', 'jpeg', 'png');
  $dataArray = array(
    'movieTitle'=> $postData['movTitle'], 'movieDescription' => $postData['movDesc'], 'movieGenre' => $postData['movGenre'], 'movieDate' => $postData['movRelease'], 'moviePhoto' => $location
  );
  $result = $db->insert('movies', $dataArray);
  echo json_encode($result);

}


