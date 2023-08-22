<?php
    require_once "footer.php";
    require_once "navbar.php";
    require_once "db_connect.php";


    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    $sqlUsers = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
    $resultUsers = mysqli_query($connect, $sqlUsers);
    $rowUser = mysqli_fetch_assoc($resultUsers);

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);
    $rowAnimals = mysqli_fetch_assoc($resultAnimals);
    
    $nicePetOptions = "";
    $naughtyPetOptions = "";
    if(mysqli_num_rows($resultAnimals) > 0){
        while($row = mysqli_fetch_assoc($resultAnimals)){
            $nicePetOptions .= "<option value='{$row["id"]}' selected>{$row["name"]}</option>";
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
        $sqlNaughty = "UPDATE `pet_of_week` SET `animal_id` = '$naughtyPet', `description` = '$naughtyPetDescription' WHERE id = 2";

        if(mysqli_query($connect, $sql)){
            if(mysqli_query($connect, $sqlNaughty)){
            header("refresh: 10; url = manage.php");
            }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong.
                </div>";
            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="Stylesheet" href="../css/update.css">

</head>
<body>
    <?=$nav ?>
    <div class="text-center mt-5 mb-5">
        <h2 class="text-center " id="welcome">Create a new entry:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST">
            <label class="nicePet">Nice Pet:</label>
            <select id="nicePet" name ="nicePet"> 
              <?= $nicePetOptions ?>
            </select>
            <div class="mb-4">
                <label for="nicePetDescription" class="form-label mt-3">Nice Pet Description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="nicePetDescription"  aria-describedby="nicePetDescription"  name="nicePetDescription"></textarea>
            </div>
            <hr class= "my-4">
            <label class="naugthyPet">Naughty Pet:</label>
            <select id="naughtyPet" name ="naughtyPet"> 
              <?= $naughtyPetOptions ?>
            </select>
            <div class="mb-4">
                <label for="naughtyPetDescription" class="form-label mt-3">Naughty Pet Description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="naughtyPetDescription"  aria-describedby="naughtyPetDescription"  name="naughtyPetDescription"></textarea>
            </div>
            <button name="create" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Update Pets</button>
            <a href="dashboard.php" class="btn btn-dark mb-5 mt-4">Back to Dashboard</a>
        </form>
    </div>

    <?=$footer ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>