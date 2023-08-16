<?php

require_once "db_connect.php";

$operator = $_GET["operator"];
$age = $_GET["age"];
$location = $_GET["location"];


$animalDisplay = "";
$sql = "SELECT * FROM animals WHERE";

if(($age != "") && ($operator != "")){
    $sql .= "age $operator $age";
}

if ($location != "") {
$location = "%".$location."%";
    $sql .= "JOIN age $operator $age";
}

$sql = "SELECT * FROM animals WHERE age $operator $age";
$result = mysqli_query($connect, $sql);



if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $animalDisplay .= 
        "<div>
            <div class='card gap-3 mt-5 mb-5 shadow' style='width: 18rem;'>
                <img src='../images/{$row["picture"]}' class='card-img-top' alt='...' style='height: 30vh;'>
                <div class='card-body'>
                    <h4 class='card-title mb-4 text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$row["name"]}</h4>
                    <hr class='TitleHR'>
                    <p class='card-text mt-5'><b>Age:</b> <br> {$row["age"]}</p>
                    <p class='card-text mb-5'><b>Size:</b><br> {$row["size"]}</p>
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$row["id"]}' class='btn btn-dark'>Details</a>
                        <a href='edit.php?x={$row["id"]}' class='btn btn-warning'>Edit</a>
                        <a href='delete.php?x={$row["id"]}' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
}else{
    $animalDisplay .= "<p>No results found.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Join</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    

<div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $animalDisplay ?>
        </div>
    </div>





</body>
</html>