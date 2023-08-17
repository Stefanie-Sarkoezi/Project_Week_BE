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
            <img src="../images/SeparationA.png" alt="" class="img-fluid h-50">
            <div class="mb-5">
                    <h2 class="" id="welcome">Recognizing and Addressing Pet Separation Anxiety</h2>
                <hr class="MLLine" style="width:20vw;">
                <p>
                    <b class="m-0 fs-1">A</b>s cherished members of our families, our pets provide us with unconditional love and companionship. However, just like humans, pets can experience emotional challenges, and one common issue is separation anxiety. If you've noticed signs of distress when you leave your pet alone, they might be struggling with this condition. Understanding separation anxiety and learning how to manage it can greatly improve your pet's well-being.
            </div>
        </div>
        <div class="d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5 m-5 mb-3">
            <div>
                <p>
                    <h3><b>Unveiling Separation Anxiety</b></h3>
                    <p>
                    Separation anxiety is a psychological condition that occurs when pets become excessively anxious or distressed when separated from their owners. This can manifest in various ways, depending on the individual pet's personality and circumstances.
                    </p>
                </p>
                <p>
                    <h3><b>Recognizing the Signs</b></h3>
                    <p>Pets with separation anxiety may exhibit a range of behaviors, including:
                    </p>
                    <h5>Excessive Vocalization:</h5>
                    <p>
                    Constant barking, meowing, or howling when alone.
                    </p>
                    
                    <h5>Destructive Behavior:</h5>
                    <p>
                    Chewing furniture, scratching doors, or tearing up belongings.
                    </p>
                    
                    <h5>Inappropriate Elimination:</h5>
                    <p>
                    Accidents in the house, even if the pet is usually housetrained.
                    </p>
                    
                    <h5>Pacing or Restlessness:</h5>
                    <p>
                    Restlessness, pacing, or an inability to settle down.
                    </p>
                    <h5>Escape Attempts:</h5>
                    <p>
                    Trying to escape or find their way back to their owner.
                    </p>
                    <h5>Excessive Greeting: </h5>
                    <p>
                    Overwhelming excitement when the owner returns, as if they've been apart for a long time.
                    </p>
                    <h5>Loss of Appetite: </h5>
                    <p>
                    Refusing to eat when alone.
                    </p>
                </p>
                <p>
                    <h3><b>Potential Causes</b></h3>
                    <p>Several factors can contribute to separation anxiety in pets:</p>
                    
                    <h5>Sudden Changes:</h5>
                    <p>
                    Major life changes such as moving to a new home, a change in routine, or the loss of a family member or companion can trigger anxiety.
                    </p>
                    <h5>Past Experiences: </h5>
                    <p>
                    Pets that have experienced neglect, abandonment, or multiple rehoming might be more prone to separation anxiety.
                    </p>
                    <h5>Attachment Issues:</h5>
                    <p>
                    Overly strong bonds with their owners can lead to distress when apart.
                    </p>
                    <h5>Lack of Socialization:</h5>
                    <p>
                    Insufficient exposure to being alone during their formative months can make pets more vulnerable to anxiety.
                    </p>
                </p>
            </div>
            <div>
                <p>
                    <h3><b>Managing Separation Anxiety</b></h3>
                    <p>
                    Addressing separation anxiety requires patience and understanding. Here are some strategies to help your pet cope:
                    </p>

                    <h5>Gradual Departures:</h5>
                    <p>
                    Practice leaving for short periods and gradually increase the time to help your pet adjust to your absence.
                    </p>
                    <h5>Create a Safe Space:</h5>
                    <p>
                    Designate a cozy area where your pet feels safe and secure. This can be a crate, a specific room, or a comfy bed.
                    </p>
                    <h5>Positive Associations:</h5>
                    <p>
                    Offer treats, toys, or puzzles that your pet can engage with while you're away.
                    </p>
                    <h5>Calming Techniques: </h5>
                    <p>
                    Use pheromone diffusers or calming music to create a soothing environment.
                    </p>
                    <h5>Behavior Modification:</h5>
                    <p>
                    Consult a professional animal behaviorist or veterinarian for tailored advice and training techniques.
                    </p>
                    <h5>Medication:</h5>
                    <p>
                    In severe cases, your veterinarian might recommend medication to alleviate your pet's anxiety.
                    </p>
                </p>
                <p>
                    <h3><b>Seeking Professional Help</b></h3>
                    <p>
                    If your pet's separation anxiety is severe or negatively impacting their quality of life, it's advisable to seek guidance from a veterinarian or animal behaviorist. These professionals can provide an accurate diagnosis and develop a comprehensive plan to address your pet's specific needs.
                    </p>
                <p>
                In conclusion, recognizing and addressing separation anxiety is crucial for the well-being of our beloved pets. By understanding the signs, identifying potential triggers, and implementing appropriate management strategies, you can help your pet feel more secure and content when you're not around. Remember, your patience, love, and commitment are vital in helping your furry friend overcome their anxiety and enjoy a happier, more relaxed life.
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