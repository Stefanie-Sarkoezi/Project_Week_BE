<!-- Admins only  -->

<?php

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    require_once "db_connect.php";

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";

    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){
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
                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                </div>
                </div>
                </div>
          </div>";
        }
    }else {
        $layout.= "No results found!";
    }
    // Get Options to select from for Breeds
    $speciesOptions = "";
    $checkerArray = [];
    $sqlBreed = "SELECT * FROM `animals`";
    $resultBreed = mysqli_query($connect, $sqlBreed);
    if(mysqli_num_rows($resultBreed) > 0){
        while($rowBreed = mysqli_fetch_assoc($resultBreed)){
            if (in_array($rowBreed["breed"], $checkerArray, TRUE)) {
                array_push($checkerArray, $rowBreed["breed"]);
            } else {
                array_push($checkerArray, $rowBreed["breed"]);
                $speciesOptions .= 
                "<option value='{$rowBreed["breed"]}'>{$rowBreed["breed"]}</option>";
            }
        }
    }
    // Find by Age
    if(isset($_POST["age-press"])){
        $age = ($_POST["age"]);
        $operator = ($_POST["operator"]);
    
        header("Location: petage.php?age={$age}&&operator={$operator}");
    }
    
    // Find by Location (PLZ)
    if(isset($_POST["location-press"])){
        $location = ($_POST["location$location"]);
    
        header("Location: petlocation.php?location={$location}");
    }
    
    // Find by Species
    if(isset($_POST["species-press"])){
        $species = ($_POST["species"]);
    
        header("Location: petspecies.php?species={$species}");
    }
    // -------------------PET OF THE WEEK--------------------------
    $sqlPow = "SELECT * FROM pet_of_week WHERE id = 1";
    $resultPow = mysqli_query($connect, $sqlPow);
    $rowNice = mysqli_fetch_assoc($resultPow);
    $sqlAnimal = "SELECT * FROM animals WHERE id = {$rowNice["animal_id"]}";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);
    $nicePet = "
    <div class='text-center d-flex flex-row gap-5 flex-wrap justify-content-start align-items-center m-4' style='width: 50vw;'>
        <img src='../images/{$rowAnimal["picture"]}' class='img-fluid img-thumbnail rounded' alt='...' style='width: 50%;'>
        <div>
            <b>{$rowAnimal["name"]}</b>
            <p>{$rowNice["description"]}  
        </div> 
    </div>";

    $sqlPow = "SELECT * FROM pet_of_week WHERE id = 2";
    $resultPow = mysqli_query($connect, $sqlPow);
    $rowNice = mysqli_fetch_assoc($resultPow);
    $sqlAnimal = "SELECT * FROM animals WHERE id = {$rowNice["animal_id"]}";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);
    $naughtyPet = "
    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='width: 30%;'>
    <b>{$rowAnimal["name"]}</b>
    <p>{$rowNice["description"]}";
    // ------------------------PET OF THE WEEK END-------------------------------------

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
        <h2 class="text-center mt-5" id="welcome">Manage:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container">
        <div class="petOfTheWeek">
            <hr>
            <div class="nicePet text-center bg-light p-4">
                <h2>NICE PET OF THE WEEK</h2>
                <?=$nicePet?>
            </div>
            <hr>
            <div class="naughtyPet text-center bg-light p-4">
                <h2>NAUGHTY PET OF THE WEEK</h2>
                <?= $naughtyPet?>
            </div>
            <hr>
        </div>
        <a class="btn btn-dark" type="button" href="create_potw.php">Pet of the Week</a>
        <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filter</button>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header myFilter">
                <h5 class="offcanvas-title text-light" id="offcanvasScrollingLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body myFilter">
                <hr>
                <!-- Form to find by Age -->
                <form method="post" enctype="multipart/form-data">
                    <label for="age" class="text-light">Age: </label>
                    <input type="text" class="form-control mt-2" name="age"><br>
                        <label for="operator" class="text-light">Operator: </label>
                        <select id="operator" class="form-select mt-2" name="operator">
                            <option value="=">Equals</option>
                            <option value=">">MoreThan</option>
                            <option value="<">LessThan</option>
                        </select>
                    <button name="age-press" class="btn btn-secondary mt-3" type="submit">FindByAge</button>
                </form>
                <hr>
                <!-- Form to find by Location (PLZ) -->
                <form method="post" enctype="multipart/form-data">
                    <label for="location" class="text-light">District: </label>
                    <select id="location" class="form-select mt-2" name="location">
                        <option value="1010">1010 Innere Stadt</option>
                        <option value="1020">1020 Leopoldstadt</option>
                        <option value="1030">1030 Landstraße</option>
                        <option value="1040">1040 Wieden</option>
                        <option value="1050">1050 Margareten</option>
                        <option value="1060">1060 Mariahilf</option>
                        <option value="1070">1070 Neubau</option>
                        <option value="1080">1080 Josefstadt</option>
                        <option value="1090">1090 Alsergrund</option>
                        <option value="1100">1100 Favoriten</option>
                        <option value="1110">1110 Simmering</option>
                        <option value="1120">1120 Meidling</option>
                        <option value="1130">1130 Hietzing</option>
                        <option value="1140">1140 Penzing</option>
                        <option value="1150">1150 Rudolfsheim-Fünfhaus</option>
                        <option value="1160">1160 Ottakring</option>
                        <option value="1170">1170 Hernals</option>
                        <option value="1180">1180 Währing</option>
                        <option value="1190">1190 Döbling</option>
                        <option value="1200">1200 Brigittenau</option>
                        <option value="1210">1210 Floridsdorf</option>
                        <option value="1220">1220 Donaustadt</option>
                        <option value="1230">1230 Liesing</option>
                    </select>
                    <button name="location-press" class="btn btn-secondary mt-3" type="submit">FindByLocation</button>
                </form>
                <hr>
                <!-- Form to find by Species -->
                <form method="post" enctype="multipart/form-data">
                    <label for="species" class="text-light">Species: </label>
                    <select id="species" class="form-select mt-2" name="species">
                        <?= $speciesOptions ?>
                    </select>
                    <button name="species-press" class="btn btn-secondary mt-3" type="submit">FindBySpecies</button>
                </form>
            </div>
        </div>
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