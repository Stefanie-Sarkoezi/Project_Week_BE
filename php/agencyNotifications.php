<?php 
    require_once "footer.php";
    require_once "navbar.php";
    if(!isset($_SESSION["shelter"])){
        header("Location: home.php");
    }
    $sql = "SELECT * FROM pet_adoptions WHERE shelter_id = {$_SESSION["shelter"]}";
    $result = mysqli_query($connect, $sql);
    $layout = "";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $sqlA = "SELECT * FROM animals WHERE id = {$row['animal_id_fk']}";
            $resultA = mysqli_query($connect, $sqlA);
            $rowA = mysqli_fetch_assoc($resultA);
            $sqlU = "SELECT * FROM users WHERE id = {$row['user_id_fk']}";
            $resultU = mysqli_query($connect, $sqlU);
            $rowU = mysqli_fetch_assoc($resultU);
            $seen = "";
            if($row['seen'] == 0){
                $seen = "<b class='text-danger'> ! </b>";
            }
            $layout .= "
            <tr>
                <th scope='row'>$seen</th>
                <td>{$row['request_date']}</td>
                <td>{$rowA['name']}</td>
                <td>{$rowU['first_name']} {$rowU['last_name']}</td>
                <td><a href='agencyRequests.php?x={$row["id"]}'>Details</a></td>
            </tr>";
        }
    }else {
        $layout.= "
        <tr>
            <th scope='row'>No Requests found!</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>";
    }
?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Notifications</title>
   <link rel="Stylesheet" href="../css/home.css">
   <link rel="Stylesheet" href="../css/lukas.css">
   
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>


<body>
   <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">Adoption Requests!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <!-- Added Style by Lukas -->
    <!-- To avoid the floating container I added a min height to the container. That should prevent this behavior. -->
    <div class="container" id="floatfooter">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Date</th>
                <th scope="col">Animal</th>
                <th scope="col">Adopter</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                <?= $layout ?>
            </tbody>
        </table>
    </div>
    
    <?= $footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>