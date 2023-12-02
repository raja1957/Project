<?php
// // require 'connect.php';

// $servername="localhost";
// $username="root";
// $password="";
// $dbname="Social";

// $conn=mysqli_connect($servername,$username,$password,$dbname);
// echo $conn;
// if(!$conn){
//     // die("Can't connect to the db");
//     echo "Sorry for the error!!!!";
// }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Social";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("sorry we failed to connect" . mysqli_connect_error());
}

// require 'login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page or Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="style2.css">
</head>


<body>

    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form action="index.php" method="post">
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="text" name='Username' required>
                    <label for="Username">Username</label>
                </div>
                <div class="input-group">
                    <input type="email" name="Email" required>
                    <label for="Email">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="Password" required>
                    <label for="Password">Password</label>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="#" class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>
        <?php

        $dismissibleButton = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Username = $_POST['Username'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $user_exists = false;
            if($Username!=null){
            $exists = "SELECT * FROM `Users` WHERE Username like '$Username'";
            $check = mysqli_query($conn, $exists);
            $rows = mysqli_num_rows($check);
            // echo $rows;
            if ($rows > 0) {
                $user_exists = true;
            } else {
                $hash = password_hash($Password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `Users` (`ID`, `Username`, `Email`, `Password`) VALUES (NULL, '$Username', '$Email', '$hash');";

                // echo 'error';
                $result_sql = mysqli_query($conn, $sql);
                if (!$result_sql) {
                    echo "The data submission is failed to the databse!!!!";
                } else {

                    // header('location: index.php');

                    // echo "hello";
                    $dismissibleButton = true;
                }
            }
        }
        }

        ?>

        <div class="form-wrapper sign-in">
            <form action="index.php" method="post">
                <h2>Login</h2>
                <div class="input-group">
                    <input type="text" required name="Username_Log">
                    <label for="Username_Log">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" required name="Password_Log">
                    <label for="Password_Log">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn"><a href="index.php">Login</a></button></button>
                <!-- <button type="submit" class="btn">Login</button> -->
                <div class="sign-link">
                    <p>Don't have an account? <a href="#" class="signUp-link">Sign Up</a></p>
                </div>
            </form>

        </div>
    </div>
    <?php
    require 'login.php'; 
    ?>
    <?php
    if ($dismissibleButton) :
    ?>

        <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed;top:0cm;left: 35%;">
            <strong>Success!</strong> You have successfully registered!!Now log in to your account.
            <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php endif; ?>
    <?php
    if ($user_exists) :
    ?>
        <div id="alertMessage" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed;top:0cm;left: 35%;">
            <strong>Failed!</strong> Sorry but the username already exists!!Use a different Username.
            <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <script>
        // Hide the alert after 10 seconds
        setTimeout(function() {
            document.getElementById('alertMessage').style.display = 'none';
        }, 5000);
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>