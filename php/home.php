<?php

    session_start();

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    require_once "db_connect.php";

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";
    


    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){

            $adoptBtn = "";
            if($rowAnimal["status"] == 0){
                $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
            } else {
                $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
            }
            
            $layout .= "<div>
            <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='width: 100%;'>
                <div class='card-body '>
                <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                <hr class='TitleHR'>
                <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                <div class='buttons text-center'> 
                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                    {$adoptBtn}
                </div>
                </div>
                </div>
          </div>";
        }
    }else {
        $layout.= "No results found!";
    }

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $row["first_name"] ?></title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

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
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
              <span class="text-black-50 fs-6"><?= $row["email"] ?></span>
            </a>
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
                <img src="../images/<?= $row["picture"] ?>" class="object-fit-contain" alt="user pic" width="70" height="70">
            </a>
        </div>
    </nav>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">Welcome <?= $row["first_name"]?>!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $layout ?>
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