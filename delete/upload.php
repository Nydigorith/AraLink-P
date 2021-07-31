<?php
include 'db.php';
$varivari= $_SESSION["classcode"];
if(isset($_POST["upload-image"])){ 
	$img_size = $_FILES['image']['size'];
	if ($img_size < 65536) {
        if(!empty($_FILES["image"]["name"])) { 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $allowTypes = array('png'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
                $query  = $conn->prepare("UPDATE classadmin SET images = '$imgContent' WHERE classcode = '$varivari'");
                $result = $query->execute(); 
                if($result){ 
                    $info = "Uploaded Succesfully";
                    $_SESSION['info'] = $info;
                }else{ 
                    $errors['images'] = "File upload failed, please try again."; 
                }  
            }else{ 
                $errors['images'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $errors['images'] = 'Please select an image file to upload.'; 
        } 
    }else{ 
        $errors['images'] = "malaki."; 
    } 
} 
?>