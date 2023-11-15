<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php
            include "css/output.css";
        ?>
    </style>
</head>
<body>
    <!-- Admin  Nav Bar -->
    <div class="h-24 bg-black flex items-center justify-end">
        <div class="flex items-center justify-between w-[25em] mx-10 text-white">
            <form action="">
                <input type="text" placeholder="Search: ">
            </form>
            <button>Add Movie</button>
            <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                <h1 class="text-black font-bold">Sign Out</h1>
            </a>
        </div>
    </div>
    <!-- Movies -->
    <div>

    </div>

    <!--Add Movie-->
    <div class="h-[30em] w-[25em] absolute bg-slate-600 top-[5em] left-[30em]">
        <form action="">
            <input type="text" placeholder="Movie Title">
            <input type="text" placeholder="Movie Genre">
            <input type="text" placeholder="Release Date">
            <input type="text" placeholder="Movie Description">
        </form>
    </div>
</body>
</html>