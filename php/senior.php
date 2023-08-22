<?php
    require_once "footer.php";
    require_once "navbar.php";

    require_once "db_connect.php";
    $name = "";
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        $name = "guest";
    }
    else{
        if(isset($_SESSION["user"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
        }
        if(isset($_SESSION["shelter"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
        }
        if(isset($_SESSION["adm"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
        }
    
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["first_name"];
    }

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";

    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){
            if($rowAnimal["age"] > 8){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $layout .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='width: 100%;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }}
        
    }else {
        $layout.= "No results found!";
    }
    

?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $name ?></title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
    <?=$nav ?>
    
    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center mt-5" >
        <h2 id="welcome">Our Seniors:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>
   

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $layout ?>
        </div>
    </div>

    <?=$footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>