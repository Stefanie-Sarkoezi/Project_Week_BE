<?php

    require_once "footer.php";

    session_start();
    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    require_once "db_connect.php";

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $row["first_name"] ?></title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="../images/logo.png" alt="logo" style="width: 5vw;">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navText" >
                <li class="nav-item ms-2 me-3">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="senior.php">Our Seniors</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="resourceLibrary.php">Resource Library</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
                </li>
            </ul>
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
              <span class="text-black-50 fs-6"><?= $row["email"] ?></span>
            </a>
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
                <img src="../images/<?= $row["picture"] ?>" class="object-fit-contain" alt="user pic" width="70" height="70">
            </a>
        </div>
    </nav>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">FAQs</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mt-5">
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1" >
                What is Pawfect? 
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq1">
                <div class="card card-body">
                    The goal of Pawfect is to connect animal shelters with potential adopters and help our pet friends to find a new home. 
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq1" >
                How does an adoption process work? 
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq2">
                <div class="card card-body">
                    Our pet adoption platform aims to connect animal shelters with potential pet adopters seamlessly. The process begins when you find a furry friend you'd like to welcome into your home. Simply click on the "Take Me Home" button on the pet's profile to initiate the adoption process.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq1" >
                What happens after I click the "Take Me Home" button? 
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq3">
                <div class="card card-body">
                    After clicking the button, you'll be guided to fill out an adoption request form. This form helps us gather information about you and your living situation to ensure that you and the pet are a good match. The information you provide helps the animal shelters make informed decisions.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq1" >
                What information is required in the adoption request form?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq4">
                <div class="card card-body">
                    The adoption request form will ask you for details about your living situation, experience with pets, daily routine, and your reasons for wanting to adopt. This information helps the shelters assess if the pet's needs align with your lifestyle.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq1" >
                What happens once I submit the adoption request?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq5">
                <div class="card card-body">
                    Once you submit the adoption request, the animal shelter will review your information and application. They'll consider factors like the pet's specific needs and your ability to provide a loving and suitable home.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq1" >
                How long does it take to hear back from the shelter?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq6">
                <div class="card card-body">
                    The response time may vary depending on the shelter's workload and the number of applications they receive. Typically, shelters aim to respond within a few business days. Your patience during this process is appreciated.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false" aria-controls="faq1" >
                What if my adoption request is accepted?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq7">
                <div class="card card-body">
                    Congratulations! If your adoption request is accepted, the shelter will contact you with further instructions. This may involve scheduling a meet-and-greet with the pet or discussing adoption logistics.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="false" aria-controls="faq1" >
                Can my adoption request be declined?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq8">
                <div class="card card-body">
                    Yes, there might be instances where your adoption request is declined. Shelters prioritize the well-being of the animals and strive to ensure a suitable match. If your request is declined, it's not a reflection on you personally but rather a decision made to ensure the best outcome for the pet.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-inline-flex">
                <button class="btn btn-dark p-3 text-start" style="width: 30vw;" type="button" data-bs-toggle="collapse" data-bs-target="#faq9" aria-expanded="false" aria-controls="faq1" >
                What if I'm not selected for adoption?
                <img src="../images/arrow_down.png" class="ms-3" style="height: 2vh;">
                </button>
            </p>
            <div class="collapse" id="faq9">
                <div class="card card-body">
                    If your adoption request is not selected, don't be disheartened. Our platform hosts a variety of wonderful pets, and there might be another furry companion that's the perfect fit for your home. You're encouraged to explore other pet profiles and submit adoption requests for those that match your lifestyle.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="d-flex align-items-center">
                <button class="btn btn-dark p-3 text-start flex-grow-1" type="button" data-bs-toggle="collapse" data-bs-target="#faq10" aria-expanded="false" aria-controls="faq1">
                    Can I visit the shelter in person?
                </button>
                <img src="../images/arrow_down.png" class="ms-3 arrow" style="height: 2vh;">
            </p>
            <div class="collapse" id="faq10">
                <div class="card card-body">
                    Many shelters do offer in-person visits, but availability might vary. We recommend checking the specific shelter's policies or contacting them directly to inquire about visiting arrangements.
                </div>
            </div>
        </div>
    </div>


    <?=$footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html> 