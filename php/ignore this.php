<?php 

if(isset($_POST["join-press"])){
    $animalDisplay = "";
    $sql = "SELECT * FROM animals WHERE ";
    $show = false;

    $age = ($_POST["age"]);
    $operator = ($_POST["operator"]);
    $location = ($_POST["location"]);


    
    if($age != "" && $operator != ""){
        $sql .= "age $operator $age";
        $show = true;
    }


    if($location != "" && $show == true) {
        $sql .= " AND address LIKE '$location'";
        echo $sql;
    }
    if($location != "" && $show == false){
        $sql .= "address LIKE '$location'";
        $show = true;
        echo $sql;
    }


    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $animalDisplay .= 
            "<div>
                <div class='card' style='width: 18rem;'>
                    <img src='../images/{$row["picture"]}' class='card-img-top object-fit-cover' alt='...' style='height: 30vh;'>
                    <div class='card-body'>
                        <h4 class='card-title mb-4 text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$row["name"]}</h4>
                        <hr class='TitleHR'>
                        <p class='card-text mt-5'><b>Age:</b> <br> {$row["age"]}</p>
                        <p class='card-text mb-5'><b>Size:</b><br> {$row["size"]}</p>
                        {$bttns}
                    </div>
                </div>
            </div>";
        }
    }
}