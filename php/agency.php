<?php
    require_once "footer.php";
    require_once "navbar.php";

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(!isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        header("Location: home.php");
    }

    require_once "db_connect.php";

    $agencyId= "";
    if(isset($_SESSION["shelter"])){
        $agencyId = $_SESSION["shelter"];
    }

    $sql = "SELECT * FROM users WHERE id = {$agencyId}";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);


    $sqlAnimals = "SELECT * FROM animals  WHERE agency_id_fk = {$agencyId} ";

    // assumption: 1-available, 2-requested, 0-adopted
    if (isset($_GET['status'])){
        if ($_GET['status'] == 'adopted'){
            $sqlAnimals .= " AND status = 0";
        } elseif ($_GET['status'] == 'requested'){
            $sqlAnimals .= " AND status = 2";
        } elseif ($_GET['status'] == 'available'){
            $sqlAnimals .= " AND status = 1";
        }
    }

    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";
    


    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){

            $statusText = "";
            if($rowAnimal["status"] == 2){
                $statusText = "Requested";
            } else if($rowAnimal["status"] == 0){
                $statusText = "Adopted";
            } else if($rowAnimal["status"] == 1){
                $statusText = "Available";
            } 


            
            $layout .= "<div>
            <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='width: 100%;'>
                <div class='card-body '>
                <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                <hr class='TitleHR'>
                <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                <p class='card-text mb-4 ps-3'><b>Status:</b><br> {$statusText} </p>
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
   <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">Welcome <?= $row["first_name"]?>!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container">
        <a class="btn btn-dark" href="agency.php?status=adopted">Adopted animals</a>
        <a class="btn btn-dark" href="agency.php?status=available">Available animals</a>
        <a class="btn btn-dark" href="agency.php">All animals</a>
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $layout ?>
        </div>
    </div>
    
    <?= $footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>