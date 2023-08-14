<?php
    require_once "db_connect.php";
    require_once "file_upload.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    $sqlUsers = "SELECT * FROM users";
    $resultUsers = mysqli_query($connect, $sqlUsers);
    $rowUser = mysqli_fetch_assoc($resultUsers);


    if(isset($_POST["create"])){
        $name = $_POST["name"];
        $address = $_POST["address"];
        $description = $_POST["description"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccinated = $_POST["vaccinated"];
        $breed = $_POST["breed"];
        $status = $_POST["status"];
        $picture = fileUpload($_FILES["picture"], "animal");

        $sql = "INSERT INTO `animals`(`name`, `address`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `picture`) VALUES ('$name','$address', '$description', '$size','$age','$vaccinated','$breed','$status','{$picture[0]}')";

        if(mysqli_query($connect, $sql)){
            echo "<div class='alert alert-success' role='alert'>
            New entry has been created. {$picture[1]}
                </div>";
                header("refresh: 3; url = manage.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="Stylesheet" href="../css/update.css">
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="home.php">Pets</a>
                </li>-->
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="senior.php">Our Seniors</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="manage.php">Admin</a>
                </li>
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="create.php">Create</a>
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
    <div class="text-center mt-5 mb-5">
        <h2 class="text-center " id="welcome">Create a new entry:</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mb-5 mt-5">
        <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-4 mt-5">
               <label for="name" class= "form-label">Name:</label>
               <input  type="text" class="form-control" id="name" aria-describedby="name" name="name">
            </div>
            <div class="mb-4">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control"  id="address"  aria-describedby="address" placeholder="E.g. Praterstraße 34, 1020 Vienna" name="address">
            </div>
            <div class="mb-4">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="description"  aria-describedby="description"  name="description"></textarea>
            </div>
            <div class="mb-4">
                <label for="size" class="form-label">Size:</label>
                <input type="number" class="form-control"  id="size"  aria-describedby="size"  placeholder="Size in cm" name="size">
            </div>
            <div class="mb-4">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control"  id="age"  aria-describedby="age"  placeholder="Age in years" name="age">
            </div>
            <div class="mb-4">
                <label for="vaccinated" class="form-label">Vaccinated:</label>
                <input type="text" class="form-control"  id="vaccinated"  aria-describedby="vaccinated"  name="vaccinated">
            </div>
            <div class="mb-4">
                <label for="breed" class="form-label">Breed:</label>
                <input type="text" class="form-control"  id="breed"  aria-describedby="breed"  name="breed">
            </div>
            <div class="mb-4">
                <label for="status" class="form-label">Status:</label>
                <input type="number" class="form-control"  id="status"  aria-describedby="status"  placeholder="Choose 0 for adopted and 1 for available " name="status">
            </div>
           <div class="mb-4">
                <label for="picture" class="form-label">Picture:</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
            <button name="create" type="submit" class="btn text-white mb-5 mt-4 me-3" id="upBtn">Create Entry</button>
            <a href="dashboard.php" class="btn btn-dark mb-5 mt-4">Back to Dashboard</a>
        </form>
    </div>

    <footer class="mt-5">
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