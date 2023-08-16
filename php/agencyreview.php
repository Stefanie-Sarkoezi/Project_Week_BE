<?php
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])  && !isset($_SESSION["shelter"]) && !isset($_SESSION["agency"])){
        header("Location: login.php");
    }

    require_once "db_connect.php";

    $agencyId= "";
    if(isset($_SESSION["shelter"])){
        $agencyId = $_SESSION["shelter"];
    }
    if(isset($_SESSION["agency"])){
        $agencyId = $_SESSION["agency"];
    }

    $sql = "SELECT * FROM users WHERE id = {$agencyId}";
    $result = mysqli_query($connect, $sql);
    $rowUser = mysqli_fetch_assoc($result);


    $id = $_GET["x"];

    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    // assumption: 1-available, 2-requested, 0-adopted
    $status = $row["status"];
    if($status = 0){ 
        $message = "Adopted";
        $colorClass = "red-text";
    }else if($status = 2){ 
        $message = "Requested";
        $colorClass = "orange-text";
    } else {
        $message = "Available";
        $colorClass = "green-text";
    }

    $sqlAnyRequest = "SELECT pet_adoptions.id as requestId, pet_adoptions.*, users.*
                        FROM pet_adoptions	
                            LEFT JOIN animals ON pet_adoptions.animal_id_fk = animals.id 
                            LEFT JOIN users ON pet_adoptions.user_id_fk = users.id
                            where animals.status =2 and animals.id = {$id}
                            order by pet_adoptions.request_date desc";

    $resultAnyRequest = mysqli_query($connect, $sqlAnyRequest);
    $cardForRequest = "";
    if (mysqli_num_rows($resultAnyRequest) > 0) {
        // assumption: the last request should be displayed! previous ones might be rejected. so no need to display them.
        $rowRequest = mysqli_fetch_assoc($resultAnyRequest);
        $cardForRequest = "
                <div class='text-center'>
                    <h1 id='welcome'>Request Details</h1>
                        <hr class='MLLine' style='width:20vw;'>
                </div>
                <div class='d-flex flex-row justify-content-center align-items-start'>
                <div><img src='../images/{$rowRequest["picture"]} width='700vw'></div>
                <div class='w-50'>
                    <div class='mb-3'><b id='txSize'>Name:</b> <br> {$rowRequest["first_name"]}</div>
                    <div class='mb-3'><b id='txSize'>Surname:</b> <br> {$rowRequest["last_name"]}</div>
                    <div class='mb-3'><b id='txSize'>Address:</b> <br> {$rowRequest["address"]}</div>
                    <div class='mb-3'><b id='txSize'>Phone:</b> <br> {$rowRequest["phone"]}</div>
                    <div class='mb-3'><b id='txSize'>Email:</b> <br> {$rowRequest["email"]}</div>
                </div>
                <div class='w-100'> 
                    <b id='txSize'>Request Date:</b> {$rowRequest["request_date"]}<br>  
                    <b id='txSize'>Living Conditions:</b>  {$rowRequest["living_condition"]}<br>  
                    <b id='txSize'>Previous Experience:</b>  {$rowRequest["previous_experience"]}<br>  
                    <b id='txSize'>Adoption Reason:</b> {$rowRequest["adoption_reason"]}
                </div>
            </div>
            <div class='buttons text-center'> 
                <a href='agencyaction.php?animalid={$rowRequest["animal_id_fk"]}&requestid={$rowRequest["requestId"]}&action=approve' class='btn btn-dark'>Approve</a>
                <a href='agencyaction.php?animalid={$rowRequest["animal_id_fk"]}&requestid={$rowRequest["requestId"]}&action=reject' class='btn btn-dark'>Reject</a>
            </div><br><br>

            ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="Stylesheet" href="../css/details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
                    <a class="nav-link" href="agency.php">All animals</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="agency.php?status=adopted">Adopted animals</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="agency.php?status=requested">Requested animals</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
                </li>
            </ul>
            <a class="navbar-brand" href="update.php?id=<?=$rowUser["id"]?>">
              <span class="text-black-50 fs-6"><?= $rowUser["email"] ?></span>
            </a>
            <a class="navbar-brand" href="update.php?id=<?=$rowUser["id"]?>">
                <img src="../images/<?= $rowUser["picture"] ?>" class="object-fit-contain" alt="user pic" width="70" height="70">
            </a>
        </div>
    </nav>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center" >
        <h1 id="welcome">Details</h1>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="d-flex flex-row justify-content-center align-items-start">
        <div><img src="../images/<?= $row["picture"] ?>" width="700vw"></div>
        <div class="w-50">
            <div class="mb-3"><b id="txSize">Name:</b> <br> <?= $row["name"] ?></div>
            <div class="mb-3"><b id="txSize">Address:</b> <br><?= $row["address"]?></div>
            <div class="mb-3"><b id="txSize">Age:</b> <br><?= $row["age"]?></div>
            <div class="mb-3"><b id="txSize">Size:</b> <br><?= $row["size"]?> cm</div>
            <div class="mb-3"><b id="txSize">Vaccinated:</b> <br><?= $row["vaccinated"] ?></div>
            <div class="mb-3"><b id="txSize">Breed:</b> <br><?= $row["breed"] ?></div>
            <div >
                <b id="txSize">Status:</b> 
                <span class="<?php echo $colorClass; ?>"> <?php echo $message; ?> </span>
            </div>
        </div>
        <div class="w-100"> <b id="txSize">Description:</b> <br>  <?= $row["description"] ?></div>
   </div>

   <?php echo $cardForRequest; ?>

    <footer>
        <div class="card text-center" id="foBg">
            <div class="card-header p-3">
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/Facebook.png" width="40%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/twitter.png" width="90%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/instagram.png" width="75%"  class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/google.png" width="75%"  class="m-1"></a>
            </div>
            <span class="card-body input-group input-group-sm  mx-auto p-3" style="width: 40%;" >
                <span class="input-group-text bg-black border-black text-white">Sign up for our newsletter</span>
                <input type="text" name="email" autocomplete="email" class="form-control bg-black border-black" placeholder="example@gmail.com">
                <button class=" btn rounded-end bg-black text-white" type="button" id="button-addon1"> Subscripe</button>
            </span>
            <div class="card-footer text-body-secondary p-1">
                &copy; Stefanie Sarközi
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>