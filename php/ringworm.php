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
   <link rel="Stylesheet" href="../css/libraryArticles.css">
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

    

    <div class=" container bg-light container-fluid font-size-auto shadow p-5">
        <div class="d-flex  text-start flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5">
            <img src="../images/RingwormsDog.png" alt="" class="img-fluid h-50">
            <div class="mb-5">
                    <h2 class="" id="welcome">Unraveling the Mystery of Ringworm in Dogs</h2>
                <hr class="MLLine" style="width:20vw;">
                <p>
                    <b class="m-0 fs-1">R</b>ingworm, despite its misleading name, is not caused by a worm but rather a fungal infection that can affect both humans and animals, including dogs. This common skin condition is highly contagious and can be a cause for concern among pet owners. Understanding the ins and outs of ringworm in dogs can help you identify, treat, and prevent its spread.
            </div>
        </div>
        <div class="d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5 m-5 mb-3">
            <div>
                <p>
                    <h3><b>The Fungus Among Us</b></h3>
                    <p>
                    Ringworm is caused by various types of fungi known as dermatophytes. These fungi thrive in warm and humid environments, making pets susceptible to infection. Dogs with compromised immune systems, young puppies, and older dogs are particularly at risk.
                    </p>
                </p>
                <p>
                    <h3><b>Recognizing the Signs</b></h3>
                    <p>Ringworm presents itself as circular, hairless patches on a dog's skin. These patches are often red and may be slightly raised, resembling a rash. The center of the lesion might appear more healed, giving it a ring-like appearance that inspired the name. Other symptoms can include:
                    </p>
                    <h5>Itchiness: </h5>
                    <p>
                    Infected dogs may scratch or lick the affected areas due to discomfort.
                    </p>
                    
                    <h5>Scaly Skin:</h5>
                    <p>
                    The skin around the lesion may become flaky or scaly.
                    </p>
                    
                    <h5>Hair Loss:</h5>
                    <p>
                    Hair loss is common within the circular patches.
                    </p>
                    
                    <h5>Crusty Patches:</h5>
                    <p>
                    Some lesions may develop a crust or scab on the surface.
                    </p>
                    <h5>Inflammation:</h5>
                    <p>
                    In severe cases, the affected area can become inflamed or develop a secondary bacterial infection.
                    </p>
                </p>
                <p>
                    <h3><b>Diagnosis and Treatment</b></h3>
                    <p>If you suspect your dog has ringworm, consult a veterinarian for proper diagnosis and treatment. The vet will likely perform a fungal culture to confirm the presence of dermatophytes. Once diagnosed, treatment may involve:</p>
                    
                    <h5>1. Topical Medications: </h5>
                    <p>
                    Antifungal creams, ointments, or shampoos can be applied directly to the affected areas. It's important to follow your vet's instructions and complete the treatment course.
                    </p>
                    <h5>2. Oral Medications::</h5>
                    <p>
                    In more severe cases, oral antifungal medications may be prescribed. These medications are usually reserved for extensive infections or cases where topical treatment isn't effective.
                    </p>
                    <h5>3. Environmental Management:</h5>
                    <p>
                    Since ringworm is highly contagious, thorough cleaning of your dog's living environment is crucial to prevent reinfection. Vacuuming, washing bedding, and disinfecting surfaces can help eliminate fungal spores.
                    </p>
                    <h5>4. Isolation:</h5>
                    <p>
                    Infected dogs should be isolated from other pets to prevent spreading the infection.
                    </p>
                </p>
            </div>
            <div>
                <p>
                    <h3><b>Prevention and Precautions</b></h3>
                    <p>
                    Preventing ringworm requires diligence, especially if you have multiple pets. Some preventive measures include:
                    </p>

                    <h5>Regular Check-ups:</h5>
                    <p>
                    Regular veterinary visits can help catch and address any potential issues early.
                    </p>
                    <h5>Good Hygiene:</h5>
                    <p>
                    Regular bathing and grooming can help maintain your dog's skin health.
                    </p>
                    <h5>Quarantine New Pets:</h5>
                    <p>
                    If you bring a new pet into your home, consider isolating them until they've been cleared by a veterinarian.
                    </p>
                    <h5>Limit Exposure:</h5>
                    <p>
                    If you suspect ringworm in one of your pets, limit their contact with other animals and humans until they've been treated and cleared by a vet.
                    </p>
                    <h5>Sanitation: </h5>
                    <p>
                    Regularly clean and disinfect your pet's living areas, bedding, and grooming tools.
                    </p>
                </p>
                <p>
                In conclusion, while ringworm in dogs might not be caused by worms, it's still a concern that requires attention. Being aware of the signs, seeking veterinary guidance, and taking preventive measures are essential steps in managing this fungal infection. With proper care and treatment, your canine companion can overcome ringworm and regain their healthy, vibrant coat.
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