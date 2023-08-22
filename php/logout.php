<?php
    session_start();
    if(isset($_GET["logout"])){
        unset($_SESSION["user"]);
        unset($_SESSION["shelter"]);
        unset($_SESSION["adm"]);

        session_unset();
        session_destroy();

        header("Location: home.php");
    }
?>
