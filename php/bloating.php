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
            <img src="../images/BloatingDog.png" alt="" class="img-fluid h-50">
            <div class="mb-5">
                    <h2 class="" id="welcome">The Bloating Battle: Understanding Canine Bloating</h2>
                <hr class="MLLine" style="width:20vw;">
                <p>
                    <b class="m-0 fs-1">B</b>loating, a seemingly harmless condition, can turn into a serious and life-threatening issue for our beloved canine companions. Canine bloating, also known as gastric dilatation-volvulus (GDV) or bloat, is a medical emergency that requires immediate attention. Understanding its causes, symptoms, and preventive measures is crucial for every dog owner.
                </p>
            </div>
        </div>
        <div class="d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5 m-5 mb-3">
            <div>
                <p>
                    <h3><b>The Culprits Behind Canine Bloating</b></h3>
                    Bloating occurs when a dog's stomach fills with gas, fluid, or food, leading to an expansion that can put pressure on vital organs and blood vessels. If this expansion becomes severe and the stomach twists, cutting off the blood supply, it can result in GDV, which is a life-threatening situation.
                </p>
                <p>
                    While the exact causes of bloating aren't always clear, certain factors are believed to contribute:
                    <h5>1. Eating Habits:</h5>
                    <p>
                        Rapid eating, gulping air while eating, or consuming large meals can increase the likelihood of bloating. Dogs that eat quickly are more prone to swallowing air, which can lead to gas accumulation.
                    </p>
                    
                    <h5>2. Breed Predisposition:</h5>
                    <p>
                        Larger, deep-chested breeds, such as Great Danes, Boxers, and Standard Poodles, are more susceptible to bloating.
                    </p>
                    
                    <h5>3. Physical Activity After Eating:</h5>
                    <p>
                        Engaging in vigorous exercise immediately after eating can potentially trigger bloating.
                    </p>
                    
                    <h5>4. Age and Genetics:</h5>
                    <p>
                        Older dogs and those with a family history of bloating may be at a higher risk.
                    </p>
                </p>
                <p>
                    <h3><b>Recognizing the Signs</b></h3>
                    <p>Detecting the symptoms of bloating is crucial in addressing the issue promptly. Common signs of bloating in dogs include:</p>
                    
                    <h5>Restlessness:</h5>
                    <p>
                    Dogs may appear anxious or restless, unable to find a comfortable position..
                    </p>
                    <h5>Distended Abdomen:</h5>
                    <p>
                    The abdomen may become visibly enlarged and feel tight.
                    </p>
                    <h5>Unproductive Retching or Vomiting:</h5>
                    <p>
                    Dogs may attempt to vomit but produce little or no content.
                    </p>
                    <h5>Excessive Drooling:</h5>
                    <p>
                    Drooling more than usual can be a sign of discomfort.
                    </p>
                    <h5>Difficulty Breathing:</h5>
                    <p>
                    As the stomach enlarges, it can put pressure on the diaphragm, making breathing difficult.
                    </p>
                    <h5>Rapid Heart Rate:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                    <h5>Collapse:</h5>
                    <p>
                    In severe cases, dogs may collapse due to shock.
                    </p>
                </p>
            </div>
            <div>
                <p>
                    <h3><b>Taking Swift Action</b></h3>
                    If you suspect your dog is experiencing bloating or GDV, don't hesitate to seek immediate veterinary care. Bloating is a medical emergency that requires professional intervention. Your veterinarian will perform a physical examination, potentially take X-rays, and take necessary measures to alleviate the pressure and address the twist if present.
                </p>
                <p>
                    <h3><b>Prevention is Key</b></h3>
                    <p>While not all cases of bloating can be prevented, there are steps you can take to minimize the risk:</p>
                    
                    <h5>1. Manage Meals:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                    <h5>2. Avoid Vigorous Activity After Eating:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                    <h5>3. Scheduled Feedings:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                    <h5>4. Elevated Food Bowls:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                    <h5>5. Regular Veterinary Check-ups:</h5>
                    <p>
                    An elevated heart rate can indicate distress.
                    </p>
                </p>
                <p>
                In conclusion, bloating in dogs is a serious condition that demands immediate attention. Being aware of the risk factors, recognizing the symptoms, and taking preventive measures can make all the difference in safeguarding your canine companion's health and well-being. Your dog's welfare is in your hands, and staying informed is a significant step towards ensuring their safety.
                </p>
            </div>      
        </div>
    </div>

    <?= $footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>