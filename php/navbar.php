<?php
    session_start();
    require_once "db_connect.php";
    $dashboard="";
    $log="
        <li class='nav-item'>
            <a class='nav-link' href='logout.php?logout'>Logout</a >
        </li>";
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])&& !isset($_SESSION["shelter"])){
        $userAcc = "
        <a class='navbar-brand' href='login.php'>
        <span class='text-black-50 fs-6'>Login</span>
        </a>";
        $log="";
    }
    else{
        if(isset($_SESSION["shelter"])){
            $sqlNav = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
            $dashboard="
                <li class='nav-item me-3'>
                    <a class='nav-link' aria-current='page' href='agency.php'>Dashboard</a>
                </li>
                <li class='nav-item me-3'>
                    <a class='nav-link' aria-current='page' href='agencyNotifications.php'>Requests</a>
                </li>
                <li class='nav-item me-3'>
                    <a class='nav-link' aria-current='page' href='create.php'>Create</a>
                </li>";
        }
        if(isset($_SESSION["user"])){
            $sqlNav = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
        }
        if(isset($_SESSION["adm"])){
            $sqlNav = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
            $dashboard="
                <li class='nav-item me-3'>
                    <a class='nav-link' aria-current='page' href='dashboard.php'>Dashboard</a>
                </li>
                <li class='nav-item me-3'>
                    <a class='nav-link' aria-current='page' href='create.php'>Create</a>
                </li>";
        }
        $resultNav = mysqli_query($connect, $sqlNav);
        $rowNav = mysqli_fetch_assoc($resultNav);
        $userAcc = "
        <a class='navbar-brand' href='update.php?id={$rowNav["id"]}'>
            <img src='../images/{$rowNav["picture"]}' class='object-fit-contain' alt='user pic' width='70' height='70'>
        </a>";
    }

    $nav="
    <nav class='navbar navbar-expand-lg bg-body-tertiary' >
    <div class='container-fluid'>
        <a class='navbar-brand' href='home.php'>
            <img src='../images/logo.png' alt='logo' style='width: 5vw;'>
        </a>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0 navText' >
            <li class='nav-item ms-2 me-3'>
                <a class='nav-link active' aria-current='page' href='home.php'>Home</a>
            </li>
            <!-- <li class='nav-item'>
                <a class='nav-link' href='home.php'>Pets</a>
            </li>-->
            <li class='nav-item  me-3'> 
                <a class='nav-link' href='senior.php'>Our Seniors</a>
            </li>
            <li class='nav-item dropdown me-3'>
                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Info
                </a>
                <ul class='dropdown-menu'>
                    <li><a class='dropdown-item' href='resourceLibrary.php'>Resource Library</a></li>
                    <li><a class='dropdown-item' href='faq.php'>FAQ</a></li>
                    <li><a class='dropdown-item' href='about.php'>About us</a></li>
                </ul>
            </li>
            {$dashboard}
            {$log}
        </ul>
        {$userAcc}
    </div>
    </nav>"
?>