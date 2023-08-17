<?php

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: login.php");
}

require_once "db_connect.php";

$location = $_GET["location"];
$location = "%".$location."%";

$animalDisplay = "";


$sql = "SELECT * FROM `animals` WHERE address LIKE '$location';";
$result = mysqli_query($connect, $sql);

$bttns="";

if(isset($_SESSION["user"])){
    $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
}
if(isset($_SESSION["adm"])){
    $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
}

$resultUser = mysqli_query($connect, $sqlUser);
$rowUser = mysqli_fetch_assoc($resultUser);


if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        if(isset($_SESSION["user"])){
            $bttns="
            <div class='buttons text-center'> 
                <a href='details.php?x={$row["id"]}' class='btn btn-dark'>Details</a>
            </div>";
        }
        if(isset($_SESSION["adm"])){
            $bttns="
            <div class='buttons text-center'> 
                <a href='details.php?x={$row["id"]}' class='btn btn-dark'>Details</a>
                <a href='edit.php?x={$row["id"]}' class='btn btn-dark'>Edit</a>
                <a href='delete.php?x={$row["id"]}' class='btn btn-dark'>Delete</a>
            </div>";
        }
        $animalDisplay .= 
        "<div>
            <div class='card' style='width: 18rem;'>
                <img src='../images/{$row["picture"]}' class='card-img-top object-fit-cover' alt='...' style='height: 30vh;'>
                <div class='card-body'>
                    <h4 class='card-title mb-4 text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$row["name"]}</h4>
                    <hr class='TitleHR'>
                    <p class='card-text mt-5'><b>Age:</b> <br> {$row["age"]}</p>
                    <p class='card-text mb-5'><b>Size:</b><br> {$row["size"]}</p>
                    {$bttns}
                </div>
            </div>
        </div>";
    }
}else{
    $animalDisplay .= "<p>No results found.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Search</title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body><nav class="navbar navbar-expand-lg bg-body-tertiary" >
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
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="manage.php">Admin</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="create.php">Create</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="resourceLibrary.php">Resource Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="create_potw.php">Pet of the Week</a>
                </li>
            </ul>
            <a class="navbar-brand" href="update.php?id=<?=$rowUser["id"]?>">
              <span class="text-black-50 fs-6"><?= $rowUser["email"] ?></span>
            </a>
            <a class="navbar-brand" href="update.php?id=<?=$rowUser["id"]?>">
                <img src="../images/<?= $rowUser["picture"] ?>" class="object-fit-contain" alt="user pic" width="70" height="70">
            </a>
        </div>
    </nav>
    <div class="text-center mb-5 mt-5">
        <h2 class="text-center mt-5" id="welcome">Welcome <?= $rowUser["first_name"] . " " . $rowUser[ "last_name"]?>!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>
    <div class="container">
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-xs-1 gap-3">
            <?= $animalDisplay ?>
        </div>
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