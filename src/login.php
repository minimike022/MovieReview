<?php

session_start();

include_once ("vendor/autoload.php");

  $google_client = new Google_Client();

  $google_client->setClientId('664943467864-efulhqiu8dqt1pg6j4ft5m766rb5o49k.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  $google_client->setRedirectUri('http://localhost/MovieReview/src/'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $_SESSION['access_token']=$token['access_token'];

    $google_service = new Google_Service_Oauth2($google_client);

    $data = $google_service->userinfo->get();

    $current_datetime = date('Y-m-d H:i:s');

   // print_r($data);

$_SESSION['first_name']=$data['given_name'];
$_SESSION['last_name']=$data['family_name'];
$_SESSION['email_address']=$data['email'];
$_SESSION['profile_picture']=$data['picture'];

   
   
   }
  }
  
  
  $login_button = '';
  
 // echo $_SESSION['access_token'];
  
  if(!$_SESSION['access_token'])
  {
	//  echo 'test';
	  
   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="asset/sign-in-with-google.png" /></a>';
   
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        <?php

        include "css/output.css";

        ?>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body class="flex justify-center font-body text-white">
    <div class="w-screen h-screen relative bg-black bg-opacity-30">
        <img src="images/netflixlogo.webp" alt="" class="w-screen h-screen objct-cover absolute mix-blend-overlay">
    </div>

    <div class="w-[25em] h-[30em] bg-black absolute mt-20 rounded-md bg-opacity-80">
        <a href="index.php" class="w-full mt-4"><img src="images/x.svg" alt="" class="mt-4 h-[35px] w-[35px] absolute right-[3em]"></a>
        <h1 class="ml-11 text-3xl font-bold mt-8">
            Sign In
        </h1>
        <h2 id="validation" class="text-sm text-center mt-2 text-red-500">Username or Password is Incorrect</h2>
        <form action="" method="POST" id="loginUser" class="flex flex-col w-full items-center mt-4">
            <input type="text" id="uname" name="uname" placeholder="Username" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5">
            <input type="password" id="pword" name="pword" placeholder="Password" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-5">
            <h1 class="relative left-[3.5em] mt-2">Forgot password?</h1>
            <input type="submit" name="submit" value="submit" class="focus:outline-none h-[2.8em] rounded-md bg-red-600 w-[19em] mt-5">
        </form>
        <div class="flex flex-col items-center mt-4">
            <h1>or login using</h1>
            <!-- Soc Med Photos -->
            <div class="mt-4 flex justify-between w-36">
                <button onclick="onSignIn()"><img src="images/google.png" alt="" class="h-[35px] w-[35px]"></button>
                <img src="images/Facebook.png" alt="" class="h-[35px] w-[35px]">
                <img src="images/twitter.png" alt="" class="h-[35px] w-[35px]">
            </div>
            <a href="signup.php" class="mt-8">
                <h2>Don't have an account?</h2>
            </a>
        </div>
    </div>

</body>

<script type="text/javascript">

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }

    var validation = document.getElementById('validation');
    validation.style.display = "none"
    $(document).ready(function() {
        $("#loginUser").on("submit", function(e) {
            e.preventDefault();
            let uname = $('#uname').val();
            let pword = $('#pword').val();
            var hasEmptyFields = false;
            var formData = $(this).serialize();

            if (hasEmptyFields) {
                alert('Please fill in all fields');
                } else {
                if(uname == "admin" && pword == "admin123") {
                    location.href = "adminIndex.php"
                }else {
                    $.ajax({
                    url: "ajaxController.php",
                    method: "POST",
                    data: {
                        "loggingIn": true,
                        username: uname,
                        password: pword,
                    },
                    success: function(result) {
                        var datas = JSON.parse(result)
                        console.log(datas);
                            if (datas == 0) {
                                validation.style.display = "block";
                            } else {
                                datas.forEach(function(data) {
                                var dataID = data['userID'];
                                $.ajax({
                                    url: "ajaxController.php",
                                    method: "POST",
                                    data: {datas:dataID},
                                    success:function(result) {
                                        console.log(result) 
                                        location.href = "index.php";
                                        }
                                    })
                                })
                            }
                        },
                        error:function(error) {
                        console.log(error);
                        alert("Oops something went wrong!");     
                    },
                    

                })
                }
            }
        });
    });
</script>

</html>