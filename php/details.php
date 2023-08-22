<?php
    require_once "footer.php";
    require_once "navbar.php";

    require_once "db_connect.php";

    $id = $_GET["x"];

    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $status = $row["status"];
    if($status == 0){ 
        $message = "Adopted";
        $colorClass = "red-text";
    }else if($status == 2){ 
        $message = "Requested";
        $colorClass = "red-text";
    } else {
        $message = "Available";
        $colorClass = "green-text";
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
    <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center" >
        <h1 id="welcome">Details</h1>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="d-flex flex-row gap-5 flex-wrap justify-content-start align-items-center p-5">
        <div class="w-40"><img src="../images/<?= $row["picture"] ?>" width="80%"></div>
        <div class="w-40 ps-0">
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

    <?= $footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
