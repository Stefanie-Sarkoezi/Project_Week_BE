<?php 
    require_once "footer.php";
    require_once "navbar.php";
    if(!isset($_SESSION["shelter"])){
        header("Location: home.php");
    }
    $id = $_GET["x"];
    $sql = "SELECT * FROM pet_adoptions WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $layout = "";
    $seen = "";
    $sqlA = "SELECT * FROM animals WHERE id = {$row['animal_id_fk']}";
    $resultA = mysqli_query($connect, $sqlA);
    $rowA = mysqli_fetch_assoc($resultA);
    $sqlU = "SELECT * FROM users WHERE id = {$row['user_id_fk']}";
    $resultU = mysqli_query($connect, $sqlU);
    $rowU = mysqli_fetch_assoc($resultU);

    $edit = "UPDATE `pet_adoptions` SET `seen` = '1' WHERE id = $id";
    if(mysqli_query($connect, $edit)){
    }

    $seen = "";
    if($row['seen'] == 0){
        $seen = "<b class='text-danger'> ! </b>";
    }
?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Notifications</title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">
    <link rel="Stylesheet" href="../css/home.css">
</head>


<body>
   <?= $nav ?>

    <div class="container mt-5">
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Date:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
                <?= $row['request_date'] ?>
            </div>
        </div>
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Animal:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
                <?= $rowA['name'] ?>
            </div>
        </div>
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Adopter:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
                <?= $rowU['first_name'] . " " . $rowU['last_name'] ?>
            </div>
        </div>
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Living Condition:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
            <?= $row['living_condition'] ?>
            </div>
        </div>
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Previous Experience:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
            <?= $row['previous_experience'] ?>
            </div>
        </div>
        <div class="myRequest">
            <div class="p-3 bg-light text-dark">
                <b>Adoption Reason:</b>
            </div>
            <div class="p-3 mb-3 bg-body-secondary">
            <?= $row['adoption_reason'] ?>
            </div>
        </div>
        <a href='acceptRequest.php?x=<?= $row['id'] ?>' class='btn btn-success'>Accept</a>
        <a href='rejectRequest.php?x=<?= $row['id'] ?>' class='btn btn-danger'>Reject</a>
    </div>
    
    <?= $footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>