<?php
    require_once "db_connect.php";

    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        header("Location: register.php");
    }
    if(isset($_SESSION["adm"])){
        $sqlAcc = "SELECT * FROM users WHERE id = {$_SESSION['adm']}";
    }
    if(isset($_SESSION["user"])){
        $sqlAcc = "SELECT * FROM users WHERE id = {$_SESSION['user']}";
    }
    if(isset($_SESSION["shelter"])){
        $sqlAcc = "SELECT * FROM users WHERE id = {$_SESSION['shelter']}";
    }
    $resultAcc = mysqli_query($connect, $sqlAcc);
    $rowAcc = mysqli_fetch_assoc($resultAcc);
    $AccID = $rowAcc["id"];

    $id = $_GET["x"];

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row["picture"] != "avatar.png"){
        unlink("../images/$row[picture]");
    }

    $delete = "DELETE FROM `users` WHERE id = $id";
    if(mysqli_query($connect, $delete)){
        if(isset($_SESSION["adm"])){
            if($id != $AccID){
                header("Location: dashboard.php");
            }
            else{
                unset($_SESSION["user"]);
                unset($_SESSION["shelter"]);
                unset($_SESSION["adm"]);
                session_unset();
                session_destroy();
                header("Location: logout.php?logout");
            }
        }
        else{
            unset($_SESSION["user"]);
            unset($_SESSION["shelter"]);
            unset($_SESSION["adm"]);
            session_unset();
            session_destroy();
            // header("Location: logout.php?logout");
        }
    }else {
        echo "Oops! Something went wrong!";
    }
?>