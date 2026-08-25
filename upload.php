
<?php
    $target_dir="uploads/";
    $target_file=$target_dir . basename($_FILES["file"]["name"]);

    $uploadOK=1;

    $imageFileType=strtolower( pathinfo($target_file , PATHINFO_EXTENSION ));
    if(isset ($_POST["submit"])){
        $check=getimagesize($_FILES["file"] ["tmp_name"]);

        if($check != false){
            echo "uploaded file is image";
            $uploadOK=1;

        } else{
            echo "file is not an image";
            $uploadOK=0;
        }
    
    }

    if(file_exists ($target_file)){
        echo "file already exists";
        $uploadOK=0;
    }

    if($_FILES["file"] ["size"]> 5000000){
        echo "file size excedes limit";
        $uploadOK=0;
    }

    if($imageFileType !== 'jpg' && $imageFileType !== 'png' 
        && $imageFileType !== 'jpeg' && $imageFileType !== 'gif' ){
            echo "unsuported filr type";
            $uploadOK=0;
        }

    if($uploadOK == 0){
        echo "Sorry, your file is not uploaded";
    } else{
        if(move_uploaded_file ($_FILES["file"] ["tmp_name"], $target_file)){
            echo "file is uploaded successfully";
        }else{
            echo "Error uplaoding your file";
        }
    }