<?php
    require_once "db_connect.php";
    require_once "file_upload.php";
    require_once "footer.php";
    require_once "navbar.php";

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        header("Location: login.php");
    }

    if(isset($_SESSION["user"])){
        $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
    }elseif(isset($_SESSION["adm"])) {
        $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
    }elseif(isset($_SESSION["shelter"])) {
        $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
    }
    $resultUser = mysqli_query($connect, $sqlUser);
    $rowUser = mysqli_fetch_assoc($resultUser);
 
    $id = $_GET["x"];
  
    $error = false;

    $livingcondition = $previousexperience = $adoptionreason = "";
    $livingconditionError = $previousexperienceError = $adoptionreasonError = "";

    if(isset($_POST["createrequest"])){
        $livingcondition = $_POST["livingcondition"];
        $previousexperience = $_POST["previousexperience"];
        $adoptionreason = $_POST["adoptionreason"];

        if(empty($livingcondition)){
            $error = true;
            $livingconditionError = "Please enter your livingcondition.";
        }elseif(strlen($livingcondition) < 10){
            $error = true;
            $livingconditionError = "Please enter a valid livingcondition.";
        }
        if(empty($previousexperience)){
            $error = true;
            $previousexperienceError = "Please enter your previousexperience.";
        }elseif(strlen($previousexperience) < 10){
            $error = true;
            $previousexperienceError = "Please enter a valid previousexperience.";
        }
        if(empty($adoptionreason)){
            $error = true;
            $adoptionreasonError = "Please enter your adoptionreason.";
        }elseif(strlen($adoptionreason) < 10){
            $error = true;
            $adoptionreasonError = "Please enter a valid adoptionreason.";
        }
        if(!$error){
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
                    header("refresh: 3; url = home.php");
            }else {
                echo "<div class='alert alert-danger' role='alert'>
                    Oops! Something went wrong. {$picture[1]}
                    </div>";
            }
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
    <?= $nav ?>
    <div class="text-center mt-5 mb-5">
        <h2 class="text-center " id="welcome">Request adoption:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-4 mt-5">
               <label for="livingcondition" class= "form-label">Living Conditions:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="livingcondition"  aria-describedby="livingcondition"  name="livingcondition"></textarea>
                <span class="text-danger"><?= $livingconditionError ?></span>
            </div>
            <div class="mb-4 mt-5">
               <label for="previousexperience" class= "form-label">Previous Pet Experience:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="previousexperience"  aria-describedby="previousexperience"  name="previousexperience"></textarea>
                <span class="text-danger"><?= $previousexperienceError ?></span>
            </div>
            <div class="mb-4 mt-5">
               <label for="adoptionreason" class= "form-label">Adoption Reason:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="adoptionreason"  aria-describedby="adoptionreason"  name="adoptionreason"></textarea>
                <span class="text-danger"><?= $adoptionreasonError ?></span>
            </div>
            <button name="createrequest" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Create Request</button>
            <a href="home.php" class="btn btn-dark mb-5 mt-4">Back to Home</a>
        </form>
    </div>

    <?=$footer?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>