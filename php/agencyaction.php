<?php
    require_once "db_connect.php";

    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])  && !isset($_SESSION["shelter"]) && !isset($_SESSION["agency"])){
        header("Location: login.php");
    }

    $animalid = $_GET["animalid"];
    $requestid = $_GET["requestid"];
    $actionType = $_GET["action"];


    if ($actionType == 'approve') {
        $adopt_date = date('Y-m-d');
        // update adoption date
        $sqlForAdoptionTable = "UPDATE pet_adoptions SET adopt_date = $adopt_date WHERE id = $requestid";
        // make animal adopted in animals table - status 0
        $sqlForAnimalTable = "UPDATE `animals` SET `status` = '0' WHERE id = $animalid";
        If (mysqli_query($connect, $sqlForAdoptionTable) && mysqli_query($connect, $sqlForAnimalTable)){
            echo "<div class='alert alert-success' role='alert'>
            Yay! Adoption request is accepted! 
                </div>";
                header("refresh: 3; url = agency.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }
    } else if ($actionType == 'reject') {
        // make animal available again - status 1
        $sqlForAnimalTable = "UPDATE `animals` SET `status` = '1' WHERE id = $animalid";
        If (mysqli_query($connect, $sqlForAnimalTable)){
            echo "<div class='alert alert-success' role='alert'>
            Adoption request is rejected! 
                </div>";
                header("refresh: 3; url = agency.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }

    }
 
    
 
 