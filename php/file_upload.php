<?php
   function fileUpload($picture, $source = "user"){

        if($picture["error"] == 4){ 
           $pictureName = "avatar.png"; 

            if($source == "animal"){
                $pictureName = "pet-avatar.png";
            }

           $message = "You didn't choose a picture. You can upload it later." ;
       }else{
           $checkIfImage = getimagesize($picture["tmp_name"]); 
           $message = $checkIfImage ? "Ok" : "Not image";
       }

        if($message == "Ok"){
           $ext = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION)); 
           $pictureName = uniqid("" ). "." . $ext; 
           $destination = "../images/{$pictureName}" ; 

            if($source == "animal"){
                $destination = "../images/{$pictureName}" ;
            }

           move_uploaded_file($picture["tmp_name"], $destination); 
       }elseif($message == "Not image"){
            $pictureName = "avatar.png"; 
            $message = "That's not an image!" ;
       }

       return  [$pictureName, $message];
   }

?>