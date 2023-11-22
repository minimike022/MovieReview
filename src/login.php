<?php

session_start();

if (isset($_SESSION['token'])) {
    header('location: index.php');
    exit;

}
require "config.php";

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $_SESSION['token'] = $token;
        header("location: index.php");
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id"
        content="664943467864-efulhqiu8dqt1pg6j4ft5m766rb5o49k.apps.googleusercontent.com">
    <title>Login Page</title>
    <style>
        <?php

        include "css/output.css";

        ?>
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body class="flex justify-center font-body text-white">
    <div class="w-screen h-screen relative bg-black bg-opacity-30">
        <img src="images/netflixlogo.webp" alt="" class="w-screen h-screen objct-cover absolute mix-blend-overlay">
    </div>

    <div class="w-[25em] h-[30em] bg-black absolute mt-20 rounded-md bg-opacity-80">
        <a href="index.php" class="w-full mt-4"><img src="images/x.svg" alt=""
                class="mt-4 h-[35px] w-[35px] absolute right-[3em]"></a>
        <h1 class="ml-11 text-3xl font-bold mt-8">
            Sign In
        </h1>
        <h2 id="validation" class="text-sm text-center mt-2 text-red-500">Username or Password is Incorrect</h2>
        <form action="" method="POST" id="loginUser" class="flex flex-col w-full items-center mt-4">
            <input type="text" id="uname" name="uname" placeholder="Username"
                class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5">
            <input type="password" id="pword" name="pword" placeholder="Password"
                class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-5">
            <h1 class="relative left-[3.5em] mt-2">Forgot password?</h1>
            <input type="submit" name="submit" value="submit"
                class="focus:outline-none h-[2.8em] rounded-md bg-red-600 w-[19em] mt-5">
        </form>
        <div class="flex flex-col items-center mt-4">
            <h1>or login using</h1>
            <!-- Soc Med Photos -->
            <div class="mt-4 flex justify-between w-36">
                <a href="<?= $client->createAuthUrl() ?>"><img src="images/google.png" alt=""
                        class="h-[35px] w-[35px]"></a>
                <img src="images/Facebook.png" alt="" class="h-[35px] w-[35px]" id="facebook">
            </div>
            <a href="signup.php" class="mt-8">
                <h2>Don't have an account?</h2>
            </a>
        </div>
    </div>

</body>

<script type="text/javascript">


    var validation = document.getElementById('validation');
    validation.style.display = "none"
    $(document).ready(function () {
        $("#loginUser").on("submit", function (e) {
            e.preventDefault();
            let uname = $('#uname').val();
            let pword = $('#pword').val();
            var hasEmptyFields = false;
            var formData = $(this).serialize();

            if (hasEmptyFields) {
                alert('Please fill in all fields');
            } else {
                if (uname == "admin" && pword == "admin123") {
                    location.href = "adminIndex.php"
                } else {
                    $.ajax({
                        url: "ajaxController.php",
                        method: "POST",
                        data: {
                            "loggingIn": true,
                            username: uname,
                            password: pword,
                        },
                        success: function (result) {
                            var datas = JSON.parse(result)
                            console.log(datas);
                            if (datas == 0) {
                                validation.style.display = "block";
                            } else {
                                datas.forEach(function (data) {
                                    var dataID = data['userID'];
                                    $.ajax({
                                        url: "ajaxController.php",
                                        method: "POST",
                                        data: { datas: dataID },
                                        success: function (result) {
                                            console.log(result)
                                            location.href = "index.php";
                                        }
                                    })
                                })
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            alert("Oops something went wrong!");
                        },


                    })
                }
            }
        });
    });

    $(document).ready(function() {
            $('#facebook').click(function() {
                var oauth2Endpoint = 'https://www.facebook.com/v18.0/dialog/oauth?'

                var params = {
                    'app_id': '380931224453344',
                    'response_type': 'token',
                    'redirect_uri': 'http://localhost/MovieReview/src/index.php',
                };

                // Create a form element and append it to the body.
                var form = $('<form>', {
                    'method': 'GET',
                    'action': oauth2Endpoint
                });

                // Add form parameters as hidden input values.
                for (var p in params) {
                    $('<input>', {
                        'type': 'hidden',
                        'name': p,
                        'value': params[p]
                    }).appendTo(form);
                }

                // Add form to page and submit it to open the OAuth 2.0 endpoint.
                form.appendTo('body').submit();
            });
        });
</script>

</html>