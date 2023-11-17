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
            <button onclick="openModal()">Add Movie</button>
            <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center bg-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                <h1 class="text-black font-bold">Sign Out</h1>
            </a>
        </div>
    </div>
    <!-- Movies -->
    <div>
        <table>
            <tr id="movies" class="flex flex-row">
            </tr>
        </table>
    </div>

    <!--Add Movie-->
    
    <div id="addMovies" class="h-[30em] w-[25em] absolute bg-black top-[5em] left-[30em] bg-opacity-95">
    <button onclick="closeModal()" class="absolute top-6 right-16"><img src="images/x.svg" alt="" class="h-[30px] w-[30px]"></button>
        <form action="" method="POST" id="getMovies" class="flex flex-col items-center">
            <input type="text" id="movTitle" name="movTitle" placeholder="Movie Title" class="w-[18em] h-[3em] border-2 bg-[#3D3C3A] border-white rounded-md mt-16 pl-4 text-white">
            <input type="text" id="movGenre" name="movGenre" placeholder="Movie Genre" class="w-[18em] h-[3em] border-2 bg-[#3D3C3A] border-white rounded-md mt-4 pl-4 text-white">
            <input type="text" id="movRelease" name="movRelease" placeholder="Release Date" class="w-[18em] h-[3em] border-2 bg-[#3D3C3A] border-white rounded-md mt-4 pl-4 text-white">
            <input type="text" id="movDesc" name="movDesc" placeholder="Movie Description" class="text-sm w-[20em] h-[5em] border-2 bg-[#3D3C3A] border-white rounded-md mt-4 pl-4 text-white">
            <input type="file" id="img" name="img" accept="image/*" class="mt-4">    
            <input type="submit" value="submit" name="submit" onclick="closeModal()" class="mt-4 w-[15em] h-[2em] bg-green-500 text-white text-lg font-bold rounded-lg text-center">
        </form>
    </div>

    <!-- Fetch Movies -->
    
</body>
<script type="text/javascript">
    var addMovie = document.getElementById("addMovies");
    addMovie.style.display = "none";

    const openModal = () => {
        addMovie.style.display = "block";
    }
    const closeModal = () => {
        addMovie.style.display = "none"
    }
    $(document).ready(function() {
    $('#getMovies').on("submit", function(e) {
        var datas = $(this).serializeArray();
        console.log(datas)
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

    $.ajax({
        url:"ajaxController.php",
        method:"POST",
        data: {"fetchMovieData":true},
        success:function(result) {
            var datas = JSON.parse(result);
            var movieTr = ` `
            datas.forEach(function(data){
                movieTr += `<td class='flex items-center flex-col ml-10'><button id="button" data-Ids=`+data['movieID']+` class='bg-white h-52 w-44'></button>`
                movieTr += `<h1>`+data['movieTitle']+`</h1></td>`
            })
            $('#movies').html(movieTr);
        }
    })

    })

</script>
</html>