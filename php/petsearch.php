<?php

require_once "db_connect.php";

// Get Options to select from for Breeds
$speciesOptions = "";
$checkerArray = [];
$sql = "SELECT * FROM `animals`";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        if (in_array($row["breed"], $checkerArray, TRUE)) {
            array_push($checkerArray, $row["breed"]);
        } else {
            array_push($checkerArray, $row["breed"]);
            $speciesOptions .= 
            "<option value='{$row["breed"]}'>{$row["breed"]}</option>";
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Search</title>
</head>
<body>
    


<!-- Form to find by Age -->
<form method="post" enctype="multipart/form-data">
    <label for="age">Age: </label>
    <input type="text" name="age"><br>
    <label for="operator">Operator: </label>
    <select id="operator" name="operator">
        <option value="=">Equals</option>
        <option value=">">MoreThan</option>
        <option value="<">LessThan</option>
    </select>
    <button name="age-press" type="submit">FindByAge</button>
</form>
<!-- Form to find by Location (PLZ) -->
<form method="post" enctype="multipart/form-data">
    <label for="location">District: </label>
    <select id="location" name="location">
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
    <button name="location-press" type="submit">FindByLocation</button>
</form>
<!-- Form to find by Species -->
<form method="post" enctype="multipart/form-data">
    <label for="species">species: </label>
    <select id="species" name="species">
        <?= $speciesOptions ?>
    </select>
    <button name="species-press" type="submit">FindBySpecies</button>
</form>


</body>
</html>