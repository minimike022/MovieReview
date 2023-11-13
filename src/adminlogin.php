<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
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
        <a href="landing.php" class="w-full mt-4"><img src="images/x.svg" alt="" class="mt-4 h-[35px] w-[35px] absolute right-[3em]"></a>
            <h1 class="ml-11 text-3xl font-bold mt-11">
                Admin
            </h1>
            
        <form action="" method="POST" id="adminLogin" class="flex flex-col w-full items-center mt-6">
            <div id="errorBox" class="w-[19em] h-12 bg-none border-2 border-red-500 rounded-md flex justify-center items-center mb-4">
                <h1 class="text-red-500 text-[12px] text-center mt-1">Incorrect Username or Password. Please Try Again</h1>
            </div>
            <input type="text" id="uname" name="uname" placeholder="Username" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-4">
            <input type="text" id="email" name="email" placeholder="Email" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-4">
            <input type="password" id="pword" name="pword" placeholder="Password" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-4"> 
            <input type="submit" id="submit" name="submit" value="submit" class="focus:outline-none h-[2.8em] rounded-md bg-red-600 w-[19em] mt-6">
        </form>
    </div>
</body>
<script type="text/javascript">
    var errorBox = document.getElementById("errorBox");
    errorBox.style.display = "none"
    var isMatched = true
    //Change This Later. Will check wether username and password is correct then logged in
    if(!isMatched) {
        errorBox.style.display = "block"
    }
    $("#adminLogin").on("submit", function(e) {
            e.preventDefault();
            location.href = "adminlanding.php"
        })
    
    
</script>

</html>