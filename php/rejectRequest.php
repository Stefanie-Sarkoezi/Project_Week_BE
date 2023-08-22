
<?php
require_once "db_connect.php";

session_start();

if(!isset($_SESSION["shelter"])){
    header("Location: home.php");
}

$id = $_GET["x"];


$delete = "DELETE FROM `pet_adoptions` WHERE id = {$id}";
if(mysqli_query($connect, $delete)){
    header("Location: agencyNotifications.php");
}else {
    echo "Oops! Something went wrong!";
}

?>