<?php
    require_once "db_connect.php";

    session_start();

    if(!isset($_SESSION["shelter"])){
        header("Location: home.php");
    }

    $id = $_GET["x"];

    $sql = "SELECT * FROM `pet_adoptions` WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $edit = "UPDATE `animals` SET `status` = '0' WHERE id = {$id}";

    $delete = "DELETE FROM `pet_adoptions` WHERE id = {$id}";
    if(mysqli_query($connect, $edit) && mysqli_query($connect, $delete)){
        header("Location: agencyNotifications.php");
    }else {
        echo "Oops! Something went wrong!";
    }

?>