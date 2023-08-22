<?php

require_once "db_connect.php";
require_once "ignorefooter.php";

$animalDisplay = $age = $operator = $location = $species = $speciesOptions = "";


// fetch all animal breeds from the table, dont repeat same species twice
$checkerArray = [];
$sqlX = "SELECT * FROM `animals`";
$result = mysqli_query($connect, $sqlX);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        // If an animal species from $row["breed"] already exists in the array, don't print
        // an extra option, then push it into the array
        if (in_array($row["breed"], $checkerArray, TRUE)) {
            array_push($checkerArray, $row["breed"]);
        } 
        // If an animal species from $row["breed" doesn't exist in the array yet, print an 
        // extra option line. Then push it into the array. This way you avoid duplicates like
        // printing an "Option dog" for every single dog in the table
        else {
            array_push($checkerArray, $row["breed"]);
            $speciesOptions .= 
            "<option value='{$row["breed"]}'>{$row["breed"]}</option>";
        }
    }
}

// Combine any number of criteria :D
if(isset($_POST["join-press"])){
    $animalDisplay = "";
    $sql = "SELECT * FROM animals WHERE ";
    $show = false;

    $age = ($_POST["age"]);
    $operator = ($_POST["operator"]);
    $location = ($_POST["location"]);
    $location = "%".$location."%";
    $species = ($_POST["species"]);


    
    if($age != "" && $operator != ""){
        $sql .= "age $operator $age";
        $show = true;
    }


    if($location != "" && $show == true) {
        $sql .= " AND address LIKE '$location'";
    }
    if($location != "" && $show == false){
        $sql .= "address LIKE '$location'";
        $show = true;
    }

    if($species != "" && $show == true) {
        $sql .= " AND breed = '$species'";
    }
    if($species != "" && $show == false){
        $sql .= "breed = '$species'";
        $show = true;
    }

    if ($sql == "SELECT * FROM animals WHERE ") {
        echo "DO SOMETHING";
        $sql = "SELECT * FROM animals";
    }
    
    $result = mysqli_query($connect, $sql);

    // for debugging
    // echo $sql;

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $animalDisplay .= 
            "<div>
                <div class='card' style='width: 18rem;'>
                    <img src='../images/{$row["picture"]}' class='card-img-top object-fit-cover' alt='...' style='height: 30vh;'>
                    <div class='card-body'>
                        <h4 class='card-title mb-4 text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$row["name"]}</h4>
                        <hr class='TitleHR'>
                        <p class='card-text mt-5'><b>Age:</b> <br> {$row["age"]}</p>
                        <p class='card-text mb-5'><b>Size:</b><br> {$row["size"]}</p>
                    </div>
                </div>
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
    <title>Pet Test</title>
</head>
<body>
    
<!-- Form to find by Age -->
<form method="post" enctype="multipart/form-data">

    <label for="age">Age: </label>
    <input type="text" name="age"><br>

    <label for="operator">Age Operator: </label>
    <select id="operator" name="operator">
        <option value="">Select a Value</option>
        <option value="=">Equals</option>
        <option value=">">MoreThan</option>
        <option value="<">LessThan</option>
    </select><br>

    <label for="location">Location: </label>
    <select id="location" name="location">
        <option value="">Innere Select a Value</option>
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
        <option value="1150">1150 Rudolfsheim</option>
        <option value="1160">1160 Ottakring</option>
        <option value="1170">1170 Hernals</option>
        <option value="1180">1180 Währing</option>
        <option value="1190">1190 Döbling</option>
        <option value="1200">1200 Brigittenau</option>
        <option value="1210">1210 Floridsdorf</option>
        <option value="1220">1220 Donaustadt</option>
        <option value="1230">1230 Liesing</option>
    </select><br>

    <label for="species">species: </label>
    <select id="species" name="species">
        <?= $speciesOptions ?>
    </select>

    <button name="join-press" type="submit">FindByCriteria</button>

</form>

<div>
    <?php echo $animalDisplay ?>
</div>


<footer><?php echo $footer ?></footer>
</body>
</html>