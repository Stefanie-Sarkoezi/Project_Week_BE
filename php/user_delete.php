<?php
    require_once "db_connect.php";

    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: register.php");
    }

    $id = $_GET["x"];

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row["picture"] != "avatar.png"){
        unlink("../images/$row[picture]");
    }

    $delete = "DELETE FROM `users` WHERE id = $id";
    if(mysqli_query($connect, $delete)){
        unset($_SESSION["user"]);
        unset($_SESSION["adm"]);
        session_unset();
        session_destroy();
        header("Location: login.php");
    }else {
        echo "Oops! Something went wrong!";
    }
?>