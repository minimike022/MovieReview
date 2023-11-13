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
<body class="flex justify-center font-body text-white">
    <div class="w-screen h-screen relative bg-black bg-opacity-30">
    <img src="images/netflixlogo.webp" alt="" class="w-screen h-screen objct-cover absolute mix-blend-overlay">
    </div>

    <div class="w-[25em] h-[30em] bg-black absolute mt-20 rounded-md bg-opacity-80">
    <a href="landing.php" class="w-full mt-4"><img src="images/x.svg" alt="" class="mt-4 h-[35px] w-[35px] absolute right-[3em]"></a>
        <h1 class="ml-11 text-3xl font-bold mt-8">
            Sign In
        </h1>
        <form action="" method="POST" id="loginUser" class="flex flex-col w-full items-center mt-6">
            <input type="text" id="uname" name="uname" placeholder="Username" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5">
            <input type="password" id="pword" name="pword" placeholder="Password" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-5">
            <h1 class="relative left-[3.5em] mt-2">Forgot password?</h1>
            <input type="submit" name="submit" value="submit" class="focus:outline-none h-[2.8em] rounded-md bg-red-600 w-[19em] mt-5">
        </form>
        <div class="flex flex-col items-center mt-4">
            <h1>or login using</h1>
            <!-- Soc Med Photos -->
            <div class="mt-4 flex justify-between w-36">
                <img src="images/google.png" alt="" class="h-[35px] w-[35   px]">
                <img src="images/Facebook.png" alt="" class="h-[35px] w-[35px]">
                <img src="images/twitter.png" alt="" class="h-[35px] w-[35px]">
            </div>
            <a href="signup.php" class="mt-8"><h2>Don't have an account?</h2></a>
        </div>
    </div>
</body>

<script type = "text/javascript">
    $(document).ready(function() { 
        $("#loginUser").on("submit", function(e) {
            e.preventDefault();   
            let uname = $('#uname').val();
            let pword = $('#pword').val();

            $.ajax({
                url:"ajaxController.php",
                method:"POST",
                data: {
                    "loggingIn": true,
                    username:uname,
                    password:pword,
                },
                success:function(result) {
                    console.log(result);
                }
            })
            
    })
    }) 
    
    
</script>
</html>