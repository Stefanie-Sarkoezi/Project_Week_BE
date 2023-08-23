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
    
    function cleanInput($param){
        $data = trim($param);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    if(isset($_POST["createrequest"])){
        $livingcondition = cleanInput($_POST["livingcondition"]);
        $previousexperience = cleanInput($_POST["previousexperience"]);
        $adoptionreason = cleanInput($_POST["adoptionreason"]);

        if(empty($livingcondition)){
            $error = true;
            $livingconditionError = "Please enter your living condition.";
        }elseif(strlen($livingcondition) < 10){
            $error = true;
            $livingconditionError = "Please enter a valid living condition.";
        }
        if(empty($previousexperience)){
            $error = true;
            $previousexperienceError = "Please enter your previous experience.";
        }elseif(strlen($previousexperience) < 10){
            $error = true;
            $previousexperienceError = "Please enter a valid previous experience.";
        }
        if(empty($adoptionreason)){
            $error = true;
            $adoptionreasonError = "Please enter your adoption reason.";
        }elseif(strlen($adoptionreason) < 10){
            $error = true;
            $adoptionreasonError = "Please enter a valid adoption reason.";
        }
        if(!$error){
            $sqlAnimal = "SELECT * FROM animals WHERE id = $id";
            $resultAnimal = mysqli_query($connect, $sqlAnimal);
            $rowAnimal = mysqli_fetch_assoc($resultAnimal);
         
            $shelterID = $rowAnimal["agency_id_fk"];
            $request_date = date('Y-m-d H:i:s');
            $user_id_fk = $rowUser["id"];
            $animal_id_fk = $rowAnimal["id"];
            $sqlAdoptionRequest = "INSERT INTO `pet_adoptions`(`request_date`, `user_id_fk`, `animal_id_fk`, `living_condition`, `previous_experience`, `adoption_reason`, `shelter_id`) 
                                    VALUES ('$request_date','$user_id_fk', '$animal_id_fk', '$livingcondition', '$previousexperience', '$adoptionreason', '$shelterID')";
         
            if(mysqli_query($connect, $sqlAdoptionRequest)){
                echo "<div class='alert alert-success' role='alert'>
                Yay! Your adoption request was sent successfully {$rowAnimal['name']}! 
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
               <textarea type="text" style="height: 10vh;" class="form-control"  id="livingcondition"  aria-describedby="livingcondition"  name="livingcondition" required></textarea>
                <span class="text-danger"><?= $livingconditionError ?></span>
            </div>
            <div class="mb-4 mt-5">
               <label for="previousexperience" class= "form-label">Previous Pet Experience:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="previousexperience"  aria-describedby="previousexperience"  name="previousexperience" required></textarea>
                <span class="text-danger"><?= $previousexperienceError ?></span>
            </div>
            <div class="mb-4 mt-5">
               <label for="adoptionreason" class= "form-label">Adoption Reason:</label>
               <textarea type="text" style="height: 10vh;" class="form-control"  id="adoptionreason"  aria-describedby="adoptionreason"  name="adoptionreason" required></textarea>
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