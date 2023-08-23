<?php
    
    require_once "footer.php";
    require_once "navbar.php";

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        $name = "guest";
    }
    else{
        if(isset($_SESSION["user"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
        }
        if(isset($_SESSION["shelter"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
        }
        if(isset($_SESSION["adm"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
        }
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["first_name"];
    }
    require_once "db_connect.php";
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $name ?></title>
   <link rel="Stylesheet" href="../css/libraryArticles.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
    <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    

    <div class=" container bg-light container-fluid font-size-auto shadow p-5">
        <div class="d-flex  text-start flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5">
            <img src="../images/TailwagCat.png" alt="" class="img-fluid h-50">
            <div class="mb-5">
                    <h2 class="" id="welcome">Decoding Cat Communication: Understanding the Meaning of Tail Wags</h2>
                <hr class="MLLine" style="width:20vw;">
                <p>
                    <b class="m-0 fs-1">C</b>ats are renowned for their enigmatic behavior, and one of the most expressive parts of their body is their tail. The way a cat holds and moves its tail can provide valuable insights into its mood, emotions, and intentions. Understanding the various meanings behind cats' tail wags can help you better connect with your feline friend.
                </p>
            </div>
        </div>
        <div class="d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5 m-5 mb-3">
            <div>
                <p>
                    <h3><b>The Straight-Up Tail</b></h3>
                    When a cat holds its tail upright, it's typically a sign of confidence, contentment, and a friendly demeanor. This is often seen when a cat greets you with its tail held straight up, displaying a sense of ease and comfort in your presence.
                </p>
                <p>
                    <h3><b>The Slow Swish</b></h3>
                    A slow swaying of the tail, usually accompanied by a relaxed body, indicates that your cat is in a peaceful and content state. This gentle movement is often seen when a cat is lounging or enjoying some quiet time.
                </p>
                <p>
                    <h3><b>The Puffed-Up Tail</b></h3>
                    A puffed-up tail is a clear indicator that a cat is feeling threatened, scared, or agitated. This defensive posture, often referred to as "bottle-brushing," is an attempt to make the cat appear larger and more intimidating. It's a signal that the cat might be ready to defend itself if necessary.
                </p>
                <p>
                    <h3><b>The Curved Tail</b></h3>
                    A tail that twitches at the tip can indicate a cat's heightened excitement or anticipation. This often happens when a cat is focused on prey, a toy, or an interesting movement nearby. It's a sign that your cat is ready for action.
                </p>
                <p>
                    <h3><b>The Twitching Tip</b></h3>
                    A tail that twitches at the tip can indicate a cat's heightened excitement or anticipation. This often happens when a cat is focused on prey, a toy, or an interesting movement nearby. It's a sign that your cat is ready for action.
                </p>
            </div>
            <div>
                <p>
                    <h3><b>The Flicking Tail</b></h3>
                    A tail that flicks back and forth rapidly can be a sign of irritation or annoyance. It's often seen when a cat is interacting with something it doesn't like, such as an unwelcome touch or an object that's bothering it.
                </p>
                <p>
                    <h3><b>The Wagging Tail</b></h3>
                    A wagging tail in cats is not equivalent to a wagging tail in dogs. In cats, a wagging tail typically signals an agitated or conflicted state. It's important to pay attention to other body language cues when interpreting this behavior, as the context matters in understanding the specific emotion the cat is expressing.
                </p>
                <p>
                    <h3><b>The Low-Hanging Tail</b></h3>
                    A tail that's held low to the ground, sometimes tucked between the hind legs, can indicate submission, fear, or anxiety. This is often seen when a cat encounters a dominant or unfamiliar presence.
                </p>
                <p>
                    <h3><b>The Quivering Tail</b></h3>
                    A tail that quivers while the cat is holding it still can be a sign of intense excitement, particularly during moments of play or anticipation.
                </p>
                <p>
                In conclusion, a cat's tail is a powerful tool for communication, reflecting a wide range of emotions and intentions. By paying close attention to your cat's tail movements in conjunction with their overall body language, facial expressions, and vocalizations, you can gain valuable insights into their current state of mind. Remember that each cat is unique, so take the time to observe and learn your cat's individual tail language to strengthen your bond and enhance your understanding of their feelings.
                </p>
            </div>      
        </div>
    </div>

    <?= $footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>