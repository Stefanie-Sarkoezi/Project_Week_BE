<?php
    require_once "footer.php";
    require_once "navbar.php";

    if(isset($_SESSION["shelter"])){
        header("Location: agency.php");
    }
    if(!isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        header("Location: home.php");
    }

    require_once "db_connect.php";
    $name = "";

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);
    $name = $row["first_name"];

    $sqlUsers = "SELECT * FROM users";

    $resultUsers = mysqli_query($connect, $sqlUsers);

    $layout = "";

    if(mysqli_num_rows($resultUsers) > 0){
        while($userRow = mysqli_fetch_assoc($resultUsers)){
            $layout .= "<div>
            <div class='card' style='width: 18rem;'>
                <img src='../images/{$userRow["picture"]}' class='card-img-top object-fit-cover' alt='user pic' width='100%' height='300'>
                <div class='card-body'>
                <h5 class='card-title'>{$userRow["first_name"]} {$userRow["last_name"]}</h5>
                <p class='card-text'>{$userRow["email"]}</p>
                <a href='update.php?id={$userRow["id"]}' class='btn text-white' id='upBtn'>Update</a>
            </div>
        </div>
      </div>";
        }
    }else {
        $layout .= "No results found!";
    }
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $name ?></title>
   <link rel="Stylesheet" href="../css/dashboard.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
    <?= $nav ?>
    <div class="text-center mb-5 mt-5">
        <h2 class="text-center mt-5" id="welcome">Welcome <?= $row["first_name"] . " " . $row[ "last_name"]?>!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-ml-2 row-cols-sm-1">
            <?= $layout ?>
        </div>
    </div>

    <?= $footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>