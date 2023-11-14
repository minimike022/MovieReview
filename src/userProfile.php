<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        <?php
        
            include "css/output.css";
        
        ?>
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body class="bg-black">
    <!-- Navigation Header -->
    <div class="w-full h-20 bg-black sticky items-center justify-between flex text-white p-10">
        <!--Title Header -->
        <div class="flex items-center justify-center">
            <a href="landing.php"><img src="images/logo1.png" alt="" class="h-[60px] w-[80px]"></a>
            <!-- Navigation -->
            <div class="flex items-center justify-between h-full font-body w-[23em] ml-8 font-bold text-base">
                <a href="index.php" class="hover:text-red-500">Home</a>
                <a href="" class="hover:text-red-500">Movies</a>
                <a href="" class="hover:text-red-500">New & Popular</a>
                <a href="" class="hover:text-red-500">My Reviews</a>
            </div>
            <form method="POST" action="" class="ml-4 flex items-center border-none">
                <input type="text" placeholder="Search:" name="search" id="search" class="rounded-lg h-10 w-[20em] border-2 border-white bg-black focus:outline-none focus:border-red-500 pl-6">
            </form>
        </div>
        

        <!-- Users Buttons -->
        <div id="loggedIn">
                <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600 text-black hover:text-white">
                    <h1 class="font-bold">Sign Out</h1>
                </a>
        </div>
    </div>

    <!-- Body -->
    <div class="mx-32 my-20 text-white flex justify-between font-body">
        <!-- User Info -->
        <div class="flex flex-col items-center">
            <!-- Profile Photo -->
            <div>
                <img src="images/twitter.png" alt="" class="h-[15em] w-[15em]">
            </div>
            <div class="mt-4 items-start w-full font-bold text-lg">
                <h1 class="mt-2">Name: </h1>
                <h1 class="mt-2">Age: </h1>
                <h1 class="mt-2">Gender: </h1>
                <h1 class="mt-2">Religion: </h1>
                <h1 class="mt-2">Birthday</h1>
            </div>
            <!-- User Info -->
        </div>
        
        <!-- Informations -->
        <div class="w-[25em]">
            <!-- Reviews -->
            <div class="mt-4 flex flex-col">
                <h1 class="text-3xl font-bold">Reviews</h1>
                <div class="ml-4 mt-4">
                    <h1 class="text-lg font-bold">Transformer(2023)</h1>
                    <p class="ml-4 h-[5em] rounded-lg p-2 bg-[#373737] mt-2">dsadwahdsjakdhwkja</p>
                </div>
            </div>
            <!-- Edit Information -->
            <div>

            </div>
            <!-- Change Password -->
        </div>

        <!--Controller-->
        <div class="flex flex-col items-start font-bold text-lg h-[6em] justify-between">
            <button class="hover:text-red-500 hover:text-xl"><h1>My Reviews</h1></button>
            <button class="hover:text-red-500 hover:text-xl"><h1>Edit Information</h1></button>
            <button class="hover:text-red-500 hover:text-xl"><h1>Change Password</h1></button>
        </div>

    </div>

</body>
</html>