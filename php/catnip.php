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
            <img src="../images/CatnipCat.png" alt="" class="img-fluid h-50">
            <div class="mb-5">
                    <h2 class="" id="welcome">The Feline Fascination: How Catnip Affects Cats</h2>
                <hr class="MLLine" style="width:20vw;">
                <p>
                    <b class="m-0 fs-1">C</b>atnip, scientifically known as Nepeta cataria, has long held a mysterious allure over our feline friends. The sight of a cat rolling, rubbing, and purring with abandon when exposed to catnip is a common and often comical sight. But what exactly is catnip, and how does it affect cats?
                </p>
            </div>
        </div>
        <div class="d-flex flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-row gap-5 m-5 mb-3">
            <div>
                <p>
                    <h3><b>The Catnip Connection</b></h3>
                    Catnip is a herbaceous plant from the mint family, native to Europe and Asia but now found worldwide. Its distinctive aroma is the result of a compound called nepetalactone, found in the leaves, stems, and seeds of the plant. When cats come into contact with catnip, whether through sniffing, licking, or chewing, the nepetalactone interacts with their olfactory receptors, triggering a series of intriguing reactions.
                </p>
                <p>
                    <h3><b>The "Catnip High"</b></h3>
                    The most noticeable effect of catnip on cats is their almost euphoric response. It's not uncommon to see a cat sniff, chew, or rub against catnip, followed by a burst of energetic behavior. This can include rolling around, playful antics, and heightened vocalizations. Some cats may even become more affectionate during their catnip-induced moments.
                </p>
                <p>
                    <h3><b>The Chill Out Zone</b></h3>
                    While some cats exhibit exuberance, others react to catnip in a more sedate manner. Instead of hyperactivity, they may enter a state of relaxation and blissful calmness. This tranquil reaction can be particularly soothing for anxious or stressed cats.
                </p>
                <p>
                    <h3><b>The Temporary Nature</b></h3>
                    The effects of catnip are generally short-lived, lasting around 10 to 15 minutes. After this time, a refractory period follows during which the cat becomes temporarily immune to the allure of catnip. This reset mechanism ensures that cats don't become overwhelmed or desensitized to its effects.
                </p>
            </div>
            <div>
                <p>
                    <h3><b>The Genetic Quirk</b></h3>
                    Interestingly, not all cats are equally susceptible to the allure of catnip. Around 50-70% of cats possess the genetic predisposition to respond to catnip, while others show little to no interest. Kittens and elderly cats are less likely to react strongly to catnip, and its effects generally don't manifest in cats under six months old.
                </p>
                <p>
                    <h3><b>The Safe Indulgence</b></h3>
                    Catnip is considered safe for cats and can be a beneficial enrichment tool. It provides mental stimulation, encourages physical activity, and can even be used to redirect a cat's attention from destructive behavior. However, it's recommended not to overindulge cats in catnip sessions, as excessive exposure might lead to the cat becoming less responsive over time.
                </p>
                <p>
                    <h3><b>The Safe Indulgence</b></h3>
                    In addition to catnip, some cats may also respond to other plants in the Nepeta genus, such as silver vine or valerian root. These alternatives can provide similar stimulating effects to catnip and offer variety in a cat's enrichment activities.
                </p>
                <p>
                    In conclusion, the enigmatic effects of catnip on cats continue to captivate and entertain pet owners worldwide. From playful escapades to serene relaxation, catnip's influence varies from feline to feline. As long as it's offered in moderation and as part of a well-rounded enrichment plan, catnip can be a safe and enjoyable experience for both cats and their human companions. So, the next time you share a moment of catnip-induced bliss with your furry friend, remember you're witnessing one of nature's quirks that makes our feline companions so endlessly fascinating.
                </p>
            </div>      
        </div>
    </div>

    <?= $footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>