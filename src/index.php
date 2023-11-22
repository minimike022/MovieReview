<?php
session_start();

require "config.php";
if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
    if ($client->isAccessTokenExpired()) {
        unset($_SESSION['token']);
        header("location: login.php");
        exit;
    }

    $user = (new Google_Service_Oauth2($client))->userinfo->get();

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Review | Discover Moviews</title>
    <style>
        <?php

        include "css/output.css";

        ?>
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
</head>

<body class="font-body bg-black">
    <!-- Navigation Header -->
    <div class="w-full h-20 bg-black sticky items-center justify-between flex text-white p-10">
        <!--Title Header -->
        <div class="flex items-center justify-center">
            <a href="landing.php"><img src="images/logo1.png" alt="" class="h-[60px] w-[80px]"></a>
            <!-- Navigation -->
            <div class="flex items-center justify-between h-full font-body w-[20em] ml-8 font-bold text-base">
                <a href="#" class="hover:text-red-500 hover:text-xl">Home</a>
                <a href="" class="hover:text-red-500 hover:text-xl">Movies</a>
                <a href="" class="hover:text-red-500 hover:text-xl">New & Popular</a>
            </div>
            <form method="POST" action="" class="ml-4 flex items-center border-none">
                <input type="text" placeholder="Search:" id="live_Search" name="search" id="search"
                    class="rounded-lg h-10 w-[20em] border-2 border-white bg-black focus:outline-none focus:border-red-500 pl-6">
            </form>
        </div>


        <!-- Users Buttons -->
        <div id="notloggedIn">
            <div class="flex items-center justify-between w-[13em]">
                <a href="signup.php"
                    class="h-[2.5em] w-24 flex items-center justify-center border-2 border-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-white font-bold">Register</h1>
                </a>
                <a href="login.php"
                    class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-black font-bold">Sign In</h1>
                </a>
            </div>
        </div>
        <div id="loggedIn">
            <div class="flex items-center justify-between w-[13em]">
                <a href="userProfile.php"
                    class="h-[2.5em] w-24 flex items-center justify-center rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-white font-bold">Profile</h1>
                </a>
                <a href="logout.php"
                    class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600 text-black hover:text-white">
                    <h1 class="font-bold">Sign Out</h1>
                </a>
            </div>
        </div>
    </div>
    <h1 class="text-white">
        <?php


        ?>
    </h1>

    <!-- Featured -->
    <div class="w-full h-[32em] bg-landingImage bg-cover font-body text-white overflow-hidden">
        <!-- Featured Description -->
        <div class="relative translate-x-12 translate-y-64">
            <!-- Movie Title -->
            <h1 class="text-3xl font-extrabold">John Wick(2014)</h1>
            <!-- Movie Description -->
            <p class="w-[35em] mt-2 text-lg"> John wick is a retired assassin who returns back to his old ways after a
                group of Russian gangsters steal his car
                kill a puppy which was gifted to him by his late wife Helen.
            </p>
            <!-- Stars and Ratings -->
            <div class="mt-2">
                <!-- Stars -->
                <div class="flex items-center justify-between w-[13em]">
                    <img src="images/star.png" alt="" class="h-[25px] w-[25px]">
                    <img src="images/star.png" alt="" class="h-[25px] w-[25px]">
                    <img src="images/star.png" alt="" class="h-[25px] w-[25px]">
                    <img src="images/star.png" alt="" class="h-[25px] w-[25px]">
                    <img src="images/star.png" alt="" class="h-[25px] w-[25px]">
                    <h1>4.5/5</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Body -->
    <div class="my-10 flex items-center justify-center">
        <!-- Movie Tables -->
        <table class="flex-wrap flex justify-center">
            <tr id="movies" class="flex w-[70em] flex-wrap">

            </tr>
        </table>
    </div>
</body>

<script script="text/javascript">
    var loggedIn = document.getElementById("loggedIn");
    var notLoggedIn = document.getElementById("notloggedIn");

    $.ajax({
        url: "ajaxController.php",
        method: "POST",
        data: {
            "isGettingGoogleUser": true,
        },
        success: function (result) {
            console.log(result)
        }
    })


    const loadMovies = () => {
        $.ajax({
            url: "ajaxController.php",
            method: "POST",
            data: { "fetchMovies": true },
            success: function (result) {
                var datas = JSON.parse(result);
                var movieTr = ` `
                console.log(datas)
                datas.forEach(function (data) {
                    movieTr += `<td class='h-[26em] w-[20em] py-4 bg-white rounded-lg flex items-center flex-col ml-10 mt-10'><button id="button" data-ids=` + data['movieID'] + `><img src="` + data['moviePhoto'] + `" data-Ids=` + data['movieID'] + ` class='h-[18em] w-[18em] rounded-lg'></button>`
                    movieTr += `<h1 class="mt-4 font-bold text-2xl">` + data['movieTitle'] + `</h1>`
                    movieTr += `<h1 class="mt-4 text-xl">` + data['movieGenre'] + ` | ` + data['movieDate'] + `</h1>`
                })
                $('#movies').html(movieTr);
            }

        })
    }
    loadMovies();
    $(document).ready(function () {
        loadMovies();
        $(document).on("click", "#button", function (e) {
            var dataID = $(this).attr('data-Ids');
            console.log(dataID)
            $.ajax({
                url: "ajaxController.php",
                method: "POST",
                data: {
                    "deliveringData": true,
                    dataId: dataID
                },
                success: function (result) {
                    console.log(result)
                    location.href = "landingMovie.php"
                }
            })
        })

        $.ajax({
            url: "ajaxController.php",
            method: "POST",
            data: {
                "isLoggedin": true
            },
            success: function (result) {
                var userID = result
                $.ajax({
                    url: "ajaxController.php",
                    method: "POST",
                    data: {
                        "isDeliveringUserID": true,
                        userID: userID,
                    },
                    success: function (result) {
                        console.log(result)
                    }
                })

                if (result == 0) {
                    loggedIn.style.display = "none";
                    notLoggedIn.style.display = "block"
                }
                else {
                    loggedIn.style.display = "block";
                    notLoggedIn.style.display = "none"
                }
            }
        })
    })

    $('#live_Search').keyup(function (e) {
        e.preventDefault()
        var liveSearch = $(this).val();
        if (liveSearch != '') {
            $.ajax({
                url: "ajaxController.php",
                method: "POST",
                data: {
                    live_Search: liveSearch
                },
                success: function (result) {
                    var datas = JSON.parse(result);
                    var movieTr = ` `
                    console.log(datas)
                    datas.forEach(function (data) {
                        movieTr += `<td class='h-[28em] w-[20em] py-4 bg-white rounded-lg flex items-center flex-col ml-10 mt-10'><button id="button" data-ids=` + data['movieID'] + `><img src="` + data['moviePhoto'] + `" data-Ids=` + data['movieID'] + ` class='h-[18em] w-[18em] rounded-lg'></button>`
                        movieTr += `<h1 class="mt-4 font-bold text-2xl">` + data['movieTitle'] + `</h1>`
                        movieTr += `<h1 class="mt-4 text-base">` + data['movieGenre'] + ` | ` + data['movieDate'] + `</h1>`
                    })
                    $('#movies').html(movieTr);
                }
            })
        } else {
            loadMovies()
        }
    })


</script>

</html>