<?php
    require_once "footer.php";
    require_once "db_connect.php";
    require_once "file_upload.php";

    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    if(isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
        $resultUser = mysqli_query($connect, $sqlUser);
        $rowUser = mysqli_fetch_assoc($resultUser);
    }elseif(!isset($_SESSION["user"]) && isset($_SESSION["adm"])) {
        $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
        $resultUser = mysqli_query($connect, $sqlUser);
        $rowUser = mysqli_fetch_assoc($resultUser);
    }
 
    $id = $_GET["x"];
  

    if(isset($_POST["createrequest"])){
        $livingcondition = $_POST["livingcondition"];
        $previousexperience = $_POST["previousexperience"];
        $adoptionreason = $_POST["adoptionreason"];

        $sqlAnimal = "SELECT * FROM animals WHERE id = $id";
        $resultAnimal = mysqli_query($connect, $sqlAnimal);
        $rowAnimal = mysqli_fetch_assoc($resultAnimal);
     
        $request_date = date('Y-m-d');
        $user_id_fk = $rowUser["id"];
        $animal_id_fk = $rowAnimal["id"];
        $sqlAdoptionRequest = "INSERT INTO `pet_adoptions`(`request_date`, `user_id_fk`, `animal_id_fk`, `living_condition`, `previous_experience`, `adoption_reason`) 
                                VALUES ('$request_date','$user_id_fk', '$animal_id_fk', '$livingcondition', '$previousexperience', '$adoptionreason')";
     
        $sqlAnimalUpdate = "UPDATE `animals` SET `status` = '2' WHERE id = $animal_id_fk";
     
        if(mysqli_query($connect, $sqlAdoptionRequest) && mysqli_query($connect, $sqlAnimalUpdate) ){
            echo "<div class='alert alert-success' role='alert'>
            Yay! Your adoption request is sent successfully {$rowAnimal['name']}! 
                </div>";
                header("refresh: 3; url = manage.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }
     
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt Request</title>
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
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="senior.php">Our Seniors</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="resourceLibrary.php">Resource Library</a>
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
        <h2 class="text-center " id="welcome">Request adoption:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-4 mt-5">
               <label for="livingcondition" class= "form-label">Living Conditions:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="livingcondition"  aria-describedby="livingcondition"  name="livingcondition"></textarea>
            </div>
            <div class="mb-4 mt-5">
               <label for="previousexperience" class= "form-label">Previous Pet Experience:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="previousexperience"  aria-describedby="previousexperience"  name="previousexperience"></textarea>
            </div>
            <div class="mb-4 mt-5">
               <label for="adoptionreason" class= "form-label">Adoption Reason:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="adoptionreason"  aria-describedby="adoptionreason"  name="adoptionreason"></textarea>
            </div>
            <button name="createrequest" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Create Request</button>
            <a href="dashboard.php" class="btn btn-dark mb-5 mt-4">Back to Dashboard</a>
        </form>
    </div>

    <?=$footer?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>