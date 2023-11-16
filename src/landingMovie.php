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
                    <div class="flex items-center justify-between h-full font-body w-[28em] ml-8 font-bold text-base">
                        <a href="index.php" class="hover:text-red-500 hover:text-xl">Home</a>
                        <a href="" class="hover:text-red-500 hover:text-xl">Movies</a>
                        <a href=""class="hover:text-red-500 hover:text-xl">New & Popular</a>
                    </div>
                    <form method="POST" action="" class="ml-4 flex items-center border-none">
                        <input type="text" placeholder="Search:" name="search" id="search" class="rounded-lg h-10 w-[20em] border-2 border-white bg-black focus:outline-none focus:border-red-500 pl-6">
                    </form>
                </div>
            <!-- Sign Out Buttons -->
                <div class="flex items-center justify-between w-[10em]">
                    <div>
                        <a href="">Profile</a>
                    </div>
                    <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center border-2 border-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                        <h1>Sign Out</h1>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Movie Description -->
    <div class="m-14 flex flex-row w-[40em]">
        <!-- Movie Poster -->
        <span>
            <img src="" alt="" class="h-80 w-72" id="moviePoster">
        </span>
        <!-- Movie Description -->
        <div class="mx-12 my-4">
            <!-- Movie Title -->
            <span>
                <h1 id="movieTitle" class="text-[2.5em] text-white font-bold">Movie Title</h1>
            </span>
            <!-- Movie Genre -->
            <span class=>
                <h1 class="text-[1em] text-white font-semibold mt-2" id="movieGenre">Genre:</h1>
            </span>
            <!-- Movie Release Date -->
            <span class=>
                <h1 class="text-[1em] text-white font-semibold mt-2" id="movieRelease">Release Date:</h1>
            </span>
            <!-- Movie Description -->
            <span>
                <p class="text-white w-[40em] break-all mt-4" id="movieDesc">
                    dsadjsahfdslhdkalsdjsaklhwdiaofhsladjwladjsakldjwaidjspaodjwaldhsajkdaasl;adkwal;dsahjfkshjkes
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
    <div class="m-14 text-white">
        <h1 class="text-2xl font-bold">Write a Review</h1>
        <form action="" method="POST" class="flex flex-col">
            <input type="text" class="focus:outline-none border-white border-2 rounded-lg bg-black h-44 w-[40em] mt-4">
            <input type="submit" class="font-bold bg-[#414A4C] rounded-lg focus:outline-none h-[2.5em] w-36 mt-4">
        </form>
    </div>

    <!-- Suggested Movie Section -->
    <div class="text-white m-14">
        <h1 class="text-2xl font-bold">Similar Movies</h1>
        <table id="similarMovies" class="my-4">
            <tr class="flex flex-row">
                <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1 class="text-base font-bold mt-2">Hello World</h1></td>
                <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1 class="text-base font-bold mt-2">Hello World</h1></td>
                <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1 class="text-base font-bold mt-2">Hello World</h1></td>
            </tr>
        </table>
    </div>
</body>
<script type="text/javascript">
    

    $(document).ready(function() {
        $.ajax({
            url: "ajaxController.php",
            method: "POST",
            data: {
                "getMovieID": true
            },
            success:function(result){
                var movieID = JSON.parse(result)
                console.log(movieID);
                $.ajax({
                    url:"ajaxController.php",
                    method:"POST",
                    data: {
                        "getMovieData": true,
                        movieId:movieID,
                    },
                    success:function(result) {
                        var movieData = JSON.parse(result);
                        console.log(movieData)
                        movieData.forEach(function(data) {
                            document.getElementById("movieTitle").textContent = data['movieTitle'];
                            document.getElementById("movieGenre").textContent +=" " + data['movieGenre'];
                            document.getElementById("movieRelease").textContent +=" " + data['movieDate'];
                            document.getElementById("movieDesc").textContent = data['movieDescription'];
                        })
                        
                    }

                })
            }
        })
    })

    

</script>

</html>