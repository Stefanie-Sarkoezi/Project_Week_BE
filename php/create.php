<?php
    require_once "db_connect.php";
    require_once "file_upload.php";
    require_once "footer.php";
    require_once "navbar.php";

    if(!isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        header("Location: home.php");
    }
    $agencyForm = "";
    $agencyForm2 = "";
    $agencyOptions = "";
    if(isset($_SESSION["shelter"])){
        $sqlUsers = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
    }
    if(isset($_SESSION["adm"])){
        $sqlUsers = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
        $sqlAcc = "SELECT * FROM users";
        $resultAcc = mysqli_query($connect, $sqlAcc);
        if(mysqli_num_rows($resultAcc) > 0){
            while($rowAcc = mysqli_fetch_assoc($resultAcc)){
                if ($rowAcc["status"] == "shelter") {
                    $agencyOptions .= 
                    "<option value='{$rowAcc['id']}'>{$rowAcc['first_name']} {$rowAcc['last_name']}</option>";
                }
            }
        }
        $agencyForm="
        <div class='mb-4'>
            <label for='agencyID' class='form-label'>Agency:</label>
                <select id='agencyID' class='form-select mt-2' name='agencyID'>
                    <option value=''>select agency</option>";
        $agencyForm2 = "
                    </select>
            </div>";
    }
    $resultUsers = mysqli_query($connect, $sqlUsers);
    $rowUser = mysqli_fetch_assoc($resultUsers);

    if(isset($_POST["create"])){
        $sql ="";
        $name = $_POST["name"];
        $address = $_POST["address"];
        $description = $_POST["description"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccinated = $_POST["vaccinated"];
        $breed = $_POST["breed"];
        $picture = fileUpload($_FILES["picture"], "animal");
        $status = 1;
        if(isset($_SESSION["adm"])){
            $agencyID = $_POST["agencyID"];
            $sql = "INSERT INTO `animals`(`name`, `address`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `picture`,`agency_id_fk`) VALUES ('$name','$address', '$description', '$size','$age','$vaccinated','$breed','$status','{$picture[0]}','$agencyID')";
        }
        else{
            $agencyID = $rowUser["id"];
            $sql = "INSERT INTO `animals`(`name`, `address`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `picture`,`agency_id_fk`) VALUES ('$name','$address', '$description', '$size','$age','$vaccinated','$breed','$status','{$picture[0]}','$agencyID')";
        }
        if(mysqli_query($connect, $sql)){
            echo "<div class='alert alert-success' role='alert'>
            New entry has been created. {$picture[1]}
                </div>";
                header("refresh: 3; url = home.php");
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
    <title>Create</title>
    <link rel="Stylesheet" href="../css/update.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <?= $nav ?>
    <div class="text-center mt-5 mb-5">
        <h2 class="text-center " id="welcome">Create a new entry:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-4 mt-5">
               <label for="name" class= "form-label">Name:</label>
               <input  type="text" class="form-control" id="name" aria-describedby="name" name="name">
            </div>
            <div class="mb-4">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control"  id="address"  aria-describedby="address" placeholder="E.g. Praterstraße 34, 1020 Vienna" name="address">
            </div>
            <div class="mb-4">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="description"  aria-describedby="description"  name="description"></textarea>
            </div>
            <div class="mb-4">
                <label for="size" class="form-label">Size:</label>
                <input type="number" class="form-control"  id="size"  aria-describedby="size"  placeholder="Size in cm" name="size">
            </div>
            <div class="mb-4">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control"  id="age"  aria-describedby="age"  placeholder="Age in years" name="age">
            </div>
            <div class="mb-4">
                <label for="vaccinated" class="form-label">Vaccinated:</label>
                <select class="form-select form-select mb-3" aria-label="vaccinated" name="vaccinated" id="vaccinated" >
                    <option selected value="Yes">Yes</option>
                    <option value="No">No</option>
                </select> 
            </div>
            <div class="mb-4">
                <label for="breed" class="form-label">Breed:</label>
                <select class="form-select form-select mb-3" aria-label="breed" name="breed" id="breed" >
                    <option selected value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                    <option value="Leopard Gecko">Leopard Gecko</option>
                    <option value="Bunny">Bunny</option>
                    <option value="Jumping Spider">Jumping Spider</option>
                </select> 
            </div>
            <?= $agencyForm ?>
            <?= $agencyOptions ?>
            <?= $agencyForm2 ?>
           <div class="mb-4">
                <label for="picture" class="form-label">Picture:</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
            <button name="create" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Create Entry</button>
            <a href="home.php" class="btn btn-dark mb-5 mt-4">Back to Home</a>
        </form>
    </div>

    <?= $footer ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>