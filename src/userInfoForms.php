<?php

session_start();
?>

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
<body class="font-body">
    <div class="w-full h-20 bg-black sticky items-center justify-between flex text-white p-10">
        <!--Title Header -->
        <div class="flex items-center justify-center">
            <a href="#"><img src="images/logo1.png" alt="" class="h-[60px] w-[100px]"></a>
        </div>
        <!-- Sign Out Buttons -->
        <div class="flex items-center justify-between w-[10em]">
            <a href="login.php" class="h-[2.5em] w-24 flex items-center justify-center border-2 border-white rounded-md hover:bg-red-500 hover:border-none active:bg-red-600">
                <h1>Sign Out</h1>
            </a>
        </div>
    </div>
    <!-- Form Body Contents  -->
    <div class="my-14 mx-14">
        <!-- Header  -->
        <div>
            <h1 class="text-5xl font-bold w-20">Personal Information</h1>
            <h2 class="text-lg mt-2">Pease enter your personal information on the forms provided below</h2>
        </div>
        <!-- Form Containers -->
        <div>
            <form action="" method="post" class="mx-8 my-4" id="addUserInfo">
                <div class="flex flex-col justify-between h-[23em]">
                    <!-- First Layer -->
                    <div class="flex justify-between w-[59em]">
                        <span>
                            <h1 class="text-lg font-bold">Last Name</h1>
                            <input type="text" id="lname" name="lname" placeholder="Last Name" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        <span>
                            <h1 class="text-lg font-bold">First Name</h1>
                            <input type="text" id="fname" name="fname" placeholder="First Name" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        <span>
                            <h1 class="text-lg font-bold">Middle Name</h1>
                            <input type="text" id="mname" name="mname" placeholder="Middle Name" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        
                        
                    </div>
                    <!-- Second Layer -->
                    <div class="flex justify-between w-[59em]">
                        <span>
                        <h1 class="text-lg font-bold">Birthday</h1>
                            <input type="date" id="bday" name="bday" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        <span>
                            <h1 class="text-lg font-bold">Religion</h1>
                            <input type="text" id="religion" name="religion" placeholder="Religion" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        
                        <!-- Radio Buttons Layer --> 
                        <span>
                            <h1 class="text-lg font-bold">Gender</h1>
                            <div class="flex flex-col justify-between">
                                <div class="flex items-center w-72">
                                    <input type="radio" id="male" name="gender" value="Male" class="h-5 w-5">
                                    <label for="rad1" class="text-lg ml-2">Male</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="female" name="gender" value="Female" class="h-5 w-5">
                                    <label for="rad2" class="text-lg ml-2">Female</label>
                                </div>  
                            </div>
                        </span>
                    </div>
                    <!-- Third Layer -->
                    <div class="flex justify-between w-[59em]">
                        <span>
                            <h1 class="text-lg font-bold">Address</h1>
                            <input type="text" id="address" name="address" placeholder="Address" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-[34em]">
                        </span>
                        <span>
                            <h1 class="text-lg font-bold">Phone Number</h1>
                            <input type="text" id="cnum" name="cnum" placeholder="Contact Number" class="border-2 border-black rounded-xl text-lg px-2 h-12 w-72">
                        </span>
                        
                    </div>
                    <!-- Submit Layer -->
                    <div>
                        <button type="submit" id="submit" value="submit" name="submit" class="border-2 rounded-xl bg-green-400 text-lg h-12 w-72 text-lg font-bold text-white border-none hover:bg-green-500 active:bg-green-600">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $("#addUserInfo").on("submit", function(e) {
            e.preventDefault();

            var datas = $(this).serializeArray();
            var data_array = {};
            var hasEmptyFields = false;

            $.map(datas, function(data, index) {
                if (data['value'].trim() === '') {
                    hasEmptyFields = true;
                }
                data_array[data['name']] = data['value'];
            });

            if (hasEmptyFields) {
                alert('Please fill in all fields.');
            } else {
                $.ajax({
                    url: "ajaxController.php",
                    method: "POST",
                    data: {
                        "addUserInfo": true,
                        "datas": data_array,
                    },
                    success: function(result) {
                        console.log(result);
                        location.href = "index.php";
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Oops something went wrong!");
                    }
                });
            }

        });
    });
    
</script>

</html>