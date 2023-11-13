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
</head>
<body class="font-body bg-black">
    <!-- Navigation Header -->
    <div class="w-full h-20 bg-black sticky items-center justify-between flex text-white p-10">
        <!--Title Header -->
        <div class="flex items-center justify-center">
            <a href="landing.php"><img src="images/logo1.png" alt="" class="h-[60px] w-[80px]"></a>
            <!-- Navigation -->
            <div class="flex items-center justify-between h-full font-body w-[18em] ml-8 font-bold text-base">
                <a href="#" class="hover:text-red-500 hover:text-xl">Home</a>
                <a href="" class="hover:text-red-500 hover:text-xl">Movies</a>
                <a href="" class="hover:text-red-500 hover:text-xl">New & Popular</a>
            </div>
            <form method="POST" action="" class="ml-4 flex items-center border-none">
                <input type="text" placeholder="Search:" name="search" id="search" class="rounded-lg h-10 w-[20em] border-2 border-white bg-black focus:outline-none focus:border-red-500 pl-6">
            </form>
        </div>
        

        <!-- Users Buttons -->
        <div id="notloggedIn">
            <div class="flex items-center justify-between w-[13em]">
                <a href="signup.php" class="h-[2.5em] w-24 flex items-center justify-center border-2 border-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-white font-bold">Register</h1>
                </a> 
                <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-black font-bold">Sign In</h1>
                </a>
            </div>
        </div>
        <div id="loggedIn">
            <div class="flex items-center justify-between w-[13em]">
                <a href="userProfile.php" class="h-[2.5em] w-24 flex items-center justify-center rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                    <h1 class="text-white font-bold">Profile</h1>
                </a> 
                <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600 text-black hover:text-white">
                    <h1 class="font-bold">Sign Out</h1>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured -->
    <div class="w-full h-[32em] bg-landingImage bg-cover font-body text-white overflow-hidden">
        <!-- Featured Description -->
        <div class="relative translate-x-12 translate-y-52">
            <!-- Movie Title -->
            <h1 class="text-3xl font-extrabold">John Wick(2014)</h1>
            <!-- Movie Description -->
            <p class="w-[35em] mt-2 text-lg"> John wick is a retired assassin who returns back to his old ways after a group of Russian gangsters steal his car
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
            <button onclick="moveToMovie()" class=" mt-2 border-2 rounded-lg border-white w-[6.5em] h-[2.5em] hover:bg-red-500 hover:border-none active:bg-red-600">
                <h1>See more</h1>
            </button>
        </div>
    </div>
    <!-- Body -->
    <div class="text-white my-10 ml-6">
        <!-- Top Trending Tables -->
        <div>
            <h1 class="text-2xl font-bold">Top Trending</h1>
            <table id="topTrendingTables" class="my-4">
                <tr class="flex flex-row">
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                    <h1>Hello World</h1></td>
                </tr>
            </table>
        </div>
        <!-- Horror Tables -->
        <div>
            <h1 class="text-2xl font-bold">Horror/Thriller</h1>
            <table id="horrorTables"  class="my-4">
                <tr class="flex flex-row">
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                </tr>
            </table>
    
        </div>

        <!-- Action Tables -->
        <div>
            <h1 class="text-2xl font-bold">Action</h1>
            <table id="actionTables" class="my-4 w-full">
                <tr class="flex flex-row overflow-x-scroll" id="actMovies">
                </tr>
            </table>
    
        </div>

        <!-- comedy Tables -->
        <div>
            <h1 class="text-2xl font-bold">Comedy</h1>
            <table id="comedyTables"  class="my-4">
                <tr class="flex flex-row">
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                    <td class="flex items-center flex-col ml-10"><div class="bg-white h-52 w-44"></div>
                        <h1>Hello World</h1></td>
                </tr>
            </table>
    
        </div>
    </div>
</body>
<script script="text/javascript">
    var loggedIn = document.getElementById("loggedIn");
    var notLoggedIn = document.getElementById("notloggedIn");
    var isLoggedIn = true;
    if(isLoggedIn === false) {
        notLoggedIn.style.display = "block"
        loggedIn.style.display = "none"
    }
    else {
        notLoggedIn.style.display = "none"
        loggedIn.style.display = "block"

    }

    const moveToMovie = () => {
        location.href = "landingMovie.php";
    }

    var movies = 3;
    var movieTr = document.getElementById("actMovies");
    movieTr = ` `
    for(var i = 0; i != movies; i++) {
        movieTr += `<td class='flex items-center flex-col ml-10'><div class='bg-white h-52 w-44'></div>`
        movieTr += `<h1>`+i+`</h1></td>`
    }
    $("#actMovies").html(movieTr);

</script>
</html>