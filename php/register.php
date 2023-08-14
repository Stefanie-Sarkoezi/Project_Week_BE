<?php
    require_once "db_connect.php";
    require_once "file_upload.php";

    session_start();

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    $error = false;

    $fname = $lname = $email = $address = $phone = $email = "";
    $fnameError = $lnameError = $addressError = $phoneError = $emailError = $passError = "";

    function cleanInput($param){
        $data = trim($param);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    if(isset($_POST["sign-up"])){
        $fname = cleanInput($_POST["fname"]);
        $lname = cleanInput($_POST["lname"]);
        $email = cleanInput($_POST["email"]);
        $password = $_POST["password"];
        $address = cleanInput($_POST["address"]);
        $phone = cleanInput($_POST["phone"]);
        $picture = fileUpload($_FILES["picture"]);

        if(empty($fname)){
            $error = true;
            $fnameError = "Please enter your first name.";
        }elseif(strlen($fname) < 2){
            $error = true;
            $fnameError = "Name must have at least 2 characters.";
        }elseif(!preg_match("/^[a-zA-Z\s]+$/", $fname)){
            $error = true;
            $fnameError = "Name must contain only letters and spaces.";
        }

        if(empty($lname)){
            $error = true;
            $lnameError = "Please enter your last name.";
        }elseif(strlen($lname) < 2){
            $error = true;
            $lnameError = "Name must have at least 2 characters.";
        }elseif(!preg_match("/^[a-zA-Z\s]+$/", $lname)){
            $error = true;
            $lnameError = "Name must contain only letters and spaces.";
        }

        if(empty($address)){
            $error = true;
            $addressError = "Please enter your address.";
        }elseif(strlen($address) < 10){
            $error = true;
            $addressError = "Please enter a valid address.";
        }

        if(empty($phone)){
            $error = true;
            $phoneError = "Please enter your phone number.";
        }elseif(strlen($phone) < 5){
            $error = true;
            $phoneError = "Please enter a valid phone number.";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Please enter a valid email address";
        }else {
            $query = "SELECT email FROM users WHERE email = '$email'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) != 0){
                $error = true;
                $emailError = "Provided Email is already taken.";
            }
        }

        if(empty($password)){
            $error = true;
            $passError = "Password can't be empty!";
        }elseif(strlen($password) < 8){
            $error = true;
            $passError = "Password must have at least 8 characters.";
        }

        if(!$error){
            $password = hash("sha256", $password);
            $sql = "INSERT INTO `users`( `first_name`, `last_name`, `password`, `address`, `phone`, `email`, `picture`) VALUES ('$fname','$lname','$password','$address', '$phone', '$email','$picture[0]') ";

            if(mysqli_query($connect, $sql)){
                echo "<div class='alert alert-success'>
                    <p>New account has been created. $picture[1]</p>
                    </div>" ;
                header("refresh: 3; url = login.php");
                } else  {
                        echo   "<div class='alert alert-danger'>
                    <p>Oops! Something went wrong.</p>
                </div>" ;
                }
            
        }
        
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Sign Up</title>
        <link rel="Stylesheet" href="../css/update.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" >
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">
                    <img src="../images/logo.png" alt="logo" style="width: 5vw;">
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navText" >
                    <li class="nav-item ms-2 me-3">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="home.php">Pets</a>
                    </li>-->
                    <li class="nav-item  me-3"> 
                        <a class="nav-link" href="senior.php">Our Seniors</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout">Logout</a >
                    </li>
                </ul>
        
            </div>
        </nav>

        <div class="text-center mb-5 mt-5" >
            <h1 id="welcome">Sign Up:</h1>
            <hr class="MLLine" style="width:20vw;">
        </div>

        <div class="container mt-5 mb-5">
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-4 mt-5" >
                    <label for="fname" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $fname ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>
                <div class="mb-4">
                    <label for="lname" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>" required>
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
                <div class="mb-4">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class= "form-control" id="address" name="address"  value="<?= $address ?>">
                    <span class="text-danger"><?= $addressError ?></span>
                </div>
                <div class="mb-4">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class= "form-control" id="phone" name="phone"  value="<?= $phone ?>">
                    <span class="text-danger"><?= $phoneError ?></span>
                </div>
                <div class="mb-4">
                    <label for="picture" class="form-label">Profile picture:</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                    <span class="text-danger"><?= $emailError ?></span>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?= $passError ?></span>
                </div>
                <button name="sign-up" type="submit" class="btn mb-5 text-white" id="upBtn">Create account</button>
             
                <span class="ms-3 mb-5 ">You already have an account? <a href="login.php">Sign in here</a></span>
            </form>
        </div>

        <footer class="mt-5">
            <div class="card text-center" id="foBg">
                <div class="card-header p-3">
                    <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/Facebook.png" width="40%" class="m-1"></a>
                    <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/twitter.png" width="90%" class="m-1"></a>
                    <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/instagram.png" width="75%"  class="m-1"></a>
                    <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/google.png" width="75%"  class="m-1"></a>
                </div>
                <span class="card-body input-group input-group-sm  mx-auto p-3" style="width: 40%;" >
                    <span class="input-group-text bg-black border-black text-white">Sign up for our newsletter</span>
                    <input type="text" name="email" autocomplete="email" class="form-control bg-black border-black" placeholder="example@gmail.com">
                    <button class=" btn rounded-end bg-black text-white" type="button" id="button-addon1"> Subscripe</button>
                </span>
                <div class="card-footer text-body-secondary p-1">
                    &copy; Stefanie Sarközi
                </div>
            </div>
        </footer>

     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
    </body>
</html>