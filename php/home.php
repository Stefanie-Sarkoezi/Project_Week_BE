<?php
    require_once "footer.php";
    require_once "navbar.php";
    $animalDisplay = $age = $operator = $location = $species = $speciesOptions = "";
    

    require_once "db_connect.php";
    $name = "";
    $potwBtn ="
    <div class='row row-cols-xl-4 row-cols-md-2 row-cols-s-1 gap-3'>
        <form method='post' enctype='multipart/form-data' class='myForm'>
        <button name='allAnimals' class='btn btn-dark mybtn' type='submit'>All Animals</button>
        </form>
        <button class='btn btn-dark mybtn' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasScrolling' aria-controls='offcanvasScrolling'>Filter</button>
        <form method='post' enctype='multipart/form-data' class='myForm'>
        <button name='availableAnimals' class='btn btn-dark mybtn' type='submit'>Available Animals</button>
        </form>
        <form method='post' enctype='multipart/form-data' class='myForm'>
        <button name='adoptedAnimals' class='btn btn-dark mybtn' type='submit'>Adopted Animals</button>
        </form>
    </div>
    ";
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
        $name = "guest";
    }
    else{
        if(isset($_SESSION["user"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
        }
        if(isset($_SESSION["shelter"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["shelter"]}";
            $potwBtn ="
            <div class='row row-cols-xl-4 row-cols-md-2 row-cols-s-1 gap-3'>
            <form method='post' enctype='multipart/form-data' class='myForm'>
            <button name='findShelterAnimals' class='btn btn-dark mybtn' type='submit'>Own Animals</button>
            </form>
            <button class='btn btn-dark mybtn' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasScrolling' aria-controls='offcanvasScrolling'>Filter</button>
                <form method='post' enctype='multipart/form-data' class='myForm'>
                <button name='availableAnimals' class='btn btn-dark mybtn' type='submit'>Available Animals</button>
                </form>
                <form method='post' enctype='multipart/form-data' class='myForm'>
                <button name='adoptedAnimals' class='btn btn-dark mybtn' type='submit'>Adopted Animals</button>
                </form>
            </div>
            ";
        }
        if(isset($_SESSION["adm"])){
            $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
            $potwBtn ="
            <div class='row row-cols-xl-4 row-cols-md-2 row-cols-s-1 gap-3 mt-5'>
                <a class='btn btn-dark mybtn px-3 text-nowrap' type='button' href='create_potw.php'>Pet of the Week</a>
                <button class='btn btn-dark mybtn' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasScrolling' aria-controls='offcanvasScrolling'>Filter</button>
                <form method='post' enctype='multipart/form-data' class='myForm'>
                    <button name='availableAnimals' class='btn btn-dark mybtn text-nowrap' type='submit'>Available Animals</button>
                </form>
                <form method='post' enctype='multipart/form-data' class='myForm'>
                    <button name='adoptedAnimals' class='btn btn-dark mybtn text-nowrap ms-3' type='submit'>Adopted Animals</button>
                </form>
            </div>
            ";
        }
    
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["first_name"];
    }


    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";
    
    // -------------------PET OF THE WEEK--------------------------
    $sqlPow = "SELECT * FROM pet_of_week WHERE id = 1";
    $resultPow = mysqli_query($connect, $sqlPow);
    $rowNice = mysqli_fetch_assoc($resultPow);
    $sqlAnimal = "SELECT * FROM animals WHERE id = {$rowNice["animal_id"]}";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);
    $nicePet = "
        <div class='text-center my-5'>
            <div class='d-flex flex-row flex-wrap flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-xl-nowrap flex-xxl-nowrap justify-content-center align-items-center gap-5'>
                
                    <img src='../images/{$rowAnimal["picture"]}' class='img-fluid img-thumbnail rounded potwImg shadow' style='width: 50%; height: 50%; object-fit: cover; object-position: center;' alt='...' '>
               
                <div class='conTxt'>
                    <b class='mb-5  card-title'>{$rowAnimal["name"]}</b>
                    <p class='mt-3'>{$rowNice["description"]}  
                </div> 
            </div>
        </div>";

    $sqlPow = "SELECT * FROM pet_of_week WHERE id = 2";
    $resultPow = mysqli_query($connect, $sqlPow);
    $rowNice = mysqli_fetch_assoc($resultPow);
    $sqlAnimal = "SELECT * FROM animals WHERE id = {$rowNice["animal_id"]}";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);
    $naughtyPet = "
        <div class='text-center my-5'>
            <div class='d-flex flex-row flex-wrap flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-xl-nowrap flex-xxl-nowrap justify-content-center align-items-center gap-5'>
                
                    <img src='../images/{$rowAnimal["picture"]}' class='img-fluid img-thumbnail rounded potwImg shadow' style='width: 50%; height: 50%; object-fit: cover; object-position: center;' alt='...' '>
               
                <div class='conTxt'>
                    <b class='mb-5 card-title'>{$rowAnimal["name"]}</b>
                    <p class='mt-3'>{$rowNice["description"]}  
                </div> 
            </div>
        </div>";
    // ------------------------PET OF THE WEEK END-------------------------------------

    // fetch all animal breeds from the table, dont repeat same species twice
    $checkerArray = [];
    $sqlX = "SELECT * FROM `animals`";
    $result = mysqli_query($connect, $sqlX);
    if(mysqli_num_rows($result) > 0){
        while($rowAnimal = mysqli_fetch_assoc($result)){
            // If an animal species from $rowAnimal["breed"] already exists in the array, don't print
            // an extra option, then push it into the array
            if (in_array($rowAnimal["breed"], $checkerArray, TRUE)) {
                array_push($checkerArray, $rowAnimal["breed"]);
            }
            // If an animal species from $row["breed" doesn't exist in the array yet, print an 
            // extra option line. Then push it into the array. This way you avoid duplicates like
            // printing an "Option dog" for every single dog in the table
            else {
                array_push($checkerArray, $rowAnimal["breed"]);
                $speciesOptions .= 
                "<option value='{$rowAnimal["breed"]}'>{$rowAnimal["breed"]}</option>";
            }
        }
    }
    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){
            $adoptBtn = "";
            if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
            } else {
                $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
            }
            if(isset($_SESSION["adm"])){
                $bttn ="
                <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                            <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                </div>";
            }
            if(isset($_SESSION["user"])){
                $bttn ="
                <div class='buttons text-center'> 
                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                    {$adoptBtn}
                </div>";
            }
            if(isset($_SESSION["shelter"])){
                if($rowAnimal["agency_id_fk"] == $row["id"]){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                else{
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
            }
            if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                $bttn ="
                <div class='buttons text-center'> 
                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                    <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                </div>";
            }
            $animalDisplay .= "<div>
            <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                </div>
          </div>";
        }
    }else {
        $animalDisplay.= "No results found!";
    }
    // Combine any number of criteria :D
    if(isset($_POST["join-press"])){
        $animalDisplay = "";
        $sql = "SELECT * FROM animals WHERE ";
        $show = false;

        $age = ($_POST["age"]);
            $operator = ($_POST["operator"]);
            $location = ($_POST["location"]);
            $location = "%".$location."%";
            $species = ($_POST["species"]);

        
            if($age != "" && $operator != ""){
                $sql .= "age $operator $age";
                $show = true;
            }
    
    
            if($location != "" && $show == true) {
                $sql .= " AND address LIKE '$location'";
            }
            if($location != "" && $show == false){
                $sql .= "address LIKE '$location'";
                $show = true;
            }
    
            if($species != "" && $show == true) {
                $sql .= " AND breed = '$species'";
            }
            if($species != "" && $show == false){
                $sql .= "breed = '$species'";
                $show = true;
            }
    
            if ($sql == "SELECT * FROM animals WHERE ") {
                echo "DO SOMETHING";
            }
        
        $show = true;
        $result = mysqli_query($connect, $sql);

        // for debugging
        // echo $sql;

        if(mysqli_num_rows($result) > 0){
            while($rowAnimal = mysqli_fetch_assoc($result)){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $animalDisplay .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }
        }else {
            $animalDisplay.= "No results found!";
        }
    }
    if(isset($_POST["findShelterAnimals"])){
        $animalDisplay = "";
        $sql = "SELECT * FROM animals WHERE agency_id_fk = $row[id]";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) > 0){
            while($rowAnimal = mysqli_fetch_assoc($result)){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $animalDisplay .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }
        }else {
            $animalDisplay.= "No results found!";
        }
        $potwBtn ="
        <div class='row row-cols-xl-4 row-cols-md-2 row-cols-s-1 gap-3'>
            <form method='post' enctype='multipart/form-data' class='myForm'>
            <button name='allAnimals' class='btn btn-dark mybtn' type='submit'>All Animals</button>
            </form>
            <button class='btn btn-dark mybtn' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasScrolling' aria-controls='offcanvasScrolling'>Filter</button>
            <form method='post' enctype='multipart/form-data' class='myForm'>
            <button name='availableAnimals' class='btn btn-dark mybtn' type='submit'>Available Animals</button>
            </form>
            <form method='post' enctype='multipart/form-data' class='myForm'>
            <button name='adoptedAnimals' class='btn btn-dark mybtn' type='submit'>Adopted Animals</button>
            </form>
        </div>
        ";
    }
    if(isset($_POST["allAnimals"])){
        $animalDisplay = "";
        $sql = "SELECT * FROM animals";
        $result = mysqli_query($connect, $sql);

        // for debugging
        // echo $sql;

        if(mysqli_num_rows($result) > 0){
            while($rowAnimal = mysqli_fetch_assoc($result)){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $animalDisplay .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }
        }else {
            $animalDisplay.= "No results found!";
        }
    }
    if(isset($_POST["availableAnimals"])){
        $animalDisplay = "";
        $sql = "SELECT * FROM animals WHERE status = '1'";
        $result = mysqli_query($connect, $sql);

        // for debugging
        // echo $sql;

        if(mysqli_num_rows($result) > 0){
            while($rowAnimal = mysqli_fetch_assoc($result)){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $animalDisplay .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }
        }else {
            $animalDisplay.= "No results found!";
        }
    }
    if(isset($_POST["adoptedAnimals"])){
        $animalDisplay = "";
        $sqlAdA = "SELECT * FROM animals WHERE status = '0'";
        $resultAdA = mysqli_query($connect, $sqlAdA);

        // for debugging
        // echo $sql;

        if(mysqli_num_rows($resultAdA) > 0){
            while($rowAnimal = mysqli_fetch_assoc($resultAdA)){
                $adoptBtn = "";
                if($rowAnimal["status"] == 0 || $rowAnimal["status"] == 2){
                    $adoptBtn = "<button href='adopt.php?x={$rowAnimal["id"]}' class='btn text-white' disabled id='upBtn'>Take me home</button>";
                } else {
                    $adoptBtn = "<button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='adopt.php?x={$rowAnimal["id"]}'>Take me home </a> </button>";
                }
                if(isset($_SESSION["adm"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                                <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                    </div>";
                }
                if(isset($_SESSION["user"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        {$adoptBtn}
                    </div>";
                }
                if(isset($_SESSION["shelter"])){
                    if($rowAnimal["agency_id_fk"] == $row["id"]){
                        $bttn ="
                        <div class='buttons text-center'> 
                                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                                    <a href='edit.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Edit</a>
                                    <a href='delete.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Delete</a>
                        </div>";
                    }
                    else{
                        $bttn ="
                        <div class='buttons text-center'> 
                            <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                            {$adoptBtn}
                        </div>";
                    }
                }
                if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["shelter"])){
                    $bttn ="
                    <div class='buttons text-center'> 
                        <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                        <button  class='btn text-white' id='upBtn'> <a class='text-decoration-none text-white' href='login.php'>Take me home </a> </button>
                    </div>";
                }
                $animalDisplay .= "<div>
                <div class='card gap-2 mt-5 mb-5 shadow align-items-center' style='width: 17rem;'>
                    <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='max-height:50%; object-fit:cover;'>
                    <div class='card-body '>
                    <h3 class='card-title text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h3>
                    <hr class='TitleHR'>
                    <p class='card-text ps-3 mt-4'><b>Age:</b> <br> {$rowAnimal["age"]} Years</p>
                    <p class='card-text mb-4 ps-3'><b>Size:</b><br> {$rowAnimal["size"]} cm</p>
                    {$bttn}
                    </div>
                    </div>
              </div>";
            }
        }else {
            $animalDisplay.= "No results found!";
        }
    }
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $name ?></title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">
   <link rel="Stylesheet" href="../css/home.css">

</head>
<body>
    <?=$nav ?>
    <div class="headerImage mb-5">
        <p id="hero">PAWFECT <br> - MATCH -</p>
    </div>

    <div class="text-center">
        <h2 class="text-center mt-5" id="welcome">Welcome <?= $name ?>!</h2>
        <hr class="MLLine" style="width:20vw;">
    </div>

    <div class="container">
        <hr class="mt-5 mb-4">
        <div class="d-flex flex-row flex-wrap flex-sm-wrap flex-md-wrap flex-lg-nowrap flex-xl-nowrap flex-xxl-nowrap justify-content-center align-items-stretch gap-4">
            <div class="text-center bg-light rounded shadow flex-grow-1">
                <h2 class="mb-5 mt-4 card-title">NICE PET OF THE WEEK</h2>
                <?=$nicePet?>
            </div>
            <div class="text-center bg-light rounded shadow flex-grow-1">
                <h2 class="mb-5 mt-4 card-title">NAUGHTY PET OF THE WEEK</h2>
                <?=$naughtyPet?>
            </div>
        </div>
        <hr class="mb-5 mt-4">
        <?= $potwBtn ?>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header myFilter">
                <h5 class="offcanvas-title text-light" id="offcanvasScrollingLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body myFilter">
                <hr>
                <!-- Form to find by Age -->
                <form method="post" enctype="multipart/form-data">
                    <label for="age" class="text-light">Age: </label>
                    <input type="text" class="form-control mt-2" name="age"><br>
                        <label for="operator" class="text-light">Operator: </label>
                        <select id="operator" class="form-select mt-2" name="operator">
                            <option value="">Select an operator</option>
                            <option value="=">Equals</option>
                            <option value=">">MoreThan</option>
                            <option value="<">LessThan</option>
                        </select>
                    <hr>
                    <!-- Form to find by Location (PLZ) -->
                    <label for="location" class="text-light">District: </label>
                    <select id="location" class="form-select mt-2" name="location">
                        <option value="">Select a Location</option>
                        <option value="1010">1010 Innere Stadt</option>
                        <option value="1020">1020 Leopoldstadt</option>
                        <option value="1030">1030 Landstraße</option>
                        <option value="1040">1040 Wieden</option>
                        <option value="1050">1050 Margareten</option>
                        <option value="1060">1060 Mariahilf</option>
                        <option value="1070">1070 Neubau</option>
                        <option value="1080">1080 Josefstadt</option>
                        <option value="1090">1090 Alsergrund</option>
                        <option value="1100">1100 Favoriten</option>
                        <option value="1110">1110 Simmering</option>
                        <option value="1120">1120 Meidling</option>
                        <option value="1130">1130 Hietzing</option>
                        <option value="1140">1140 Penzing</option>
                        <option value="1150">1150 Rudolfsheim-Fünfhaus</option>
                        <option value="1160">1160 Ottakring</option>
                        <option value="1170">1170 Hernals</option>
                        <option value="1180">1180 Währing</option>
                        <option value="1190">1190 Döbling</option>
                        <option value="1200">1200 Brigittenau</option>
                        <option value="1210">1210 Floridsdorf</option>
                        <option value="1220">1220 Donaustadt</option>
                        <option value="1230">1230 Liesing</option>
                    </select>
                    <hr>
                    <!-- Form to find by Species -->
                    <label for="species" class="text-light">Species: </label>
                    <select id="species" class="form-select mt-2" name="species">
                        <option value="">Select Species</option>
                        <?= $speciesOptions ?>
                    </select>
                    <button name="join-press" class="btn btn-secondary mt-3" type="submit">FindByCriteria</button>
                </form>
            </div>
        </div>
        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $animalDisplay ?>
        </div>
    </div>
    <?=$footer ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>