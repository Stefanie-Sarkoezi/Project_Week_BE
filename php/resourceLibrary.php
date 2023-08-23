<?php
    require_once "footer.php";
    require_once "navbar.php";

    require_once "db_connect.php";
?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Resource Libary</title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">Resource Library</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container-fluid pt-5">
            <div class="container py-5">
                <div class="row pb-3">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center  justify-content-center bg-white mb-2 p-3 p-sm-5 h-100 shadow" >
                            <p> <img src="../images/EmergencyDog.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-house display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">The emergency checklist all pet parents need</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="emergencyChecklist.php">Read More</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5 h-100 shadow">
                            <p> <img src="../images/CatnipCat.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-food display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">How catnip affects cats</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="catnip.php">Read More</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5 h-100 shadow" >
                            <p> <img src="../images/BloatingDog.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">Bloating in dogs</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="bloating.php">Read More</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5 h-100 shadow" >
                            <p> <img src="../images/RingwormsDog.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">Ringworm in dogs</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="ringworm.php">Read More</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5 h-100 shadow" >
                            <p> <img src="../images/TailwagCat.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">What do cats' tail wags mean?</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="tailWag.php">Read More</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5 h-100 shadow">
                            <p> <img src="../images/SeparationA.png" alt="" class="img-fluid"> </p>
                            <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                            <h3 class="mb-3">Does your pet suffer from separation anxiety?</h3>
                            <!-- <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est magna diam eos, rebum sit vero stet ipsum justo</p> -->
                            <span class="mt-auto">
                            <a class="text-uppercase font-weight-bold mt-auto btn btn-secondary" href="separationA.php">Read More</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <?=$footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>