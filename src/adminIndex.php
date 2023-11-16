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
    <script type="text/javascript" src="js/jquery.min.js"></script>
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
        <form action="" method="POST" id="getMovies">
            <input type="text" id="movTitle" name="movTitle" placeholder="Movie Title">
            <input type="text" id="movGenre" name="movGenre" placeholder="Movie Genre">
            <input type="text" id="movRelease" name="movRelease" placeholder="Release Date">
            <input type="text" id="movDesc" name="movDesc" placeholder="Movie Description">
            <input type="submit" value="submit" name="submit" placeholder="Movie Description">
        </form>

    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
    $('#getMovies').on("submit", function(e) {
        e.preventDefault();
        var datas = $(this).serializeArray();
        var data_array = {};
        $.map(datas, function(data, index) {
                if (data['value'].trim() === '') {
                    hasEmptyFields = true;
                }
                data_array[data['name']] = data['value'];
            });
        
        $.ajax({
            url: "ajaxController.php",
            method: "POST",
            data: {
                "AddMovie": true,
                movieData:data_array
               
            },
            success:function(result){
                console.log(result);
                console.log("Added Successfully!");
            },
            error:function(result) {
                console.log("Added Failed!");
            }
        })
    }) 

    })

</script>
</html>