
<?php 
session_start();
require "db.php";

$email = "";
$classname = "";
$name = "";


require 'php/PHPMailer.php';
require 'php/SMTP.php';
require 'php/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->SMTPDebug  = 2;  
$mail->Port       = 587;




$mail->isSMTP();

$mail->Host = "smtp.gmail.com";



$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls';            
$mail->isHTML(true);

$mail->Username = "aralink.xyz@gmail.com";
$mail->Password = 'khpdauesnaeizzmv'; 

$mail->setFrom('aralink.xyz@gmail.com','AraLink');



$errors = array();

    /* Signup */
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $classname = $_POST['classname'];

        if(preg_match("~@gmail\.com$~",$email)){

            $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
            $query->execute([':email' => $email]);
            if( $query->rowCount() > 0){
                $errors[':email'] = "Email that you have entered is already exist!";
            } else {

                if($password !== $cpassword){
                    $errors['password'] = "Confirm password not matched!";
                } else {
                if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $password)) {


                
    
               
                if(count($errors) === 0){
                $classcode =    substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,8))), 1, 8);
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $code = rand(999999, 111111);
                $status = "notverified";

                $query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :classcode");
                $query->execute([':classcode' => $classcode]);
                if( $query->rowCount() > 0){
                    $classcode =    substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,8))), 1, 8);
                } else {


                
                $query = $conn->prepare("INSERT INTO classadmin (name, email, password, code, status, classname, classcode)
                                values(:name, :email, :password, :code, :status, :classname, :classcode)");
                $result=$query->execute([':name' => $name, ':email' => $email, ':password' => $encpass, ':code' => $code,':status' => $status,':classname' => $classname,':classcode' => $classcode]);
                    if($result){
        

                        $mail->addAddress($email);
                        $mail->Subject='Email Verification Code';
                        $mail->Body="Your verification code is <b>$code</b>";



                        if($mail->send()){
                            $info = "We've sent a verification code to your email - $email";
                            $_SESSION['info-otp'] = $info;
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                        
                            header('location: otp');
                            exit();
                        }else{
                            $errors['otp-error'] = "Failed while sending code!";
                        }
                    }else{
                        $errors['db-error'] = "Failed while inserting data into database!";
                    }
                }
                
            }
            } else{
                $errors['password'] = "password does not meet m inimum requoirements";
            }
        }
    }
}
        else{
            $errors['email'] = "bobo gmail nga e.";
        }
    }


    /* Click Verification Button */
     if(isset($_POST['check'])){
       /*  $_SESSION['info'] = ""; */
        $otp_code = $_POST['otp'];
        if (preg_match('/^([0-9]*)$/', $otp_code)) {
            $query = $conn->prepare("SELECT * FROM classadmin WHERE code = :code");
            $query->execute([':code' => $otp_code]);
            if($query->rowCount() > 0){
                $fetch = $query->fetch(PDO::FETCH_ASSOC);
                $fetch_code = $fetch['code'];
                $email = $fetch['email'];
                $code = 0;
                $status = 'verified';
                $query  = $conn->prepare("UPDATE classadmin SET code = :newCode, status = :status WHERE code = :oldCode");
                $result = $query->execute([':newCode' => $code, ':status' => $status, ':oldCode' => $fetch_code]);
                if($result){
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    header('location: home');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while updating code!";
                }
            }else{
                $errors['otp-error'] = "You've entered incorrect code!";
            }
        }else{
            $errors['otp-error'] = "bobo number nga e.";
        }
    } 

    /* Login */
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password =  $_POST['password'];
        if(preg_match("~@gmail\.com$~",$email)){
            $query  = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
            $query->execute([':email' => $email]);
            if($query->rowCount() > 0){
                $fetch = $query->fetch(PDO::FETCH_ASSOC);
                $fetch_pass = $fetch['password'];
                if(password_verify($password, $fetch_pass)){
                    $_SESSION['email'] = $email;
                    $status = $fetch['status'];
                    if($status == 'verified'){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: home');
                    }else{
                        $info = "It's look like you haven't still verify your email - $email";
                        $_SESSION['info-otp'] = $info;
                        header('location: otp');
                     }
                }else{
                     $errors['email'] = "Incorrect email or password!";
                }
            }else{
                 $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
            }
        }
        else{
            $errors['email'] = "bobo gmail nga e.";
        } 
    }

    /* Forgot Password Check Email */
    if(isset($_POST['check-email'])){
        $email = $_POST['email'];
        if(preg_match("~@gmail\.com$~",$email)){
            $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
            $query->execute([':email' => $email]);
            if($query->rowCount() > 0){
                $code = rand(999999, 111111);
                $query=  $conn->prepare("UPDATE classadmin SET code = :code WHERE email = :email");
                $result = $query->execute([':code' => $code, ':email' => $email]);       
                if($result){
                    $mail->addAddress($email);
                    $mail->Subject='Email Verification Code';
                    $mail->Body="Your verification code is <b>$code</b>";

                    if($mail->send()){
                        $info = "We've sent a passwrod reset otp to your email - $email";
                        $_SESSION['info-rotp'] = $info;
                        $_SESSION['email'] = $email;
                        header('location: reset-otp');
                        exit();
                    }else{
                        $errors['otp-error'] = "Failed while sending code!";
                    }
                }else{
                    $errors['db-error'] = "Something went wrong!";
                }
            }else{
                $errors['email'] = "This email address does not exist!";
            }
        }else{
            $errors['email'] = "bobo gmfdssfail nga e.";
        }
    }

    /* Check Reset OTP */
    if(isset($_POST['check-reset-otp'])){
        /* $_SESSION['info'] = ""; */
        $otp_code = $_POST['otp'];
        $query  = $conn->prepare("SELECT * FROM classadmin WHERE code = :code");
        $query->execute([':code' => $otp_code]);
        if (preg_match('/^([0-9]*)$/', $otp_code)) {
            if($query->rowCount() > 0){
                $fetch =  $query->fetch(PDO::FETCH_ASSOC);
                $code = 0;

                $email = $fetch['email'];
                $_SESSION['email'] = $email;
                $info = "Please create a new password that you don't use on any other site.";
                $_SESSION['info-np'] = $info;
                $query = $conn->prepare("UPDATE classadmin SET code = :code WHERE email = :email");
                $result=$query->execute([':code' => $code, ':email' => $email]);
                if ($result) {
                    header('location: new-password');
                } else {
                    $errors['code'] = "Simethong is wrong!";
                }
               
                exit();
            }else{
                $errors['otp-error'] = "You've entered incorrect code!";
            }
        }else{
            $errors['otp-error'] = "bobo number nga e.";
        }
    }

    /* Change Password */
    if(isset($_POST['change-password'])){
 /*        $_SESSION['info'] = ""; */
        $password = $_POST['password'];
        $cpassword =  $_POST['cpassword'];

            if($password !== $cpassword){
                $errors['password'] = "Confirm password not matched!";
            } else{ 
                if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $password)) {
            /* $code = 0; */
            $email = $_SESSION['email'];
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $query = $conn->prepare("UPDATE classadmin SET password = :password WHERE email = :email");
            $result=$query->execute([':password' => $encpass, ':email' => $email]);
      
                if($result){
                    $success = "Your password changed. Now you can login with your new password.";
                    $_SESSION['info-success'] = $success;
                    header('Location: login');
                }else{
                    $errors['db-error'] = "Failed to change your password!";
                }
            }else {
                $errors['password'] = "password does not meet m inimum requoirements";
        }
    }
}

    /* Login Now */
    if(isset($_POST['login-now'])){
        header('Location: php/login');
    }


    /* Admin */
    /* Class Change Name */
    if(isset($_GET['change-name'])){
         $varivari =  $_GET['varivari'];
         $id =  $_GET['id'];
         $changename = $_GET['change-name'];
         $query  = $conn->prepare("UPDATE classadmin SET classname = :classname WHERE id = :id");
        $query->execute([':classname' => $changename, ':id' => $id]);
     }

    /* Upload Image */
    if(isset($_POST["upload-image"])){ 
        $varivari= $_SESSION["classcode"];
        $img_size = $_FILES['image']['size'];
       
            if(!empty($_FILES["image"]["name"])) { 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                $allowTypes = array('png'); 
                if(in_array($fileType, $allowTypes)){ 
                    if ($img_size < 16000000) {
                    $image = $_FILES['image']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $query  = $conn->prepare("UPDATE classadmin SET images = '$imgContent' WHERE classcode = '$varivari'");
                    $result = $query->execute(); 
                    if($result){ 
                        $info = "Uploaded Succesfully";
                        $_SESSION['info-image'] = $info;
                    }else{ 
                        $errors['images'] = "File upload failed, please try again."; 
                    }  
                
                }else{ 
                    $errors['images'] = "Please upload less than 100kb"; 
                }
                }else{ 
                    $errors['images'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                } 
            }else{ 
                $errors['images'] = 'Please select an image file to upload.'; 
            }
        ?>
        
        
        <script>
            var message = "e";
        </script> 
            <?php  
    } 

    /* Delete Image */
    if(isset($_POST['remove-image'])) {
        $varivari= $_SESSION["classcode"];
        
        $query  = $conn->prepare("UPDATE classadmin SET images = '' WHERE classcode = '$varivari'");
       $query->execute(); 
    }



    /* resenr for otp */
    if(isset($_POST['resend'])) {
        $email = $_POST['email'];
      
    /*     if ($_POST['otp-check'] != "" ) { */
          
         
        $code = rand(999999, 111111);
        $query=  $conn->prepare("UPDATE classadmin SET code = :code WHERE email = :email");
        $result = $query->execute([':code' => $code, ':email' => $email]);       
        if($result){
         
            $mail->addAddress($email);
            $mail->Subject='Email Verification Code';
            $mail->Body="Your verification code is <b>$code</b>";

            if($mail->send()){
                $info = "Code Resend to $email.";
                
                $_SESSION['info-otp'] = $info;
                $_SESSION['email'] = $email;
                header('location: otp');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
   /*  } else {
        $errors['db-error'] = "put a text!";
    } */
    } 
    /* resenr for reset-otp */
    if(isset($_POST['resendd'])) {
        $email = $_POST['email'];
      
    /*     if ($_POST['otp-check'] != "" ) { */
          
         
        $code = rand(999999, 111111);
        $query=  $conn->prepare("UPDATE classadmin SET code = :code WHERE email = :email");
        $result = $query->execute([':code' => $code, ':email' => $email]);       
        if($result){
            $mail->addAddress($email);
            $mail->Subject='Email Verification Code';
            $mail->Body="Your verification code is <b>$code</b>";

            if($mail->send()){
                $info = "Code Resend to $email.";
                
                $_SESSION['info-rotp'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-otp');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
   /*  } else {
        $errors['db-error'] = "put a text!";
    } */
    } 
    
    /* Index */
    /* Guest */
    if(isset($_POST['submit'])){
        $codihe = $_POST['c'];
            $query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :classcode");
            $query->execute([':classcode' => $codihe]);
            if($query->rowCount() > 0){
                header('location: guest?c='.$codihe);   
            } else {
            $errors['classcode'] = "Looks like bobo!";
            ?>
        <script>
            var error = "error";
        </script> 
            <?php 
        }
    }
?>