<?php
    require_once "footer.php";
    require_once "navbar.php";

    require_once "db_connect.php";
?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>About us</title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <?= $nav ?>

    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">FAQs</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container mt-5">
        <div class="mb-3">
            <p><b> Welcome to Pawfect: Where Hearts and Homes Unite </b></p>
        </div>
        <div class="mb-3">
            <p><b> Our Guideline: Don't Shop - Adopt! </b></p>
        </div>
        <div class="mb-3">
            <p> At Pawfect, our purpose is crystal clear: we are a passionate team of animal-loving Web Developers and Designers who have come together to create a meaningful bridge between animal shelters and those seeking to open their hearts and homes to a new furry friend. </p>
        </div>
        <div class="mb-3">
            <p><b> Our Journey </b></p>
        </div>
        <div class="mb-3">
            <p> Our story embarked on a path of compassion during our educational journey. Tasked with a substantial web project, we harnessed our collective affection for animals and conceptualized a platform dedicated to pet adoption. What originated as a project soon evolved into a heart-driven endeavor, as we poured our creativity and expertise into a comprehensive online space designed to connect pets in need with their ideal forever families. </p>
        </div>
        <div class="mb-3">
            <p><b> From Virtual to Reality </b></p>
        </div>
        <div class="mb-3">
            <p> The exhilaration we felt while crafting the platform spurred us to convert our digital vision into a tangible reality. Each aspect of Pawfect, from its user-friendly features to its captivating design, was meticulously fashioned to create a seamless experience for shelters and potential adopters alike. Our devotion to this cause was unwavering, propelling us to transform our online creation into a genuine platform where pets could truly find the love-filled homes they deserve. </p>
        </div>
        <div class="mb-3">
            <p><b> Guided by Compassion, Not Profit </b></p>
        </div>
        <div class="mb-3">
            <p> Our compass is set by compassion, not financial gain. This endeavor is a testament to our sincere concern for animal welfare. Profit is not our motive - our true reward lies in knowing that we are instrumental in bringing animals in need together with compassionate individuals and families. </p>
        </div>
        <div class="mb-3">
            <p><b> Join the Pawfect Journey </b></p>
        </div>
        <div class="mb-3">
            <p> If you're an animal shelter seeking to collaborate or an individual excited to extend a warm welcome to a new companion, we invite you to be a part of the Pawfect journey. Each adoption, every wagging tail, and the bonds formed remind us of the incredible power of empathy and care. </p>
        </div>
        <div class="mb-3">
            <p> Thank you for making Pawfect your platform of choice. Together, let's make the world a haven for our beloved four-legged friends. </p>
        </div>
        <div class="mb-3">
            <p> With heartfelt gratitude,
 </p>
        </div>
        <div class="mb-3">
            <p> The Pawfect Team </p>
        </div>
    </div>


    <?=$footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html> 