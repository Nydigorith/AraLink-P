
<?php 
session_start();
require "db.php";
require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $classname = $_POST['classname'];
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
   /*  $email_check = "SELECT * FROM classadmin WHERE email = '$email'"; */

    $email_check = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
    $email_check->execute([':email' => $email]);


    if( $email_check->rowCount() > 0){
        $errors[':email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){

       
$classcode =    substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,8))), 1, 8);
    
   
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";


        $insert_data = $conn->prepare("INSERT INTO classadmin (name, email, password, code, status, classname, classcode)
                        values(:name, :email, :password, :code, :status, :classname, :classcode)");
        
        $data_check=$insert_data->execute([':name' => $name, ':email' => $email, ':password' => $encpass, ':code' => $code,':status' => $status,':classname' => $classname,':classcode' => $classcode]);

        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: smtpwebsitesmtp@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}





    //if user click verification code submit button
     if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
    
        $check_code = $conn->prepare("SELECT * FROM classadmin WHERE code = :code");
         $check_code->execute([':code' => $otp_code]);
    
        if($check_code->rowCount() > 0){
            $fetch_data = $check_code->fetch(PDO::FETCH_ASSOC);

             print_r($fetch_data); 
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';

          

            $update_otp  = $conn->prepare("UPDATE classadmin SET code = :newCode, status = :status WHERE code = :oldCode");
            $update_res = $update_otp->execute([':newCode' => $code, ':status' => $status, ':oldCode' => $fetch_code]);


            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    } 



    //if user click login button
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password =  $_POST['password'];

       
        $check_email  = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
       $check_email->execute([':email' => $email]);


       
        if($check_email->rowCount() > 0){
            $fetch = $check_email->fetch(PDO::FETCH_ASSOC);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = $_POST['email'];

        $check_email = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
        $check_email->execute([':email' => $email]);



 
        if($check_email->rowCount() > 0){
            $code = rand(999999, 111111);
            $insert_code =  $conn->prepare("UPDATE classadmin SET code = :code WHERE email = :email");
            $run_query = $insert_code->execute([':code' => $code, ':email' => $email]);
            
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: shahiprem7890@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
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
    }

    //if user click check reset otp button reset-code
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
    


        $check_code  = $conn->prepare("SELECT * FROM classadmin WHERE code = :code");
        $check_code->execute([':code' => $otp_code]);

        if($check_code->rowCount() > 0){
      
            $fetch_data =  $check_code->fetch(PDO::FETCH_ASSOC);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $cpassword =  $_POST['cpassword'];
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            /* $update_pass = "UPDATE classadmin SET code = $code, password = '$encpass' WHERE email = '$email'"; */
          

            $update_pass = $conn->prepare("UPDATE classadmin SET code = :code, password = :password WHERE email = :email");
$run_query=$update_pass->execute([':code' => $code, ':password' => $encpass, ':email' => $email]);

            
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    if(isset($_GET['change-name'])){
       
        /*  $varivari = $_GET['varivari']; */
        /*  $id = $_GET['is']; */
         $varivari =  $_GET['varivari'];
         $id =  $_GET['id'];
         $changename = $_GET['change-name'];

         $update_name  = $conn->prepare("UPDATE classadmin SET classname = :classname WHERE id = :id");



     $update_name->execute([':classname' => $changename, ':id' => $id]);



      
           
             
        
     }

  
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: php/login-user.php');
    }
?>