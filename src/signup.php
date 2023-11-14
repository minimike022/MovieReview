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
        <a href="index.php" class="w-full mt-4"><img src="images/x.svg" alt="" class="mt-4 h-[35px] w-[35px] absolute right-[3em]"></a>
            <h1 class="ml-11 text-3xl font-bold mt-11">
                Sign Up
            </h1>
        <form action="" method="POST" id="addUser" class="flex flex-col w-full items-center mt-6">
            <input type="text" id="uname" name="uname" placeholder="Username" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-4">
            <span class="flex text-left w-full"><h2 id="validationTag" class="text-[#ED2939] font-bold text-sm mt-2 ml-12">Username Already Taken!</h2></span>
            <input type="text" id="email" name="email" placeholder="Email" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-4">
            <input type="password" id="pword" name="pword" placeholder="Password" class="focus:outline-none h-[2.8em] rounded-md bg-[#3D3C3A] w-[19em] pl-5 mt-4"> 
            <input type="submit" name="submit" value="submit" class="focus:outline-none h-[2.8em] rounded-md bg-red-600 w-[19em] mt-6">
        </form>
        <div class="flex flex-col items-center mt-4">
            <a href="login.php" class="mt-8"><h2>Already have an account?</h2></a>
        </div>
    </div>
</body>

<script type="text/javascript">
    var unameForm = document.getElementById("uname");
    var validateTag = document.getElementById("validationTag");
    var emailForm = document.getElementById("email");

    validateTag.style.display = "none";
    $(document).ready(function() {
        $("#addUser").on("submit", function(e) {
            e.preventDefault();
            var username = $('#uname').val();
            console.log(username);
            var datas = $(this).serializeArray();
            var data_array = {};
            var hasEmptyFields = false;
            console.log(datas);
            $.map(datas, function(data, index) {
                if (data['value'].trim() === '') {
                    hasEmptyFields = true;
                }
                data_array[data['name']] = data['value'];
            });

            if (hasEmptyFields) {
                alert('Please fill in all fields.');
            } else {
                $.post("ajaxController.php", {
                    uname:username
                }, function(result) {
                    if(result == "0") {
                        $.ajax({
                            url:"ajaxController.php",
                            method:"POST",
                            data: {
                                "addUser": true,
                                datas:data_array,
                            },
                            success:function(result) {
                                console.log("successfully Added!")
                                location.href="userInfoForms.php";
                            }
                        })
                    }else if(result != 0){
                        unameForm.style.borderBottom = "4px solid #ED2939"
                        validateTag.style.display = "block";
                        emailForm.style.marginTop = "0.5rem"
                    }
                })
            }

        });
    });
</script>

</html>