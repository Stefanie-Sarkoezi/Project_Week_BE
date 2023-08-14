<?php
    session_start();
    require_once "db_connect.php";


    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    $email = $passError = $emailError = "";
    $error = false;

    function cleanInputs($input){
        $data = trim($input); 
        $data = strip_tags($data); 
        $data = htmlspecialchars($data); 
 
         return $data;
    }

    if(isset($_POST["login"])){
        $email = cleanInputs($_POST["email"]);
        $password = $_POST["password"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $error = true ;
            $emailError = "Please enter a valid email address" ;
        }
 
         if (empty ($password)) {
            $error = true ;
            $passError = "Password can't be empty!";
        }

        if(!$error){
            $password = hash("sha256", $password);

            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            
            if(mysqli_num_rows($result) == 1){
                if($row["status"] == "user"){
                    $_SESSION["user"] = $row["id"];
                    header("Location: home.php");
                }else {
                    $_SESSION["adm"] = $row["id"];
                    header("Location: dashboard.php");
                }
            }else {
                echo "<div class='alert alert-danger'>
                <p>Wrong credentials, please try again.</p>
              </div>";
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Login page</title>
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

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center mb-5 mt-5" >
        <h1 id="welcome">Login</h1>
        <hr class="MLLine" style="width:20vw;">
    </div>

        <div class="container mt-5">
            <form method="post">
                <div class="mb-4 mt-5">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>" >
                    <span class="text-danger"><?= $emailError ?></span>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?= $passError ?></span>
                </div>
                <button name="login" type="submit" class="btn text-white me-3" id="upBtn" >Login</button>
             
                <span class="ms-2">You don't have an account? <a href="register.php">Register here</a></span>
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

     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>