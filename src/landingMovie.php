<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle"></title>
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
    <!-- Header Navigation -->
    <header>
        <nav>
            <!-- Navigation Header -->
            <div class="w-full h-20 bg-black sticky items-center justify-between flex text-white p-10">
                <!--Title Header -->
                <div class="flex items-center justify-center">
                    <a href="landing.php"><img src="images/logo1.png" alt="" class="h-[60px] w-[80px]"></a>
                    <!-- Navigation -->
                    <div class="flex items-center justify-between h-full font-body w-[20em] ml-8 font-bold text-base">
                        <a href="index.php" class="hover:text-red-500 hover:text-xl">Home</a>
                        <a href="" class="hover:text-red-500 hover:text-xl">Movies</a>
                        <a href="" class="hover:text-red-500 hover:text-xl">New & Popular</a>
                    </div>
                    <form method="POST" action="" class="ml-4 flex items-center border-none">
                        <input type="text" placeholder="Search:" name="search" id="search"
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
        </nav>
    </header>
    <!-- Movie Description -->
    <div class="m-14 flex flex-row w-[40em]">
        <!-- Movie Poster -->
        <img src="" alt="sdwa" class="h-[25em] w-[20em]" id="moviePoster">
        <!-- Movie Description -->
        <div class="mx-12 my-4">
            <!-- Movie Title -->
            <span>
                <h1 id="movieTitle" class="text-[3.5em] text-white font-bold">Movie Title</h1>
            </span>
            <!-- Movie Genre -->
            <span class=>
                <h1 class="text-[1.3em] text-white font-semibold mt-2" id="movieGenre">Genre:</h1>
            </span>
            <!-- Movie Release Date -->
            <span class=>
                <h1 class="text-[1.3em] text-white font-semibold mt-2" id="movieRelease">Release Date:</h1>
            </span>
            <!-- Movie Description -->
            <span>
                <p class="text-white w-[40em] break-all text-[1em] mt-9" id="movieDesc">
                </p>
            </span>
        </div>
    </div>
    <!-- Review Section -->
    <div class="text-white m-14">
        <!-- Title  Header-->
        <span>
            <h1 class="font-bold text-2xl">Reviews</h1>
        </span>
        <!-- Reviews -->
        <div class="bg-gray-800 h-72 w-[50em] rounded-lg mt-4">
        </div>
    </div>

    <!-- Write a review -->
    <div id="reviews" class="m-14 text-white">
        <h1 class="text-2xl font-bold">Write a Review</h1>
        <form action="" method="POST" class="flex flex-col">
            <input type="text" class="focus:outline-none border-white border-2 rounded-lg bg-black h-44 w-[40em] mt-4">
            <input type="submit" class="font-bold bg-[#414A4C] rounded-lg focus:outline-none h-[2.5em] w-36 mt-4">
        </form>
    </div>

</body>
<script type="text/javascript">

    $(document).ready(function() {
        var loggedIn = document.getElementById("loggedIn");
        var notLoggedIn = document.getElementById("notloggedIn");
        var reviews = document.getElementById("reviews")
        $.ajax({
            url: "ajaxController.php",
            method: "POST",
            data: {
                "getUserId": true
            },
            success:function(result) {
                var userID = result
                console.log(result);
                if (result != 0) {
                    loggedIn.style.display = "block";
                    notLoggedIn.style.display = "none"
                }
                else {
                    loggedIn.style.display = "none";
                    notLoggedIn.style.display = "block"
                    reviews.style.display = "none"
                }
            }
        })

        $(document).ready(function () {
            $.ajax({
                url: "ajaxController.php",
                method: "POST",
                data: {
                    "getMovieID": true
                },
                success: function (result) {

                    var movieID = JSON.parse(result)
                    console.log(movieID);
                    $.ajax({
                        url: "ajaxController.php",
                        method: "POST",
                        data: {
                            "getMovieData": true,
                            movieId: movieID,
                        },
                        success: function (result) {
                            var movieData = JSON.parse(result)
                            console.log(movieData)
                            movieData.forEach(function (data) {
                                document.getElementById("moviePoster").src = data['moviePhoto']
                                document.getElementById("movieTitle").textContent = data['movieTitle'];
                                document.getElementById("movieGenre").textContent += " " + data['movieGenre'];
                                document.getElementById("movieRelease").textContent += " " + data['movieDate'];
                                document.getElementById("movieDesc").textContent = data['movieDescription'];
                            })

                        }

                    })
                }
            })
        })
    })



</script>

</html>