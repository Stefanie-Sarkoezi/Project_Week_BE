<?php
    
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

    

    <div class=" container bg-light container-fluid p-5">
        <div class="text-center mb-5">
            <h2 class="text-center" id="welcome">The emergency checklist all pet parents need</h2>
            <hr class="MLLine" style="width:20vw;">
        </div>
        <div class="d-flex  text-center gap-5">
            <img src="../images/EmergencyDog.png" alt="" class="img-fluid h-50">
            <div class="text-start">
                <p>
                    As a devoted pet parent, ensuring the safety and well-being of your furry friend is of the utmost importance. While we hope that emergencies never happen, it's crucial to be prepared for the unexpected. Just as you have an emergency kit for yourself and your family, it's equally important to have one tailored to your pet's needs. Here's a comprehensive emergency checklist that all pet parents should have on hand:
                </p>
                <p>
                    <b>1.</b> Contact Information
                    Have a list of important contact information readily available. This should include your veterinarian's number, an emergency veterinary clinic's number, and the number for a local animal poison control center. It's also wise to keep a copy of your pet's medical records, including vaccinations and any ongoing health conditions.
                </p>
                <p>
                    <b>2.</b> First Aid Supplies
                    A well-stocked pet first aid kit can be a lifesaver. Include items like:

                    Sterile gauze and bandages
                    Adhesive tape
                    Tweezers    
                    Antiseptic wipes
                    Scissors
                    Digital thermometer
                    Disposable gloves
                    Pet-safe disinfectant
                    Saline solution for flushing wounds or eyes
                </p>
                <p>
                    <b>3.</b> Medications
                    If your pet is on any regular medications, ensure you have a sufficient supply in your emergency kit. Rotate them periodically to prevent expiration. Additionally, include any prescription information and dosage instructions.
                </p>
                <p>
                    <b>4.</b> Food and Water
                    Pack enough of your pet's regular food to last for a few days. Store it in an airtight container to keep it fresh. Also, carry a supply of bottled water in case your pet's access to clean water is compromised.
                </p>
                
            </div>
        </div>
        <div class="mt-5 d-flex gap-5">
            <div class="text-start">
                <p>
                    <b>5.</b> Comfort Items
                    Familiar items can help reduce stress during emergencies. Include your pet's favorite toys, blanket, or bed to provide comfort and a sense of security.
                </p>
                <p>
                    <b>6.</b> Leash, Collar, and Harness
                    Always have an extra leash, collar, and harness in case the ones you're using become damaged or lost. These are essential for keeping your pet under control and preventing them from running off in unfamiliar or chaotic situations.
                </p>
                <p>
                    <b>7.</b> Carrier or Crate
                    If evacuation is necessary, having a safe and comfortable carrier or crate for your pet is vital. Make sure it's large enough for them to stand, turn around, and lie down comfortably.
                </p>
                <p>
                    <b>8.</b> Identification
                    Ensure your pet's ID tag is up to date with your current contact information. Microchipping is an excellent way to provide permanent identification; just make sure the associated details are current.
                </p>
                <p>
                    <b>9.</b> Recent Photos
                    Keep recent photos of your pet in your emergency kit. These could prove invaluable if you become separated and need to provide identification to shelters or rescue organizations.
                </p>
            </div>
            <div class="">
                <p>
                    <b>10.</b> Emergency Blanket
                    An emergency blanket can help keep your pet warm in case of extreme weather conditions or if you need to spend time outdoors.
                </p>
                <p>
                    <b>11.</b> Waste Cleanup Supplies
                    Pack bags for waste disposal, as well as some cleaning supplies like paper towels and sanitizing wipes.
                </p>
                <p>
                    <b>12.</b> Calming Aids
                    Some pets may become anxious during emergencies. Having calming aids, such as pheromone diffusers or anxiety wraps, can help soothe their nerves.
                </p>
                <p>
                    <b>13.</b> Instructions and Plan
                    Create a clear and concise plan for what to do in different emergency scenarios. Include evacuation routes, meeting points, and any specific needs your pet may have. Share this plan with family members or trusted neighbors.
                </p>
                <p>
                    Remember, emergencies can be chaotic and stressful, but having a well-prepared emergency kit can make all the difference for your pet's safety and well-being. Regularly review and update your kit to ensure that it remains current and effective. Your dedication to being a responsible pet parent extends to preparing for the unexpected – a testament to the love you have for your furry companion.
                </p>
            </div>
        </div>
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

</body>
</html>