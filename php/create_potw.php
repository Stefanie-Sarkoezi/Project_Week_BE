<?php
    require_once "db_connect.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    $sqlUsers = "SELECT * FROM users";
    $resultUsers = mysqli_query($connect, $sqlUsers);
    $rowUser = mysqli_fetch_assoc($resultUsers);

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);
    $rowAnimals = mysqli_fetch_assoc($resultAnimals);
    
    $nicePetOptions = "";
    if(mysqli_num_rows($resultAnimals) > 0){
        while($row = mysqli_fetch_assoc($resultAnimals)){
            $nicePetOptions .= "<option value='{$row["id"]}' selected>{$row["name"]}</option>";
        }
    }else {
        $layout .= "No Results";
    }
    $naughtyPetOptions = "";
    if(mysqli_num_rows($resultAnimals) > 0){
        while($row = mysqli_fetch_assoc($resultAnimals)){
            $naughtyPetOptions .= "<option value='{$row["id"]}' selected>{$row["name"]}</option>";
        }
    }else {
        $layout .= "No Results";
    }


    if(isset($_POST["create"])){
        $nicePet = $_POST["nicePet"];
        $nicePetDescription = $_POST["nicePetDescription"];
        $naughtyPet = $_POST["naughtyPet"];
        $naughtyPetDescription = $_POST["naughtyPetDescription"];

        $sql = "UPDATE `pet_of_week` SET `animal_id` = '$nicePet', `description` = '$nicePetDescription' WHERE id = 1";
        $sql = "UPDATE `pet_of_week` SET `animal_id` = '$naughtyPet', `description` = '$naughtyPetDescription' WHERE id = 2";

        if(mysqli_query($connect, $sql)){
            header("refresh: 3; url = manage.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong.
                </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="manage.php">Admin</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="create.php">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
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
    <div class="text-center mt-5 mb-5">
        <h2 class="text-center " id="welcome">Create a new entry:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST">
            nice pet: 
            <select id="nicePet" name ="nicePet"> 
              <?= $nicePetOptions ?>
            </select>
            <div class="mb-4">
                <label for="nicePetDescription" class="form-label">nice pet description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="nicePetDescription"  aria-describedby="nicePetDescription"  name="nicePetDescription"></textarea>
            </div>
            <hr>
            naughty pet: 
            <select id="naughtyPet" name ="naughtyPet"> 
              <?= $naughtyPetOptions ?>
            </select>
            <div class="mb-4">
                <label for="naughtyPetDescription" class="form-label">naughty pet description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="naughtyPetDescription"  aria-describedby="naughtyPetDescription"  name="naughtyPetDescription"></textarea>
            </div>
            <button name="create" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Update Pets</button>
            <a href="dashboard.php" class="btn btn-dark mb-5 mt-4">Back to Dashboard</a>
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