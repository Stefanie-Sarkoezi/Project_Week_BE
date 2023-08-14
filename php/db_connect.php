<?php

    $localhost = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "be19_cr5_animal_adoption_sarközi_stefanie";

    
    $connect = mysqli_connect($localhost, $username, $password, $dbname);

    if (!$connect) {
    die ("Connection failed");
    }
