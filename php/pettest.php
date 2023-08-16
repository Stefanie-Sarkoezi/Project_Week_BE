<?php

require_once "db_connect.php";

// Find by Age
if(isset($_POST["join-press"])){
    $age = ($_POST["age"]);
    $operator = ($_POST["operator"]);
    $location = ($_POST["location"]);

    header("Location: petjoin.php?age={$age}&&operator={$operator}&&location={$location}");
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
        <option value="=">Equals</option>
        <option value=">">MoreThan</option>
        <option value="<">LessThan</option>
    </select><br>

    <label for="location">Location: </label>
    <select id="location" name="location">
        <option value=""></option>
        <option value="1010">Innere Stadt</option>
        <option value="1020">Leopoldstadt</option>
        <option value="1030">Landstraße</option>
        <option value="1040">Wieden</option>
        <option value="1050">Margareten</option>
        <option value="1060">Mariahilf</option>
        <option value="1070">Neubau</option>
        <option value="1080">Josefstadt</option>
        <option value="1090">Alsergrund</option>
        <option value="1100">Favoriten</option>
        <option value="1110">Simmering</option>
        <option value="1120">Meidling</option>
        <option value="1130">Hietzing</option>
        <option value="1140">Penzing</option>
        <option value="1150">Rudolfsheim</option>
        <option value="1160">Ottakring</option>
        <option value="1170">Hernals</option>
        <option value="1180">Währing</option>
        <option value="1190">Döbling</option>
        <option value="1200">Brigittenau</option>
        <option value="1210">Floridsdorf</option>
        <option value="1220">Donaustadt</option>
        <option value="1230">Liesing</option>
    </select><br>

    <button name="join-press" type="submit">FindByCriteria</button>

</form>


</body>
</html>