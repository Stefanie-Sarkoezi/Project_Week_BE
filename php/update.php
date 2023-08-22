<?php
   require_once "footer.php";
   require_once "navbar.php";
   require_once "db_connect.php";
   require_once "file_upload.php";

   if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"]) && !isset($_SESSION["shelter"])){
    header("Location: home.php");
   }

   $id = $_GET["id"]; 
   if(isset($_SESSION["user"]) || isset($_SESSION["shelter"])){
        if(isset($_SESSION["user"])){
            $sqlAcc = "SELECT * FROM users WHERE id = {$_SESSION['user']}";
        }
        if(isset($_SESSION["shelter"])){
            $sqlAcc = "SELECT * FROM users WHERE id = {$_SESSION['shelter']}";
        }
        $resultAcc = mysqli_query($connect, $sqlAcc);
        $rowAcc = mysqli_fetch_assoc($resultAcc);
        $AccID = $rowAcc["id"];
        if($id != $AccID){
            header("Location: home.php");
        }
   }
   $sql = "SELECT * FROM users WHERE id = $id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);

   $backBtn = "home.php";
   $status="";
   if(isset($_SESSION["adm"])){
        $status="
        <div class='mb-4'>
            <label for='status' class='form-label'>Status:</label>
                <select id='status' class='form-select mt-2' name='status'>
                    <option value='user'>User</option>
                    <option value='shelter'>Shelter</option>
                    <option value='adm'>Admin</option>
                </select>
        </div>";
   }

   if (isset($_POST["update"])){
       $fname = $_POST["first_name"];
       $lname = $_POST["last_name"];
       $email = $_POST["email"];
       $address = $_POST["address"];
       $phone = $_POST["phone"];
       $picture = fileUpload($_FILES["picture"]);

       if(isset($_SESSION["adm"])){
            $stat = $_POST["status"];
            if($_FILES["picture"]["error"] == 0){
                 if($row["picture"] != "avatar.png"){
                    unlink("../images/$row[picture]" );
                }
                $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `picture` = '$picture[0]', address = '$address', `phone` = '$phone', `email` = '$email', `status` = '$stat' WHERE id = {$id}";
            } else {
                $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', address = '$address', `phone` = '$phone', `email` = '$email', `status` = '$stat' WHERE id = {$id}";
            }
       }
       else{
        if($_FILES["picture"]["error"] == 0){
             if($row["picture"] != "avatar.png"){
                unlink("../images/$row[picture]" );
            }
            $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `picture` = '$picture[0]', address = '$address', `phone` = '$phone', `email` = '$email' WHERE id = {$id}";
        } else {
            $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', address = '$address', `phone` = '$phone', `email` = '$email' WHERE id = {$id}";
        }
    }
       

    if (mysqli_query($connect, $sql)){
        echo  "<div class='alert alert-success' role='alert'>
       Your user information has been updated. {$picture[1]}
     </div>" ;
     header( "refresh: 1; url=$backBtn" );
   } else  {
        echo   "<div class='alert alert-danger' role='alert'>
       Oops! Something went wrong. {$picture[1]}
     </div>" ;
   }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Edit profile </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="Stylesheet" href="../css/update.css">
    </head>
    <body>
        <?= $nav ?>

        <div class="container mt-5 mb-5">
            <div class="text-center mb-5">
                <h1  id="welcome">Edit profile: </h1>
                <hr class="MLLine" style="width:20vw;">
            </div>
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-4 mt-5" >
                    <label for="first_name" class="form-label"> First name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= $row["first_name"] ?>">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control"   id="last_name" name="last_name" placeholder="Last name" value="<?= $row["last_name"] ?> ">
                </div>
                <div class="mb-4">
                    <label for="address" class="form-label">Adress:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= $row["address"] ?>">
                </div>
                <div class="mb-4">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $row["phone"] ?>">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?> ">
                </div>
                <?= $status ?>
                <div class="mb-4">
                    <label for="picture" class="form-label">Profile picture:</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                </div>
                <button name="update" type="submit" class="btn text-white mb-5" id="upBtn" >Update profile</button>
                <a href="<?= $backBtn ?>" class="btn btn-secondary mb-5">Back</a>
                <a href='user_delete.php?x=<?= $id ?>' class='btn btn-danger mb-5'>Delete</a>
            </form>
        </div>

        <?= $footer ?>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>