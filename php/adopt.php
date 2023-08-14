<?php  
   session_start();

   if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
       header("Location: login.php");
   }

   require_once "db_connect.php";

   if(isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
       $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
       $resultUser = mysqli_query($connect, $sqlUser);
       $rowUser = mysqli_fetch_assoc($resultUser);
   }elseif(!isset($_SESSION["user"]) && isset($_SESSION["adm"])) {
       $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
       $resultUser = mysqli_query($connect, $sqlUser);
       $rowUser = mysqli_fetch_assoc($resultUser);
   }

   $id = $_GET["x"];

   $sql = "SELECT * FROM animals WHERE id = $id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);

   $adopt_date = date('Y-m-d');
   $user_id_fk = $rowUser["id"];
   $animal_id_fk = $row["id"];
   $sql = "INSERT INTO `pet_adoptions`(`adopt_date`, `user_id_fk`, `animal_id_fk`) VALUES ('$adopt_date','$user_id_fk', '$animal_id_fk')";

   $statusUpdate = "UPDATE `animals` SET `status` = '0' WHERE id = $row[id]";
   $result = mysqli_query($connect, $statusUpdate);

   

        if(mysqli_query($connect, $sql)){
            echo "<div class='alert alert-success' role='alert'>
            Yay! You successfully adopted {$row['name']}! 
                </div>";
                header("refresh: 3; url = manage.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt</title>
    <link rel="Stylesheet" href="../css/update.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</body>
</html>